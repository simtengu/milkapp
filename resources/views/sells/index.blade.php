@extends('layouts.admin')
@section('content')
    <div class="container py-4 px-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-md-7 px-4">
                <h2 class="cl-primary font-weight-bold app-title text-times">Mauzo</h2>
                <div class="d-flex mt-4 mb-2 justify-content-around">
                    <div class="text-center">
                        <div class="d-inline-block p-1 thumbnail bottle-div">
                            <img id="bottle-div-img" width="100" class="rounded-circle"
                                src="{{ asset('/images/bottle1.jpg') }}" alt="bottole img" />
                        </div>
                        <label class="my-2 d-block text-times">Chupa</label>
                    </div>
                    <div class="text-center">
                        <div class="d-inline-block p-1 thumbnail vessel-div">
                            <img id="vessel-div-img" width="100" class="rounded-circle"
                                src="{{ asset('/images/normal.jpg') }}" alt="bottole img" />
                        </div>
                        <label class="my-2 d-block text-times">Rejareja</label>
                    </div>

                    <div class="text-center">
                        <div class="d-inline-block p-1 thumbnail vessel-div">
                            <img id="yogurt-div-img" width="100" class="rounded-circle"
                                src="{{ asset('/images/yg1.jpg') }}" alt="bottole img" />
                        </div>
                        <label class="my-2 d-block text-times">Yogurt</label>
                    </div>
                </div>

                @if (Session()->has('income_saved'))
                    <div class="alert alert-success my-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{ Session('income_saved') }}</p>
                    </div>
                @endif

                {{-- mauzo kwa chupa section........................................................... --}}
                  @include('includes.mauzo_kwa_chupa')
                  {{-- mauzo kwa rejareja................................................................ --}}
                  @include('includes.mauzo_kwa_rejareja')
                  {{-- mauzo ya yogurt ....................................................................... --}}
                  @include('includes.mauzo_ya_yogurt')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //open mauzo kwa lita section..................
            $("#vessel-div-img").click(() => {
                $("#chupa").hide();
                $("#yogurt").hide();
                $("#rejareja").show();
            });
            //open mauzo kwa chupa section....................
            $("#bottle-div-img").click(() => {
                $("#rejareja").hide();
                $("#yogurt").hide();
                $("#chupa").show();
            })
            //open mauzo ya yogurt section....................
            $("#yogurt-div-img").click(() => {
                $("#rejareja").hide();
                $("#yogurt").show();
                $("#chupa").hide();
            })

            //changing bottle price with change in bottle type...................
            $("#bottle_capacity_container").on("change", "#bottleCapacity", function() {
                let price = $("#bottleCapacity").val();
                $("#bottle_price").val(price);

                            $("#bottleTotalAmount").val(0);
                            $("#bottleQuantity").val(0);
            });

            //changing yogurt bottle price with change in bottle type/capacity...................
            $("#yogurt_container").on("change", "#yogurt_capacity", function() {
                let price = $("#yogurt_capacity").val();
                $("#yogurt_price").val(price);
                            $("#yogurtTotalAmount").val(0);
                            $("#yogurtQuantity").val(0);
            });


            //changing volume price with change in volume type...................
            $("#volume_container").on("change", "#volume", function() {
                let price = $("#volume").val();
                $("#volume_price").val(price);
                            $("#volumeTotalAmount").val(0);
                            $("#volumeQuantity").val(0);
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
            //calculating total amount  for bottle operation...........................................

            $("#bottleQuantity").keyup(function() {
                let quantity = $(this).val();
                let validated_quantity = quantity == "" ? 0 : quantity;
                let bottle_price = $("#bottle_price").val();
                let total_amount = validated_quantity * bottle_price;
                $("#bottleTotalAmount").val(total_amount);

            });


            //calculating total amount  for volume operation...........................................

            $("#volumeQuantity").keyup(function() {
                let quantity = $(this).val();
                let validated_quantity = quantity == "" ? 0 : quantity;
                let volume_price = $("#volume_price").val();
                let total_amount = validated_quantity * volume_price;
                $("#volumeTotalAmount").val(total_amount);

            });

            //calculating total amount  for yogurt operation...........................................

            $("#yogurtQuantity").keyup(function() {
                let quantity = $(this).val();
                let validated_quantity = quantity == "" ? 0 : quantity;
                let yogurt_price = $("#yogurt_price").val();
                let total_amount = validated_quantity * yogurt_price;
                $("#yogurtTotalAmount").val(total_amount);

            });


        });

    </script>
@endsection
