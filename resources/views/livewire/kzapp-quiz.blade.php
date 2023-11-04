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
                            <h5>Quiz :  {{ $quiz->name }} </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12"  style="height: 387px; overflow-y:scroll;">
                                    @php $index = 0; @endphp 
                                    @foreach ($questions as $question)
                                        <div class="card card-plain mt-1 questBlock" >
                                            <div class="card-header pb-0 pt-0 text-left bg-transparent">
                                                <h5>{{ $question->quesion }} </h5>
                                                @if($question->description != null)
                                                    <p style="margin: 0">{{ $question->description }}</p>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach ($question->options as $option)        
                                                        <div class="col-md-3 col-lg-3 col-sm-12">
                                                            <div class="form-check">
                                                                <input  name="option{{ $index }}" type="radio" class="form-check-input optionValue{{ $index }}" value="{{ $option->is_correct  == 1 ? 1 : 0}}" id="option{{ $option->id }}">
                                                                <label class="form-check-label" for="option{{ $option->id }}">{{ $option->option }}</label>
                                                            </div> 
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 resultText" >

                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        @php $index++; @endphp
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a
                                    class="btn btn-primary active mb-0 text-white submitTest" style="float: right" role="button" aria-pressed="true">
                                    Submit
                                    </a>
                                    @if (!empty($hasNextChapter))
                                    <a  href="{{ route('viewChapter', ['id' => $hasNextChapter->id]) }}"
                                    class="btn btn-primary active mb-0 text-white actionBtns" style="float: right;display: none" role="button" style="" aria-pressed="true">
                                    Next
                                    </a>
                                    @else
                                    <a href="{{ route('createCertficate') }}"
                                    class="btn btn-primary active mb-0 text-white actionBtns" style="float: right; display: none" role="button" aria-pressed="true">
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
<script>
    $(document).ready(function(){
        $(".submitTest").click(function(){
            var element = $(".questBlock");
            $.each(element, function(i,v){
                console.log(v);
                if($(v).find(".optionValue"+i+":checked").val() == 1){
                    $(v).find('.resultText').html('<span class="badge badge-sm bg-gradient-success">Correct !!</span>');
                }else{
                    $(v).find('.resultText').html('<span class="badge badge-sm bg-gradient-danger">Incorrect !!</span>');
                };
            });
            $(this).hide();
            $(".actionBtns").show();
        })
    })
</script>




  @endsection
