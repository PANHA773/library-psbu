@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User Account - {{ $department->name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{ admin_url('settings/departments') }}">Departments</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ __('admin.in_required') }}</h3>
              </div>
              <form id="userForm" action="{{ admin_url('settings/departments/'. $department->id .'/users/'. $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" placeholder="Enter user name" required>
                                @error('name')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Enter email" required>
                                @error('email')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password (Leave blank to keep current)</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password">
                                @error('password')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm new password">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}" placeholder="Enter phone">
                                @error('phone')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="avatar">Profile Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="avatar" name="avatar" accept="image/*">
                                    <label class="custom-file-label" for="avatar">Choose image</label>
                                  </div>
                                </div>
                                @if($user->avatar)
                                  <div class="mt-2">
                                    <img src="{{ asset('uploads/users/' . $user->avatar) }}" width="100px" height="100px" class="rounded">
                                  </div>
                                @endif
                                @error('avatar')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('admin.submit')}}</button>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</div>
@stop
