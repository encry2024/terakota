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
                            <a href="{{ route('frontend.user.dashboard') }}" class="btn-dark btn-lg fw-3 btn">Cancel</a>
                            <button class="btn-dark btn-lg fw-3 btn" name="checkout_btn" data-toggle="modal" data-target="#check_out_modal">Check-out</button>
                            <button class="btn-dark btn-lg fw-3 btn" name="print_btn">Print</button>
                            <a href="{{ route('frontend.user.dashboard') }}" class="btn-dark btn-lg fw-3 mt-1 btn">Dispose</a>
                            <button class="btn-dark btn-lg fw-3 btn mt-1" id="remove_btn">Remove</button>
                            <a href="{{ route('frontend.user.dashboard') }}" class="btn-dark btn-lg fw-3 mt-1 btn">Dashboard</a>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div>
            </div><!-- Order -->
        </div>
    </div><!-- col-lg-3 -->
</div><!-- row -->

<div class="modal fade bd-example-modal-sm printModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="check_out_modal">
    <div class="modal-dialog">
        <div class="modal-content printable">
            <div class="modal-body official_receipt">
                <br>
                <div class="receipt">
                    <p class="text-center fs-1">MANDA'S BULALUHAN & GRILL</p>
                    <p class="text-center fs-1">#468 Barangka Drive, Brgy. Malamig</p>
                    <p class="text-center fs-1">Mandaluyong City</p>
                    <p class="text-center">TIN # 009-841-115</p>
                </div>
                <p class="text-center fs-1">{{ date('m/d/Y (l) H:i:s') }}</p>
                <hr style="border-top: 1px dashed black">
                <div class="receipt">
                    <p>TABLE NO# 1</p>
                    <p>RCPT# <span id="receipt_id"></span></p>
                    <p>STAFF: {{ $logged_in_user->full_name }}</p>
                    <hr style="border-top: 1px dashed black">
                </div>
                <div class="receipt">
                    <div class="receipt_orders" id="customer_order_list">
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">
                    Check-out
                </button>
            </div>
        </div>
    </div>
</div>

@include('frontend.user.dashboard.modals')
@endsection

@push('after-scripts')
    @include('frontend.user.dashboard.script')
@endpush