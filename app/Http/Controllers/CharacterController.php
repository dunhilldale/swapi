<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CharacterController extends Controller
{
    // Return merged people (SWAPI first page) + custom characters
    public function peopleList(Request $request)
    {
        // Fetch first page from SWAPI people endpoint
        $swapiUrl = 'https://swapi.dev/api/people';
        $resp = Http::get($swapiUrl);
        $swapiData = $resp->successful() ? $resp->json()['results'] : [];

        // Map SWAPI items to a uniform shape and mark as external
        $swapiMapped = array_map(function ($item) {
            return [
                'id' => null,
                'name' => $item['name'] ?? '',
                'gender' => $item['gender'] ?? null,
                'birth_year' => $item['birth_year'] ?? null,
                'height' => $item['height'] ?? null,
                'mass' => $item['mass'] ?? null,
                'custom' => false,
            ];
        }, $swapiData);

        // Fetch custom characters from database
        $custom = Character::all()->map(function ($c) {
            return [
                'id' => $c->id,
                'name' => $c->name,
                'gender' => $c->gender,
                'birth_year' => $c->birth_year,
                'height' => $c->height,
                'mass' => $c->mass,
                'custom' => true,
            ];
        })->toArray();

        return response()->json(array_merge($swapiMapped, $custom));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:50',
            'birth_year' => 'nullable|string|max:50',
            'height' => 'nullable|numeric|max:500',
            'mass' => 'nullable|numeric|max:500',
        ]);

        $character = Character::create($data);

        return response()->json(['character' => $character], 201);
    }

    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();

        return response()->json(['deleted' => true]);
    }

    public function search(Request $request)
    {
        $q = $request->query('q', '');
        if (!$q) {
            return response()->json([]);
        }

        $categories = ['people', 'films', 'planets', 'species', 'vehicles', 'starships'];
        $results = [];

        foreach ($categories as $cat) {
            $url = "https://swapi.dev/api/{$cat}?search=" . urlencode($q);
            $res = Http::get($url);
            if ($res->successful()) {
                $data = $res->json()['results'] ?? [];
                $top = array_slice($data, 0, 3); // top 3 per category
                $results[$cat] = $top;
            } else {
                $results[$cat] = [];
            }
        }

        // Search local database for people and merge
        $localMapped = (Character::getByName($q))->map(function ($c) {
            return array_merge($c->toArray(), ['custom' => true]);
        })->toArray();

        if (isset($results['people'])) {
            // Prepend local results to SWAPI results
            $results['people'] = array_merge($localMapped, $results['people']);
        } else {
            $results['people'] = $localMapped;
        }

        return response()->json($results);
    }
}
