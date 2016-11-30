$(document).ready(function(){

var username = $('#hdnSession').val(); 

$.ajax({url: "history.php",success: function(ds){
      var obj = jQuery.parseJSON( ds );
	  
      localStorage.setItem('Allitems', ds);
      if(obj.length==0)
      {
         $('#wpl').last().append('<div class="col-sm-4 col-lg-4 col-md-4" id="NHistory"><p>No History Found</p></div>');
      }
      else
      {
      for(var i=0 ; i < obj.length;i++)
      { 
      if(username == 0)
      {
      $('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><h4 class="pull-right" style = "color:red">'+obj[i].d+'</h4><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div></div></li>');
      $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"});
      }
      }
    }
  }

});
});