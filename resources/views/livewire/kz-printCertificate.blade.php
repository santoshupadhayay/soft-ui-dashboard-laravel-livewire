@extends('layouts.app')
@section('content')
<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-2">
                        <div class="card-header pb-0 text-center bg-transparent">
                            <img src="../assets/img/kzlogo.jpeg" class="navbar-brand-img w-50 h-50" alt="...">
                        </div>
                        <div class="card-body text-center" style="height: 387px">
                            <div class="row">
                                <div class="col-md-12"> 
                                    This is to certify that.
                                </div>
                                <div class="col-md-12 mt-4 mb-4"> 
                                    <h2>{{ $reg['name'] }}</h2>
                                </div>
                                <div class="col-md-12"> 
                                    has successfully completed the training on the stream
                                </div>
                                <div class="col-md-12 mt-4 mb-4"> 
                                    <h5>{{ $reg['stream'] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                            style="background-image:url('../assets/img/curved-images/curved6.jpg')">
                            <img src="{{ asset('storage/'.$reg['certificate']) }}" style="width: 400px;margin: 14%;border-radius: 8px;border: 10px solid white;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        
    });
</script>


@endsection
