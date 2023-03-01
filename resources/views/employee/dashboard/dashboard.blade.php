@extends('auth.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/dashboard.css') }}">
@endpush
@section('content')
    <div class="row mt-5">

        <div class="container">
            <div class="row">
                {{-- <div class="col-md-4"></div> --}}
                <div class="card text-center col-md-8 mt-3 col-sm-10 p-0">
                    <div class="card-header p-0">
                        <img src="https://i.pinimg.com/originals/fc/68/f8/fc68f86873c9c661e84ad442cf8fb6cf.gif"
                            alt="" class="w-100">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Welcome to <span class="text-primary">{{ Auth::user()->full_name }}</span>
                        </h5>

                    </div>
                    <a href="{{ route('profile.show') }}">
                        <div class="card-footer text-muted bg bg-danger">
                            GO TO YOUR PROFILE
                        </div>
                    </a>
                </div>

            </div>
        </div>


        <!-- /.row -->
    @endsection
    @push('scripts')
        <script src="//cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
        <script src="{{ asset('assets/js/user.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/profile.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/ajax.js') }}" defer></script>
    @endpush
