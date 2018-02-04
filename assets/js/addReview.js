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
	
	var addUserForm = $("#addUser");
	
	var validator = addUserForm.validate({
		
		rules:{
			Reviewname : { required : true, selected : true},
			review:{required: true}
		},
		messages:{
			Reviewname :{ required : "This field is required" },
			review : { required : "This field is required"}
		}
	});
});

