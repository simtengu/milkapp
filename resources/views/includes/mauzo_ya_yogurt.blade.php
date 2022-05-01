                <div style="display: none" class="pt-5 my-2 my-md-5" id="yogurt">
                    <h5 class="h4 py-3 text-app text-times">Mauzo ya yogurt</h5>
                    <form method="POST" action="{{ route('save_yogurt_income') }}" class="form">
                        @csrf

                        <div id="yogurt_container" class="form-group">
                            <label for="yogurt_capacity">Jina/ujazo wa chupa</label>
                            <select style="width:110px" class="d-block p-1" name="capacity" id="yogurt_capacity">
                                @forelse ($yogurt_bottles as $bottle)
                                    <option value={{ $bottle->price }}>{{ $bottle->capacity }}</option>
                                @empty
                                    <option value="">hakuna taarifa</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="my-2">
                            <label for="yogurt_price">bei</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;"
                                value={{ $yogurt_bottles->count() > 0 ? $yogurt_bottles[0]->price : 0 }} type="number"
                                id="yogurt_price" name="price" class="p-1 bg-app text-center" required>
                        </div>

                        <div id="yogurtQuantityContainer" class="form-group">
                            <label for="yogurtQuantity">idadi</label><br>
                            <input name="quantity" inputmode="numeric"
                                style="width: 110px;border: 1px solid grey !important" id="yogurtQuantity" type="number"
                                min="0" class="bg-app btn" required>
                        </div>

                        <div id="yogurtTotalAmountContainer" class="my-2">
                            <label for="yogurtTotalAmount">Jumla ya malipo</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;" type="number"
                                min="0" id="yogurtTotalAmount" name="amount" class="p-1 bg-app text-center" required>
                        </div>

                        <button style="width: 110px;" type="submit" class="btn text-center btn-app">Submit</button>
                    </form>
                </div>