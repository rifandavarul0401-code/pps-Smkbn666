<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Login - Sistem Poin Pelanggaran Siswa</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body {
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 50%, #2c3e50 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                font-family: 'Georgia', 'Times New Roman', serif;
            }
            .login-container {
                max-width: 450px;
                margin: 0 auto;
            }
            .login-card {
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.15), 0 0 0 1px rgba(255,255,255,0.1);
                overflow: hidden;
            }
            .card-header {
                background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
                border-bottom: 1px solid rgba(255,255,255,0.1);
                padding: 3rem 2rem 2rem;
                text-align: center;
                color: white;
                position: relative;
            }
            .card-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 2px;
                background: linear-gradient(90deg, #bdc3c7, #ecf0f1, #bdc3c7);
            }
            .logo-container {
                margin-bottom: 1.5rem;
            }
            .logo-container i {
                font-size: 3.5rem;
                color: #ecf0f1;
                text-shadow: 0 2px 8px rgba(0,0,0,0.3);
                transition: all 0.3s ease;
            }
            .logo-container i:hover {
                transform: scale(1.05);
                color: #bdc3c7;
            }
            .card-header h3 {
                color: #ecf0f1;
                font-size: 1.6rem;
                font-weight: 400;
                margin-bottom: 0.5rem;
                text-shadow: 0 1px 3px rgba(0,0,0,0.3);
                letter-spacing: 0.5px;
            }
            .card-header p {
                color: #bdc3c7;
                font-size: 0.95rem;
                margin: 0;
                font-style: italic;
            }
            .card-body {
                padding: 2.5rem 2rem;
            }
            .form-floating {
                margin-bottom: 1.5rem;
            }
            .form-control {
                border: 1px solid #bdc3c7;
                border-radius: 8px;
                padding: 1rem 1.25rem;
                font-size: 1rem;
                background: #fafafa;
                transition: all 0.3s ease;
                font-family: 'Georgia', serif;
            }
            .form-control:focus {
                border-color: #34495e;
                box-shadow: 0 0 0 0.2rem rgba(52, 73, 94, 0.15);
                background: white;
                outline: none;
            }
            .form-floating > label {
                color: #7f8c8d;
                font-weight: 400;
                font-family: 'Georgia', serif;
            }
            .btn-login {
                background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 8px;
                padding: 1rem;
                font-weight: 400;
                font-size: 1rem;
                color: #ecf0f1;
                transition: all 0.3s ease;
                box-shadow: 0 4px 12px rgba(44, 62, 80, 0.3);
                font-family: 'Georgia', serif;
                letter-spacing: 0.5px;
            }
            .btn-login:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 20px rgba(44, 62, 80, 0.4);
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
                color: white;
            }
            .card-footer {
                background: rgba(248, 249, 250, 0.6);
                border-top: 1px solid rgba(189, 195, 199, 0.3);
                padding: 1.5rem;
                text-align: center;
            }
            .alert {
                border-radius: 15px;
                font-size: 0.9rem;
                border: none;
                background: rgba(220, 53, 69, 0.1);
                color: #721c24;
                backdrop-filter: blur(10px);
            }
            .floating-shapes {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: -1;
            }
            .shape {
                position: absolute;
                background: rgba(236, 240, 241, 0.05);
                border-radius: 50%;
                animation: float 8s ease-in-out infinite;
            }
            .shape:nth-child(1) {
                width: 80px;
                height: 80px;
                top: 10%;
                left: 10%;
                animation-delay: 0s;
            }
            .shape:nth-child(2) {
                width: 120px;
                height: 120px;
                top: 70%;
                right: 10%;
                animation-delay: 2s;
            }
            .shape:nth-child(3) {
                width: 60px;
                height: 60px;
                top: 40%;
                left: 80%;
                animation-delay: 4s;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
                50% { transform: translateY(-15px) rotate(90deg); opacity: 0.6; }
            }
        </style>
    </head>
    <body>
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="container">
            <div class="login-container">
                <div class="card login-card">
                    <div class="card-header">
                        <div class="logo-container">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>Sistem Poin Pelanggaran Siswa</h3>
                        <p>Masuk ke dashboard Anda</p>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div class="form-floating">
                                <input class="form-control" name="username" type="text" id="username" placeholder="Username" required autofocus />
                                <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" name="password" type="password" id="password" placeholder="Password" required />
                                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-login" type="submit">
                                    <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Dashboard
                                </button>
                            </div>
                        </form>
                        
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #34495e;">Daftar di sini</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
