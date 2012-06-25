<?php
require_once 'mysql.php';

class user {
  var $db;
  
  function __construct(){
    $this->db = new mysql();
  }
  //dohvat imena i prezimena usera	 
  	function getUserInfo($userID){
    		$result = $this->db->row(array(
	        	'table' => 'user',
      			'condition' => 'ID='.$userID)
      		);
		return $result;
  	}
	//dohvat userID na temelju imena logina
	function getUserID($name){
		$result = $this->db->get('userLogin','ID','username=\''.$name.'\'');
		return $result;
	}

	function getUserLogin($name,$psswd){
		$psswd = md5($psswd);
                $result = $this->db->get('userLogin','ID','username=\''.$name.'\' AND psswd=\''.$psswd.'\'');
                return $result;
        }

	function insertNewUser($username,$psswd){
		$psswd = md5($psswd);
		$data = array(
			'username' => $username,
			'psswd' => $psswd);
		$result = $this->db->insert('userLogin',$data);
		return $result;
	}
	function insertUserProfile($name,$surname,$id){
		$data = array(
			'name' => $name,
			'surname' => $surname,
			'ID' => $id);
		$result = $this->db->insert('user',$data);
		return $result;
	}
	function getFriendsNum($id){
                $result = $this->db->query("SELECT COUNT( * ) FROM `friends` WHERE IDmy =".$id);
                return $result[0][0]['COUNT( * )'];
        }
	function getFriendsReqNum($id){
                $result = $this->db->query("SELECT COUNT( * ) FROM `request` WHERE IDfriend =".$id);
                return $result[0][0]['COUNT( * )'];
        }
	function getPeopleList($id){
		$result = $this->db->query("SELECT name,surname,ID FROM user WHERE NOT ID='".$id."';");
                return $result;

	}
	function getRequestList($id){
		$query= "SELECT user.* FROM user JOIN request ON user.ID = request.IDmy WHERE request.IDfriend=".$id;
		$result = $this->db->query($query);
		return $result;
		}
	function getFriendsList($id){
                $query= "SELECT user.* FROM user JOIN friends ON user.ID = friends.IDfriend WHERE friends.IDmy=".$id;
                $result = $this->db->query($query);
                return $result;
                }
	function addFriends($IDmy,$IDfriend){
		$this->db->delete('request','IDfriend='.$IDmy.' AND IDmy='.$IDfriend);
		$data = array(
			'IDmy' => $IDmy,
			'IDfriend' => $IDfriend);
		$this->db->insert('friends',$data);
		$data = array(
			'IDmy' => $IDfriend,
			'IDfriend' => $IDmy);
		$this->db->insert('friends',$data);
	}

	
  
  /*
  function __destruct(void){
   
  }
  */
}
?>
