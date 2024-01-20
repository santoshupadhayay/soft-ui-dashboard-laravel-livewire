@extends('layouts.app')
@section('content')
<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-2">
                        <div class="row" style="background-image:url('../assets/img/cert-top.png'); height:22px;">
                        </div>
                        <div class="card-header pb-0 text-center bg-transparent">
                            <img src="../assets/img/kzlogo.png" class="navbar-brand-img" style="width: 10%" alt="...">
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-12 text-uppercase"> 
                                    <h1 style="color: darkgoldenrod;">Certificate</h1>
                                </div>
                                <div class="col-md-12 text-uppercase"> 
                                    This is to certify that.
                                </div>
                                <div class="col-md-12 text-uppercase" style="margin: 10px 0"> 
                                    <h2>{{ $reg->name }}</h2>
                                </div>
                                <div class="col-md-12 text-uppercase"> 
                                    has successfully completed the assessment of the knowledge <br>acquired in course title
                                </div>
                                <div class="col-md-12 text-uppercase" style="margin: 10px 0"> 
                                    <h2>{{ $reg->stream }}</h2>
                                </div>
                                <div class="col-md-12 text-uppercase"> 
                                    and has demonstrated outstanding proficiency and dedication
                                </div>
                                <div class="col-md-12 text-uppercase"> 
                                    In recognition of your hard work and commitment to the continious learning,<br>
                                    We are proud to process the issuance of this certificate.
                                </div>
                                <div class="col-md-12 text-uppercase"> 
                                    <div class="row" style="margin: 10px 0">
                                        <div class="col-md-6" style="padding: 32px 0">
                                            {{ date("d M Y") }}
                                            <br>
                                            <b>Date Of Completion</b>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="../assets/img/kzlogo.png" class="navbar-brand-img" style="width: 10%" alt="...">
                                            <br>
                                            <b>Authorized Institution</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="background-image:url('../assets/img/cert-top.png'); height:22px;">
                        </div>
                        <div class="row" style="text-align: center;margin: 10px;">
                            <div class="col-md-12">
                                <a 
                                class="btn btn-primary active mb-0 text-white printPage" role="button" aria-pressed="true">
                                Print Certificate
                                </a>
                                <a href="{{ route('kzapp') }}"
                                class="btn btn-warning active mb-0 text-white" role="button" aria-pressed="true">
                                Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $(".printPage").click(function(){
            $(this).hide();
            window.print();
        })
    });
</script>


@endsection
