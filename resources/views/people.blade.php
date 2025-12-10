@extends('layout')

@section('content')
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">People List</h1>
            <a href="/" class="text-blue-600 hover:underline">&larr; Back to Search</a>
        </div>

        <people-list></people-list>
    </div>
@endsection
