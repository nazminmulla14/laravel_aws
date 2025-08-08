@extends('layout')

@section('content')
    <h2>Employee Details</h2>
    <p><strong>Name:</strong> {{ $employee->name }}</p>
    <p><strong>Email:</strong> {{ $employee->email }}</p>
    <p><strong>Phone:</strong> {{ $employee->phone }}</p>
    <p><strong>Position:</strong> {{ $employee->position }}</p>
    @if($employee->profile)
        <p><strong>Profile:</strong></p>
        <img src="{{ $employee->profile }}" width="100">
    @endif
    <br>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
