@extends('layouts.admin')
@section('content')
    <div class="container">

        <div class="row justify-content-center p-2">
            <div class="col-md-8 my-2">
                                <div class="card">
                                    <div class="card-header text-capitalize bg-light">
                                        <h4 class="text-app">badili taarifa hapa</h4>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="POST" action="{{ route('production.update_bottle_produced',$data->id) }}"
                                            class="form">
                                            @csrf
    
                                             @method('PATCH')
                                            <div class="form-group">
                                                <label for="bottle_milk_type" class="text-muted text-arial font-18">Aina ya
                                                    maziwa </label>
                                                    <input type="text" value="{{ $data->milk_type }}" class="form-control" readonly>
                                            </div>
                                                {{-- bottle types and capacities...................................................................... --}}
                                            <div id="bottles_container" class="form-group">
                                                    <label class="text-muted text-arial font-18" for="mgando_bottles">Aina ya
                                                        chupa</label>
                                                        <input type="text" value="{{ $data->bottle_capacity }}" class="form-control bottle_capacity" readonly>
                                            </div>
    
                                            <div class="form-group">
                                                <label for="litres_quantity" class="text-muted text-arial font-18">Idadi ya
                                                    lita</label>
                                                <input type="number" value="{{ $data->litre }}" min="0" name="litre" class="form-control"
                                                    id="litres_quantity" required step="any">
                                            </div>
    
                                            <div class="form-group">
                                                <label for="bottle_quantity" class="text-muted text-arial font-18">Idadi ya
                                                    chupa</label>
                                                <input type="number" value="{{ $data->bottle_quantity }}" min="0" name="bottle_quantity" class="form-control"
                                                    id="bottle_quantity" novalidate>
                                            </div>
    
    
                                            <button type="submit" class="btn btn-app">Ongeza</button>
    
                                        </form>

                                    </div>
                                </div>

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


    });

</script>
@stop
