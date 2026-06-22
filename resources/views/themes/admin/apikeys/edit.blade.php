@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.edit_api_key')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.edit_api_key')}}</li>
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
              <form id="quickForm" action="{{ admin_url('shop_settings/apikeys/'. $apikey->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="name">{{__('admin.name')}}</label>
                              <input type="text" name="name" class="form-control" id="name" value="{{ $apikey->name; }}"  placeholder="{{__('admin.enter_name')}}">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="status">{{__('admin.status')}}</label>
                              @php $is_selected = $apikey->status; @endphp
                              <select class="form-control select2" style="width: 100%;" name="status" id="status">
                                <option value="" disabled>{{__('admin.select_status')}}</option>
                                <option value="1" {{ $is_selected == 1 ? 'checked' : '' }}>Active</option>
                                <option value="0" {{ $is_selected == 0 ? 'checked' : '' }}>Inactive</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <label>API Key Scopes</label><br>
                          @php $selected = json_decode($apikey->scopes, true) ?? []; @endphp
                          <div class="row ">
                            <input type="checkbox" class="mx-2" name="scopes[]" value="read" {{ in_array('read', $selected) ? 'checked' : '' }}> <span>Read</span><br>
                            <input type="checkbox" class="mx-2" name="scopes[]" value="write" {{ in_array('write', $selected) ? 'checked' : '' }}> <span>Write</span><br>
                            <input type="checkbox" class="mx-2" name="scopes[]" value="delete" {{ in_array('delete', $selected) ? 'checked' : '' }}> <span>Delete</span><br>
                          </div>

                        </div>
                        
                    </div>
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

@endsection