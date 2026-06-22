@extends(admin_layout('layouts.app'))
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('admin.book_report') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.books') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form method="POST" action="{{ admin_url('reports/books') }}">
                    @csrf
                    @method('POST')
                    <div class="card card-default collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('admin.date_filter') }}</h3>
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
                                        <label>{{ __('admin.start_date') }}</label>
                                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                            name="start_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('admin.end_date') }}</label>
                                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                            name="end_date">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('admin.filter') }}</button>
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
                            <h3 class="card-title m-1">{{ __('admin.report_description') }}</h3>
                            <div class="float-end">
                                <a href="" class="btn btn-default"><i class="fas fa-file-image"></i></a>
                                <a href="" class="btn btn-default" title="Download as pdf"><i
                                        class="fas fa-file-pdf"></i></a>
                                <a href="{{ admin_url('') }}" class="btn btn-default"><i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="book-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('admin.image') }}</th>
                                        <th>{{ __('admin.code') }}</th>
                                        <th>{{ __('admin.title') }}</th>
                                        <th>{{ __('admin.slug') }}</th>
                                        <th>{{ __('admin.category') }}</th>
                                        <th>{{ __('admin.category_language') }}</th>
                                        <th>{{ __('admin.date') }}</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr class="text-center view-modal" data-id="{{ $book->id}}" data-toggle="modal" data-target="#modal-lg">
                                            <td><img width="50px"
                                                    src="{{ $book->image ? asset('uploads/books/' . $book->image) : asset('images/no_image.png') }}">
                                            </td>
                                            <td>{{ $book->code }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->slug }}</td>
                                            <td>{{ $book->category_name }}</td>
                                            <td>{{ $book->cate_lang_name }}</td>
                                            <td>{{ $book->created_at }}</td>
                                            {{-- <td>
                        <button class="btn btn-info btn-sm view-modal" data-id="{{ $book->id}}" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-eye"></i></button>
                        
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
    var site =  {url: "<?= admin_url('group_book/books/') ?>" , asset: "<?= asset('uploads/books/') ?>" }
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
              $(".modal-title").text(data.title);
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
                          <td>{{__('admin.title')}}</td>
                          <td>${data.title}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.author')}}</td>
                          <td>${data.author}</td>
                        </tr>

                        ${(data.author_date)  ? '<tr><td>{{__("admin.author_date")}}</td><td>' + data.author_date + '</td></tr>' : '' }
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
