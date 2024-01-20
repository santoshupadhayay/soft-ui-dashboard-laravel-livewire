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
                                <div class="col-md-12"  style="height: 300px; overflow:hidden;">
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
                                                        <div class="col-md-12 col-lg-12 col-sm-12">
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
                                    class="btn btn-primary active mb-0 text-white nextQuestion" style="float: right" role="button" aria-pressed="true">
                                    Next
                                    </a>
                                    <a
                                    class="btn btn-primary active mb-0 text-white submitQuestion" style="float: right" role="button" aria-pressed="true">
                                    Submit
                                    </a>
                                    @if (!empty($hasNextChapter))
                                    <a  href="{{ route('viewChapter', ['id' => $hasNextChapter->id]) }}"
                                    class="btn btn-primary active mb-0 text-white actionBtns" style="float: right;display: none" role="button" style="" aria-pressed="true">
                                    Next
                                    </a>
                                    @else
                                    <a href="{{ route('printCertificate') }}"
                                    class="btn btn-primary active mb-0 text-white actionBtns certificateBtn" style="float: right; display: none" role="button" aria-pressed="true">
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
<style>
    .questBlock{
        display: none;
    }
</style>
<script>
    $(document).ready(function(){

        var quizCouter = 0
        var totalQuiz = $(".questBlock").length;
        $(".submitQuestion").click(function(){
            var element = $(".questBlock").eq(quizCouter);
            for (var i = 0; i < element.find(".optionValue"+quizCouter).length; i++) {
                console.log(element.find(".optionValue"+quizCouter));
                if (element.find(".optionValue"+quizCouter)[i].value == '1') {
                    var CorrectOption = $(element.find(".optionValue"+quizCouter)[i]).next('label').text();
                    break; // Once found, exit the loop
                }
            }
            if(element.find(".optionValue"+quizCouter+":checked").val() == 1){
                element.find('.resultText').html('<span class="badge badge-sm bg-gradient-success">Correct Answer !!</span>');
            }else{
                element.find('.resultText').html('<span class="badge badge-sm bg-gradient-danger">Oops Incorrect Answer !!</span><br><br><b>The correct answer is '+CorrectOption+'</b>');
            };
            $(".submitQuestion").hide();
            if(quizCouter <= totalQuiz-1){
                console.log(quizCouter , totalQuiz-1);
                $(".nextQuestion").show();    
            }
            if(quizCouter == totalQuiz-1){
                $(".submitQuestion").hide();
                $(".nextQuestion").hide();
                $(".certificateBtn").show();
            }
        })
        $(".nextQuestion").click(function(){
            $(".submitQuestion").show();
            $(".nextQuestion").hide();
            $(".questBlock").hide();
            quizCouter++;
            if(quizCouter < (".questBlock").length){
                $(".questBlock").eq(quizCouter).show();
            }else{
                $(".submitQuestion").hide();
                $(".nextQuestion").hide();
                $(".certificateBtn").show();
            }
        })

        
        $(".nextQuestion").hide()
        $(".questBlock").hide().eq(0).show();
    })
</script>




  @endsection
