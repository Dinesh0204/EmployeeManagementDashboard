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

        <div class="w-full">
            <div id="employee_ajax_listing">
                @include('employee.ajax_listing')
            </div>
        </div>
    </div>
    <div>
        <div class="py-12 flex-1 overflow-x-auto pl-[240px]">

            <div class="bg-white rounded-lg shadow p-6 mb-10">
                <h2 class="text-2xl font-bold mb-6">Chart</h2>
                <div class="h-[400px]">
                    <canvas id="myChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold mb-6">Map</h2>
                <p class="text-gray-600 mb-6">The map below displays the locations of employees.</p>
                <div id="employee-location-map" class="w-full h-[400px] rounded-md border border-gray-300"></div>
            </div>
        </div>

    </div>
</div>
@push('scripts')
<script>
    const ctx = $('#myChart');
    let chart;
    let map;

    $(document).ready(function() {
        loadChart();
        loadMap();
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
                        responsive: true,
                        maintainAspectRatio: false,
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
                chart.canvas.parentNode.style.height = '60vh';

            }
        })
    }

    function loadMap() {
        map = L.map('employee-location-map');

        $.ajax({
            type: 'GET',
            url: "{{route('employee.map')}}",
            success: function(data) {
                console.log(data.success);
                map.setView([19.0760, 72.8777], 5);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                data.success.forEach(function(location) {
                    let lat = location.latitude;
                    let lng = location.longitude;

                    L.marker([lat, lng]).addTo(map)
                        .bindPopup("<b>" + location.name + "</b>"); // Display location name in popup
                });
            }
        });
    }
</script>
@endpush
@endsection