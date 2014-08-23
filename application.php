<script>
	// ============================
	//	Global variables.
	// =======================
	var infoDialogOpen;
	var infoDialogPosition;
	var ohotoDialogOpen;
	var photoDialogPosition;
	var boxbotPosition;
	var vase1Position;
	var vase2Position;
	var vase3Position;

	// ============================
	//	Function for generalising the Ajax request upon dragstop
	// ============================

	
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
			infoDialogOpen = <?php echo json_encode($_SESSION['infoDialogOpen']); ?>;
			infoDialogPosition = <?php echo json_encode($_SESSION['infoDialogPosition']); ?>;
			photoDialogOpen = <?php echo json_encode($_SESSION['photoDialogOpen']); ?>;
			photoDialogPosition = <?php echo json_encode($_SESSION['photoDialogPosition']); ?>;
			boxbotPosition = <?php echo json_encode($_SESSION['boxbot']); ?>;
			vase1Position = <?php echo json_encode($_SESSION['vase1']); ?>;
			vase2Position = <?php echo json_encode($_SESSION['vase2']); ?>;
			vase3Position = <?php echo json_encode($_SESSION['vase3']); ?>;
		});
	});
	
	// ============================
	//	Function for everything to do with the dialog containing info.php into (in dialog.php).
	// ============================
	$(function() {
	
		// ============================
		//	Settings for the dialog window with php info
		// =======================
			$( "#infoDialog" ).dialog({
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
						data: { infoDialogOpen: false },
						dataType: "text"
						})
				},
				dragStop: function( event, ui ) {
					$.ajax({
						type: "POST",
						url: "savestate.php",
						data: { infoDialogPosition: {left: ui.position.left, top: ui.position.top}},
						dataType: "text"
						})
				}
			});
			// ============================
			//	Functions when there is a double-click on one of the icons:
			//  1) The dialog window is opened
			//  2) Ajax request is sent to save the new state in savestate.php
			//		where is will be saved in session vars
			// ============================

			$( "#vase1" ).dblclick(function() {
				$( "#infoDialog" ).dialog( "open" );
				$.ajax({
					type: "POST",
					url: "savestate.php",
					data: { infoDialogOpen: true},
					dataType: "text"
					})
			});
	});

	// ============================
	//	Function for everything to do with the dialog containing the photo app.
	// ============================
	$(function() {
			$( "#photoDialog" ).dialog({
				autoOpen: false,
				height: 400,
				width: 670,
				left: 200,
				top: 100,
			// ============================
			//	On closing the dialog, send ajax request to save new state of the window:
			// ============================			
				close: function() {
					$.ajax({
						type: "POST",
						url: "savestate.php",
						data: { photoDialogOpen: false },
						dataType: "text"
						})
				},
				dragStop: function( event, ui ) {
					$.ajax({
						type: "POST",
						url: "savestate.php",
						data: { photoDialogPosition: {left: ui.position.left, top: ui.position.top}},
						dataType: "text"
						})
				}
			});
			// ============================
			//	Functions when there is a double-click on one of the icons:
			//  1) The dialog window is opened
			//  2) Ajax request is sent to save the new state in savestate.php
			//		where is will be saved in session vars
			// ============================

			$( "#vase2" ).dblclick(function() {
				$( "#photoDialog" ).dialog( "open" );
				$.ajax({
					type: "POST",
					url: "savestate.php",
					data: { photoDialogOpen: true},
					dataType: "text"
					})
			});
	});	
	
	
	// ============================
	//	Functions for restoring state of windows, icons position from sessions variables
	//	upon reload of the page.
	//	Set to $( window ).load so it is executed after the other functions
	//	(this means there might be a noticeable delay before everything returns to desired position)
	// ============================
	$( window ).load(function() {
		if (infoDialogOpen === "true"){
			$( "#infoDialog" ).dialog( "open" );
		}
		if (photoDialogOpen === "true"){
			$( "#photoDialog" ).dialog( "open" );
		}
		$( "#infoDialog" ).parent().css({"left": infoDialogPosition.left + "px", "top": infoDialogPosition.top + "px"});
		$( "#photoDialog" ).parent().css({"left": photoDialogPosition.left + "px", "top": photoDialogPosition.top + "px"});
		$( "#boxbot" ).css({"left": boxbotPosition.left + "px", "top": boxbotPosition.top + "px"});
		$( "#vase1" ).css({"left": vase1Position.left + "px", "top": vase1Position.top + "px"});
		$( "#vase2" ).css({"left": vase2Position.left + "px", "top": vase2Position.top + "px"});
		$( "#vase3" ).css({"left": vase3Position.left + "px", "top": vase3Position.top + "px"});
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

	// ============================
	// 	Function for draggable elements (icons); defined by the "draggable"
	//	class.
	//	Individual ajax requests per icon; TODO: generalise to a function
	// =======================	
	$(function() {
		$( ".draggable" ).draggable({
		});

		$( "#boxbot" ).on( "dragstop", function( event, ui ) {
			$.ajax({
				type: "POST",
				url: "savestate.php",
				data: {boxbot: {left: ui.position.left, top: ui.position.top}},
				dataType: "text"
				})
		} );
		$( "#vase1" ).on( "dragstop", function( event, ui ) {
			$.ajax({
				type: "POST",
				url: "savestate.php",
				data: {vase1: {left: ui.position.left, top: ui.position.top}},
				dataType: "text"
				})
		} );
		$( "#vase2" ).on( "dragstop", function( event, ui ) {
			$.ajax({
				type: "POST",
				url: "savestate.php",
				data: {vase2: {left: ui.position.left, top: ui.position.top}},
				dataType: "text"
				})
		} );
		$( "#vase3" ).on( "dragstop", function( event, ui ) {
			$.ajax({
				type: "POST",
				url: "savestate.php",
				data: {vase3: {left: ui.position.left, top: ui.position.top}},
				dataType: "text"
				})
		} );
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
		}
		else $( '#menudiv' ).hide();
	}

</script>