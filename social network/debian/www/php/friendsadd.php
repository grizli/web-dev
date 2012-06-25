<!DOCTYPE HTML>
<html>

<?php

session_start();

require_once 'classes/user.php';
require_once 'classes/photo.php';
require_once 'classes/comments.php';

if(!isset($_SESSION['id'])){
	header("Location: index.php");
}

$user = new user();
$comment = new comment();
$photo = new photo();

$result = $user->getUserInfo($_SESSION['id']);

$name = $result['name'];
$surname = $result['surname'];
$id = $result['ID'];

?>

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
          <h1><a href="home.php">PUS<span class="logo_colour">lab2</span></a></h1>
          <h2>Social network</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li class="selected"><a href="home.php">Home</a></li>
	  <li><a href="#">Photo</a>
              <ul>
                <li><a href="photomy.php">My Photos</a></li>
                <li><a href="photoupload.php">Upload Photo</a></li>
                <li><a href="photofriends.php">Friends Photos</a></li>
                <li><a href="photopublic.php">Public Photos</a></li>
             </ul></li>

          <li><a href="#">Friends</a>
	      <ul>
		<li><a href="friendsview.php">View</a></li>
		<li><a href="friendsadd.php">Add</a></li>
		<li><a href="friendsrequests.php">Requests</a></li>
	     </ul></li>
          <li><a href="comment.php">Comments</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="logout.php">Logout</a></li>
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
      <div id="sidebar_container">
        <div class="sidebar">
          <h3>Friends stats</h3>
          <h4>Number of friends: <?php $result = $user->getFriendsNum($id); echo $result['COUNT( * )']; ?> </h4>
          <h4>Number of requests: <?php $result = $user->getFriendsReqNum($id); echo $result['COUNT( * )']; ?> </h4>
        </div>
      </div>
      <div class="content">
	<table>
		<tr><td>Name</td><td>Surname</td><td>Option</td></tr>
	<?php $results = $user->getPeopleList($id); 
		foreach($results as $resultstmp)
		foreach($resultstmp as $result){
			$line="<tr><td>".$result['name']."</td><td>".$result['surname']."</td><td><a href=_friendadd.php?f=".$id."&s=".$result['ID'].">Add</a></td></tr>";
			echo $line;
		}
	?>
	</table>
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
