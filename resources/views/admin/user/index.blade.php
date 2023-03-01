@extends('layouts.app', ['showSidebar' => true, 'showContentHeader' => true, 'showFooter' => false])
@push('styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex p-2">
                    <div class="col-3 float-right">
                        <a href="{{ route('users.create') }}" class="btn btn-block btn-success ">
                            <i class="fas fa-plus"></i> Add </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Photo</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        <tbody>
                            @forelse ($adminUser as $key => $user)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @if (isset($user->media->file))
                                            <img src="{{ asset('uploads/' . $user->media->file) }}" width="50"
                                                height="50">
                                        @else
                                            <p>no image</p>
                                        @endif
                                    </td>
                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile_number }}</td>
                                    <td>{{ $user->profile->birthday }}</td>
                                    <td>{{ $user->profile->gender }}</td>
                                    <td>{{ $user->roles[0]->name }}</td>
                                    <td class="text-center">
                                        @can('user.edit')
                                            <a href="{{ route('users.edit', Crypt::encrypt($user->id)) }}"
                                                class="btn btn-info editButton" style="border: none;background:transparent">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20"
                                                    height="20" fill="blue">
                                                    <path
                                                        d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                                </svg>
                                            </a>
                                        @endcan

                                        @can('user.delete')
                                            <form class="form-horizontal" role="form" method="POST"
                                                action="{{ route('users.destroy', $user->id) }}"
                                                onsubmit="return confirm('Are you sure you wish to delete this record?');">
                                                @if ($user->id)
                                                    {{ method_field('DELETE') }}
                                                @endif
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger"
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
                                    <td colspan="9">
                                        <p class="text-danger">User not Available !</p>
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
