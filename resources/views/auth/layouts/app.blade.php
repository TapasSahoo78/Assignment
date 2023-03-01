<!DOCTYPE html>
<html lang="en">
<title>@yield('title')</title>
@include('auth.layouts.partials.header')

<body class="hold-transition {{ \Request::route()->getName() == 'login' ? 'login-page' : 'register-page' }}">
    @include('auth.layouts.partials.flash')
    <div class="loader-blur">
        <div class="loader"></div>
    </div>
    @yield('content')
    @include('auth.layouts.partials.footer')
</body>

</html>
