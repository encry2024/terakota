<script>
$(document).ready(function () {
    var modal,
        product_price = 0,
        quantity = 0,
        discount = 0,
        discountLabel = "no-discount",
        product_id = 0,
        senior_id = "",
        orderObj = [];

    $('#product_modal').on('show.bs.modal', function (event) {
        let button  = $(event.relatedTarget);         // Button that triggered the modal
        let product = button.data('name');            // Extract info from data-* attributes
        product_price   = parseFloat(button.data('price'));
        product_id      = button.data('id');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
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
    }).on('click', 'button[name=keyC]', function () {
        $("#input_quantity").val(0);
        $("#input_price").val("0.00");
        price = 0;
        quantity = 0;
    }).on('click', 'button[name=keyB]', function () {
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

                    $("div[id=senior_numpad]").on('click', 'button[name=senior_numkey]',function (event) {
                        const key = $(this).data('value');
                        let input = $("div[id=senior_numpad]").find('input[name=senior_id]');

                        senior_citizen_id = senior_citizen_id + key;

                        input.val(senior_citizen_id);
                        console.log(input);
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
                    if (result.value.length == 0) {
                        swal({
                            text: 'Senior Citizen ID was not provided.',
                            type: 'error',
                            showCancelButton: true
                        }).then((result) => {
                            discount = 0;

                            $("label[name=discount_label]").removeClass("active");
                            $("label[data-discount-title=no_discount]").addClass("active");
                            $("input[name=discount]").attr('checked', 'true');

                            let total = computePrice(quantity, product_price, discount);

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

        console.log(discountLabel);
    }).on('click', '#confirm_btn', function (event) {
        let html = "";

        orderObj.push({
            product_id: product_id,
            qty: quantity,
            total_cost: $('#input_price').val(),
            discount_id: $('input[name=discount]').data('discount_id'),
            discount_label: discountLabel
        });

        html = "<tr>";
        html += "<td class='table-item'>";
        html += modal.find('.modal-title').text();
        html += "<div class='sub-item'>"+ discountLabel.toLocaleLowerCase().replace(" ", "-") +"@%"+ discount +"</div>";
        html += "<div class='sub-item'>ID: "+ senior_id +"</div>";
        html += "</td>";
        html += "<td>"+ quantity +"</td>";
        html += "<td>"+ $('#input_price').val() +"</td>";
        html += "</tr>";

        $("#order-container").append(html);

        clearValues();
    }).on('click', 'button[id=cancel_btn]', function () {
        clearValues();
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

        $("#input_price").val("0.00");
        $("#input_quantity").val(0);
        $("label[name=discount_label]").removeClass("active");
        $("label[data-discount-title=no_discount]").addClass("active");
        $("input[name=discount]").attr('checked', 'true');
    }
});
</script>