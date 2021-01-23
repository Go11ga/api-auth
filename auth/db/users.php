<?php
  class Users {
    /**
     * * Свойства объекта
     */
    public $id;
    public $login;
    public $password;

    /**
     * * Получение всех элементов
     */
    public function getAll () {
      $text  = file_get_contents('auth/db/users.txt');
      $arr = json_decode($text);

      $array = [];

      foreach($arr as $el) {
        $array[] = (array) $el;
      }

      return $array;
    }

    /**
     * * Инкремент id
     */
    public function updateId () {
      $arr = $this->getAll();

      $currentId = 0;

      foreach($arr as $el){
        $array = (array) $el;
        if($array['id'] > $currentId){
          $currentId = $array['id'];
        }
      }

      $currentId++;

      $this->id = $currentId;
    }

    /**
     * * Создание нового пользователя
     */
    public function create () {
      $flag = true;

      $arr = $this->getAll();

      foreach($arr as $el) {
        if ($el['login'] === $this->login) {
          $flag  = false;
          break;
        }
      }

      if ($flag) {
        $this->updateId();

        $newEl = 
          [
            'id' => $this->id, 
            'login' => $this->login, 
            'password' => $this->password
          ];
        
        $object = (object) $newEl;

        $arr[$id] = $object;

        $arr2 = array_values($arr);
        $result = json_encode($arr2);
        file_put_contents('auth/db/users.txt', $result);

        return true;

      } else {
        return false;
      }
    }

    /**
     * * Проверка существования пользователя
     */
    public function userExists () {
      $flag = false;

      $arr = $this->getAll();

      foreach($arr as $el) {
        if ($el['login'] === $this->login) {
          $flag  = true;
          break;
        }
      }

      if ($flag) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * * Проверка пароля
     */
    public function password_verify () {
      $flag = false;

      $arr = $this->getAll();

      if ($this->userExists()) {
        foreach($arr as $el) {
          if ($el['password'] === $this->password) {
            $flag  = true;
            break;
          }
        }
      }

      if ($flag) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * * Обновление пользователя
     */
    public function update ($login, $password) {
      $arr = $this->getAll();

      $ind;

      foreach($arr as $key => $el) {
        $array = (array) $el;
        if($array['login'] == $this->login) {
          $ind = $key;
        }
      }

      $arr2 = (array) $arr[$ind];
      $arr2['login'] = $login;
      $arr2['password'] = $password;

      $object = (object) $arr2;

      $arr[$ind] = $object;
      $arr2 = array_values($arr);
      $result = json_encode($arr2);
      file_put_contents('auth/db/users.txt', $result);

      return true;
    }
  }
?>