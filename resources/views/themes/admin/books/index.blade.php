@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper no-print">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('admin.books') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{ __('admin.books') }}</li>
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
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('group_book/books/create') }}">{{__('admin.add_book')}}</a>
              </div>

              <div class="table-responsive">
              <div class="card-body ">
                <table id="book-table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th>{{ __('admin.image') }}</th>
                      <th>{{ __('admin.code') }}</th>
                      <th>{{ __('admin.title') }}</th>
                      <th>{{ __('admin.slug') }}</th>
                      <th>{{ __('admin.category') }}</th>
                      <th>{{ __('admin.category_language') }}</th>
                      <th>Department</th>
                      <th>{{ __('admin.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($books as $book)
                  <tr class="text-center view-modal" data-id="{{ $book->id}}" data-toggle="modal" data-target="#modal-lg">
                    <td></td>
                    <td><img width="50px" src="{{ $book->image ? asset('uploads/books/'. $book->image) : asset('images/no_image.png');  }}"></td>
                    <td>{{  $book->code }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->slug }}</td>
                    <td>{{ $book->category_name }}</td>
                    <td>{{ $book->cate_lang_name }}</td>
                    <td>{{ $book->department_name ?? 'N/A' }}</td>
                    <td class="col-2">
                        <form  action="{{ admin_url('group_book/books/'. $book->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            @php
                              $currentUser = auth()->user();
                              $canManageBook = $currentUser->hasAnyRole(['Owner', 'Admin', 'Teacher'])
                                  || ($currentUser->user_type === 'department' && (int) $book->created_by === (int) auth()->id());
                            @endphp
                            @if($canManageBook && auth()->user()->can('book-edit'))
                            <a href="{{ admin_url('group_book/books/'. $book->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            @endif
                            @if($canManageBook && auth()->user()->can('book-delete'))
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            @endif
                        </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="9" class="text-center">No books found.</td>
                  </tr>
                  @endforelse
                </table>
                <div class="mt-3">
                  {{ $books->links() }}
                </div>
              </div>
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
  <script>
  
   $("#checkAll").on("click", function () {
    $(".row-check").prop("checked", this.checked);
});
  </script>
  @include('components.modal-lg')
@stop
