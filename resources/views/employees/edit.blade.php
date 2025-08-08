@extends('layout')

@section('content')
<h2>Edit Employee</h2>
<form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('employees.form')
    <button class="btn btn-success">Update</button>
</form>
@endsection
