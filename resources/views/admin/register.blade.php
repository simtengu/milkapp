@extends('layouts.admin')           
@section('content')
  <div class="container">
        <div class="row justify-content-center">
             <div class="col-md-6" id="loginContainer">  
                 <div class="login-div px-1 px-md-5 py-10" >
                    <form id="reg_form" method="POST" action="{{ route('save_user') }}" class="form">
                        @csrf
                        @if (Session()->has('user_saved'))
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
                             <h4>{{ Session('user_saved') }}</h4>
						</div>
                        @endif
                           <h2 style="color:#5734a1">Add User</h2>
                            <div class="form-group">
                                <input class="form-control" style="font-size: 22px"  type="text" name="name" placeholder="name"  required/>
                            </div>

                            <div class="form-group">
                                <input class="form-control" style="font-size: 22px"  type="email" name="email" placeholder="email"  required/>
                            </div>
                            <div class="form-group">
                                <input  class="form-control" style="font-size: 22px" type="password" id="pwd" name="password" placeholder="password" required />
                            </div>
                            <div class="form-group">
                                <input  class="form-control" style="font-size: 22px" type="password" id="confirm_pwd" name="confirm_password" placeholder="confirm password" required />
                            </div>
                        <button type="submit" class="login-btn btn btn-block">submit</button>
                    </form>
                  </div>              
             </div>
        </div>
  </div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $("#reg_form").submit(function(e){
     let pwd  = $("#pwd").val();
     let confirm_pwd  = $("#confirm_pwd").val();
     if(pwd != confirm_pwd){
         e.preventDefault();
         return alert("Password entered doesn't match");
     }

    });
  });

</script>
@endsection