<?php
  class Posts {
    /**
     * * Получение всех элементов
     */
    public function getAll () {
      $text  = file_get_contents('posts/db/posts.txt');
      $arr = json_decode($text);

      return $arr;
    }

    /**
     * * Получение одного элемента по id
     */
    public function getById ($id) {
      $text  = file_get_contents('posts/db/posts.txt');
      $arr = json_decode($text);

      $item;
      foreach($arr as $el) {
        $array = (array) $el;
        if($array['id'] == $id) {
          $item = $array;
        }
      }

      return $item;
    }

    /**
     * * Добавление элемента
     */
    public function setOne ($title, $textInc) {
      $text = file_get_contents('posts/db/posts.txt');
      $arr = json_decode($text);

      $currentId = 0;
      foreach($arr as $el){
        $array = (array) $el;
        if($array['id'] > $currentId){
          $currentId = $array['id'];
        }
      }

      $currentId++;

      $date = date('Y-m-d"T"H:i:s',time());

      $newEl = 
        [
          'id' => $currentId, 
          'title' => $title, 
          'text' => $textInc,
          'comments' => [],
          'views' => 0,
          'img' => "https://cataas.com/cat?width=350&height=273&i=".$currentId,
          "registered" => $date
        ];
      
      $object = (object) $newEl;

      $arr[$id] = $object;

      $arr2 = array_values($arr);
      $result = json_encode($arr2);
      file_put_contents('posts/db/posts.txt', $result);

      return true;
    }

    /**
     * * Редактирование элемента по id
     */
    public function update ($id, $title, $textInc) {
      $text = file_get_contents('posts/db/posts.txt');
      $arr = json_decode($text);

      $ind;
      foreach($arr as $key => $el) {
        $array = (array) $el;
        if($array['id'] == $id) {
          $ind = $key;
        }
      }

      $arr2 = (array) $arr[$ind];

      $arr2['title'] = $title;
      $arr2['text'] = $textInc;

      $object = (object) $arr2;

      $arr[$ind] = $object;
      $arr2 = array_values($arr);
      $result = json_encode($arr2);
      file_put_contents('posts/db/posts.txt', $result);

      return true;
    }

    /**
     * * Удаление элемента по id
     */
    public function removeById ($id) {
      $text = file_get_contents('posts/db/posts.txt');
      $arr = json_decode($text);

      $ind;
      foreach($arr as $key => $el) {
        $array = (array) $el;
        if($array['id'] == $id) {
          $ind = $key;
        }
      }

      unset($arr[$ind]);

      $arr2 = array_values($arr);
      $result = json_encode($arr2);

      file_put_contents('posts/db/posts.txt', $result);

      return true;
    }
  }
?>