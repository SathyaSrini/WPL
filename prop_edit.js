$(document).ready(function() {
	var operation = "";
	$('#links a').click(function(){
		
		/*if ($("#login_form").is(":hidden")){
              $("#login_form").slideDown("slow");
		}
		else{
			$("#login_form").slideUp("slow");
		}*/
		
		//alert($(this).text());
		//$("#aptid").prop('disabled', false);
		operation = $(this).text().split(" ")[0];
		$('table tr').find('input:text').val('');
		$("#login_form").hide();
		$("#operation").val(operation);
		$("#submit_button").val(operation);
		//alert(operation+"*");
		if ((operation == "Update") || (operation == "Remove")) {
			$("#login_form").show('slow');
			$('#propertyid').prop('disabled', false);
			$('#propertyid').val('');
			$('table tr').not(':first').hide();
		//	$('table tr').show();
		//	$("#propertyid").siblings().hide();
			$("#show_button").show('slow');
		}
		else {
			
			$("#login_form").show('slow');
			$('table tr').show();
			//$('table tr').find('input:text').val('');
			$("#show_button").hide();
			$("#show_button").click();
		}
		
		
	});
	
	$("#submit_button").click(function(){
		if(operation == "Remove") {
			if(!confirm("Confirm Delete?")){
				return false;
			}
		}
	});
	
	$("#show_button").click(function(){
		var regex = /^[0-9]+$/i;
		var check_flag = 0;
		var error = 0;
	//	alert("Self triggered show");
		operation = $("#operation").val();
		//alert(operation);
		if(operation != "Add") {
			if(($("#propertyid").val().length === 0) || (!regex.test($("#propertyid").val()))) {
				alert("Please enter a valid ID");
				check_flag = 1;
			}
			//else if() {
			//	alert("Please Enter a valid id");			
			//	check_flag = 1;
			//}
		}
		
		if(!check_flag) {
			//alert("Its an add");
			if (window.XMLHttpRequest)   {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
				//alert("1");
			} 
			else   {
				// code for IE6, IE5     
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");   
			} 
			xmlhttp.onreadystatechange=function()   {
				if (xmlhttp.readyState==4 && xmlhttp.status==200)     {
					if(xmlhttp.responseText.indexOf("Error") !== -1) {
						alert(xmlhttp.responseText);
						//$('table tr').show();
					}
					else {
						if(operation == "Add") {
							document.getElementById("propertyid").value=xmlhttp.responseText;
							document.getElementById("hiddenid").value=xmlhttp.responseText;
							$('#propertyid').prop('disabled', true);
						}
						else {
							var result = JSON.parse(xmlhttp.responseText);
							$('table tr').show();
							document.getElementById("aptid").value=result.aptno;
							document.getElementById("street").value=result.street;
							document.getElementById("city").value=result.city;
							document.getElementById("state").value=result.state;
							document.getElementById("zip").value=result.zipcode;
							document.getElementById("sqft").value=result.sqft;
							document.getElementById("bhk").value=result.bhk;
							document.getElementById("bath").value=result.bath;
							document.getElementById("price").value=result.price;
							document.getElementById("hiddenid").value=document.getElementById("propertyid").value;
							//document.getElementById("image").value=result.image;
							if(result.isapt == 0) {
								$('#aptid').prop('disabled', true);
							}
							(result.isavailable == 1) ? (document.getElementById('isavailable').checked = "checked") : (document.getElementById("isavailable").checked = false);
							(result.isapt == 1) ? (document.getElementById('isapt').checked = "checked") : (document.getElementById("isapt").checked = false);
							
						}
					}
			    }   
			} ;
			//alert("just before Its sending the url");
			var id = document.getElementById("propertyid").value;
			//xmlhttp.open("GET","admin.php?operation="+(operation != "Add") ? "show" : "popid"+"&id="+id,true);
			if(operation == "Add") {
				xmlhttp.open("GET","admin.php?operation=popid",true);
			}
			else {
				xmlhttp.open("GET","admin.php?id="+id,true);
			}
			xmlhttp.send(); 
		}
		
		//$("#street").text("TEST");
		
	});
	
	$('#isapt').click(function(){
		if ($('#isapt').prop("checked") == true) {
			//alert("checkbox is checked");
			$('#aptid').prop('disabled', false);
			$('#isapt').val("isapartment");
		}
		else {
			//alert("Chec box un");
			$('#aptid').val('');
			$('#aptid').prop('disabled', true);
			$('#isapt').val("random");
		}
		//$('#aptid').prop('disabled', function(i, v) { return !v; })
		
	});
	
	$('#isavailable').click(function(){
		if ($('#isavailable').prop("checked") == true) {
			$('#isavailable').val("isavailable");
		}
		else {
			$('#isavailable').val("random");
		}
		//$('#aptid').prop('disabled', function(i, v) { return !v; })
		
	});
	
	//$('#submit_button').click(function(){
//		alert("about to trigger form submit");
//		$("#form1").submit();
//		//alert("DB Oeration Successful!!");
//	});
/*function openForm()
{
	 if ($("#login_form").is(":hidden")){
              $("#login_form").slideDown("slow");
	}
	else{
		$("#login_form").slideUp("slow");
	}
}*/
});