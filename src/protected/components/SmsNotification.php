<?php
/**
 * SmsNotification класс
 * Работа с API смс-шлюза smspilot
 * Рассылка уведомлений о новых книгах автора и проверка статуса рассылки
 */
class SmsNotification extends CComponent
{
    const SMS_API_KEY = 'XXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZXXXXXXXXXXXXYYYYYYYYYYYYZZZZZZZZ';
    const SMS_API_URL = 'https://smspilot.ru/api2.php';
    const SMS_FROM = 'INFORM';

    /**
     * Рассылка уведомлений о новых книгах автора
     * @param array $subscribers - список телефонов подписчиков
     * @param object Author $author - данные автора,
     * @param string $bookTitle - название книги
     * @return bool - false если били ошибки при отправке
     */
    public static function sendNewBookofAuthor(array $subscribers, object $author, string $bookTitle): bool
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

    /**
     * Проверка статуса отправки уведомлений
     * @param object stdClass $result - ответ на отправку уведомлений, который содержит id пакета отправки
     * @return bool - false если статус с ошибкой
     */
    private static function checkStatus($result): bool
    {
        $isSuccess = true;

        if (isset($result->server_packet_id)) {

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
        } else {
            $isSuccess = false;
        }
        return $isSuccess;
    }

}