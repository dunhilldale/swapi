@extends('layout')

@section('content')
    <div class="max-w-2xl mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Star Wars Search</h1>
            <p class="text-gray-600">Find your favorite characters</p>
        </div>

        <search-bar></search-bar>

        <div class="mt-8 text-center">
            <a href="/people" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                View Saved Characters
            </a>
        </div>
    </div>
@endsection
