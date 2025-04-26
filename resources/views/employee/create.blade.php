@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Create Employee</h1>

    <div class="bg-white p-6">
        <form method="post" action="{{ route('employee.store') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="department" class="block text-gray-700 font-semibold mb-2">Department</label>
                <select name="department_id" id="department"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('department_id') border-red-500 @enderror">
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                <select name="location_id" id="location"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location_id') border-red-500 @enderror">
                    <option value="">Select Location</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
                @error('location_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="salary" class="block text-gray-700 font-semibold mb-2">Salary</label>
                <input type="text" name="salary" id="name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">

                @error('salary')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="cursor-pointer flex justify-center bg-green-700 hover:bg-green-900 ">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-all duration-200">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
@endsection