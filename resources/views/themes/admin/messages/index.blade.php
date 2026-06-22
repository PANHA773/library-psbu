@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Messages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('') }}">Home</a></li>
                        <li class="breadcrumb-item active">Messages</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-envelope"></i> All Messages
                                @if($unreadCount > 0)
                                    <span class="badge badge-danger">{{ $unreadCount }} Unread</span>
                                @endif
                            </h3>
                            <div class="card-tools pull-right">
                                @if($unreadCount > 0)
                                    <a href="{{ admin_url('messages') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-check"></i> Mark All as Read
                                    </a>
                                @endif
                                @if($messages->count() > 0)
                                    <form action="{{ route('messages.deleteRead') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete all read messages?')">
                                            <i class="fas fa-trash"></i> Delete Read
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            @if($messages->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Status</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($messages as $message)
                                                <tr class="{{ $message->status === 'unread' ? 'table-active font-weight-bold' : '' }}">
                                                    <td>
                                                        @if($message->status === 'unread')
                                                            <span class="badge badge-danger">Unread</span>
                                                        @elseif($message->status === 'replied')
                                                            <span class="badge badge-success">Replied</span>
                                                        @else
                                                            <span class="badge badge-secondary">Read</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $message->name }}</td>
                                                    <td>
                                                        <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                                    </td>
                                                    <td>{{ $message->subject }}</td>
                                                    <td>
                                                        <span title="{{ $message->message }}">
                                                            {{ Str::limit($message->message, 50) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $message->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('messages.show', $message->id) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" role="status" aria-live="polite">
                                            Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} messages
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers">
                                            {{ $messages->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <p>No messages yet. When users submit the contact form, their messages will appear here.</p>
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
