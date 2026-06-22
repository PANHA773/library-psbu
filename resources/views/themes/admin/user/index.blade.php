@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.users')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.users')}}</li>
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
            
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('peoples/users/create') }}">{{__('admin.add_user')}}</a>
              </div>
           
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{__('admin.image')}}</th>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.phone')}}</th>
                    <th>{{__('admin.email')}}</th>
                    <th>{{__('admin.skills')}}</th>
                    <th>{{__('admin.roles')}}</th>
                    <th>{{__('admin.action')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr class="text-center view-modal" data-id="{{ $user->id}}" data-toggle="modal" data-target="#modal-lg">
                      <td><img width="50px" style="border-radius:50%;object-fit:cover;height:50px;"
                           src="{{ $user->avatar ? asset('uploads/profile/'. $user->avatar) : asset('images/no_image.png') }}"
                           onerror="this.src='{{ asset('images/no_image.png') }}'"></td>
                      <td>{{ $user->name; }}</td>
                      <td>{{ $user->phone; }}</td>
                      <td>{{ $user->email; }}</td>
                      <td>{{ $user->skills; }}</td>
                      <td>
                        @foreach($user->roles as $role)
                          <span class="badge badge-primary">{{ ucfirst($role->name) }}</span>
                        @endforeach
                      </td>
                      <td style="width: 170px;">
                          <form action="{{ admin_url('peoples/users/'. $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        @if($user->is_ban == 1) 
                        <a href="{{ admin_url('peoples/users/status_ban/'. $user->id) }}" class="btn btn-success btn-sm"><i class="fas fa-sync"></i></a>
                        @else
                        <a href="{{ admin_url('peoples/users/status_ban/'. $user->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></a>
                        @endif
                        <a href="{{ admin_url('peoples/users/'. $user->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
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

  <script>
    var site =  {url: "<?= admin_url('peoples/users/') ?>" , asset: "<?= asset('uploads/profile/') ?>", no_image: "<?= asset('images/no_image.png') ?>" }
    function htmlEntities(str) {
        return String(str).replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>').replace(/"/g, '"');
    }

    $(function () {
    $(document).on('click', '.view-modal', function () {
        var id = $(this).attr('data-id');
        // alert(id);
        var html = '';
        $(".modal-title").text('{{__("admin.user_details")}}');

        $.ajax({
            url: site.url + '/' + id,
            dataType: "json",
            type: "get",
            async: true,
            success: function (data) {    
                html += `
                <div class="row mb-4">
                  <div class="col-md-4">
                    <img src="${data.avatar ? site.asset + '/' + data.avatar : site.no_image }" alt="${data.name}" width="100%">
                  </div>
                  <div class="col-md-8">
                    <table class="table table-bordered table-strip">
                      <tbody>
                        <tr>
                          <td>{{__('admin.name')}}</td>
                          <td>${data.name}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.phone')}}</td>
                          <td>${data.phone}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.email')}}</td>
                          <td>${data.email}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.gender')}}</td>
                          <td>${data.gender}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.experiences')}}</td>
                          <td>${data.experience}</td>
                        </tr>

                        <tr>
                          <td>{{__('admin.skills')}}</td>
                          <td>${data.skills}</td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
                `;
                $('.modal-body').empty().append(html);


              var qrcode = new QRCode("qrcode", {
                  text: data.code,
                  width: 50,
                  height: 50,
                  correctLevel : QRCode.CorrectLevel.L
              });

            JsBarcode("#barcode", data.code, {
              format: "CODE128",
              lineColor: "#0aa",
              width:1,
              height:40,
              displayValue: true
            });

            },
        });

    });
});
  </script>

  @include('components.modal-lg')
@stop
