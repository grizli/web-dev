<?php
	require_once 'mysql.php';

class comment{
	  var $db;

  	function __construct(){
    		$this->db = new mysql();
  	}

	function getCommentsNum($id){
		$result = $this->db->query("SELECT COUNT( * ) FROM `hasComment` WHERE IDuser =".$id);
		return $result[0][0]['COUNT( * )'];
	}

	function addComment($uid,$pid,$comment){
		$data = array(
			'content' => $comment);
		$this->db->insert('comment',$data);
		$result = $this->db->get('comment','ID','content=\''.$comment.'\'');
		$cid = $result;
		$data = array(
			'IDuser' => $uid,
			'IDcomment' => $cid);
		$this->db->insert('hasComment',$data);
		$data = array(
			'IDphoto' => $pid,
			'IDcomment' => $cid);
		$this->db->insert('photoComment',$data);
	}
	function getPictureComments($pid){
		$result = $this->db->query2("SELECT content,name,surname FROM comment JOIN photoComment ON comment.ID=photoComment.IDcomment JOIN hasComment ON hasComment.IDcomment=photoComment.IDcomment JOIN user ON user.ID=hasComment.IDuser WHERE photoComment.IDphoto=".$pid);
		return $result;
	}
	function getMyComments($id){
		$result = $this->db->query2("SELECT content,filename,comment.ID FROM comment JOIN hasComment ON hasComment.IDcomment=comment.ID JOIN photoComment ON photoComment.IDcomment=comment.ID JOIN photoName ON photoName.ID=photoComment.IDphoto WHERE hasComment.IDuser=".$id);
		return $result;
	}
	function isOwner($cid,$uid){
		$result = $this->db->get('hasComment','IDuser','IDcomment='.$cid);
		if ($result == $uid) return 1;
		else return 0;
	}
	function deleteComment($cid){
		$this->db->delete('comment','ID='.$cid);
		$this->db->delete('hasComment','IDcomment='.$cid);
		$this->db->delete('photoComment','IDcomment='.$cid);
	}
}

?>
