@extends('layout')

@section('content')
<h2>Add student</h2>
<form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('Students.form')
    <button class="btn btn-success">Save</button>
</form>
@endsection
