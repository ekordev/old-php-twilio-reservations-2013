// login.js -> login page default functions generic javascript
function page_redirect( results ){
	console.log( results );
	var strUrl;
	if( results[0].contact_id === 0 ){
		alert('Please re-enter your mobile number or password.');
		return false;
	}else{
//		$.map(results[0], function(value,key){
//			if( !value ){ value = 0; }
//			$.cookie(key, value);
//			$.cookie(key, value, { domain: '.ireserv.it', path: '/' });
//			console.log( key + ' = ' + value );
//		});
		// if no querystring item
		console.log( GetQueryStringParams("pid") );
		console.log( GetQueryStringParams("a") );

		$guestlist_id = GetQueryStringParams("pid");
		$request_type = ( GetQueryStringParams("a") ) ;

		switch( $request_type ){
			case "1":
				strUrl = '/guest-list.php?pid=' + $guestlist_id + '&a=' + $request_type;
			break;
			case "2":
				strUrl = '/guest-list?pid=' + $guestlist_id + '&a=' + $request_type;
			break;
			default:
				strUrl = '/dashboard.php';
		}
		console.log(strUrl);
		document.location.href = strUrl;
	}
}

// return the querystring parameters
function GetQueryStringParams(sParam){
	var sPageURL = window.location.search.substring(1),
    	sURLVariables = sPageURL.split('&'),
    	sParameterName;
    for (var i = 0; i < sURLVariables.length; i++){
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam){
            return sParameterName[1];
        }
    }
}
