@extends('admin.admin')
@section('content')

<form method="post" action="{{ route('updateUser', $users->id) }}">
    @csrf
    @method('PATCH')

    {{-- Alert --}}
    @if (Session::get('userUpdate'))
    <div class="alert alert-success">
        {{ Session::get('userUpdate')}}
    </div>
    @endif
    {{-- End alert --}}
    
    {{-- Form input --}}
    <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
        <input name="name" type="text" class="form-control" id="exampleFormControlInput1"
            value="{{ $users->name }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Phone</label>
        <input name="phone" type="text" class="form-control" id="exampleFormControlInput1"
            value="{{ $users->phone }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Email</label>
        <input name="email" type="text" class="form-control" id="exampleFormControlInput1"
            value="{{ $users->email }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Password</label>
        <input name="password" type="password" class="form-control" id="exampleFormControlInput1" value="{{ $users->password }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Region</label>
        <input name="region" type="text" class="form-control" id="exampleFormControlInput1"
            value="{{ $users->region }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Roles</label>
        <select name="role" id="">
            <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $users->role == 'user' ? 'selected' : '' }}>User</option>
        </select>        
    </div>
    <div class="form-group">
        <button class="btn btn-dark" type="submit">Update</button>
    </div>
</form>
{{-- End form input --}}

@endsection
