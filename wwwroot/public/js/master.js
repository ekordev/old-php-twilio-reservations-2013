/*****************************************************************************************
// master.js
// this is stuff which applies to every page within the application for mobile
// resets, orientation, etc
// james mendham
// August 20th, 2013 - 5:43 PM
*****************************************************************************************/
$(document).ready(function(e){
	// iPhone form to page viewport reset
	$('input, textarea, select').bind('blur',function(e){
		window.scrollTo(0,1);
	});
	// format phone number form fields
	$(".mobile").mask("(999) 999-9999");
});

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
