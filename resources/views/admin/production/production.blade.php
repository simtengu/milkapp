@extends('layouts.admin')
@section('content')
    <div class="container">

        <div class="row justify-content-center p-2">
            <div class="col-md-8 my-2">
                <h2 class="text-times font-22 text-app font-weight-bold">Today's Production</h2>
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


    });

</script>
@stop
