@extends(admin_layout('layouts.app'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.provinces')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.provinces')}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{__('admin.report_description')}}</h3>
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('settings/provinces/create') }}">{{__('admin.add_provinces')}}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table-category" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{__('admin.image')}}</th>
                    <th>{{__('admin.zipcode')}}</th>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.description')}}</th>
                    <th>{{__('admin.action')}}</th>
                  </tr> 
                  </thead>
                  <tbody>
                    @foreach($provinces as $province)
                  <tr class="text-center">
                    <td><img width="50px" src="{{ $province->image ? asset('uploads/province/'. $province->image) : asset('images/no_image.png');  }}"></td>
                    <td>{{ $province->zip_code }}</td>
                    <td>{{ $province->name }}</td>
                    <td><?= decode_html($province->details) ?></td>
                    {{-- <td>{{ $province->parent_name }}</td> --}}
                    <td>
                        
                        <form  action="{{ admin_url('settings/provinces/'. $province->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:void(0)" class="btn btn-info btn-sm view-modal" data-id="{{ $province->id}}" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-eye"></i></a>
                            <a href="{{ admin_url('settings/provinces/'. $province->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
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

  <script>

    var site =  {url: "<?= admin_url('settings/provinces/') ?>" , asset: "<?= asset('uploads/province/') ?>" }

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>').replace(/"/g, '"');
    }

    $(function () {

    $(document).on('click', '.view-modal', function () {
        var id = $(this).attr('data-id');
        // alert(id);
        var html = '';

        // alert(site.url);

        $.ajax({
            url: site.url + '/' + id,
            dataType: "json",
            type: "get",
            async: true,
            success: function (data) {
                html += `
                <div class="row mb-4">
                  <div class="col-md-4">
                    <img src="${site.asset + '/' + data.image}" alt="${data.name}" width="100%">
                  </div>
                  <div class="col-md-8">
                  
                    <table class="table table-bordered table-strip">
                      <tbody>
                        <tr>
                          <td>{{__('admin.province_name')}}</td>
                          <td>${data.name}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.zip_code')}}</td>
                          <td>${data.zip_code}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.details')}}</td>
                          <td>${ htmlEntities(data.details) }</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                `;
                $('.modal-body').empty().append(html);

            },
        });

    });
});
  </script>


  @include('components.modal-lg')
@stop
