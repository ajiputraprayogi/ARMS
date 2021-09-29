


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Daftar</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/images/favicon.ico" />
      <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
      <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  </head>
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    
      <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div class="row align-items-center justify-content-center height-self-center">
                <div class="col-lg-8">
                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center auth-content">
                            <div class="col-lg-7 align-self-center">
                                <div class="p-3">
                                    <h2 class="mb-2">Mendaftar</h2>
                                    <p>Buat akun Anda.</p>
                                    <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                        <div class="row">
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input id="name" class="floating-input form-control @error('name') is-invalid @enderror" type="text" placeholder=" " value="{{ old('name') }}" name="name" required autocomplete="off">
                                                <label>{{ __('Nama Lengkap') }}</label>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input id="username" class="floating-input form-control @error('username') is-invalid @enderror" type="text" placeholder=" " value="{{ old('username') }}" name="username" required autocomplete="off">
                                                <label>{{ __('Username') }}</label>
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input id="email" class="floating-input form-control @error('email') is-invalid @enderror" type="email" placeholder=" " value="{{ old('email') }}" name="email" required autocomplete="off">
                                                <label>{{ __('E-Mail Address') }}</label>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input id="telp" class="floating-input form-control @error('telp') is-invalid @enderror" type="text" placeholder=" " value="{{ old('telp') }}" name="telp" required autocomplete="off">
                                                <label>{{ __('No. Telp') }}</label>
                                                @error('telp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input id="password" class="floating-input form-control @error('password') is-invalid @enderror" type="password" placeholder=" "  name="password" required autocomplete="new-password">
                                                <label>{{ __('Password') }}</label>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror</input>
                                                <label>{{ __('Password') }}</label>
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <input id="password-confirm" class="floating-input form-control" type="password" placeholder=" " name="password_confirmation" required autocomplete="new-password">
                                                <label>{{ __('Confirm Password') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="floating-label form-group">
                                                <select name="level" id="" class="form-control" hidden>
                                                    <option value="Superadmin">Superadmin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-12">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Saya setuju dengan ketentuan penggunaan</label>
                                            </div>
                                        </div> -->
                                        </div>
                                        <button type="submit" class="btn btn-primary">Mendaftar</button>
                                        <p class="mt-3">
                                        Sudah memiliki akun <a href="{{ route('login') }}" class="text-primary">Masuk</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-5 content-right">
                                <img src="../assets/images/login/01.png" class="img-fluid image-right" alt="">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
      </div>
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js"></script>
  </body>
</html>