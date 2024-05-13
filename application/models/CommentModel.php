<?php

class CommentModel extends CI_Model
{
    public function insertComment($comment, $postID, $userID)
    {
        $data = array(
            'comment' => $comment,
            'postID' => $postID,
            'userID' => $userID
        );
        $response = $this->db->insert('comment', $data);
        return ( $response ? $this->db->insert_id() : $this->db->error());
    }

    public function getComment($id)
    {
        $this->db->select('userName, user_detail.profileImage, comment.*');
        $this->db->from('user_detail');
        $this->db->where('postID', $id);
        $this->db->join('comment', 'user_detail.userID = comment.userID');

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteComment($id)
    {
        $this->db->where('commentID', $id);
        $this->db->delete('comment');
        return $this->db->affected_rows();
    }
}
