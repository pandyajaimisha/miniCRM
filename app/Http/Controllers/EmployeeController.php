<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\DataTables\EmployeeDataTable;
use App\Models\Company;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeeDataTable $dataTable)
    {
        $companies = Company::all();
        return $dataTable->render('employees.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create(array_merge($request->only('first_name', 'last_name', 'email', 'phone'), [
            'company_id' => $request->input('company')
        ]));

        return redirect()->route('employees.index')->with(['status' => 'Employee ' . $employee->first_name . ' ' . $employee->last_name . ' added successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update(array_merge($request->only('first_name', 'last_name', 'email', 'phone'), [
            'company_id' => $request->input('company')
        ]));
        
        return redirect()->route('employees.index')->with(['status' => 'Employee ' . $employee->first_name . ' ' . $employee->last_name . ' updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with(['status' => 'Employee ' . $employee->first_name . ' ' . $employee->last_name . ' deleted successfully!']);
    }
}
