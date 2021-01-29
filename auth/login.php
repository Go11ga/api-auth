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
  include_once 'db/users.php';
  $db_users = new Users();
  
  // Вариант с ЧПУ
  // $data = json_decode(file_get_contents("php://input"));
  // $db_users->login = $data->login;
  // $db_users->password = $data->password;

  $login = $_REQUEST['login'];
  $password = $_REQUEST['password'];

  $db_users->login = $login;
  $db_users->password = $password;

  $user_exists = $db_users->userExists();
  $password_verified = $db_users->password_verify();

  /**
   * * Подключение файлов jwt 
   */
  include_once 'config/core.php';
  include_once 'libs/php-jwt-master/src/BeforeValidException.php';
  include_once 'libs/php-jwt-master/src/ExpiredException.php';
  include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
  include_once 'libs/php-jwt-master/src/JWT.php';
  use \Firebase\JWT\JWT;

  /**
   * * Существует ли логин и соответствует ли пароль тому, что находится в базе данных 
   */
  if ( $user_exists && $password_verified ) {
  
    $token = array(
      "iss" => $iss,
      "aud" => $aud,
      "iat" => $iat,
      "nbf" => $nbf,
      "data" => array(
          "login" => $db_users->login,
          "password" => $db_users->password
      )
    );

    http_response_code(200);

    /**
     * * Создание jwt 
     */
    $jwt = JWT::encode($token, $key);
    echo json_encode(
        array(
            "message" => "Успешный вход в систему.",
            "jwt" => $jwt
        )
    );

  } else {
    http_response_code(401);
    echo json_encode(array("message" => "Ошибка входа"));
  }
?>
 