$(document).ready(function(){

var username = $('#hdnSession').val(); 

$.ajax({url: "favourite.php",success: function(ds){

      var obj = jQuery.parseJSON( ds );

      localStorage.setItem('Allitems', ds);
	  
	  if(obj.length != 0) {
		  //var count = 0;
		for(var i=0 ; i < obj.length;i++)
		{
			//if((count % 3) == 0) {
			//	$('#wpl').last().append('<br>');
			//}
			
			if(obj[i].isavai == 1) {
				$('#wpl').last().append('<li style="list-style: none;"><div class="thumbnail" style="max-width:30%;"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><input type="checkbox" name="ato" id="'+obj[i].cn+'" value="'+obj[i].cn+'$'+obj[i].p+'" /> Add to Order<div class="pull-right"><button id="RemoveFromWL" name ="'+obj[i].cn+'"">Remove From WishList</button></div></div></li>');
			}
			else{
				$('#wpl').last().append('<li style="list-style: none;"><div class="thumbnail" style="max-width:30%;"><img src= "img/'+ obj[i].i+'" alt="'+obj[i].cn+'"style="width:300px;height:180px;"><div class="caption"><h4 class="pull-right">'+obj[i].p+'$</h4><h4>'+obj[i].st+'</h4><p>'+obj[i].c+','+obj[i].s+','+obj[i].z+'</p><p>Area: '+obj[i].sq+' sqft</p><p>Bed: '+obj[i].bh+'  Bath: '+obj[i].b+'</p></div><label for="prop" style="color:red; font-size : 20px; font-weight:bold; text-align:center">Not Available</label><div class="pull-right"><button id="RemoveFromWL" name ="'+obj[i].cn+'"">Remove From WishList</button></div></div></li>');
			}
		//$("ul.pagination3").quickPagination({pagerLocation:"bottom",pageSize:"1"});
      
		}
		$('#wpl').last().append('<input type="button"  value="CHECKOUT" id="checkout" style="float:right;"/><br><br>');
	  }
	  
	  else {
		  $('#wpl').last().append('<center><p style="color:red; font-size : 30px; font-weight:bold">No items in wishlist</p></center>');
	  }
}

});

$("#wpl").on("click", "#RemoveFromWL", function(){
    if(!confirm("Confirm Delete?")){
		return false;
	}
    $(this).text("Removed From WishList");
    $(this).css('color','red');
	$(this).prop("disabled",true);
    var id_clicked = this.name;
	$('#'+id_clicked).prop("disabled", true);
	$('#'+id_clicked).removeAttr('checked');
/*$('#contained input:checkbox').each(function() {
	$(this).removeAttr('checked');
	$(this).prop("disabled", true);
});*/
    $.ajax({
        type:'POST',
        url: 'favourite.php',
        data: 
        {
            clicked_id: id_clicked,
			wlremove: 1
        }
    });

});

$("#wpl").on("click", "#checkout", function(){
	var arr = [];
	$("#wpl input:checked").each(function(){
		arr.push($(this).val());
	});
	
	if(arr.length == 0) {
		alert("Please select items for checkout");
		return false;
	}
	
			//alert("Its an add");
		/*	if (window.XMLHttpRequest)   {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
				//alert("1");
			} 
			else   {
				// code for IE6, IE5     
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");   
			} 

			xmlhttp.open("POST","favourite.php?operation=popid",true);
			//xmlhttp.open("GET","admin.php?id="+id,true);
			xmlhttp.send(); */
			
			var itemlist = JSON.stringify(arr);
			$.ajax({
				type: "POST",
				url: "favourite.php",
				data: {items : itemlist}
			});
		window.alert("CheckOut Successful!!");
		window.location.href = "favourite.html";
	
});


});





