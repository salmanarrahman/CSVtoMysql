@extends('layouts.app')

@section('title', 'Upload Page')
@section('content')
<div class="mx-auto py-8">
    <form enctype="multipart/form-data"
          action="{{ route('csv.upload') }}"
          method="post"
          class="flex flex-col gap-4 p-4 bg-gray-50 border border-gray-300 rounded-lg shadow-md max-w-md mx-auto">
        @csrf
        <label class="text-gray-700 font-medium"
               for="file">
            CSV Upload
        </label>
        <input
            class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            type="file"
            name="csv_file"
            id="csv_file"
            accept=".csv"
            required
        >
        <button
            type="submit"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg  focus:outline-none focus:ring-2 focus:ring-indigo-400">
            Upload
        </button>
    </form>
    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {!! session('error') !!}
        </div>
    @endif
</div>
@endsection
