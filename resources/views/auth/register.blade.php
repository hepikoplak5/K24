@extends('layouts.template')

@section('content')
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Test K24</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate="">
                    @csrf
                    @if (count($errors) > 0)
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                          {{ $error }}<br>
                        @endforeach
                      </div>
                    @endif

                    <div class="col-6">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Tolong masukkan nama anda!</div>
                    </div>

                    <div class="col-6">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Tolong masukkan email yang valid!</div>
                    </div>

                    <div class="col-6">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Tolong masukkan username anda!</div>
                      </div>
                    </div>

                    <div class="col-6">
                      <label for="nohp" class="form-label">No. HP</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">+62</span>
                        <input type="text" name="nohp" class="form-control" id="nohp" placeholder="81312341234" required>
                        <div class="invalid-feedback">Tolong masukkan Nomor HP anda!</div>
                      </div>
                    </div>

                    <div class="col-6">
                      <label for="noktp" class="form-label">No. KTP</label>
                      <input type="text" name="noktp" class="form-control" id="noktp" required>
                      <div class="invalid-feedback">Tolong masukkan Nomor KTP anda!</div>
                    </div>

                    <div class="col-6">
                      <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                      <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
                      <div class="invalid-feedback">Tolong masukkan tanggal lahir anda!</div>
                    </div>

                    <div class="col-6">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-6">
                      <label for="inputNumber" class="form-label">File Upload</label>
                      <div class="col-sm-12">
                        <input class="form-control" type="file" name="foto" id="formFile">
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
@endsection
