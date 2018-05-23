<script>
$(document).ready(function () {
    let modal,
        product_price   = 0,
        quantity        = 0,
        discount        = 0,
        discountLabel   = "no-discount",
        product_id      = 0,
        senior_id       = "",
        discount_id     = 0,
        order_type      = 0,
        orderProductIdArray = [],
        orderObj        = [];

    // Load pending orders if this dining table's status is pending
    let getData = $.ajax({
        type: "POST",
        url: "{{ route('frontend.cashier.order.get_pendings', $dining->id) }}",
        data: {
            _token: "{{ csrf_token() }}",
            dining_id: "{{ $dining->id }}"
        },
        dataType: 'JSON',
        success: function (data) {
            let html = null;
            let total_price = 0;

            for (let i=0; i<data.length; i++) {
                let order       = data[i];
                let discount    = data[i].discount;

                orderObj.push(order);

                total_price += parseFloat(order.amount) * parseInt(order.quantity);

                if (order.discount_id != 0) {
                    html = `<a data-id="${order.id}" name="customer_order" id="customer_order" class="list-group-item list-group-item-action flex-column align-items-start border-0 rounded-0" style="margin-bottom: 1px; cursor: pointer; padding-top: 0px; padding-bottom: 8px;">`;
                    html +=    `<div class="d-flex w-100 justify-content-between">`;
                    html +=    `<h5 style="font-weight: 300;"><span class="margin-right: 1rem;">${order.quantity} <span style="font-size: 14px; font-weight: 300;">pc(s).</span> </span> ${order.product.name}</h5>`;
                    html +=    `<br>`;
                    html +=    `<h5 style="font-weight: 300;">PHP ${Number(order.amount * order.quantity).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits:2})}</h5>`;
                    html +=    `</div>`;
                    html +=    `<p class="mb-1" style="font-weight: 300; font-size: 14px;">Senior ID: ${order.senior_id}</p>`;
                    html +=    `<p class="mb-1" style="font-weight: 300; font-size: 14px; text-transform: capitalize;">${discount.name} - %${discount.discount}</p>`;
                    html += `</a>`;
                } else {
                    html = `<a data-id="${order.id}" name="customer_order" id="customer_order" class="list-group-item list-group-item-action flex-column align-items-start border-0 rounded-0" style="margin-bottom: 1px; cursor: pointer;">`;
                    html +=    `<div class="d-flex w-100 justify-content-between">`;
                    html +=    `<h5 style="font-weight: 300;"><span class="margin-right: 1rem;">${order.quantity} <span style="font-size: 14px; font-weight: 300;">pc(s).</span> </span> ${order.product.name}</h5>`;
                    html +=    `<br>`;
                    html +=    `<h5 style="font-weight: 300;">PHP ${order.amount}</h5>`;
                    html +=    `</div>`;
                    html += `</a>`;
                }

                $('#product-body').append(html);
            }

            console.log(orderObj);

            $('#total_amount').text("PHP " + Number(total_price).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2}));
        }
    });

    $('#product_modal').on('show.bs.modal', function (event) {
        let button      = $(event.relatedTarget);         // Button that triggered the modal
        let product     = button.data('name');            // Extract info from data-* attributes
        product_price   = parseFloat(button.data('price'));
        product_id      = button.data('id');

        modal = $(this);

        modal.find('.modal-title').text(product);
    }).on('click', 'button[name=numKey]', function () {
        const numkey = $(this)[0].innerText;
        let total = 0;

        if (quantity == 0) {
            quantity =+ numkey;
            total = computePrice(quantity, product_price, discount);
            $("#input_quantity").val(quantity);
        } else {
            quantity = quantity + numkey;
            total = computePrice(quantity, product_price, discount);
            $("#input_quantity").val(quantity);
        }

        $("#input_price").val(Number(total).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
    }).on('click', 'button[name=keyC]', function () { // Cancel Button
        $("#input_quantity").val(0);
        $("#input_price").val("0.00");
        price = 0;
        quantity = 0;
    }).on('click', 'button[name=keyB]', function () { // Backspace Button
        $("#input_quantity").val( function(index, value) {
            return quantity = value.substr(0, value.length - 1);
        });

        if (quantity.length == 0) {
            $("#input_quantity").val(0);
            $("#input_price").val('0.00');
        } else {
            let total = computePrice(quantity, product_price, discount);

            $("#input_price").val(Number(total).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
        }
    }).on('change', 'input[name=discount]', function () {
        let discountBtn     = $(this);
            discountLabel   = discountBtn.data('discount-title');

        // Get discount value
        discount = discountBtn.data('value');
        discount_id = discountBtn.data('discount_id');

        // If discount title is senior_citizen
        // Request for a Senior Citizen ID
        if (discountLabel == "senior_citizen") {
            $(document).off('focusin.modal');

            swal({
                text: 'Enter Senior Citizen ID:',
                html:
                '<div class="row" style="margin-right: -4px; margin-left: -4px;">'+
                    '<div id="senior_numpad">'+
                        '<h6 for="input_senior_id" class="form-control-label">Enter Senior Citizen ID:</h6>'+
                        '<input type="text" name="senior_id" id="input_senior_id" class="swal2-input" readOnly>'+
                        '<div class="numpad" style="margin-left: -5px;">'+
                            '<button name="senior_numkey" data-value="7" type="button" class="numkey btn-dark rounded-0">7</button>'+
                            '<button name="senior_numkey" data-value="8" type="button" class="numkey btn-dark rounded-0">8</button>'+
                            '<button name="senior_numkey" data-value="9" type="button" class="numkey btn-dark rounded-0">9</button>'+
                            '<button name="keyB" type="button" class="numkey btn-dark rounded-0"><i class="fas fa-chevron-left"></i></button>'+

                            '<button name="senior_numkey" data-value="4" type="button" class="numkey btn-dark rounded-0">4</button>'+
                            '<button name="senior_numkey" data-value="5" type="button" class="numkey btn-dark rounded-0">5</button>'+
                            '<button name="senior_numkey" data-value="6" type="button" class="numkey btn-dark rounded-0">6</button>'+
                            '<button name="keyC" type="button" class="numkey btn-dark rounded-0">C</button>'+

                            '<button name="senior_numkey" data-value="1" type="button" class="numkey btn-dark rounded-0">1</button>'+
                            '<button name="senior_numkey" data-value="2" type="button" class="numkey btn-dark rounded-0">2</button>'+
                            '<button name="senior_numkey" data-value="3" type="button" class="numkey btn-dark rounded-0">3</button>'+
                            '<button name="senior_numkey" data-value="0" type="button" class="numkey btn-dark rounded-0">0</button>'+
                        '</div>'+
                    '</div>'+
                '</div>',
                onOpen: () => {
                    let senior_citizen_id = "";

                    // Bind click event to the dynamic DOM (Document Object Model) senior_numpad
                    $("div[id=senior_numpad]").on('click', 'button[name=senior_numkey]',function (event) {
                        const key = $(this).data('value');
                        let input = $("div[id=senior_numpad]").find('input[name=senior_id]');

                        senior_citizen_id = senior_citizen_id + key;

                        input.val(senior_citizen_id);
                    }).on('click', 'button[name=keyB]', function () {
                        $("input[name=senior_id]").val( function(index, value) {
                            return senior_citizen_id = value.substr(0, value.length - 1);
                        });
                    }).on('click', 'button[name=keyC]', function () {
                        $("input[name=senior_id]").val("");
                        senior_citizen_id = "";
                    });
                },
                showCancelButton: true
            }).then((result) => {
                if (result.value) {
                    if ($("input[name=senior_id]").val() == "" ) {
                        swal({
                            text: 'Senior Citizen ID was not provided.',
                            type: 'error',
                            showCancelButton: true
                        }).then((result) => {
                            discount = 0;
                            let total = computePrice(quantity, product_price, discount);

                            $("label[name=discount_label]").removeClass("active");
                            $("label[data-discount-title=no_discount]").addClass("active");
                            $("input[name=discount]").attr('checked', 'true');

                            if (quantity != 0) {
                                $("#input_price").val(Number(total).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                            }
                        });
                    } else {
                        let total = computePrice(quantity, product_price, discount);

                        senior_id = $("input[name=senior_id]").val();

                        if (quantity != 0) {
                            $("#input_price").val(Number(total).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                        }
                    }
                } else {
                    discount = 0;

                    $("label[name=discount_label]").removeClass("active");
                    $("label[data-discount-title=no_discount]").addClass("active");
                    $("input[name=discount]").attr('checked', 'true');

                    let total = computePrice(quantity, product_price, discount);

                    if (quantity != 0) {
                        $("#input_price").val(Number(total).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                    }
                }
            });
        } else {
            let total = computePrice(quantity, product_price, discount);

            if (quantity != 0) {
                $("#input_price").val(Number(total).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
            }
        }
    }).on('click', '#confirm_btn', function (event) {
        let html = "";
        let total_price = 0;

        console.log(senior_id);
        $.ajax({
            type: "POST",
            url: "{{ route('frontend.cashier.order.save', $dining->id) }}",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
                quantity: quantity,
                discount_id: discount_id,
                senior_id: senior_id,
                order_type: order_type,
                dining_id: "{{ $dining->id }}",
                user_id: "{{ Auth::user()->id }}"
            },
            dataType: 'JSON',
            success: function (data) {
                const order_product = data.order_product,
                discount = data.discount,
                product = data.product,
                order = data.order;

                console.log(data);

                orderObj.push({
                    id: order_product.id,
                    amount: order_product.amount,
                    quantity: order_product.quantity
                });

                console.log(orderObj);

                for (let i=0; Object.keys(orderObj).length > i; i++) {
                    const order = orderObj[i];

                    total_price += parseFloat(order.amount) * parseInt(order.quantity);
                }

                if (order_product.discount_id != 0) {
                        html = `<a data-id="${order_product.id}" name="customer_order" id="customer_order" class="list-group-item list-group-item-action flex-column align-items-start border-0 rounded-0" style="margin-bottom: 1px; cursor: pointer; padding-top: 0px; padding-bottom: 8px;">`;
                        html +=    `<div class="d-flex w-100 justify-content-between">`;
                        html +=    `<h5 style="font-weight: 300;"><span class="margin-right: 1rem;">${order_product.quantity} <span style="font-size: 14px; font-weight: 300;">pc(s).</span> </span> ${product.name}</h5>`;
                        html +=    `<br>`;
                        html +=    `<h5 style="font-weight: 300;">PHP ${order_product.amount}</h5>`;
                        html +=    `</div>`;
                        html +=    `<p class="mb-1" style="font-weight: 300; font-size: 14px;">Senior ID: ${order_product.senior_id}</p>`;
                        html +=    `<p class="mb-1" style="font-weight: 300; font-size: 14px; text-transform: capitalize;">${discount.name} - %${discount.discount}</p>`;
                        html += `</a>`;
                    } else {
                        html = `<a data-id="${order_product.id}" name="customer_order" id="customer_order" class="list-group-item list-group-item-action flex-column align-items-start border-0 rounded-0" style="margin-bottom: 1px; cursor: pointer;">`;
                        html +=    `<div class="d-flex w-100 justify-content-between">`;
                        html +=    `<h5 style="font-weight: 300;"><span class="margin-right: 1rem;">${order_product.quantity} <span style="font-size: 14px; font-weight: 300;">pc(s).</span> </span> ${product.name}</h5>`;
                        html +=    `<br>`;
                        html +=    `<h5 style="font-weight: 300;">PHP ${order_product.amount}</h5>`;
                        html +=    `</div>`;
                        html += `</a>`;
                    }

                    $('#product-body').append(html);

                $('#total_amount').text("PHP " + Number(total_price).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2}));
                clearValues();
            }
        });
    }).on('click', 'button[id=cancel_btn]', function () {
        clearValues();
    });

    $('#product-body').on('click', "a[name=customer_order]", function () {
        let order = $(this);

        if (order.hasClass('selected_order')) {
            console.log('---------------THE SELECTED ITEM WAS REMOVED---------------')
            order.removeClass('selected_order');
            console.log(order.data('id'));
            _.remove(orderProductIdArray, function(value) {
                return value == order.data('id');
            });

            console.log(orderProductIdArray);
        } else {
            console.log('---------------AN ITEM WAS SELECTED---------------')
            order.addClass('selected_order');
            console.log(order.data('id'));
            orderProductIdArray.push(order.data('id'));

            console.log(orderProductIdArray);
        }
    });

    $('#remove_btn').on('click', function() {
        if (orderProductIdArray.count() == 0) {
            swal({
                title: 'There are no selected items to remove.',
                confirmButtonText: 'Ok',
                type: 'warning'
            });
        } else {
            swal({
                title: 'Are you sure you want to remove the selected items in the list?',
                showCancelButton: true,
                confirmButtonText: 'Remove',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then((result) => {
                if (result.value) {
                    swal({
                        title: 'Administrator Password',
                        input: 'password',
                        showCancelButton: true,
                        confirmButtonText: 'Remove Order',
                        showLoaderOnConfirm: false,
                        preConfirm: (password) => {
                            return new Promise((resolve) =>
                            {
                                $.ajax({
                                    type: 'get',
                                    url: '{{ url("admin_password") }}/' + password,
                                    success: function(data)
                                    {
                                        if(data > 0)
                                            resolve();
                                        else
                                            swal('Invalid Password', '', 'warning');
                                    }
                                });
                                //end ajax
                            })
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: 'POST',
                                url : '{{ route("frontend.cashier.order.remove_item", $dining->id) }}',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    _method: 'DELETE',
                                    order_product_array: orderProductIdArray
                                },
                                success: function(data) {
                                    console.log(data);
                                    swal({
                                        title: 'Selected items has been removed',
                                        showConfirmButton: true,
                                        showCancelButton: false,
                                        type: 'success'
                                    }).then((result) => {
                                        if (result.value)
                                            window.location.reload();
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }
    })

    $('button[name=order_type]').on('click', function () {
        let button = $(this);

        $('button[name=order_type]').removeClass('active');
        button.addClass('active');
        order_type = button.data('value');
    });

    function computePrice(quantity, product_price, discount) {
        discount = parseFloat(discount) / 100;

        let total_price = parseInt(quantity) * product_price.toPrecision();
        total_price = parseFloat(total_price) - (parseFloat(total_price) * parseFloat(discount));

        return total_price.toPrecision();
    }

    function clearValues() {
        product_price   = 0;
        quantity        = 0;
        discount        = 0;
        discountLabel   = "no-discount";
        product_id      = 0;
        discount_id     = 0;
        senior_id       = "";

        $("#input_price").val("0.00");
        $("#input_quantity").val(0);
        $("label[name=discount_label]").removeClass("active");
        $("label[data-discount-title=no_discount]").addClass("active");
        $("input[name=discount]").attr('checked', 'true');
    }
});
</script>