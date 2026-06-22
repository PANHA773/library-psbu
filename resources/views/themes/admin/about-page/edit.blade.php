@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit About Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ admin_url('about-page') }}">About Page</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Page Content Form</h3>
                        </div>

                        <form action="{{ admin_url('about-page/update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <!-- Title Section -->
                                <fieldset>
                                    <legend>Page Title & Subtitle</legend>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Page Title *</label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                    id="title" name="title"
                                                    value="{{ old('title', $about->title ?? '') }}"
                                                    placeholder="Enter page title">
                                                @error('title')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subtitle">Subtitle *</label>
                                                <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                                    id="subtitle" name="subtitle"
                                                    value="{{ old('subtitle', $about->subtitle ?? '') }}"
                                                    placeholder="Enter subtitle">
                                                @error('subtitle')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <!-- Hero Section -->
                                <fieldset>
                                    <legend>Hero Section</legend>

                                    <div class="form-group">
                                        <label for="hero_description">Hero Description *</label>
                                        <textarea class="form-control @error('hero_description') is-invalid @enderror"
                                            id="hero_description" name="hero_description" rows="4"
                                            placeholder="Enter hero section description">{{ old('hero_description', $about->hero_description ?? '') }}</textarea>
                                        @error('hero_description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="badge_text">Badge Text *</label>
                                                <input type="text" class="form-control @error('badge_text') is-invalid @enderror"
                                                    id="badge_text" name="badge_text"
                                                    value="{{ old('badge_text', $about->badge_text ?? '') }}"
                                                    placeholder="e.g., Welcome to Our Library">
                                                @error('badge_text')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="years_of_service">Years of Service *</label>
                                                <input type="number" class="form-control @error('years_of_service') is-invalid @enderror"
                                                    id="years_of_service" name="years_of_service" min="1"
                                                    value="{{ old('years_of_service', $about->years_of_service ?? '10') }}"
                                                    placeholder="Enter years">
                                                @error('years_of_service')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="service_description">Service Description *</label>
                                        <input type="text" class="form-control @error('service_description') is-invalid @enderror"
                                            id="service_description" name="service_description"
                                            value="{{ old('service_description', $about->service_description ?? '') }}"
                                            placeholder="Description of years of service">
                                        @error('service_description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </fieldset>

                                <!-- Intro Section -->
                                <fieldset>
                                    <legend>Introduction Section</legend>

                                    <div class="form-group">
                                        <label for="intro_description">Intro Description *</label>
                                        <textarea class="form-control @error('intro_description') is-invalid @enderror"
                                            id="intro_description" name="intro_description" rows="5"
                                            placeholder="Enter introduction description">{{ old('intro_description', $about->intro_description ?? '') }}</textarea>
                                        @error('intro_description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </fieldset>

                                <!-- Mission & Vision Section -->
                                <fieldset>
                                    <legend>Mission & Vision</legend>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mission">Mission *</label>
                                                <textarea class="form-control @error('mission') is-invalid @enderror"
                                                    id="mission" name="mission" rows="4"
                                                    placeholder="Enter mission statement">{{ old('mission', $about->mission ?? '') }}</textarea>
                                                @error('mission')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vision">Vision *</label>
                                                <textarea class="form-control @error('vision') is-invalid @enderror"
                                                    id="vision" name="vision" rows="4"
                                                    placeholder="Enter vision statement">{{ old('vision', $about->vision ?? '') }}</textarea>
                                                @error('vision')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <a href="{{ admin_url('about-page') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    fieldset {
        border: 2px solid #007bff;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    legend {
        width: auto;
        padding: 0 10px;
        color: #007bff;
        font-weight: 600;
    }
</style>

@endsection
