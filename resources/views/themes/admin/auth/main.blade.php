<?php 
$bgs = glob('./images/*.jpg');
$testing =  str_replace('./images/','', $bgs[mt_rand(0, count($bgs) - 1)]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ settings()->site_name }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}"></link>


</head>
<body class="hold-transition login-page" style="background-image: url('<?= asset('images/'. $testing); ?>'); background-size: cover;">

    @yield('content')
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>


@error('captcha')
<script>$(function(){
  var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
});
Toast.fire({
      icon: 'error',
      title: '{{ $message }}'
    })
})</script>
@enderror



@if(session('success'))
  <script>$(function(){
    var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  Toast.fire({
      icon: 'success',
      title: '<b>{{ session("success") }}</b>',
    })
  })</script> 
@elseif(session('info')) 
<script>$(function(){
  var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
Toast.fire({
      icon: 'info',
      title: '{{ session("info") }}'
    })
})</script>

  {{-- <script> $(function(){toastr.info("{{ session('info') }}") })</script> --}}
@elseif(session('warning'))
<script>$(function(){
  var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
Toast.fire({
      icon: 'warning',
      title: '{{ session("warning") }}'
    })
})</script>
{{-- <script> $(function(){toastr.warning("{{ session('warning') }}") })</script> --}}
@elseif(session('error')) 
<script>$(function(){
  var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
Toast.fire({
      icon: 'error',
      title: '<b>{{ session("error") }}</b>'
    })
})</script>
{{-- <scrip> $(function(){toastr.error("{{ session('error') }}") })</script> --}}
@endif
</body>
</html>