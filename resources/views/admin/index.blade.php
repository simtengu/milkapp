    @extends('layouts.admin')           
@section('content')
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Incomes</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Consumptions</div>
                                   
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Income Reports</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">Consumption Reports</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
  
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                All Users @isset($users) ({{ count($users) }}) @else 0 @endisset 
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label>
                                        <select name="entries" id="entries_select" class="custom-select custom-select-md form-control form-control-md">
                                        <option selected value="">select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        </select> 
                                      Entries</label> 
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="p-1 d-flex justify-content-end">
                                           <div style="position: relative;"> 
                                            <input id="searchName" type="text" name="searchName" class="form-control form-control-md" placeholder="search by email">
                                            <ul id="results_ul" style="position: absolute;left: 0px;width: 100%;" class="list-group">
                                              
                                            </ul>
                                           </div>
                                        
                                    </div>
                                </div>
                            </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Region</th>
                                                <th>University</th>
                                                <th>view</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    @isset($users)
                                     @if(count($users))
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->whatsapp_phone }}</td>
                                                <td>{{ $user->university->region->name }}</td>
                                                <td>{{ $user->university->name }}</td>
                                                <td><a href="#" class="btn btn-md btn-success">view</a></td>
                                            </tr>
                                        @endforeach
                                     @endif
                                     @endisset
                                        </tbody>
                                    </table>
                                </div>
                                @isset($record)                                    
                                @if(count($users))
                                <div>
                                  {{$users->render()}}
                                </div>
                                @endif
                                @endisset
                            </div>
                        </div>
                    </div>
@endsection
@section('scripts')
  <script type="text/javascript">
      $(document).ready(function(){
         $("#entries_select").change(function(){
          var range = $(this).val();
          if (range != "") {
            window.location.href  = "{{ url('/administrator') }}"+"/"+range;
          }
         });
//searching user basing on their email...................................................
         $("#searchName").on('keyup', function(){
           var item  = $(this).val().trim();
           if (item.length > 1) {
               
               $.ajax({
                url: "{{ url('/admin_email_fetch') }}"+"/"+item,
                method:"GET",
                success: function(rs){
                 $("#results_ul").html(rs);
                },
                error: function(){
                    console.log("something went wrong");
                }
               })
           }else{
             $("#results_ul").html("");
           }
         });

         $(document).click(function(){
             $("#results_ul").html("");
         });
          $("#results_ul").click(function(e){
             e.stopPropagation();
          });
      });


  </script>
@stop