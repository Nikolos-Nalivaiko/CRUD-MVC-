<?php

namespace application\models;
use application\core\Model;

class Main extends Model {

    public function createUser($table, $post){
        $this->db->create($table, $post);
    }

    public function updateUser($table, $post, $where = []) {
        $this->db->update($table, $post, $where);
    }

    public function deleteUser($table, $fields) {
        $this->db->delete($table, $fields);
    }

    public function listUsers($table, $fields, $where = []) {
        $result = $this->db->readList($table, $fields, $where);

        foreach($result as $data) {
            echo '<div class="user-info">
                    <h4>User #'.$data['id'].'</h4>
                    <p>name ----> <b>'.$data['name'].'</b></p>
                    <p>value ----> <b>'.$data['value'].'</b></p>
                </div>';
        }
    }

    public function readSingle() {
        
    }

}