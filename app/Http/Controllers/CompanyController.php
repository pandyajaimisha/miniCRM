<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCompanyRequest;
use App\DataTables\CompanyDataTable;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CompanyDataTable $dataTable)
    {
        return $dataTable->render('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCompanyRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('logo')) {
            $imageName = time() .'.'. $request->logo->extension();
            $request->file('logo')->storeAs('public/company-logos', $imageName);
        }
        
        $company = Company::create(array_merge(
            $request->only('name', 'email', 'website_url', 'contact_person'), 
            [
                'logo' => $imageName
            ]
        ));

        return redirect()->route('companies.index')->with(['status' => 'Company ' . $company->name . ' added successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $imageName = null;
        if ($request->hasFile('logo')) {
            $imageName = time() .'.'. $request->logo->extension();
            $request->file('logo')->storeAs('public/company-logos', $imageName);
            if ($company->logo) {
                Storage::delete('public/company-logos/' . $company->logo);
            }
        } else {
            if ($request->filled('remove_logo') && $company->logo) {
                Storage::delete('public/company-logos/' . $company->logo);
            } else {
                $imageName = $company->logo;
            }
        }

        $company->update(array_merge(
            $request->only('name', 'email', 'website_url', 'contact_person'), 
            [
                'logo' => $imageName
            ]
        ));

        return redirect()->route('companies.index')->with(['status' => 'Company ' . $company->name . ' updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $name = $company->name;

        Storage::delete('public/company-logos/' . $company->logo);

        $company->delete();

        return redirect()->route('companies.index')->with(['status' => 'Company ' . $name . ' deleted successfully!']);
    }
}
