@extends('layouts.app', ['showSidebar' => true, 'showContentHeader' => true, 'showFooter' => false])
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush
@section('content')

    <div class="card card-primary">
        <div class="card-header d-flex justify-content-end">
            <p class="h4 col-9 text-capitalize">Edit</p>
            @include('layouts.partials.back-button')
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="#" method="POST" name="userAddform"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <fieldset class="the-fieldset rounded mb-4 personalSection">
                    <legend class="the-legend badge badge-warning text-uppercase mb-2">Personal Details:</legend>
                    <div class="d-flex mb-2">
                        <div class="col">
                            <div class="input-group ">
                                <input type="text" class="form-control required" name="firstname"
                                    value="{{ old('firstname') }}" placeholder="First name">
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
                        <div class="col">
                            <div class="input-group ">
                                <input type="text" class="form-control required" name="lastname"
                                    value="{{ old('lastname') }}" placeholder="Last name">
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
                    <div class="d-flex mb-2">
                        <div class="col">
                            <div class="input-group ">
                                <input type="text" class="form-control required" name="phone_number"
                                    data-inputmask='"mask": "9999999999"' data-inputmask-mask="(6000000000)|(9999999999)"
                                    data-inputmask-clearincomplete="true" data-mask value="{{ old('phone_number') }}"
                                    placeholder="Phone Number">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-mobile"></span>
                                    </div>
                                </div>
                            </div>
                            @error('phone_number')
                                <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="input-group ">
                                <input type="text" class="form-control sometimes" data-inputmask='"mask": "9999999999"'
                                    data-inputmask-mask="(6000000000)|(9999999999)" data-inputmask-clearincomplete="true"
                                    data-mask name="alternate_phone_number" value="{{ old('alternate_phone_number') }}"
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
                    <div class="d-flex mb-2">
                        <div class="col">
                            <div class="input-group ">
                                <select class="form-control select2bs4 required" data-placeholder="Select Gender"
                                    name="gender">
                                    <option value="">Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="transgender" {{ old('gender') == 'transgender' ? 'selected' : '' }}>
                                        Transgender</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-map-marker-alt"></span>
                                    </div>
                                </div>
                            </div>
                            @error('gender')
                                <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="input-group ">
                                <input type="text" name="birthday" class="form-control required"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask
                                    placeholder="Date of Birth" value="{{ old('birthday') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="far fa-calendar-alt"></span>
                                    </div>
                                </div>
                            </div>
                            @error('birthday')
                                <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="input-group ">
                                <input type="text"
                                    class="form-control {{ $userType == 'customer' ? 'sometimes' : 'required' }}"
                                    name="aadhar_number" data-inputmask='"mask": "9999 9999 9999"'
                                    data-inputmask-mask="(1000 0000 0000)|(9999 9999 9999)"
                                    data-inputmask-clearincomplete="true" data-mask value="{{ old('aadhar_number') }}"
                                    placeholder="Aadhar Number">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card"></span>
                                    </div>
                                </div>
                            </div>
                            @error('aadhar_number')
                                <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </fieldset>
                <fieldset class="the-fieldset rounded mb-4 addressSection">
                    <legend class="the-legend badge badge-warning text-uppercase mb-2">Address Details:</legend>
                    <div class="col mb-2">
                        <div class="">
                            <textarea class="form-control required" rows="3" name="address" placeholder="Enter The Address">{{ old('address') }}</textarea>
                        </div>
                        @error('address')
                            <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex">
                        <div class="col">
                            <div class="input-group ">
                                <select class="form-control select2bs4 required getPopulate" name="state"
                                    data-placeholder="Select State" data-message="City" data-location="setCities">
                                    <option value="" data-populate="">State</option>
                                    @foreach ($states as $state)
                                        <option
                                            data-populate="{{ json_encode($state->districts->pluck('name', 'slug')) }}"
                                            value="{{ $state->slug }}"
                                            {{ $state->slug == old('state') ? 'selected' : '' }}>{{ $state->name }}
                                        </option>
                                    @endforeach
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
                        <div class="col">
                            <div class="input-group ">
                                <select class="form-control select2bs4 required setCities" data-placeholder="Select City"
                                    name="city">
                                    <option value="">City</option>
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
                        <div class="col">
                            <div class="input-group ">
                                <input type="text" name="pin_code" id="pin_code" placeholder="Pincode"
                                    class="form-control required" data-inputmask='"mask": "999999"'
                                    data-inputmask-clearincomplete="true" data-mask value="{{ old('pin_code') }}">
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
                </fieldset>
                @if ($userType == 'customer')
                    <fieldset class="the-fieldset rounded mb-4 optionalSection">
                        <legend class="the-legend badge badge-warning text-uppercase mb-2">Optional Details (Car):</legend>
                        <div class="d-flex mb-2">
                            <div class="col">
                                <div class="input-group ">
                                    <select class="form-control sometimes select2bs4 getPopulate "
                                        name="meta_details[brand]" data-placeholder="Select Brand" data-message="Model"
                                        data-location="setModel">
                                        <option value="" selected>Select A Brand</option>
                                        @foreach ($cars as $carKey => $carValue)
                                            <option value="{{ $carKey }}"
                                                data-populate="{{ json_encode($carValue->pluck('model', 'model')) }}"
                                                {{ old('meta_details.brand') == $carKey ? 'selected' : '' }}>
                                                {{ $carKey }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-car"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('meta_details.brand')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="input-group ">
                                    <select class="form-control sometimes select2bs4 setModel" name="meta_details[model]"
                                        data-placeholder="Select Model">
                                        <option value="">Select A Model</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-car"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('meta_details.model')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="input-group ">
                                    <select class="form-control select2bs4 sometimes" name="meta_details[technology]"
                                        data-placeholder="Select Technology">
                                        <option value="">Select A Technology</option>
                                        <option value="manual" {{ old('technology') == 'manual' ? 'selected' : '' }}>
                                            Manual
                                        </option>
                                        <option value="automatic"
                                            {{ old('technology') == 'automatic' ? 'selected' : '' }}>
                                            Automatic</option>
                                        <option value="both" {{ old('technology') == 'both' ? 'selected' : '' }}>Auto &
                                            Manual</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-cog"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('meta_details.technology')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div class="col">
                                <div class="input-group">
                                    <input type="text" name="meta_details[car_number]" id="car_number"
                                        placeholder="Car Number" class="form-control sometimes"
                                        data-inputmask='"mask": "aa 99 aa 9999"' data-inputmask-clearincomplete="true"
                                        data-mask value="{{ old('car_number') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa regular fa-list-ol"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('meta_details.car_number')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="input-group ">
                                    <input type="text" name="meta_details[fair_charge]" id="fair_charge"
                                        placeholder="Fair Charge" class="form-control sometimes"
                                        data-inputmask='"mask": "9999"' data-mask value="{{ old('fair_charge') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-rupee"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('meta_details.fair_charge')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                @elseif($userType == 'driver')
                    <fieldset class="the-fieldset rounded mb-4 licenceSection">
                        <legend class="the-legend badge badge-warning text-uppercase mb-2">Driving Licence Details:
                        </legend>
                        <div class="col" align="justify">
                            <p>
                                Total number of input characters should be exactly 16 (including space or '-' or '/').
                            </p>
                            <p>
                                If you hold an old driving license with a different format, please convert the format as per
                                below rule before entering.
                            <p><code>SS/RR/YYYY/NNNNNNN</code></p>
                            <p>Where</p>
                            <p><code>SS</code> - Two character State Code (like WB for West Bengal, TN for Tamil Nadu etc)
                            </p>
                            <p><code>RR</code> - Two digit RTO Code</p>
                            <p><code>YYYY</code> - 4-digit Year of Issue (For Example: If year is mentioned in 2 digits, say
                                99, then it should be converted to 1999. Similarly use 2012 for 12)</p>
                            <p><code>NNNNNNN</code> - Rest of the numbers are to be given in 7 digits. If there are less
                                number of digits, then additional 0's(zeros) may be added to make the total 7.
                            </p>
                            </p>
                            <p>
                                For example: If the Driving Licence Number is <code>RJ-13/12/123456</code> then please enter
                                <code>RJ-13/20120123456</code>
                            </p>
                        </div>
                        <div class="col">
                            <div class="input-group ">
                                <input type="text" class="form-control required"
                                    data-inputmask='"mask": "aa-99/9999/9999999"' data-inputmask-clearincomplete="true"
                                    data-mask name="meta_details[licence_no]"
                                    value="{{ old('meta_details.licence_no') }}" placeholder="Driving Licence Number">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card"></span>
                                    </div>
                                </div>
                            </div>
                            @error('meta_details.licence_no')
                                <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </fieldset>
                @elseif($userType == 'car-owner')
                    <fieldset class="the-fieldset rounded mb-4 ownercarSection">
                        <legend class="the-legend badge badge-warning text-uppercase mb-2">car details:</legend>
                        <div class="d-flex mb-2">
                            <div class="col">
                                <div class="input-group ">
                                    <select class="form-control required select2bs4 getPopulate "
                                        name="car_details[brand]" data-placeholder="Select Brand" data-message="Model"
                                        data-location="setModel">
                                        <option value="" selected>Select A Brand</option>
                                        @foreach ($cars as $carKey => $carValue)
                                            <option value="{{ $carKey }}"
                                                data-populate="{{ json_encode($carValue->pluck('model', 'uuid')) }}"
                                                {{ old('brand') == $carKey ? 'selected' : '' }}>{{ $carKey }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-car"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('car_details.brand')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <select class="form-control required select2bs4 setModel" name="car_details[model]"
                                        data-placeholder="Select Model">
                                        <option value="">Select A Model</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-car"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('car_details.model')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="input-group ">
                                    <select class="form-control select2bs4 required" name="car_details[technology]"
                                        data-placeholder="Select Technology">
                                        <option value="">Select A Technology</option>
                                        <option value="manual"
                                            {{ old('car_details.technology') == 'manual' ? 'selected' : '' }}>Manual
                                        </option>
                                        <option value="automatic"
                                            {{ old('car_details.technology') == 'automatic' ? 'selected' : '' }}>Automatic
                                        </option>
                                        <option value="both"
                                            {{ old('car_details.technology') == 'both' ? 'selected' : '' }}>Auto & Manual
                                        </option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-cog"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('car_details.technology')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <input type="text" name="car_details[car_number]" id="car_number"
                                        placeholder="Car Number" class="form-control required"
                                        data-inputmask='"mask": "aa 99 aa 9999"' data-inputmask-clearincomplete="true"
                                        data-mask value="{{ old('car_details.car_number') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa regular fa-list-ol"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('car_details.car_number')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col">
                                <div class="input-group ">
                                    <input type="text" class="form-control required" name="car_details[insurance_no]"
                                        value="{{ old('car_details.insurance_no') }}" placeholder="Insurance Number">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('car_details.insurance_no')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="input-group ">
                                    <input type="text" class="form-control required" name="car_details[rc_no]"
                                        value="{{ old('car_details.rc_no') }}" placeholder="Rc Number">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('car_details.rc_no')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="input-group ">
                                    <input type="text" class="form-control required" name="car_details[polution_no]"
                                        value="{{ old('car_details.polution_no') }}" placeholder="Polution Number">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('car_details.rc_no')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col">
                            <div class="input-group ">
                                <input type="text" class="form-control required" name="meta_details[owner_car_number]" value="{{ old('meta_details.owner_car_number') }}" data-inputmask='"mask": "aa 99 aa 9999"' data-inputmask-clearincomplete="true" data-mask placeholder="Car  Number">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card"></span>
                                    </div>
                                </div>
                            </div>
                            @error('meta_details.owner_car_number')
                                <span class="code text-danger small font-weight-bold">{{$message}}</span>
                            @enderror
                        </div> --}}
                        </div>
                    </fieldset>
                @endif
                <fieldset class="the-fieldset rounded mb-4 uploadSection">
                    <legend class="the-legend badge badge-warning text-uppercase mb-2">Upload Section:</legend>
                    <div class="d-flex">
                        <div class="col">
                            <label>Profile Picture</label>
                            <div class="input-group ">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input {{ $userType == 'driver' ? 'required' : 'sometimes' }}"
                                        id="profile_picture" name="media[profile_picture]">
                                    <label class="custom-file-label" for="profile_picture">Choose File....</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                </div>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-solid fa-folder"></span>
                                    </div>
                                </div>
                            </div>
                            @error('media.profile_picture')
                                <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($userType == 'driver')
                            <div class="col">
                                <label>Aadhar Image</label>
                                <div class="input-group ">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input required" id="validatedCustomFile"
                                            name="media[aadhar_image]">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose File....</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-solid fa-folder"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('media.aadhar_image')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label>Driving Licence Image</label>
                                <div class="input-group ">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input required"
                                            id="driving_licence_image" name="media[driving_licence_image]">
                                        <label class="custom-file-label" for="driving_licence_image">Choose
                                            File....</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-solid fa-folder"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('media.driving_licence_image')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        @elseif ($userType == 'car-owner')
                            <div class="col">
                                <label>Aadhar Image</label>
                                <div class="input-group ">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input required" id="aadhar_image"
                                            name="media[aadhar_image]">
                                        <label class="custom-file-label" for="aadhar_image">Choose File....</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-solid fa-folder"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('media.aadhar_image')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label>Insurance Image</label>
                                <div class="input-group ">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input required" id="insurance_image"
                                            name="media[insurance_image]">
                                        <label class="custom-file-label" for="insurance_image">Choose File....</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-solid fa-folder"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('media.insurance_image')
                                    <span class="code text-danger small font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                </fieldset>
                {{-- @if ($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif --}}
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="col-4 mx-auto">
                    <input type="hidden" value="{{ $userType }}" name="userType" id="userType">
                    <input type="hidden" name="imagesize" id="imagesize"
                        value="{{ config('constants.SITE_PHOTO_STORE_IMAGE_DIMENSION') }}">
                    <button type="submit" class="btn btn-block btn-success userAddbtn">Submit</button>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/js/user.js') }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            placeholder: $(this).data('placeholder'),
            allowClear: true
        });
        $('[data-mask]').inputmask({
            casing: "upper",
            removeMaskOnSubmit: true,
            nullable: false
        });
    </script>
    <script src="{{ asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
@endpush
