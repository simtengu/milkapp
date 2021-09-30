<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="styleSheet" />
    <link href="{{ asset('/css/app.css') }}" rel="styleSheet" />
</head>
<body>
    <div class="login-container container">
        <div class="row justify-content-center">
             <div class="col-md-6" id="loginContainer">  
                 <div class="login-div px-5 py-10" >
                    <form method="POST" action="{{ route('authenticate_user') }}" class="form">
                         @csrf

                        @if (Session()->has('invalid_auth_attempt'))
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
                             <h4>{{ Session('invalid_auth_attempt') }}</h4>
						</div>
                        @endif

                           <h2 style="color:#5734a1">Login here</h2>
                            <div class="form-group">
                                <input class="form-control" style="font-size: 22px"  type="email" name="email" placeholder="email"  required/>
                            </div>
                            <div class="form-group">
                                <input  class="form-control" style="font-size: 22px" type="password" name="password" placeholder="password" required />
                            </div>
                            <div>
								<label  class="checkbox">
								<input name="remember_me" type="checkbox" value="checked" checked> Remember me
								</label>
                            </div>
                        
                        <button type="submit" class="login-btn btn btn-block">login</button>
                    </form>
                  </div>              
             </div>
        </div>
    </div>
      <script src="{{ asset('admin/js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
  
</body>
</html>