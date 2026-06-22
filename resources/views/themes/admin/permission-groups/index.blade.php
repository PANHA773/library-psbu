@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper no-print">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.permission_groups')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.permission_groups')}}</li>
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
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('settings/permission-groups/create') }}">{{__('admin.add_permission_group')}}</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.action')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($groups as $gp)
                  <tr class="text-center">
                    <td>{{ $gp->name }}</td>
                    <td class="col-sm-1">
                      <form action="{{ admin_url('settings/permission-groups/'. $gp->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                      
                        <a href="{{ admin_url('settings/permission-groups/'. $gp->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                       
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

@if (session('remove_br')) 
    <script>
      if(localStorage.getItem('britems')) {
        localStorage.removeItem('britems');
      }

      if(localStorage.getItem('bstudent')) {
        localStorage.removeItem('bstudent');
      }
    </script>
    {{Session::forget('remove_br');}}
@endif

<script>
    var site =  {url: "<?= admin_url('borrowers/') ?>" , asset_book: "<?= asset('uploads/books/') ?>", asset: "<?= asset('uploads/student/') ?>", no_image: "<?= asset('images/no_image.png') ?>" };

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>').replace(/"/g, '"');
    }

    $(function () {
    $(document).on('click', '.view-modal', function () {
        var id = $(this).attr('data-id');
        var html = '';
        var html1 = '';

        $.ajax({
            url: site.url + '/' + id,
            dataType: "json",
            type: "get",
            async: true,
            success: function (data) {    
               $(".modal-title").text('{{__("admin.borrower_details")}}');
                html += `
                <div class="row mb-4">
                  <div class="col-md-4">
                    <img src="${data.borrow.image ? site.asset + '/' + data.borrow.image : site.no_image }" alt="${data.borrow.name}" width="100%">
                  </div>
                  <div class="col-md-8">
                    <table class="table table-bordered table-strip">
                      <tbody>
                        <tr>
                          <td>{{__('admin.code')}}</td>
                          <td>${data.borrow.reference_no}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.full_name')}}</td>
                          <td>${data.borrow.first_name +' '+ data.borrow.last_name}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.status')}}</td>
                          <td>${data.borrow.status}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.start_date_borrowed')}}</td>
                          <td>${data.borrow.start_date}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.start_date_repayed')}}</td>
                          <td>${data.borrow.end_date}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                `;
              var i = 1;
              $.each(data.books , function(index, value) {
                html1 += `
                    <tr>
                      <td class="col-1"><img src="${value.image ? site.asset_book + '/' + value.image : site.no_image }" alt="${value.title}" width="100%"></td>
                      <td>${value.code}</td>
                      <td>${value.title}</td>
                      <td>${value.borrow_quantity}</td>
                    </tr>
                `;
              i ++;
              });
              var header = `
                  <div class="col-md-12">
                    <table class="table table-bordered table-strip">
                      <thead>
                        <tr>
                          <th>{{__('admin.num')}}</th>
                          <th>{{__('admin.code')}}</th>
                          <th>{{__('admin.title')}}</th>
                          <th>{{__('admin.quantity')}}</th>
                        </tr>
                      </thead>
                      <tbody>` + html1 +`
                      </tbody>
                    </table>
                  </div>
                `;
                $('.modal-body').empty().append(html + header);
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
