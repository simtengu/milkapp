@extends('layouts.admin')
@section('content')
        <div class="row my-4">
             <div class="col-md-6">  
                 <div class=" px-5 px-md-6 py-7 " >
                    <form id="reg_form" method="POST" action="{{ route('update_details') }}" class="form">
                         @csrf
                         @method('PATCH')
                        @if (Session()->has('details_updated'))
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
                             <p class="text-dark font-17 text-times">{{ Session('details_updated') }}</p>
						</div>
                        @endif

                           <h2 style="color:#5734a1" class=" text-times text-capitalize">update information here</h2>
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}" placeholder="name"  required/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}" placeholder="email"  required/>
                            </div>
                            <div class="form-group">
                                <input id="current_pwd"  class="form-control"  type="password" name="current_pwd" placeholder="password ya sasa" required />
                            </div>
                            <div class="form-group">
                                <input  id="pwd" class="form-control"  type="password" name="new_password" placeholder="password mpya" required />
                            </div>
                            <div class="form-group">
                                <input id="confirm_pwd"  class="form-control"  type="password" name="confirm_pwd" placeholder="rudia password mpya" required />
                            </div>
                        
                        <button type="submit" class="btn-app btn">Update</button>
                    </form>
                  </div>              
             </div>
             <div class="col-md-6 p-2" id="users_div">
                 <div class="px-3 mt-2"><h4 class="text-times  text-app">Normal users</h4></div>
                 
                        @if (Session()->has('user_removed'))
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
                             <p class="text-dark font-17 text-times">{{ Session('user_removed') }}</p>
						</div>
                        @endif
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
             
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
              <form method="POST" action="{{ route('remove_user',$user->id) }}" class="form">
                @csrf
                @method('DELETE')
               <button onclick=" if( !confirm('unathibitisha kuondoa mtumiaji huyu')){
                        event.preventDefault(); }" type="submit" class="btn btn-danger">Ondoa</button>
              </form>
          </td>
        </tr>
        @empty
            <tr>
                <td colspan="3">
                    <h5 class="text-app">Hakuna watumiaji wengine</h5>
                </td>
            </tr> 
        @endforelse
    </tbody>
  </table>
</div>
             </div>
        </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
    $("#reg_form").submit(function(e){
     let pwd  = $("#pwd").val();
     let confirm_pwd  = $("#confirm_pwd").val();
     if(pwd != confirm_pwd){
         e.preventDefault();
         return alert("Password entered doesn't match");
     }

    });
    })
</script>
@stop