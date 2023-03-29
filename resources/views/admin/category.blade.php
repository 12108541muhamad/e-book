@extends('admin.admin')
@section('content')

{{-- Alert --}}
@if (Session::has('createCategory'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('createCategory') }}
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
<h2 class="mb-4 mt-4">Categories Books</h2>

<a class="top-link btn bg-dark text-white mb-4" data-bs-toggle="modal" href="#categoryModal1">Create New</a>
<div style="overflow-x: auto">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
    
            <tr>
                <td scope="col">{{ $category->id }}</td>
                <td scope="col">{{ $category->category }}</td>
                <td scope="col">{{ $category->created_at->format('Y/m/d') }}</td>
                <td scope="col">{{ $category->updated_at->format('Y/m/d') }}</td>
                <td>
                    <a class="text-dark" href="{{ route('editUser', $category['id']) }}"><i class="fa fa-edit"></i></a>
                    <a class="text-dark" data-bs-toggle="modal" href="#topModalDelete"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- categories item 1 modal popup-->
<center>
    <div class="top-modal modal fade" id="categoryModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Top details-->
                                <h2 class="text-uppercase">Create Category</h2>
                                <form action="{{ route('categoryCreate') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Category</label>
                                        <input name="category" type="text" class="form-control" id="exampleFormControlInput2" required>
                                    </div>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="submit">
                                        Create
                                    </button>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        Cancel
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


{{-- delete --}}
<center>
    <div class="top-modal modal fade" id="topModalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Yakin ingin menghapus data ini?</h2>
                                <form action="{{ route('deleteCategory', ['id' => $category['id']]) }}" method="post"
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
