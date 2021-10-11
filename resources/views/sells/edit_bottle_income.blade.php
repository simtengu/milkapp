@extends('layouts.admin')
@section('content')
    <div class="container py-4 px-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-md-7 px-4">
                {{-- mauzo kwa chupa update section........................................................... --}}
                <div  class="pt-5 my-2 my-md-5" id="chupa">
                    <div class="d-flex justify-content-between">
                        <div> <h5 class="h4 py-3 text-app text-times">Badili taarifa</h5></div>
                        <div>
                            <form id="income_delete_form" method="POST" action="{{ route('remove_bottle_income',$income->id) }}" class="form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Futa taarifa</button>
                            </form>
                        </div>
                    </div>
                    
                @if (Session()->has('income_updated'))
                    <div class="alert alert-success my-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{ Session('income_updated') }}</p>
                    </div>
                @endif
                    <form method="POST" action="{{ route('update_bottle_income',$income->id) }}" class="form">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="bottleMilkType">Aina ya maziwa</label>
                            <select style="width:110px" class="d-block p-1" name="milk_type" id="bottleMilkType">
                                @if ($income->milk_type == "mgando")          
                                <option selected value="mgando">mgando</option>
                                <option value="fresh">fresh</option>
                                 @else
                                 <option  value="fresh" selected>fresh</option>                              
                                 <option  value="mgando">mgando</option>
                                @endif
                            </select>
                        </div>

                        <div id="bottle_capacity_container" class="form-group">
                            <label for="bottleCapacity">Aina ya chupa</label>
                            <select style="width:110px" class="d-block p-1" name="bottle_capacity" id="bottleCapacity">
                                @foreach ($bottles as $bottle)
                                  @if ($bottle->price == $income->price)
                                  <option value={{ $bottle->price }} selected >{{ $bottle->capacity }}</option>
                                    @else
                                  <option value={{ $bottle->price }} >{{ $bottle->capacity }}</option>
                                  @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="my-2">
                            <label for="bottle_price">bei ya chupa</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;"
                                value={{ $income->price }} type="number"
                                id="bottle_price" name="price" class="p-1 bg-app text-center" required>
                        </div>

                        <div id="bottleQuantityContainer" class="form-group">
                            <label for="bottleQuantity">idadi ya chupa</label><br>
                            <input name="quantity" inputmode="numeric"
                                style="width: 110px;border: 1px solid grey !important" value="{{ $income->quantity }}" id="bottleQuantity" type="number"
                                min="0" class="bg-app btn" required>
                        </div>

                        <div id="bottleTotalAmountContainer" class="my-2">
                            <label for="bottleTotalAmount">Jumla ya malipo</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;" type="number"
                                min="0" id="bottleTotalAmount" value="{{ $income->amount }}" name="amount" class="p-1 bg-app text-center" required>
                        </div>

                        <button style="width: 110px;" type="submit" class="btn text-center btn-app">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
   <script>

       $(document).ready(function(){

            //changing bottle price with change in bottle type...................
            $("#bottle_capacity_container").on("change", "#bottleCapacity", function() {
                let price = $("#bottleCapacity").val();
                $("#bottle_price").val(price);

                            $("#bottleTotalAmount").val(0);
                            $("#bottleQuantity").val(0);
            });

            //fetching system bottles available according to type of  milk

            $("#bottleMilkType").change(function() {
                let milkType = $(this).val();
                let url = "{{ url('fetch_bottles') }}" + "/" + milkType;

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

                        if (res.data == "error") {
                            alert(
                                "something went wrong..probably it's because of your unappropriate way of request sending");
                        } else {
                            $("#bottleCapacity").replaceWith(res.data);
                            $("#bottle_price").val(res.initial_price);
                            $("#bottleTotalAmount").val(0);
                            $("#bottleQuantity").val(0);
                        }
                    },
                    error: function() {
                        alert('something went wrong please try again later');
                    }
                });
            });

            //calculating total amount  for bottle operation...........................................

            $("#bottleQuantity").keyup(function() {
                let quantity = $(this).val();
                let validated_quantity = quantity == "" ? 0 : quantity;
                let bottle_price = $("#bottle_price").val();
                let total_amount = validated_quantity * bottle_price;
                $("#bottleTotalAmount").val(total_amount);

            });



            //income deleting form .......................
            $("#income_delete_form").submit(function(e) {
                if(!confirm('unathibitisha kuondoa taarifa hii?')){
                  e.preventDefault();
                }
            })
       });
  </script> 
@endsection