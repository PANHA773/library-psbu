
@extends(admin_layout('layouts.app'))
@section('content')

<style>
  fieldset {
    border: 2px solid #333326;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
  }
</style>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.system_settings')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.system_settings')}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{__('admin.in_required')}}</h3>
              </div>
              <form action="{{ admin_url('settings') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                <fieldset >
                  <legend>Personal Information</legend>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="site_name">{{__('admin.site_name')}}</label>
                            <input type="text" class="form-control" name="site_name" value="{{ $setting->site_name }}" id="site_name" placeholder="Site name">
                          </div>
                          <div class="form-group">
                            <label for="student_prefix">{{__('admin.student_prefix')}}</label>
                            <input type="text" class="form-control" id="student_prefix" value="{{$setting->student_prefix}}" name="student_prefix" placeholder="{{__('student_prefix')}}">
                          </div>
                          
                          <div class="form-group">
                            <label for="lat">{{__('admin.lat')}}</label>
                            <input type="text" class="form-control" id="lat" name="lat" value="{{$setting->lat}}" placeholder="{{__('admin.lat')}}">
                        </div>
                        <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="captcha" type="checkbox" id="customCheckbox1" value="1" {!!$setting->captcha == 1 ? 'checked' : ''!!}>
                            <label for="customCheckbox1" class="custom-control-label">{{__('admin.login_with_captcha')}}</label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="iwidth">{{__('admin.ip_address_allow')}}</label>
                          <input type="text" class="form-control" id="iheight" name="ip_address_allow" value="{{$setting->ip_address_allow}}" placeholder="{{__('admin.ip_address_allow')}}">
                        </div>

                        <div class="form-group">
                              <label for="end_ip_address">{{__('admin.end_ip_address')}}</label>
                              <input type="text" id="end_ip_address" class="form-control" name="end_ip_address" value="{{ $setting->end_ip_address }}" placeholder="{{__('admin.end_ip_address')}}">
                        </div>

                      <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="avariable_register_page" type="checkbox" id="customCheckbox4" value="1" {!!$setting->avariable_register_page == 1 ? 'checked' : ''!!}>
                            <label for="customCheckbox4" class="custom-control-label">{{__('admin.avariable_register_page')}}</label>
                          </div>
                        </div>                  
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>{{__('admin.language')}}</label>
                        <select class="form-control select2" style="width: 100%;"  name="language" id="language">
                          <option value="kh" {{ $setting->language  == 'kh'? 'selected="selected"' :'' }} >Khmer</option>
                          <option value="us" {{ $setting->language  == 'us'? 'selected="selected"' :'' }}>English</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>{{__('admin.theme')}}</label>
                        <select class="form-control select2" style="width: 100%;"  name="theme" id="theme">
                          <option value="dark" {{ $setting->theme  == 'dark'? 'selected="selected"' :'' }} >Dark</option>
                          <option value="white" {{ $setting->theme  == 'white'? 'selected="selected"' :'' }}>White</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="iwidth">{{__('admin.iheight')}}</label>
                        <input type="text" class="form-control" id="iheight" name="iheight" value="{{$setting->iheight}}" placeholder="{{__('admin.iheight')}}">
                      </div>

                      <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="is_demo" type="checkbox" id="customCheckbox2" value="1" {!!$setting->is_demo == 1 ? 'checked' : ''!!}>
                            <label for="customCheckbox2" class="custom-control-label">{{__('admin.is_demo')}}</label>
                          </div>
                        </div>

                      <div class="form-group">
                            <label for="book_prefix">{{__('admin.book_prefix')}}</label>
                            <input type="text" class="form-control" value="{{ $setting->book_prefix }}" name="book_prefix" id="book_prefix" placeholder="{{__('admin.book_prefix')}}">
                      </div>

                      <div class="form-group">
                            <label for="lng">{{__('admin.lng')}}</label>
                            <input type="text" id="lng" class="form-control" name="lng" value="{{ $setting->lng }}" placeholder="{{__('admin.lng')}}">
                      </div>

                      <div class="form-group">
                            <label for="start_ip_address">{{__('admin.start_ip_address')}}</label>
                            <input type="text" id="lng" class="form-control" name="start_ip_address" value="{{ $setting->start_ip_address }}" placeholder="{{__('admin.start_ip_address')}}">
                      </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="borrow_prefix">{{__('admin.borrow_prefix')}}</label>
                          <input type="text" class="form-control" id="borrow_prefix" value="{{ $setting->borrow_prefix }}" name="borrow_prefix" placeholder="{{__('admin.borrow_prefix')}}">
                      </div>
                      <div class="form-group">
                        <label for="attandence_prefix">{{__('admin.attendance_prefix')}}</label>
                        <input type="text" class="form-control" id="attendance_prefix" name="attendance_prefix" value="{{$setting->attendance_prefix}}" placeholder="{{__('admin.attandence_prefix')}}">
                    </div>

                    <div class="form-group">
                        <label for="iwidth">{{__('admin.iwidth')}}</label>
                        <input type="text" class="form-control" id="iwidth" name="iwidth" value="{{$setting->iwidth}}" placeholder="{{__('admin.iwidth')}}">
                    </div>

                    <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="hidden_login_btn" type="checkbox" id="customCheckbox3" value="1" {!!$setting->hidden_login_btn == 1 ? 'checked' : ''!!}>
                            <label for="customCheckbox3" class="custom-control-label">{{__('admin.hidden_login_btn')}}</label>
                          </div>
                        </div>

                        <div class="form-group">
                            <label for="end_ip_address">{{__('admin.site_prefix')}}</label>
                            <input type="text" id="site_prefix" class="form-control" name="site_prefix" value="{{ $setting->site_prefix }}" placeholder="{{__('admin.site_prefix')}}">
                      </div>
                      <div class="form-group">
                            <label for="using_in_area">{{__('admin.using_in_area')}}</label>
                            <input type="text" id="using_in_area" class="form-control" name="using_in_area" value="{{ $setting->using_in_area }}" placeholder="{{__('admin.using_in_area')}}">
                      </div>

                      <div class="form-group">
                      <label for="exampleInputFile">{{__('admin.logo')}}</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="image" name="image">
                          <label class="custom-file-label" for="image">{{__('admin.choose_file')}}</label>
                        </div>
                      </div>
                    </div>
                    </div>
                </div>
                </fieldset>

                <fieldset>
                  <legend>License Developer</legend>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="license_dev_name">Developer Name</label>
                        <input type="text" class="form-control" name="license_dev_name" id="license_dev_name" value="{{ $setting->license_dev_name ?? '' }}" placeholder="Developer name">
                      </div>
                      <div class="form-group">
                        <label for="license_dev_phone">Phone</label>
                        <input type="text" class="form-control" name="license_dev_phone" id="license_dev_phone" value="{{ $setting->license_dev_phone ?? '' }}" placeholder="+855 ...">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="license_dev_telegram">Telegram</label>
                        <input type="text" class="form-control" name="license_dev_telegram" id="license_dev_telegram" value="{{ $setting->license_dev_telegram ?? '' }}" placeholder="@username or https://t.me/...">
                      </div>
                      <div class="form-group">
                        <label for="license_dev_email">Email</label>
                        <input type="email" class="form-control" name="license_dev_email" id="license_dev_email" value="{{ $setting->license_dev_email ?? '' }}" placeholder="email@example.com">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="license_dev_whatsapp">WhatsApp</label>
                        <input type="text" class="form-control" name="license_dev_whatsapp" id="license_dev_whatsapp" value="{{ $setting->license_dev_whatsapp ?? '' }}" placeholder="+855 ...">
                      </div>
                      <div class="form-group">
                        <label for="license_dev_note">Note</label>
                        <textarea class="form-control" name="license_dev_note" id="license_dev_note" rows="4" placeholder="Short support note">{{ $setting->license_dev_note ?? '' }}</textarea>
                      </div>
                    </div>
                  </div>
                </fieldset>
          
                  <div class="col-md-12">
                    <div class="card card-outline card-info">
                      <div class="card-header">
                        <h3 class="card-title">
                          {{__('admin.description')}}
                        </h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <textarea id="summernote" name="description"></textarea>
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
    </section>
  </div>
  @stop
