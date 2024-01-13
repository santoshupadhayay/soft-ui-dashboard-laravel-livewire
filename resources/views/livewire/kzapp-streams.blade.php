@extends('layouts.app')
@section('content')
@include('layouts.navbars.guest.login')
<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8" style="z-index: 99999999999999999999;">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h5>Streams</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                @foreach ($streams as $stream)
                                      <div class="col-md-6 mb-lg-0 mb-2 mt-2">
                                          <div class="card">
                                              <div class="card-body p-3">
                                              <div class="row">
                                                  <div class="col-lg-6">
                                                      <div class="d-flex flex-column h-100">
                                                          <h5 class="font-weight-bolder">{{ $stream->name }}</h5>
                                                          <p class="mb-5">{!! $stream->description !!}</p>
                                                          <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{ route('loadChapters', ['id' => $stream->id]) }}">
                                                          Start Course
                                                          <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                                          </a>
                                                      </div>
                                                  </div>
                                                  <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                                                      <div class="bg-gradient-warning border-radius-lg h-100">
                                                          <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                                          <div class="position-relative d-flex h-100">
                                                              <img class="w-100 position-relative z-index-2" src="{{ asset($stream->icon) }}">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              </div>
                                          </div>
                                      </div>
                                @endforeach
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
