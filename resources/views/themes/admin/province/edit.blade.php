@extends(admin_layout('layouts.app'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.edit_province')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.edit')}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Please fill in the information below. The field labels marked with * are required input fields.</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action="{{ admin_url('province/'. $province->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">{{__('admin.zip_code')}}</label>
                                <input type="text" name="zip_code" value="{{ $province->zip_code }}" class="form-control" id="zip_code"  placeholder="{{__('enter_province_zip_code')}}">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputFile">{{__('admin.image')}}</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">{{__('admin.choose_file')}}</label>
                              </div>
                            </div>
                          </div>
                            
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                <label for="name">{{__('admin.name')}}</label>
                                <input type="text" name="name" value="{{ $province->name }}" class="form-control" id="name" placeholder="{{__('enter_province_name')}}">
                          </div>
                          <div class="form-group">
                              <img src="{{ asset('uploads/province/'.$province->image); }}"  width="200px" height="200px">
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                              <div class="card-header">
                                <h3 class="card-title">
                                  {{__('admin.description')}}
                                </h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                <textarea id="summernote" name="description">{{ decode_html($province->details) }}</textarea>
                              </div>
                              <div class="card-footer">
                    
                              </div>
                            </div>
                          </div>
                          <!-- /.col-->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('admin.submit')}}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@stop