@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.login_devices')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.login_devices')}}</li>
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
          
              <div class="card-body">
                <table id="table-category" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{__('admin.ip_address')}}</th>
                    <th>{{__('admin.devices')}}</th>
                    <th>{{__('admin.platform')}}</th>
                    <th>{{__('admin.browsers')}}</th>
                    <th>{{__('admin.logined_in_at')}}</th>
                    {{-- <th>{{__('admin.action')}}</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($devices as $device)
                  <tr class="text-center">
                    <td>{{ $device->ip_address; }}</td>
                    <td>{{  $device->device; }}</td>
                    <td>{{ $device->platform; }}</td>
                    <td>{{ $device->browser; }}</td>
                    <td>{{ $device->logged_in_at; }}</td>
                    {{-- <td>
                        
                        <form  action="{{ admin_url('settings/categories/'. $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:void(0)" class="btn btn-info btn-sm view-modal" data-id="{{ $category->id}}" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-eye"></i></a>
                        <a href="{{ admin_url('settings/categories/'. $category->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td> --}}
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
  <script>

    var site =  {url: "<?= admin_url('settings/categories/') ?>" , asset: "<?= asset('uploads/category/') ?>" }

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>').replace(/"/g, '"');
    }

    $(function () {
    $(document).on('click', '.view-modal', function () {
        var id = $(this).attr('data-id');
        var html = '';

        $.ajax({
            url: site.url + '/' + id,
            dataType: "json",
            type: "get",
            async: true,
            success: function (data) {
              // alert(JSON.stringify(data));
                html += `
                <div class="row mb-4">
                  <div class="col-md-4">
                    <img src="${data.image ? site.asset + '/' + data.image : site.asset + '/no_image.png'}" alt="${data.name}" width="100%">
                  </div>
                  <div class="col-md-8">
                  
                    <table class="table table-bordered table-strip">
                      <tbody>
                        <tr>
                          <td>{{__('admin.code')}}</td>
                          <td>${data.code}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.name')}}</td>
                          <td>${data.name}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.description')}}</td>
                          <td>${ htmlEntities(data.description) }</td>
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
