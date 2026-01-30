<?php

class SmsNotification extends CComponent {

    const SMS_API_KEY = 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ';
    const SMS_API_URL = 'https://smspilot.ru/api2.php';
    const SMS_FROM = 'INFORM';


    public static function sendNewBookofAuthor(array $subscribers, Author $author, string $bookTitle)
    {
        $send = [];
        $i = 1;

        foreach ($subscribers as $item) {
            array_push($send, [
                'id' => $i,
                'to' => $item->guest_phone,
                'text'=> "Новая книга автора ".$author->author_name.", {$bookTitle}."
            ]);
            $i++;
        }

        $content = [
            'apikey' => self::SMS_API_KEY,
            'from' => self::SMS_FROM,
            'send' => $send
        ];

        $result = file_get_contents(
            self::SMS_API_URL,
            false,
            stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/json\r\n",
                    'content' => json_encode($content),
                ],
        ]));

        return self::checkStatus(json_decode($result));
    }

    private static function checkStatus($result): bool
    {
        $isSuccess = true;

        $content = [
            'apikey' => self::SMS_API_KEY,
            "check" => true,
            "server_packet_id" => $result->server_packet_id
        ];

        $res = json_decode(file_get_contents(
            self::SMS_API_URL,
            false,
            stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/json\r\n",
                    'content' => json_encode($content),
                ],
        ])));

        if (isset($res->error)) {
            $isSuccess = false;
        }
        return $isSuccess;
    }

}