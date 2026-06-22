<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate License</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light d-flex align-items-center justify-content-center vh-100">

<div class="card p-4 shadow-lg" style="width: 400px; background: #1e1e1e; border-radius: 15px;">
    <h4 class="text-center text-info mb-3">🔐 Activate License</h4>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('license.activate') }}">
        @csrf
        <div class="mb-3">
            <label for="license_key" class="form-label text-white">License Key</label>
            <textarea name="license_key" id="license_key" class="form-control" rows="4" placeholder="Paste your license key here..." required></textarea>
        </div>

        @error('license_key')
            <div class="text-danger small mb-2">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-info w-100">Activate</button>
    </form>
    <a href="{{ route('license.contact'); }}" class="btn btn-danger mt-2 w-100">Back</a>

    <div class="text-center mt-3 small text-secondary">
        Need help? Contact <a href="tel:+855713567907" class="text-warning">+855 71 35 67 907</a><br>
        or Telegram: <a href="https://t.me/chou_chamnan" class="text-info">@CHOU_CHAMNAN</a>
    </div>
</div>

</body>
</html>