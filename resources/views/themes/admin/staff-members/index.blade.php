@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Staff & Librarians</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('') }}">Home</a></li>
                        <li class="breadcrumb-item active">Staff & Librarians</li>
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Manage leadership and librarian profiles</h3>
                            <a href="{{ admin_url('staff-members/create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add New
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="80">Image</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Type</th>
                                            <th width="90">Order</th>
                                            <th width="100">Status</th>
                                            <th width="180">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($staffMembers as $member)
                                            <tr>
                                                <td>
                                                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                                </td>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->position }}</td>
                                                <td>{{ ucfirst($member->member_type) }}</td>
                                                <td>{{ $member->sort_order }}</td>
                                                <td>
                                                    @if($member->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-secondary">Hidden</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ admin_url('staff-members/' . $member->id . '/edit') }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ admin_url('staff-members/' . $member->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this staff member?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    No staff members found. Add the first profile to get started.
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

@endsection
