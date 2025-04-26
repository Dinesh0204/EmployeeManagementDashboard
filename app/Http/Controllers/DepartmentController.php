<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentCreateRequest;
use App\Repositories\DepartmentRepository;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function __construct(public DepartmentService $departmentService, public DepartmentRepository $departmentRepository) {}
    public function index()
    {
        $departments = $this->departmentRepository->getAll();
        return view('department.index', ['departments' => $departments]);
    }


    public function create()
    {
        return view('department.create');
    }

    public function store(DepartmentCreateRequest $departmentCreateRequest)
    {
        $validatedDepartment = $departmentCreateRequest->validated();
        $this->departmentService->create($validatedDepartment);
        return redirect()->route('department.index');
    }
}
