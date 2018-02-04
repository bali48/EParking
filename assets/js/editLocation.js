/**
 * File : editUser.js 
 * 
 * This file contain the validation of edit user form
 * 
 * @author Kishor Mali
 */
$(document).ready(function () {

    var editUserForm = $("#editUser");

    var validator = editUserForm.validate({

        rules: {
                location :{ required : true },
        },
        messages: {
            location :{ required : "This field is required" },
        }
    });
});
