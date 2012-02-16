//Unit table
$(document).ready(function() { 
  // call the tablesorter plugin 
  $("#unit_table").tablesorter({ 
  }); 


  $('.unit_name').click(function(){
    var url = $(this)[0].dataset.url;
    
    $.get(url
      ,function(data, textStatus, jqXHR){
      $('#modal').html(data);
      $('#modal').addClass("show");
      $('#modal').show();
      
      },'html');
  });
  $('#modal').click(function(){
    $('#modal').hide();
  });
});
