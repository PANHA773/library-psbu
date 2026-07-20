@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.profile')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.user_profile')}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  @php
                    $profileAvatarPath = $user->avatar ? public_path('uploads/profile/' . $user->avatar) : null;
                    $profileAvatarUrl = ($user->avatar && file_exists($profileAvatarPath))
                        ? asset('uploads/profile/'. $user->avatar)
                        : ($user->gender == 'male' ? asset('uploads/profile/male.png') : asset('uploads/profile/female.png'));
                  @endphp
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ $profileAvatarUrl }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                <p class="text-muted text-center">{{ Auth::user()->major}}</p>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{__('admin.about_me')}}</h3>
              </div>
              <div class="card-body">
                @if(Auth::user()->education)
                <strong><i class="fas fa-book mr-1"></i> {{__('admin.education')}}</strong>
                <p class="text-muted">
                  {{Auth::user()->education}}
                </p>
                @endif
                @if(Auth::user()->education && Auth::user()->address)
                <hr>
                @endif
                @if(Auth::user()->address)
                <strong><i class="fas fa-map-marker-alt mr-1"></i>{{__('admin.location')}}</strong>
                <p class="text-muted">{{ Auth::user()->address}}</p>
                @endif
                @if(Auth::user()->skills && Auth::user()->address)
                <hr>
                @endif
                @if(Auth::user()->skills)
                <strong><i class="fas fa-pencil-alt mr-1"></i>{{__('admin.skills')}}</strong>
                <p class="text-muted">
                  <?php 
                    $skills = explode(",", Auth::user()->skills);
                    $color =  ['text-danger','text-success', 'text-info', 'text-warning', 'text-primary'];
                  ?>
                  @for ($i = 0; $i < count($skills); $i++)
                    <span class="tag {{ $color[$i]}}">{{ $skills[$i] }}</span>
                  @endfor
                </p>
                @endif
                @if(Auth::user()->skills && Auth::user()->description)
                <hr>
                @endif
                @if(Auth::user()->description)
                <strong><i class="far fa-file-alt mr-1"></i>{{__('admin.notes')}}</strong>
                <p class="text-muted">{{Auth::user()->description}}</p>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#edit_profile" data-toggle="tab">{{__('admin.edit')}}</a></li>
                  <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">{{__('admin.change_password')}}</a></li>
                  <li class="nav-item"><a class="nav-link" href="#avatar" data-toggle="tab">{{__('admin.avatar')}}</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="edit_profile">
                    <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST">
                      @csrf
                      @method('PATCH')
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">{{__('admin.name')}}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$user->name }}" id="name" name="name" placeholder="{{__('admin.enter_your_name')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">{{__('admin.email')}}</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" value="{{$user->email}}" name="email" id="email" placeholder="{{__('admin.enter_your_email')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">{{__('admin.phone')}}</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="phone" value="{{ $user->phone }}" name="phone" placeholder="{{__('admin.enter_your_phone')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">{{__('admin.gender')}}</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" style="width: 100%;"  name="gender" id="gender">
                            <option  value="male" {{ $user->gender == 'male' ? 'selected="selected"' :'' }} >{{__('admin.male')}}</option>
                            <option  value="female" {{ $user->gender == 'female' ? 'selected="selected"' :'' }} >{{__('admin.female')}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">{{__('admin.address')}}</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="address" name="address" id="address"  placeholder="{{__('admin.enter_your_address')}}">{{ $user->address }}</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="experience" class="col-sm-2 col-form-label">{{__('admin.experience')}}</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="experience" name="experience" placeholder="{{__('admin.enter_your_experience')}}">{{ $user->experience }}</textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="eduction" class="col-sm-2 col-form-label">{{__('admin.education')}}</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="education" name="education" placeholder="{{__('admin.enter_your_education')}}">{{ $user->education }}</textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="major" class="col-sm-2 col-form-label">{{__('admin.major')}}</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="major" name="major" placeholder="{{__('admin.enter_your_major')}}">{{ $user->major }}</textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="skills" class="col-sm-2 col-form-label">{{__('admin.skills')}}</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="skills" value="{{ $user->skills }}" name="skills" placeholder="{{__('admin.enter_your_skills')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">{{__('admin.notes')}}</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="description" name="description" placeholder="{{__('admin.enter_your_note')}}">{{ $user->description }}</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" id="is_agree" name="is_agree" {{ $user->is_agree ? 'checked' : ''}}> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">{{__('admin.submit')}}</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="change_password">
                    <form class="form-horizontal" action="{{ route('password.update') }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">{{__('admin.current_password')}}</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="current_password" id="current_password" placeholder="{{__('admin.enter_current_password')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">{{__('admin.new_password')}}</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" id="password" placeholder="{{__('admin.enter_new_password')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">{{__('admin.confirm_password')}}</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{__('admin.enter_confirm_password')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">{{__('admin.change_password')}}</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="avatar">
                    <form class="form-horizontal" method="POST" action="{{ admin_url('profile/update_avatar') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">{{__('admin.avatar')}}</label>
                        <div class="col-sm-10">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profile" name="profile">
                            <label class="custom-file-label" for="profile">{{__('admin.choose_file')}}</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">{{__('admin.update_avatar')}}</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @stop
  
