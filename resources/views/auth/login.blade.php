<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Atmiya Wellness |  Login</title>
  <link rel="icon" class="bg-white" sizes="64x64" type="image/png" href="{{ asset('admin/dist/img/au-favicon.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <style>
    body {
      background: linear-gradient(to bottom right, #007bff, #28a745);
      font-family: 'Arial', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeIn 1.5s ease-in-out;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }

    .login-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      padding: 15px;
      transform: scale(1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-header {
      background: linear-gradient(to right, #007bff, #28a745);
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    .card-header img {
      width: 80px;
      height: auto;
      border-radius: 50%;
      background: #fff;
      padding: 5px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      animation: bounceIn 1.2s ease;
    }

    @keyframes bounceIn {
      0% {
        transform: scale(0.8);
        opacity: 0;
      }

      50% {
        transform: scale(1.2);
        opacity: 0.8;
      }

      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .form-control {
      border-radius: 30px;
      padding: 15px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #28a745;
      box-shadow: 0 0 10px rgba(40, 167, 69, 0.3);
    }

    .btn-dark {
      background-color: #007bff;
      border: none;
      font-size: 18px;
      border-radius: 30px;
      transition: all 0.3s ease;
    }

    .btn-dark:hover {
      background-color: #0056b3;
    }

    .card-footer {
      text-align: center;
      background-color: white;
    }

    .link-dark {
      color: #007bff;
      position: relative;
      text-decoration: none;
    }

    .link-dark::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -2px;
      width: 100%;
      height: 2px;
      background-color: #007bff;
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    @media (max-width: 576px) {
      .card-header img {
        width: 60px;
      }

      .btn-dark {
        font-size: 16px;
      }

      .form-control {
        padding: 10px;
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <section class="py-3">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
          <div class="card login-card mt-4">
            <div class="card-header">
              <img src="{{ asset('admin/dist/img/au-logo.png') }}" alt="User Logo" class="img-fluid">
              <h4 class="mt-3">Admin Login</h4>
            </div>
            <div class="card-body p-4">
              <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                @if(session('error'))
          <div class="alert alert-danger" role="alert">
            {{ session('error') }}
          </div>
        @endif

                <div class="row gy-3">
                  <div class="col-12">
                    <div class="form-floating">
                      <input type="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                        placeholder="name@example.com" required>
                      <label for="email">Email Address</label>
                    </div>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <div class="form-floating position-relative">
                      <input type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" id="password" placeholder="Password" required>
                      <label for="password">Password</label>
                      <!-- Eye Icon for Show Password -->
                      <i id="togglePassword" class="fas fa-eye position-absolute" style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn btn-dark btn-lg" type="submit">Login</button>
                    </div>
                  </div>
                  <div class="col-12 text-center">
                    <p class="m-0 text-secondary">Don't have an account? <br><a href="{{ route('admin.register') }}"
                        class="link-dark fw-bold text-decoration-none">Sign up</a></p>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer">
              <p class="m-0 text-secondary">Atmiya Wellness &copy; 2025</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    // Toggle password visibility using the eye icon
    document.getElementById('togglePassword').addEventListener('click', function () {
      var passwordField = document.getElementById('password');
      var icon = this;

      // Toggle the type of the password field
      passwordField.type = passwordField.type === 'password' ? 'text' : 'password';

      // Toggle the eye icon
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });
  </script>

</body>

</html>
