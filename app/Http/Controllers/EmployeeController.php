<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeCreateRequest;
use App\Repositories\DepartmentRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\LocationRepository;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        public EmployeeRepository $employeeRepsitory,
        public DepartmentRepository $departmentRepository,
        public LocationRepository $locationRepository,
        public EmployeeService $employeeService
    ) {}

    public function index()
    {

        $employees = $this->employeeRepsitory->getAll();
        return view('employee.index', ['employees' => $employees]);
    }

    public function create()
    {
        $departments = $this->departmentRepository->getAll();
        $locations = $this->locationRepository->getAll();
        return view('employee.create', ['departments' => $departments, 'locations' => $locations]);
    }

    public function store(EmployeeCreateRequest $employeeCreateRequest)
    {
        $validatedEmployee = $employeeCreateRequest->validated();
        $this->employeeService->create($validatedEmployee);
        return redirect()->route('employee.index');
    }
}
