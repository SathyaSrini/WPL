$(document).ready(function(){

$.ajax({url: "properties.php",success: function(ds){

      var obj = jQuery.parseJSON( ds );

      localStorage.setItem('Allitems', ds);

      for(var i=0 ; i < obj.length;i++)
      {
       
     $('#wpl').last().append('<div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><div class="ratings"><button onclick="AddToCart(this)" id="AddCart'+obj[i].cn+'">Add To WishList</button></div></div>');
  
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
           
         $('#wpl').last().append('<div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><div class="ratings"><button onclick="AddToCart(this)" id="AddCart'+obj[i].cn+'">Add To WishList</button></div></div>');
      
          }
        },

        error: function(request,status,errorThrown) {
         alert(status);
         alert(errorThrown);
         alert(request);
     }
    });
    });
});