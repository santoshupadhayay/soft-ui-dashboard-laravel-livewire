@section('content')
@include('layouts.navbars.guest.login')
<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h5>Start Your Education Journey</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('register') }}" action="#" method="POST" role="form text-left">
                                {{ csrf_field() }}
                                <div class="mb-3">
                                    <label for="Name">{{ __('Name') }}</label>
                                    <div class="@error('name')border border-danger rounded-3 @enderror">
                                        <input name="name" id="name" type="text" class="form-control"
                                            placeholder="Name" aria-label="Name" aria-describedby="email-addon" required>
                                    </div>
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="age">{{ __('Age') }}</label>
                                    <div class="@error('age')border border-danger rounded-3 @enderror">
                                        <input name="age" id="age" type="number" class="form-control"
                                            placeholder="Age" aria-label="Age"
                                            aria-describedby="password-addon" required>
                                    </div>
                                    @error('age') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="phone">{{ __('Phone') }}</label>
                                    <div class="@error('phone')border border-danger rounded-3 @enderror">
                                        <input wire:model="phone" id="phone" type="number" class="form-control"
                                            placeholder="phone" aria-label="phone"
                                            aria-describedby="password-addon" >
                                    </div>
                                    @error('age') <div class="text-danger">{{ $message }}</div> @enderror
                                </div> --}}
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn bg-gradient-info w-100 mt-4 mb-0 logBtn" >{{ __('Start') }}</button>
                                </div>
                            </form>
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
