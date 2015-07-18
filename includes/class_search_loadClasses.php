<?php
	require('../mysqli_connect.php');
	$q = "SELECT * FROM classes ORDER BY rating LIMIT 3";
	if(isset($_POST['searchWithinInput']))
	{
		$q = "SELECT * FROM classes WHERE teacher LIKE '".$_POST['searchWithinInput']."%' ". "ORDER BY rating LIMIT 3";
	}
	$r = @mysqli_query($dbc, $q);$to_write = "";
		while ($row = mysqli_fetch_assoc($r)){
			$to_write .= '
			<div id = "searchResultsDiv">
				<div id = "searchResultLeft">
					<span>'.$row['distance'].'km away</span>
					<img src="img/'.$row['image'].'" />
					<h3>'.$row['teacher'].'</h3>
				</div>
				<div id = "searchResultMid">
					<h2>'.$row['name'].'</h2>
					<ul>
						<li>Length (weeks):'. $row['length'].'</li>
						<li>Number of classes: '.$row['numClasses'].'</li>
						<li><span>';
							for($i = 0; $i < $row['rating']; $i++){
								$to_write .= '<span>★</span>';
							}
							for($i = $row['rating']; $i < 5; $i++){
								$to_write .= '<span>☆</span>';
							}
						$to_write .= '.</span></li>
					</ul>
				</div>
				<div id = "searchResultRight">
					<div><span>';
						if($row['isOpen'] == true){
							$to_write .= 'Open!';
						}else{
							$to_write .= 'Click for Availability';
						}
					$to_write .= '</span></div>
					<div><h1>'.$row['price'].' kuai/hr</h1></div>
					<div><span>Limit: '.$row['studentLimit'].' students/class</span></div>
				</div>
			</div>';
		}
		mysqli_close($dbc);
		echo $to_write;
?>