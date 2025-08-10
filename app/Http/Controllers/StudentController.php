<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
     public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('Students.index', compact('students'));
    }

    public function create()
    {
        return view('Students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:students',
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

        Student::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'position' => $request->position,
            'profile'  => $profileUrl,
        ]);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('Students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('Students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:students,email,' . $student->id,
            'phone'    => 'required',
            'position' => 'required',
            'profile'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $profileUrl = $student->profile;

        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('profiles', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $profileUrl = Storage::disk('s3')->url($path);
        }

        $student->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'position' => $request->position,
            'profile'  => $profileUrl,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $Student = Student::findOrFail($id);
        $Student->delete();
        return redirect()->route('Students.index')->with('success', 'Student deleted successfully.');
    }
}
