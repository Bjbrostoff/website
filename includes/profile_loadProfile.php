<?php
	echo $_POST['userID'];
	$teacherID=$_POST['userID'];
	echo $_POST['tab'];
	require('../mysqli_connect.php');
	switch ($_POST['tab'])
	{
		case "radio1":
			$q = "SELECT * FROM classes WHERE teacherID = '".$teacherID."'";
			$r = @mysqli_query($dbc, $q);
			echo $q;
			echo '<div id = "websiteAwards">';
			echo '<h2>Website Awards/Recommendations</h2>';
			echo '<div id = "classesOffered>"';
			echo '<h2>Classes Offered</h2>';
			$to_write = "";
			while ($row = mysqli_fetch_assoc($r)){
				$to_write .= '
				<div class = "profile_classes_offered">
					<img class = "profile_classes_img" src="img/'.$row['image'].'"/>
					<div class = "profile_classes_offered_rightdiv">
						<h2>'.$row['name'].'</h2>
						<span>'.$row['studentLimit'].' students/class</span>
						<div><span>';
							if($row['isOpen'] == true){
								$to_write .= 'Open!';
							}else{
								$to_write .= 'Click for Availability';
							}
						$to_write .= '</span></div>
						<div><h1>Price '.$row['price'].' kuai/hr</h1></div>';
			}
			echo $to_write;
			echo '<div id = "profileReviews">';
			break;
		default:
			echo "hello world";
			break;
	}
?>