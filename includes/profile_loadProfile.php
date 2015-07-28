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
		case "radio2":
			 <div id = "AboutMeTopBar">
				<div id = "AboutMeTopBarLeft"></div>
					<img id = "aboutMeTopBarPic" src=""/>
					<span>★★★★★</span>
					<span>500 Following</span>
				</div>
				<div id = "topBarRight">
					<img id = "statsPlaceHolder" src = ""/>
				</div>
				<div id = "topBarMid">
					<span>BEN BROSTOFF</span>
					<div>
						<span>Verified</span>
						<span>Preferred</span>
					</div>
					<div>
						<button id="followButton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">WeChat</span></button>
						<button id="followButton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Email</span></button>
						<button id="followButton" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Follow</span></button>
					</div>
				</div>
			</div>
			<table id = "backgroundTable">
				<tr>
					<td></td>
					<td>
						<span>Education and Training</span>
					</td>
				</tr>
				<tr>
					<td>
						<img id = "collegePlaceHolder" src = ""/>
						<span>Pomona College - 4</span>
					</td>
					<td>
						<table>
							<tr>
								<td>College Degree</td>
								<td>B.S. Pomona College</td>
							</tr>
							<tr>
								<td>Major</td>
								<td>Mathematical Economics</td>
							</tr>
							<tr>
								<td>2 week bullshit course</td>
								<td>Sanli</td>
							</tr>
						</table>
					<td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span>Specialty</span>
					</td>
				</tr>
				<tr>
					<td>
						<td>
							<img id = "classPlaceHolder" src = ""/>
							<span>US History</span>
							<span>★★★★★</span>
						</td>
						<td>
							<table>
								<tr>
									<td>College Degree</td>
									<td>B.S. Pomona College</td>
								</tr>
								<tr>
									<td>Major</td>
									<td>Mathematical Economics</td>
								</tr>
								<tr>
									<td>2 week bullshit course</td>
									<td>Sanli</td>
								</tr>
							</table>
						<td>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span>Biography</span>
					</td>
				</tr>
				<tr>
					<td>
						<td>
							<img id = "bioPic" src = ""/>
						</td>
						<td>
							"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
						<td>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span>College Applications</span>
					</td>
				</tr>
				<tr>
					<td>
						<td>
							<img id = "collegeAppPicPlaceHolder" src = ""/>
						</td>
						<td>
							<table>
								<tr>
									<td>Shanghai Sanli Education Co.</td>
									<td>2014-Present</td>
								</tr>
							</table>
						<td>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span>Work Experience</span>
					</td>
				</tr>
				<tr>
					<td>
						<td>
							<img id = "sanliPicPlaceHolder" src = ""/>
							<span>Sanli Inc.</span>
						</td>
						<td>
							<table>
								<tr>
									<td>Shanghai Sanli Education Co.</td>
									<td>2014-Present</td>
								</tr>
							</table>
						<td>
					</td>
				</tr>
			</table>
			
			
			
		default:
			echo "hello world";
			break;
	}
?>