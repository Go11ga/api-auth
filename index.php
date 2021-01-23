<?php
  /**
   * * Создание пользователя
   * * http://api-auth/api/create
   */
  require_once 'auth/create_user.php';

  /**
   * * Вход пользователя
   * * http://api-auth/api/auth/admin/login
   */
  // require_once 'auth/login.php';

  /**
   * * Валидация токена
   * * http://api-auth/api/validate/admin/login
   */
  // require_once 'auth/validate_token.php';

  /**
   * * Обновление пользователя
   * http://api-auth/api/update/admin/login
   */

  $requestUri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

  try {
    /**
     * * Создание пользователя
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'create') {
      createUser();
    }

    /**
     * * Вход пользователя
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'auth') {
      require_once 'auth/login.php';
    }

    /**
     * * Валидация токена
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'validate') {
      require_once 'auth/validate_token.php';
    }

    /**
     * * обновление пользователя
     */
    if ($_SERVER['REQUEST_METHOD'] ==='POST' && $requestUri[1] === 'update') {
      require_once 'auth/update_user.php';
    }
  } catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
  }

  
?>