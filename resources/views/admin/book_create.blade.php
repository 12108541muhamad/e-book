@extends('admin.admin')
@section('content')

<h2 class="mb-4 mt-4">Create Book</h2>  
<form method="POST" action="{{ route('bookCreate.post') }}" enctype="multipart/form-data">
    @csrf
    {{-- Alert --}}
    @if (Session::has('createBook'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('createBook') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    {{-- End alert --}}
    {{-- Form input --}}
    <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input name="title" type="text" class="form-control" id="exampleFormControlInput1" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Writer</label>
        <input name="writer" type="text" class="form-control" id="exampleFormControlInput2" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Publisher</label>
        <input name="publisher" type="text" class="form-control" id="exampleFormControlInput2" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">ISBN</label>
        <input name="isbn" type="number" class="form-control" id="exampleFormControlInput2" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Synopsis</label>
        <textarea name="synopsis" class="form-control" id="exampleFormControlInput2" required></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Category</label>
        <select name="category" id="">
            @foreach ($categories as $category)
            <option value="{{ $category->category }}">{{ $category->category }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group file-upload-wrapper mb-3">
        <label for="input-file-now-custom-2">Cover</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-image"></i></span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" style="cursor: pointer;" id="input-file-now-custom-2" name="cover">
                <label class="custom-file-label" for="input-file-now-custom-2"></label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-dark" type="submit">Create</button>
    </div>
    {{-- End form input --}}
</form>

@endsection
