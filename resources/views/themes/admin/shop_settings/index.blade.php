
@extends(admin_layout('layouts.app'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.site_settings')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.site_settings')}}</li>
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
                <h3 class="card-title">Please update the information below. The field labels marked with * are required input fields.</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ admin_url('shop_settings') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                @method('POST')
                <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="site_name">{{__('admin.site_name')}}</label>
                            <input type="text" class="form-control" name="shop_name" value="{{ $shop_setting->shop_name }}" id="shop_name" placeholder="shop name">
                          </div>
                          <div class="form-group">
                            <label for="site_name">{{__('admin.site_description')}}</label>
                            <input type="text" class="form-control" name="shop_description" value="{{ $shop_setting->description }}" id="shop_description" placeholder="Shop Description">
                          </div>
                          <div class="form-group">
                            <label for="site_name">{{__('admin.product_page_description')}}</label>
                            <input type="text" class="form-control" name="product_page" value="{{ $shop_setting->products_description }}" id="product_page" placeholder="Product page">
                          </div>
                          <div class="form-group">
                            <label for="site_name">{{__('admin.phone')}}</label>
                            <input type="text" class="form-control" name="phone" value="{{ $shop_setting->phone }}" id="phone" placeholder="Phone number">
                          </div>
                          
                          <div class="form-group">
                            <label for="site_name">{{__('admin.email')}}</label>
                            <input type="text" class="form-control" name="email" value="{{ $shop_setting->email }}" id="email" placeholder="Email">
                          </div>

                          <div class="form-group">
                            <label for="payment_text">{{__('admin.payment_text')}}</label>
                            <input type="text" class="form-control" name="payment_text" value="{{ $shop_setting->payment_text }}" id="payment_text" placeholder="{{__('admin.payment_text')}}">
                          </div>
                          
                          <div class="form-group">
                            <label>Private shop(for member only)</label>
                            <select class="form-control select2" style="width: 100%;"  name="private_shop" id="private_shop">
                              <option  value="0" {{ ($shop_setting->private == 0) ? 'selected': '' }}>{{__('admin.no')}}</option>
                              <option  value="1" {{ ($shop_setting->private == 1) ? 'selected': '' }}>{{__('admin.yes')}}</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="site_name">{{__('admin.keyword')}}</label>
                            <input type="text" class="form-control" name="key_word" id="key_word" value="{{ $shop_setting->keyword }}" id="key_word" placeholder="Keywork">
                          </div>
                          <div class="form-group">
                            <label for="site_name">{{__('admin.address')}}</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $shop_setting->address }}" id="address" placeholder="Address">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">{{__('admin.logo')}}</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                <label class="custom-file-label" for="image">{{__('admin.choose_file')}}</label>
                              </div>
                             
                            </div>
                          </div>
                    </div>
    
                    <div class="col-md-6">
                      
                        <div class="form-group">
                            <label for="">{{__('admin.shipping')}}</label>
                            <input type="text" class="form-control" name="shipping" value="0" id="shipping" placeholder="Shipping">
                        </div>      
                      <div class="form-group">
                        <label for="">{{__('admin.follow_text')}}</label>
                        <input type="text" class="form-control" name="follow_text" id="follow_text" value="{{ $shop_setting->follow_text }}" placeholder="Follow text">
                    </div>
                        <div class="form-group">
                          <label for="">{{__('admin.facebook')}}</label>
                          <input type="text" class="form-control" name="facebook" value="{{ $shop_setting->facebook }}" placeholder="Facebook">
                      </div>
                      <div class="form-group">
                        <label for="">{{__('admin.twitter')}}</label>
                        <input type="text" class="form-control" name="twitter" value="{{ $shop_setting->twitter }}" id="twitter" placeholder="Twitter">
                    </div>
                    <div class="form-group">
                      <label for="">{{__('admin.google_plus')}}</label>
                      <input type="text" class="form-control" name="google_plus" id="google_plus" value="{{ $shop_setting->google_plus }}" placeholder="{{__('admin.google_plus')}}">
                  </div>
                  <div class="form-group">
                      <label for="">{{__('admin.instagram')}}</label>
                      <input type="text" class="form-control" name="instagram"  id="instagram" value="{{ $shop_setting->instagram }}" placeholder="{{__('admin.instagram')}}">
                  </div>
                  <div class="form-group">
                    <label for="">{{__('admin.message_cookie')}}</label>
                    <input type="text" class="form-control" name="message_cookie" id="message_cookie" value="{{ $shop_setting->cookie_message }}" placeholder="{{__('admin.messge_cookie')}}">
                </div>
                <div class="form-group">
                  <label for="">{{__('admin.cookie_link')}}</label>
                  <input type="text" class="form-control" name="cookie_link" id="cookie_link" value="{{ $shop_setting->cookie_link }}" placeholder="{{__('admin.cookie_link')}}">
              </div>
                </div>
                </div>
                  <div class="col-md-12">
                    <div class="card card-outline card-info">
                      <div class="card-header">
                        <h3 class="card-title">
                          {{__('admin.bank_details')}}
                        </h3>
                      </div>
                      <div class="card-body">
                        <textarea id="summernote" name="bank_details" id="bank_destails"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('admin.update')}}</button>
                </div>
              </form>
            </div>      
      </div>
    </section>
  </div>
  @stop