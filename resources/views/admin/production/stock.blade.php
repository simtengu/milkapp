@extends('layouts.admin')
@section('content')
    <div class="container">

        <div class="row justify-content-center p-2">
            <div class="col-md-9 my-2">
                <h2 class="text-times font-22 text-app font-weight-bold">Our Current Stock</h2>
                        @if (Session()->has('spoiled_milk_removed'))
                            <div class="alert alert-success my-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ Session('spoiled_milk_removed') }}</p>
                            </div>
                        @endif
                        @if (Session()->has('spoiled_bottle_removed'))
                            <div class="alert alert-success my-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ Session('spoiled_bottle_removed') }}</p>
                            </div>
                        @endif
{{-- rejareja stock............................................................................... --}}
       @include('includes.rejareja_stock')
{{-- bottles stock.................................................................   --}}
       @include('includes.bottles_stock')

            </div>
        </div>
    </div>
@stop()
@section('scripts')
<script>
    $(document).ready(function() {

            $("#bottles_container").on("change", ".bottle_capacity", function() {
              
                 $("#bottle_quantity").val(0);
            });

            //changing bottle capacities with change in milk type...................
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

