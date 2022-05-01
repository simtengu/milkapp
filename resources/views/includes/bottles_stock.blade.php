                <div class=" my-4 px-3">
                    <div class=" mt-5">
                        <h5 class=" text-dark mb-4">
                            Maziwa&Yogurt (chupa)
                        </h5>
                    </div>


                    <div class="table-responsive card p-3">

                        <table class="table table-striped">
                            <thead class="text-app">
                                <th>Aina ya maziwa</th>
                                <th>Aina ya chupa</th>
                               
                                <th>Idadi ya chupa</th>
                                
                            </thead>
                            <tbody>
                                @forelse ($bottles as $item)

                                    <tr>
                                        <td>
                                            {{ $item->milk_type }}
                                        </td>
                                        <td>
                                            {{ $item->bottle_capacity }}
                                        </td>
                                        
                                        <td>{{ $item->bottle_quantity }}</td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <p class="text-muted text-lead">hakuna taarifa kwa sasa</p>
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-muted font-16 text-capitalize px-2  mt-2">
                            <p class="font-weight-bold">Jumla(maziwa pekee)</p>
                            <p> Chupa: {{ $total_bottle_quantity }}</p>
                                                            <hr>
                                <div class="d-flex justify-content-around align-items-center flex-wrap my-2">
                                    <h5 class="text-times text-dark">Kuna chupa za yogurt/maziwa yaliyoharibika ?</h5>
                                <button type="button" data-toggle="modal" data-target="#chupa"
                                class="btn-sm btn-danger btn">ondoa</button>
                                </div>
                        </div>
                    </div>

                </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="chupa">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title">Ondoa Chupa Zilizoharibika</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('stock.remove_spoiled_bottles') }}"
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
                                                id="bottle_types" required>
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
                                            <label for="bottle_quantity" class="text-muted text-arial font-18">Idadi ya
                                                chupa</label>
                                            <input type="number" min="0" name="bottle_quantity" class="form-control"
                                                id="bottle_quantity" required>
                                        </div>


                                        <button type="submit" class="btn btn-app">ondoa</button>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
