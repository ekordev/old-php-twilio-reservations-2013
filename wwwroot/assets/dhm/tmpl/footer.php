<!-- css only spinning loader -->
<div id="loading"></div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="public/js/jquery/jquery.mobile.custom.min.js"></script>
	<script src="public/js/jquery/jquery.easing.min.js"></script>
	<script src="public/js/plugins/snap.min.js"></script>
    <script src="public/js/plugins/serializeForm.min.js"></script>
    <script src="public/js/jquery/jquery.cookie.js"></script>
   <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-wip/js/bootstrap.min.js"></script>
    <script src="public/js/respond.min.js"></script>
    <script type="javascript">
    /********** manage the difference in window location by appliance ***********/
    var page = document.getElementById('container'),
        ua = navigator.userAgent,
        iphone = ~ua.indexOf('iPhone') || ~ua.indexOf('iPod'),
        ipad = ~ua.indexOf('iPad'),
        ios = iphone || ipad,
        fullscreen = window.navigator.standalone,
        android = ~ua.indexOf('Android'),
        lastWidth = 0;

    if (android) {
      window.onscroll = function() {
        page.style.height = window.innerHeight + 'px'
      }
    }
    var setupScroll = window.onload = function() {
      if (ios) {
        var height = document.documentElement.clientHeight;
        if (iphone && !fullscreen) height += 100;
        page.style.height = height + 'px';
      } else if (android) {
        page.style.height = (window.innerHeight + 75) + 'px'
      }
      setTimeout(scrollTo, 0, 0, 1);
    };
    (window.onresize = function() {
      var pageWidth = page.offsetWidth;
      if (lastWidth == pageWidth) return;
      lastWidth = pageWidth;
      setupScroll();
    })();
    </script>
    <script>
		/* AJAX Start Loader */
		$(document).ajaxStart(function(){
			console.log('ajaxStart');
			$("#loading").show();
		});
		/* AJAX Complete Loader Hide */
		$(document).ajaxStop(function(){
			console.log('ajaxStop');
			$("#loading").hide();
			var vid = $.cookie("venue_id"),
				cid = $.cookie("credentials_id");
			if(vid == 'null'){ vid = 0; } if(cid == 'null'){ cid = 0; }
			var strUrl = '../dashboard.php?vid='+vid+'&cid='+cid;
			console.log(strUrl);
			document.location.href = strUrl;
		});
    /********************** jquery actions **********************/
    $(document).ready(function(){
    	/* set the page to function as an app viewport */
		window.addEventListener("load", function () {
			// Set a timeout...
			setTimeout(function () {
				// Hide the address bar!
				window.scrollTo(0, 1);
			}, 0);
		});
		/* form login response */
    	$("form[name='login-form']").submit(function(e){
    		e.preventDefault();
    		var formName = $(this).attr('name'),
    			formUrl = 'lib/forms/'+ $(this).attr('action'),
    			formMethod = $(this).attr('method'),
    			formData = $(this).serializeForm(),
    			jsonData = JSON.stringify(formData),
    			submitJSON = '{ "name": '+formName+', "data": '+jsonData+' }';
    		console.log(formUrl); console.log(formMethod);
    		console.log(formData); console.log(jsonData);
    		console.log(submitJSON);
    		$.ajax({
				dataType:"json",
				type: formMethod,
				url: formUrl,
				data: { data: jsonData }
    		}).done(function( results ){
    			if(results){
    				console.log( JSON.stringify(results) );
    				if(results[0]["contact_id"] === 0){
    					alert('Please re-enter your mobile number or password.');
    				}else{
						$.map(results[0], function(value,key){
							$.cookie(key, value);
						});
    				}
    			}
    		});
    	});
    });
    </script>
  </body>
</html>
