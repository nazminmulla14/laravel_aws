@extends('layout')

@section('content')
<h2>Add Employee</h2>
<form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('employees.form')
    <button class="btn btn-success">Save</button>
</form>
@endsection
