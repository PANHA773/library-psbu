@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.add_department') ?? 'Add Department'}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.add_department') ?? 'Add Department'}}</li>
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
                <h3 class="card-title">{{ __('admin.in_required') }}</h3>
              </div>
              <form id="departmentForm" action="{{ admin_url('settings/departments') }}" method="POST">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{__('admin.name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter department name" required>
                                @error('name')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">{{__('admin.code')}} <span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" id="code" placeholder="Enter unique code" required>
                                @error('code')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('admin.email')}}</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                @error('email')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="avatar">{{__('admin.profile_image')}}</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="avatar" name="avatar" accept="image/*">
                                    <label class="custom-file-label" for="avatar">Choose image</label>
                                  </div>
                                </div>
                                @error('avatar')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">{{__('admin.phone')}}</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone">
                                @error('phone')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">{{__('admin.address')}}</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="Enter address">
                                @error('address')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="is_active">{{__('admin.status')}}</label>
                                <div class="d-flex align-items-center" style="gap: 10px;">
                                  <input type="checkbox" name="is_active" id="is_active" style="width: 15px; height: 15px;" checked>
                                  <span>Active</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">{{__('admin.description')}}</label>
                                <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter description"></textarea>
                                @error('description')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
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
@stop
