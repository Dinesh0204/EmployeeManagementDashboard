<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function create($data)
    {
        Department::create($data);
    }
}
