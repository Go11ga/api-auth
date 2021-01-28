<?php
  $requestUri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
  require_once 'posts/posts_api.php';

  try {
    /**
     * * Создание пользователя
     * * http://api-auth/api/auth/create
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth' && $requestUri[2] === 'create') {
      require_once 'auth/create_user.php';
    }

    /**
     * * Вход пользователя
     * * http://api-auth/api/auth/auth
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth' && $requestUri[2] === 'auth') {
      require_once 'auth/login.php';
    }

    /**
     * * Валидация токена
     * * http://api-auth/api/auth/validate
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth' && $requestUri[2] === 'validate') {
      require_once 'auth/validate_token.php';
    }

    /**
     * * Обновление пользователя
     * * http://api-auth/api/auth/update
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth' && $requestUri[2] === 'update') {
      require_once 'auth/update_user.php';
    }

    /**
     * * Получить все посты
     * * http://api-auth/api/posts
     */
    if ($_SERVER['REQUEST_METHOD'] ==='GET' && $requestUri[1] === 'posts' && !isset($requestUri[2])) {
      getAllPosts();
    }

    /**
     * * Получить один пост
     * * http://api-auth/api/posts/1
     */
    if ($_SERVER['REQUEST_METHOD'] ==='GET' && $requestUri[1] === 'posts' && isset($requestUri[2])) {
      $id = $requestUri[2];
      getOnePost($id);
    }

    /**
     * * Добавить один пост
     * * http://api-auth/api/posts/add
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'posts' && $requestUri[2] === 'add') {
      addOnePost();
    }

    /**
     * * Редактировать пост по id
     * * http://api-auth/api/posts/update/1
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'posts' && $requestUri[2] === 'update' && isset($requestUri[3])) {
      $id = $requestUri[3];
      updateOnePost($id);
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
     * * Добавить один комментарий
     * * http://api-auth/api/comment/add/1
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'comment' && $requestUri[2] === 'add' && isset($requestUri[3])) {
      $id = $requestUri[3];
      addComment($id);
    }

    /**
     * * Удалить один комментарий
     * * http://api-auth/api/comment/delete/1/1
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'comment' && $requestUri[2] === 'delete' && isset($requestUri[3]) && isset($requestUri[4])) {
      $post_id = $requestUri[3];
      $comment_id = $requestUri[4];
      deleteComment($post_id, $comment_id);
    }
    
    /**
     * * Увеличить количество просмотров
     * * http://api-auth/api/views/1
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'views' && isset($requestUri[2])) {
      $id = $requestUri[2];
      increaseViews($id);
    }
  
  } catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
  }
?>