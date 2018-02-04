/**
 * File : addCompany.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#addNewCompany");
	
	var validator = addUserForm.validate({
		
		rules:{
			location :{ required : true },
			
		},
		messages:{
			location :{ required : "This field is required" },
			
		}
	});
});
