@extends('frontend.layouts.app')

@section('content')
<div class="row mb-4">
    <div id="ajaxSpinnerContainer">
        <div id="ajaxSpinner"></div>
    </div>
    <!-- Product List -->
    <div class="col-lg-9">
        <div class="row" style="padding-top: 1rem;">
            <div class="nav flex-column nav-pills rounded-0 ml-2" role="tablist" aria-orientation="vertical">
                <a class="nav-link pt-3 pb-3 active rounded-0"
                    id="pills-all-tab"
                    data-toggle="pill"
                    href="#v-pills-all"
                    role="tab"
                    aria-controls="v-pills-all">
                    {{ strtoupper("all") }}
                </a>

                @foreach ($categories as $category)
                    <a class="nav-link pt-3 pb-3 rounded-0"
                        id="pills-{{ strtolower(str_replace(' ', '-', $category->name)) }}-tab"
                        data-toggle="pill"
                        href="#v-pills-{{ strtolower(str_replace(' ', '-', $category->name)) }}"
                        role="tab"
                        aria-controls="v-pills-{{ strtolower(str_replace(' ', '-', $category->name)) }}">
                        {{ strtoupper($category->name) }}
                    </a>
                @endforeach
            </div>

            <div class="tab-content w-80" id="v-pills-tabContent">
                @if (count($products))
                <div
                    class="tab-pane fade show active"
                    id="v-pills-all"
                    role="tabpanel"
                    aria-labelledby="v-pills-all-tab">
                    <div class="col five-btns">
                        @foreach ($products as $product)
                        <button type="button" class="btn btn-outline-white rounded-0"
                            data-toggle="modal"
                            data-target="#product_modal"
                            data-name="{{ ucwords($product->name) }}";
                            data-id="{{ $product->id }}"
                            data-price="{{ $product->price }}">
                            {{ ucwords($product->code) }}
                        </button>
                        @endforeach
                    </div><!-- col five-btn -->
                </div><!-- tab-pane fade show active -->
                @else
                <div class="tab-pane fade show active"
                    id="v-pills-all"
                    role="tabpanel"
                    aria-labelledby="v-pills-all-tab">
                    <p class="text-center ml-2">There are no available products on this category...</p>
                </div><!-- tab-pane fade show active -->
                @endif

                @foreach ($categories as $category)
                    @if (count($category->products))
                    <div class="tab-pane fade"
                        id="v-pills-{{ strtolower(str_replace(' ', '-', $category->name)) }}"
                        role="tabpanel"
                        aria-labelledby="v-pills-{{ strtolower(str_replace(' ', '-', $category->name)) }}-tab">
                        <div class="col five-btns">
                            @foreach ($category->products as $product)
                            <button type="button" class="btn btn-outline-white rounded-0"
                                data-toggle="modal"
                                data-target="#product_modal"
                                data-name="{{ ucwords($product->name) }}";
                                data-id="{{ $product->id }}"
                                data-price="{{ $product->price }}">
                                    {{ ucwords($product->code) }}
                            </button>
                            @endforeach
                        </div><!-- col five-btn -->
                    </div><!-- tab-pane fade -->
                    @else
                    <div class="tab-pane fade"
                        id="v-pills-{{ strtolower(str_replace(' ', '-', $category->name)) }}"
                        role="tabpanel"
                        aria-labelledby="v-pills-{{ strtolower(str_replace(' ', '-', $category->name)) }}-tab">
                        <p class="text-center ml-2">There are no available products on this category...</p>
                    </div><!-- tab-pane fade -->
                    @endif
                @endforeach
            </div><!-- tab-content w-80 -->
        </div><!-- row -->
    </div><!-- col-lg-7 -->

    <div class="col-lg-3">
        <div class="sidebar-fixed">
            <div class="order">
                <div class="sidebar">
                    <div class="card rounded-0" style="height: 100%;">
                        <div class="card-header">
                            <h6 style="font-weight: 300px;">Table #
                            <span class="float-right" style="font-size: 14px;">{{ $dining->name }}</span>
                            </h6>

                        </div>
                        <div class="card-body order-body">
                            <div class="list-group border-0" id="product-body" style="height: 450px; overflow-y: scroll;">

                            </div>
                        </div><!-- card-body -->
                        <div class="card-body border-top pt-0 pb-0">
                            <h5 class="fw-3">Total Amount: <span class="float-right" id="total_amount"></span></h5>
                        </div><!-- card-body -->
                        <div class="card-body border-top pt-0 pb-0">
                            <div class="pt-3 pb-0">
                            <button class="btn-dark btn-lg fw-3 btn" name="checkout_btn" data-toggle="modal" data-target="#charge_modal">Bill Out</button>
                            <button class="btn-dark btn-lg fw-3 btn" name="print_btn">Print</button>
                            <button class="btn-dark btn-lg fw-3 btn" id="remove_btn">Remove Item</button>
                            <button name="cancel_btn" class="btn-dark btn-lg fw-3 mt-1 btn w-47">Cancel OR</button>
                            <a href="{{ route('frontend.user.dashboard') }}" class="btn-dark btn-lg fw-3 mt-1 btn w-39-25">Dashboard</a>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div>
            </div><!-- Order -->
        </div>
    </div><!-- col-lg-3 -->
</div><!-- row -->

