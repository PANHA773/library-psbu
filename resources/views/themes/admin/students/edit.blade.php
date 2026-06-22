@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.edit_student')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.edit_student')}}</li>
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
                <h3 class="card-title">{{__('admin.in_required')}}</h3>
              </div>
              <form id="quickForm" action="{{ admin_url('peoples/students/'. $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">{{__('admin.first_name')}}</label>
                                <input type="text" name="first_name" class="form-control" value="{{$student->first_name}}" id="first_name"  placeholder="{{__('admin.enter_first_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="nick_name">{{__('admin.nick_name')}}</label>
                                <input type="text" name="nick_name" class="form-control" value="{{$student->nick_name}}" id="nick_name" placeholder="{{__('admin.enter_nick_name')}}">
                            </div>

                            <div class="form-group">
                                <label>{{__('admin.gender')}}</label>
                                <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                                  <option value="">{{__('admin.select_gender')}}</option>
                                  <option value="male" {{$student->gender == 'male' ? 'selected' : ''}}>{{__('admin.male')}}</option>
                                  <option value="female" {{$student->gender == 'female' ? 'selected' : ''}}>{{__('admin.female')}}</option>
                                
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phone">{{__('admin.phone')}}</label>
                                <input type="text" name="phone" class="form-control" value="{{$student->phone}}" id="phone" placeholder="{{__('admin.enter_phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="father_phone">{{__('admin.father_phone')}}</label>
                                <input type="text" name="father_phone" class="form-control" value="{{$student->father_phone}}" id="father_phone" placeholder="{{__('admin.enter_father_phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="father_phone">{{__('admin.mother_phone')}}</label>
                                <input type="text" name="mother_phone" class="form-control" value="{{ $student->mother_phone }}" id="mother_phone" placeholder="{{__('admin.enter_mother_phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('admin.batch')}}</label>
                                <input type="text" name="batch" class="form-control" id="batch"  value="{{$student->batch}}" placeholder="{{__('admin.enter_batch')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('admin.skill')}}</label>
                                <input type="text" name="skills" class="form-control" id="skills"  value="{{$student->skills}}"placeholder="{{__('admin.enter_skill')}}">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">{{__('admin.last_name')}}</label>
                                <input type="text" name="last_name" class="form-control" value="{{$student->last_name}}" id="last_name" placeholder="{{__('admin.last_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="dob">{{__('admin.dob')}}</label>
                                <input type="date" name="dob" class="form-control" id="dob" value="{{$student->dob}}" placeholder="{{__('admin.enter_dob')}}">
                            </div>
                            <div class="form-group">
                                <label for="pob">{{__('admin.pob')}}</label>
                                <input type="text" name="pob" class="form-control" id="pob" value="{{$student->pob}}" placeholder="{{__('admin.pob')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('admin.email')}}</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{$student->email}}" placeholder="{{__('admin.enter_email')}}">
                            </div>

                            <div class="form-group">
                                <label for="province_id">{{__('admin.province')}}</label>
                                <select class="form-control select2" name="province_id" id="province_id" style="width: 100%;">
                                  <option value="">{{__('admin.select_province')}}</option>
                                  @foreach($provinces as $province)
                                  <option value="{{ $province->id }}" {{$student->province_id == $province->id ? 'selected' : ''}}>{{ $province->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('admin.shift')}}</label>
                                <input type="text" name="shift" class="form-control" id="shift"  value="{{$student->shift}}"placeholder="{{__('admin.enter_shift')}}">
                            </div>

                            <div class="col-md-12">
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
                        </div>

                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                              <div class="card-header">
                                <h3 class="card-title">
                                  {{__('admin.description')}}
                                </h3>
                              </div>
                             
                              <div class="card-body">
                                <textarea id="summernote" name="description">{{ decode_html($student->description)}}</textarea>
                              </div>
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
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
@stop
