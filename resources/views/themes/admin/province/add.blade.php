@extends(admin_layout('layouts.app'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.add_province')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.add_province')}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Please fill in the information below. The field labels marked with * are required input fields.</h3>
              </div>
              <form id="quickForm" action="{{ admin_url('settings/provinces') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">{{__('admin.zip_code')}}</label>
                                <input type="text" name="zip_code" class="form-control" id="zip_code"  placeholder="{{__('enter_zip_code')}}">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <label for="name">{{__('admin.name')}}</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="{{__('enter_zip_code')}}">
                              </div>
                        </div>
                      
                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                              <div class="card-header">
                                <h3 class="card-title">
                                  {{__('admin.description')}}
                                </h3>
                              </div>
                              <div class="card-body">
                                <textarea id="summernote" name="description"></textarea>
                              </div>
                              <
                            </div>
                          </div>
                          <!-- /.col-->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('submit')}}</button>
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