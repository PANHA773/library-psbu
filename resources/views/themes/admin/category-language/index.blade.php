@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.category_languages')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.category_languages')}}</li>
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
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('settings/category_langauges/create') }}">{{__('admin.add_category_language')}}</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{__('admin.image')}}</th>
                    <th>{{__('admin.code')}}</th>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.slug')}}</th>
                    <th>{{__('admin.action')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($cate_lang as $category)
                  <tr class="text-center">
                    <td><img width="50px" src="{{ $category->image ? asset('uploads/category/'. $category->image) : asset('images/no_image.png');  }}"></td>
                    <td>{{  $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        
                        <form  action="{{ admin_url('settings/category_langauges/'. $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:void(0)" class="btn btn-info btn-sm view-modal" data-id="{{ $category->id}}" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-eye"></i></a>
                        <a href="{{ admin_url('settings/category_langauges/'. $category->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></a>
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

    var site =  {url: "<?= admin_url('settings/category_langauges/') ?>" , asset: "<?= asset('uploads/category_lang/') ?>" }

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>').replace(/"/g, '"');
    }

    $(function () {
    $(document).on('click', '.view-modal', function () {
        var id = $(this).attr('data-id');
        // alert(id);
        var html = '';
        $(".modal-title").text('{{__("admin.category_lange")}}');
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
