@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold mb-6 text-center">Employees</h1>
        <a class="block bg-green-900 text-white hover:bg-green-700 px-4 py-2 rounded-md" href="{{route('employee.create')}}">Create</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Department</th>
                    <th class="py-3 px-6 text-left">Location</th>
                </tr>
            </thead>

            <tbody class="text-gray-600">
                @foreach($employees as $employee)
                <tr class="border-b hover:bg-gray-50 {{$loop->even?'bg-gray-50':''}}">
                    <td class="py-4 px-6">{{ $employee->name }}</td>
                    <td class="py-4 px-6">{{ $employee->department->name }}</td>
                    <td class="py-4 px-6">{{ $employee->location->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection