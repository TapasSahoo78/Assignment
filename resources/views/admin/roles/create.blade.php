@extends('layouts.app', ['showSidebar' => true, 'showContentHeader' => true, 'showFooter' => false])
@push('styles')
@endpush
@section('content')
    <div class="card card-primary">
        <div class="card-header d-flex justify-content-end">
            <p class="h4 col-9 text-capitalize">Add Form</p>
            @include('layouts.partials.back-button')
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ isset($editRole->id) ? route('roles.update', $editRole->id) : route('roles.store') }}" method="POST"
            name="userAddform" enctype="multipart/form-data">
            @if (isset($editRole->id))
                @method('PUT')
            @endif
            @csrf
            <!-- Info boxes -->
            <div class="row">
                <div class="container">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="name" class="form-label">Role</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ isset($editRole->name) ? $editRole->name : '' }}" placeholder="Enter Role">
                        </div>
                    </div>

                    <div class="row mb-3 mt-3">
                        <label for="Features " class="col-sm-3">Permissions </label>
                        <div class="col-3 gap-3 d-flex">

                            <div class="form-check">
                                <input type="checkbox" value="1" class="form-check-input" id="checkPermissionAll">
                                <label class="form-check-label" for="checkPermissionAll">All</label>
                            </div>
                        </div>
                        <div class="col-6">
                            @if (isset($editRole))
                                @foreach ($permissions as $permission)
                                    <div class="col-3">
                                        <label for="">{{ $permission->name }}</label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $editRole->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($permissions as $permission)
                                    <div class="col-3">
                                        <label for="">{{ $permission->name }}</label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="col-3 mx-auto d-flex">
                    <button type="submit" class="btn btn-block btn-md btn-success userAddbtn">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $("#checkPermissionAll").click(function() {
            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked', true);
            } else {
                // un check all the checkbox
                $('input[type=checkbox]').prop('checked', false);
            }
        });
    </script>
@endpush
