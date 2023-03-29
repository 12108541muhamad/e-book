    @extends('layout')
    @section('content')
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" id="category-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('library') }}">All</a></li>
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item" href="{{ route('library.category', strtolower($category->category)) }}">{{ $category->category }}</a></li>
                            @endforeach
                        </ul>
                    </li>                    
                </ul>                
                <form action="{{ route('search') }}" method="GET" class="d-flex">
                    <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>                
            </div>
        </div>
    </nav>

    <section class="page-section bg-light" id="top">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Library</h2>
                <h3 class="section-subheading text-muted">Halo <b>{{ Auth::user()->name }}</b>, Pilihlah buku yang ingin dibaca</h3>
            </div>
            <div class="row row-cols-5">
                @foreach ($books as $book)
                <div class="col mb-4">
                    <div class="top-item d-flex flex-column" style="max-width: 200px;">
                        <a class="top-link flex-grow-1" data-bs-toggle="modal" href="#libraryModal{{ $book->id }}">
                            <div class="top-hover flex-grow-1 d-flex align-items-center justify-content-center">
                                <div class="top-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid flex-grow-1" src="{{ asset('storage/assets/img/cover/'. $book->cover) }}" alt="..." />
                        </a>
                        <div class="top-caption">
                            <div class="top-caption-heading">{{ $book->title }}</div>
                            <div class="top-caption-subheading text-muted">{{ $book->writer }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    @foreach ($books as $book)
    <div class="top-modal modal fade" id="libraryModal{{ $book->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Book details-->
                                <h2 class="text-uppercase">{{ $book->title }}</h2>
                                <p class="text-muted">Publisher by {{ $book->publisher }}</p>
                                <img class="img-fluid d-block mx-auto" src="{{ asset('storage/assets/img/cover/'. $book->cover) }}" alt="..." />
                                <p class="text-muted">Synopsis:</p>
                                <p>{{ $book->synopsis }}</p>
                                <ul class="list-inline">
                                    <li>
                                        <a class="btn btn-primary mb-2">View Book</a>
                                    </li>
                                </ul>
                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                    <i class="fas fa-xmark me-1"></i>
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach    
    @endsection
