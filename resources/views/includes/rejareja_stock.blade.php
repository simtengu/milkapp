                <div class=" my-4 px-3">
                    <div class=" mt-5">
                        <h5 class=" text-dark mb-4">
                            Maziwa (rejareja)
                        </h5>
                    </div>

                    <div class="table-responsive card p-3">


                        <table class="table table-striped">
                            <tbody>
                                @forelse ($litres as $item)
                                    <tr>
                                        <td>
                                            {{ $item->milk_type }}
                                        </td>
                                        <td>
                                           <span class="text-muted">lita: </span>  {{ $item->litre }}
                                        </td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td>
                                            <p class="text-muted text-lead">Hakuna taarifa kwa sasa</p>
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            <p class="text-muted font-16 text-capitalize px-2 font-weight-bold mt-2">Jumla: lita
                                {{ $litres_in_stock }}</p>
                                <hr>
                                <div class="d-flex justify-content-around align-items-center flex-wrap my-2">
                                    <h5 class="text-times text-dark">Kuna maziwa yaliyoharibika ?</h5>
                                <button type="button" data-toggle="modal" data-target="#rejareja"
                                class="btn-sm btn-danger btn">ondoa</button>
                                </div>
                        </div>
                    </div>

                </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="rejareja">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title">Ondoa maziwa yaliyoharibika</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('stock.remove_spoiled_milk') }}" class="form">
                                        @csrf
                                        

                                            <div class="form-group">
                                                <label for="milk_type" class="text-muted text-arial font-18">Aina ya maziwa </label>
                                                <select class="form-control text-dark" name="milk_type" id="milk_type" required>
                                                    <option value="maziwa mgando" selected>mgando</option>
                                                    <option value="maziwa fresh" >fresh</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-muted text-arial font-18" for="litre">Idadi ya lita</label>
                                                <input type="number" min="0" name="litre" id="litre" class="form-control" placeholder="weka idadi" required novalidate>
                                            </div>
                                            <button type="submit" class="btn btn-app">ondoa</button>
                                        
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
