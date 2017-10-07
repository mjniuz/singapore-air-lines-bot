<?php namespace App\Bot\Repository;

class TemplateService
{
    public function __construct()
    {
    }

    public function sendConfirm(array $confirmTemplate, $delay = 0)
    {
        return [
            'type'     => 'confirm',
            'response' => $confirmTemplate,
            'delay'    => $delay,
        ];
    }

    public function sendText($message = '', $delay = 0/*second*/)
    {
        return [
            'type'     => 'text',
            'response' => $message,
            'delay'    => $delay,
        ];
    }

    public function sendImage($URL = '', $delay = 0/*second*/)
    {
        return [
            'type'     => 'image',
            'response' => $URL,
            'delay'    => $delay,
        ];
    }

    public function sendAudio(array $audio, $delay = 0/*second*/)
    {
        return [
            'type'     => 'audio',
            'response' => [
                'url'      => $audio['url'],
                'duration' => $audio['duration'],
            ],
            'delay'    => $delay,
        ];
    }

    public function sendCheckIn($message = [], $delay = 0/*second*/)
    {
        return [
            'type'     => 'checkin',
            'response' => $message,
            'delay'    => $delay,
        ];
    }

    public function sendAirlineUpdate($message = [], $delay = 0/*second*/)
    {
        return [
            'type'     => 'airline_update',
            'response' => $message,
            'delay'    => $delay,
        ];
    }

    public function sendBoarding($message = [], $delay = 0/*second*/)
    {
        return [
            'type'     => 'boarding',
            'response' => $message,
            'delay'    => $delay,
        ];
    }

    public function sendList($lists = [], $delay = 0/*second*/)
    {
        return [
            'type'     => 'list',
            'response' => $lists,
            'delay'    => $delay,
        ];
    }

    public function sendGeneric($genericTemplates = [], $delay = 0/*second*/)
    {
        return [
            'type'     => 'generic',
            'response' => $genericTemplates,
            'delay'    => $delay,
        ];
    }

    public function sendButton($buttonTemplates = [], $delay = 0/*second*/)
    {
        return [
            'type'     => 'button',
            'response' => $buttonTemplates,
            'delay'    => $delay,
        ];
    }
}
