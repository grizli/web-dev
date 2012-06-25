<!DOCTYPE HTML>
<html>

<head>
  <title>Social network</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">PUS<span class="logo_colour">lab2</span></a></h1>
          <h2>Social network</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li class="selected"><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
        </ul>
      </nav>
    </header>
    <div id="site_content">
      <div class="gallery">
        <ul class="images">
          <li class="show"><img width="950" height="300" src="images/1.jpg" alt="photo_one" /></li>
          <li><img width="950" height="300" src="images/2.jpg" alt="photo_two" /></li>
          <li><img width="950" height="300" src="images/3.jpg" alt="photo_three" /></li>
        </ul>
      </div>
      <div class="content">
        <h1>Register page</h1>
	<div>
		<form name="login" action="useradd.php" method="POST">
			<p>
				Please enter new username, and new password (with confirmation)
				<?php
					$info = $_GET['reason'];
					if($info == 'psswd'){
						echo "<h4 color='red'>Password not identical!</h4>";
					} else if ($info == 'username') {
						echo "<h4 color='orange'>Username exist!</h4>";
						
					} else if ($info == 'sth') {
						echo "<h4> Database error! </h4>";
					}
					
				?>
			</p>
			<table>
				<tr><td>Name: </td><td><input type="text" name="name"/>
				<tr><td>Surname: </td><td><input type="text" name="surname"/>
				<tr><td>Username: </td><td><input type="text" name="username"/>
				<tr><td>Password: </td><td><input type="password" name="psswd"/>
				<tr><td>Password (confirm): </td><td><input type="password" name="psswd2"/>
				<tr><td/><td><input type="submit" name="register" value="Register"/>
			</table>
		</form>
	</div>
      </div>
    </div>
    <footer>
      <p>Copyright &copy; CSS3_photo_two | <a href="http://www.css3templates.co.uk">design from css3templates.co.uk</a></p>
    </footer>
  </div>
  <p>&nbsp;</p>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/image_fade.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
  </script>
</body>
</html>
