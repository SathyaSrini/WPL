$(document).ready(function(){

var username = $('#hdnSession').val(); 
var isLoggedin = $('#userPresent').val();

$.ajax({url: "properties.php",success: function(ds){
     
      var obj = jQuery.parseJSON( ds );

      localStorage.setItem('Allitems', ds);
      for(var i=0 ; i < obj.length;i++)
      {

      var inWl = obj[i].w;
	  

	  if(isLoggedin)
	  {
	  if(username == 0)
     {
      if(inWl==0)
      {
      $('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><div class="ratings"><button id="AddCart" name ="'+obj[i].cn+'"">Add To WishList</button></div></div></li>');
      $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"});
      }
      else
      {
      $('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><div class="ratings"><button style="color: green;" id="AddCart" name ="'+obj[i].cn+'"" disabled>Added To WishList</button></div></div></li>');
      $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"}); 
      }
    }
      else
      {
      $('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><div class="ratings"><button id="Edit" name ="'+obj[i].cn+'"">Edit</button></div></div></li>');
     
	  $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"});
	  } 
	  }
	  else
	  {
		
		$('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div></div></li>');
        $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"});

		
	  }
      
      }
	  
    }

});

$("#search").click(function(){
      var hType=$('#aptType').val();
      var beds=$('#beds').val();
      var bath=$('#baths').val();
      var city=$('#city').val();
      var state=$('#state').val();
     
      $.ajax({url: "properties.php",

        data:{hType:hType,beds:beds,bath:bath,city:city,state:state},
        success: function(ds){
       
        var obj = jQuery.parseJSON( ds );

         $('#wpl').empty();

          for(var i=0 ; i < obj.length;i++)
          {
           
 var inWl = obj[i].w;
	  

	  if(isLoggedin)
	  {
	  if(username == 0)
     {
      if(inWl==0)
      {
      $('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><div class="ratings"><button id="AddCart" name ="'+obj[i].cn+'"">Add To WishList</button></div></div></li>');
      $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"});
      }
      else
      {
      $('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><div class="ratings"><button style="color: green;" id="AddCart" name ="'+obj[i].cn+'"" disabled>Added To WishList</button></div></div></li>');
      $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"}); 
      }
    }
      else
      {
      $('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><div class="ratings"><button id="Edit" name ="'+obj[i].cn+'"">Edit</button></div></div></li>');
     
	  $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"});
	  } 
	  }
	  else
	  {
		
		$('#wpl').last().append('<li><div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div></div></li>');
        $("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"3"});

		
	  }
      
		  
		  }
        },

        error: function(request,status,errorThrown) {
         alert(status);
         alert(errorThrown);
         alert(request);
     }
    });
    });
	

// $("[name=5]", function(){
    
//     $(this).text("Added to WishList");
//     $(this).css('color','green');
//   $(this).prop("disabled",true);
//     var id_clicked = this.name;
//     alert("Hello");

// });



$("#wpl").on("click", "#AddCart", function(){
    
    var id_clicked = this.name;

    $(this).text("Added to WishList");
    $(this).css('color','green');
	  $(this).prop("disabled",true);
    
    $.ajax({
        type:'POST',
        url: 'properties.php',
        data: 
        {
            clicked_id: id_clicked
        }
    }); 

});

$("#wpl").on("click", "#Edit", function(){
    
    $(this).css('color','red');
    
    var id_clicked = this.name;

    //alert(id_clicked);
	window.location.href = "property_edit.html?"+id_clicked;

   /* $.ajax({
        type:'POST',
        url: 'property_edit.html',
        data: 
        {
            clicked_id: id_clicked
        }
    }); */

});
});