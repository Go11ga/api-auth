<?php
  /**
   * * Заголовки
   */
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  /**
   * * Для кодирования токена
   */
  include_once 'config/core.php';
  include_once 'libs/php-jwt-master/src/BeforeValidException.php';
  include_once 'libs/php-jwt-master/src/ExpiredException.php';
  include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
  include_once 'libs/php-jwt-master/src/JWT.php';
  use \Firebase\JWT\JWT;

  /**
   * * "Подключение к БД"
   */
  include_once 'db/users.php';
  $db_users = new Users();
  
  /**
   * * Получаем данные
   */
  $data = json_decode(file_get_contents("php://input"));
  
  /**
   * * Получаем jwt 
   */
  $jwt=isset($data->jwt) ? $data->jwt : "";
 
  /**
   * * Если JWT не пуст
   */ 
  if($jwt) {
    try {
      /**
       * * Декодирование jwt 
       */
      $decoded = JWT::decode($jwt, $key, array('HS256'));

      $db_users->name = $decoded->data->name;
      $db_users->password = $decoded->data->password;

      if ($db_users->userExists() && $db_users->password_verify ()) {
        $upd_name = $data->name;
        $upd_password = $data->password;

        /**
         * * Если обновление прошло успешно, генерируем новый токен
         */
        if($db_users->update($upd_name, $upd_password)) {
          $token = array(
            "iss" => $iss,
            "aud" => $aud,
            "iat" => $iat,
            "nbf" => $nbf,
            "data" => array(
              "name" => $upd_name,
              "password" => $upd_password
            )
          );
        
          $jwt = JWT::encode($token, $key);
            
          http_response_code(200);
            
          echo json_encode(
            array(
              "message" => "Пользователь был обновлён",
              "jwt" => $jwt
            )
          );
        } else {
          http_response_code(401);
          echo json_encode(array("message" => "Невозможно обновить пользователя."));
        }
      } else {
        http_response_code(400);
        echo json_encode(array("message" => "Невозможно обновить пользователя."));
      }
    }
    /**
     * * Если декодирование не удалось, это означает, что JWT является недействительным
     */ 
    catch (Exception $e){
      http_response_code(401);
  
      echo json_encode(array(
        "message" => "Доступ закрыт",
        "error" => $e->getMessage()
      ));
    }
  }
  
  /**
   * * Показать сообщение об ошибке, если jwt пуст
   */
  else {
    http_response_code(401);
    echo json_encode(array("message" => "Доступ закрыт."));
  }
?>