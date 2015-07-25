<?php
	$teacherID=$_POST['userID'];
	require('../mysqli_connect.php');
	function loadProfileReviews(){
		global $teacherID, $dbc;
		$q = "SELECT * FROM reviews WHERE teacherID = '".$teacherID."'";
		$r = @mysqli_query($dbc, $q);
		$to_write = "";
		echo 	'<div id = "profileReviews">
					<span><h2>Profile Reviews</h2></span>';
		while ($row = mysqli_fetch_assoc($r)){
			$to_write .= '
				<div class = "profileDiv">
					<span>';
						for($i = 0; $i < $row['stars']; $i++){
							$to_write .= '<span>★</span>';
						}
						for($i = $row['stars']; $i < 5; $i++){
							$to_write .= '<span>☆</span>';
						}
					$to_write .= '</span>
					<span>Reviewed by</span>
					<span>';
						$q2 = "SELECT name FROM students WHERE studentID = '".$row['studentID']."'";
						$r2 = @mysqli_query($dbc, $q2);
						$student= mysqli_fetch_assoc($r2);
						$to_write.= $student['name'].'
					</span>
					<span><p>'.
						$row['review'].
					'</span></p>
				</div>';
		}
		echo $to_write;
		echo '</div>';
	} 
	function loadClassesOffered(){
		global $teacherID, $dbc;
		$q = "SELECT * FROM classes WHERE teacherID = '".$teacherID."'";
		$r = @mysqli_query($dbc, $q);
		echo '
		<div id = "classesOffered">
			<h2 id="classesTitle">Classes Offered</h2>';
		$to_write = "";
		while ($row = mysqli_fetch_assoc($r)){
			$to_write .= '
			<div class = "profile_classes_offered">
				<img class = "profile_classes_img" src="img/'.$row['image'].'"/>
				<div class = "profile_classes_offered_rightdiv">
					<h3>'.$row['name'].'</h3>
					<span>'.$row['studentLimit'].' students/class</span>
					<div><span>';
						if($row['isOpen'] == true){
							$to_write .= 'Open!';
						}else{
							$to_write .= 'Click for Availability';
						}
					$to_write .= '</span></div>
					<div>Price '.$row['price'].' kuai/hr</div>
				</div>
			</div>';
		}
		echo $to_write;
		echo '</div>';
	}
	switch ($_POST['tab'])
	{
		case "radio1":
			echo '
				<div id = "websiteAwards">
					<h2>Website Awards/Recommendations</h2>
				</div>';
			loadProfileReviews();
			loadClassesOffered();

			break;
		default:
			echo "hello world";
			break;
	}
?>