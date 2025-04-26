<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function create($data)
    {
        Employee::create($data);
    }
}