<!-- Modal -->
<div id="charge_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Transaction No#: <b class="modal-title">{{ $order->id }}</b></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12" id="payment">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="table_number">Table Number</label>
                                    <input type="input" class="form-control" id="table_number" value="{{ $dining->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="table_description">Table Description</label>
                                    <input type="input" class="form-control" id="table_description" value='No description...' readonly>
                                </div>

                                @if($dining->price != 0)
                                    <div class="form-group">
                                        <label for="dining_cost">Dining Cost</label>
                                        <input type="input" class="form-control" id="dining_cost" placeholder='0.00' value="{{ $dining->price }}" readOnly>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="payable">Payable Order</label>
                                    <input type="input" class="form-control" id="payable_order" value='0.00' readonly>
                                </div>
                            </div> <!-- col-lg-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="payable">Total Payable</label>
                                    <input type="input" class="form-control" id="total_payable" value='0.00' readonly>
                                </div>

                                <div class="form-group">
                                    <label for="vat">12% VAT / VAT Amount</label>
                                    <input type="input" class="form-control" id="vat" value='0.00' readonly>
                                </div> <!-- form-group -->

                                <div class="form-group">
                                    <label for="change">Total Amount Due</label>
                                    <input type="input" class="form-control" id="total_amount_due" value='0.00' readonly>
                                </div> <!-- form-group -->
                            </div> <!-- col-lg-4 -->

                            <div class="col-lg-4">
                                @if ($dining->price != 0)
                                <div class="form-group">
                                    <label for="cash">Deposit</label>
                                    <input type="input" class="form-control" id="deposit" placeholder="0.00" pattern="[0-9]">
                                </div> <!-- form-group -->
                                @endif

                                <div class="form-group">
                                    <label for="cash">Cash</label>
                                    <input type="input" class="form-control" id="cash" placeholder="0.00" pattern="[0-9]">
                                </div> <!-- form-group -->

                                <div class="form-group">
                                    <label for="change">Change</label>
                                    <input type="input" class="form-control" id="change" value='0.00' readonly>
                                </div> <!-- form-group -->

                            </div> <!-- col-lg-4 -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="notify" style="color:red" class="pull-left"></span>
                <button class="btn-dark btn-lg fw-3 btn rounded-0" name="checkout_btn" data-toggle="modal" data-target="#check_out_modal" data-keyboard="false" data-backdrop="static">Bill Out</button>
                <button type="button" class="btn btn-lg btn-danger rounded-0" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<form action="{{ route('frontend.cashier.order.complete_order', $order->id) }}" class="modal fade bd-example-modal-sm printModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="check_out_modal" method="POST">
    {{ csrf_field() }}
    <div class="modal-dialog">
        <div class="modal-content printable">
            <div class="modal-body official_receipt">
                <div class="receipt">
                    <p class="text-center fs-3">MANDA'S BULALUHAN & GRILL</p>
                    <p class="text-center fs-1">#468 Barangka Drive, Brgy. Malamig</p>
                    <p class="text-center fs-1">Mandaluyong City</p>
                    <p class="text-center">TIN # 009-841-115-000</p>
                </div>
                <p class="text-center fs-1">{{ date('m/d/Y (l) H:i:s') }}</p>
                <br>
                <hr style="border-top: 1px dashed black">
                <br>
                <div class="receipt">
                    <p>TABLE NO# 1</p>
                    <p>RCPT# <span id="receipt_id"></span></p>
                    <p>STAFF: {{ $logged_in_user->full_name }}</p>
                    <br>
                </div>
                <div class="receipt">
                    @if ($dining->price != 0)
                    <p class="fs-2">KTV RATE <span class="float-right">{{ number_format($dining->price, 2) }}</span></p>
                    @endif
                    <div class="receipt_orders" id="customer_order_list">
                        <p></p>
                    </div>
                    <br>
                    <p>VAT Amount <span class="float-right" id="vat">0.00</span></p>
                    <p>Vatable Sales  <span class="float-right">0.00</span></p>
                    <br>
                    @if ($dining->price != 0)
                    <p class="fs-2">ORDER COST: <span class="float-right" id="order_total">0.00</span></p>
                    <br>
                    @endif
                    <p class="fs-2">TOTAL:
                        <span class="float-right" id="total">0.00</span>
                        <span class="sub-info fs-1">PESO
                            <span class="float-right" id="cash">0.00</span>
                        </span>
                        @if ($dining->price != 0)
                        <span class="sub-info fs-1">KTV Deposit
                            <span class="float-right" id="dining_credit">0.00</span>
                        </span>
                        @endif
                    </p>
                    <p class="fs-2">CHANGE DUE  <span class="float-right" id="change_due">0.00</span></p>
                </div>
                <br>
                <hr style="border-top: 1px dashed black">
                <br>
                <div class="receipt">
                    <p class="text-center fs-1">THIS IS NOT AN OFFICIAL RECEIPT</p>
                    <p class="text-center fs-1">NO SERVICE CHARGE</p>
                    <p class="text-center">ExcelAsia Business Solutions</p>
                    <p class="text-center">Unit 5 2nd Floor 463 MRP Bldg.</p>
                    <p class="text-center">Barangka Drive corner</p>
                    <p class="text-center">San Rafael St. Plainview</p>
                    <p class="text-center">Mandaluyong City 1550</p>
                    <p class="text-center">DATE ISSUED: {{ date('m/d/Y') }}</p>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success rounded-0" type="submit">
                    Bill Out
                </button>

                <button class="btn btn-danger rounded-0" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</form>

@include('frontend.user.dashboard.modals')
@endsection

@push('after-scripts')
    @include('frontend.user.dashboard.script')
@endpush