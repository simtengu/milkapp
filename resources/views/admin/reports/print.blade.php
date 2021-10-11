<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Mbeya milk</title>
        <link href="{{ asset('/css/app.css') }}" rel="styleSheet" />
  <style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}


#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #9273d2;
  color: white;
}

.d-flex {
    display: flex;
}
.justify-content-center {
    justify-content: center;
}

.justify-content-between {
    justify-content: space-between;
}
.text-uppercase {
    text-transform: uppercase;
}
.text-center {
    text-align: center;
}

.font-weight-bold {
    font-weight: bold;
}
.card {
    padding: 10px;
}

.text-success {
    color: rgb(117, 192, 117);

}

.text-danger {
    color: rgb(131, 38, 38);

}
.btn-outline-danger {
  padding: 5px !important;
  background-color: transparent;
  color: rgb(131, 38, 38);
  border: 1px solid rgb(131, 38, 38);
  border-radius: 4px;

}

.btn-outline-success {
    padding: 5px !important;
    background-color: transparent;
    color: rgb(117, 192, 117);
    border: 1px solid rgb(117, 192, 117);
    border-radius: 4px;

}
.align-items-center {
    align-items: center;
}

.font-18 {
    font-size: 15px;
}
</style>

    </head> 
    <body style="background-color: white !important; padding: 0px;margin:0px;">
 

    <div class="container-fluid">


        <div class="card my-4">
            <div class="card-body">
                <div style="float: right;color: grey">

                    @isset($today_filter)
                        <h4 class=" text-times font-17">{{ $today_filter }}</h4>
                    @endisset
   
                    @isset($all_filter)
                        <h4 class=" text-times font-17">{{ $all_filter }}</h4>
                    @endisset
   
                    @isset($date_filter)
                        <h4 class=" text-times font-17">{{ $date_filter }}</h4>
                    @endisset
   
                    @isset($date_range_filter)
                        <h4 class=" text-times font-17">{{ $date_range_filter }}</h4>
                    @endisset
                </div>
                {{-- ..................... mapato section.................................. --}}
                <div>
                    <div>
                        <h3 class="text-app font-weight-bold text-uppercase">mapato</h3>
                        <h5 class="text-times ml-3 font-weight-bold font-17">Jumla ya mapato: <span
                                class="text-app">{{ number_format($total_income) }} Tsh</span> </h5>
        
                    {{-- move through matumizi kwa chupa,lita,yogurt........................................ --}}
                    <hr>          
                    </div>
                    <div>
                        <div>
                            <div>
                                <p class="font-17 text-times text-capitalize">mauzo kwa chupa</p>
                               <p class="ml-3 text-times font-17">Jumla: <span
                                    class="text-app font-weight-bold">{{ number_format($total_bottle_income) }} Tsh</span>
                               </p>
                            </div>
                            <table id="customers" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sno:</th>
                                        <th>Aina ya maziwa</th>
                                        <th>Chupa</th>
                                        <th>Bei(Tsh)</th>
                                        <th>Idadi</th>
                                        <th>Kiasi(Tsh)</th>
                                        <th>Tarehe</th>
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
                                                <td>{{ number_format($income->price)  }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ number_format($income->amount)  }}</td>
                                                <td>{{ $income->created_at->toDateString() }}</td>
                                            </tr>
                                            <?php $count = $count + 1; ?>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7"> hakuna taarifa</td>
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

                    <div>
                        <div>
                            <div>
                               
                             <p class="font-17 text-times text-capitalize">mauzo kwa rejareja</p>
                               <p class="ml-3 text-times font-17">Jumla: <span
                                   class="text-app font-weight-bold">{{ number_format($total_litre_income) }} Tsh</span>
                               </p>
                              
                            
                            </div>

                            <table id="customers" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sno:</th>
                                        <th>Aina ya maziwa</th>
                                        <th>Ujazo</th>
                                        <th>Bei(Tsh)</th>
                                        <th>Idadi</th>
                                        <th>Kiasi(Tsh)</th>
                                        <th>Tarehe</th>
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
                                                <td>{{ number_format($income->price)  }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ number_format($income->amount)  }}</td>
                                                <td>{{ $income->created_at->toDateString() }}</td>
                                            </tr>
                                            <?php $counter = $counter + 1; ?>
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="7"> hakuna taarifa</td>
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
                    <div id="kwa_yogurt_div" >
                        <div class="table-responsive">
                            <div>
                               <p class="font-17 text-times text-capitalize">mauzo ya yogurt</p>
                               <p class="ml-3 text-times font-17">Jumla: <span
                                    class="text-app font-weight-bold">{{ number_format($total_yogurt_income) }} Tsh</span> 
                               </p>
                            </div>

                            <table id="customers" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sno:</th>
                                        <th>Aina/Ujazo</th>
                                        <th>Bei(Tsh)</th>
                                        <th>Idadi</th>
                                        <th>Kiasi(Tsh)</th>
                                        <th>Tarehe</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($yogurt_incomes))
                                        <?php $j = 1; ?>
                                        @foreach ($yogurt_incomes as $income)
                                            <tr>
                                                <td>{{ $j }}</td>

                                                <td>{{ $income->capacity }}</td>
                                                <td>{{ number_format($income->price)  }}</td>
                                                <td>{{ $income->quantity }}</td>
                                                <td>{{ number_format($income->amount)  }}</td>
                                                <td>{{ $income->created_at->toDateString() }}</td>
                                            </tr>
                                            <?php $j = $j + 1; ?>
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="6" class="text-app text-center"> hakuna taarifa</td>
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

                <div style='margin-top: 10px;'>
                    <div>
                        <h3 class="text-app font-weight-bold text-uppercase">matumizi</h3>
                        <h5 class="text-times ml-3 font-weight-bold font-18">Jumla ya matumizi: <span
                                class="text-app">{{ number_format($total_expense) }} Tsh</span> </h5>
                        <table id="customers" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sno:</th>
                                    <th>lengo/kusudi</th>
                                    <th>kiasi(Tsh)</th>
                                    <th>wahusika</th>
                                    <th>Tarehe</th>
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
                                    </tr>
                                    <?php $i = $i + 1; ?>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center"> <p class="text-app">Bado hakuna taarifa</p> </td>
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
                <div class="mt-1" id="analysis_container">
                    <div style=" display: inline-block !important;border-radius: 7px;border: 2px solid #9273d2; margin-top: 37px;">
                        <div class="card-body" style="padding: 5px;">
                            <h3 style="color: black; margin: 1px auto;" class=" text-times">ANALYSIS</h3><br>

                            <h5 class=" text-times font-18">Jumla ya mapato: <span class="text-app font-weight-bold">{{ number_format($total_income) }} Tsh</span> </h5>
                            <h5 class=" text-times font-18">Jumla ya matumizi: <span class="text-app font-weight-bold">{{ number_format($total_expense) }} Tsh</span> </h5>
                            <hr>
                            <div>
                                <table>
                                    <tr>
                                        <td>

                                            <div> <h5 class="text-app font-18  text-times">Status:</h5></div>
                                        </td>
                                        @if ($total_income > $total_expense)
                                           <td><div> <h5 class="text-success font-18 text-times">+ {{ number_format($total_income-$total_expense)  }} Tsh</h5></div></td>
                                    </tr>
                                </table>
                                        <div style="margin-top: 1px;"><button class=" btn-outline-success  font-weight-bold">vizuri</button></div>
                                        @else
                                            <td><div><h5 class="text-danger font-18 text-times"> {{ number_format($total_income-$total_expense)  }} Tsh</h5></div></td>
                                        </tr>
                                            </table>
                                            <div style="margin-top: 1px;"><button class=" btn-outline-danger  font-weight-bold">vibaya</button></div>
                                        @endif  
                                        
                                    </tr>
                                </table>
                               
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>




       
    </body>
</html>
