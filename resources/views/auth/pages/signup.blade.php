@extends('auth.layouts.app')
@section('title')
    Registration
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="col-md-6 mt-4">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Signup</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new user</p>
                <form action="{{ route('register.post') }}" method="post" name="registerform"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}"
                                    placeholder="First name">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            @error('firstname')
                                <span class="code text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}"
                                    placeholder="Last name">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            @error('lastname')
                                <span class="code text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        {{-- <div class="input-group mb-3 col">
                            <input type="file" class="" id="" name="profile_picture">
                        </div> --}}
                        <input type="file" class="" id="" name="profile_picture" accept="image/*">
                        @error('profile_picture')
                            <span class="code text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-group mb-3 col">
                            <input type="date" name="birthday" class="form-control" data-inputmask-alias="datetime"
                                data-inputmask-inputformat="yyyy-mm-dd" data-mask placeholder="Date of Birth"
                                value="{{ old('birthday') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="far fa-calendar-alt"></span>
                                </div>
                            </div>
                        </div>
                        @error('birthday')
                            <span class="code text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <div class="input-group mb-3 col">
                            <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number"
                                class="form-control" data-inputmask='"mask": "9999999999"'
                                data-inputmask-mask="(6000000000)|(9999999999)" data-inputmask-clearincomplete="true"
                                data-mask value="{{ old('phone_number') }}">
                            {{-- <input type="number" class="form-control" name="phone_number" min="6000000000" max="9999999999" value="{{ old('phone_number') }}" placeholder="Phone Number"> --}}
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-solid fa-mobile"></span>
                                </div>
                            </div>
                        </div>
                        @error('phone_number')
                            <span class="code text-danger">{{ $message }}</span>
                        @enderror
                        <div class="input-group mb-3 col">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <span class="code text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <div class="col">
                            <div class="input-group mb-3">
                                <select class="form-control select2bs4 getPopulate" name="state" data-message="City"
                                    data-location="setCities">
                                    <option value="" data-populate="">State</option>
                                    {{ getState('') }}
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-map-marker-alt"></span>
                                    </div>
                                </div>
                            </div>
                            @error('state')
                                <span class="code text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <select class="form-control select2bs4 setCities" name="city">
                                    <option value="">City</option>
                                    {{ getCity('') }}
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-map-marker-alt"></span>
                                    </div>
                                </div>
                            </div>
                            @error('city')
                                <span class="code text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="input-group mb-3 col">
                            <input type="password" class="form-control passwordField" name="password"
                                value="{{ old('password') }}" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="javascript:void(0)" class="passwordHideShow">
                                        <svg class="passwordHidden" width="20px" height="14px" viewBox="0 0 20 14"
                                            version="1.1">
                                            <g id="show-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g id="show-password" fill="gray" fill-rule="nonzero">
                                                    <path
                                                        d="M9.952,0 C5.55581964,0.00248628109 1.60850854,2.69365447 0,6.785 C1.60695767,10.8762575 5.5544681,13.5668547 9.95,13.5668547 C14.3455319,13.5668547 18.2930423,10.8762575 19.9,6.785 C18.2920266,2.69501195 14.34672,0.00412882876 9.952,0 Z M9.952,11.309 C7.45401608,11.309 5.429,9.28398392 5.429,6.786 C5.429,4.28801608 7.45401608,2.263 9.952,2.263 C12.4499839,2.263 14.475,4.28801608 14.475,6.786 C14.4738964,9.28352664 12.4495266,11.3078964 9.952,11.309 L9.952,11.309 Z M9.952,4.07099704 C8.45309919,4.07099704 7.238,5.28609919 7.238,6.785 C7.238,8.28390081 8.45309919,9.499 9.952,9.499 C11.4509008,9.499 12.666003,8.28390081 12.666003,6.785 C12.6670637,6.06487688 12.3814668,5.37394216 11.8722623,4.86473767 C11.3630578,4.35553317 10.6721231,4.0699363 9.952,4.07099704 L9.952,4.07099704 Z"
                                                        id="Icon_material-remove-red-eye"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <svg class="passwordShowed d-none" width="18px" height="16px"
                                            viewBox="0 0 18 16" version="1.1">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g id="hide-password" fill="#9B9B9B" fill-rule="nonzero">
                                                    <path
                                                        d="M8.866,3.2 C11.08314,3.19280434 12.8870792,4.98287049 12.897,7.2 C12.8971449,7.70218532 12.7989648,8.19954059 12.608,8.664 L14.962,10.998 C16.1886907,9.98413194 17.1397143,8.67711934 17.727,7.198 C15.8188493,2.43238406 10.4837828,0.0287989846 5.65,1.757 L7.39,3.485 C7.85947076,3.29724472 8.36037705,3.20052501 8.866,3.2 Z M0.807,1.017 L2.65,2.841 L3.022,3.209 C1.6728609,4.24213925 0.628587991,5.62125678 0,7.2 C1.96162887,12.0841703 7.50193433,14.4643338 12.395,12.525 L12.735,12.861 L15.097,15.195 L16.122,14.178 L1.828,0 L0.807,1.017 Z M5.262,5.436 L6.512,6.674 C6.4711228,6.84366455 6.44998266,7.01748341 6.449,7.192 C6.44898396,7.83147599 6.70417265,8.44451588 7.15794345,8.89509507 C7.61171425,9.34567427 8.22654005,9.59652962 8.866,9.592 C9.04185064,9.59125421 9.21702126,9.57011292 9.388,9.529 L10.638,10.767 C9.39692134,11.3861097 7.92403616,11.3199507 6.74346168,10.5920655 C5.5628872,9.86418028 4.84225588,8.57792282 4.838,7.191 C4.84201959,6.5811201 4.98713971,5.98044602 5.262,5.436 Z M8.736,4.815 L11.276,7.335 L11.292,7.208 C11.292,6.56852401 11.0368273,5.95548412 10.5830565,5.50490493 C10.1292858,5.05432573 9.51445995,4.80347038 8.875,4.808 L8.736,4.815 Z"
                                                        id="Icon_ionic-md-eye-off"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <span class="code text-danger">{{ $message }}</span>
                        @enderror
                        <div class="input-group mb-3 col">
                            <input type="password" class="form-control passwordField" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="javascript:void(0)" class="passwordHideShow">
                                        <svg class="passwordHidden" width="20px" height="14px" viewBox="0 0 20 14"
                                            version="1.1">
                                            <g id="show-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g id="show-password" fill="gray" fill-rule="nonzero">
                                                    <path
                                                        d="M9.952,0 C5.55581964,0.00248628109 1.60850854,2.69365447 0,6.785 C1.60695767,10.8762575 5.5544681,13.5668547 9.95,13.5668547 C14.3455319,13.5668547 18.2930423,10.8762575 19.9,6.785 C18.2920266,2.69501195 14.34672,0.00412882876 9.952,0 Z M9.952,11.309 C7.45401608,11.309 5.429,9.28398392 5.429,6.786 C5.429,4.28801608 7.45401608,2.263 9.952,2.263 C12.4499839,2.263 14.475,4.28801608 14.475,6.786 C14.4738964,9.28352664 12.4495266,11.3078964 9.952,11.309 L9.952,11.309 Z M9.952,4.07099704 C8.45309919,4.07099704 7.238,5.28609919 7.238,6.785 C7.238,8.28390081 8.45309919,9.499 9.952,9.499 C11.4509008,9.499 12.666003,8.28390081 12.666003,6.785 C12.6670637,6.06487688 12.3814668,5.37394216 11.8722623,4.86473767 C11.3630578,4.35553317 10.6721231,4.0699363 9.952,4.07099704 L9.952,4.07099704 Z"
                                                        id="Icon_material-remove-red-eye"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <svg class="passwordShowed d-none" width="18px" height="16px"
                                            viewBox="0 0 18 16" version="1.1">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g id="hide-password" fill="#9B9B9B" fill-rule="nonzero">
                                                    <path
                                                        d="M8.866,3.2 C11.08314,3.19280434 12.8870792,4.98287049 12.897,7.2 C12.8971449,7.70218532 12.7989648,8.19954059 12.608,8.664 L14.962,10.998 C16.1886907,9.98413194 17.1397143,8.67711934 17.727,7.198 C15.8188493,2.43238406 10.4837828,0.0287989846 5.65,1.757 L7.39,3.485 C7.85947076,3.29724472 8.36037705,3.20052501 8.866,3.2 Z M0.807,1.017 L2.65,2.841 L3.022,3.209 C1.6728609,4.24213925 0.628587991,5.62125678 0,7.2 C1.96162887,12.0841703 7.50193433,14.4643338 12.395,12.525 L12.735,12.861 L15.097,15.195 L16.122,14.178 L1.828,0 L0.807,1.017 Z M5.262,5.436 L6.512,6.674 C6.4711228,6.84366455 6.44998266,7.01748341 6.449,7.192 C6.44898396,7.83147599 6.70417265,8.44451588 7.15794345,8.89509507 C7.61171425,9.34567427 8.22654005,9.59652962 8.866,9.592 C9.04185064,9.59125421 9.21702126,9.57011292 9.388,9.529 L10.638,10.767 C9.39692134,11.3861097 7.92403616,11.3199507 6.74346168,10.5920655 C5.5628872,9.86418028 4.84225588,8.57792282 4.838,7.191 C4.84201959,6.5811201 4.98713971,5.98044602 5.262,5.436 Z M8.736,4.815 L11.276,7.335 L11.292,7.208 C11.292,6.56852401 11.0368273,5.95548412 10.5830565,5.50490493 C10.1292858,5.05432573 9.51445995,4.80347038 8.875,4.808 L8.736,4.815 Z"
                                                        id="Icon_ionic-md-eye-off"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <span class="code text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="agreeTerms">
                                <label class="custom-control-label" for="agreeTerms">I agree to the <a
                                        href="#">terms</a>.</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <input type="submit" class="btn btn-primary btn-block registersubmit" value="Register">
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="">I already have an Account</a>
                </div>

            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endpush
