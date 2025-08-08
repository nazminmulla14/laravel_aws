<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:employees',
            'phone'    => 'required',
            'position' => 'required',
            'profile'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $profileUrl = null;
        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('profiles', 's3');
            // dd($path);
            Storage::disk('s3')->setVisibility($path, 'public');
            $profileUrl = Storage::disk('s3')->url($path);
        }

        Employee::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'position' => $request->position,
            'profile'  => $profileUrl,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:employees,email,' . $employee->id,
            'phone'    => 'required',
            'position' => 'required',
            'profile'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $profileUrl = $employee->profile;

        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('profiles', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $profileUrl = Storage::disk('s3')->url($path);
        }

        $employee->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'position' => $request->position,
            'profile'  => $profileUrl,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
