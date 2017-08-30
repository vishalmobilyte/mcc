$(function(){
	$("input[name='phone']").attr('maxlength',10);
})


  
  function getCircleOptions(e){
    var block_id = $(e).val();
    var rel_url = $(e).attr('rel_url');

    
    $.ajax({
            url: rel_url,//AJAX URL WHERE THE LOGIC HAS BUILD
            data:{'block_id':block_id},//ALL SUBMITTED DATA FROM THE FORM
            dataType:'html',
            method: "POST",
            success:function(res)
            {
            
              $("#circle_options").html(res);
             
            }
          });


  }

  function getLists(e){
    var userType = $(e).val();
    if(userType=='2'){
      $(".block_list").show();
      $(".agw_list").hide();
    }
    else{
       $(".block_list").hide();
      $(".agw_list").show();
    }
  }

  $( document ).ready(function() {
    var block_id_sel = $("#blocks_list").val();
  

  });


