/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteLocation", function(){
		var compId = $(this).data("compid"),
			hitURL = baseURL + "deleteLocation",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Location ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : compId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Location successfully deleted"); }
				else if(data.status = false) { alert("Location deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
