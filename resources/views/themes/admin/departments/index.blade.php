@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('admin.departments') ?? 'Departments' }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{ __('admin.departments') ?? 'Departments' }}</li>
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
                <h3 class="card-title">{{ __('admin.list') ?? 'Department List' }}</h3>
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('settings/departments/create') }}">{{__('admin.add_department') ?? 'Add Department'}}</a>
              </div>

              <div class="table-responsive">
              <div class="card-body ">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>{{ __('admin.name') ?? 'Name' }}</th>
                      <th>{{ __('admin.code') ?? 'Code' }}</th>
                      <th>{{ __('admin.email') ?? 'Email' }}</th>
                      <th>{{ __('admin.phone') ?? 'Phone' }}</th>
                      <th>{{ __('admin.status') ?? 'Status' }}</th>
                      <th>{{ __('admin.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($departments as $department)
                  <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->code }}</td>
                    <td>{{ $department->email ?? 'N/A' }}</td>
                    <td>{{ $department->phone ?? 'N/A' }}</td>
                    <td>
                      @if($department->is_active)
                        <span class="badge bg-success">{{ __('admin.active') ?? 'Active' }}</span>
                      @else
                        <span class="badge bg-danger">{{ __('admin.inactive') ?? 'Inactive' }}</span>
                      @endif
                    </td>
                    <td class="col-3">
                        <a href="{{ admin_url('settings/departments/'. $department->id .'/users') }}" class="btn btn-info btn-sm" title="Manage Users">
                          <i class="fas fa-users"></i> Users
                        </a>
                        <form  action="{{ admin_url('settings/departments/'. $department->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <a href="{{ admin_url('settings/departments/'. $department->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center">{{ __('admin.no_data') ?? 'No data available' }}</td>
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
