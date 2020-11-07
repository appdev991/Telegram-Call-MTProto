<?php

namespace App\Channels\Telegram;
use App\Models\TelegramSession;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramLocation;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\Exceptions\CouldNotSendNotification;

use danog\MadelineProto\API;
/**
 * Class TelegramChannel.
 */
class TelegramCallChannel
{

    /**
     * @var Telegram
     */
    protected $telegram;

    /**
     * Channel constructor.
     *
     * @param Telegram $telegram
     */
    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }


    public function send($notifiable, Notification $notification)
    {
    
    $session_info=TelegramSession::first();
    $session_name=$session_info->name;
        $telegram_id = $notifiable->telegram_chat_id;
        
        
        dump("active session name ". $session_name);
        
        dump($telegram_id . " has been selected for telegram call");
        
        // if ($telegram_id != "@Haddi_Malik" && $telegram_id != "@usman_zaidi") {
        //     dump($telegram_id . " has been skipped");
        //     $telegram_id = null;
        // }

        try {
            if (!empty($telegram_id)) {
                dump("Making Call To : " . $telegram_id);
                $MadelineProto = new API(public_path('madeline/01/'.$session_name));
                $MadelineProto->start();
                $MadelineProto->sleep(20);
                $controller = $MadelineProto->requestCall($telegram_id);

            }
        } catch (\Exception $ex) {
            dump("EXCEPTION : " . date('Y-m-d h:i a') . " " . $ex->getMessage() . " Line: " . $ex->getLine() . " File : " . $ex->getFile() . " \n ");
        }
    }
}
