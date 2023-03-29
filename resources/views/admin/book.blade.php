@extends('admin.admin')
@section('content')

{{-- Alert --}}
@if (Session::has('bookUpdate'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('bookUpdate') }}
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
<h2 class="mb-4 mt-4">Books</h2>

<a class="top-link btn bg-dark text-white mb-4" href="/admin/bookCreate">Create New</a>
<div style="overflow-x: auto">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Writter</th>
                <th scope="col">Publisher</th>
                <th scope="col">ISBN</th>
                <th scope="col">Synopsis</th>
                <th scope="col">Category</th>
                <th scope="col">Cover</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
    
            <tr>
                <td scope="col">{{ $book->id }}</td>
                <td scope="col">{{ $book->title }}</td>
                <td scope="col">{{ $book->writter }}</td>
                <td scope="col">{{ $book->publisher }}</td>
                <td scope="col">{{ $book->isbn }}</td>
                <td scope="col">{{ substr($book->synopsis, 0, 45) . '...' }}</td>
                <td scope="col">{{ $book->category }}</td>
                <td scope="col"><img src="{{ asset('storage/assets/img/cover/'. $book->cover) }}" style="width: 150%; position:relative;" alt="image"></td>
                <td scope="col">{{ $book->created_at->format('Y/m/d') }}</td>
                <td scope="col">{{ $book->updated_at->format('Y/m/d') }}</td>
                <td>
                    <a class="text-dark" href="{{ route('editUser', $book['id']) }}"><i class="fa fa-edit"></i></a>
                    <a class="text-dark" data-bs-toggle="modal" href="{{ '#topModalDelete', $book['id'] }}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<center>
    <div class="top-modal modal fade" id="topModalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Yakin ingin menghapus data ini?</h2>
                                <form action="{{ route('deleteBook', ['id' => $book['id']]) }}" method="post"
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
