                <div class=" my-4 px-3">
                    <div class=" mt-5">
                        <h5 class=" text-dark mb-4">
                            Uzalishaji chupa
                        </h5>
                    </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="chupa">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title">Uzalishaji Chupa</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('production.produce_bottle') }}"
                                        class="form">
                                        @csrf


                                        <div class="form-group">
                                            <label for="bottle_milk_type" class="text-muted text-arial font-18">Aina ya
                                                maziwa </label>
                                            <select class="form-control text-dark" name="milk_type"
                                                id="bottle_milk_type" required>
                                                <option value="maziwa mgando" selected>mgando</option>
                                                <option value="maziwa fresh">fresh</option>
                                                <option value="yogurt">yogurt</option>
                                            </select>
                                        </div>
                                        {{-- bottle types and capacities(to be changed by ajax calls) ...................................................................... --}}
                                        <div id="bottles_container" class="form-group">
                                            <label class="text-muted text-arial font-18" for="mgando_bottles">Aina ya
                                                chupa</label>
                                            <select class="form-control  bottle_capacity" name="bottle_capacity"
                                                id="bottle_types">
                                                <option value="">chagua</option>
                                                @forelse ($mgando_bottles as $bottle)
                                                    <option value="{{ $bottle->capacity }}">{{ $bottle->capacity }}
                                                    </option>
                                                @empty
                                                    <option value="">hakuna taarifa</option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="litres_quantity" class="text-muted text-arial font-18">Idadi ya
                                                lita</label>
                                            <input type="number" min="0" name="litre" class="form-control"
                                                id="litres_quantity" required step="any">
                                        </div>

                                        <div class="form-group">
                                            <label for="bottle_quantity" class="text-muted text-arial font-18">Idadi ya
                                                chupa</label>
                                            <input type="number" min="0" name="bottle_quantity" class="form-control"
                                                id="bottle_quantity" novalidate>
                                        </div>


                                        <button type="submit" class="btn btn-app">Ongeza</button>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive card p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                            <p class="text-dark font-18 text-capitalize mt-2"></p>
                            <button type="button" data-toggle="modal" data-target="#chupa"
                                class="btn btn-sm btn-success">ongeza</button>
                        </div>

                        @if (Session()->has('bottle_produced'))
                            <div class="alert alert-success my-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ Session('bottle_produced') }}</p>
                            </div>
                        @endif
                        @if (Session()->has('bottle_updated'))
                            <div class="alert alert-success my-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ Session('bottle_updated') }}</p>
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead class="text-app">
                                <th>Aina ya maziwa</th>
                                <th>Aina ya chupa</th>
                                <th>Idadi ya lita</th>
                                <th>Idadi ya chupa</th>
                                <th>Edit</th>
                            </thead>
                            <tbody>
                                @forelse ($produced_bottles as $item)

                                    <tr>
                                        <td>
                                            {{ $item->milk_type }}
                                        </td>
                                        <td>
                                            {{ $item->bottle_capacity }}
                                        </td>
                                        <td>{{ $item->litre }}</td>
                                        <td>{{ $item->bottle_quantity }}</td>
                                        <td><a href="{{ route('production.edit_bottle_produced',$item) }}" class="text-primary">edit</a></td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-muted text-lead">Bado haujafanyika Uzalishaji wa maziwa ya
                                                rejareja</p>
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-muted font-16 text-capitalize px-2  mt-2">
                            <p class="font-weight-bold">Jumla(maziwa pekee)</p>
                            <p>lita: {{ $total_bottle_litres }}, chupa: {{ $total_bottle_quantity }}</p>
                        </div>
                    </div>



                </div>
