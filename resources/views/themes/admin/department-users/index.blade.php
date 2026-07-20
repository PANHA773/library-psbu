@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $department->name }} - Users/Accounts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('admin.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{ admin_url('settings/departments') }}">Departments</a></li>
              <li class="breadcrumb-item active">{{ $department->name }}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Department User Accounts</h3>
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('settings/departments/'. $department->id .'/users/create') }}">Add User Account</a>
              </div>

              <div class="table-responsive">
              <div class="card-body ">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Status</th>
                      <th>{{ __('admin.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($users as $user)
                  <tr>
                    <td>
                      @php
                        $departmentAvatarPath = $user->avatar ? public_path('uploads/users/' . $user->avatar) : null;
                      @endphp
                      <img src="{{ ($user->avatar && file_exists($departmentAvatarPath)) ? asset('uploads/users/'. $user->avatar) : asset('images/no_image.png') }}" width="40px" height="40px" class="rounded-circle">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? 'N/A' }}</td>
                    <td>
                      @if($user->activated)
                        <span class="badge bg-success">Active</span>
                      @else
                        <span class="badge bg-danger">Inactive</span>
                      @endif
                    </td>
                    <td class="col-2">
                        <a href="{{ admin_url('settings/departments/'. $department->id .'/users/'. $user->id .'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <form  action="{{ admin_url('settings/departments/'. $department->id .'/users/'. $user->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center">No users assigned to this department yet</td>
                  </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop
