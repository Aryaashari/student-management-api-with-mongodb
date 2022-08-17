<?php

namespace Student\Management\Helper;

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


    public static function Success(string $message, ?array $data, ?array $custom) {
        self::$response["meta"]["message"] = $message;
        self::$response["data"] = $data;
        if (!is_null($custom)) {
            self::$response[] = $custom;
        }
    }

    public static function Error(string $message, int $code = 500 , ?array $error, ?array $custom) {
        self::$response["meta"]["status"] = "error";
        self::$response["meta"]["message"] = $message;
        self::$response["meta"]["code"] = $code;
        self::$response["error"] = $error;
        if (!is_null($custom)) {
            self::$response[] = $custom;
        }
    }

}