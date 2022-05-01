@extends('layouts.admin')
@section('content')
    <div class="container">

        <div class="row justify-content-center p-2">
            <div class="col-md-8 my-2">
                <h3 class="text-times text-app font-weight-bold text-center">Our Production</h3>

                <div class="d-flex flex-wrap mt-2 mt-md-5 mx-2">
                    <div>
                        <a href="{{ route('production.today_report') }}" class="btn btn-sm btn-outline-secondary mx-1">Today</a>
                    </div>
                    <div style="position: relative">
                        <button id="date_btn" class="btn btn-sm btn-outline-secondary mx-1">Date</button>
                        <div style="display:none; position: absolute;left:0px;top:31px;z-index:100;"
                            class="border rounded shadow bg-light" id="date_div">
                            <div style="border-radius: 5px 5px 0px 0px; background: linear-gradient(rgb(147, 56, 212),indigo) "
                                class="d-flex justify-content-center align-items-center p-1">
                                <p class="text-light text-times font-17 text-capitalize mt-1">pick date</p>
                            </div>

                            <div class="p-2">
                                <form method="POST" action="{{ route('production.date_report') }}" class="form">
                                    @csrf
                                    <div class="form-group">
                                        <input name="date" class="form-control" type="date" required>
                                        <button class="btn btn-app-outline mt-2 btn-sm btn-block">submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <h5 class="text-times text-lead text-muted mx-3 mt-3">{{ $filter }}</h5>
 
{{-- mapokezi ya maziwa.......................................................... --}}
       @include('includes.pokea_maziwa')
{{-- uzalishaji rejareja............................................................................... --}}
       @include('includes.uzalishaji_rejareja')
       {{-- uzalishaji chupa.................................................................   --}}
       @include('includes.uzalishaji_chupa')

            </div>
        </div>
    </div>
@stop()
@section('scripts')
<script>
    $(document).ready(function() {

            //count of litres and bottles............................
            $("#litres_quantity").keyup(function(){
                let litres = $(this).val();
            //check for bottle capacity ............................ 
                let bottleCapacity = $(".bottle_capacity").val();
                if (bottleCapacity == "") {
                     alert("Tafadhali chagua kwanza aina ya chupa");
                     $(this).val(0);
                     return;
                }
                if ((bottleCapacity == "lita") || (bottleCapacity == "lita moja") || (bottleCapacity == "lita 1")) {
                 let bottle_count = litres / 1 ;
                 $("#bottle_quantity").val(bottle_count);
                 return;
                    
                }else if((bottleCapacity == "nusu lita") || (bottleCapacity == "nusu")){
                let bottle_count = litres / 0.5 ;
                 $("#bottle_quantity").val(bottle_count);
                 return;
                }else if((bottleCapacity == "robo lita") || (bottleCapacity == "robo")){
                let bottle_count = litres / 0.25 ;
                 $("#bottle_quantity").val(bottle_count);
                 return;
                }else{
                    $("#bottle_quantity").val(0);

                }
            })


            $("#bottle_quantity").keyup(function(){
                let bottles = $(this).val();
             
                let bottleCapacity = $(".bottle_capacity").val();
                if (bottleCapacity == "") {
                     alert("Tafadhali chagua kwanza aina ya chupa");
                     $(this).val(0);
                     return;
                }
                if ((bottleCapacity == "lita") || (bottleCapacity == "lita moja") || (bottleCapacity == "lita 1")) {
                 let litre_count = bottles * 1 ;
                 $("#litres_quantity").val(litre_count);
                 return;
                    
                }else if((bottleCapacity == "nusu lita") || (bottleCapacity == "nusu")){
                let litre_count = bottles * 0.5 ;
                 $("#litres_quantity").val(litre_count);
                 return;
                }else if((bottleCapacity == "robo lita") || (bottleCapacity == "robo")){
                let litre_count = bottles * 0.25 ;
                 $("#litres_quantity").val(litre_count);
                 return;
                }else{
                    $("#litres_quantity").val(0);

                }
            })

            // $(".bottle_capacity").change(function(){
            // });

            $("#bottles_container").on("change", ".bottle_capacity", function() {
                 $("#litres_quantity").val(0);
                 $("#bottle_quantity").val(0);
            });

            //changing bottle capacities with change in bottle type...................
            $("#bottle_milk_type").change(function() {
               
                if ($(this).val() == "maziwa mgando") {  
  //fetch maziwa mgando bottles .......................................................
                let milk_type = "mgando";
                let url = "{{ url('production/fetch_production_bottles') }}" + "/" + milk_type;
                $.ajax({
                    url: url,
                    method: 'GET',
                    beforeSend: function() {
                        $("#loader_container").fadeIn();
                    },
                    complete: function() {
                        $("#loader_container").fadeOut();
                    },
                    success: function(res) {
                    //replacing latest bottle information with ones from server.............
                    $("#bottle_types").replaceWith(res.data);
                    $("#litres_quantity").val(0);
                    $("#bottle_quantity").val(0);
   
                    },
                    error: function() {
                        alert('something went wrong please try again later');
                    }
                });
          

                }

                if ($(this).val() == "maziwa fresh") {
              //fetch maziwa fresh bottles .......................................................
                let milk_type = "fresh";
                let url = "{{ url('production/fetch_production_bottles') }}" + "/" + milk_type;
                $.ajax({
                    url: url,
                    method: 'GET',
                    beforeSend: function() {
                        $("#loader_container").fadeIn();
                    },
                    complete: function() {
                        $("#loader_container").fadeOut();
                    },
                    success: function(res) {
                    //replacing latest bottle information with ones from server.............
                    $("#bottle_types").replaceWith(res.data);
                    $("#litres_quantity").val(0);
                    $("#bottle_quantity").val(0);
   
                    },
                    error: function() {
                        alert('something went wrong please try again later');
                    }
                });
                }

                if ($(this).val() == "yogurt") {
  //fetch  yogurt bottles .......................................................
                let milk_type = "yogurt";
                let url = "{{ url('production/fetch_production_bottles') }}" + "/" + milk_type;
                $.ajax({
                    url: url,
                    method: 'GET',
                    beforeSend: function() {
                        $("#loader_container").fadeIn();
                    },
                    complete: function() {
                        $("#loader_container").fadeOut();
                    },
                    success: function(res) {
                    //replacing latest bottle information with ones from server.............
                    $("#bottle_types").replaceWith(res.data);
                    $("#litres_quantity").val(0);
                    $("#bottle_quantity").val(0);
   
                    },
                    error: function() {
                        alert('something went wrong please try again later');
                    }
                });

                }

            });



            $("#date_btn").click(function(e) {
                $("#date_div").toggle();
                e.stopPropagation();
            })

            $(document).click(function() {
                $("#date_div").hide();
            });

            $("#date_div").click(function(e) {
                e.stopPropagation();
            })

    });

</script>
@stop
