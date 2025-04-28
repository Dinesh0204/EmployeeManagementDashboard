<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
        <tr>
            <th class="py-3 px-6 text-left">Name</th>
            <th class="py-3 px-6 text-left">Department</th>
            <th class="py-3 px-6 text-left">Salary</th>
            <th class="py-3 px-6 text-left">Location</th>
            <th class="py-3 px-6 text-left">Created At</th>
        </tr>
    </thead>

    <tbody class="show-employee-listing text-gray-600">
        @foreach($employees as $employee)
        <tr class="border-b hover:bg-gray-50 {{$loop->even?'bg-gray-50':''}}">
            <td class="py-4 px-6">{{ $employee->name }}</td>
            <td class="py-4 px-6">{{ $employee->department->name }}</td>
            <td class="py-4 px-6">{{ $employee->salary }}</td>
            <td class="py-4 px-6">{{ $employee->location->name }}</td>
            <td class="py-4 px-6">{{ $employee->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>