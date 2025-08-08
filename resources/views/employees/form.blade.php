<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label>Position</label>
    <input type="text" name="position" value="{{ old('position', $employee->position ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label>Profile Picture</label>
    <input type="file" name="profile" class="form-control">
    @if(!empty($employee->profile))
        <img src="{{ $employee->profile }}" width="50" class="mt-2">
    @endif
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
