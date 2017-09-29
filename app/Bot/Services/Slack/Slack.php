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
        // set environment Attachment
        $attachment = new Attachment([
            'fallback'    => 'Environment',
            'author_name' => 'Environment',
            'author_icon' => Config::get('slack.icon'),
            'username'    => 'Bot Singapure',
            'text'        => env('APP_ENV'),
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

        self::sendNotification($attachment);
    }

    /**
     * this function for hit notification from request
     *
     * @param string $url     The url
     * @param array  $request The request
     */
    public static function sendNotifyRequest($request, $url)
    {
        // set environment Attachment
        $attachment = new Attachment([
            'fallback'    => 'Environment',
            'author_name' => 'Environment',
            'author_icon' => Config::get('slack.icon'),
            'username'    => 'Bot Singapure',
            'text'        => env('APP_ENV'),
            'fields'      => [
                new AttachmentField([
                    'title' => 'URL',
                    'value' => $url,
                    'short' => true,
                ]),
                new AttachmentField([
                    'title' => 'Request',
                    'value' => json_encode($request),
                    'short' => true,
                ]),
            ],
        ]);

        self::sendNotification($attachment);
    }

    /**
     * this function for send notification to slack
     *
     * @param object $attachment The attachment
     */
    public static function sendNotification($attachment)
    {
        // set client slack
        $client  = new Maknz\Slack\Client(Config::get('slack.endpoint'));
        $channel = Config::get('slack.channel');

        // send notification
        $message = $client->createMessage();
        $message->attach($attachment);
        $message->to($channel)->withIcon(Config::get('slack.icon'))->send('Bot Singapure Airlines');
    }
}
