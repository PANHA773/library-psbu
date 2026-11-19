<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ settings()->site_name }}</title>
  <link rel="shortcut icon" href="{{ settings_logo_url() }}" type="image/x-icon">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')  }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{asset('dist/css/style.css')}}">

  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

  <link href="{{ asset('plugins/jquery-ui/jquery-ui.css')}}"  rel = "stylesheet">
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Kantumruy+Pro:wght@300;400;500;600;700&family=Noto+Sans+Khmer:wght@300;400;500;600;700&family=Noto+Sans:wght@300;400;500;600;700&display=swap');
  :root {
    --admin-navy: #081A33;
    --admin-blue: #0B2C5F;
    --admin-blue-soft: #123A73;
    --admin-accent: #0E6E8C;
    --admin-gold: #D9A441;
    --admin-bg: #F8FAFC;
    --admin-text: #0F172A;
    --admin-muted: #64748B;
    --admin-border: #E2E8F0;
  }
  body {
    font-family: "Kantumruy Pro", "Noto Sans Khmer", "Noto Sans", "Battambang", system-ui, sans-serif !important;
    color: var(--admin-text);
    background: var(--admin-bg);
  }
  .main-sidebar { background: var(--admin-navy) !important; box-shadow: 8px 0 28px rgba(8,26,51,.12) !important; }
  .brand-link { min-height: 76px; display:flex !important; align-items:center; border-bottom:1px solid rgba(255,255,255,.1) !important; padding: .8rem 1rem !important; }
  .brand-image { width:38px; height:38px; max-height:38px !important; object-fit:cover; margin:0 12px 0 0 !important; }
  .brand-text { color:#fff !important; font-weight:700 !important; letter-spacing:.01em; white-space:normal; line-height:1.2; }
  .brand-text .brand-subtitle { display:block;color:rgba(255,255,255,.56);font-size:.68rem;font-weight:400;letter-spacing:.035em;margin-top:3px; }
  .main-sidebar .sidebar { padding: 12px 10px 18px; }
  .nav-sidebar .nav-link { color:rgba(255,255,255,.76) !important; border-radius:9px; margin:2px 0; transition:background .18s ease,color .18s ease,transform .18s ease; }
  .nav-sidebar .nav-link:hover { background:rgba(255,255,255,.09) !important; color:#fff !important; transform:translateX(2px); }
  .nav-sidebar .nav-link.active { color:#fff !important; background:linear-gradient(100deg,rgba(217,164,65,.22),rgba(14,110,140,.22)) !important; box-shadow:inset 3px 0 var(--admin-gold); }
  .nav-sidebar .nav-link.active .nav-icon { color:var(--admin-gold) !important; }
  .nav-sidebar .nav-treeview { padding-left:8px; }
  .nav-sidebar .nav-treeview > .nav-item > .nav-link { font-size:.92rem; }
  .main-header { background:#fff !important; border-bottom:1px solid var(--admin-border) !important; box-shadow:0 3px 14px rgba(15,23,42,.04); }
  .main-header .nav-link { color:var(--admin-muted) !important; }
  .main-header .nav-link:hover { color:var(--admin-blue) !important; }
  .main-header .text-white { color:var(--admin-muted) !important; }
  .dropdown-menu { border:1px solid var(--admin-border); border-radius:12px; box-shadow:0 16px 36px rgba(15,23,42,.12); overflow:hidden; }
  .dropdown-item:active { background:var(--admin-blue); }
  .content-wrapper, .content-wrapper > .content { background:var(--admin-bg); }
  .content-header { padding:22px 1rem 12px !important; }
  .content-header h1 { color:var(--admin-text); font-size:1.55rem; font-weight:700; }
  .breadcrumb { background:transparent !important; }
  .breadcrumb-item, .breadcrumb-item a { color:var(--admin-muted); }
  .main-footer { background:#fff; border-top:1px solid var(--admin-border); color:var(--admin-muted); }
  .btn-primary { background:var(--admin-blue); border-color:var(--admin-blue); }
  .btn-primary:hover { background:var(--admin-blue-soft); border-color:var(--admin-blue-soft); }
  .user-panel-card { display:flex; align-items:center; gap:11px; margin:18px 7px 4px; padding:14px 10px 4px; border-top:1px solid rgba(255,255,255,.12); color:#fff; }
  .user-panel-card .user-initial { width:36px;height:36px;display:grid;place-items:center;border-radius:50%;background:rgba(217,164,65,.18);color:#f2c66d;font-weight:700; }
  .user-panel-card .user-meta { min-width:0; }
  .user-panel-card .user-name { font-size:.88rem;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
  .user-panel-card .user-role { color:rgba(255,255,255,.56);font-size:.74rem; }
  @media (max-width:767.98px) {
    .main-header { margin-left:0 !important; }
    .content-header { padding-top:16px !important; }
    .brand-link { min-height:64px; }
  }
  @media (prefers-reduced-motion:reduce) { *,*::before,*::after { scroll-behavior:auto !important; transition:none !important; animation:none !important; } }
  .truncated-text {
      overflow: hidden !important;
      white-space: nowrap !important;
      text-overflow: ellipsis !important; 
  }

  </style>
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed body">
<div class="wrapper">
   <main>
      @include(admin_layout('layouts.navigation'))
      @include(admin_layout('layouts.sidebar'))
      @yield('content')
   </main>

   <aside class="control-sidebar control-sidebar-dark">
   </aside>

  <footer class="main-footer no-print">
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="<?php eval(base64_decode('CiBlY2hvIHN0cmlwb3MoJF9TRVJWRVJbIlx4NTNceDQ1XDEyMlwxMjZceDQ1XHg1Mlx4NWZceDUwXDEyMlx4NGZceDU0XDExN1wxMDNceDRmXDExNCJdLCAiXHg2OFx4NzRcMTY0XHg3MFx4NzMiKSA9PT0gMCA/ICJceDY4XDE2NFx4NzRcMTYwXDE2M1w3Mlx4MmZcNTciIDogIlx4NjhceDc0XDE2NFwxNjBceDNhXHgyZlw1NyIgLiAkX1NFUlZFUlsiXDExMFx4NTRcMTI0XDEyMFwxMzdcMTEwXDExN1wxMjNcMTI0Il07IA==')); ?>">{{settings()->site_name}}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <span>{{__('admin.login_device')}}: {{Auth::user()->os_login}} ,({{__('admin.login_browser')}}: {{Auth::user()->brower_login}})</span>
      <b>{{__('admin.version')}}</b> {{shop_settings()->version}}
    </div>
  </footer>
</div>

<script async src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script async src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/core.js') }}"></script>

<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<script  src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script  src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script  src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script  src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script  src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script  src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script  src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script  src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script  src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script  src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script  src="{{asset('dist/js/datatables.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
  $(function () {
    $('#summernote').summernote({
      placeholder: "{{__('admin.input_description')}}",
      height: 200
    })
  });
</script>

<script >
 var lang = {};
  lang.first              = "{{ __('datatable.first') }}";
  lang.last               = "{{ __('datatable.last') }}";
  lang.next               = "{{ __('datatable.next') }}";
  lang.previous           = "{{ __('datatable.previous') }}";
  lang.lengthMenu          = "{{ __('datatable.lengthMenu') }}";
  lang.zeroRecords        = "{{ __('datatable.zeroRecords') }}";
  lang.info               = "{{ __('datatable.info') }}";
  lang.infoEmpty          = "{{ __('datatable.infoEmpty') }}";
  lang.infoFiltered       = "{{ __('datatable.infoFiltered') }}";
  lang.search             = "{{ __('datatable.search') }}";
  lang.loadingRecords     = "{{ __('datatable.loadingRecords') }}";
  lang.processing         = "{{ __('datatable.processing') }}";
  lang.emptyTable         = "{{ __('datatable.emptyTable') }}";

</script>

<script  src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script  src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

  @if(session('success'))
    <script >$(function(){
      var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    Toast.fire({
        icon: 'success',
        title: '{{ session("success") }}',
      })
    })</script> 
  @elseif(session('info')) 
  <script >$(function(){
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
  @elseif(session('warning'))
  <script >$(function(){
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
  <script> $(function(){toastr.warning("{{ session('warning') }}") })</script>
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
  @endif

  <script>
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0');
      var yyyy = today.getFullYear();

      var ttoday = mm + '/' + dd + '/' + yyyy;
      var dateEl = document.querySelector(".date");
      if (dateEl) {
          dateEl.value = ttoday;
      }
  </script>

  <script async>
    var get_code =  '{{request()->cookie("language");}}';
      $('.show-flag').addClass('flag-icon-'+ get_code); 
      $('.flag-icon-'+ get_code).addClass('active'); 
  
  </script>

<script async>

      // var themes =  localStorage.getItem("themes");
      var themes = getCookie("themes");
      $('.body').addClass(themes);
      if(themes == 'dark-mode') {
        $('.switch-theme').append('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16"><path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/></svg>');
      } else {
        $('.switch-theme').append('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16"><path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286"/></svg>');
      }
     
  function myFunction() {
     var element = document.body;
     element.classList.toggle("dark-mode");

     if ($(document.body).hasClass("dark-mode")) {
        $('.switch-theme').empty();
        setCookie("themes", "dark-mode", 365);
        $('.switch-theme').append('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16"><path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/></svg>');
      } else {
        $('.switch-theme').empty();
        $('.switch-theme').append('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16"><path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286"/></svg>');
        setCookie("themes", "");
      }
  }

  </script>
  {{-- <script>
    $(".modal").printThis({ 
    debug: false,              
    importCSS: true,             
    importStyle: true,         
    printContainer: true,
    pageTitle: "My Modal",             
    removeInline: false,        
    printDelay: 333,            
    header: null,             
    formValues: true          
}); 
  </script> --}}

  @yield('scripts')

</body>
</html>
