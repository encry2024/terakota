@extends('frontend.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-lg-2">
        <!-- Left Menu -->
        <div class="row">
            <div class="col">
                <label for="order_type_container">TABLE:</label>
                <input type="text" class="form-control text-right rounded-0" readOnly value="{{ $dining->name }}">
            </div><!-- col -->
        </div><!-- row -->
        <hr>
        <div class="row">
            <div class="col">
                <label for="order_type_container">CUSTOMER:</label>
                <div class="btn-group-toggle btn-group-vertical col-lg-12" data-toggle="buttons" id="order_type_container">
                    <label class="btn btn-info rounded-0" style="padding: 15px;">
                        <input type="radio" autocomplete="off"> DINE-IN
                    </label>

                    <label class="btn btn-info rounded-0" style="padding: 15px;">
                        <input type="radio" autocomplete="off"> TAKE-OUT
                    </label>

                    <label class="btn btn-info rounded-0" style="padding: 15px;">
                        <input type="radio" autocomplete="off"> SALARY DEDUCT
                    </label>

                    <label class="btn btn-info rounded-0" style="padding: 15px;">
                        <input type="radio" autocomplete="off"> ACKNOWLEDGE
                    </label>
                </div><!-- btn-group-toggle -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- col-lg-2 -->

    <!-- Product List -->
    <div class="col-lg-7">
        <div class="row">
            <div class="nav flex-column nav-pills rounded-0" role="tablist" aria-orientation="vertical">
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
                        <button type="button" class="btn btn-dark bg-product rounded-0 btn-product"
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
                            <button type="button" class="btn btn-dark bg-product rounded-0 btn-product"
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
        <div class="card rounded-0">
            <div class="card-body order-body" id="order_container">
                <table class="table table-order">
                    <thead>
                        <th>PRODUCT</th>
                        <th>QTY</th>
                        <th>COST</th>
                    </thead>

                    <tbody id="order-container">
                    </tbody>
                </table>
            </div><!-- card-body -->
        </div><!-- card -->
    </div><!-- col-lg-3 -->
</div><!-- row -->

@include('frontend.user.dashboard.modals')
@endsection

@push('after-scripts')
    @include('frontend.user.dashboard.script')
@endpush