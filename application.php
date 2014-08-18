<script>
	// ============================
	//	Global variables.
	// =======================
	var dialogOpen;
	var dialogPosition;
	var boxbotPosition;
	var vase1Position;
	var vase2Position;
	var vase3Position;
	
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
			dialogOpen = <?php echo json_encode($_SESSION['dialogOpen']); ?>;
			dialogPosition = <?php echo json_encode($_SESSION['dialogPosition']); ?>;
			boxbotPosition = <?php echo json_encode($_SESSION['boxbot']); ?>;
			vase1Position = <?php echo json_encode($_SESSION['vase1']); ?>;
			vase2Position = <?php echo json_encode($_SESSION['vase2']); ?>;
			vase3Position = <?php echo json_encode($_SESSION['vase3']); ?>;
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
						data: { dialogOpen: false },
						dataType: "text"
						})
				},
				dragStop: function( event, ui ) {
					$.ajax({
						type: "POST",
						url: "savestate.php",
						data: { dialogPosition: {left: ui.position.left, top: ui.position.top}},
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

			$( ".opener" ).dblclick(function() {
				$( "#dialog" ).dialog( "open" );
				$.ajax({
					type: "POST",
					url: "savestate.php",
					data: { dialogOpen: true},
					dataType: "text"
					})
			});
	});

	// ============================
	//	Functions for restoring state of windows, icons position from sessions variables
	//	upon reload of the page.
	//	Set to $( window ).load so it is executed after the other functions 
	//	TODO: test more
	// ============================
	$( window ).load(function() {
		if (dialogOpen === "true"){
			$( "#dialog" ).dialog( "open" );
		}
		$( "#dialog" ).parent().css({"left": dialogPosition.left + "px", "top": dialogPosition.top + "px"});
		$( "#boxbot" ).css({"left": boxbotPosition.left + "px", "top": boxbotPosition.top + "px"});
		$( "#vase1" ).css({"left": vase1Position.left + "px", "top": vase1Position.top + "px"});
		$( "#vase2" ).css({"left": vase2Position.left + "px", "top": vase2Position.top + "px"});
		$( "#vase3" ).css({"left": vase3Position.left + "px", "top": vase3Position.top + "px"});
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