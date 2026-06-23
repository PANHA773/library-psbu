@extends(admin_layout('layouts.app'))
@section('content')

<style>
    .category-page .content-wrapper {
        background:
            radial-gradient(circle at top left, rgba(6, 95, 145, 0.08), transparent 30%),
            linear-gradient(180deg, #f4f9fc 0%, #eef5f9 100%);
    }

    .category-hero {
        margin-bottom: 20px;
    }

    .category-hero .hero-panel {
        background: linear-gradient(135deg, #0e4a6b 0%, #0b3550 100%);
        color: #fff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 20px 40px rgba(12, 32, 57, 0.18);
        position: relative;
        overflow: hidden;
    }

    .category-hero .hero-panel::after {
        content: "";
        position: absolute;
        right: -40px;
        top: -40px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .category-hero h1 {
        margin: 0 0 8px;
        font-size: 2rem;
        font-weight: 800;
    }

    .category-hero p {
        margin: 0;
        color: rgba(255, 255, 255, 0.82);
    }

    .category-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 20px;
    }

    .category-stat {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 18px;
        padding: 14px 16px;
        backdrop-filter: blur(8px);
    }

    .category-stat span {
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: rgba(255, 255, 255, 0.74);
        margin-bottom: 4px;
    }

    .category-stat strong {
        font-size: 1.4rem;
        font-weight: 800;
    }

    .category-card {
        border: 0;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(12, 32, 57, 0.12);
    }

    .category-card .card-header {
        background: #fff;
        border-bottom: 1px solid rgba(12, 32, 57, 0.08);
        padding: 18px 20px;
    }

    .category-card .card-body {
        background: #fff;
        padding: 0;
    }

    .category-actions {
        display: inline-flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .category-thumb {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        object-fit: cover;
        border: 1px solid rgba(12, 32, 57, 0.08);
        background: #f4f7fa;
        box-shadow: 0 8px 16px rgba(12, 32, 57, 0.08);
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(6, 95, 145, 0.08);
        color: #0e4a6b;
        font-weight: 700;
        font-size: 12px;
    }

    .category-badge.muted {
        background: rgba(12, 32, 57, 0.06);
        color: #667085;
    }

    .table-category thead th {
        background: #f7fafc;
        color: #0b3550;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid rgba(12, 32, 57, 0.08);
    }

    .table-category tbody td {
        vertical-align: middle;
        padding-top: 16px;
        padding-bottom: 16px;
        color: #243447;
    }

    .table-category tbody tr:hover {
        background: #f9fcff;
    }

    .category-actions .btn {
        border-radius: 10px;
        box-shadow: 0 10px 18px rgba(12, 32, 57, 0.08);
    }

    @media (max-width: 991.98px) {
        .category-stats {
            grid-template-columns: 1fr;
        }

        .category-hero .hero-panel {
            padding: 22px;
        }
    }
</style>

<div class="content-wrapper category-page">
    <section class="content-header">
        <div class="container-fluid">
            <div class="category-hero">
                <div class="hero-panel">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1>{{ __('admin.categories') }}</h1>
                            <p>{{ __('admin.report_description') }}</p>
                        </div>
                        <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
                            <a class="btn btn-light btn-lg px-4" href="{{ admin_url('settings/categories/create') }}">
                                <i class="fa fa-plus mr-2"></i>{{ __('admin.add_category') }}
                            </a>
                        </div>
                    </div>

                    <div class="category-stats">
                        <div class="category-stat">
                            <span>Total</span>
                            <strong>{{ isset($categories) ? $categories->count() : 0 }}</strong>
                        </div>
                        <div class="category-stat">
                            <span>Visible</span>
                            <strong>{{ isset($categories) ? $categories->whereNotNull('image')->count() : 0 }}</strong>
                        </div>
                        <div class="category-stat">
                            <span>Manage</span>
                            <strong>CRUD</strong>
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
                    <div class="card category-card">
                        <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
                            <h3 class="card-title m-0">{{ __('admin.categories') }}</h3>
                            <div class="category-badge">{{ __('admin.add_category') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table-category" class="table table-category table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('admin.image') }}</th>
                                            <th>{{ __('admin.code') }}</th>
                                            <th>{{ __('admin.name') }}</th>
                                            <th>{{ __('admin.slug') }}</th>
                                            <th>{{ __('admin.parent') }}</th>
                                            <th>{{ __('admin.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>
                                                    <img class="category-thumb" src="{{ $category->image ? asset('uploads/category/' . $category->image) : asset('images/no_image.png') }}" alt="{{ $category->name }}">
                                                </td>
                                                <td>{{ $category->code }}</td>
                                                <td>
                                                    <strong>{{ $category->name }}</strong>
                                                </td>
                                                <td>{{ $category->slug }}</td>
                                                <td>
                                                    @if(!empty($category->parent_name))
                                                        <span class="category-badge">{{ $category->parent_name }}</span>
                                                    @else
                                                        <span class="category-badge muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="category-actions">
                                                        <a href="javascript:void(0)" class="btn btn-info btn-sm view-modal" data-id="{{ $category->id }}" data-toggle="modal" data-target="#modal-lg">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ admin_url('settings/categories/' . $category->id . '/edit') }}" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ admin_url('settings/categories/' . $category->id) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-muted">
                                                    No categories found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    var site = { url: "<?= admin_url('settings/categories/') ?>", asset: "<?= asset('uploads/category/') ?>" };

    function htmlEntities(str) {
        return String(str).replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>').replace(/"/g, '"');
    }

    $(function () {
        $(document).on('click', '.view-modal', function () {
            var id = $(this).attr('data-id');
            var html = '';

            $("#get_id").val(id);

            $.ajax({
                url: site.url + '/' + id,
                dataType: "json",
                type: "get",
                async: true,
                success: function (data) {
                    html += `
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="${data.image ? site.asset + '/' + data.image : site.asset + '/no_image.png'}" alt="${data.name}" width="100%">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-strip">
                                <tbody>
                                    <tr>
                                        <td>{{ __('admin.code') }}</td>
                                        <td>${data.code}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('admin.name') }}</td>
                                        <td>${data.name}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('admin.description') }}</td>
                                        <td>${htmlEntities(data.description)}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    `;
                    $('.modal-body').empty().append(html);
                },
            });
        });
    });
</script>

@include('components.modal-lg')
@stop
