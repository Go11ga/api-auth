<?php
  /**
   * * Заголовки
   */
  header("Access-Control-Allow-Orgin: *");
  header("Access-Control-Allow-Methods: *");
  header("Content-Type: application/json");

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
  function addOnePost ($title, $text) {
    $db_posts = new Posts();

    // Вариант для ЧПУ
    // $data = json_decode(file_get_contents("php://input"));
    // $title = $data->title;
    // $text = $data->text;

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
  function updateOnePost ($id, $text) {
    $db_posts = new Posts();

    // Вариант для ЧПУ
    // $data = json_decode(file_get_contents("php://input"));
    // $text = $data->text;

    $post = $db_posts->getById($id);

    if ($post) {
      if($db_posts->update($id, $text)) {
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
  function addComment ($id, $title, $text) {
    $db_posts = new Posts();

    // Вариант для ЧПУ
    // $data = json_decode(file_get_contents("php://input"));

    // $title = $data->title;
    // $text = $data->text;

    $post = $db_posts->getById($id);

    if ($post && $title && $text) {
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

  /**
   * * Удалить комментарий
   */
  function deleteComment ($post_id, $comment_id) {
    $db_posts = new Posts();

    $post = $db_posts->getById($post_id);

    if ($post) {
      if($db_posts->removeComment($post_id, $comment_id)) {
        http_response_code(200);
        echo json_encode(array("message" => "Комментарий удален"));
      } else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно удалить комментарий"));
      }
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Невозможно удалить комментарий"));
    }
  }

  /**
   * * Увеличить количество просмотров
   */
  function increaseViews ($id) {
    $db_posts = new Posts();

    $post = $db_posts->getById($id);

    if($post) {
      if($db_posts->increase($id)) {
        http_response_code(200);
        echo json_encode(array("message" => "Счетчик увеличен"));
      } else {
        http_response_code(200);
        echo json_encode(array("message" => "Не возможно увеличить счетчик"));
      }
    } else {
      http_response_code(200);
      echo json_encode(array("message" => "Не возможно увеличить счетчик"));
    }
  }
?>