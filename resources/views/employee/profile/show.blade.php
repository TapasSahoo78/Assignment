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
                    <div class="">
                        <a href="{{ route('signout') }}" class="btn btn-secondary ">Logout</a>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    @include('layouts.partials.flash')
@endpush
