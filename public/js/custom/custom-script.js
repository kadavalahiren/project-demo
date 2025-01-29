$(document).ready(function() {

    $(document).on('focusout', '.input_percentage', function() {

        var product_val_type = $("#product_val_type").val();
        var retailer_product_price = $("#product_price").val();
        var wholesaler_product_price = $("#wholesale_price").val();
        var input_percentage = $(this).val();
        var input_percentage_this = $(this);

        if (product_val_type == 1) { // retailer
            if (retailer_product_price == '' || retailer_product_price.length == 0) {
                swal(
                    'Oops...',
                    'Please select Product Price First!',
                    'error'
                );
                $(".input_percentage").val("");
                return false;
            } else {
                var val_percentage = (retailer_product_price * input_percentage) / 100;
                var retailer_discount_price = retailer_product_price - val_percentage;
                $(this).closest('#image-row1').find('.input_retail_price').val(
                    retailer_discount_price);
            }
        } else if (product_val_type == 2) { // wholesaler
            if (wholesaler_product_price == '' || wholesaler_product_price.length == 0) {
                swal(
                    'Oops...',
                    'Please select Product Price First!',
                    'error'
                );
                $(".input_percentage").val("");
                return false;
            } else {
                var val_percentage = (wholesaler_product_price * input_percentage) / 100;
                var wholesaler_discount_price = wholesaler_product_price - val_percentage;
                $(this).closest('#image-row1').find('.input_wholesaler_price').val(
                    wholesaler_discount_price);
            }

        } else { // both
            if ((wholesaler_product_price == '' || wholesaler_product_price.length == 0) || (
                    retailer_product_price == '' || retailer_product_price.length == 0)) {
                swal(
                    'Oops...',
                    'Please select Product Price First!',
                    'error'
                );
                $(".input_percentage").val("");
                return false;
            } else {
                var val_percentage = (wholesaler_product_price * input_percentage) / 100;
                var wholesaler_discount_price = wholesaler_product_price - val_percentage;
                $(this).closest('#image-row1').find('.input_wholesaler_price').val(
                    wholesaler_discount_price);

                var val_percentage = (retailer_product_price * input_percentage) / 100;
                var retailer_discount_price = retailer_product_price - val_percentage;
                $(this).closest('#image-row1').find('.input_retail_price').val(
                    retailer_discount_price);
            }

        }

    });

    // Delete Tax Class confirm once
    $(".delete_form").on("submit", function(event) {
        event.preventDefault();

        if (confirm("Are you sure you want to delete this Tax class?")) {
            $(this)[0].submit();
        }
    });

    $(".add_tax_class_form").on("submit", function(event) {
        event.preventDefault();
        if ($("tbody").find("tr").length <= 0) {
            $(".tax_rate_validation").show();
            return false;
        } else {
            $(".tax_rate_validation").hide();
            $(this)[0].submit();
            return true;
        }
    });

    $("#ship_method_type").on("change", function() {
        if ($(this).val() == "rate_distance") {
            $(".main_methodtype_chkbx").removeClass("d-none");
        } else {
            $(".main_methodtype_chkbx").addClass("d-none");
        }
    });

    $(".update_tax_class_form").on("submit", function(event) {
        event.preventDefault();
        if ($("tbody").find("tr").length <= 0) {
            $(".tax_rate_validation").show();
            return false;
        } else {
            $(".tax_rate_validation").hide();
            $(this)[0].submit();
            return true;
        }
    });

    // Delete Tax Class confirm once
    $(".delete_form_shipping").on("submit", function(event) {
        event.preventDefault();

        if (confirm("Are you sure you want to delete this Shipping Method?")) {
            $(this)[0].submit();
        }
    });

    //
    $("#select_apply_on").on("change", function() {
        $("#product_id").val('');
        $("#category_id").val('');
        $("#offer_id").val('');
        $('#slider_category_single').html('');
        $('#offer_single').html('');
        $('#product-related_single').html('');

        if ($(this).val() == "product" || $(this).val() == "products") {
            $(".main_product_section").removeClass("d-none");
            $(".main_category_section").addClass("d-none");
            $(".main_offer_section").addClass("d-none");
        } else if ($(this).val() == "category" || $(this).val() == "categories") {
            $(".main_category_section").removeClass("d-none");
            $(".main_product_section").addClass("d-none");
            $(".main_offer_section").addClass("d-none");
        } else if ($(this).val() == "offer") {
            $(".main_offer_section").removeClass("d-none");
            $(".main_product_section").addClass("d-none");
            $(".main_category_section").addClass("d-none");
        } else {
            $(".main_product_section").addClass("d-none");
            $(".main_category_section").addClass("d-none");
            $(".main_offer_section").addClass("d-none");
        }
    });
    $("#linked_too").on("change", function() {
        $("#speciality_id").val('');
        $("#service_id").val('');
        $("#offer_id").val('');
        $('#slider_category_single').html('');
        $('#offer_single').html('');
        $('#product-related_single').html('');
      
        if ($(this).val() == "speciality" || $(this).val() == "speciality") {
            $(".main_product_section").removeClass("d-none");
            $(".main_category_section").addClass("d-none");
            $(".main_offer_section").addClass("d-none");
        } else if ($(this).val() == "service" || $(this).val() == "categories") {
            $(".main_category_section").removeClass("d-none");
            $(".main_product_section").addClass("d-none");
            $(".main_offer_section").addClass("d-none");
        } else if ($(this).val() == "subservice") {
            $(".main_offer_section").removeClass("d-none");
            $(".main_product_section").addClass("d-none");
            $(".main_category_section").addClass("d-none");
        } else {
            $(".main_product_section").addClass("d-none");
            $(".main_category_section").addClass("d-none");
            $(".main_offer_section").addClass("d-none");
        }
    });
});