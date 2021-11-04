                <div class=" my-4 px-3">
                    <div class=" mt-5">
                        <h5 class=" text-dark mb-4">
                            Mapokezi ya maziwa
                        </h5>
                    </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Pokea maziwa</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('production.receive_milk') }}" class="form">
                                        @csrf
                                        <div>

                                            <p class="text-dark text-arial font-18">Idadi ya lita</p>
                                            <div class="form-group d-flex">
                                                <input name="lita" type="number" min="0" class="form-control" required>
                                                <button type="submit" class="btn btn-app">Ongeza</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive card p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                            <p class="text-dark font-18 text-capitalize mt-2"></p>
                            <button type="button" data-toggle="modal" data-target="#myModal"
                                class="btn btn-sm btn-success">pokea maziwa</button>
                        </div>

                        @if (Session()->has('milk_received'))
                            <div class="alert alert-success my-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ Session('milk_received') }}</p>
                            </div>
                        @endif
                        @if (Session()->has('received_litre_updated'))
                            <div class="alert alert-success my-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ Session('received_litre_updated') }}</p>
                            </div>
                        @endif

                        <table class="table table-striped">
                            <tbody>
                                @forelse ($today_litres as $item)

                                    <tr>
                                        <td>Zimepokelewa</td>
                                        <td>
                                            <div class="d-flex justify-content-around align-items-center">
                                                <div>
                                                    <p class="text-muted text-lead">Lita</p>
                                                </div>
                                                <div>
                                                    <form method="POST"
                                                        action="{{ route('production.update_received_milk', $item->id) }}"
                                                        class="form">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class=" form-group">
                                                            <div class="d-flex">

                                                                <input name="lita" id="editFormInput" class="text-dark"
                                                                    value={{ $item->lita }} type="number" required />
                                                                <button type="submit"
                                                                    class="btn btn-warning btn-sm">edit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td>
                                            <p class="text-muted text-lead">Bado hayajafanyika mapokezi yoyote ya maziwa</p>
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            <p class="text-muted font-16 text-capitalize px-2 font-weight-bold mt-2">Jumla: lita
                                {{ $total_litres }}</p>
                        </div>
                    </div>



                </div>