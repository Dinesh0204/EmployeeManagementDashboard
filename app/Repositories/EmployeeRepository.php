<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeRepository
{
    public function getAll()
    {
        return Employee::all();
    }

    public function getFilteredEmployees($filters = [])
    {
        $query =  Employee::query();

        $query->when(!empty($filters['department']), function ($subQuery) use ($filters) {
            $subQuery->where('department_id', $filters['department']);
        });

        $query->when(!empty($filters['salary']), function ($subQuery) use ($filters) {
            $subQuery->where('salary', $filters['salary']);
        });

        return $query->get();
    }


    public function getEmployeesCountWithDate()
    {
        $query =  Employee::query();
        $query->selectRaw('DATE(created_at) as date ,count(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $query->pluck('date')->toArray(),
            'data' => $query->pluck('total')->toArray()
        ];
    }

    public function getEmployeesLocation()
    {
        $employees = $this->getAll();
        $result = $employees->map(function ($employee) {
            return [
                'name' => $employee->location->name,
                'latitude' => $employee->location->latitude,
                'longitude' => $employee->location->longitude
            ];
        })->unique();
        return $result;
    }
}
