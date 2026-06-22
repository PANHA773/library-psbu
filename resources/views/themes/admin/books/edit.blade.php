@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.edit_book')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.edit_book')}}</li>
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
              <form id="quickForm" action="{{ admin_url('group_book/books/'. $book->id); }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">{{__('admin.code')}}</label>
                                <input type="text" name="code" class="form-control" id="code" value="{{ $book->code }}"  placeholder="{{__('admin.enter_book_code')}}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('admin.title')}}</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{$book->title}}" placeholder="{{__('admin.enter_book_title')}}">
                            </div>
                            <div class="form-group">
                                <label for="slug">{{__('admin.author_name')}}</label>
                                <input type="text" name="author_name" class="form-control" id="author_name" value="{{ $book->author; }}" placeholder="{{__('admin.enter_author_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="date">{{__('admin.author_date')}}</label>
                                <input type="date" name="author_date" value="{{ $book->author_date; }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">{{__('admin.slug')}}</label>
                                <input type="text" name="slug" class="form-control" id="slug" value="{{ $book->slug }}" placeholder="{{__('admin.enter_book_slug')}}">
                            </div>
                            
                            <div class="form-group">
                                <label>{{__('admin.category')}}</label>
                                <select class="form-control select2" name="category" id="category" style="width: 100%;">
                                  <option value="">{{__('admin.select_category')}}</option>
                                  @foreach($categories as $category)
                                  <option value="{{ $category->id }}" {{  ($category->id == $book->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{__('admin.category_language')}}</label>
                                <select class="form-control select2" name="category_lang_id" id="category_lang_id" style="width: 100%;">
                                  <option value="">{{__('admin.select_category_language')}}</option>
                                  @foreach($category_languages as $category_lang)
                                  <option value="{{ $category_lang->id }}" {{  ($category_lang->id == $book->category_lang_id) ? 'selected' : '' }}>{{ $category_lang->name }}</option>
                                  @endforeach
                                </select>
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
                          <div class="form-group">
                            <img src="{{ asset('uploads/books/'. $book->image) }}" width="100px" height="100px">
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
                                <textarea id="summernote" name="description"> {{ decode_html($book->details) }}</textarea>
                              </div>
                            </div>
                          </div> 
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('update')}}</button>
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