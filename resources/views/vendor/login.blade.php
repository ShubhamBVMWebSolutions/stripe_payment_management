<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Vendor - Login</title>
</head>
<body>
    @include('sweetalert::alert')
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item text-center">
                  <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
                </li>
                <li class="nav-item text-center">
                  <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Signup</a>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form action="{{route('vendor_login')}}" method="post">
                        @csrf
                      <div class="form px-4 pt-5">
                          <input type="email" name="email" class="form-control" placeholder="Enter Email...">
                          <input type="password" name="password" class="form-control" placeholder="Enter Password.....">
                          <button class="btn btn-dark btn-block">Login</button>
                          <br>
                          <h5>Login As User <a href="{{route('home')}}">User Login</a></h5>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <form action="{{route('vendor_signup')}}" method="post">
                        @csrf
                        <div class="form px-4">
                            <input type="hidden" name="role_id" class="form-control" value="4">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name...">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email Address ......">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password.....">
                            <button class="btn btn-dark btn-block">Signup</button>
                            <br>
                          <h5>Signup As user <a href="{{route('home')}}">User Sign Up</a></h5>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
