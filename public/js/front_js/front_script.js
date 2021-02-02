$(document).ready(function(){
  // $("#sort").on('change',function(){
  //   this.form.submit();
  // });

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

  function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;

  }
});