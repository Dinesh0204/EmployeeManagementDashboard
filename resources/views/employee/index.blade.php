@extends('layouts.app')

@section('content')
<div class="max-w-full mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-center flex-1">Employees</h1>
        <a class="block bg-green-900 text-white hover:bg-green-700 px-4 py-2 rounded-md ml-4" href="{{route('employee.create')}}">Create</a>
    </div>

    <div class="flex gap-6">
        <div class="w-64 bg-white shadow-md rounded-lg p-4 h-fit">
            <form method="post" id="employee-filter">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="department">Department</label>
                    <select name="department" id="department" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="salary">Salary</label>
                    <input type="text" name="salary" id="salary" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Salary">
                </div>

                <div>
                    <button type="submit" class="w-full !bg-green-900 text-white hover:bg-amber-700 px-4 py-2 rounded-md">
                        Filter
                    </button>
                </div>
            </form>
        </div>


        <div class="flex-1 overflow-x-auto" id="employee_ajax_listing">
            @include('employee.ajax_listing')
            <div>
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div>
            Chart
        </div>

    </div>
</div>
@push('scripts')
<script>
    const ctx = document.getElementById('myChart');
    let chart;
    $(document).ready(function() {
        loadChart();
    })

    $('#employee-filter').on('submit', function(e) {
        e.preventDefault();
        filter();
    })

    function filter() {
        $.ajax({
            type: 'POST',
            url: "{{route('employee.filter')}}",
            data: $('#employee-filter').serialize(),
            dataType: "json",
            success: function(data) {

                $('#employee_ajax_listing').html(data.success)
            },
            error: function(data) {}
        })
    }

    function loadChart() {
        $.ajax({
            type: 'GET',
            url: "{{route('employee.chart')}}",
            success: function(data) {
                xAxis = data.success.labels;
                yAxis = data.success.data;
                const config = {
                    type: 'line',
                    data: {
                        labels: xAxis,
                        datasets: [{
                            label: 'Employees Count',
                            data: yAxis,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Employee Count'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            }
                        }
                    }
                }
                chart = new Chart(ctx, config)
            }
        })
    }
</script>
@endpush
@endsection