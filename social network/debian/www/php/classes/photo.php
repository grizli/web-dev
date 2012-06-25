<?php
	require_once 'mysql.php';

class photo{
	  var $db;

  	function __construct(){
    		$this->db = new mysql();
  	}

	function getPhotosNum($id){
		$result = $this->db->query("SELECT COUNT( * ) FROM `hasPhoto` WHERE IDuser =".$id);
		return $result[0][0]['COUNT( * )'];
	}
	function getLikesNum($id){
                $result = $this->db->query("SELECT COUNT( * ) FROM `like` WHERE IDuser ='.$id.'");
                return $result[0][0];
        }
	function uploadPhoto($id,$filename,$content,$public,$peoples){
		$data = array(
			'filename' => $filename,
			'IDuser' => $id);
		$result = $this->db->insert('photoName',$data);
		$query="SELECT ID FROM photoName WHERE IDuser={$id} AND filename='{$filename}'";
		$result = $this->db->query($query);
		$idphoto=$result[0]['photoName']['ID'];

		$data = array(
			'IDuser' => $id,
			'IDphoto' => $idphoto);
		$result = $this->db->insert('hasPhoto',$data);

		$myFile = "uploads/".$filename;
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, $content);
		fclose($fh);

		$data = array(
			'ID' => $idphoto,
			'Visibility' => $public);
		$result = $this->db->insert('photoVisability',$data);
		foreach($peoples as $human){
			$data = array(
				'IDphoto' => $idphoto,
				'IDuser' => $human);
			$this->db->insert('tagged',$data);
		}
	}
	function loadMy($id){
		$result = $this->db->query2("SELECT filename,ID from photoName WHERE IDuser=".$id);
		return $result;
	}
	function loadFriendPhoto($id){
		$result = $this->db->query2("SELECT DISTINCT photoName.ID, photoName.filename, user.name, user.surname from photoName JOIN friends ON photoName.IDuser = friends.IDfriend LEFT JOIN user ON user.ID=friends.IDfriend WHERE friends.IDmy=".$id);
                return $result;
	}
	function taggedPeople($pid){
		$result = $this->db->query2("SELECT name,surname FROM user JOIN tagged ON user.ID=tagged.IDuser WHERE tagged.IDphoto=".$pid);
		return $result;
	}
	function likeStatus($idphoto,$iduser){
		$query = "SELECT IDphoto FROM `like` WHERE IDuser={$iduser} AND IDphoto={$idphoto}";
		$result = $this->db->query2($query);
		$result = mysql_fetch_array($result);
		if ($result['IDphoto']>0) return "liked";
		else return "not liked";
	}
	function toggleLike($user,$photo){
		$result = $this->db->query2("SELECT IDphoto FROM `like` WHERE IDuser={$user} AND IDphoto={$photo}");
		$result = mysql_fetch_array($result);
		if (!$result[0]>0) {
			$data = array(
				'IDuser' => $user,
				'IDphoto' => $photo);
			$this->db->insert('`like`',$data);
		}else{
			$this->db->delete('`like`','IDuser='.$user.' AND IDphoto='.$photo);
		}
	}
	function getLikeNum($uid){
		$result = $this->db->query("SELECT COUNT( * ) FROM `like` JOIN hasPhoto ON hasPhoto.IDphoto=`like`.IDphoto WHERE hasPhoto.IDuser=".$uid);
		return $result[0][0];
	}
	function getPublicNum(){
		$result = $this->db->query("SELECT COUNT( * ) FROM photoVisability WHERE Visibility='1'");
		return $result[0][0];
	}
	function loadPublicPhoto(){
		$result = $this->db->query2("SELECT photoName.filename, photoName.ID, name,surname FROM photoName JOIN photoVisability ON photoName.ID=photoVisability.ID JOIN hasPhoto ON hasPhoto.IDphoto=photoName.ID JOIN user ON user.ID=hasPhoto.IDuser WHERE photoVisability.Visibility=1");
                return $result;
	}
	function getNumFriendsPhoto($myid){
		$result = $this->db->query("SELECT COUNT(hasPhoto.IDphoto) FROM hasPhoto JOIN friends ON hasPhoto.IDuser = friends.IDfriend WHERE friends.IDmy=".$myid);
		return $result[0][0];
	}
}

?>
