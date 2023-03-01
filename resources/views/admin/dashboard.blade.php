@extends('layouts.app', ['showSidebar' => true, 'showContentHeader' => true, 'showFooter' => false])

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <h2>Welcome to {{ auth()->user()->roles[0]->name }} Dashboard</h2>
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
