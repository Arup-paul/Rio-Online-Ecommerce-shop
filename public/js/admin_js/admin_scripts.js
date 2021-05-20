$(document).ready(function() {
    //Check Admin Password is correct or not
    $("#current_pwd").keyup(function() {
        var current_pwd = $("#current_pwd").val();
        //ajax request
        $.ajax({
            type: "post",
            url: "/admin/check-current-pwd",
            data: { current_pwd: current_pwd },
            success: function(resp) {
                if (resp == "false") {
                    //check password for false
                    $("#check_current_password").html(
                        "<font color='red'>Current Password is Incorrect</font>"
                    );
                } else if (resp == "true") {
                    //check password for true
                    $("#check_current_password").html(
                        "<font color='green'>Current Password Match</font>"
                    );
                }
            },
            error: function() {
                //anything wrong
                alert("Error");
            }
        });
    });


    //confirm delete with Sweet alert
     $(document).on("click",".confirmDelete",function(){
        var record = $(this).attr("record"); //product
        var recordid = $(this).attr("recordid"); //1

        Swal.fire({
            title: "Are you sure?",
            text: "Delete this " + record,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.value) {
                window.location.href =
                    "/admin/delete_" + record + "/" + recordid;
            }
        });
    });

    //update section status in section module
    $(".updateSectionStatus").click(function() {
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $.ajax({
            type: "post",
            url: "/admin/update_section_status",
            data: {
                status: status,
                section_id: section_id
            },
            success: function(resp) {
                if (resp["status"] == 0) {
                    $("#section-" + section_id).html(
                        "<a class='updateSectionStatus badge badge-danger' href='javascript:void(0)'> Inctive</a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#section-" + section_id).html(
                        "<a class='updateSectionStatus badge badge-success' href='javascript:void(0)'> Active</a>"
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //update category status in category module
    $(".updateCategoryStatus").click(function() {
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        $.ajax({
            type: "post",
            url: "/admin/update_category_status",
            data: {
                status: status,
                category_id: category_id
            },
            success: function(resp) {
                if (resp["status"] == 0) {
                    $("#category-" + category_id).html(
                        "<a class='updateCategoryStatus badge badge-danger' href='javascript:void(0)'> Inctive</a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#category-" + category_id).html(
                        "<a class='updateCategoryStatus badge badge-success' href='javascript:void(0)'> Active</a>"
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //Append Categories Level
    $("#section_id").change(function() {
        var section_id = $(this).val();
        $.ajax({
            type: "post",
            url: "/admin/append_categories_level",
            data: { section_id: section_id },
            success: function(resp) {
                $("#appendCategoriesLevel").html(resp);
            },
            error: function(resp) {
                alert("Error");
            }
        });
    });

    //confirm delete functionality with jquery
    // $(".confirmDelete").click(function () {
    //     var name = $(this).attr("name");
    //     if (confirm("Are You sure to delete this " + name + "?")) {
    //         return true;
    //     }
    //         return false;

    // });


    //update Product status in product module
    $(".updateProductStatus").click(function() {
        var status = $(this).text();
        var product_id = $(this).attr("product_id");
        $.ajax({
            type: "post",
            url: "/admin/update_product_status",
            data: {
                status: status,
                product_id: product_id
            },
            success: function(resp) {
                if (resp["status"] == 0) {
                    $("#product-" + product_id).html(
                        "<a class='updateProductStatus badge badge-danger' href='javascript:void(0)'> Inctive</a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#product-" + product_id).html(
                        "<a class='updateProductStatus badge badge-success' href='javascript:void(0)'> Active</a>"
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

      //update Attribute status in product module
      $(".updateAttributeStatus").click(function() {
        var status = $(this).text();
        var attribute_id = $(this).attr("attribute_id");
        $.ajax({
            type: "post",
            url: "/admin/update_attribute_status",
            data: {
                status: status,
                attribute_id: attribute_id
            },
            success: function(resp) {
                if (resp["status"] == 0) {
                    $("#attribute-" + attribute_id).html(
                        "<a class=' badge-danger'>Inctive</a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#attribute-" + attribute_id).html(
                        "<a class=' badge-success'>Active</a>"
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

     //update Attribute status in product module
     $(".updateImageStatus").click(function() {
        var status = $(this).text();
        var image_id = $(this).attr("image_id");
        $.ajax({
            type: "post",
            url: "/admin/update_image_status",
            data: {
                status: status,
                image_id: image_id
            },
            success: function(resp) {
                if (resp["status"] == 0) {
                    $("#image-" + image_id).html(
                        "<a class=' badge-danger'>Inctive</a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#image-" + image_id).html(
                        "<a class=' badge-success'>Active</a>"
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //update Brand status in product module
    $(".updateBrandStatus").click(function() {
        var status =  $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        $.ajax({
            type: "post",
            url: "/admin/update_brand_status",
            data: {
                status: status,
                brand_id: brand_id
            },
            success: function(resp) {
                if (resp["status"] == 0) {
                    $("#brand-" + brand_id).html(
                        "  <i class='fa fa-toggle-off' status='InActive'></i> "
                    );
                } else if (resp["status"] == 1) {
                    $("#brand-" + brand_id).html(
                        " <i class='fa fa-toggle-on' status='Active'></i> "
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

     //update Brand status in product module
     $(".updateBannerStatus").click(function() {
        var status =  $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        $.ajax({
            type: "post",
            url: "/admin/update_banner_status",
            data: {
                status: status,
                banner_id: banner_id
             },
            success: function(resp) {
                if (resp["status"] == 0) {
                    $("#banner-" + banner_id).html(
                        "  <i class='fa fa-toggle-off' status='InActive'></i> "
                    );
                } else if (resp["status"] == 1) {
                    $("#banner-" + banner_id).html(
                        " <i class='fa fa-toggle-on' status='Active'></i> "
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

      //update coupon status in coupon module
      $(".updatecouponStatus").click(function() {
        var status = $(this).text();
        var coupon_id = $(this).attr("coupon_id");
        $.ajax({
            type: "post",
            url: "/admin/update_coupon_status",
            data: {
                status: status,
                coupon_id: coupon_id
            },
            success: function(resp) {
                if (resp["status"] == 0) {
                    $("#coupon-" + coupon_id).html(
                        "<a class='updatecouponStatus badge badge-danger' href='javascript:void(0)'> Inctive</a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#coupon-" + coupon_id).html(
                        "<a class='updatecouponStatus badge badge-success' href='javascript:void(0)'> Active</a>"
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //products Attributes Add/Remove Script

    var maxField = 10;
    var addButton = $(".add_button");
    var wrapper = $(".field_wrapper");
    var fieldHtml =
        '<div style="margin-top:10px; margin-left:2px;"> <input id="size" required  type="text" name="size[]"  placeholder="Size" style="width: 120px;"/>&nbsp;<input required id="sku" style="width: 120px;" type="text" name="sku[]" placeholder="SKU"/>&nbsp;<input required id="price" style="width: 120px;"  type="text" name="price[]"placeholder="Price"/>&nbsp;<input id="stock" style="width: 120px;" required  type="text" name="stock[]"  placeholder="Stock"/> &nbsp; <a  href="javascript:void(0);" class="remove_button text-danger"><i class="fa fa-trash"></i></a></div>';
    var x = 1;

    $(addButton).click(function() {
        if (x < maxField) {
            x++;
            $(wrapper).append(fieldHtml);
        }
    });

    $(wrapper).on("click", ".remove_button", function(e) {
        e.preventDefault();
        $(this)
            .parent("div")
            .remove();
        x--;
    });
});
