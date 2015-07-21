<!DOCTYPE html>
<html lang="en">
<head>
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
			<form id = "profileTab" style="margin-top: 1em;">
				<div id="profileRadioSet">
					<input type="radio" id="radio1" name="radio"><label for="radio1">Personal Information</label>
					<input type="radio" id="radio2" name="radio"><label for="radio2">Education Background</label>
					<input type="radio" id="radio3" name="radio"><label for="radio3">Classes Offered</label>
					<input type="radio" id="radio4" name="radio"><label for="radio4">Reviews</label>
					<input type="radio" id="radio5" name="radio"><label for="radio5">Questions</label>
					<input type="radio" id="radio6" name="radio"><label for="radio6">Make an Appointment</label>
				</div>
			</form>
		</div>
	</section>
	<section id ="mainBlock">
		<div id = "leftAwardsBar"></div>
		<div id = "midClassesOfferedBar"></div>
		<div id = "rightReviewsBar"></div>
	</section>
	<section id = "activitiesBlock">
	</section>			
</body>
<?php include ('footer.html');?>
<script>
	$('#nameContainer > button').button();
	$('#profileRadioSet').buttonset();
</script>
</html>