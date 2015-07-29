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
	function loadAboutMe(){
		global $teacherID, $dbc;
		$q = "SELECT * FROM teachers WHERE teacherID = '".$teacherID."'";
		$r = @mysqli_query($dbc, $q);
		$teacher = mysqli_fetch_assoc($r);
		$eatArray = json_decode($teacher['educationAndTraining']);
		$specArray = json_decode($teacher['speciality']);
		$bio = $teacher['bio'];
		$cAppArray = explode(", ", $teacher['collegeApplications']);
		$workExpArray = json_decode($teacher['workExperience']);
		$to_write = "";
		$to_write .='
			<table id = "backgroundTable">
				<tbody>
					<tr>
						<td class = "backgroundTableLeft"></td>
						<td class = "backgroundTableRight">
							<span><h2>Education and Training</h2></span>
						</td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft">
							<img id = "collegePlaceHolder" src = "img/'.$teacher['eATPic'].'"/>
							<span>Pomona College - 4</span>
						</td>
						<td class = "backgroundTableRight">
							<table>';
							foreach ($eatArray as $key => $value){
								$to_write.='
								<tr>
									<td>'.$key.'</td>
									<td>'.$value.'</td>
								</tr>';
							}
							$to_write.='</table>
						</td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft"></td>
						<td class = "backgroundTableRight">
							<span><h2>Speciality</h2></span>
						</td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft">
							<img id = "classPlaceHolder" src = "img/'.$teacher['specPic'].'"/>
							<span>US History</span>
							<span>★★★★★</span>
						</td>
						<td class = "backgroundTableRight">
							<table>';
							for($i = 0; $i < count($specArray); $i++){
								$to_write.='
								<tr>
									<td>'.$specArray["$i"].'</td>
									<td></td>
								</tr>';
							}
							$to_write.='</table>
						<td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft"></td>
						<td class = "backgroundTableRight">
							<span><h2>Biography</h2></span>
						</td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft">
							<img id = "bioPic" src = "img/'.$teacher['specPic'].'"/>
						</td>
						<td class = "backgroundTableRight">
							'.$bio.'
						<td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft"></td>
						<td class = "backgroundTableRight">
							<span><h2>College Applications</h2></span>
						</td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft">
							<img id = "collegeAppPicPlaceHolder" src = "img/'.$teacher['cAppPic'].'"/>
						</td>
						<td class = "backgroundTableRight">
							<table>';
							for($i = 0; $i < count($cAppArray); $i++){
								$to_write.='
								<tr>
									<td>'.$cAppArray["$i"].'</td>
									<td></td>
								</tr>';
							}
							$to_write.='</table>
						<td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft"></td>
						<td class = "backgroundTableRight">
							<span><h2>Work Experience</h2></span>
						</td>
					</tr>
					<tr>
						<td class = "backgroundTableLeft">
							<img id = "sanliPicPlaceHolder" src = "img/'.$teacher['workExPic'].'"/>
							<span>Sanli Inc.</span>
						</td>
						<td class = "backgroundTableRight">
							<table>';
							foreach ($workExpArray as $key => $value){
								$to_write.='
								<tr>
									<td>'.$key.'</td>
									<td>'.$value.'</td>
								</tr>';
							}
							$to_write.='</table>
						<td>
					</tr>
				<tbody>
			</table>';
		echo $to_write;
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
		case "radio2":
			loadAboutMe();
			break;
			
		default:
			break;
	}
?>