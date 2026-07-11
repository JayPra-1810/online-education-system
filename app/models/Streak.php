<?php

class Streak {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getStreak($user_id) {
        $this->db->query("SELECT * FROM streaks WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        $streak = $this->db->single();
        
        if(!$streak) {
            // Initialize streak if not exists
            $this->db->query("INSERT INTO streaks (user_id, current_streak, longest_streak) VALUES (:user_id, 0, 0)");
            $this->db->bind(':user_id', $user_id);
            $this->db->execute();
            
            return (object) [
                'user_id' => $user_id,
                'current_streak' => 0,
                'longest_streak' => 0,
                'last_activity_date' => null
            ];
        }
        
        return $streak;
    }

    public function updateStreak($user_id) {
        $streak = $this->getStreak($user_id);
        $today = date('Y-m-d');
        
        if($streak->last_activity_date == $today) {
            // Already updated today
            return true;
        }
        
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $new_streak = 1;
        
        if($streak->last_activity_date == $yesterday) {
            $new_streak = $streak->current_streak + 1;
        }
        
        $longest = max($new_streak, $streak->longest_streak);
        
        $this->db->query("UPDATE streaks SET current_streak = :current, longest_streak = :longest, last_activity_date = :today WHERE user_id = :user_id");
        $this->db->bind(':current', $new_streak);
        $this->db->bind(':longest', $longest);
        $this->db->bind(':today', $today);
        $this->db->bind(':user_id', $user_id);
        
        return $this->db->execute();
    }
}
