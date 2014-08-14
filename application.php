<script>
	// ============================
	//	Global variable that saves the state of the dialog window (open or closed,
	// or true or false)
	// =======================
	var dialogStateArray;

	$(function() {
		$.ajax({
			type: "GET",
			url: "savestate.php",
			data: "",
			dataType: "text"
		})
		.done(function() {
			dialogStateArray = <?php echo json_encode($_SESSION['dialog']); ?>;
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
					// .done(function( data ) {
						// dialogStateArray = <?php echo json_encode($_SESSION['dialog']); ?>;	
					// });
			});
	});

	// ============================
	//	Functions that opens the dialog window with php.info
	//	if the corresponding session variable is set to "open"
	//  (so that the window state remains the same on reload)
	//	Set to $( window ).load so it is executed after the other
	//	function and dialogStateArray isn't given several contracting values
	//	during the page load
	//	TODO: test more
	// ============================

	$( window ).load(function() {
		if (dialogStateArray === "open"){
			$( "#dialog" ).dialog( "open" );
		}
	});




	// ============================
	//	Functions that opens the menu upon page load
	//	if the corresponding session variable is set to "open"
	//  (so that the window state remains the same on reload)
	//	Does not yet work before first Ajax request is sent.
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

	$(function() {
		$( ".draggable" ).draggable();
	});

	// $( ".draggable" ).draggable({
		// stop: function( event, ui ) {}
	// });
	
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

		// NOTE: hide/show: can be done automatically with "toggle" - don't need an if/else
		
		// ============================
		// 	Popup window for the photo app.
		// =======================
		function newPopup(url) {
			popupWindow = window.open(
				url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
		}	

</script>