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
                            <h5>Chapter :  {{ $chapter->name }} </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="height: 387px; overflow-y:scroll;">
                                    <video controls="controls" style="width:100%;height:100%;"><source src="{{ asset($chapter->file) }}" ></video>
                                    {{-- <iframe id="pptViewer"  src = "https://view.officeapps.live.com/op/embed.aspx?src=[https://drive.google.com/file/d/1p1Ngcp4O0n22p8Dtod5lObVNAFB4qE7E/preview]" width="100%" height="100%" allowfullscreen webkitallowfullscreen></iframe>                                     --}}
                                    {{-- <iframe src = "/ViewerJS/#{{ asset($chapter->file) }}" width='400' height='300' allowfullscreen webkitallowfullscreen></iframe> --}}
                                    {{-- <iframe id="pptViewer" src = "/ViewerJS/#{{ asset($chapter->file) }}" width='400' height='300' allowfullscreen webkitallowfullscreen></iframe> --}}                      
                                    {{-- <iframe src="https://docs.google.com/presentation/d/11RCM1EMWNzS2Wg0yDEWCebxu-vTCSHCY/view" width="100%" height="100%"></iframe> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!empty($hasQuiz))
                                    <a href="{{ route('appQuiz',['id' => $hasQuiz->id]) }}"
                                    class="btn btn-primary active mb-0 text-white" style="float: right" role="button" aria-pressed="true">
                                    Take Quiz
                                    </a>
                                    @elseif (!empty($hasNextChapter))
                                    <a href="{{ route('addStream') }}"
                                    class="btn btn-primary active mb-0 text-white" style="float: right" role="button" aria-pressed="true">
                                    Next
                                    </a>
                                    @else
                                    <a href="{{ route('createCertficate') }}"
                                    class="btn btn-primary active mb-0 text-white" style="float: right" role="button" aria-pressed="true">
                                    Get Certificate
                                    </a>
                                    @endif
                                </div>
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
{{-- <script src="{{ asset('assets/dist/pspdfkit.js') }}"></script>
<script>
    $(document).ready(function(){
        PSPDFKit.load({
            container: "#pspdfkit",
            document: "{{ asset($chapter->file) }}" // Add the path to your document here.
        })
        .then(function(instance) {
            console.log("PSPDFKit loaded", instance);
        })
        .catch(function(error) {
            console.error(error.message);
        });    
    })
</script> --}}
@endsection
