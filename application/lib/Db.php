<?php

namespace application\lib;

use PDO;

class Db {

    protected $db;

    public function __construct()
    {
        // Подключаемся к БД
       $config = require 'application/config/db.php';
       $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
    }

    // Функция на выполнение запроса 
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if(!empty($params)) {
            foreach($params as $key => $val) {
                $stmt->bindValue(':'.$key, $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function readList($table, $fields, $where = []) {
        $fieldData = implode(', ', $fields);

        if(!empty($where)) {
            foreach($where as $keyP => $valP) {
                $whereData[] = $keyP.' = \''.$valP.'\'';
            }
            $whereData = implode(' AND ', $whereData);
            $sql = 'SELECT '.$fieldData.' FROM '.$table.' WHERE '.$whereData;
        } else {
            $sql = 'SELECT '.$fieldData.' FROM '.$table;
        }
        $result = $this->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($table, $post) {
        $params = [];
        foreach($post as $key => $val) {
            $params[$key] = $val;
            $fieldData[] = $key.'= :'.$key;
        }
        
        $fieldData = implode(', ', $fieldData);
        $sql = 'INSERT INTO '.$table.' SET '.$fieldData;
        $this->query($sql, $params);
    }

    public function update($table, $post, $where = [] ) {
        foreach($post as $key => $val) {
            $params[$key] = $val;
            $fieldData[] = $key.'= :'.$key;
        }
        $fieldData = implode(', ', $fieldData);

        if(!empty($where)) {
            foreach($where as $keyP => $valP) {
                $whereData[] = $keyP.' = \''.$valP.'\'';
            }
            $whereData = implode(' AND ', $whereData);
            $sql = 'UPDATE '.$table.' SET '.$fieldData.' WHERE '.$whereData;
        } else {
            $sql = 'UPDATE '.$table.' SET '.$fieldData;
        }
        $this->query($sql, $params);
    }

    public function delete($table, $fields) {
        foreach($fields as $key => $val) {
            $fieldsData[] = $key.' = \''.$val.'\'';
        }
        $fieldsData = implode(' AND ', $fieldsData);

        $sql = 'DELETE FROM '.$table.' WHERE '.$fieldsData;
        $this->query($sql);
    }
  
}  