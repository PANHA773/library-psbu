<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact for License</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <style>
        body {
            background: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .contact-section {
            padding: 60px 20px;
            text-align: center;
        }

        .contact-section h1 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
        }

        .contact-section p {
            color: #555;
            margin-bottom: 50px;
        }

        .contact-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 6px 20px rgba(0,0,0,0.05);
            text-align: center;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
        }

        .contact-card i {
            font-size: 32px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .contact-card h5 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .contact-card a {
            color: #0d6efd;
            text-decoration: none;
        }

        .contact-card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="contact-section container">
    <div class="col-md-12 mb-4">
        <h1>Contact Developer for License</h1>
        <p>If you need a license key for your installation, you can reach me via any of the methods below.</p> 
        <a href="{{ route('license.form') }}" class="btn btn-success"><i class="fa fa-key"></i> Activate License Key</a>
    </div> 
    
    <div class="row g-4 justify-content-center">
        <!-- Phone -->
        <div class="col-md-4 col-sm-6">
            <div class="contact-card">
                <i class="bi bi-telephone"></i>
                <h5>Phone</h5>
                <p>+855 713567907</p>
                <a href="tel:+855713567907">Call Now</a>
            </div>
        </div>

        <!-- Telegram -->
        <div class="col-md-4 col-sm-6">
            <div class="contact-card">
                <i class="bi bi-telegram"></i>
                <h5>Telegram</h5>
                <p>@CHOU_CHAMNAN</p>
                <a href="https://t.me/chou_chamnan" target="_blank">Message Me</a>
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-4 col-sm-6">
            <div class="contact-card">
                <i class="bi bi-envelope"></i>
                <h5>Email</h5>
                <p>chou.chamnan.kh@gmail.com</p>
                <a href="mailto:chou.chamnan.kh@gmail.com">Send Email</a>
            </div>
        </div>

        <!-- WhatsApp -->
        <div class="col-md-4 col-sm-6">
            <div class="contact-card">
                <i class="bi bi-whatsapp"></i>
                <h5>WhatsApp</h5>
                <p>+855 71 35 67 907</p>
                <a href="https://wa.me/855713567907" target="_blank">Chat Now</a>
            </div>
        </div>

        <!-- Optional: Add more -->
        {{-- <div class="col-md-4 col-sm-6">
            <div class="contact-card">
                <i class="bi bi-discord"></i>
                <h5>Discord</h5>
                <p>YourDiscordUsername</p>
                <a href="https://discord.gg/xyz" target="_blank">Join Chat</a>
            </div>
        </div>  --}}
    </div>
</div>

</body>
</html>