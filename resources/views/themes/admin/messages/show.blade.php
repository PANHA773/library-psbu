@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Message Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('messages.index') }}">Messages</a></li>
                        <li class="breadcrumb-item active">View Message</li>
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
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-envelope"></i> {{ $message->subject }}
                            </h3>
                            <div class="card-tools pull-right">
                                @if($message->status === 'unread')
                                    <span class="badge badge-danger">Unread</span>
                                @elseif($message->status === 'replied')
                                    <span class="badge badge-success">Replied</span>
                                @else
                                    <span class="badge badge-secondary">Read</span>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <strong>From:</strong><br>
                                    {{ $message->name }}<br>
                                    <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                </div>
                                <div class="col-md-6">
                                    <strong>Date:</strong><br>
                                    {{ $message->created_at->format('M d, Y H:i A') }}
                                </div>
                            </div>

                            <hr>

                            <div class="message-content">
                                <h5><strong>Subject:</strong> {{ $message->subject }}</h5>
                                <hr>
                                <div class="alert alert-light border">
                                    {{ nl2br($message->message) }}
                                </div>
                            </div>

                            @if($message->read_at)
                                <p class="text-muted text-sm">
                                    <i class="fas fa-check"></i> Read at {{ $message->read_at->format('M d, Y H:i A') }}
                                </p>
                            @endif

                            @if($message->replied_at)
                                <p class="text-success text-sm">
                                    <i class="fas fa-reply"></i> Replied at {{ $message->replied_at->format('M d, Y H:i A') }}
                                </p>
                            @endif
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('messages.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Messages
                            </a>
                            @if($message->status !== 'replied')
                                <form action="{{ route('messages.mark-as-replied', $message->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-reply"></i> Mark as Replied
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h3 class="card-title">Message Info</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <strong>ID:</strong> #{{ $message->id }}
                                </li>
                                <li class="mb-2">
                                    <strong>Status:</strong><br>
                                    @if($message->status === 'unread')
                                        <span class="badge badge-danger">Unread</span>
                                    @elseif($message->status === 'replied')
                                        <span class="badge badge-success">Replied</span>
                                    @else
                                        <span class="badge badge-secondary">Read</span>
                                    @endif
                                </li>
                                <li class="mb-2">
                                    <strong>Received:</strong><br>
                                    {{ $message->created_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                </li>
                                @if($message->read_at)
                                    <li class="mb-2">
                                        <strong>Read:</strong><br>
                                        {{ $message->read_at->format('M d, Y H:i A') }}
                                    </li>
                                @endif
                                @if($message->replied_at)
                                    <li class="mb-2">
                                        <strong>Replied:</strong><br>
                                        {{ $message->replied_at->format('M d, Y H:i A') }}
                                    </li>
                                @endif
                            </ul>

                            <hr>

                            <div>
                                <strong>Sender Info:</strong>
                                <ul class="list-unstyled mt-2">
                                    <li class="mb-2">
                                        <strong>Name:</strong><br>
                                        {{ $message->name }}
                                    </li>
                                    <li class="mb-2">
                                        <strong>Email:</strong><br>
                                        <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                    </li>
                                    <li>
                                        <a href="mailto:{{ $message->email }}" class="btn btn-sm btn-primary w-100">
                                            <i class="fas fa-reply"></i> Reply via Email
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
