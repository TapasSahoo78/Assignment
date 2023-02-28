<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.header')

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        @include('layouts.partials.preloader')

        <!-- Navbar -->
        @include('layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @if ($showSidebar)
            @include('layouts.partials.sidebar')
        @endif
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @if ($showContentHeader)
                @include('layouts.partials.content-header')
            @endif
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @if ($showFooter)
            @include('layouts.partials.footer')
        @endif
    </div>
    <!-- ./wrapper -->
    @include('layouts.partials._footer')
</body>

</html>
