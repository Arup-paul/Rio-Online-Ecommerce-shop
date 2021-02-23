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
          if(resp['discount_price'] > 0){
              $(".getAttrPrice").html("<del> BDT-"+resp['product_price']+ "</del> BDT-"+resp['discount_price']);
          }else{
              $(".getAttrPrice").html("BDT-"+resp['product_price']);
          }

      },error:function(){

      }
    })
  })
});
