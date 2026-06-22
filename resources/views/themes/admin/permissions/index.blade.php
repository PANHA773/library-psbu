@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper no-print">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.permissions')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.permissions')}}</li>
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
                <h3 class="card-title">{{__('admin.report_description')}}</h3>
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('settings/permissions/create') }}">{{__('admin.add_permission')}}</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.group_name')}}</th>
                    <th>{{__('admin.action')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $pm)
                  <tr class="text-center">
                    <td>{{ $pm->name }}</td>
                    <td>{{$pm->group_name}}</td>
                    <td>
                      <form action="{{ admin_url('settings/permissions/'. $pm->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                      
                        <a href="{{ admin_url('settings/permissions/'. $pm->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
