//function for datepicker
$(function() {
    $( "#datepicker" ).datepicker(
    {dateFormat: 'yy-mm-dd'});
  });

//function for address
function deleteAddress(aid){
	if(confirm("Are you sure you want to delete this Address?")){
		window.location.href = "deleteAddress.php?aid=" + aid;
	}
}

//function for current date in YYYY-MM-DD
function currentDate() {
    var date = new Date();
    var month = '' + (date.getMonth() + 1);
    var day = '' + date.getDate();
    var year = date.getFullYear();

    if (month.length < 2) month = "0" + month;
    if (day.length < 2) day = "0" + day;

    return [year, month, day].join("-");
}
  
//function for clickable panel-heading
$(document).on('click', '.panel-heading span.clickable', function (e) {
    var $this = $(this);
    if ($this.hasClass('collapsed')) {
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '.panel div.clickable', function (e) {
    var $this = $(this);
    if ($this.hasClass('collapsed')) {
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});

//function for number input
$(document).ready(function() {
    $("#input_username").keydown(function(e){
    	//Allow: backspace, delete, tab, escape and enter 
        //if you want decimal use 190
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39) ||
             // Allow: alphabets
            (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 97 && e.keyCode <= 122)) {
                 // let it happen, dont do anything
                 return;
        }else{
            e.preventDefault();
        }
    });
    $("#input_pincode,#pincode0,#pincode1,#pincode2,#pincode3,#input_price,#input_weight,#input_mobile,#input_login_mobile").keydown(function (e) {
        // Allow: backspace, delete, tab, escape and enter 
        //if you want decimal use 190
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, dont do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

//function for login form new
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = this.href.split('#');
    $('.nav a').filter('a[href="#'+target[1]+'"]').tab('show');
});

//function for change password form
$( "#changePasswordForm" ).submit(function( event ) {
	var formData = {
		"input_old_password" : $("input[name=input_old_password]").val(),
		"input_new_password" : $("input[name=input_new_password]").val(),
		"input_re_new_password" : $("input[name=input_re_new_password]").val()
	};
	
	$("#change_password_submit_status").empty();
	if(!formData["input_old_password"]){
		$("#input_old_password").addClass("has-error");
		$("#change_password_old_status").html("This field is mandatory.");
	}else{
		if(formData["input_old_password"].length < 6){
			$("#input_old_password").addClass("has-error");
			$("#change_password_old_status").html("Invalid Current Password.");
		}else{
			$("#input_old_password").removeClass("has-error");
			$("#change_password_old_status").empty();
		}
	
	}
	if(!formData["input_new_password"]){
		$("#input_new_password").addClass("has-error");
		$("#change_password_new_status").html("This field is mandatory.");
	}else{
		if(formData["input_new_password"].length < 6){
			$("#input_new_password").addClass("has-error");
			$("#change_password_new_status").html("At least six characters.");
		}else{
			$("#input_new_password").removeClass("has-error");
			$("#change_password_new_status").empty();
		}
	}
	if(!formData["input_re_new_password"]){
		$("#input_re_new_password").addClass("has-error");
		$("#change_password_re_new_status").html("This field is mandatory.");
	}else{
		$("#input_re_new_password").removeClass("has-error");
		$("#change_password_re_new_status").empty();
	}
	if(formData["input_new_password"] != formData["input_re_new_password"] && formData["input_new_password"] && formData["input_re_new_password"]){
		$("#change_password_re_new_status").html("Re-type New Password must be same as New Password.");
	}
	if(!$("#change_password_old_status").html() && !$("#change_password_new_status").html() && !$("#change_password_re_new_status").html()){
		$.ajax({
			type        : "POST", 
			url         : "userSettings.php",
			data        : formData,		    
			success	: function(response){
				data = JSON.parse(response);
				if (!data.success) {
				    	if(data.errors.submit){
				    		$("#change_password_submit_status").html(data.errors.submit);
				    	}
				}else{
					location.reload();
				}
			},
			error	: function(response){
				alert("error");
			}  
		});
	}
	return false;
});

//function for referral form
$( "#referralForm" ).click(function( event ) {
	var formData = {
		"email" : $("input[name=input_email]").val(),
		"phone" : $("input[name=input_mobile]").val()
	};
	$("#submit_status").empty();
	if(!formData["email"] && !formData["phone"]){
		$("#submit_status").html("Please enter Email address or/and Mobile number.");
	}else{
		$.ajax({
			type        : "POST", 
			url         : "userReferral.php",
			data        : formData,		    
			success	: function(response){
				data = JSON.parse(response);
				if (!data.success) {
				    	if(data.errors.submit){
				    		$("#submit_status").html(data.errors.submit);
				    	}
				}else{
					location.reload();
				}
			},
			error	: function(response){
				alert("error");
			}  
		});
	}
	return false;
});

//function for contact form
$(document).ready(function(){ 
  //Hiding Labels Initially
  $('#contact form .row .floating-label-form-group').each(function(){
    $(this).addClass('js-hide-label');
  });
  //Hiding Placeholder in input
  $('input,textarea').focus(function(){
       $(this).data('placeholder',$(this).attr('placeholder'))
          .attr('placeholder','');
    }).blur(function(){
      $(this).attr('placeholder',$(this).data('placeholder'));
    });
  //Now adding and removing classes on Events - keyup,blur,focus
  $('#contact form .row .floating-label-form-group').find('input,textarea').on('keyup blur focus',function(e) {
      var $this = $(this),
          $parent = $this.parent();
      
      if(e.type=='keyup') {
            $parent.removeClass('js-hide-label').addClass('js-highlight-label');
      }
    else if(e.type=='blur'){
      if($this.val()==''){
        $parent.addClass('js-hide-label');
      }
      else{
        $parent.removeClass('js-hide-label').addClass('js-highlight-label');
      }
    }
    
      else if(e.type=='focus'){
        $parent.removeClass('js-hide-label').addClass('js-highlight-label'); 
      }
    
  });  
});

$( "#contactForm" ).submit(function( event ) {
	var formData = {
		"name" : $("input[name=name]").val(),
		"email" : $("input[name=email]").val(),
		"phone" : $("input[name=phone]").val(),
		"message" : $("textarea[name=message]").val(),
	};
	$("#submit_status").empty();
	if(!formData["name"]){
		$("#name").parent().addClass("bottom-error");
		$("#name_status").html("Name is required.");
	}else{
		$("#name").removeClass("bottom-error");
		$("#name_status").empty();
	}
	
	if(!formData["email"]){
		$("#email").parent().addClass("bottom-error");
		$("#email_status").html("Email address is required.");
	}else{
		$("#email").removeClass("bottom-error");
		$("#email_status").empty();
	}
	
	if(!formData["phone"]){
		$("#phone").parent().addClass("bottom-error");
		$("#phone_status").html("Mobile number is required.");
	}else{
		$("#phone").removeClass("bottom-error");
		$("#phone_status").empty();
	}
	
	if(!formData["message"]){
		$("#message").parent().addClass("bottom-error");
		$("#message_status").html("Message is required.");
	}else{
		$("#message").removeClass("bottom-error");
		$("#message_status").empty();
	}
	
	if(!$("#name_status").html() && !$("#email_status").html() && !$("#phone_status").html() && !$("#message_status").html()){
		$.ajax({
			type        : "POST", 
			url         : "userMessage.php",
			data        : formData,		    
			success	: function(response){
				data = JSON.parse(response);
				if (!data.success) {
				    	if(data.errors.submit){
				    		$("#submit_status").html(data.errors.submit);
				    	}
				}
				else{
					location.reload();
				}
			},
			error	: function(response){
				alert("error");	
			}  
		});
	}
	return false;
});

//function for review form
$(".rateit").click(function( event ) {
	var id = event.currentTarget.id;
	var rid = id.substr(12,2);
	var some = "#"+id;
	var some1 = "#user_rating"+rid;
	$(some1).val($(some).rateit("value"));
});

$( ".updateReviews" ).submit(function( event ) {
	var id = event.target.id;
	var some = "textarea[name=input_user_comment"+id+"]";
	var some1 = "input[name=input_user_rating"+id+"]";
	var some2 = "#review"+id;
	var iuc = "#input_user_comment"+id;
	var ss = "#submit_status"+id;
	var ur = "#user_rating"+id;
	var formData = {
		"input_user_comment" : $(some).val(),
		"input_user_rating" : $(some1).val(),
		"rid" : $(some2).val(),
	};
	$.ajax({
		type        : "POST", 
		url         : "updateReviews.php",
		data        : formData,		    
		success	: function(response){
			data = JSON.parse(response);
			if (!data.success) {
			    	if(data.errors.submit){
			    		$(ss).html(data.errors.submit);
			    	}
			}
			else{
				location.reload();
			}
		},
		error	: function(response){
			alert("error");	
		}  
	});
	return false;
});

$( ".userReviews" ).submit(function( event ) {
	var id = event.target.id;
	var some = "textarea[name=input_user_comment"+id+"]";
	var some1 = "input[name=input_user_rating"+id+"]";
	var iuc = "#input_user_comment"+id;
	var ss = "#submit_status"+id;
	var ur = "#user_rating"+id;
	var formData = {
		"input_user_comment" : $(some).val(),
		"input_user_rating" : $(some1).val(),
		"rid" : id,
	};
	$.ajax({
		type        : "POST", 
		url         : "userReviews.php",
		data        : formData,		    
		success	: function(response){
			data = JSON.parse(response);
			if (!data.success) {
			    	if(data.errors.submit){
			    		$(ss).html(data.errors.submit);
			    	}
			}
			else{
				location.reload();
			}
		},
		error	: function(response){
			alert("error");	
		}  
	});
	return false;
});

//function for chat form
$( ".userChats" ).submit(function( event ) {
	var id = event.target.id;
	var some = "textarea[name=input_message"+id+"]";
	var inm = "#input_message"+id;
	var ss = "#submit_status"+id;
	var yd = "#your_div"+id;
	var formData = {
		"input_message" : $(some).val(),
		"rid" : id,
	};
	if(!formData["input_message"]){
		$(inm).addClass("has-error");
		$(ss).html("Message can not be empty.");
	}else{
		$(inm).removeClass("has-error");
		$(ss).empty();
		$.ajax({
			type        : "POST", 
			url         : "userChats.php",
			data        : formData,		    
			success	: function(response){
				data = JSON.parse(response);
				if (!data.success) {
				    	if(data.errors.submit){
				    		$(ss).html(data.errors.submit);
				    	}
				}
				else{
					$(inm).val("");
var message = "<div style='width: 80%; display: inline-block'><label>me</label>: <label style='font-weight: normal;'>"+formData["input_message"]+"</label></div><div style='width: 18%; display: inline-block; vertical-align: top;'><label style='font-weight: normal; float: right; font-size: 10px;'>now</label></div>";
					
					$(yd).append(message);
					$(yd).scrollTop($(yd).prop("scrollHeight"));				
				}
			},
			error	: function(response){
				alert("error");	
			}  
		});
	}
	return false;
});

//function for forget form
$( "#forgetform" ).submit(function( event ) {
	var formData = {
		"input_email" : $("input[name=input_forget_email]").val(),
	};
	$("#forget_submit_status").empty();
	if(!formData["input_email"]){
		$("#input_forget_email").addClass("has-error");
		$("#forget_email_status").html("Email address is required.");
	}else{
		$("#input_forget_email").removeClass("has-error");
		$("#forget_email_status").empty();
	}
	if(!$("#forget_email_status").html()){
		$.ajax({
			type        : "POST", 
			url         : "userForget.php",
			data        : formData,		    
			success	: function(response){
			data = JSON.parse(response);
			if (!data.success) {
				$("#forget_submit_status").html(data.errors.submit);
			}
			else{
				$("#forget_otp").show();
				$("#forget_email").hide();
				$("#otpEmail").val(formData["input_email"]);				
			}
			},
			error	: function(response){
			alert("error");	
			}  
		});
	}
	return false;
});

function sendOTP()
{
	var email = $("#otpEmail").val();
	var formData = {
		"input_email" : email,
	};
	$.ajax({
		type        : "POST", 
		url         : "sendOTP.php",
		data        : formData,		    
		success	: function(response){
		data = JSON.parse(response);
			if (!data.success) {
				$("#forget_submit_status").html(data.errors.submit);
			}
		},
		error	: function(response){
		alert("error");	
		}  
	});
	return false;
}

$( "#otpform" ).submit(function( event ) {
	var formData = {
		"input_otp" : $("input[name=input_forget_otp]").val(),
		"input_email" : $("input[name=otpEmail]").val(),
	};
	if(!formData["input_otp"]){
		$("#input_forget_otp").addClass("has-error");
		$("#otp_submit_status").html("OTP is required.");
	}else{
		$("#input_forget_otp").removeClass("has-error");
		$("#otp_submit_status").empty();
	}
	if(!$("#otp_submit_status").html()){
		$.ajax({
			type        : "POST", 
			url         : "verifyOTP.php",
			data        : formData,		    
			success	: function(response){
			data = JSON.parse(response);
			if (!data.success) {
				$("#otp_submit_status").html(data.errors.submit);
			}
			else{
				location.href="myProfile.php?as_a=settings";
			}
			},
			error	: function(response){
			alert("error");	
			}  
		});
	}
	return false;
});

	
//function for login form
$( "#loginform" ).submit(function( event ) {
	var formData = {
		"input_mobile" : $("input[name=input_login_mobile]").val(),
		"input_password" : $("input[name=input_login_password]").val(),
	};
	$("#login_submit_status").empty();
	if(!formData["input_mobile"]){
		$("#input_login_mobile").addClass("has-error");
		$("#login_mobile_status").html("Mobile no. is required.");
	}else{
		if(formData["input_mobile"].length==10 && (formData["input_mobile"].charAt(0)=="9" || formData["input_mobile"].charAt(0)=="8" || formData["input_mobile"].charAt(0)=="7")){
			$("#input_login_mobile").removeClass("has-error");
			$("#login_mobile_status").empty();
		}else{
			$("#input_login_mobile").addClass("has-error");
			$("#login_mobile_status").html("Invalid Mobile Number!");
		}
	}
	
	if(!formData["input_password"]){
		$("#input_login_password").addClass("has-error");
		$("#login_password_status").html("Password is required.");
	}else{
		$("#input_login_password").removeClass("has-error");
		$("#login_password_status").empty();
	}
	
	if(!$("#login_mobile_status").html() && !$("#login_password_status").html()){
		
		$.ajax({
			type        : "POST", 
			url         : "userLogin.php",
			data        : formData,		    
			success	: function(response){
			data = JSON.parse(response);
			if (!data.success) {
			    	if(data.errors.submit){
			    		$("#login_submit_status").html(data.errors.submit);
			    	}
			}
			else{
				location.reload();
			}
			},
			error	: function(response){
			alert("error");	
			}  
		});
		
	}
	return false;
});

//function for register form
$( "#registerform" ).submit(function( event ) {
	var formData = {
		"input_mobile" : $("input[name=input_mobile]").val(),
		"input_email" : $("input[name=input_email]").val(),
		"input_username" : $("input[name=input_username]").val(),
		"input_password" : $("input[name=input_password]").val(),
		"input_repassword" : $("input[name=input_repassword]").val(),
		"input_code" : $("input[name=input_code]").val(),
	};
	$("#submit_status").empty();
	$("#code_status").empty();
	$("#input_code").removeClass("has-error");
	
	if(!formData["input_mobile"]){
		$("#input_mobile").addClass("has-error");
		$("#mobile_status").html("Mobile no. is required.");
	}else{
		if(formData["input_mobile"].length==10 && (formData["input_mobile"].charAt(0)=="9" || formData["input_mobile"].charAt(0)=="8" || formData["input_mobile"].charAt(0)=="7")){
			$("#input_mobile").removeClass("has-error");
			$("#mobile_status").empty();
		}else{
			$("#input_mobile").addClass("has-error");
			$("#mobile_status").html("Invalid Mobile Number!");
		}
	}
	
	if(!formData["input_email"]){
		$("#input_email").addClass("has-error");
		$("#email_status").html("Email address is required.");
	}else{
		$("#input_email").removeClass("has-error");
		$("#email_status").empty();
	}
	
	if(!formData["input_username"]){
		$("#input_username").addClass("has-error");
		$("#username_status").html("Name is required.");
	}else{
		if(formData["input_username"].length>=3){
			$("#input_username").removeClass("has-error");
			$("#username_status").empty();
		}else{
			$("#input_username").addClass("has-error");
			$("#username_status").html("At least three characters.");
		}
	}
	
	if(!formData["input_password"]){
		$("#input_password").addClass("has-error");
		$("#password_status").html("Password is required.");
	}else{
		if(formData["input_password"].length>=6){
			$("#input_password").removeClass("has-error");
			$("#password_status").empty();
		}else{
			$("#input_password").addClass("has-error");
			$("#password_status").html("At least six characters.");
		}
	}
	
	if(!formData["input_repassword"]){
		$("#input_repassword").addClass("has-error");
		$("#repassword_status").html("Re-type Password is required.");
	}else{
		$("#input_repassword").removeClass("has-error");
		$("#repassword_status").empty();
	}
	
	if(formData["input_password"] != formData["input_repassword"] && formData["input_password"] && formData["input_repassword"]){
		$("#repassword_status").html("Re-type Password must be same as Password.");
	}
	
	if(formData["input_code"]){
		$.ajax({
			type        : "POST", 
			url         : "checkReferralCode.php",
			data        : formData,		    
			success	: function(response){
			data = JSON.parse(response);
				if (!data.success) {
			    		$("#code_status").html("Invalid Referral Code (Case-Sensitive)!");
			    		$("#input_code").addClass("has-error");
				}
			},
			error	: function(response){
				alert("error");	
			}  
		});
	}
	
	if(!$("#mobile_status").html() && !$("#email_status").html() && !$("#username_status").html() && !$("#password_status").html() && !$("#repassword_status").html() && !$("#code_status").html()){
		if(!$("#input_register_checkbox").is(":checked")){
			alert("Please ensure that you are 18+");
		}else{
			$.ajax({
				type        : "POST", 
				url         : "userRegister.php",
				data        : formData,		    
				success	: function(response){
				data = JSON.parse(response);
				if (!data.success) {
				    	if(data.errors.submit){
				    		$("#submit_status").html(data.errors.submit);
				    	}
				}
				else{
					/*
					 *  CR 44
					 *  - To show the OTP text box
					 *  Fix BEGIN
					 */
					$("#reg_form").hide();
					$("#reg_otp").show();
					$("#input_verify_mobile").val(formData["input_mobile"]);
					/*  Fix END - 44  */
				}
				},
				error	: function(response){
				alert("error");	
				}  
			});
		}
	}
	return false;
            
});

/*
 *  CR 44
 *  - To verify OTP via AJAX
 *  Fix BEGIN
 */
//function for verify otp form
$( "#verifyotpform" ).submit(function( event ) {
	var formData = {
		"input_verify_mobile" : $("input[name=input_verify_mobile]").val(),
		"input_otp" : $("input[name=input_otp]").val(),
	};
	$("#otp_status").empty();
	//$("#input_code").removeClass("has-error");
	
	if(!formData["input_verify_mobile"]){
		$("#input_verify_mobile").addClass("has-error");
		$("#verify_mobile_status").html("Mobile no. is required.");
	}else{
		if(formData["input_verify_mobile"].length==10 && (formData["input_verify_mobile"].charAt(0)=="9" || formData["input_verify_mobile"].charAt(0)=="8" || formData["input_verify_mobile"].charAt(0)=="7")){
			$("#input_verify_mobile").removeClass("has-error");
			$("#verify_mobile_status").empty();
		}else{
			$("#input_verify_mobile").addClass("has-error");
			$("#verify_mobile_status").html("Invalid Mobile Number!");
		}
	}

	if(!formData["input_otp"]){
		$("#input_otp").addClass("has-error");
		$("#otp_status").html("Please provide a valid OTP");
	}
	
	if(!$("#verify_mobile_status").html() && !$("#otp_status").html()){
		$.ajax({
			type        : "POST", 
			url         : "verifyMobileOTP.php",
			data        : formData,		    
			success	: function(response){
			data = JSON.parse(response);
			if (!data.success) {
			    	if(data.errors.submit){
			    		$("#verify_status").html(data.errors.submit);
			    	}
			}
			else{
				location.reload();
			}
			},
			error	: function(response){
				alert("error");	
			}  
		});
	}
	return false;
});
/*  Fix END - 44  */

//function for Parcel form
function userParcels()
{
	var formData = {
		"input_pickup_address_id" : $("input[name=input_pickup_address_id]").val(),
		"input_delivery_address_id" : $("input[name=input_delivery_address_id]").val(),
		"input_delivery_date" : $("input[name=input_delivery_date]").val(),
		"input_notes" : $("textarea[name=input_notes]").val(),
		"input_headline" : $("input[name=input_headline]").val(),
		"input_weight" : $("input[name=input_weight]").val(),
		"input_price" : $("input[name=input_price]").val(),
	};
	
	if(!formData["input_delivery_address_id"]){
		$("#delivery_address_status").html("Delivery address is required.");
	}else{
		$("#delivery_address_status").empty();
	}
	
	if(!formData["input_pickup_address_id"]){
		$("#pickup_address_status").html("Pickup address is required.");
	}else{
		$("#pickup_address_status").empty();
	}

	if(!formData["input_delivery_date"]){
		$("#datepicker").addClass("has-error");
		$("#date_status").html("Parcel date is required.");
	}else{
		
		if(formData["input_delivery_date"] < currentDate()){
			$("#datepicker").addClass("has-error");
			$("#date_status").html("Parcel date must be greater than present date.");
		}else{
			$("#datepicker").removeClass("has-error");
			$("#date_status").empty();
		}
	}

	if(!formData["input_headline"]){
		$("#input_headline").addClass("has-error");
		$("#headline_status").html("Headline is required.");
	}else{
		$("#input_headline").removeClass("has-error");
		$("#headline_status").empty();
	}
	
	if(!formData["input_weight"]){
		$("#input_weight").addClass("has-error");
		$("#weight_status").html("Weight is required.");
	}else{
		$("#input_weight").removeClass("has-error");
		$("#weight_status").empty();
	}
	
	if(!formData["input_price"]){
		$("#input_price").addClass("has-error");
		$("#price_status").html("Price is required.");
	}else{
		$("#input_price").removeClass("has-error");
		$("#price_status").empty();
	}
	
	if(formData["input_delivery_address_id"] == formData["input_pickup_address_id"] && formData["input_pickup_address_id"]){
		$("#delivery_address_status").html("Pickup address and Delivery address must be different.");
	}
	
	if(!$("#delivery_address_status").html() && !$("#pickup_address_status").html() && !$("#date_status").html() && !$("#headline_status").html() && !$("#weight_status").html() && !$("#price_status").html()){
		$.ajax({
	            type        : "POST", 
	            url         : "userParcels.php",
	            data        : formData,		    
	            success	: function(response){
	            	data = JSON.parse(response);
	            	if (!data.success) {
		            	if(data.errors.submit){
		            		$("#submit_status").html(data.errors.submit);
		            	}
		    	}
		    	else{
		    		location.reload();
		    	}
	            },
	            error	: function(response){
	            	alert("error");	
	            }   
	        });
	}
	return false;
}

function updateParcels()
{
	var formData = {
		"order_id" : $("input[name=order_id]").val(),
		"input_pickup_address_id" : $("input[name=input_pickup_address_id]").val(),
		"input_delivery_address_id" : $("input[name=input_delivery_address_id]").val(),
		"input_delivery_date" : $("input[name=input_delivery_date]").val(),
		"input_notes" : $("textarea[name=input_notes]").val(),
		"input_headline" : $("input[name=input_headline]").val(),
		"input_weight" : $("input[name=input_weight]").val(),
		"input_price" : $("input[name=input_price]").val(),
	};
	
	if(!formData["input_delivery_address_id"]){
		$("#delivery_address_status").html("Delivery address is required.");
	}else{
		$("#delivery_address_status").empty();
	}
	
	if(!formData["input_pickup_address_id"]){
		$("#pickup_address_status").html("Pickup address is required.");
	}else{
		$("#pickup_address_status").empty();
	}

	if(!formData["input_delivery_date"]){
		$("#datepicker").addClass("has-error");
		$("#date_status").html("Parcel date is required.");
	}else{
		
		if(formData["input_delivery_date"] < currentDate()){
			$("#datepicker").addClass("has-error");
			$("#date_status").html("Parcel date must be greater than present date.");
		}else{
			$("#datepicker").removeClass("has-error");
			$("#date_status").empty();
		}
	}

	if(!formData["input_headline"]){
		$("#input_headline").addClass("has-error");
		$("#headline_status").html("Headline is required.");
	}else{
		$("#input_headline").removeClass("has-error");
		$("#headline_status").empty();
	}
	
	if(!formData["input_weight"]){
		$("#input_weight").addClass("has-error");
		$("#weight_status").html("Weight is required.");
	}else{
		$("#input_weight").removeClass("has-error");
		$("#weight_status").empty();
	}
	
	if(!formData["input_price"]){
		$("#input_price").addClass("has-error");
		$("#price_status").html("Price is required.");
	}else{
		$("#input_price").removeClass("has-error");
		$("#price_status").empty();
	}
	
	if(formData["input_delivery_address_id"] == formData["input_pickup_address_id"] && formData["input_pickup_address_id"])
	{
		$("#delivery_address_status").html("Pickup address and Delivery address must be different.");
	}
	
	if(!$("#delivery_address_status").html() && !$("#pickup_address_status").html() && !$("#date_status").html() && !$("#headline_status").html() && !$("#weight_status").html() && !$("#price_status").html()){
		$.ajax({
	            type        : "POST", 
	            url         : "updateParcels.php",
	            data        : formData,		    
	            success	: function(response){
	            	data = JSON.parse(response);
	            	if (!data.success) {
		            	if(data.errors.submit){
		            		$("#submit_status").html(data.errors.submit);
		            	}
		            	if(data.errors.registration){
		            		$("#submit_status").html(data.errors.registration);
		            	}
		    	}
		    	else{
		    		location.href="myOrders.php";
		    	}
	            },
	            error	: function(response){
	            	alert("error");	
	            }   
	        });
	}
	return false;
}


//function for Journey form
function userJourneys()
{
	var formData = {
		"input_source_address_id" : $("input[name=input_source_address_id]").val(),
		"input_destination_address_id" : $("input[name=input_destination_address_id]").val(),
		"input_journey_date" : $("input[name=input_journey_date]").val(),
		"input_notes" : $("textarea[name=input_notes]").val(),
		"input_headline" : $("input[name=input_headline]").val(),
	};
	
	if(!formData["input_destination_address_id"]){
		$("#destination_address_status").html("Destination address is required.");
	}else{
		$("#destination_address_status").empty();
	}
	
	if(!formData["input_source_address_id"]){
		$("#source_address_status").html("Source address is required.");
	}else{
		$("#source_address_status").empty();
	}

	if(!formData["input_journey_date"]){
		$("#datepicker").addClass("has-error");
		$("#date_status").html("Journey date is required.");
	}else{
		
		if(formData["input_journey_date"] < currentDate()){
			$("#datepicker").addClass("has-error");
			$("#date_status").html("Journey date must be greater than present date.");
		}else{
			$("#datepicker").removeClass("has-error");
			$("#date_status").empty();
		}
	}

	if(!formData["input_headline"]){
		$("#input_headline").addClass("has-error");
		$("#headline_status").html("Headline is required.");
	}else{
		$("#input_headline").removeClass("has-error");
		$("#headline_status").empty();
	}
	
	if(formData["input_destination_address_id"] == formData["input_source_address_id"] && formData["input_source_address_id"]){
		$("#destination_address_status").html("Source address and Destination address must be different.");
	}
	
	if(!$("#destination_address_status").html() && !$("#source_address_status").html() && !$("#date_status").html() && !$("#headline_status").html()){
		$.ajax({
	            type        : "POST", 
	            url         : "userJourneys.php",
	            data        : formData,		    
	            success	: function(response){
	            	data = JSON.parse(response);
	            	if (!data.success) {
		            	if(data.errors.submit){
		            		$("#submit_status").html(data.errors.submit);
		            	}
		    	}
		    	else{
		    		location.reload();
		    	}
	            },
	            error	: function(response){
	            	alert("error");	
	            }   
	        });
	}
	return false;
}

function updateJourneys()
{
	var formData = {
		"journey_id" : $("input[name=journey_id]").val(),
		"input_source_address_id" : $("input[name=input_source_address_id]").val(),
		"input_destination_address_id" : $("input[name=input_destination_address_id]").val(),
		"input_journey_date" : $("input[name=input_journey_date]").val(),
		"input_notes" : $("textarea[name=input_notes]").val(),
		"input_headline" : $("input[name=input_headline]").val(),
	};
	
	if(!formData["input_destination_address_id"]){
		$("#destination_address_status").html("Destination address is required.");
	}else{
		$("#destination_address_status").empty();
	}
	
	if(!formData["input_source_address_id"]){
		$("#source_address_status").html("Source address is required.");
	}else{
		$("#source_address_status").empty();
	}

	if(!formData["input_journey_date"]){
		$("#datepicker").addClass("has-error");
		$("#date_status").html("Journey date is required.");
	}else{
		
		if(formData["input_journey_date"] < currentDate()){
			$("#datepicker").addClass("has-error");
			$("#date_status").html("Journey date must be greater than present date.");
		}else{
			$("#datepicker").removeClass("has-error");
			$("#date_status").empty();
		}
	}

	if(!formData["input_headline"]){
		$("#input_headline").addClass("has-error");
		$("#headline_status").html("Headline is required.");
	}else{
		$("#input_headline").removeClass("has-error");
		$("#headline_status").empty();
	}
	
	if(formData["input_destination_address_id"] == formData["input_source_address_id"] && formData["input_source_address_id"])
	{
		$("#destination_address_status").html("Source address and Destination address must be different.");
	}
	
	if(!$("#destination_address_status").html() && !$("#source_address_status").html() && !$("#date_status").html() && !$("#headline_status").html()){
		$.ajax({
	            type        : "POST", 
	            url         : "updateJourneys.php",
	            data        : formData,		    
	            success	: function(response){
	            	data = JSON.parse(response);
	            	if (!data.success) {
		            	if(data.errors.submit){
		            		$("#submit_status").html(data.errors.submit);
		            	}
		            	if(data.errors.registration){
		            		$("#submit_status").html(data.errors.registration);
		            	}
		    	}
		    	else{
		    		location.href="myJourneys.php";
		    	}
	            },
	            error	: function(response){
	            	alert("error");	
	            }   
	        });
	}
	return false;
}

//function for Address form
function checklabel(){
	var formData = {
		"address_id" : $("input[name=address_id]").val(),
		"input_address_label" : $("input[name=input_address_label]").val(),
	};
	$("#input_address_label").removeClass("has-error");
	$("#label_status").empty();
	if(!formData["input_address_label"]){
		$("#input_address_label").addClass("has-error");
		$("#label_status").html("Label is required.");
	}else{
		$.ajax({
	            type        : "POST", 
	            url         : "checklabel.php",
	            data        : formData,		    
	            success	: function(response){
	            	data = JSON.parse(response);
	            	if (!data.success) {
		            	if(data.errors.input_address_label){
		     
		            		$("#input_address_label").addClass("has-error");
		            		$("#label_status").html(data.errors.input_address_label);
		            	}
		        }
		    }
	        });
	}
        return false;
}
function checkpincode(){
	var formData = {
		"input_pincode" : $("input[name=input_pincode]").val(),
	};
	$("#input_pincode").removeClass("has-error");
	$("#pincode_status").empty();
	if(!formData["input_pincode"]){
		$("#input_pincode").addClass("has-error");
		$("#pincode_status").html("Pincode is required.");
	}else{
		$.ajax({
	            type        : "POST", 
	            url         : "checkpincode.php",
	            data        : formData,		    
	            success	: function(response){
	            	data = JSON.parse(response);
	            	if (!data.success) {
		            	if(data.errors.input_pincode){
		     
		            		$("#input_pincode").addClass("has-error");
		            		$("#pincode_status").html(data.errors.input_pincode);
		            	}
		        }
		    }
	        });
	}
	
        return false;
}
function checkaddress(){
	var formData = {
		"input_address" : $("textarea[name=input_address]").val(),
	};
	$("#comment").removeClass("has-error");
	$("#address_status").empty();
	if(!formData["input_address"]){
		$("#comment").addClass("has-error");
		$("#address_status").html("Address is required.");
	}
	return false;
}
			
function updateAddress(){
	var formData = {
		"address_id" : $("input[name=address_id]").val(),
		"input_address_label" : $("input[name=input_address_label]").val(),
		"input_pincode" : $("input[name=input_pincode]").val(),
		"input_address" : $("textarea[name=input_address]").val(),
		"city" : $("input[name=city]").val(),
		"state" : $("input[name=state]").val(),
	};
	if(!formData["input_address_label"] || !formData["input_pincode"] || !formData["input_address"]){
		
		if(!formData["input_address_label"]){
			$("#input_address_label").addClass("has-error");
			$("#label_status").html("Label is required.");
		}else{
			$.ajax({
		            type        : "POST", 
		            url         : "checklabel.php",
		            data        : formData,		    
		            success	: function(response){
		            	data = JSON.parse(response);
		            	if (!data.success) {
			            	if(data.errors.input_address_label){
			     
			            		$("#input_address_label").addClass("has-error");
			            		$("#label_status").html(data.errors.input_address_label);
			            	}
			        }
			    }
		        });
		}
	
		if(!formData["input_pincode"]){
			$("#input_pincode").addClass("has-error");
			$("#pincode_status").html("Pincode is required.");
		}else{
			$.ajax({
		            type        : "POST", 
		            url         : "checkpincode.php",
		            data        : formData,		    
		            success	: function(response){
		            	data = JSON.parse(response);
		            	if (!data.success) {
			            	if(data.errors.input_pincode){
			     
			            		$("#input_pincode").addClass("has-error");
			            		$("#pincode_status").html(data.errors.input_pincode);
			            	}
			        }
			    }
		        });
		}
	
		if(!formData["input_address"]){
			$("#comment").addClass("has-error");
			$("#address_status").html("Address is required.");
		}else{
			$("#comment").removeClass("has-error");
			$("#address_status").empty();
		}
	
	}else{
		$.ajax({
	            type        : "POST", 
	            url         : "updateAddress.php",
	            data        : formData,		    
	            success	: function(response){
	            	$(".form-control").removeClass("has-error");
	            	$(".error-status").empty();
	            	data = JSON.parse(response);
	            	if (!data.success) {
		            	if(data.errors.input_address_label){
		            		$("#input_address_label").addClass("has-error");
		            		$("#label_status").html(data.errors.input_address_label);
		            	}
		            	if(data.errors.input_pincode){
		            		$("#input_pincode").addClass("has-error");
		            		$("#pincode_status").html(data.errors.input_pincode);
		            	}
		            	if(data.errors.input_address){
		            		$("#comment").addClass("has-error");
		            		$("#address_status").html(data.errors.input_address);
		            	}
		            	if(data.errors.submit){
		            		$("#submit_status").html(data.errors.submit);
		            	}
		    	}
		    	else{
		    		location.reload();
		    	}
	            },
	            error	: function(response){
	            	alert("error");	
	            }   
	        });
	}
	return false;
}

function userAddress(){
	var formData = {
		"input_address_label" : $("input[name=input_address_label]").val(),
		"input_pincode" : $("input[name=input_pincode]").val(),
		"input_address" : $("textarea[name=input_address]").val(),
		"city" : $("input[name=city]").val(),
		"state" : $("input[name=state]").val(),
	};
	if(!formData["input_address_label"] || !formData["input_pincode"] || !formData["input_address"]){
	
		if(!formData["input_address_label"]){
			$("#input_address_label").addClass("has-error");
			$("#label_status").html("Label is required.");
		}else{
			$.ajax({
		            type        : "POST", 
		            url         : "checklabel.php",
		            data        : formData,		    
		            success	: function(response){
		            	data = JSON.parse(response);
		            	if (!data.success) {
			            	if(data.errors.input_address_label){
			     
			            		$("#input_address_label").addClass("has-error");
			            		$("#label_status").html(data.errors.input_address_label);
			            	}
			        }
			    }
		        });
		}
	
		if(!formData["input_pincode"]){
			$("#input_pincode").addClass("has-error");
			$("#pincode_status").html("Pincode is required.");
		}else{
			$.ajax({
		            type        : "POST", 
		            url         : "checkpincode.php",
		            data        : formData,		    
		            success	: function(response){
		            	data = JSON.parse(response);
		            	if (!data.success) {
			            	if(data.errors.input_pincode){
			     
			            		$("#input_pincode").addClass("has-error");
			            		$("#pincode_status").html(data.errors.input_pincode);
			            	}
			        }
			    }
		        });
		}
	
		if(!formData["input_address"]){
			$("#comment").addClass("has-error");
			$("#address_status").html("Address is required.");
		}else{
			$("#comment").removeClass("has-error");
			$("#address_status").empty();
		}
	
	}else{
		$.ajax({
	            type        : "POST", 
	            url         : "userAddress.php",
	            data        : formData,		    
	            success	: function(response){
	            	$(".form-control").removeClass("has-error");
	            	$(".error-status").empty();
	            	data = JSON.parse(response);
	            	if (!data.success) {
		            	if(data.errors.input_address_label){
		            		$("#input_address_label").addClass("has-error");
		            		$("#label_status").html(data.errors.input_address_label);
		            	}
		            	if(data.errors.input_pincode){
		            		$("#input_pincode").addClass("has-error");
		            		$("#pincode_status").html(data.errors.input_pincode);
		            	}
		            	if(data.errors.input_address){
		            		$("#comment").addClass("has-error");
		            		$("#address_status").html(data.errors.input_address);
		            	}
		            	if(data.errors.submit){
		            		$("#submit_status").html(data.errors.submit);
		            	}
		    	}
		    	else{
		    		location.reload();
		    	}
	            },
	            error	: function(response){
	            	alert("error");	
	            }   
	        });
	}
	return false;
}

//function for pincode based address autofill in myAddress.php

function fillAddress()
{       
	$( "#input_pincode" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "http://wecarriers.com/ravi_4/pincode_json.php",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,  // Set minimum input length
      select: function( event, ui ) {
            var vl = ui.item.id;      
            var data = vl.split("-");
            //console.log(data);
            $("#city").val(data[1]);
            $("#state").val(data[2]);
      },
      open: function() {
                 // D0 something on open event.
      },
      close: function() {
               // Do something on close event
      }
    });
  }
  
//function for pincode search in myDashboard.php

function showPincode()
{       
	$("#pincode0,#pincode1,#pincode2,#pincode3").autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "http://wecarriers.com/ravi_4/pincode_json.php",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,  // Set minimum input length
      select: function( event, ui ) {
            var vl = ui.item.id;      
            var data = vl.split("-");
            //console.log(data);
      },
      open: function() {
                 // D0 something on open event.
      },
      close: function() {
               // Do omething on close event
      }
    });
  }
  
//function for pizza menu