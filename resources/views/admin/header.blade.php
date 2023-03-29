@extends('admin.admin')
@section('content')

@foreach ($headers as $header)
<h2 class="mb-4 mt-4">Custom Header</h2>
<form method="post" action="{{ route('updateHeader', $header->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    {{-- Alert --}}
    @if (Session::has('updateHeader'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('updateHeader') }}
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
        <label for="exampleFormControlInput1">Heading</label>
        <input name="heading" type="text" class="form-control" id="exampleFormControlInput1"
            value="{{ $header->heading }}" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Sub Heading</label>
        <input name="subheading" type="text" class="form-control" id="exampleFormControlInput2"
            value="{{ $header->subheading }}" required>
    </div>
    <div class="form-group file-upload-wrapper mb-3">
        <label for="input-file-now-custom-2">Banner (ukuran maksimal: 3MB)</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-image"></i></span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" style="cursor: pointer;" title="{{ $header->banner }}" id="input-file-now-custom-2" name="banner">
                <label class="custom-file-label" for="input-file-now-custom-2">
                    {{ $header->banner ? $header->banner : 'Choose file' }}
                </label>
            </div>
        </div>
        @if ($header->banner)
        <div class="mt-3" style="height: 300px; width: 1040px; background-image: url({{ asset('storage/assets/img/banner/'. $header->banner) }}); background-size: cover;"></div>
        @endif
    </div>
    <div class="form-group">
        <button class="btn btn-dark" type="submit">Update</button>
    </div>
    {{-- End form input --}}
</form>
@endforeach

@endsection
