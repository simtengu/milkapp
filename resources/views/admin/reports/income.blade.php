@extends('layouts.admin')
@section('content')
    <div class="container-fluid">


        <div class="card my-4">
            <div class="card-header">
                <h3 class="text-times text-app">Filters</h3>
                <div class="d-flex flex-wrap">
                    <div>
                        <a href="{{ route('general.report') }}" class="btn btn-sm btn-outline-secondary mx-1">Today</a>
                    </div>
                   <div style="position: relative">
                       <button id="date_btn" class="btn btn-sm btn-outline-secondary mx-1">Date</button>
                       <div style="display:none; position: absolute;left:0px;top:31px;z-index:100;" class="border rounded shadow bg-light" id="date_div">
                         <div style="border-radius: 5px 5px 0px 0px; background: linear-gradient(rgb(147, 56, 212),indigo) " class="d-flex justify-content-center align-items-center p-1">
                             <p class="text-light text-times font-17 text-capitalize mt-1">pick date</p>
                         </div>
                         
                         <div class="p-2">
                             <form method="POST" action="{{ route('date.report') }}" class="form">
                                @csrf
                                  <div class="form-group">
                                      <input name="date" class="form-control" type="date" required>
                                      <button class="btn btn-app-outline mt-2 btn-sm btn-block">submit</button>
                                  </div>
                                  
                              </form>
                         </div>
                       </div>
                  </div>
                   <div style="position: relative">
                       <button id="date_range_btn" class="btn btn-sm btn-outline-secondary mx-1">Date range</button>
                       <div style="display:none; position: absolute;left:0px;top:31px;z-index:100;" class="border rounded shadow bg-light" id="date_range_div">
                         <div style="border-radius: 5px 5px 0px 0px; background: linear-gradient(rgb(147, 56, 212),indigo) " class="d-flex justify-content-center align-items-center p-1">
                             <p class="text-light text-times font-17 text-capitalize mt-1">select range</p>
                         </div>
                         
                         <div class="p-2">
                             <form method="POST" action="{{ route('date_range.report') }}" class="form">
                                 @csrf
                                    <div class="form-group">
                                        <label for="from_date">From</label>
                                      <input name="from_date" class="form-control" id="from_date" type="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="to_date">To</label>
                                      <input name="to_date" class="form-control" id="to_date" type="date" required>
                                    </div>

                                    <button class="btn btn-app-outline btn-sm btn-block">submit</button>
                                  
                              </form>
                         </div>
                       </div>
                  </div>
                  <div>
                      <a href="{{ route('all.report') }}" class="btn btn-sm btn-outline-secondary mx-1">All</a>
                 </div> 
              
                </div>
            </div>
            <div class="card-body">
                 @isset($today_filter)
                     <h4 class="text-dark text-times">{{ $today_filter }}</h4>
                 @endisset

                 @isset($all_filter)
                     <h4 class="text-dark text-times">{{ $all_filter }}</h4>
                 @endisset

                 @isset($date_filter)
                     <h4 class="text-dark text-times">{{ $date_filter }}</h4>
                 @endisset

                 @isset($date_range_filter)
                     <h4 class="text-dark text-times">{{ $date_range_filter }}</h4>
                 @endisset
                <div class="row justify-content-start mb-5">
                    <div class="mx-3 my-1">
                        <button id="mapato_btn" class="btn btn-app text-times font-18">Mapato</button>
                    </div>

                    <div class="mx-3 my-1">
                        <button id="matumizi_btn" class="btn btn-app text-times font-18">Matumizi</button>
                    </div>

                    <div class="mx-3 my-1">
                        <button id="analysis_btn" class="btn btn-app text-times font-18">Analysis</button>
                    </div>

                </div>
                {{-- ..................... mapato section.................................. --}}
                <div id="mapato_container" class="row">
                    <div class="col-12">
                        <h3 class="text-app font-weight-bold text-uppercase">mapato</h3>
                        <h5 class="text-times ml-3 font-weight-bold">Jumla ya mapato: <span
                                class="text-app">{{ number_format($total_income) }} Tsh</span> </h5>
        
                    {{-- move through matumizi kwa chupa,lita,yogurt........................................ --}}
                    <hr>
                    <div style="flex-wrap: wrap" class="d-flex  justify-content-start my-3">
                    <div class="mx-3 my-1">
                        <button id="mapato_kwa_chupa_btn" class="btn text-app font-weight-bold text-times font-16 bg-light-grey">kwa chupa</button>
                    </div>

                    <div class="mx-3 my-1">
                        <button id="mapato_kwa_lita_btn" class="btn text-app font-weight-bold text-times font-16 bg-light-grey">kwa rejareja</button>
                    </div>

                    <div class="mx-3 my-1">
                        <button id="mapato_kwa_yogurt_btn" class="btn text-app font-weight-bold text-times font-16 bg-light-grey">kwa yogurt</button>
                    </div>

                </div>          
                    </div>
                    <div id="kwa_chupa_div" class="col-12">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between">
                                <p class="font-17 text-times text-capitalize">mauzo kwa chupa</p>
                               <p class="ml-3 text-times font-17">Jumla: <span
                                    class="text-app font-weight-bold">{{ number_format($total_bottle_income) }} Tsh</span>
                               </p>
                            </div>
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sno:</th>
                                        <th>Aina ya maziwa</th>
                                        <th>Chupa</th>
                                        <th>Bei(Tsh)</th>
                                        <th>Idadi</th>
                                        <th>Kiasi(Tsh)</th>
                                        <th>Tarehe</th>
                                        <th>username</th>
                                        <th class="text-center"><a href="{{ route('income.index') }}" class="text-success text-times font-17">Ongeza</a></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($bottle_incomes))
                                        <?php $count = 1; ?>
                                        @foreach ($bottle_incomes as $income)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $income->milk_type }}</td>
                                                <td>{{ $income->bottle_capacity }}</td>
                                                <td>{{ $income->price }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ $income->amount }}</td>
                                                <td>{{ $income->created_at->toDateString() }}</td>
                                                <td>{{ $income->added_by }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('edit_bottle_income',$income->id) }}" class="text-underline text-app">actions</a>
                                                </td>
                                            </tr>
                                            <?php $count = $count + 1; ?>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-app text-center"> hakuna taarifa</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                            {{-- pagination of bottle incomes of the day........... --}}
                           
                                    <div>
                                      {{$bottle_incomes->links()}}
                                    </div>
                          

                        </div>

                    </div>

                    <div style="display: none" id="kwa_lita_div" class="col-12">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between">
                               <p class="font-17 text-times text-capitalize">mauzo kwa rejareja</p>
                               <p class="ml-3 text-times font-17">Jumla: <span
                                   class="text-app font-weight-bold">{{ number_format($total_litre_income) }} Tsh</span>
                               </p>
                            </div>

                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sno:</th>
                                        <th>Aina ya maziwa</th>
                                        <th>Ujazo</th>
                                        <th>Bei(Tsh)</th>
                                        <th>Idadi</th>
                                        <th>Kiasi(Tsh)</th>
                                        <th>Tarehe</th>
                                        <th>username</th>
                                        <th class="text-center"><a href="{{ route('income.index') }}" class="text-success text-times font-17">Ongeza</a></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($litre_incomes))
                                        <?php $counter = 1; ?>
                                        @foreach ($litre_incomes as $income)
                                            <tr>
                                                <td>{{ $counter }}</td>
                                                <td>{{ $income->milk_type }}</td>
                                                <td>{{ $income->volume }}</td>
                                                <td>{{ $income->price }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ $income->amount }}</td>
                                                <td>{{ $income->created_at->toDateString() }}</td>
                                                <td>{{ $income->added_by }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('edit_litre_income',$income->id) }}" class="text-underline text-app">actions</a>
                                                </td>
                                            </tr>
                                            <?php $counter = $counter + 1; ?>
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="9" class="text-app text-center"> hakuna taarifa</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                            {{-- pagination of litre incomes of the day........... --}}
                           
                                    <div>
                                      {{$litre_incomes->links()}}
                                    </div>

                        </div>

                    </div>
                    {{-- mauzo ya yogurt........................................................ --}}
                    <div style="display: none" id="kwa_yogurt_div" class="col-12">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between">
                               <p class="font-17 text-times text-capitalize">mauzo ya yogurt</p>
                               <p class="ml-3 text-times font-17">Jumla: <span
                                    class="text-app font-weight-bold">{{ number_format($total_yogurt_income) }} Tsh</span> 
                               </p>
                            </div>

                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sno:</th>
                                        <th>Aina/Ujazo</th>
                                        <th>Bei(Tsh)</th>
                                        <th>Idadi</th>
                                        <th>Kiasi(Tsh)</th>
                                        <th>Tarehe</th>
                                        <th>username</th>
                                        <th class="text-center"><a href="{{ route('income.index') }}" class="text-success text-times font-17">Ongeza</a></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($yogurt_incomes))
                                        <?php $j = 1; ?>
                                        @foreach ($yogurt_incomes as $income)
                                            <tr>
                                                <td>{{ $j }}</td>

                                                <td>{{ $income->capacity }}</td>
                                                <td>{{ $income->price }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ $income->amount }}</td>
                                                <td>{{ $income->created_at->toDateString() }}</td>
                                                <td>{{ $income->added_by }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('edit_yogurt_income',$income->id) }}" class="text-underline text-app">actions</a>
                                                </td>
                                            </tr>
                                            <?php $j = $j + 1; ?>
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="8" class="text-app text-center"> hakuna taarifa</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                            {{-- pagination of yogurt incomes of the day........... --}}
                           
                                    <div>
                                      {{$yogurt_incomes->links()}}
                                    </div>
                        </div>

                    </div>

                </div>

                <div id="matumizi_container" style="display: none;">
                    <div class="table-responsive">
                        <h3 class="text-app font-weight-bold text-uppercase">matumizi</h3>
                        <h5 class="text-times ml-3 font-weight-bold">Jumla ya matumizi: <span
                                class="text-app">{{ number_format($total_expense) }} Tsh</span> </h5>
                        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sno:</th>
                                    <th>lengo/kusudi</th>
                                    <th>kiasi(Tsh)</th>
                                    <th>wahusika</th>
                                    <th>Tarehe</th>
                                    <th>Username</th>
                                    <th class="text-center"><a href="{{ route('expense.index') }}" class="text-success text-times font-17">Ongeza</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @forelse ($expenses as $expense)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $expense->purpose }}</td>
                                        <td>{{ number_format($expense->amount)  }}</td>
                                        <td>{{ $expense->to_whom }}</td>
                                        <td>{{ $expense->created_at->toDateString() }}</td>
                                        <td>{{ $expense->added_by }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('expense.edit',$expense->id) }}" class="text-underline text-app">actions</a>
                                                </td>
                                    </tr>
                                    <?php $i = $i + 1; ?>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center"> <p class="text-app">Bado hakuna taarifa</p> </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                            {{-- pagination of expenses of the day........... --}}
                           
                                    <div>
                                      {{$expenses->links()}}
                                    </div>

                    </div>
                </div>
                <div style="display: none;" id="analysis_container">
                    <div class="card" style="display: inline-block !important">
                        <div class="card-header">
                            <h2 class="text-app text-times">ANALYSIS</h2>
                        </div>
                        <div class="card-body">

                            <h5 class=" text-times">Jumla ya mapato: <span class="text-app font-weight-bold">{{ number_format($total_income) }} Tsh</span> </h5>
                            <h5 class=" text-times">Jumla ya matumizi: <span class="text-app font-weight-bold">{{ number_format($total_expense) }} Tsh</span> </h5>
                            <hr>
                            <div class="d-flex align-items-center justify-content-between mt-2 card-footern mt-2">
                                <h5 class="text-app  text-times">Status:</h5>
                                  @if ($total_income > $total_expense)
                                      <h5 class="text-success text-times">+ {{ number_format($total_income-$total_expense)  }} Tsh</h5>
                                      <button class="btn btn-outline-success btn-sm mb-1 font-weight-bold">vizuri</button>
                                  @else
                                      <h5 class="text-danger text-times"> {{ number_format($total_income-$total_expense)  }} Tsh</h5>
                                      <button class="btn btn-outline-danger btn-sm mb-1 font-weight-bold">vibaya</button>
                                  @endif  
                               
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop()
@section('scripts')
<script>
    $(document).ready(function() {
        //hide and show report sections ............................
        $("#mapato_btn").click(function() {
            $("#mapato_container").show();
            $("#matumizi_container").hide();
            $("#analysis_container").hide();
        });

        $("#matumizi_btn").click(function() {
            $("#matumizi_container").show();
            $("#mapato_container").hide();
            $("#analysis_container").hide();
        });

        $("#analysis_btn").click(function() {
            $("#analysis_container").show();
            $("#matumizi_container").hide();
            $("#mapato_container").hide();
        });

        //hide and show mapato sections...............
        $("#mapato_kwa_chupa_btn").click(function() {
             $("#kwa_chupa_div").show();
             $("#kwa_lita_div").hide();
             $("#kwa_yogurt_div").hide();
        })

        $("#mapato_kwa_lita_btn").click(function() {
             $("#kwa_chupa_div").hide();
             $("#kwa_lita_div").show();
             $("#kwa_yogurt_div").hide();
        })

        $("#mapato_kwa_yogurt_btn").click(function() {
             $("#kwa_chupa_div").hide();
             $("#kwa_lita_div").hide();
             $("#kwa_yogurt_div").show();
        })


        $("#date_btn").click(function (e) {
            $("#date_div").toggle();
             e.stopPropagation();
        })

        $("#date_range_btn").click(function (e) {
            $("#date_range_div").toggle();
           e.stopPropagation();
        })

        $(document).click(function(){
         $("#date_div").hide();
         $("#date_range_div").hide();
        });

        $("#date_div").click(function(e){
           e.stopPropagation();
        })
        $("#date_range_div").click(function(e){
           e.stopPropagation();
        })
    });

</script>
@stop
