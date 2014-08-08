<script>

	// ============================
	//	Global variable that saves the state of the dialog window (open or closed,
	// or true or false)
	// =======================
	var dialogStateArray;

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
					alert (dialogStateArray);
					$.ajax({
						type: "POST",
						url: "savestate.php",
						data: { dialog: "closed" },
						dataType: "text"
						})
						.done(function( data ) {
							// Pop-Up window for displaying the current state of the variable
							alert( "Dialog state: " + dialogStateArray);
						});
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
					.done(function( data ) {
						alert ("Opened it! ");
					});
			});
	});

	// ============================
	//	Functions that opens the dialog window with php.info
	//	if the corresponding session variable is set to "open"
	//  (so that the window state remains the same on reload)
	// ============================
	$(function() {
		dialogStateArray = <?php echo json_encode($_SESSION['dialog']); ?>;
		if (dialogStateArray === "open"){
			$( "#dialog" ).dialog( "open" );
		}
	});
	
		
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
	// 	Functions for the startmenu
	// =======================
	$(function() {
		$( "#menu" ).menu();
	});
	function closeopenstartmenu(){
		if($( "#menudiv" ).css( "display" )=='none')
		{
			$( '#menudiv' ).show();
		}
		else $( '#menudiv' ).hide();
	}
		
		// NOTE: hide/show: can be done automatically with "toggle" - don't need an if/else
	
	</script>