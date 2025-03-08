@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="mx-auto py-8">
        @if ($isDatabaseEmpty)
            <div class="text-center py-16">
                <p class="text-gray-700 text-xl">
                    The database is currently empty.
                </p>
                <p class="text-gray-600 mt-2">
                    Please upload a CSV file to populate the data. Then you can perform search operation
                </p>
                <a href="{{ route('csv.upload') }}"
                   class="mt-4 inline-block bg-indigo-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-indigo-700">
                   Upload CSV File
                </a>
            </div>
        @else
            <form action="{{ route('get.population') }}"
                  method="post" class="space-y-4 p-6 bg-gray-100 rounded-lg shadow-md w-full max-w-md mx-auto">
                @csrf
                <div>
                    <label for="prefecture"
                           class="block text-sm font-medium text-gray-700">
                        Select Prefecture
                    </label>
                    <select
                        id="prefecture"
                        name="prefecture"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option  value="" selected>
                            -- Select Prefecture --
                        </option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->prefecture }}" >
                                {{ $prefecture->prefecture }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="year"
                           class="block text-sm font-medium text-gray-700">
                        Select Year
                    </label>
                    <select id="year"
                            name="year"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm " required>
                        <option
                            value="" selected>
                            -- Select Year --
                        </option>
                        @foreach ($years as $year)
                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="pt-2">
                    <button type="submit"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Get Population
                    </button>
                </div>
            </form>
        @endif
        <div class="mt-8">
            @if (!empty($query_result) && $query_result->count() > 0)
                <h1 class="text-center text-lg">Population Data</h1>
                <table class="min-w-full table-auto border-collapse border border-gray-200"
                >
                    <thead  class="bg-gray-100"
                    >
                    <tr>
                        <th class="px-6 py-4 text-sm text-gray-700 border border-gray-100">Prefecture</th>
                        <th class="px-6 py-4 text-sm text-gray-700 border border-gray-100">Year</th>
                        <th class="px-6 py-4 text-sm text-gray-700 border border-gray-100">Population</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200"
                    >
                    @foreach ($query_result as $population)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700 border border-gray-100"class="px-6 py-4 text-sm text-gray-700 border border-gray-100">{{ $population->prefecture }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 border border-gray-100">{{ $population->year }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 border border-gray-100">{{ $population->population }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @elseif(request()->isMethod('post'))
                <p>No Results</p>
            @endif
        </div>
    </div>
@endsection
