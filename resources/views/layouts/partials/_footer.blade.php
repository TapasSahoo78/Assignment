<script src="{{ asset('assets/dist/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets/dist/js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/dashboard2.js') }}"></script>
{{-- toastr js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/js/datatable.js') }}"></script>
@include('layouts.partials.flash')
@stack('scripts')
