<script>
	// ============================
	//	Global variables.
	// =======================
	var dialogStateArray;
	var icon1Position;
	
	// ============================
	//	Function that loads the current state from the session variables upon page load
	// =======================	
	$(function() {
		$.ajax({
			type: "GET",
			url: "savestate.php",
			data: "",
			dataType: "text"
		})
		.done(function() {
			dialogStateArray = <?php echo json_encode($_SESSION['dialog']); ?>;
			icon1Position = <?php echo json_encode($_SESSION['icon1']); ?>;
		});
	});
	
	// ============================
	//	Function for everything to do with the dialog window (in dialog.php).
	// ============================
	$(function() {
	
		// ============================
		//	Settings for the dialog window with php info
		// =======================
			$( "#dialog" ).dialog({
				autoOpen: false,
				height: 400,
				width: 670,
			// ============================
			//	On closing the dialog, send ajax request to save new state of the window:
			// ============================			
				close: function() {
					$.ajax({
						type: "POST",
						url: "savestate.php",
						data: { dialog: "closed" },
						dataType: "text"
						})
						// .done(function( data ) {
							// dialogStateArray = <?php echo json_encode($_SESSION['dialog']); ?>;	
						// });
				}
			});
			// ============================
			//	Functions when there is a double-click on one of the icons:
			//  1) The dialog window is opened
			//  2) Ajax request is sent to save the new state in savestate.php
			//		where is will be saved in session vars
			// ============================

			$( ".opener" ).dblclick(function() {
				$( "#dialog" ).dialog( "open" );
				$.ajax({
					type: "POST",
					url: "savestate.php",
					data: { dialog: "open" },
					dataType: "text"
					})
			});
	});

	// ============================
	//	Functions that opens the dialog window with php.info if the corresponding session variable 
	//	is set to "open" (so that the window state remains the same on reload)
	//	Set to $( window ).load so it is executed after the other functions 
	//	TODO: test more
	// ============================
	$( window ).load(function() {
		if (dialogStateArray === "open"){
			$( "#dialog" ).dialog( "open" );
		}
		$( ".draggable.useropener" ).css("left", icon1Position.left + "px");
	});

	// ============================
	//	Functions that opens the menu upon page load if the corresponding
	//	session variable is set to "open"
	// ============================
	
	// var menuStateArray;
		
	// ============================
	//	Functions for the dialog window with user info (in userdaten.php)
	// =======================		
	$(function() {
		$( "#userdaten" ).dialog({
			autoOpen: false,
			height: 150,
			width: 250
		});
		$( ".useropener" ).dblclick(function() {
			$( "#userdaten" ).dialog( "open" );
		});
	});

	// ============================
	// 	Function for draggable elements (icons); defined by the "draggable"
	//	class, so same action for all four icons.
	//	TODO: change (ideally generalise the ajax request to a function to be called every time).
	// =======================	
	$(function() {
		$( ".draggable" ).draggable({
			stop: function(event, ui) {
				$.ajax({
					type: "POST",
					url: "savestate.php",
					data: {icon1: {left: ui.position.left, top: ui.position.top}},
					dataType: "text"
					})
			}
		});
	});
	
	// ============================
	// 	Functions for the startmenu. Is called by onClick on the "Start" paragraph.
	// =======================
	$(function() {
		$( "#menu" ).menu();
	});
	function closeopenstartmenu(){
		if($( "#menudiv" ).css( "display" )=='none')
		{
			$( '#menudiv' ).show();
			$.ajax({
				type: "POST",
				url: "savestate.php",
				data: { menu: "open" },
				dataType: "text"
				})
		}
		else $( '#menudiv' ).hide();
	}
		// ============================
		// 	Popup window for the photo app (is attached to one of the icons; TODO
		//	have the app open on double-click, not as a link)
		// =======================
		function newPopup(url) {
			popupWindow = window.open(
				url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
		}	

</script>