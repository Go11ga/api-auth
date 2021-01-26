<?php
  /**
   * * Заголовки
   */
  header("Access-Control-Allow-Origin: http://authentication-jwt/");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  /**
   * * "Подключение к БД"
   */
  include_once 'db/posts.php';
  

  /**
   * * Получить все посты
   */
  function getAllPosts () {
    $db_posts = new Posts();
    $posts = $db_posts->getAll();

    if($posts) {
      http_response_code(200);
      echo json_encode(
        array(
          "message" => "Данные получены",
          "data" => $posts
        )
      );
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Ошибка загрузки"));
    }
  }

  /**
   * * Получить один пост
   */
  function getOnePost ($id) {
    $db_posts = new Posts();
    $post = $db_posts->getById($id);

    if($post) {
      http_response_code(200);
      echo json_encode(
        array(
          "message" => "Данные получены",
          "data" => $post
        )
      );
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Ошибка загрузки"));
    }
  }

  /**
   * * Добавить один пост
   */
  function addOnePost () {
    $data = json_decode(file_get_contents("php://input"));

    $title = $data->title;
    $text = $data->text;

    $db_posts = new Posts();

    $db_posts->setOne($title, $text);

    if($title && $text) {
      if($db_posts->setOne($title, $text)) {
        http_response_code(200);
        echo json_encode(array("message" => "Пост был создан"));
      } else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно создать пост"));
      }
    }
  }

  /**
   * * Редактировать пост
   */
  function updateOnePost ($id) {
    $data = json_decode(file_get_contents("php://input"));

    $title = $data->title;
    $text = $data->text;

    $db_posts = new Posts();

    $post = $db_posts->getById($id);

    if ($post) {
      if($db_posts->update($id, $title, $text)) {
        http_response_code(200);
        echo json_encode(array("message" => "Пост был обновлен"));
      } else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно обновить пост"));
      }
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Невозможно обновить пост"));
    }
  }

  /**
   * * Удалить пост
   */
  function removeOne ($id) {
    $db_posts = new Posts();

    $post = $db_posts->getById($id);

    if ($post) {
      if($db_posts->removeById($id)) {
        http_response_code(200);
        echo json_encode(array("message" => "Пост был удален"));
      } else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно удалить пост"));
      }
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Невозможно удалить пост"));
    }
  }

  /**
   * Добавить комментарий
   */
  function addComment ($id) {
    $db_posts = new Posts();

    $data = json_decode(file_get_contents("php://input"));

    $title = $data->title;
    $text = $data->text;

    $post = $db_posts->getById($id);

    if ($post) {
      if($db_posts->addComment($id, $title, $text)) {
        http_response_code(200);
        echo json_encode(array("message" => "Комментарий добавлен"));
      } else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно добавить комментарий"));
      } 
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Невозможно добавить комментарий"));
    }
  }
?>