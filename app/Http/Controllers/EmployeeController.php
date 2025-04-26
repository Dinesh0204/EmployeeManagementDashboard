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
    protected $employees;
    protected $departments;
    protected $locations;

    protected $filters = [
        'department' => '',
        'salary' => ''
    ];

    public function __construct(
        public EmployeeRepository $employeeRepsitory,
        public DepartmentRepository $departmentRepository,
        public LocationRepository $locationRepository,
        public EmployeeService $employeeService
    ) {

        $this->departments = $departmentRepository->getAll();
        $this->employees = $this->employeeRepsitory->getAll();
        $this->locations = $this->locationRepository->getAll();
    }

    public function index()
    {
        return view('employee.index', ['employees' => $this->employees, 'departments' => $this->departments]);
    }

    public function create()
    {
        return view('employee.create', ['departments' => $this->departments, 'locations' => $this->locations]);
    }

    public function store(EmployeeCreateRequest $employeeCreateRequest)
    {
        $validatedEmployee = $employeeCreateRequest->validated();
        $this->employeeService->create($validatedEmployee);
        return redirect()->route('employee.index');
    }

    public function filterEmployees(Request $request)
    {
        $this->filters = [
            'department' => $request->department
        ];

        $employees = $this->employeeRepsitory->getFilteredEmployees($this->filters);

        return response()->json([
            'status' => true,
            'success' => view('employee.ajax_listing', [
                'employees' => $employees
            ])->render()
        ], 200);
    }
}
