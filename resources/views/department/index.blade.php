@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold mb-6 text-center">Departments</h1>
        <a href="{{route('department.create')}}">Create</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">CREATED AT</th>
                </tr>
            </thead>

            <tbody class="text-gray-600">
                @foreach($departments as $department)
                <tr class="border-b hover:bg-gray-50 {{$loop->even?'bg-gray-50':''}}">
                    <td class="py-4 px-6">{{ $department->name }}</td>
                    <td class="py-4 px-6">{{ $department->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection