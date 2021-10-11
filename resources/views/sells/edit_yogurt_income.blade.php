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
                        <form id="yogurt_income_delete_form" method="POST"
                            action="{{ route('remove_yogurt_income', $income->id) }}" class="form">
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

                <form method="POST" action="{{ route('update_yogurt_income', $income->id) }}" class="form">
                    @csrf
                    @method('PATCH')

                        <div id="yogurt_container" class="form-group">
                            <label for="yogurt_capacity">Jina/ujazo wa chupa</label>
                            <select style="width:110px" class="d-block p-1" name="capacity" id="yogurt_capacity">
                            @foreach ($bottles as $bottle)
                                @if ($bottle->price == $income->price)
                                    <option value={{ $bottle->price }} selected>{{ $bottle->capacity }}</option>
                                @else
                                    <option value={{ $bottle->price }} >{{ $bottle->capacity }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>

                        <div class="my-2">
                            <label for="yogurt_price">bei</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;"
                                value={{ $income->price }} type="number"
                                id="yogurt_price" name="price" class="p-1 bg-app text-center" required>
                        </div>

                        <div id="yogurtQuantityContainer" class="form-group">
                            <label for="yogurtQuantity">idadi</label><br>
                            <input name="quantity" inputmode="numeric"
                                style="width: 110px;border: 1px solid grey !important" id="yogurtQuantity" type="number"
                               value="{{ $income->quantity }}" min="0" class="bg-app btn" required>
                        </div>

                        <div id="yogurtTotalAmountContainer" class="my-2">
                            <label for="yogurtTotalAmount">Jumla ya malipo</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;" type="number"
                                value="{{ $income->amount }}"   min="0" id="yogurtTotalAmount" name="amount" class="p-1 bg-app text-center" required>
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
            //changing yogurt bottle price with change in bottle type/capacity...................
            $("#yogurt_container").on("change", "#yogurt_capacity", function() {
                let price = $("#yogurt_capacity").val();
                $("#yogurt_price").val(price);
                            $("#yogurtTotalAmount").val(0);
                            $("#yogurtQuantity").val(0);
            });

            //calculating total amount  for yogurt operation...........................................

            $("#yogurtQuantity").keyup(function() {
                let quantity = $(this).val();
                let validated_quantity = quantity == "" ? 0 : quantity;
                let yogurt_price = $("#yogurt_price").val();
                let total_amount = validated_quantity * yogurt_price;
                $("#yogurtTotalAmount").val(total_amount);

            });

            //income deleting form .......................
            $("#yogurt_income_delete_form").submit(function(e) {
                if(!confirm('unathibitisha kuondoa taarifa hii?')){
                  e.preventDefault();
                }
            })

        });

    </script>
@endsection
