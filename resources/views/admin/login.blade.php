<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="styleSheet" />
    <link href="{{ asset('/css/app.css') }}" rel="styleSheet" />

    <style>
    .logInDiv {
        background-image: url("./images/bg.JPG");
        background-position: center;
    }
    </style>
</head>
<body>
    <div class="logInDiv container-fluid">

    <div class="login-container  container">
        <div class="row justify-content-center">
             <div class="col-md-5" id="loginContainer">  
                 <div class="login-div px-md-5 py-10 " >
                    <div style="background-color: rgba(0, 161, 81, 0.5) !important" class="card shadow px-4 pb-2 pt-3">
                     <form method="POST" action="{{ route('authenticate_user') }}" class="form">
                         @csrf

                        @if (Session()->has('invalid_auth_attempt'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                             <p>{{ Session('invalid_auth_attempt') }}</p>
                        </div>
                        @endif
                            
                           <h2 style="color:#5734a1" class="text-times mb-2">Login here</h2>
                            <div class="form-group mt-3">
                                <input style="background-color: rgba(255, 255, 255, 0.6) !important;color: black !important" class=" form-control" style="font-size: 22px"  type="email" name="email" placeholder="email"  required/>
                            </div>
                            <div class="form-group">
                                <input style="background-color: rgba(255, 255, 255, 0.6) !important;color: black !important"  class="form-control" style="font-size: 22px" type="password" name="password" placeholder="password" required />
                            </div>
                            <div>
                                <label  class="checkbox text-light font-weight-bold">
                                <input name="remember_me" type="checkbox" value="checked" checked> Remember me
                                </label>
                            </div>
                        
                        <button type="submit" class="login-btn font-weight-bold btn btn-block my-2">login</button>
                    </form>                       
                    </div>

                  </div>              
             </div>
        </div>
    </div>
</div>
      <script src="{{ asset('admin/js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
  
</body>
</html>