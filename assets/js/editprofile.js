/**
 * File : editUser.js 
 * 
 * This file contain the validation of edit user form
 * 
 * @author Kishor Mali
 */
$(document).ready(function(){
    
	
	var editUserprofile = $("#editUserprofile");
	
	var validator = editUserprofile.validate({
		
		rules:{
			fname :{ required : true },
			address : { required : true },
			cpassword : {equalTo: "#password"},
			mobile : { required : true, digits : true },
			town : { required : true},
                        city : { required : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			address : { required : "This field is required"},
			cpassword : {equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			town : { required : "This field is required" },
                        city : { required : "This field is required" }
		}
	});
});