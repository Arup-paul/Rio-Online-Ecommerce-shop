$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })

  $("#sort").on('change',function(){
    var sort = $(this).val();
    var fabric = get_filter("fabric");
    var fit =  get_filter("fit");
    var sleeve =  get_filter("sleeve");
    var occasion =  get_filter("occasion");
    var pattern =  get_filter("pattern");
    var url =  $("#url").val()
    $.ajax({
      url:url,
      method:"post",
      data:{occasion:occasion,pattern:pattern,sleeve:sleeve,fit:fit,fabric:fabric,sort:sort,url:url},
      success:function(data){
        $('.filter_products').html(data);
      }
    })
  });

  //fabric filter
  $(".fabric").on('click',function(){
    var fabric = get_filter(this);
    var sort = $("#sort option:selected").text();
    var url = $("#url").val();
    $.ajax({
      url:url,
      method:"post",
      data:{fabric:fabric,sort:sort,url:url},
      success:function(data){
        $('.filter_products').html(data);
      }
    })
  });

  //fit filter

  $(".fit").on('click',function(){
    var fit = get_filter(this);
    var sort = $("#sort option:selected").text();
    var url = $("#url").val();
    $.ajax({
      url:url,
      method:"post",
      data:{fit:fit,sort:sort,url:url},
      success:function(data){
        $('.filter_products').html(data);
      }
    })
  });

  //sleeve filter

  $(".sleeve").on('click',function(){
    var sleeve = get_filter(this);
    var sort = $("#sort option:selected").text();
    var url = $("#url").val();
    $.ajax({
      url:url,
      method:"post",
      data:{sleeve:sleeve,sort:sort,url:url},
      success:function(data){
        $('.filter_products').html(data);
      }
    })
  });


  //occasion filter
  $(".occasion").on('click',function(){
    var occasion = get_filter(this);
    var sort = $("#sort option:selected").text();
    var url = $("#url").val();
    $.ajax({
      url:url,
      method:"post",
      data:{occasion:occasion,sort:sort,url:url},
      success:function(data){
        $('.filter_products').html(data);
      }
    })
  });

  //pattern filter

  $(".pattern").on('click',function(){
    var pattern = get_filter(this);
    var sort = $("#sort option:selected").text();
    var url = $("#url").val();
    $.ajax({
      url:url,
      method:"post",
      data:{pattern:pattern,sort:sort,url:url},
      success:function(data){
        $('.filter_products').html(data);
      }
    })
  });

  //filter for class name
  function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;

  }


  //size wise product price
  $("#getPrice").change(function(){
    var size = $(this).val();
    if(size == ""){
      alert("Please select Size");
      return false;
    }
    var product_id = $(this).attr("product-id");
    $.ajax({
      url:'/get-product-price',
      data:{size:size,product_id:product_id},
      type:'post',
      success: function(resp){
          if(resp['discount'] > 0){
              $(".getAttrPrice").html("<del> BDT:"+resp['product_price']+ "</del> BDT:"+resp['final_price']);
          }else{
              $(".getAttrPrice").html("BDT-"+resp['product_price']);
          }

      },error:function(){

      }
    })
  });


  //update cart items
    $(document).on('click','.btnItemUpdate',function(){
      if($(this).hasClass('qtyMinus')){
          //quantity minus click by user
          var quantity = $(this).prev().val();
          if(quantity <= 1){
              alert("Item Quantity 1 or greater");
              return false;
          }else{
              var new_qty = parseInt(quantity) - 1;
          }
      }
        if($(this).hasClass('qtyPlus')){
            //quantity minus click by user
            var quantity = $(this).prev().prev().val();
            new_qty = parseInt(quantity) + 1;
        }

        var cartId = $(this).data("cartid");
        $.ajax({
            data:{"cartid":cartId,"qty":new_qty},
            url:"/update-cart-item-qty",
            type:'post',
            success:function(resp){
                if(resp.status == false){
                    alert(resp.msg);
                }
                $("#appendCartItems").html(resp.view)
            },error:function(){
                alert("error")
            }

        })
    });

    //delete cart item
    $(document).on('click','.btnItemDelete',function(){
        var cartId = $(this).data("cartid");
        var result = confirm("want to delete this cart item");
        if(result) {
            $.ajax({
                data: {"cartid": cartId},
                url: "/delete-cart-item",
                type: 'post',
                success: function (resp) {
                    $("#appendCartItems").html(resp.view)
                }, error: function () {
                    alert("error")
                }
            })
        }
    });


    //register form
    $("#registerForm").validate({
        rules: {
            name: "required",
            mobile:{
                required: true,
                digits:true,
                minlength: 11,
                maxlength:14,
            },
            email: {
                required: true,
                email: true,
                remote:'check-email'
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            name: "Please enter your name",
            mobile: {
                required: "Please Enter your Mobile Number",
                minlength: "Your number must be at least 11 digit long",
                maxlength: "Your number  must consist 14 digit",
                digits:"Please enter your valid mobile number"
            },
            email: {
                required: "Please enter your email address",
                email: "please enter valid email address",
                remote:"Email address already exists!"
            },
            password: {
                required: "Please choose your password",
                minlength: "Your password must be at least 6 characters long"
            },

        }
    });

    //login form
    $("#loginform").validate({
        rules: {
            email:"required",
            password:"required"
        },
        messages: {
           email: "Email address field  empty",
            password: "Password field empty"

        }
    });


});
