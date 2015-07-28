	<?php 
		$page_title = '三人下 - Profile';
		include ('header.html'); 
	?>
	<link rel="stylesheet" type="text/css" href="styles/jquery-ui.min.css"
		media="screen" />
	<link rel="stylesheet" type="text/css" href="styles/profile.css"
		media="screen" />
	<script src="scripts/jquery-ui.min.js"></script>
	<script src="scripts/jquery.validate.js"></script>
	<script src="scripts/jquery-serialization.js"></script>
	<script src="scripts/classes-controller.js"></script>
	<script src="scripts/students-controller.js"></script><!-- Not sure about copyright -->
	<script src="scripts/hammer.min.js"></script>
	<script src="scripts/underscore.js"></script>
</head>
<body  id="webPage">
	<section id = "topSection">
		<div id = "backgroundPicture">
			<div id = "profilePicture"><img src="img/Koala.jpg"></div>
			<div id = "buttonInfoContainer">
				<div id = "nameContainer">
					<span id = "profileName"><h2>Ben Brostoff</h2></span>
					<button id="followButton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Follow</span></button>
					<button id="contactMeButton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Contact Me</span></button>
				</div>
				<div id = "reviewsBar">
					<span>★★★★★</span>
					<span>100 Reviews</span>
					<span>Review Me</span>
				</div>
			</div>
			<form id = "profileTab" style="margin-top: 1em;" action="profile_loadProfile.php" method="post">
				<div id="profileRadioSet">
					<input type="radio" id="radio1" name="radio" checked = "checked"><label for="radio1">Home</label>
					<input type="radio" id="radio2" name="radio"><label for="radio2">About Me</label>
					<input type="radio" id="radio3" name="radio"><label for="radio3">Reviews</label>
					<input type="radio" id="radio4" name="radio"><label for="radio4">Questions</label>
					<input type="radio" id="radio5" name="radio"><label for="radio5">Make an Appointment</label>
				</div>
			</form>
		</div>
	</section>
	<section id ="mainBlock">
	</section>
	<section id = "activitiesBlock">
	</section>			
</body>
<?php include ('footer.html');?>
<script>
	$('#nameContainer > button').button();
	$('#profileRadioSet').buttonset();
	
	function loadProfile(userID, tab){
		$.post("profile_loadProfile.php", {userID: userID, tab: tab}, function( data ){
			$("#mainBlock").html(data);
		});
	}
	$(document).ready(function() {
		<?php echo 'var user_id = 1;';
		
		?>
		//problem right now is that tabs are in a form, rather than buttons... :/
		$("#profileRadioSet input:radio").click(function(){
			console.log("hello world");
			loadProfile(user_id, $(this).attr("id"));
		});
	});
	
</script>
</html>