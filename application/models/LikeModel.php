<?php

class LikeModel extends CI_Model
{
    public function insertLike($postID, $userID)
    {
        if (isset($postID) && isset($userID)) {
            $data = array('liked' => TRUE);
            $res = $this->db->get_where('like_user_post', array('postID' => $postID, 'userID' => $userID));
            if ($res->num_rows() != 1) {
                // var_dump("LIKE - " . $data['liked']);
                $this->db->insert('liked', $data);
                $data_new = array(
                    'postID' => $postID,
                    'userID' => $userID,
                    'likeID' => $this->db->insert_id()
                );
                $this->db->insert('like_user_post', $data_new);
                $sql = "SELECT count(postID) as NumberOfLikes, postID FROM like_user_post WHERE postID = ". $postID;
                $query = $this->db->query($sql);
                return $query->result_array() + array('liked' => 1);
                
            } else {
                $data = array('liked' => FALSE);
                // var_dump("LIKE - " . $data['liked']);
                $this->db->where('likeID', $res->row()->likeID);
                $this->db->delete('like_user_post');
                $this->db->insert('liked', $data);
                $sql = "SELECT count(postID) as NumberOfLikes, postID FROM like_user_post WHERE postID = ". $postID;
                $query = $this->db->query($sql);
                return $query->result_array() + array('liked' => 0);
            }
            return $this->db->affected_rows();
        } else {
            return "No data";
        }
    }
}
