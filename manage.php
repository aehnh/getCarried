<?php
	include('config.php');
	include('session.php');

	$myemail = $_SESSION['login_email'];
	$mytype = $_SESSION['login_type'];
	if($mytype == "1") {
		$sql = "select * from mydb.tutor where email = '$myemail'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$name = $row['name'];
		$tid = $row['TutorID'];
	} else if($mytype == "2") {
		header("Location: browse.php");
	}

	if($count != 1) {
		header("Location: browse.php");
	}
?>
<html>
<head>
	<title>getCarried</title>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/nav.css">
	<link rel="stylesheet" type="text/css" href="style/modal.css">
	<link rel="stylesheet" type="text/css" href="style/convention.css">
	<link rel="stylesheet" type="text/css" href="style/table.css">
</head>
<body>
	<ul class="nav">
		<li class="logo"><a class="innerlogo" href="browse.php">getCarried</a></li>
		<li><a href="logout.php" class="hov" onclick="" style="cursor: pointer; display: block;" id="navlogout">LOGOUT</a></li>
		<li><a class="hov" onclick="document.getElementById('id01').style.display='block';" style="cursor: pointer; display: none;" id="blogin">LOGIN</a></li>
		<li><a href="manage.php" class="hov active" id="navmanage">MANAGE</a></li>
		<li><a href="browse.php" class="hov" id="navbrowse">BROWSE</a></li>
	</ul>

	<div style="margin-top: 70px; overflow: auto; height: calc(100vh - 70px);">
		<div style="margin-top: 30px; line-height: 0px; width: 50%; margin-left: auto; margin-right: auto;">
		<?php 
			$sql = "select count(*) from mydb.post where TutorID = '$tid'";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_array($result);
			echo "<p>";
			echo "Number of posts: ".$row[0];
			echo "</p>";


			$sql = "select * from mydb.post where TutorID = $tid";
			$result = mysqli_query($db,$sql);
			echo "<table id='posts'><tr><th>PID</th><th>Course</th><th>Description</th></tr>";
			while ($data = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo " <td>".$data['PID']."</td>";
				echo " <td>".$data['Subject']."</td>";
				echo "<td>".$data['Description']." </td>";
				echo "</tr>";
			}
			echo "</table>";

			$sql = "select * from mydb.application where PostID in (select PID from mydb.post where post.TutorID = '$tid')";
			$result = mysqli_query($db,$sql);
			echo mysqli_error($db);
			echo "<table id='posts' style='margin-top: 50px;'><tr><th>AppID</th><th>PostID</th><th>TuteeID</th><th>Message</th></tr>";
			while ($data = mysqli_fetch_array($result)){
			echo "<tr>";
			echo " <td>".$data['AppID']."</td>";
			echo "<td>".$data['PostID']." </td>";
			echo " <td>".$data['TuteeID']."</td>";
			echo " <td>".$data['Message']."</td>";
			#echo " <td><form method='post' action = ''><input type='submit' value='accept' name></td>";
			echo "</tr>";
			}
			echo "</table>";

			echo "<div class='modal2' style='margin-bottom: 50px;'>
				<div class='modal2-content'>";
			echo "<ul class='modal2-tab'>
				<li class='active' onclick='changeTab(this, 0);' id='tadd'><p>Add</p></li>
				<li onclick='changeTab(this, 1);' id='tedit'><p>Edit</p></li>
				<li onclick='changeTab(this, 2);' id='tdelete'><p>Delete</p></li>
			</ul>";
			echo "<div class='container' id='cadd' style='background-color: #333; display: block;'>";
			echo "<form method='POST' action='addpost.php'> <select name='course'>";
			$sql = "select * from mydb.course";
			echo"<option value='$postid'>Select Course</option>";
			$result = mysqli_query($db,$sql);
			while ($data = mysqli_fetch_array($result)) {
				$cname = $data['name'];
				echo " <option value='$cname'>".$cname."</option>";
			}
			echo "</select>
			<textarea name='description' style='width: 100%;
					padding: 12px 20px;
					margin: 8px 0;
					display: inline-block;
					border: 1px solid #ccc;
					box-sizing: border-box;
					font-size: 16px;
					font-family: Lato;
					resize: none;
					height: 150px;' placeholder='Write a description'></textarea>
			<button type = 'submit' value = 'add post'>ADD POST</button>
			</form>";
			echo "</div>";

			echo "<div class='container' id='cedit' style='background-color: #333; display: none;'>";
			echo "<form method='POST' action='editpost.php'> <select name='postid'>";
			$sql = "select * from mydb.post where TutorID = $tid";
			echo "<option value='$postid'>Select PID</option>";
			$result = mysqli_query($db,$sql);
			while ($data = mysqli_fetch_array($result)){
			$cname = $data['PID'];
			echo " <option value='$cname'>".$cname."</option>";
			}
			echo "</select>
			<textarea name='description' style='width: 100%;
					padding: 12px 20px;
					margin: 8px 0;
					display: inline-block;
					border: 1px solid #ccc;
					box-sizing: border-box;
					font-size: 16px;
					font-family: Lato;
					resize: none;
					height: 150px;' placeholder='Write a description'></textarea>
			<button type = 'submit' value = 'edit post'>EDIT POST</button>
			</form>";
			echo "</div>";

			echo "<div class='container' id='cdelete' style='background-color: #333; display: none;'>";
			echo "<form method='POST' action='deletepost.php'> <select name='postid'>";
			$sql = "select * from mydb.post where TutorID = $tid";
			echo"<option value='$postid'>Select PID</option>";
			$result = mysqli_query($db,$sql);
			while ($data = mysqli_fetch_array($result)){
			$cname = $data['PID'];
			echo " <option value='$cname'>".$cname."</option>";
			}
			echo "</select>
			<button type = 'submit' value = 'delete post'>DELETE POST</button>
			</form>";
			echo "</div>";
			echo "</div></div>";

		?>
		</div>
	</div>

	<script type="text/javascript">
		function changeTab(self, index) {
			if(!self.classList.contains("active")) {
				self.classList.add("active");
				if(index == 0) {
					document.getElementById("tedit").classList.remove("active");
					document.getElementById("tdelete").classList.remove("active");
					document.getElementById("cadd").style.display = "block";
					document.getElementById("cedit").style.display = "none";
					document.getElementById("cdelete").style.display = "none";
				} else if(index == 1) {
					document.getElementById("tadd").classList.remove("active");
					document.getElementById("tdelete").classList.remove("active");
					document.getElementById("cedit").style.display = "block";
					document.getElementById("cadd").style.display = "none";
					document.getElementById("cdelete").style.display = "none";
				} else {
					document.getElementById("tadd").classList.remove("active");
					document.getElementById("tedit").classList.remove("active");
					document.getElementById("cdelete").style.display = "block";
					document.getElementById("cadd").style.display = "none";
					document.getElementById("cedit").style.display = "none";
				}
			}
		}
	</script>
</body>
</html>