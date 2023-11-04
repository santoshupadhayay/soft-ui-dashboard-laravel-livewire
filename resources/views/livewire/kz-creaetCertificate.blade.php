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
                            <h5>Create Certificate</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <video id="cameraFeed" autoplay style="width: 100%;"></video>
                                    <canvas id="capturedImage" style="display: none"></canvas>
                                    <img id="capturedImageDisplay" alt="Captured Image" style="display: none">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <form action="{{ route('uploadCertificateImage') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="image_data" id="imageData">
                                        <button class="btn btn-primary active mb-0 text-white" style="float: right; margin-left:10px;" role="button" aria-pressed="true" type="submit">Upload</button>
                                    </form>

                                    <a
                                    class="btn btn-primary active mb-0 ml-1 text-white" style="float: right; display:none; margin-left:10px;" id="openCamera"  role="button" aria-pressed="true">
                                    Open Camera
                                    </a>

                                    <a
                                    class="btn btn-primary active mb-0 ml-1 text-white" style="float: right; margin-left:10px;" id="takePicture"  role="button" aria-pressed="true">
                                    Take Picture
                                    </a>

                                    <a
                                    class="btn btn-primary active mb-0 ml-1 text-white" style="float: right; margin-left:10px;display:none;" id="reTakePicture"  role="button" aria-pressed="true">
                                    Retake Picture
                                    </a>

                                    
                                    
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
        const openCameraButton = $('#openCamera');
        const cameraFeed = document.getElementById('cameraFeed');
        const capturedImage = document.getElementById('capturedImage');
        const capturedImageDisplay = document.getElementById('capturedImageDisplay');
        const imageDataInput = document.getElementById('imageData');


        $('#takePicture').click(function(){
            $(this).hide();
            captureImage();
            $(cameraFeed).hide();
            $('#reTakePicture').show();
        });
        $('#reTakePicture').click(function(){
            $('#reTakePicture').hide();
            $('#takePicture').show();
            capturedImageDisplay.style.display = 'none';
            $(cameraFeed).show();
            openCameraButton.trigger('click');
            
        });;

        openCameraButton.on('click', () => {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    cameraFeed.srcObject = stream;
                })
                .catch(error => {
                    console.error('Error accessing camera:', error);
                });
        });

        openCameraButton.trigger('click');

        function captureImage() {
            const context = capturedImage.getContext('2d');
            capturedImage.width = 400;
            capturedImage.height = 400;
            context.drawImage(cameraFeed, 0, 0, capturedImage.width, capturedImage.height);
            const imageData = capturedImage.toDataURL('image/png');
            capturedImageDisplay.src = imageData;
            imageDataInput.value = imageData; // Set the captured image data in the hidden input field
            capturedImageDisplay.style.display = 'block';
        }
    });
</script>


@endsection
