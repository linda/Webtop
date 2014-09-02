<script>
	// ============================
	//	File that contains javascript/jQuery functions;
	//	To be included in the main page.
	//	Javascript for the photoapp is not included.
	// =======================

	// ============================
	//	Global variables.
	// =======================
	var infoDialog;
	var photoDialog;
	var boxbot;
	var vase1;
	var vase2;
	var vase3;

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
			infoDialog = <?php echo json_encode($_SESSION['infoDialog']); ?>;
			photoDialog = <?php echo json_encode($_SESSION['photoDialog']); ?>;
			boxbot = <?php echo json_encode($_SESSION['boxbot']); ?>;
			vase1 = <?php echo json_encode($_SESSION['vase1']); ?>;
			vase2 = <?php echo json_encode($_SESSION['vase2']); ?>;
			vase3 = <?php echo json_encode($_SESSION['vase3']); ?>;
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
						data:{ 
								infoDialog:{
									open: 0,
									left: 0,
									top: 0
								} 
							},
						dataType: "text"
						})
				},
				dragStop: function( event, ui ) {
					$.ajax({
						type: "POST",
						url: "savestate.php",
						data: { infoDialog: {open: 1, left: ui.position.left, top: ui.position.top}},
						dataType: "text"
						})
				}
			});
			// ============================
			//	Functions called on double-click on one of the icons.
			//  1) The dialog window is opened
			//  2) Ajax request is sent to save the new state in savestate.php
			//		where is will be saved in sessions/the database
			//	TODO: if possible use "this" or similar function instead of
			// ============================
			$( "#vase1" ).dblclick(function() {
				$( "#infoDialog" ).dialog( "open" );
				$.ajax({
					type: "POST",
					url: "savestate.php",
					data: {
							infoDialog: {
								open: 1,
							//	TODO: if possible use "this" or similar function instead of
							//	using the element's ID?
								left: $( "#infoDialog" ).parent().position().left, 
								top: $( "#infoDialog" ).parent().position().top
							}
						},
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
						data: { photoDialog: {open: 0, left: 0, top: 0} },
						dataType: "text"
						})
				},
				dragStop: function( event, ui ) {
					$.ajax({
						type: "POST",
						url: "savestate.php",
						data: {
							photoDialog: {
								open: 1,
								left: ui.position.left, 
								top: ui.position.top
								}
							},
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
					data:{
							photoDialog: {
								open: 1,
								left: $( "#photoDialog" ).parent().position().left, 
								top: $( "#photoDialog" ).parent().position().top
							}
						},
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
		if (infoDialog.open === '1'){
			$( "#infoDialog" ).dialog( "open" );
		}
		if (photoDialog.open === '1'){
			$( "#photoDialog" ).dialog( "open" );
		}
		$( "#infoDialog" ).parent().css({"left": infoDialog.left + "px", "top": infoDialog.top + "px"});
		$( "#photoDialog" ).parent().css({"left": photoDialog.left + "px", "top": photoDialog.top + "px"});
		$( "#boxbot" ).css({"left": boxbot.left + "px", "top": boxbot.top + "px"});
		$( "#vase1" ).css({"left": vase1.left + "px", "top": vase1.top + "px"});
		$( "#vase2" ).css({"left": vase2.left + "px", "top": vase2.top + "px"});
		$( "#vase3" ).css({"left": vase3.left + "px", "top": vase3.top + "px"});
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