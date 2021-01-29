<?php
  $requestUri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

  /**
   * * ПОСТЫ
   */
  require_once 'posts/posts_api.php';

  try {
    /**
     * * Получить все посты
     * * http://api-auth/api/posts
     */
    if ($_SERVER['REQUEST_METHOD'] ==='GET' && $requestUri[1] === 'posts' && !isset($requestUri[2])) {
      getAllPosts();
    }

    /**
     * * Получить пост по id
     * * http://api-auth/api/posts/1
     */
    if ($_SERVER['REQUEST_METHOD'] ==='GET' && $requestUri[1] === 'posts' && isset($requestUri[2])) {
      $id = $requestUri[2];
      getOnePost($id);
    }

    /**
     * * Добавить пост
     * * http://api-auth/api/posts/add/title?title=test&text=test
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'posts' && $requestUri[2] === 'add') {
      $title = $_REQUEST['title'];
      $text = $_REQUEST['text'];
      addOnePost($title, $text);
    }

    /**
     * * Редактировать пост по id
     * * http://api-auth/api/posts/update/1/text?text=test
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'posts' && $requestUri[2] === 'update' && isset($requestUri[3])) {
      $id = $requestUri[3];
      $text = $_REQUEST['text'];
      updateOnePost($id, $text);
    }

    /**
     * * Удалить пост по id
     * * http://api-auth/api/posts/delete/1
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'posts' && $requestUri[2] === 'delete' && isset($requestUri[3])) {
      $id = $requestUri[3];
      removeOne($id);
    }

    
    /**
     * * КОММЕНТАРИИ
     */

    /**
     * * Добавить один комментарий
     * * http://api-auth/api/comment/add/2/title?title=test&text=test
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'comment' && $requestUri[2] === 'add' && isset($requestUri[3])) {
      $id = $requestUri[3];
      $title = $_REQUEST['title'];
      $text = $_REQUEST['text'];
      addComment($id, $title, $text);
    }

    /**
     * * Удалить один комментарий
     * * http://api-auth/api/comment/delete/2/1
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'comment' && $requestUri[2] === 'delete' && isset($requestUri[3]) && isset($requestUri[4])) {
      $post_id = $requestUri[3];
      $comment_id = $requestUri[4];
      deleteComment($post_id, $comment_id);
    }


    /**
     * * ПРОСМОТРЫ
     */
    
    /**
     * * Увеличить количество просмотров
     * * http://api-auth/api/views/2
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'views' && isset($requestUri[2])) {
      $id = $requestUri[2];
      increaseViews($id);
    }

    /**
     * * ПОЛЬЗОВАТЕЛИ
     */

    /**
     * * Создать пользователя
     * * http://api-auth/api/auth/create/login?login=Ivan&password=999
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth' && $requestUri[2] === 'create') {
      require_once 'auth/create_user.php';
    }

    /**
     * * Вход пользователя
     * * http://api-auth/api/auth/auth/login?login=admin&password=admin
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth' && $requestUri[2] === 'auth') {
      require_once 'auth/login.php';
    }

    /**
     * * Валидация токена
     * * http://api-auth/api/auth/validate/jwt?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJsb2dpbiI6ImFkbWluIiwicGFzc3dvcmQiOiJhZG1pbiJ9fQ.zdKhCvtutlHYZcy8ZJKGyCGSp75PBzqEr5iEDAWwJZQ
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth' && $requestUri[2] === 'validate') {
      require_once 'auth/validate_token.php';
    }

    /**
     * * Обновление пользователя
     * * http://api-auth/api/auth/update/jwt?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hbnktc2l0ZS5vcmciLCJhdWQiOiJodHRwOlwvXC9hbnktc2l0ZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwiZGF0YSI6eyJsb2dpbiI6ImFkbWluIiwicGFzc3dvcmQiOiJhZG1pbiJ9fQ.zdKhCvtutlHYZcy8ZJKGyCGSp75PBzqEr5iEDAWwJZQ&login=admin2&password=admin2
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth' && $requestUri[2] === 'update') {
      require_once 'auth/update_user.php';
    }
  } catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
  }
?>