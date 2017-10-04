<?php

namespace App\Bot\Repository;


class TemplateService
{
    public function __construct() {
    }

    public function sendConfirm(array $confirmTemplate, $delay = 0){
        return [
            'type'      => 'confirm',
            'response'  => $confirmTemplate,
            'delay'     => $delay
        ];
    }

    public function sendText($message = '', $delay = 0 /*second*/){
        return [
            'type'      => 'text',
            'response'  => $message,
            'delay'     => $delay
        ];
    }

    public function sendImage($URL = '', $delay = 0 /*second*/){
        return [
            'type'      => 'image',
            'response'  => $URL,
            'delay'     => $delay
        ];
    }

    public function sendAudio(array $audio, $delay = 0 /*second*/){
        return [
            'type'      => 'audio',
            'response'  => [
                'url'       => $audio['url'],
                'duration'  => $audio['duration']
            ],
            'delay'     => $delay
        ];
    }

    public function sendSticker($stickerID = '', $packageID = 1, $delay = 0 /*second*/){
        return [
            'type'      => 'sticker',
            'response'  => [
                'sticker_id'    => $stickerID,
                'package_id'    => $packageID
            ],
            'delay'     => $delay
        ];
    }

    public function sendCarousel($carouselTemplates = [], $delay = 0 /*second*/){
        return [
            'type'      => 'carousel',
            'response'  => $carouselTemplates,
            'delay'     => $delay
        ];
    }

    public function sendButton($buttonTemplates = [], $delay = 0 /*second*/){
        return [
            'type'      => 'button',
            'response'  => $buttonTemplates,
            'delay'     => $delay
        ];
    }
}
