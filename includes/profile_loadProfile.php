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
	function loadReviewsTab(){
		global $teacherID, $dbc;
		$q = "SELECT * FROM reviews WHERE teacherID = '".$teacherID."'";
		$r = @mysqli_query($dbc, $q);
		$q2 = "SELECT * FROM teachers WHERE teacherID = '".$teacherID."'";
		$r2 = @mysqli_query($dbc, $q2);
		$teacher = mysqli_fetch_assoc($r2);
		echo'<div id = ReviewsTitle>
				<h2>'.mysqli_num_rows($r).' Reviews for '.$teacher['teacherName'].'</h2></div>';
		$to_write ="";
		while($row = mysqli_fetch_assoc($r)){
			$q3 = "SELECT * FROM students WHERE studentID = '".$row['studentID']."'";
			$r3 = @mysqli_query($dbc, $q3);
			$student = mysqli_fetch_assoc($r3);
			$q4 = "SELECT * FROM classes WHERE classId = '".$row['classID']."'";
			$r4 = @mysqli_query($dbc, $q4);
			$class = mysqli_fetch_assoc($r4);
			$to_write.='
					<div class = "review">
						<div class = "reviewsTopLeft">
							<img class = "reviewsPic" src = "img/'.$student['image'].'"/>
							<h2>'.$student['name'].'</h2>
							<span>';
							for($i = 0; $i < $row['stars']; $i++){
								$to_write .= '<span>★</span>';
							}
							for($i = $row['stars']; $i < 5; $i++){
								$to_write .= '<span>☆</span>';
							}
							$to_write.='</span>
							<div class = "qualities">
								<span class = "quality_line">Difficulty';
								for($i = 0; $i < $row['difficulty']; $i++){
									$to_write .= '<span>-</span>';
								}
								$to_write.=' '.$row['difficulty'].'/5</span>
								<span class = "quality_line">Preparedness';
								for($i = 0; $i < $row['preparedness']; $i++){
									$to_write .= '<span>-</span>';
								}
								$to_write.=' '.$row['preparedness'].'/5</span>
								<span class = "quality_line">Workload';
								for($i = 0; $i < $row['workload']; $i++){
									$to_write .= '<span>-</span>';
								}
								$to_write.=' '.$row['workload'].'/5</span>
								<span class = "quality_line">Fun';
								for($i = 0; $i < $row['fun']; $i++){
									$to_write .= '<span>-</span>';
								}
								$to_write.=' '.$row['fun'].'/5</span>
								<span class = "quality_line">Effectiveness';
								for($i = 0; $i < $row['effectiveness']; $i++){
									$to_write .= '<span>-</span>';
								}
								$to_write.=' '.$row['effectiveness'].'/5</span>
							</div>
						</div>
						<div class = "reviewsTopRight">
							<div class = "reviewsTopRight_1">
								<span>Post Date: '.$row['post_date'].'</span>
								<span>Class: '.$class['name'].'
							</div>
							<div class = "reviewsTopRight_2">
								<span>';
								if($row['recommend']==1)
								{
									$to_write.='I would recommend Ben and his classes to others!';
								}
								$to_write.='
								</span>
							</div>
						</div>
						<p>
							'.$row['review'].'
						</p>
						<h3>Read More</h3>
					</div>';				
		}
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
		case "radio3":
			echo "hello world";
			loadReviewsTab();

			break;
		default:
			break;
	}
?>