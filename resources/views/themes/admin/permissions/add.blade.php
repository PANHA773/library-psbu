@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.add_permission')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.add_permission')}}</li>
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
              <form id="quickForm" action="{{ admin_url('settings/permissions') }}" method="POST">
                @csrf
                @method('POST')
                <div class="card-body">
                    {{-- <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="name">{{__('admin.name')}}</label>
                              <input type="text" name="name" class="form-control" id="name"  placeholder="{{__('admin.enter_name')}}">
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                              <label for="group_name">{{__('admin.group_name')}}</label>
                              <input type="text" name="group_name" class="form-control" id="group_name"  placeholder="{{__('admin.enter_group_name')}}">
                          </div>
                    </div> --}}
                    <div id="dynamic-fields">
                        <div class="row mb-2 field-group">
                            <div class="col-md-5">
                                <input type="text" name="name[]" class="form-control" id="name"  placeholder="{{__('admin.enter_name')}}">
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="group_name[]" class="form-control" id="group_name_1"  placeholder="{{__('admin.enter_group_name')}}">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-btn d-none">×</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" id="add-more">
                        + Add More
                    </button>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('admin.submit')}}</button>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script>
document.getElementById('add-more').addEventListener('click', function () {
    const container = document.getElementById('dynamic-fields');
   
    const fieldHTML = `
        <div class="row mb-2 field-group">
            <div class="col-md-5">
                <input type="text" name="name[]" class="form-control" id="name"  placeholder="{{__('admin.enter_name')}}">
            </div>
            <div class="col-md-5">
                <input type="text" name="group_name[]" class="form-control" id="group_name" placeholder="{{__('admin.enter_group_name')}}">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-btn">×</button>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', fieldHTML);
});

// Remove Field
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-btn')) {
        e.target.closest('.field-group').remove();
    }
});
</script>

@endsection


