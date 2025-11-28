<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Register - Sistem Poin Pelanggaran Siswa</title>
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
                padding: 2rem 0;
            }
            .register-container {
                max-width: 500px;
                margin: 0 auto;
            }
            .register-card {
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
            .logo-container i {
                font-size: 3.5rem;
                color: #ecf0f1;
                text-shadow: 0 2px 8px rgba(0,0,0,0.3);
                transition: all 0.3s ease;
                margin-bottom: 1rem;
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
            .form-label {
                color: #7f8c8d;
                font-weight: 400;
                font-family: 'Georgia', serif;
                margin-bottom: 0.5rem;
            }
            .btn-register {
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
            .btn-register:hover {
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
                border-radius: 8px;
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
            <div class="register-container">
                <div class="card register-card">
                    <div class="card-header">
                        <div class="logo-container">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3>Buat Akun Baru</h3>
                        <p>Daftar untuk mengakses sistem</p>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('register.post') }}">
                            @csrf
                            
                            <div class="form-floating">
                                <input class="form-control" name="username" type="text" id="username" placeholder="Username" value="{{ old('username') }}" required />
                                <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                            </div>
                            
                            <div class="form-floating">
                                <input class="form-control" name="nama_lengkap" type="text" id="nama_lengkap" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" required />
                                <label for="nama_lengkap"><i class="fas fa-id-card me-2"></i>Nama Lengkap</label>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="password" type="password" id="password" placeholder="Password" required />
                                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="password_confirmation" type="password" id="password_confirmation" placeholder="Konfirmasi Password" required />
                                        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Konfirmasi Password</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid mt-3">
                                <button class="btn btn-register" type="submit">
                                    <i class="fas fa-user-plus me-2"></i>Buat Akun
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #34495e;">Login di sini</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
