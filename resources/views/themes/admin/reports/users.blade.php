@extends(admin_layout('layouts.app'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('admin.user_report') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{ __('admin.books') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <form method="POST" action="{{ admin_url('reports/books')}}">
          @csrf
          @method('POST')
        <div class="card card-default collapsed-card">
          <div class="card-header">
            <h3 class="card-title">{{__('admin.date_filter')}}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>{{__('admin.start_date')}}</label>
                  <input type="date" class="form-control" value="{{ date('Y-m-d')}}" name="start_date">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>{{__('admin.end_date')}}</label>
                  <input type="date" class="form-control" value="{{ date('Y-m-d')}}" name="end_date">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">{{__('admin.filter')}}</button>
            </div>
          </div>
          
        </form>   
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title m-1">{{__('admin.report_description')}}</h3>
                <div class="float-end">
                  <a href="{{ admin_url(' ') }}" class="btn btn-default"><i class="fas fa-file-pdf"></i></a>
                  <a href="{{ admin_url('') }}" class="btn btn-default"><i class="fas fa-file-excel"></i></a>
                </div>
              </div>
              <div class="card-body">
                <table id="book-table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{ __('admin.image') }}</th>
                    <th>{{ __('admin.name') }}</th>
                    <th>{{ __('admin.email') }}</th>
                    <th>{{ __('admin.phone') }}</th>
                    <th>{{ __('admin.action') }}</th>
                  </tr>
                  
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                  <tr class="text-center">
                    <td><img width="50px" src="{{ $user->avatar ? asset('uploads/profile/'. $user->avatar) : asset('images/no_image.png');  }}"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <button class="btn btn-info btn-sm view-modal" data-id="{{ $user->id}}" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-eye"></i></button>
                       
                    </td>
                  </tr>
                  @endforeach
                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @include('components.modal-lg')
@stop
