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
                                        @can('role.edit')
                                            <a href="{{ route('roles.edit', Crypt::encrypt($role->id)) }}"
                                                class="btn btn-info editButton">Edit</a>
                                        @endcan
                                        @can('role.delete')
                                            <form class="form-horizontal" role="form" method="POST"
                                                action="{{ route('roles.destroy', $role->id) }}"
                                                onsubmit="return confirm('Are you sure you wish to delete this record?');">
                                                @if ($role->id)
                                                    {{ method_field('DELETE') }}
                                                @endif
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn"
                                                    style="border: none;background:transparent">

                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20"
                                                        height="20" fill="red">
                                                        <path
                                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg>

                                                </button>
                                            </form>
                                        @endcan
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
