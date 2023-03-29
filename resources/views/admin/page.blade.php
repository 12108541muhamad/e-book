@extends('layout')
@section('content')

<section class="page-section bg-light" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6 mb-4">
                <!-- top item 1-->
                <div class="top-item">
                    <a class="top-link" href="/admin">
                        <img class="img-fluid hover-filter" src="assets/img/top/1.jpg" alt="..." />
                    </a>
                    <div class="top-caption">
                        <div class="top-caption-heading">Admin</div>
                        <div class="top-caption-subheading text-muted">Admin Only</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <!-- top item 2-->
                <div class="top-item">
                    <a class="top-link" href="/library">
                        <img class="img-fluid hover-filter" src="assets/img/top/1.jpg"/>
                    </a>
                    <div class="top-caption">
                        <div class="top-caption-heading">Library</div>
                        <div class="top-caption-subheading text-muted">Admin & User</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <!-- top item 3-->
                <div class="top-item">
                    <a class="top-link" href="/">
                        <img class="img-fluid hover-filter" src="assets/img/top/1.jpg"/>
                    </a>
                    <div class="top-caption">
                        <div class="top-caption-heading">Home</div>
                        <div class="top-caption-subheading text-muted">Admin, User, Guest</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection