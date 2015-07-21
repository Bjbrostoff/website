<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	$page_title = '三人下 - Class Search';
	include ('header.html'); 
?>
<link rel="stylesheet" type="text/css" href="styles/jquery-ui.min.css"
	media="screen" />
<link rel="stylesheet" type="text/css" href="styles/class_search.css"
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
	<section id = "searchBlock">
		<div id = "searchUtilities">
			<h2>Narrow Your Search</h2>
				<div>
					<h3>Price</h3>
					<label for="totalamount">Total Price:</label>
					<input type="text" id="totalamount" readonly style="border:0; color:#f6931f; font-weight:bold;">
					<div id = "totalPrice"></div>
					<label for="hourlyamount">Hourly Price:</label>
					<input type="text" id="hourlyamount" readonly style="border:0; color:#f6931f; font-weight:bold;">
					<div id = "hourlyPrice"></div>
				</div>
				<div>
					<h3>Length (hrs)</h3>
					<div id = "lengthhrs"></div>
				</div>
				<div>
					<h3>Distance (km)</h3>
					<div id = "distancekm"></div>
				</div>
				<input id = "nativeSpeaker" type = "checkbox" value = "NS"></input><label>Native Speaker</label>
				<input id = "classroom" type = "checkbox" value = "inClassroom"></input><label>In Classroom</label>
		</div>
		<div id = "searchResults">
			<div id = "searchWithinBar">
				<span id ="searchWithinInputSpan">Search Within:</span>
				<input id="searchWithinInput" title="type A" class="ui-autocomplete-input" autocomplete="on">
				<button id="searchGoButton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Go</span></button>
			</div>
			<dl id = "searchFiltersBar">
				<dd id = "testSearchFilter">
					<span id = "testSearchFilterSpan">Test
						<a href = "javascript:void(0)" style="text-decoration: none;"onclick=""><sup>x</sup></a>
					</span>
				</dd>
			</dl>
			<div id = "sortBar">
				<span>Sort by:</span>
				<select id = "sortByMenu">
					<option selected ="selected">Rating</option>
					<option>Total Price</option>
					<option>Hourly Price</option>
					<option>Distance (km)</option>
				</select>
				<span>Show:</span>
				<select id = "showMenu">
					<option>5</option>
					<option selected ="selected">10</option>
					<option>15</option>
					<option>20</option>
				</select>
			</div>
			<div id = "searchContainer">
			</div>
		</div>
		<div id = "rightBar">
		</div>
	</section>
</body>
<?php include ('footer.html');?>
<script>
    $(function() {
		$( "#totalPrice" ).slider({
		  range: true,
		  min: 0,
		  max: 500,
		  values: [ 75, 300 ],
		  slide: function( event, ui ) {
			$( "#totalamount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		  }
		});
		$( "#totalamount" ).val( "$" + $( "#totalPrice" ).slider( "values", 0 ) +
		  " - $" + $( "#totalPrice" ).slider( "values", 1 ) );
    });
    $(function() {
		$( "#hourlyPrice" ).slider({
		  range: true,
		  min: 0,
		  max: 500,
		  values: [ 75, 300 ],
		  slide: function( event, ui ) {
			$( "#hourlyamount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		  }
		});
		$( "#hourlyamount" ).val( "$" + $( "#hourlyPrice" ).slider( "values", 0 ) +
		  " - $" + $( "#hourlyPrice" ).slider( "values", 1 ) );
	});
	$("#sortByMenu").menu();
	$("#showMenu").menu();
	
	
	if (window.indexedDB) { 
		$.getScript( "scripts/site-indexeddb.js" )
		.done(function( script, textStatus ) {
			initScreen();
		})
		.fail(function( jqxhr, settings, exception ) {
			console.log( 'Failed to load indexed db script' );
		});
	}
	function searchAndLoadClasses(searchValue){
		$.post("class_search_loadClasses.php", {searchWithinInput: searchValue}, function( data ){
			$("#searchContainer").html(data);
		});
	}
	function initScreen() {
		$(document).ready(function() {
			$("#searchGoButton").click(function(){
				searchAndLoadClasses($("#searchWithinInput").val());
			});
			$("#searchWithinInput").keyup(function(event){
				if(event.keyCode == 13){
					$("#searchGoButton").click();
				}
			});			
			<?php 	
				if(isset($_POST['search'])){
					echo 'searchAndLoadClasses("'.$_POST['search'].'");';
				} else{
					echo 'searchAndLoadClasses('.null.');';
				}
			?> 
		});
	}
 </script>
  </html>
