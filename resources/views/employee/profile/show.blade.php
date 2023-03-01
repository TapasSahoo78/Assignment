@extends('auth.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="row mt-5">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary">
                <div class="card-header ">
                    <h3 class="card-title col">Profile Picture</h3>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle avatar"
                            src="{{ asset('uploads/' . $showProfile->media->file) }}" alt="{{ $showProfile->fullName }}">
                    </div>

                    <h3 class="profile-username text-center">{{ $showProfile->fullName }}</h3>

                    <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="input-group mb-3 col">
                            <div class="custom-file">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="file" class="custom-file-input file-upload" accept="image/*"
                                    id="validatedCustomFile" name="profile_picture">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-success">Upload</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header d-flex">
                    <h3 class="card-title col">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-at mr-1"></i> Email</strong>
                    <p class="text-muted ml-3">
                        {{ $showProfile->email }}
                    </p>
                    <hr>
                    <strong><i class="fas fa-mobile mr-1"></i> Contact No.</strong>
                    <p class="text-muted ml-3">{{ $showProfile->mobile_number }}</p>
                    <hr>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                        <li class="nav-item"><a class="nav-link" href="#profile" data-toggle="tab">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                        <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            <form class="form-horizontal" name="basicForm" method="POST"
                                action="{{ route('profile.update.user') }}">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <label for="firstname" class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group ">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <input type="text" class="form-control required" name="firstname"
                                                value="{{ $showProfile->firstname }}" placeholder="First name">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('firstname')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group ">
                                            <input type="text" class="form-control required" name="lastname"
                                                value="{{ $showProfile->lastname }}" placeholder="Last name">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('lastname')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alternate_mobile_number" class="col-sm-3 col-form-label">Alternative
                                        Contact</label>
                                    <div class="col-sm-9">
                                        <div class="input-group ">
                                            <input type="text" class="form-control sometimes"
                                                data-inputmask='"mask": "9999999999"'
                                                data-inputmask-mask="(6000000000)|(9999999999)"
                                                data-inputmask-clearincomplete="true" data-mask
                                                name="alternate_phone_number"
                                                value="{{ $showProfile->alternate_mobile_number }}"
                                                placeholder="Alternate Phone Number">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-mobile"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('alternate_phone_number')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="tag" value="userDetails">
                                <div class="col">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="profile">
                            <form class="form-horizontal" name="profileForm" method="POST"
                                action="{{ route('profile.update.profile') }}">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <select class="form-control select2bs4 required"
                                                data-placeholder="Select Gender" name="gender">
                                                <option value="">Gender</option>
                                                <option value="male"
                                                    {{ $showProfile->profile->gender == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female"
                                                    {{ $showProfile->profile->gender == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="transgender"
                                                    {{ $showProfile->profile->gender == 'transgender' ? 'selected' : '' }}>
                                                    Transgender</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-venus"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('gender')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Birthday</label>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <input type="date" name="birthday" class="form-control sometimes"
                                                data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd"
                                                data-mask placeholder="Date of Birth"
                                                value="{{ $showProfile->profile->birthday }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-cake"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('birthday')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="tag" value="profileDetails">
                                <div class="col">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="address">
                            <form class="form-horizontal" name="addressForm"
                                action="{{ route('profile.update.address') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" name="address">
{{ $showProfile->profile->address }}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="state" class="col-sm-2 col-form-label">State</label>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <select class="form-control select2bs4 required getPopulate" name="state"
                                                data-placeholder="Select State" data-message="City"
                                                data-location="setCities">
                                                <option value="" data-populate="">State</option>
                                                {{ getState($showProfile->profile->state) }}
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('state')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <select class="form-control select2bs4 required setCities"
                                                data-placeholder="Select City" name="city"
                                                data-auth="{{ $showProfile->profile->city }}">
                                                {{ getCity($showProfile->profile->city) }}
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('city')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Pincode</label>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <input type="text" name="pin_code" id="pin_code" placeholder="Pincode"
                                                class="form-control required" data-inputmask='"mask": "999999"'
                                                data-inputmask-clearincomplete="true" data-mask
                                                value="{{ old('pin_code', $showProfile->profile->pincode) }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('pin_code')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="tag" value="profileDetails">
                                <div class="col">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="password">
                            <form class="form-horizontal" name="passwordForm"
                                action="{{ route('profile.update.password') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <label for="password" class="col-sm-4 col-form-label">Current Password</label>
                                    <div class="col-sm-8">
                                        <div class="input-group ">
                                            <input type="password" class="form-control required passwordField"
                                                name="password" placeholder="Password" id="password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <a href="javascript:void(0)" class="passwordHideShow">
                                                        <svg class="passwordHidden" width="20px" height="14px"
                                                            viewBox="0 0 20 14" version="1.1">
                                                            <g id="show-1" stroke="none" stroke-width="1"
                                                                fill="none" fill-rule="evenodd">
                                                                <g id="show-password" fill="white" fill-rule="nonzero">
                                                                    <path
                                                                        d="M9.952,0 C5.55581964,0.00248628109 1.60850854,2.69365447 0,6.785 C1.60695767,10.8762575 5.5544681,13.5668547 9.95,13.5668547 C14.3455319,13.5668547 18.2930423,10.8762575 19.9,6.785 C18.2920266,2.69501195 14.34672,0.00412882876 9.952,0 Z M9.952,11.309 C7.45401608,11.309 5.429,9.28398392 5.429,6.786 C5.429,4.28801608 7.45401608,2.263 9.952,2.263 C12.4499839,2.263 14.475,4.28801608 14.475,6.786 C14.4738964,9.28352664 12.4495266,11.3078964 9.952,11.309 L9.952,11.309 Z M9.952,4.07099704 C8.45309919,4.07099704 7.238,5.28609919 7.238,6.785 C7.238,8.28390081 8.45309919,9.499 9.952,9.499 C11.4509008,9.499 12.666003,8.28390081 12.666003,6.785 C12.6670637,6.06487688 12.3814668,5.37394216 11.8722623,4.86473767 C11.3630578,4.35553317 10.6721231,4.0699363 9.952,4.07099704 L9.952,4.07099704 Z"
                                                                        id="Icon_material-remove-red-eye"></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <svg class="passwordShowed d-none" width="18px" height="16px"
                                                            viewBox="0 0 18 16" version="1.1">
                                                            <g id="Page-1" stroke="none" stroke-width="1"
                                                                fill="none" fill-rule="evenodd">
                                                                <g id="hide-password" fill="white" fill-rule="nonzero">
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
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-sm-4 col-form-label">New Password</label>
                                    <div class="col-sm-8">
                                        <div class="input-group ">
                                            <input type="password" class="form-control required passwordField"
                                                name="new_password" placeholder="Password" id="new_password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <a href="javascript:void(0)" class="passwordHideShow">
                                                        <svg class="passwordHidden" width="20px" height="14px"
                                                            viewBox="0 0 20 14" version="1.1">
                                                            <g id="show-1" stroke="none" stroke-width="1"
                                                                fill="none" fill-rule="evenodd">
                                                                <g id="show-password" fill="white" fill-rule="nonzero">
                                                                    <path
                                                                        d="M9.952,0 C5.55581964,0.00248628109 1.60850854,2.69365447 0,6.785 C1.60695767,10.8762575 5.5544681,13.5668547 9.95,13.5668547 C14.3455319,13.5668547 18.2930423,10.8762575 19.9,6.785 C18.2920266,2.69501195 14.34672,0.00412882876 9.952,0 Z M9.952,11.309 C7.45401608,11.309 5.429,9.28398392 5.429,6.786 C5.429,4.28801608 7.45401608,2.263 9.952,2.263 C12.4499839,2.263 14.475,4.28801608 14.475,6.786 C14.4738964,9.28352664 12.4495266,11.3078964 9.952,11.309 L9.952,11.309 Z M9.952,4.07099704 C8.45309919,4.07099704 7.238,5.28609919 7.238,6.785 C7.238,8.28390081 8.45309919,9.499 9.952,9.499 C11.4509008,9.499 12.666003,8.28390081 12.666003,6.785 C12.6670637,6.06487688 12.3814668,5.37394216 11.8722623,4.86473767 C11.3630578,4.35553317 10.6721231,4.0699363 9.952,4.07099704 L9.952,4.07099704 Z"
                                                                        id="Icon_material-remove-red-eye"></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <svg class="passwordShowed d-none" width="18px" height="16px"
                                                            viewBox="0 0 18 16" version="1.1">
                                                            <g id="Page-1" stroke="none" stroke-width="1"
                                                                fill="none" fill-rule="evenodd">
                                                                <g id="hide-password" fill="white" fill-rule="nonzero">
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
                                        @error('new_password')
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                                    <div class="col-sm-8">
                                        <div class="input-group ">
                                            <input type="password" class="form-control required passwordField"
                                                name="confirm_password" placeholder="Password" id="confirm_password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <a href="javascript:void(0)" class="passwordHideShow">
                                                        <svg class="passwordHidden" width="20px" height="14px"
                                                            viewBox="0 0 20 14" version="1.1">
                                                            <g id="show-1" stroke="none" stroke-width="1"
                                                                fill="none" fill-rule="evenodd">
                                                                <g id="show-password" fill="white" fill-rule="nonzero">
                                                                    <path
                                                                        d="M9.952,0 C5.55581964,0.00248628109 1.60850854,2.69365447 0,6.785 C1.60695767,10.8762575 5.5544681,13.5668547 9.95,13.5668547 C14.3455319,13.5668547 18.2930423,10.8762575 19.9,6.785 C18.2920266,2.69501195 14.34672,0.00412882876 9.952,0 Z M9.952,11.309 C7.45401608,11.309 5.429,9.28398392 5.429,6.786 C5.429,4.28801608 7.45401608,2.263 9.952,2.263 C12.4499839,2.263 14.475,4.28801608 14.475,6.786 C14.4738964,9.28352664 12.4495266,11.3078964 9.952,11.309 L9.952,11.309 Z M9.952,4.07099704 C8.45309919,4.07099704 7.238,5.28609919 7.238,6.785 C7.238,8.28390081 8.45309919,9.499 9.952,9.499 C11.4509008,9.499 12.666003,8.28390081 12.666003,6.785 C12.6670637,6.06487688 12.3814668,5.37394216 11.8722623,4.86473767 C11.3630578,4.35553317 10.6721231,4.0699363 9.952,4.07099704 L9.952,4.07099704 Z"
                                                                        id="Icon_material-remove-red-eye"></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <svg class="passwordShowed d-none" width="18px" height="16px"
                                                            viewBox="0 0 18 16" version="1.1">
                                                            <g id="Page-1" stroke="none" stroke-width="1"
                                                                fill="none" fill-rule="evenodd">
                                                                <g id="hide-password" fill="white" fill-rule="nonzero">
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
                                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="hidden" name="tag" value="profileDetails">
                                <div class="col">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block">Update
                                            Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    {{-- @include('admin.modals.crop-modal') --}}
@endsection
@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="{{ asset('assets/js/user.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/profile.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    @include('layouts.partials.flash')
@endpush
