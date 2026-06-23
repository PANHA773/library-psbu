@extends(admin_layout('layouts.app'))
@section('content')

<style>
    .category-create-page .content-wrapper {
        background:
            radial-gradient(circle at top left, rgba(6, 95, 145, 0.10), transparent 28%),
            linear-gradient(180deg, #f4f9fc 0%, #eef5f9 100%);
    }

    .category-create-hero {
        margin-bottom: 20px;
    }

    .category-create-hero .hero-panel {
        background: linear-gradient(135deg, #0e4a6b 0%, #0b3550 100%);
        color: #fff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 20px 40px rgba(12, 32, 57, 0.18);
        overflow: hidden;
        position: relative;
    }

    .category-create-hero .hero-panel::after {
        content: "";
        position: absolute;
        right: -30px;
        top: -30px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .category-create-hero h1 {
        margin: 0 0 8px;
        font-size: 2rem;
        font-weight: 800;
    }

    .category-create-hero p {
        margin: 0;
        color: rgba(255, 255, 255, 0.82);
        max-width: 760px;
        line-height: 1.7;
    }

    .category-form-card {
        border: 0;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(12, 32, 57, 0.12);
    }

    .category-form-card .card-header {
        background: #fff;
        border-bottom: 1px solid rgba(12, 32, 57, 0.08);
        padding: 18px 20px;
    }

    .category-form-card .card-body {
        background: #fff;
        padding: 24px 20px;
    }

    .category-form-card label {
        font-weight: 700;
        color: #0b3550;
        margin-bottom: 8px;
    }

    .category-form-card .form-control,
    .category-form-card .select2-container .select2-selection--single {
        min-height: 46px;
        border-radius: 12px;
        border-color: rgba(12, 32, 57, 0.12);
        box-shadow: none;
    }

    .category-form-card .form-control:focus {
        border-color: #0e4a6b;
        box-shadow: 0 0 0 3px rgba(14, 74, 107, 0.12);
    }

    .category-form-card .card-footer {
        background: #fff;
        border-top: 1px solid rgba(12, 32, 57, 0.08);
        padding: 18px 20px;
    }

    .category-submit {
        min-width: 150px;
        border-radius: 12px;
        padding: 12px 18px;
        font-weight: 700;
        box-shadow: 0 14px 24px rgba(12, 32, 57, 0.16);
    }

    .category-preview-box {
        border: 1px dashed rgba(12, 32, 57, 0.14);
        border-radius: 16px;
        padding: 16px;
        background: #f8fbfd;
    }

    .category-preview-box img {
        width: 100%;
        max-width: 180px;
        border-radius: 14px;
        display: block;
    }

    @media (max-width: 991.98px) {
        .category-create-hero .hero-panel {
            padding: 22px;
        }
    }
</style>

<div class="content-wrapper category-create-page">
    <section class="content-header">
        <div class="container-fluid">
            <div class="category-create-hero">
                <div class="hero-panel">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1>Add Category</h1>
                            <p>Create a new book category for the admin library. You can also attach a parent category to keep the structure organized and easy to manage.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card category-form-card">
                        <div class="card-header">
                            <h3 class="card-title m-0">Please fill in the information below.</h3>
                        </div>

                        <form id="quickForm" action="{{ admin_url('settings/categories') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Please fix the following errors:</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="code">Code *</label>
                                            <input type="text" name="code" class="form-control" id="code" placeholder="Enter category code" value="{{ old('code') }}">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="name">Name *</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name" value="{{ old('name') }}">
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="slug">Slug *</label>
                                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter slug" value="{{ old('slug') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="parent">Parent</label>
                                            <select class="form-control select2" name="parent" id="parent" style="width: 100%;">
                                                <option value="">Select Parent Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('parent') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="image">Image</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label>Preview</label>
                                            <div class="category-preview-box">
                                                <img src="{{ asset('images/no_image.png') }}" alt="preview">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card card-outline card-info mb-0">
                                            <div class="card-header">
                                                <h3 class="card-title mb-0">Description</h3>
                                            </div>
                                            <div class="card-body">
                                                <textarea id="summernote" name="description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary category-submit">
                                    <i class="fa fa-save mr-1"></i> Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
