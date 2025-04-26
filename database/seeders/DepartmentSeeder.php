<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentData = ['Marketing', 'Sales', 'IT', 'Account'];

        $departments = array_map(function ($department) {
            return [
                'name' => $department,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $departmentData);

        Department::insert($departments);
    }
}
