@extends('layouts.admin')
@section('content')
    <div class="container py-4 px-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-md-7 px-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="h4 py-3 text-app text-times">Badili taarifa</h5>
                    </div>
                    <div>
                        <form id="litre_income_delete_form" method="POST"
                            action="{{ route('remove_litre_income', $income->id) }}" class="form">
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

                <form method="POST" action="{{ route('update_litre_income', $income->id) }}" class="form">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="bottleMilkType">Aina ya maziwa</label>
                        <select style="width:110px" class="d-block p-1" name="milk_type" id="volumeMilkType">
                            @if ($income->milk_type == 'mgando')
                                <option selected value="mgando">mgando</option>
                                <option value="fresh">fresh</option>
                            @else
                                <option value="fresh" selected>fresh</option>
                                <option value="mgando">mgando</option>
                            @endif
                        </select>
                    </div>

                    <div id="volume_container" class="form-group">
                        <label for="volume">Aina ya kipimo</label>
                        <select style="width:110px" class="d-block p-1" name="volume" id="volume">
                            @foreach ($volumes as $volume)
                                @if ($volume->price == $income->price)
                                    <option value={{ $volume->price }} selected>{{ $volume->volume }}</option>
                                @else
                                    <option value={{ $volume->price }}>{{ $volume->volume }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                    <div class="my-2">
                        <label for="volume_price">bei</label><br>
                        <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;"
                            value={{ $income->price }} type="number" id="volume_price" name="price"
                            class="p-1 bg-app text-center" required>
                    </div>

                    <div id="volumeQuantityContainer" class="form-group">
                        <label for="volumeQuantity">idadi</label><br>
                        <input name="quantity" inputmode="numeric" style="width: 110px;border: 1px solid grey !important"
                            id="volumeQuantity" type="number" value="{{ $income->quantity }}" min="0" class="bg-app btn"
                            required>
                    </div>

                    <div id="volumeTotalAmountContainer" class="my-2">
                        <label for="volumeTotalAmount">Jumla ya malipo</label><br>
                        <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;" type="number"
                            min="0" id="volumeTotalAmount" name="amount" value="{{ $income->amount }}" class="p-1 bg-app text-center" required>
                    </div>

                    <button style="width: 110px;" type="submit" class="btn text-center btn-app">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            //changing volume price with change in volume type...................
            $("#volume_container").on("change", "#volume", function() {
                let price = $("#volume").val();
                $("#volume_price").val(price);
                            $("#volumeTotalAmount").val(0);
                            $("#volumeQuantity").val(0);
            });

            //fetching system volumes available according to type of  milk

            $("#volumeMilkType").change(function() {
                let milkType = $(this).val();
                let url = "{{ url('fetch_volumes') }}" + "/" + milkType;

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
                        console.log(res);
                        if (res.data == "error") {
                            alert(
                                "something went wrong..probably it's because of your unappropriate way of request sending");
                        } else {
                            $("#volume").replaceWith(res.data);
                            $("#volume_price").val(res.initial_price);
                            $("#volumeTotalAmount").val(0);
                            $("#volumeQuantity").val(0);
                        }
                    },
                    error: function() {
                        alert('something went wrong please try again later');
                    }
                });
            });


            //calculating total amount  for volume operation...........................................

            $("#volumeQuantity").keyup(function() {
                let quantity = $(this).val();
                let validated_quantity = quantity == "" ? 0 : quantity;
                let volume_price = $("#volume_price").val();
                let total_amount = validated_quantity * volume_price;
                $("#volumeTotalAmount").val(total_amount);

            });

            //income deleting form .......................
            $("#litre_income_delete_form").submit(function(e) {
                if(!confirm('unathibitisha kuondoa taarifa hii?')){
                  e.preventDefault();
                }
            })

        });

    </script>
@endsection
