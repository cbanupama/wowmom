<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class FirebaseCloudMessenger
{
    /**
     * Send firebase messages
     *
     * @param $title
     * @param $body
     * @param $icon
     * @param $action
     * @param array $tokens
     * @return ResponseInterface
     */
    public function send($title, $body, $icon, $action, $tokens = [])
    {
        $fcmMsg = [
            'title'        => $title,
            'body'         => $body,
            'icon'         => $icon,
            'click_action' => $action
        ];

        $fcmFields = [
            'registration_ids' => $tokens,
            'priority'         => 'high',
            'notification'     => $fcmMsg
        ];

        $headers = [
            'Authorization' => 'key=' . config('fcm.api_access_key'),
            'Content-Type'  => 'application/json'
        ];

        $http = new Client();
        $fcmUrl = config('fcm.url');

        $response = $http->post($fcmUrl, [
            'body' => json_encode($fcmFields),
            'headers' => $headers
        ]);

        return json_decode((string)$response->getBody(), true);
    }
}
