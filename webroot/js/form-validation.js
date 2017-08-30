var FormValidation = function () {

    // basic validation
    var validationUsersAdd = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation
            var usersAdd = $('#usersAdd');
            var error1 = $('.alert-danger', usersAdd);
            var success1 = $('.alert-success', usersAdd);

            usersAdd.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }/*,
                    email: {
                        required: "This field is required",
                        email: "Please provide valid email",
                        remote: "Email already exists"
                    }*/,
                    username: {
                        minlength: 'Username should be max or greater than 2 char',
                        required: "This field is required",
                        alphanumeric: 'Username should be alpha numeric',
                        //remote: "Username already exists"
                    }
                },
                rules: {
                    name: {
                        minlength: 2,
                        required: true,
                        lettersonly: true
                    },
                    username: {
                        minlength: 2,
                        required: true,
                        alphanumeric: true,
                       // alphaNumericUsername: true,
                        //remote: base_url+"App/isUniqueUsernameAjax"
                    }/*,
                    email: {
                        required: true,
                        email: true,
                        //remote: base_url+"App/isUniqueEmailAjax"
                    }*/,
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: true,
                        equalTo: '#password'
                    },
                    role: {
                        required: true
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();  form.submit();
                }
            });


    }
    var validationdriverAdd = function() {
			// for more info visit the official plugin documentation: 
			// http://docs.jquery.com/Plugins/Validation
            var driverAdd = $('#driverAdd');
            var error1 = $('.alert-danger', driverAdd);
            var success1 = $('.alert-success', driverAdd);

            driverAdd.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    },
                    email: {
                        email: "Please provide valid email",
                       
                    },
                    username: {
                        minlength: 'Username should be max or greater than 2 char',
                        required: "This field is required",
                        alphanumeric: 'Username should be alpha numeric',
                        //remote: "Username already exists"
                    }
                },
                rules: {
                    name: {
                        minlength: 2,
                        required: true,
                        lettersonly: true
                    },
                    username: {
                        minlength: 2,
                        required: true,
                        alphanumeric: true,
                       // alphaNumericUsername: true,
                        //remote: base_url+"App/isUniqueUsernameAjax"
                    },
                    email: {
                       
                        email: true,
                        //remote: base_url+"App/isUniqueEmailAjax"
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: true,
                        equalTo: '#password'
                    },
                    role: {
                        required: true
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();  form.submit();
                }
            });


    }

    var validationChangePassword = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation
            var changePassword = $('#changePassword');
            var error1 = $('.alert-danger', changePassword);
            var success1 = $('.alert-success', changePassword);

            changePassword.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                    oldpassword: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                         minlength: 6,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: true,
                        equalTo: '#password'
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();  form.submit();
                }
            });


    }
    
    var validationFormLoginUser = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation
            var formLoginUser = $('#formLoginUser');
            var error1 = $('.alert-danger', formLoginUser);
            var success1 = $('.alert-success', formLoginUser);

            formLoginUser.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
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

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();  form.submit();
                }
            });


    }
    
   var validationWorkersAdd = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation
            var usersAdd = $('#workersAdd');
            var error1 = $('.alert-danger', usersAdd);
            var success1 = $('.alert-success', usersAdd);

            usersAdd.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }/*,
                    email: {
                        required: "This field is required",
                        email: "Please provide valid email",
                        remote: "Email already exists"
                    }*/,
                    username: {
                        minlength: 'Username should be max or greater than 2 char',
                        required: "This field is required",
                        alphanumeric: 'Username should be alpha numeric',
                        //remote: "Username already exists"
                    },
                     type_worker_id: {
                       
                        required: "This field is required"
                       
                        //remote: "Username already exists"
                    }
                },
                rules: {
                    name: {
                        minlength: 4,
                        required: true,
                        lettersonly: true
                    },
                    username: {
                        minlength: 2,
                        required: true,
                        alphanumeric: true,
                       // alphaNumericUsername: true,
                        //remote: base_url+"App/isUniqueUsernameAjax"
                    }/*,
                    email: {
                        required: true,
                        email: true,
                        //remote: base_url+"App/isUniqueEmailAjax"
                    }*/,
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    anganwadi_id: {

                        required: {
                          depends: function(element) {
                            var type_worker_val = $("#type_worker").val();
                            if(type_worker_val==1){

                          return true;
                            }
                            //or whatever you need to check
                          }
                        }

                    },
                    rbsk_team_id: {

                        required: {
                          depends: function(element) {
                            var type_worker_val = $("#type_worker").val();
                            if(type_worker_val==2){

                          return true;
                            }
                            //or whatever you need to check
                          }
                        }

                    },
                    type_worker_id :{
                        
                        required: true
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();  form.submit();
                }
            });


    }
   var validationAgwAdd = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation
            var usersAdd = $('#agwAdd');
            var error1 = $('.alert-danger', usersAdd);
            var success1 = $('.alert-success', usersAdd);

            usersAdd.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                
                },
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                       
                    }, 
                    awc_code: {
                        minlength: 2,
                        required: true
                       
                    },
                    dtcode: {
                        minlength: 2,
                        required: true
                       
                    },
                    pjcode: {
                        minlength: 2,
                        required: true
                       
                    },
                    acw_type: {
                        
                        required: true  
                    },
                    block_id: {
                        
                        required: true  
                    },
                    circle_id: {
                        
                        required: true  
                    },
                    rbsk_team_id: {
                        
                        required: true  
                    }

                    
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();  form.submit();
                }
            });


    }
   
    
    
	
    return {
        //main function to initiate the module
        init: function () {

            validationUsersAdd();
            validationdriverAdd();
            validationChangePassword();
            validationWorkersAdd();
            validationAgwAdd();
        }

    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
    
    jQuery.validator.addMethod("alphaNumericUsername", function (value, element) {
		return this.optional(element) || /^(?=\D*\d)(?=[^a-z]*[a-z])[0-9a-z]+$/i.test(value);
	}, "username must contain atleast one number and one character");
	
	jQuery.validator.addMethod("lettersonly", function(value, element) {
	  return this.optional(element) || /^[a-z ]+$/i.test(value);
	}, "Letters only please"); 

});
