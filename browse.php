<?php
	include('config.php');
	include('session.php');

	if(isset($_POST['submit'])) {
		if($_POST['submit'] == 'login') {
			$myemail = mysqli_real_escape_string($db,$_POST['email']);
			$mypassword = mysqli_real_escape_string($db,$_POST['psw']); 

			$sql = "SELECT * FROM mydb.tutor WHERE email='$myemail' and password='$mypassword'";
			$result = mysqli_query($db,$sql);
			$count = mysqli_num_rows($result);

			if($count == 1) {
				$_SESSION['login_email'] = $myemail;
				header("location: browse.php");
			} else {
				$elogin = "Invalid login";
			}
		} else if($_POST['submit'] == 'register') {
			
		}
	}

	$myemail = $_SESSION['login_user'];
	$sql = "select * from mydb.tutor where email = '$myemail'";
	$result = mysqli_query($db,$sql);
	$count = mysqli_num_rows($result);
?>
<html>
<head>
	<title>getCarried</title>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/nav.css">
	<link rel="stylesheet" type="text/css" href="style/modal.css">
	<link rel="stylesheet" type="text/css" href="style/convention.css">
</head>
<body>
	<ul class="nav">
		<li class="logo"><a class="innerlogo" href="browse.php">getCarried</a></li>
		<li><a href="logout.php" class="hov" onclick="" style="cursor: pointer; display: block;" id="navlogout">LOGOUT</a></li>
		<li><a class="hov" onclick="document.getElementById('id01').style.display='block';" style="cursor: pointer; display: none;" id="navlogin">LOGIN</a></li>
		<li><a href="manage.php" class="hov" id="navmanage">MANAGE</a></li>
		<li><a href="browse.php" class="hov active" id="navbrowse">BROWSE</a></li>
	</ul>

	<script type="text/javascript">
		console.log(<?php echo $count; ?>);
		if(<?php echo $count; ?>) {
			console.log("logged in");
			document.getElementById("navlogin").style.display = "none";
			document.getElementById("navlogout").style.display = "block";
			document.getElementById("navbrowse").href = "browse.php";
			document.getElementById("navbrowse").onclick = null;
			document.getElementById("navmanage").href = "manage.php";
			document.getElementById("navmanage").onclick = null;
		} else {
			console.log("logged out");
			document.getElementById("navlogin").style.display = "block";
			document.getElementById("navlogout").style.display = "none";
			document.getElementById("navbrowse").href = "browse.php";
			document.getElementById("navbrowse").onclick = null;
			document.getElementById("navmanage").href = "#";
			document.getElementById("navmanage").onclick = function() {document.getElementById('id01').style.display='block'};
		}
	</script>

	<div style="margin-top: 70px; overflow: auto; height: calc(100vh - 70px); line-height: 0px;">
		<p>fc</p>
	</div>

	<div id="id01" class="modal">
		<div class="modal-content">
			<ul class="modal-tab">
				<li class="active" onclick="changeTab(this, 0);" id="tlogin"><p>Login</p></li>
				<li onclick="changeTab(this, 1);" id="tregister"><p>Register</p></li>
			</ul>
			<div class="container" id="clogin" style="display: block;">
				<form action="" method="post">
					<input type="email" placeholder="Email" name="email" required>
					<input type="password" placeholder="Password" name="psw" required>
					<div style="font-size: 16px; margin: 8px 0;"><label><input type="checkbox" style=""> Remember me</label></div>
					<button type="submit" value="login">LOGIN</button>
					<div style="font-size: 16px; margin: 8px 0; color: red;" id="elogin"><?php echo $elogin; ?></div>
				</form>
				<?php 
					
				?>
			</div>
			<div class="container" id="cregister" style="display: none;">
				<form action="browse.php" method="post">
					<input type="text" placeholder="Name" name="uname" required>
					<input type="email" placeholder="Email" name="email" required>
					<input type="password" placeholder="Password" name="psw" required>
					<input type="password" placeholder="Confirm Password" name="cpsw" required>
					<select name="type">
						<option value="0">I am a:</option>
						<option value="1">Tutor</option>
						<option value="2">Tutee</option>
					</select>
					<button type="submit" value="register">REGISTER</button>
					<div style="font-size: 16px; margin: 8px 0; color: red;" id="eregister"><?php echo $eregister; ?></div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var modal = document.getElementById('id01');
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		function changeTab(self, index) {
			if(!self.classList.contains("active")) {
				self.classList.add("active");
				if(index == 0) {
					document.getElementById("tregister").classList.remove("active");
					document.getElementById("clogin").style.display = "block";
					document.getElementById("cregister").style.display = "none";
				} else {
					document.getElementById("tlogin").classList.remove("active");
					document.getElementById("clogin").style.display = "none";
					document.getElementById("cregister").style.display = "block";
				}
			}
		}
		function login() {
			var form = document.forms[0];
			var email = form.elements["email"].value;
			var password = form.elements["psw"].value;
			if(1) {

				location.href = "browse.php";
			} else {
				var errorMessage = "wtf?";
				document.getElementById("elogin").innerHTML = errorMessage;
			}
		}
		function register() {
			var form = document.forms[1];
			var username = form.elements["uname"].value;
			var email = form.elements["email"].value;
			var password = form.elements["psw"].value;
			var password2 = form.elements["cpsw"].value;
			var type = form.elements["type"].value;
			console.log(type);
			if(password != password2) {
				document.getElementById("eregister").innerHTML = "The passwords do not match.";
			} else if(type == 0) {
				document.getElementById("eregister").innerHTML = "Select account type.";
			} else {
				if(1) {
					location.href = "browse.php";
				} else {
					var errorMessage = "wtf?";
					document.getElementById("eregister").innerHTML = errorMessage;
				}
			}
		}
	</script>
</body>
</html>