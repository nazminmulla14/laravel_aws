@extends('layout')

@section('content')
    <h2>Student Details</h2>
    <p><strong>Name:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Phone:</strong> {{ $student->phone }}</p>
    <p><strong>Position:</strong> {{ $student->position }}</p>
    @if($student->profile)
        <p><strong>Profile:</strong></p>
        <img src="{{ $student->profile }}" width="100">
    @endif
    <br>
    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
