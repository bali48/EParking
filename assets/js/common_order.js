/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteCompany", function(){
		var compId = $(this).data("compid"),
			hitURL = baseURL + "deleteCompany",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Booking Order ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { compId : compId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Order successfully deleted"); }
				else if(data.status = false) { alert("Order deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
