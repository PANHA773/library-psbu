@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.attendance_list')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.attendance_list')}}</li>
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
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('attendances/create') }}">{{__('admin.add_attendance')}}</a>
              </div>
              <div class="card-body">
                <table id="table-category" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{__('admin.no')}}</th>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.gender')}}</th>
                    <th>{{__('admin.date')}}</th>
                    <th>{{__('admin.skills')}}</th>
                    <th>{{__('admin.batch')}}</th>
                    <th>{{__('admin.shift')}}</th>
                    <th>{{__('admin.action')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    @foreach($attendances as $attendance)
                  <tr class="text-center view-modal" data-id="{{ $attendance->id}}" data-toggle="modal" data-target="#modal-lg">
                    <td>{{  $i; }}</td>
                    <td>{{ $attendance->student_name }}</td>
                    <td>{{ $attendance->student_gender }}</td>
                    <td>{{ date('Y-m-d', strtotime($attendance->created_at)) }}</td>
                    <td>{{ $attendance->student_skills; }}</td>
                    <td>{{ $attendance->student_batch; }}</td>
                    <td>{{ $attendance->student_shift; }}</td>
                    <td class="col-2">
                        <form  action="{{ admin_url('attendances/delete/'. $attendance->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            {{-- <a href="{{ admin_url('settings/attendances/'. $attendance->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> --}}
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  <?php $i++; ?>
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
      if(localStorage.getItem('student_attendances')) {
        localStorage.removeItem('student_attendances');
      }
    </script>
    {{Session::forget('remove_br');}}
@endif

  <script>

    var site =  {url: "<?= admin_url('attendances/show/') ?>" , asset: "<?= asset('uploads/student/') ?>" }

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>').replace(/"/g, '"');
    }

    function stripHtml(html)
    {
      let tmp = document.createElement("div");
      tmp.innerHTML = html;
      return tmp.textContent || tmp.innerText || "";
    }

    $(function () {

    $(document).on('click', '.view-modal', function () {
        var id = $(this).attr('data-id');
        // alert(id);
        var html = '';

        // alert(site.url);

        $.ajax({
            url: site.url + '/' + id ,
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
                          <td>{{__('admin.attendance_code')}}</td>
                          <td>${data.code}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.name')}}</td>
                          <td>${data.first_name +' '+ data.last_name}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.gender')}}</td>
                          <td>${data.gender}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.date')}}</td>
                          <td>${data.created_at}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.skills')}}</td>
                          <td>${data.skills}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.batch')}}</td>
                          <td>${data.batch}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.shift')}}</td>
                          <td>${data.shift}</td>
                        </tr>
                        <tr>
                          <td>{{__('admin.description')}}</td>
                          <td>${ stripHtml(data.description) }</td>
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
