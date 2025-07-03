"use strict";

/** Unit Start*/
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        // alert($('#edit_'+service).data('holder-name'));
        $('#unit_edit_name').val($('#edit_' + id).data('name'));
        $('#unit_edit_short_name').val($('#edit_' + id).data('short_name'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Unit End*/

/** Category Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#category_edit_name').val($('#edit_' + id).data('name'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Category End */

/** Brand Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#brand_edit_name').val($('#edit_' + id).data('name'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Brand End */

/** Warranty Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#warranty_edit_duration').val($('#edit_' + id).data('duration'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Warranty End */

/** Model Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#model_edit_brand_id').val($('#edit_' + id).data('brand_id'));
        $('#model_edit_name').val($('#edit_' + id).data('name'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Model End */

/** Warehouse Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#warehouse_edit_name').val($('#edit_' + id).data('name'));
        $('#warehouse_edit_phone').val($('#edit_' + id).data('phone'));
        $('#warehouse_edit_email').val($('#edit_' + id).data('email'));
        $('#warehouse_edit_address').val($('#edit_' + id).data('address'));
        $('#warehouse_edit_city').val($('#edit_' + id).data('city'));
        $('#warehouse_edit_zip_code').val($('#edit_' + id).data('zip_code'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Warehouse End */

/** Branch Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#branch_edit_name').val($('#edit_' + id).data('name'));
        $('#branch_edit_contact_name').val($('#edit_' + id).data('contact_name'));
        $('#branch_edit_phone').val($('#edit_' + id).data('phone'));
        $('#branch_edit_address').val($('#edit_' + id).data('address'));
        $('#branch_edit_note').val($('#edit_' + id).data('note'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Branch End */

/** Branch Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#designation_edit_name').val($('#edit_' + id).data('name'));
        $('#designation_edit_description').val($('#edit_' + id).data('description'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Branch End */

/** Employee Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#employee_edit_first_name').val($('#edit_' + id).data('first_name'));
        $('#employee_edit_last_name').val($('#edit_' + id).data('last_name'));
        $('#employee_edit_phone').val($('#edit_' + id).data('phone'));
        $('#employee_edit_email').val($('#edit_' + id).data('email'));
        $('#employee_edit_address').val($('#edit_' + id).data('address'));
        $('#employee_edit_gender').val($('#edit_' + id).data('gender'));
        $('#employee_edit_employee_type').val($('#edit_' + id).data('employee_type'));
        $('#employee_edit_birth_date').val($('#edit_' + id).data('birth_date'));
        $('#employee_edit_join_date').val($('#edit_' + id).data('join_date'));
        $('#employee_designation_id').val($('#edit_' + id).data('designation_id'));
        $('#employee_edit_salary').val($('#edit_' + id).data('salary'));
        $('#employee_edit_branch_id').val($('#edit_' + id).data('branch_id'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Employee End */

/** Service Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#service_edit_name').val($('#edit_' + id).data('name'));
        $('#service_edit_charge').val($('#edit_' + id).data('charge'));
        $('#service_edit_note').val($('#edit_' + id).data('note'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Service End */

/** Party Start */
function addMoreFeature() {
    let length = parseInt($(".duplicate-feature").length) + 1; // Increment length by 1
    if (length > 3) {
        toastr.error("You can not add more than 3 Reference!");
        return;
    }
    var newFeature = $(".duplicate-feature:last").clone().insertAfter("div.duplicate-feature:last");

    $('.reference:last').text('Reference - ' + length);
    $('.duplicate-feature:last .clear-input').val('');

    $('.duplicate-feature:last .clear-img').val(null); // Clear the file input
    $('.duplicate-feature:last .table-img').attr('src', ''); // Clear the image source
}

function removeFeature(button) {
    $(button).closest('.duplicate-feature').remove();
}
/** Party End */

/** Product Start */
function updateSalePrice() {
    let unitPrice = parseFloat($('.unit_price').val()) || 0;
    let discountType = $('.discount_type').val();
    let discount = parseFloat($('.discount').val()) || 0;

    // Calculate the sales price based on discount type
    let salePrice = 0;
    if (discountType === 'fixed') {
        salePrice = unitPrice - discount;
    } else if (discountType === 'percentage') {
        let discountAmount = unitPrice * (discount / 100);
        salePrice = unitPrice - discountAmount;
    }

    $('#sale_price').val(salePrice.toFixed(2));
}
// updateSalesPrice will call when these fields change
$('.unit_price, .discount_type, .discount, .vat').on('input change', updateSalePrice);

/** Product End */

/** Service Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#employee_edit_salary').val($('#edit_' + id).data('salary'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** Service End */

/** SMS Start */
//edit modal
$('.edit-btn').each(function () {
    let container = $(this);
    let id = container.data('id');

    $('#edit_' + id).on('click', function () {
        $('#sms_edit_party_id').val($('#edit_' + id).data('party_id'));
        $('#sms_edit_message').val($('#edit_' + id).data('message'));

        let editactionroute = $(this).data('url');
        $('#editForm').attr('action', editactionroute + '/' + id);
    });
});
/** SMS End */

//categories start
$('.category-edit-btn').on('click', function () {
    var url = $(this).data('url');
    var name = $(this).data('category-name');
    var status = $(this).data('category-status');
    var icon = $(this).data('category-icon');


    $('#category_name').val(name);
    $('#category_status').val(status);
    $('#category_icon').attr('src', icon);
    $('.updateCategoryForm').attr('action', url);
});
//categories End

//Service view Start
$('.service-view-btn').on('click', function () {
    $('#service_name').text($(this).data('service-name'));
});
//Service view End
//Reject view Start
$('.reject-view-btn').on('click', function () {
    $('#reject_reason').text($(this).data('reject-reason'));
});
//Reject view End


//Expense category view Start
$('.expenses-category-view-btn').on('click', function () {
    $('#expenses_category_name').text($(this).data('expenses-category-name'));
    $('#expenses_category_description').text($(this).data('expense-category-description'));
});
//Expense category view End

//Expense Category Edit Start
$('.expense-category-edit-btn').on('click', function () {
    var url = $(this).data('url');
    var name = $(this).data('expense-category-name');
    var status = $(this).data('expense-category-status');
    var description = $(this).data('expense-category-description');


    $('#expense_category_name').val(name);
    $('#expense_category_status').val(status);
    $('#expense_category_description').val(description);
    $('.updateExpenseCategoryForm').attr('action', url);
});
//Expense Category Edit End

//Expense view Start
$('.expenses-view-btn').on('click', function () {
    $('#expense_date').text($(this).data('expense-date'));
    $('#expense_name').text($(this).data('expense-name'));
    $('#expense_category').text($(this).data('expense-category'));
    $('#expense_amount').text($(this).data('expense-amount'));
    $('#expense_description').text($(this).data('expense-description'));
});
//Expense View End

//Withdraw Method view Start
$('.withdraw-method-view-btn').on('click', function () {
    $('#payment_method').text($(this).data('payment-method'));
    $('#method_currency').text($(this).data('method-currency'));
    $('#method_min_amount').text($(this).data('payment-min-amount'));
    $('#method_max_amount').text($(this).data('payment-max-amount'));
    $('#method_charge').text($(this).data('payment-charge'));
    $('#method_status').text($(this).data('method-status'));
});
//Withdraw Method view End


//Dynamic Withdraw Method Setting Start
$(document).on('click', ".add-new-item", function () {
    let html = `
    <div class="row row-items">
        <div class="col-sm-6">
            <label for="">Label</label>
            <input type="text" name="meta[label][]" value="" class="form-control" placeholder="Enter label name">
        </div>
        <div class="col-sm-5">
            <label for="">Input</label>
            <input type="text" name="meta[input][]" class="form-control" required
                placeholder="Enter input name">
        </div>
        <div class="col-sm-1 align-self-center mt-3">
            <button type="button" class="btn text-danger trash remove-btn-features"><i class="fas fa-trash"></i></button>
        </div>
    </div>
    `
    $(".manual-rows").append(html);
});


$(document).on('click', ".remove-btn-features", function () {
    var $row = $(this).closest(".row-items");
    $row.remove();
});

//Dynamic Withdraw Method Setting End

//Coupon view Start
$('.coupon-view-btn').on('click', function () {
    $('#coupon_name').text($(this).data('coupon-name'));
    $('#coupon_start_date').text($(this).data('coupon-start-date'));
    $('#coupon_code').text($(this).data('coupon-code'));
    $('#coupon_end_date').text($(this).data('coupon-end-date'));
    $('#coupon_discount_type').text($(this).data('coupon-discount-type'));
    $('#coupon_discount_discount').text($(this).data('coupon-discount-discount'));
    $('#coupon_status').text($(this).data('coupon-status'));
    $('#coupon_description').text($(this).data('coupon-description'));
    $('#coupon_image').text($(this).data('coupon-image'));
});

//report-types Edit Start
$('.report-types-edit-btn').on('click', function () {
    var url = $(this).data('url');
    var name = $(this).data('report-types-name');

    $('#report_types_name').val(name);
    $('.updateReportTypesForm').attr('action', url);
});
//Coupon view End

// //dynamic Field Start
// $(document).on('click', ".service-btn-possition", function () {
//     var $duplicateRow = $(this).closest(".duplicate-feature");
//     var $lastDuplicateRow = $duplicateRow.clone();
//     $lastDuplicateRow.find(".remove-btn-features").removeAttr('disabled');
//     $lastDuplicateRow.insertAfter($duplicateRow);
// });

// $(document).on('click', ".remove-btn-features", function () {
//     var $row = $(this).closest(".duplicate-feature");
//     $row.remove();
// });

// $(document).on('click', ".item-plus-button", function () {
//     var $duplicateRow = $(this).closest(".duplicate-feature");
//     var $lastDuplicateRow = $duplicateRow.clone();

//     var uniqueId = new Date().getTime();
//     $lastDuplicateRow.find('.image-preview').attr('id', 'img' + uniqueId);

//     $lastDuplicateRow.find('.form-control').val('');
//     $lastDuplicateRow.find('.image-preview').attr('src', $lastDuplicateRow.find('.image-preview').data('default-src'));
//     $lastDuplicateRow.find(".remove-btn-features").removeAttr('disabled');

//     $lastDuplicateRow.insertAfter($duplicateRow);
// });
// //Dynamic Filed End


//Dynamic Tags Start
$(document).on('click', ".add-new-tag", function () {
    let html = `
    <div class="row row-items">
    <div class="mt-2 col-lg-6">
    <label>Tags</label>
    <input type="text" name="tags[]"
        class="form-control clear-input" placeholder="Enter Tag">
    </div>
        <div class="col-sm-1 align-self-center mt-3">
            <button type="button" class="btn text-danger trash remove-btn-features"><i class="fas fa-trash"></i></button>
        </div>
    </div>
    `
    $(".manual-rows-tag").append(html);
});


$(document).on('click', ".remove-btn-features", function () {
    var $row = $(this).closest(".row-items");
    $row.remove();
});

//Dynamic Tags End


document.addEventListener('DOMContentLoaded', function() {
    var readMore = document.querySelector('.read-more');
    if (readMore) {
        readMore.addEventListener('click', function() {
            var moreText = document.querySelector('.more-text');
            if (moreText) {
                moreText.classList.toggle('show');
                this.textContent = moreText.classList.contains('show') ? 'Read Less...' : 'Read More...';
            }
        });
    }
});

//Influencer service view
$('.influencer-service-view-btn').on('click', function () {
    $('#influencer_service_title').text($(this).data('influencer-service-title'));
    $('#influencer_service_category').text($(this).data('influencer-service-category'));
    $('#influencer_service_price').text($(this).data('influencer-service-price'));
    $('#influencer_service_discount').text($(this).data('influencer-service-discount'));
    $('#influencer_service_status').text($(this).data('influencer-service-status'));
    $('#influencer_service_description').text($(this).data('influencer-service-description'));
    $('#influencer_service_image').attr('src', $(this).data('influencer-service-image'));

    const features = $(this).data('influencer-service-features');
    $.each(features, function(key, feature) {
        var userHtml = `<p>${feature}</p>`;
        $('#influencer-service-features-container').append(userHtml);
    });
});

//Service view
$('.service-view-btn').on('click', function () {
    $('#service_title').text($(this).data('service-title'));
    $('#service_category').text($(this).data('service-category'));
    $('#service_price').text($(this).data('service-price'));
    $('#service_discount').text($(this).data('service-discount'));
    $('#service_status').text($(this).data('service-status'));
    $('#service_description').text($(this).data('service-description'));
    $('#service_total_order').text($(this).data('service-total-order'));
    $('#service_completed_order').text($(this).data('service-completed-order'));
    $('#service_image').attr('src', $(this).data('service-image'));

    const features = $(this).data('service-features');
    $.each(features, function(key, feature) {
        var userHtml = `<p>${feature}</p>`;
        $('#service-features-container').append(userHtml);
    });
});


$('.influencer-reject').on('click', function () {
    var url = $(this).data('url');
    $('.influencerRejectForm').attr('action', url);
});


$('.influencer-approve').on('click', function () {
    var url = $(this).data('url');
    $('.influencerApproveForm').attr('action', url);
});


$('.influencer-banned').on('click', function () {
    var url = $(this).data('url');
    $('.influencerBannedForm').attr('action', url);
});


$('.influencer-service-reject').on('click', function () {
    var url = $(this).data('url');
    $('.influencerServiceRejectForm').attr('action', url);
});

$('.influencer-send-email').on('click', function () {
    var url = $(this).data('url');
    var email = $(this).data('influencer-email');

    $('#influencer_email').val(email);
    $('.influencerSendEmailForm').attr('action', url);
});


$('.client-banned').on('click', function () {
    var url = $(this).data('url');
    $('.clientBannedForm').attr('action', url);
});

$('.client-approve').on('click', function () {
    var url = $(this).data('url');
    $('.clientApprovedForm').attr('action', url);
});


$('.client-send-email').on('click', function () {
    var url = $(this).data('url');
    var email = $(this).data('client-email');

    $('#client_email').val(email);
    $('.clientSendEmailForm').attr('action', url);
});


//Payment type edit
$('.payment-type-edit-btn').on('click', function () {
    var url = $(this).data('url');
    var name = $(this).data('payment-type-name');
    var description = $(this).data('payment-type-description');

    $('#payment_type_name').val(name);
    $('#payment_type_desc').val(description);
    $('.paymentTypeUpdateForm').attr('action', url);
});


$('.service-reject').on('click', function () {
    var url = $(this).data('url');
    $('.serviceRejectForm').attr('action', url);
});
$('.price-update').on('click', function () {
    var url = $(this).data('url');
    var adminPrice = $(this).data('price');
    console.log("url",url)
    console.log("price",adminPrice)
    $('.servicePriceForm').attr('action', url);
    $('.adminPrice').val(adminPrice);

    
});


$('.manage-order-reject-modal-btn').on('click', function () {
    var url = $(this).data('url');
    $('.manageOrderRejectForm').attr('action', url);
});

$('.manage-order-paid-modal-btn').on('click', function () {
    var url = $(this).data('url');
    $('.manageOrderPaidForm').attr('action', url);
});


//Payment type edit
$('.banners-edit-btn').on('click', function () {
    var url = $(this).data('url');
    var banners_tile = $(this).data('banners-title');
    var banners_image = $(this).data('banners-image');
    var banners_status = $(this).data('banners-status');

    $('#banners_title').val(banners_tile);
    $('#banners_status').val(banners_status);
    $('#banners_image').attr('src', banners_image);
    $('.bannersUpdateForm').attr('action', url);
});



$('.refunds-reject').on('click', function () {
    var url = $(this).data('url');
    $('.refundRejectForm').attr('action', url);
});


$('.refunds-approve').on('click', function () {
    var url = $(this).data('url');
    $('.refundApproveForm').attr('action', url);
});


//Payment type edit
$('.social-media-edit-btn').on('click', function () {
    var url = $(this).data('url');
    var media_title = $(this).data('media-title');
    var media_url = $(this).data('media-url');
    var media_icon = $(this).data('media-icon');
    var media_status = $(this).data('media-status');

    $('#media_title').val(media_title);
    $('#media_url').val(media_url);
    $('#media_status').val(media_status);
    $('#media_icon').attr('src', media_icon);
    $('.mediaUpdateForm').attr('action', url);
});

// User View Modal
$('.user-view-btn').on('click', function () {
    $('#name').text($(this).data('name'));
    $('#phone').text($(this).data('phone'));
    $('#email').text($(this).data('email'));
    $('#address').text($(this).data('address'));
    $('#country').text($(this).data('country'));
    $('#remarks').text($(this).data('remarks'));
});

