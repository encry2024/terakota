
<!-- Product Modal -->
<div class="modal rounded-0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="product_modal">
    <div class="modal-dialog modal-lg rounded-0" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <button name="order_type" data-value="0" class="btn btn-primary rounded-0 text-center">DINE-IN</button>
                        <button name="order_type" data-value="1" class="btn btn-primary rounded-0">TAKE-OUT</button>
                        <button name="order_type" data-value="2" class="btn btn-primary rounded-0">SALARY DEDUCT</button>
                        <button name="order_type" data-value="3" class="btn btn-primary rounded-0">ACKNOWLEDGE</button>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <h6 for="label_quantity" class="form-control-label">PRODUCT QUANTITY</h6>
                            <input type="text" name="quantity" id="input_quantity" class="form-control rounded-0" disabled value="0">
                        </div>

                        <div class="form-group">
                            <h6 for="label_price" class="form-control-label">TOTAL PRICE</h6>

                            <div class="input-group">
                                <span class="input-group-prepend input-group-text rounded-0">PHP</span>
                                <input type="text" name="price" id="input_price" class="form-control rounded-0" disabled value="0.00">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-3">
                        <label>DISCOUNTS</label>
                        <div class="btn-group-toggle btn-group-vertical" data-toggle="buttons" id="order_type_container">
                            <label class="btn btn-info rounded-0 active" id="discount_label" data-discount-title="{{ str_replace(' ', '_', (strtolower('NO DISCOUNT'))) }}" style="padding: 25px 20px;">
                                <input type="radio" data-discount_id="0" data-value="0.00" checked="true" name="discount" data-discount-title="{{ str_replace(' ', '_', (strtolower('NO DISCOUNT'))) }}"> NO DISCOUNT
                            </label>
                            @foreach ($discounts as $discount)
                                <label class="btn btn-info rounded-0" name="discount_label" style="padding: 25px 20px;">
                                    <input type="radio" data-discount_id="{{ $discount->id }}" name="discount" data-value="{{ $discount->discount }}" data-discount-title="{{ str_replace(' ', '_', (strtolower($discount->name))) }}"> {{ strtoupper($discount->name) }}
                                </label>
                            @endforeach
                        </div><!-- btn-group-toggle -->
                    </div>

                    <div class="col-lg-7">
                        <div class="numpad">
                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">7</button>
                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">8</button>
                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">9</button>
                            <button name="keyB" type="button" class="numkey btn-dark rounded-0"><i class="fas fa-chevron-left"></i></button>

                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">4</button>
                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">5</button>
                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">6</button>
                            <button name="keyC" type="button" class="numkey btn-dark rounded-0">C</button>

                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">1</button>
                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">2</button>
                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">3</button>
                            <button name="numKey" type="button" class="numkey btn-dark rounded-0">0</button>
                        </div><!-- col five-btn -->
                    </div>

                    <div class="col">
                        <button id="confirm_btn" type="button" class="btn btn-info col-lg-12 rounded-0" style="padding: 25px 10px;" data-dismiss="modal">CONFIRM</button>
                        <br><br>
                        <button id="cancel_btn" type="button" class="btn btn-secondary col-lg-12 rounded-0" style="padding: 25px 10px;" data-dismiss="modal">CANCEL</button>
                    </div>

                    <div class="col"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Senior Citizen -->