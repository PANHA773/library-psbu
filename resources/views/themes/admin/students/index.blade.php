@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper no-print">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.student_lists')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.student_lists')}}</li>
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
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('peoples/students/create') }}">{{__('admin.add_student')}}</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{__('admin.image')}}</th>
                    <th>{{__('admin.reference_no')}}</th>
                    <th>{{__('admin.first_name')}}</th>
                    <th>{{__('admin.last_name')}}</th>
                    <th>{{__('admin.nick_name')}}</th>
                    <th>{{__('admin.gender')}}</th>
                    <th>{{__('admin.action')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($students as $student)
                  <tr class="text-center">
                    <td><img width="50px" src="{{ $student->image ? asset('uploads/student/'. $student->image) : asset('images/no_image.png');  }}"></td>
                    <td>{{ $student->code }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->nick_name }}</td>
                    <td>{{ $student->dob }}</td>
                    <td>
                        <form  action="{{ admin_url('peoples/students/'. $student->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="#" class="btn btn-info btn-sm view-modal" data-id="{{ $student->id}}" data-toggle="modal" data-target="#modal-lg"><i class="fas fa fa-eye"></i></a>
                        <a href="{{ admin_url('peoples/students/'. $student->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa fa-trash"></i></button>
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
    var site =  {url: "<?= admin_url('peoples/students/') ?>" , asset: "<?= asset('uploads/student/') ?>" }
    function htmlEntities(str) {
        return String(str).replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>').replace(/"/g, '"');
    }
    $(function () {
    $(document).on('click', '.view-modal', function () {
        var id = $(this).attr('data-id');

        var html = '';
        $(".modal-title").text('{{__("admin.student_details")}}');
        $.ajax({
            url: site.url + '/' + id,
            dataType: "json",
            type: "get",
            async: true,
            success: function (data) {    
                html += `
                <div class="row mb-4">
                  <div class="col-md-4">
                    <img src="${data.image ? site.asset + '/' + data.image : site.asset + '/no_image.png'}" alt="${data.name}" width="100%">
                  </div>
                  <div class="col-md-8">
                  
                    <table class="table table-bordered table-strip">
                      <tbody>
                        <tr>
                          <td>{{__('admin.qrcode')}}</td>
                          <td><span id="qrcode"></span></td>
                        </tr>
                        <tr>
                          <td>{{__('admin.barcode')}}</td>
                          <td><svg id="barcode"></svg></td>
                        </tr>
                        
                        <tr>
                          <td>{{__('admin.code')}}</td>
                          <td>${data.code}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.first_name')}}</td>
                          <td>${data.first_name}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.last_name')}}</td>
                          <td>${data.last_name}</td>
                        </tr>
                        ${(data.nick_name)  ? '<tr><td>{{__('admin.nick_name')}}</td><td>' + data.nick_name + '</td></tr>' : '' }
                        ${(data.gender)  ? '<tr><td>{{__('admin.gender')}}</td><td>' + data.gender +'</td></tr>' : '' }
                        ${(data.dob)  ? '<tr><td>{{__('admin.dob')}}</td><td>' + data.dob + '</td></tr>' : '' }
                        ${(data.pob)  ? '<tr><td>{{__('admin.pob')}}</td><td>' + data.pob + '</td></tr>' : '' }
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