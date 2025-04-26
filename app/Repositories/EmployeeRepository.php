<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getAll()
    {
        return Employee::all();
    }
}
