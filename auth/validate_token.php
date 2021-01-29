<?php
  /**
   * * Заголовки
   */
  header("Access-Control-Allow-Orgin: *");
  header("Access-Control-Allow-Methods: *");
  header("Content-Type: application/json");

  /**
   * * Декодирование JWT 
   */
  include_once 'config/core.php';
  include_once 'libs/php-jwt-master/src/BeforeValidException.php';
  include_once 'libs/php-jwt-master/src/ExpiredException.php';
  include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
  include_once 'libs/php-jwt-master/src/JWT.php';
  use \Firebase\JWT\JWT;

  // Вариант с ЧПУ
  // $data = json_decode(file_get_contents("php://input"));
  // $jwt=isset($data) ? $data : "";

  $jwt = $_REQUEST['jwt'];

  /**
   * * Если JWT не пуст 
   */
  if($jwt) {
    /**
     * * Если декодирование выполнено успешно, показать данные пользователя 
     */
    try {
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        http_response_code(200);

        echo json_encode(array(
            "message" => "Доступ разрешен.",
            "data" => $decoded->data
        ));

    }

    /**
     * * Если декодирование не удалось, это означает, что JWT является недействительным 
     */
    catch (Exception $e){
    
        http_response_code(401);
    
        echo json_encode(array(
            "message" => "Доступ закрыт.",
            "error" => $e->getMessage()
        ));
    }
  }

  /**
   * * Показать сообщение об ошибке, если jwt пуст 
   */
  else{

    http_response_code(401);

    echo json_encode(array("message" => "Доступ запрещён."));
  }
?>