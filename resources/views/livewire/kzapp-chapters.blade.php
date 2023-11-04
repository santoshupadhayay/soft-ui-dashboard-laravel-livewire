@extends('layouts.app')
@section('content')
@include('layouts.navbars.guest.login')
<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h5>Chapters</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <ol class="list-group">
                                    @foreach ($chapters as $chapter)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                      {{ $chapter->name }}
                                      <a href="{{ route('viewChapter',['id' => $chapter->id]) }}">
                                        <span class="badge badge-sm bg-gradient-success">Start</span>
                                      </a>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                            style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




  @endsection
