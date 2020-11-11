function todoPost(e, ownClass){
    e.preventDefault();
    var getId = '';
    var formData = ownClass.serializeArray();
    formData.push({"name" : "action", "value" : "todo-insert"});
    $.ajax({
      url: "action/todoaction.php",
      type: "POST",
      dataType: 'json',
      data: formData,
      success: function(data){
       $('.custom-tab').each(function(){
        if($(this).hasClass('active')){
          getId = $(this).attr('id');
        }         
       });
       ownClass.find('input').val('');
       $('#'+getId).load("index.php ."+getId+"data");
       $('.counteradder').load('index.php .realodcounter');
      }
    });
}

function todoClear(e, ownClass, type='single'){
  e.preventDefault();
  var getId = ownClass.data('id');
  var idAttr = '';
  if(type == 'single'){
    if(getId == ''){
      alert('Something Went Wrong!');
      return ;
    }else{
   var submitData = {"actiondelete" : "single", "id" : getId};
   }
  }else if(type == 'all'){
   var submitData = {"actiondelete" : "all"}; 
  }else{
    alert('Something Went Wrong!');
    return ;
  }
   $.ajax({
      url: "action/todoaction.php",
      type: "POST",
      dataType: 'json',
      data: submitData,
      success: function(data){
       if(type == 'single'){
         ownClass.closest('.custom-row').fadeOut('slow');
       }else if(type == "all"){
        $('.custom-tab').each(function(){
        if($(this).hasClass('active')){
          idAttr  = $(this).attr('id');
        }         
       });
       $('#'+idAttr).load("index.php ."+idAttr+"data");
       }
       $('.counteradder').load('index.php .realodcounter');
      }
    });
}

function dataUpdate(e, ownClass){
  e.preventDefault();
  e.stopPropagation();
  var idAttr = '';
  var getId = ownClass.data('id');
  var val = ownClass.closest('.custom-row').find('.value').val();
  $.ajax({
      url: "action/todoaction.php",
      type: "POST",
      dataType: 'json',
      data: {'action-edit' : 'edit', 'todolist' : val, 'id' : getId},
      success: function(data){
       $('.custom-tab').each(function(){
        if($(this).hasClass('active')){
          idAttr = $(this).attr('id');
        }         
       });
       $('#'+idAttr).load("index.php ."+idAttr+"data");
      }
    });
}

function todoComplete(e, ownClass){
  e.stopPropagation();
  if(ownClass.find('input').val() == ''){
    alert('Something Went Wrong!');
    return ;
  }else{
  var idAttr = '';
  var getId = ownClass.find('input').val();
  $.ajax({
      url: "action/todoaction.php",
      type: "POST",
      dataType: 'json',
      data: {'action-complete' : 'complete', 'id' : getId},
      success: function(data){
       $('.custom-tab').each(function(){
        if($(this).hasClass('active')){
          idAttr = $(this).attr('id');
        }         
       });
       $('#'+idAttr).load("index.php ."+idAttr+"data");
       $('.counteradder').load('index.php .realodcounter');
      }
    });
  }
}

$(function(){
     $('.custom-btn').on('click', function(){
     	  $('.clear-completed').css('display', 'none');
        var getTab = $(this).data('tabid');
        $('.custom-btn').removeClass('active');
        $(this).addClass('active');
        $('.custom-tab').removeClass('active');
        $('#'+getTab).load("index.php ."+getTab+"data", function(){
          $('#'+getTab).addClass('active');
          if($('.clear-'+getTab).length != undefined){
           $('.clear-'+getTab).css('display', '');
          }
        });
       
     });

    $('.custom-tab').on('click', '.data-edit', function(e){
        e.preventDefault();
        e.stopPropagation();
        var id = $(this).data('id');
        var text = $(this).closest('.custom-row').find('.custom-check-container').text();
        $(this).closest('.custom-row').find('.custom-check-container').text('');
        $(this).closest('.custom-row').find('.custom-check-container').prepend('<input type="text" name="edited-value" class="value" value="'+text+'">');
        $(this).closest('.custom-row').append('<div class="save-cancel-button"><a href="javascript:void(0)" class="text-success data-update" data-id="'+id+'" onclick="dataUpdate(event, $(this))"><i class="fa fa-save"></i></a>  <a href="javascript:void(0)" class="text-danger data-close" data-id="'+id+'" data-text="'+text+'"><i class="fa fa-close"></i></a></div>');       
        $(this).closest('.custom-row').find('.row-hidden-btn').remove();
       
    });

    $('.custom-tab').on('click', '.data-close', function(e){
      e.preventDefault();
      var ownc = $(this);
      var text = ownc.data('text');
      var id = ownc.data('id');
      ownc.closest('.custom-row').find('.custom-check-container').remove();
      var appendData = '';
      appendData += "<label class='custom-check-container' onclick='todoComplete(event, $(this))'>"+text+"<input type='checkbox' value='"+id+"' name='todoid'><span class='checkmark'></span></label>";
      appendData += "<div class='row-hidden-btn'><a href='javascript:void(0)' class='text-success data-edit' data-id='"+id+"'><i class='fa fa-edit'></i></a> <a href='javascript:void(0)' class='text-danger data-delete' data-id='"+id+"'><i class='fa fa-trash'></i></a></div>";
      ownc.closest('.custom-row').append(appendData);
      ownc.closest('.custom-row').find('.save-cancel-button').remove();
    });


});
