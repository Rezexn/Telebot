<?php

namespace Rezexn\Telebot;

class Methods
{
    protected $token;

    function __construct($token)
    {
        $this->token = $token;
    }

    protected function bot($method, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->token . '/' . $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($curl);
        $err = curl_error($curl);
        return $err ? $err : json_decode($res);
    }

    public function getMe($options = [])
    {
        return $this->bot('getMe', $options);
    }

    public function setWebhook($url, $options = [])
    {
        $options['url'] = $url;
        return $this->bot('setWebhook', $options);
    }

    public function sendMessage($chat_id, $text, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['text'] = $text;
        return $this->bot('sendMessage', $options);
    }

    public function sendPhoto($chat_id, $photo, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['photo'] = $photo;
        return $this->bot('sendPhoto', $options);
    }

    public function sendVoice($chat_id, $voice, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['voice'] = $voice;
        return $this->bot('sendVoice', $options);
    }

    public function sendVideo($chat_id, $video, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['video'] = $video;
        return $this->bot('sendVideo', $options);
    }

    public function sendDocument($chat_id, $document, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['document'] = $document;
        return $this->bot('sendDocument', $options);
    }

    public function deleteMessage($chat_id, $message_id, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['message_id'] = $message_id;
        return $this->bot('deleteMessage', $options);
    }

    public function leaveChat($chat_id, $options = [])
    {
        $options['chat_id'] = $chat_id;
        return $this->bot('leaveChat', $options);
    }

    public function getChatMember($chat_id, $user_id, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['user_id'] = $user_id;
        return $this->bot('getChatMember', $options);
    }

    public function answerCallbackQuery($callback_query_id, $options = [])
    {
        $options['callback_query_id'] = $callback_query_id;
        return $this->bot('answerCallbackQuery', $options);
    }

    public function editMessageText($chat_id, $message_id, $text, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['message_id'] = $message_id;
        $options['text'] = $text;
        return $this->bot('editMessageText', $options);
    }

    public function editMessageReplyMarkup($chat_id, $message_id, $options = [])
    {
        $options['chat_id'] = $chat_id;
        $options['message_id'] = $message_id;
        return $this->bot('editMessageReplyMarkup', $options);
    }
}
