$(document).ready(function(){
	$('div.success, div.error, div.loginError').on('click',function(){
			$(this).slideUp(1000);
	});
	/*
	setInterval(function() {
		
	   $('div.success, div.flasherror, div.loginError').slideUp();
	}, 15000);*/
	
	$('#formLoginUser').validate({
		messages: {
			select_multi: {
				maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
				minlength: jQuery.validator.format("At least {0} items must be selected")
			}
		},
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}
		},         

		errorPlacement: function (error, element) { // render error placement for each input type
				if (element.attr("name") == "username" )
					error.insertAfter("#usernameDiv");
				else if  (element.attr("name") == "password" )
					error.insertAfter("#passwordDiv");
				else
					error.insertAfter(element);
		}
	});

	$('#formForgotPassword').validate({
		messages: {
			select_multi: {
				maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
				minlength: jQuery.validator.format("At least {0} items must be selected")
			}
		},
		rules: {
			email: {
				required: true,
				email: true
			}
		}
	});

	$('#formResetPassword').validate({
		messages: {
			select_multi: {
				maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
				minlength: jQuery.validator.format("At least {0} items must be selected")
			}
		},
		rules: {
			"Users[password]" : {
				required: true,
				minlength: 6,
				maxlength: 20
			},
			"Users[re_password]" : {
				required: true,
				equalTo: '#re_password'
			}
		}
	});
            
});

function submit_tracking_form(){
	
	$("#trackOrder").submit();
}
