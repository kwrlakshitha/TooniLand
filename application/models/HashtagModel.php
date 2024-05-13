<?php

class HashtagModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //save hashtags
    public function saveHashtag($hashtags, $postID)
    {
        $hashtagsSplitted = preg_split('/#/', $hashtags);
        $tags = array_filter($hashtagsSplitted);    
        $hashtagSave = array_map('trim', $tags);
        
        foreach($hashtagSave as $tag) {
            $data = array(
                'hashtag' => $tag,
            );
            $this->db->insert('hashtag', $data);

            $data_map = array(
                'hashtagID' => $this->db->insert_id(),
                'postID' => $postID,        
            );
            $this->db->insert('hashtag_post', $data_map);
        }
    }

    //get hashtags by postID and append # symbol
    public function getHashtags($postID)
    {
        $sql = "SELECT * FROM hashtag 
            INNER JOIN hashtag_post ON hashtag_post.hashtagID = hashtag.hashtagID";
        $query = $this->db->query($sql);

        foreach($query->result_array() as $row) {
            // if ($row->postID == $postID) {
                $hashtags[] = '#' . $row['hashtag'];
            // }
        }
        return $query->result();
    }
}