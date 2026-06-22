@extends(admin_layout('auth.main'))
@section('content')

<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>{{ settings()->site_name }}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You Scanning here for login this new device from other device has login your account.</p>
      <form action="recover-password.html" method="post">
        <div class="input-group mb-3">
          <div class="container">
            <div class="text-center justify-center items-center">
              {!! '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG($code, 'QRCODE') . '" alt="barcode"  width="50%" />' !!}
          </div>
          </div>
          {{-- <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div> --}}
        </div>
        <div class="row">
          {{-- <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div> --}}
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection



<!-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    Session Status
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        Email Address
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> -->
