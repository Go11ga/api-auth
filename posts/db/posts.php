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

      $date = date('Y-m-d H:i:s',time());

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
    public function update ($id, $textInc) {
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

      // $arr2['title'] = $title;
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

    /**
     * * Добавление комментария
     */
    public function addComment ($id, $title, $textInc) {
      $text = file_get_contents('posts/db/posts.txt');
      $arr = json_decode($text);

      $ind;
      foreach($arr as $key => $el) {
        $array = (array) $el;
        if($array['id'] == $id) {
          $ind = $key;
        }
      }

      // искомый общий массив
      $arr2 = (array) $arr[$ind];

      // массив комментариев
      $comments = $arr2['comments'];


      $currentId = 0;
      foreach($comments as $el){
        $array = (array) $el;
        if($array['id'] > $currentId){
          $currentId = $array['id'];
        }
      }

      $currentId++;

      $date = date('Y-m-d H:i:s',time());

      $newEl = 
        [
          'id' => $currentId, 
          'name' => $title,
          "registered" => $date, 
          'text' => $textInc
        ];

      $object = (object) $newEl;

      array_push($arr2['comments'], $object);

      $object2 = (object) $arr2;

      $arr[$ind] = $object2;
      $arr3 = array_values($arr);
      $result = json_encode($arr3);
      file_put_contents('posts/db/posts.txt', $result);

      return true;
    }

    /**
     * * Удаление комментария
     */
    public function removeComment($post_id, $comment_id) {
      $text = file_get_contents('posts/db/posts.txt');
      $arr = json_decode($text);

      $ind;
      foreach($arr as $key => $el) {
        $array = (array) $el;
        if($array['id'] == $post_id) {
          $ind = $key;
        }
      }

      // искомый общий массив
      $arr2 = (array) $arr[$ind];

      // массив комментариев
      $comments = $arr2['comments'];

      // $result = json_encode($comments);
      // echo $result;

      $comments2 = [];
      foreach($comments as $el) {
        $array = (array) $el;
        if($array['id'] != $comment_id) {
          $comments2[] = (object) $array;
        }
      }

      // $result = json_encode($comments2);
      // echo $result;

      $arr2['comments'] = $comments2;

      // $result = json_encode($arr2);
      // echo $result;
     

      $object2 = (object) $arr2;

      $arr[$ind] = $arr2;

      $arr3 = array_values($arr);

      $result = json_encode($arr3);

      file_put_contents('posts/db/posts.txt', $result);

      return true;
    }

    /**
     * * Увеличить количество просмотров
     */
    public function increase($id) {
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

      $arr2['views'] = $arr2['views'] + 1;

      $object = (object) $arr2;

      $arr[$ind] = $object;
      $arr2 = array_values($arr);
      $result = json_encode($arr2);

      file_put_contents('posts/db/posts.txt', $result);

      return true;
    }
  }
?>