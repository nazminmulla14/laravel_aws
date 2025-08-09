@extends('layout')

@section('content')
<h2>Edit student</h2>
<form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('Students.form')
    <button class="btn btn-success">Update</button>
</form>
@endsection
