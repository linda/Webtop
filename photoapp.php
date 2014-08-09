<html>
<head>
	<!-- Later include all this via php -->

	<!-- jQuery library -->
	<script type="text/javascript" src="../fancybox/jquery-1.11.1.min.js"></script>
	<!-- fancyBox -->
	<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js"></script>

	<!-- Helpers - button, thumbnail and/or media -->
	<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
	<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

	<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>

	<script>
			
		// ============================
		// 	Include fancyBox.
		// =======================
		$(document).ready(function() {
			$(".gallery").fancybox();
		});

		
		// ============================
		// 	Popup window for the photo app.
		// =======================
		function newPopup(url) {
			popupWindow = window.open(
				url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
		}	
	</script>
	
</head>


<a class="gallery" rel="group" href="images/herbstcampus017.jpg" title="Campus Wien im Herbst">
	<img src="images/herbstcampus017_small.jpg" alt="" />
</a>
<a class="gallery" rel="group" href="images/herbstcampus012.jpg" title="Campus Wien im Herbst bis">
	<img src="images/herbstcampus012_small.jpg" alt="" />
</a>

</body>
</html>