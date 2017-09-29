<?php namespace App\Bot\Services\Slack;

use Config;
use Maknz;
use Maknz\Slack\Attachment;
use Maknz\Slack\AttachmentField;

class Slack
{
    /**
     * send notification to slack if error
     *
     * @param string $url      The url
     * @param string $request  The request
     * @param string $error    The error
     * @param string $location The location
     */
    public static function sendNotifyError($url, $request, $error, $location)
    {
        // set client slack
        $client  = new Maknz\Slack\Client(Config::get('slack.endpoint'));
        $channel = Config::get('slack.channel');
        $env     = env('APP_ENV');
        $icon    = Config::get('slack.icon');

        // set environment Attachment
        $attachment = new Attachment([
            'fallback'    => 'Environment',
            'author_name' => 'Environment',
            'author_icon' => $icon,
            'username'    => 'Bot Singapure',
            'text'        => $env,
            'fields'      => [
                new AttachmentField([
                    'title' => 'URL',
                    'value' => $url,
                    'short' => true,
                ]),
                new AttachmentField([
                    'title' => 'Request',
                    'value' => $request,
                    'short' => true,
                ]),
                new AttachmentField([
                    'title' => 'Error',
                    'value' => $error,
                    'short' => true,
                ]),
                new AttachmentField([
                    'title' => 'Location',
                    'value' => $location,
                    'short' => true,
                ]),
            ],
        ]);

        $message = $client->createMessage();
        $message->attach($attachment);
        $message->to($channel)->withIcon($icon)->send('Bot Error');
    }
}
