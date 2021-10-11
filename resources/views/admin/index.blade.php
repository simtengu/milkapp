    @extends('layouts.admin')           
@section('content')
                    <div class="container-fluid">
                        <h1 class="mt-4 text-app">Dashboard</h1>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Reports</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('general.report') }}">Visit</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Print</div>
                                   
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('print_reports') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Chart</div>
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
                            <div class="col-md-10">
                            @if (Session()->has('income_removed'))
                                <div class="alert alert-success my-3">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <p>{{ Session('income_removed') }}</p>
                                </div>
                            @endif
                            </div>
                        </div>
  
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                               <h5 class="text-times text-app">Mapato ya leo</h5>
                               <h5 class="text-times text-primary">{{ date('d-m-Y') }}</h5>
                            </div>
                            <div class="card-body">
                            <div class="row justify-content-start mb-3">
                                <div class="mx-3">    
                                <button id="kwaChupaBtn" class="btn btn-app text-times font-18">kwa chupa</button>
                                </div>

                                <div class="mx-3">
                                <button id="kwaLitaBtn" class="btn btn-app text-times font-18">kwa lita</button>    
                                </div>

                                <div class="mx-3">
                                <button id="kwaYogurtBtn" class="btn btn-app text-times font-18">kwa Yogurt</button>    
                                </div>
                               
                            </div>
                                <div id="kwaChupaTable" class="table-responsive">
                                    <p class="font-17 text-times">mauzo kwa chupa</p>
                                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sno:</th>
                                                <th>Aina ya maziwa</th>
                                                <th>Chupa</th>
                                                <th>Bei(Tsh)</th>
                                                <th>Idadi</th>
                                                <th>Kiasi(Tsh)</th>
                                                <th>time</th>
                                                <th class="text-center"><a href="{{ route('income.index') }}" class="text-success text-times font-17">Ongeza</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                     @if(count($bottle_incomes))
                                       <?php  $count = 1; ?>
                                        @foreach($bottle_incomes as $income)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $income->milk_type }}</td>
                                                <td>{{ $income->bottle_capacity }}</td>
                                                <td>{{ $income->price }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ number_format($income->amount) }}</td>
                                                <td>{{ $income->created_at->diffForHumans() }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('edit_bottle_income',$income->id) }}" class="text-underline text-app">actions</a>
                                                </td>
                                            </tr>
                                            <?php  $count = $count + 1; ?>
                                        @endforeach
                                        @else
                                              <tr><td colspan="6" class="text-app text-center"> hakuna taarifa</td></tr>
                                     @endif
                                  
                                        </tbody>
                                    </table>
                                    {{-- pagination of bottle incomes of the day........... --}}
                                @if(count($bottle_incomes))
                                <div>
                                  {{$bottle_incomes->links()}}
                                </div>
                                @endif

                                </div>

                                <div id="kwaLitaTable" class="table-responsive" style="display: none;">
                                    <p class="font-17 text-times">mauzo kwa rejareja</p>
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                       <thead>
                                            <tr>
                                                <th>Sno:</th>
                                                <th>Aina ya maziwa</th>
                                                <th>Ujazo</th>
                                                <th>Bei(Tsh)</th>
                                                <th>Idadi</th>
                                                <th>Kiasi(Tsh)</th>
                                                <th class="text-center"><a href="{{ route('income.index') }}" class="text-success text-times font-17">Ongeza</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                     @if(count($litre_incomes))
                                       <?php  $counter = 1; ?>
                                        @foreach($litre_incomes as $income)
                                            <tr>
                                                <td>{{ $counter }}</td>
                                                <td>{{ $income->milk_type }}</td>
                                                <td>{{ $income->volume }}</td>
                                                <td>{{ $income->price }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ number_format($income->amount)  }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('edit_litre_income',$income->id) }}" class="text-underline text-app">actions</a>
                                                </td>
                                            </tr>
                                            <?php  $counter = $counter + 1; ?>
                                        @endforeach

                                        @else
                                              <tr><td colspan="7" class="text-app text-center"> hakuna taarifa</td></tr>
                                     @endif
                                  
                                        </tbody>
                                    </table>
                                    {{-- pagination of litre incomes of the day........... --}}
                                @if(count($litre_incomes))
                                <div>
                                  {{$litre_incomes->links()}}
                                </div>
                                @endif
                                </div>


                                <div id="kwaYogurtTable" class="table-responsive" style="display: none;">
                                    <p class="font-17 text-times">mauzo kwa yogurt</p>
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                       <thead>
                                            <tr>
                                                <th>Sno:</th>
                                                <th>Aina/Ujazo</th>
                                                <th>Bei(Tsh)</th>
                                                <th>Idadi</th>
                                                <th>Kiasi(Tsh)</th>
                                                <th class="text-center"><a href="{{ route('income.index') }}" class="text-success text-times font-17">Ongeza</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                     @if(count($yogurt_incomes))
                                       <?php  $j = 1; ?>
                                        @foreach($yogurt_incomes as $income)
                                            <tr>
                                                <td>{{ $j }}</td>
                                                <td>{{ $income->capacity }}</td>
                                                <td>{{ $income->price }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ number_format($income->amount) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('edit_yogurt_income',$income->id) }}" class="text-underline text-app">actions</a>
                                                </td>
                                            </tr>
                                            <?php  $j = $j + 1; ?>
                                        @endforeach

                                        @else
                                              <tr><td colspan="6" class="text-app text-center"> hakuna taarifa</td></tr>
                                     @endif
                                  
                                        </tbody>
                                    </table>
                                    {{-- pagination of yogurt incomes of the day........... --}}
                                @if(count($yogurt_incomes))
                                <div>
                                  {{$yogurt_incomes->links()}}
                                </div>
                                @endif
                                </div>

                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="text-times text-app">Matumizi ya leo</h5>
                                <h5 class="text-times text-primary">{{ date('d-m-Y') }}</h5>
                            </div>
                            <div class="card-body">
                                <div id="matumiziyaleo_div" class="table-responsive">
                                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sno:</th>
                                                <th>Lengo/kusudi</th>
                                                <th>Wahusika</th>
                                                <th>Kiasi(Tsh)</th>
                                                <th class="text-center"><a href="{{ route('expense.index') }}" class="text-success text-times font-17">Ongeza</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    
                                     @if(count($expenses))
                                       <?php  $count = 1; ?>
                                        @foreach($expenses as $expense)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $expense->purpose }}</td>
                                                <td>{{ $expense->to_whom }}</td>
                                                <td>{{ number_format($expense->amount)  }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('expense.edit',$expense->id) }}" class="text-underline text-app">actions</a>
                                                </td>
                                            </tr>
                                            <?php  $count = $count + 1; ?>
                                        @endforeach
                                        @else
                                              <tr><td colspan="6" class="text-app text-center"> hakuna taarifa</td></tr>
                                     @endif
                                  
                                        </tbody>
                                    </table>
                                    {{-- pagination of todays expenses of the day........... --}}
                                @if(count($expenses))
                                <div>
                                  {{$expenses->links()}}
                                </div>
                                @endif
                                </div> 
                            </div>
                        </div>
                    </div>
@endsection
@section('scripts')
  <script type="text/javascript">
      $(document).ready(function(){

//hide and show kwa chupa and kwa lita tables............................
  $("#kwaChupaBtn").click(function(){
    $("#kwaChupaTable").show();
    $("#kwaLitaTable").hide();
    $("#kwaYogurtTable").hide();
  });

  $("#kwaLitaBtn").click(function(){
    $("#kwaLitaTable").show();
    $("#kwaChupaTable").hide();
    $("#kwaYogurtTable").hide();
  });

  $("#kwaYogurtBtn").click(function(){
    $("#kwaLitaTable").hide();
    $("#kwaChupaTable").hide();
    $("#kwaYogurtTable").show();
  });

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