<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json; charset=utf-8');

# медиа файл для сотрудника
$file_to_employee = "7876cbe22572bf3828df7d26ed7c3ee0";

# Читаем входящий запрос
$data = json_decode(file_get_contents("php://input"));
$extension = (int)$data->params->extension;
$id = (int)$data->id;
# Анализируем добавочный и выбираем кому звонить и какой медиа файл проигрывать для Бабушки    # 1 - звонок менеджеру, 2 - кладовщику, 3 - курьеру, по умолчанию звоним менеджеру пусть разбирается
switch ($extension) {
    case 1:
        $REDIRECT_NUMBER = "79000000002";
        $file_to_granny = "7876cbe22572bf3828df7d26ed7c3ee1";
        break;
    case 2:
        $REDIRECT_NUMBER = "79000000003";
        $file_to_granny = "f8fe95347d176b14e3925dbe590303c4";
        break;
    case 3:
        $REDIRECT_NUMBER = "79000000004";
        $file_to_granny = "f8fe95347d176b14e3925dbe590303c4";
        break;
    default:
        $REDIRECT_NUMBER = "79000000002";
        $file_to_granny = "f8fe95347d176b14e3925dbe590303c4";
        break;
}
# Формируем ответ
$response_call = array(
    "jsonrpc" => "2.0",
    "id" => "1",
    "result" => array(
        "redirect_type" => 1,
        "event_URL" => "http://www.XXXXX.ru/ адрес где будет обработчик статистки запросов (не использую  в статье)",
        "event_extended" => "Y",
        "client_id" => "1235",
        "file_to_A" => $file_to_granny,
        "file_to_B" => $file_to_employee,
        "masking" => "Y",
        "followme_struct" => array(
            1,
            array(
                array(
                    "I_FOLLOW_ORDER" => 1,
                    "PERIOD" => "always",
                    "PERIOD_DESCRIPTION" => "Always",
                    "TIMEOUT" => "30",
                    "ACTIVE" => "Y",
                    "NAME" => "79000000001",
                    "REDIRECT_NUMBER" => $REDIRECT_NUMBER
                )
            )
        )
    )
);
echo json_encode($response_call, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
