@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>About Page Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('') }}">Home</a></li>
                        <li class="breadcrumb-item active">About Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Page Content</h3>
                            <div class="card-tools pull-right">
                                <a href="{{ admin_url('about-page/edit') }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i> Edit Content
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($about)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Page Title:</strong></label>
                                            <p>{{ $about->title }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Subtitle:</strong></label>
                                            <p>{{ $about->subtitle }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Years of Service:</strong></label>
                                            <p>{{ $about->years_of_service }}+ years</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Badge Text:</strong></label>
                                            <p>{{ $about->badge_text }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Service Description:</strong></label>
                                            <p>{{ $about->service_description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Hero Description:</strong></label>
                                            <p>{{ $about->hero_description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Intro Description:</strong></label>
                                            <p>{{ $about->intro_description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Mission:</strong></label>
                                            <p>{{ $about->mission }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>Vision:</strong></label>
                                            <p>{{ $about->vision }}</p>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <p class="text-muted">
                                        <small>Last updated: {{ $about->updated_at }}</small>
                                    </p>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <p>No about page content found. <a href="{{ admin_url('about-page/edit') }}">Create one now</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
