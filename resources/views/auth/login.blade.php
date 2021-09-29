


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login</title>
      
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
                                    <h2 class="mb-2">Masuk</h2>
                                    <p>Masuk untuk tetap terhubung.</p>
                                    <form action="{{ route('login') }}" method="post">
                                    @csrf
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="floating-label form-group">
                                                <input id="email" class="floating-input form-control @error('email') is-invalid @enderror" type="email" placeholder=" " name="email" required autocomplete="email">
                                                <label>Email</label>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="floating-label form-group">
                                                <input id="password" class="floating-input form-control @error('password') is-invalid @enderror" type="password" placeholder=" " name="password"required autocomplete="current-password">
                                                <label>Password</label>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label control-label-1" for="remember">Ingat saya</label>
                                             </div>
                                          </div>
                                          <!-- <div class="col-lg-6">
                                             <a href="auth-recoverpw.html" class="text-primary float-right">Lupa Password?</a>
                                          </div> -->
                                       </div>
                                       <button type="submit" class="btn btn-primary">Masuk</button>
                                       <p class="mt-3">
                                       Buat sebuah akun <a href="{{ route('register') }}" class="text-primary">Mendaftar</a>
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