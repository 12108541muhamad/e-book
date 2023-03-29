@extends('admin.admin')
@section('content')

{{-- Alert --}}
@if (Session::has('userUpdate'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('userUpdate') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (Session::has('destroySuccess'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('destroySuccess') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
{{-- End alert --}}
<h2 class="mb-4 mt-4">Users</h2>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Region</th>
            <th scope="col">Phone</th>
            <th scope="col">Role</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)

        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->region }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->created_at->format('Y/m/d') }}</td>
            <td>{{ $user->updated_at->format('Y/m/d') }}</td>
            <td>
                <a class="text-dark" href="{{ route('editUser', $user['id']) }}"><i class="fa fa-edit"></i></a>
                <a class="text-dark" data-bs-toggle="modal" href="#topModalDelete"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<center>
    <div class="top-modal modal fade" id="topModalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Yakin ingin menghapus data ini?</h2>
                                <form action="{{ route('delete', ['id' => $user['id']]) }}" method="post"
                                    id="deleteForm">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-dark btn-xl text-uppercase" data-bs-dismiss="modal"
                                        type="submit">
                                        Ya
                                    </button>
                                    <button class="btn btn-dark btn-xl text-uppercase" data-bs-dismiss="modal"
                                        type="button">
                                        Tidak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>

@endsection
