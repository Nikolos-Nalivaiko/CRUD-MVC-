<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

    public function indexAction() {
    
        $vars = [];

        if(!empty($_POST)) {
            // Створення користувача
            // $this->model->createUser('users', $_POST);
            $fields = [
                'name' => $_POST['name'],
                'value' => $_POST['value'],
            ];
            $where = [
                'name' => 'GFD',
                // 'value' => 885
            ];
            // Оновлення інформації користувача
            // $this->model->updateUser('users', $fields);
            // Видалення користувача
            // $this->model->deleteUser('users', $fields);
            // Список користувачів
            $result = $this->model->listUsers('users', ['*'], $where);

            
        }

        $this->view->render('Главная страница', $vars);
    }

}