@extends('admin.admin')
@section('content')

<h2>Hello {{ Auth::user()->name }}, Welcome to <b>Admin Dashboard</b></h2>

@endsection