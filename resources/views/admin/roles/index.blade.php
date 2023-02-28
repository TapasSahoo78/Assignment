@extends('layouts.app', ['showSidebar' => true, 'showContentHeader' => true, 'showFooter' => false])
@push('styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex p-2">
                    <div class="col-3 float-right">
                        <a href="{{ route('roles.create') }}" class="btn btn-block btn-success ">
                            <i class="fas fa-plus"></i> Add </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        <tbody>
                            @forelse ($roleWithPermission as $key => $role)
                                <tr>
                                    <td style="">{{ $i++ }}</td>
                                    <td style="">{{ $role->name }}</td>
                                    <td>
                                        <div class="row">
                                            @forelse ($role->permissions as $permission)
                                                <div class="col-3">{{ $permission->name }}</div>
                                            @empty
                                                <p class="text-danger">Permission not available!</p>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('roles.edit', Crypt::encrypt($role->id)) }}"
                                            class="btn btn-info editButton">Edit</a>
                                        <button class="btn btn-danger deleteButton" data-id="{{ $role->id }}"
                                            data-toggle="modal" data-target="#deleteRoleModal">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="info">
                                    <td colspan="5">
                                        <p class="text-danger">Role Not Available !</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <!-- Delete Role Modal -->
                <div class="modal fade" id="deleteRoleModal" tabindex="-1" role="dialog"
                    aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteRoleModalLabel">Delete Role</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete role?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/role.js') }}"></script>
@endpush
