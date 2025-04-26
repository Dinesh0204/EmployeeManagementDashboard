<?php

namespace App\Repositories;

use App\Models\Employee;

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
}
