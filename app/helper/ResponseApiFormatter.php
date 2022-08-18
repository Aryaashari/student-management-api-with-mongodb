<?php

namespace Student\Management\Helper;

use Exception;

class ResponseApiFormatter {

    private static $response = [
        "meta" => [
            "status" => "success",
            "code" => 200,
            "message" => ""
        ],
        "data" => null,
        "error" => null
    ];


    public static function Success(string $message, ?array $data = null, ?array $customs = null) {
        self::$response["meta"]["message"] = $message;
        self::$response["data"] = $data;
        if (!is_null($customs)) {
            foreach($customs as $key => $value) {
                self::$response[$key] = $value;
            }
        }

        header("Content-type: application/json");
        return json_encode(self::$response);
    }

    public static function Error(string $message, int $code = 500 , ?\Exception $error = null, ?array $customs = null) {
        self::$response["meta"]["status"] = "error";
        self::$response["meta"]["message"] = $message;
        self::$response["meta"]["code"] = $code;
        self::$response["error"] = $error;
        if (!is_null($customs)) {
            foreach($customs as $key => $value) {
                self::$response[$key] = $value;
            }
        }

        header("Content-type: application/json");
        return json_encode(self::$response);
    }

}