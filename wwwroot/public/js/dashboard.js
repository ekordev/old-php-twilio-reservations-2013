// dashboard.js -> dashboard page default functions generic javascript
function password_controller(formName,formUrl,formMethod,formData){
	var jsonData = JSON.stringify(formData), json,
		submitJSON = '{ "name": '+formName+', "data": '+jsonData+' }';
/*
	console.log(formUrl); console.log(formMethod);
	console.log(formData); console.log(jsonData);
	console.log(submitJSON);
	console.log(formData.current_password);
	console.log(formData.new_pwd);
*/
	if(formData.new_pwd){
		// new password
		if($("#new_pwd").val()!== ($("#new_pwd_confirm").val())){
			$("#error_message").html('<span style="color:red;">Your password\'s do not match. Please try again.</span>');
			$("#new_pwd").val('');
			$("#new_pwd_confirm").val('');
			$('#new_pwd').css("border", "#FF0000 solid 1px")
			$('#new_pwd_confirm').css("border", "#FF0000 solid 1px")
			$("#new_pwd").focus();
			return false;
		}else{
			console.log('ajax insert');
		}
	}else{
		// check existing password
		$("#error_message").html('');
		$.ajax({
			dataType:"json",
			type: formMethod,
			url: formUrl,
			data: { data: jsonData },
			complete: function( results ){
				$.map(results, function(value,key){
					if(key == 'responseText'){
						json = eval('(' + value + ')');
						if( json[0].contact_id === 0 ){
							$("#error_message").html('<span style="color: red;">There was an error with your password. Please try again.</span>');
						}else{
							$("#error_message").html('');
							$("#new-password").show();
						}
					}
				});
			}
		});
	}
}
