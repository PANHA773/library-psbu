@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create User Account for {{ $department->name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('admin.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{ admin_url('settings/departments') }}">Departments</a></li>
              <li class="breadcrumb-item active">Create User</li>
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
              <form id="userForm" action="{{ admin_url('settings/departments/'. $department->id .'/users') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter user name" required>
                                @error('name')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                                @error('email')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                                @error('password')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone">
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
