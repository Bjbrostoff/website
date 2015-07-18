<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
</head>
<body>
	<main  id="webPage">
		<section id="loginBlock">
			<div class="bss-slides num1" tabindex="1" autofocus="autofocus">
				<figure>
				  <img src="img/medium.jpg"/><figcaption>"Medium" by <a href="https://www.flickr.com/photos/thomashawk/14586158819/">Thomas Hawk</a>.</figcaption> 
				</figure>
				<figure>
				  <img src="img/colorado.jpg"/><figcaption>"Colorado" by <a href="https://www.flickr.com/photos/stuckincustoms/88370744">Trey Ratcliff</a>.</figcaption> 
				</figure>
				<figure>
				  <img src="img/monte-vista.jpg" /><figcaption>"Early Morning at the Monte Vista Wildlife Refuge, Colorado" by <a href="https://www.flickr.com/photos/davesoldano/8572429635">Dave Soldano</a>.</figcaption> 
				</figure>
				<figure>
				  <img src="img/sunrise.jpg" /><figcaption>"Sunrise in Eastern Colorado" by <a href="https://www.flickr.com/photos/35528040@N04/6673031153">Pam Morris</a>.</figcaption> 
				</figure>
				<figure>
				  <img src="img/colorado-colors.jpg"/><figcaption>"colorado colors" by <a href="https://www.flickr.com/photos/cptspock/2857543585">Jasen Miller</a>.</figcaption> 
				</figure>
			</div>  
			<div id = "login">
				<div id = "studentLogin">
					<h2>Student Login</h2>
					<input id="studentUsername" type="text" placeholder="Username"></input>
					<input id="studentPassword" type="password" placeholder="Password"></input>
				</div>
				<div id = "teacherLogin">
					<h2>Teacher Login</h2>
					<input id="teacherUsername" type="text" placeholder="Username"></input>
					<input id="teacherPassword" type="password" placeholder="Password"></input>
				</div>
			</div>
		</section>
		<section id = "middleBlock">
			<div id = "classesBlock">
				<div id = "classesBanner">
					<a href="" id = "classesTitle"><h2>Promoted Classes</h2></a>
					<a href = "" id = "seeAllClassesBtn"><h2>See All</h2></a>
				</div>
				<table id = "promotedClasses">
					<colgroup>
						<col width="33%">
						<col width="33%">
						<col width="33%">
					</colgroup>
				<tbody>
					<tr id = "promotedClassesRow">
					<?php
						require ('../mysqli_connect.php');
						$q = "SELECT * FROM `classes` ORDER BY rating LIMIT 3";
						$r = @mysqli_query($dbc, $q);
						while ($row = mysqli_fetch_assoc($r)){
							echo '	
								<td>
									<img src="img/' . $row['image'] . '"/>
									<div>
										<a href=""><span id = "className">' . $row['name'] . '</span></a>
										<a href=""><span id = "classTeacher">' . $row['teacher']  . '</span></a>
									</div>
									<div>' . $row['tags'] . '</div>
									<div><span>';
										for($i = 0; $i < $row['rating']; $i++){
											echo '<span>★</span>';
										}
										for($i = $row['rating']; $i < 5; $i++){
											echo '<span>☆</span>';
										}
									echo '</span></div>
								</td>';
						}
					?>
					</tr>
				</tbody>
				</table>
			</div>
			<div id = "topStudents">
				<h2>Top Students</h2>
				<table id = "topStudentsTable">
					<tbody id = "topStudentsTableBody">
					<?php
						$q = "SELECT * FROM `students` ORDER BY rating LIMIT 3";
						$r = @mysqli_query($dbc, $q);
						while ($row = mysqli_fetch_assoc($r)){
							echo '
							<tr><td>
								<img src="'.$row['image'] .'"/>
								<a href=""><span>'. $row['name'] .'</span></a>
								<div><span>';
									for($i = 0; $i < $row['rating']; $i++){
										echo '<span>★</span>';
									}
									for($i = $row['rating']; $i < 5; $i++){
										echo '<span>☆</span>';
									}
								echo '</span></div>
							</td></tr>';
						}
					?>
					</tbody>
				</table>
			</div>
		</section>
	</main>
</body>
<!-- Templates -->
<script>
var opts = {
    auto : {
        speed : 3500, 
        pauseOnHover : true
    },
    fullScreen : false, 
    swipe : true
};
makeBSS('.num1', opts);

			
if (window.indexedDB) { 
	$.getScript( "scripts/site-indexeddb.js" )
	.done(function( script, textStatus ) {
		initScreen();
	})
	.fail(function( jqxhr, settings, exception ) {
		console.log( 'Failed to load indexed db script' );
	});
}
function initScreen() {
	$(document).ready(function() {	

	});
}
</script>

</html>