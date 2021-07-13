<?php

if ($cmd[0] == 'set_number') {






    if ($cmd[0] == 'set_number' && $message == "нет") {
    $msg->replyHTML($local->getResponse('start.txt'));
        $db->setCmd($chatid, 'set_number');
        exit();
    }

    if ($cmd[0] == 'set_number'&& $message == '/start' ) {


        $keyboard = array(

            array(
                array(
                    'text'=>"да",
                    'request_contact'=>true
                ), array(
                'text'=>"нет",
                'request_contact'=>false

            )
            )
        ); //user button under keyboard.


        $msg->replyHTML($json['text']['шаг0']);
        $reply = "Ваш текущий номер";
        $reply_markup = $tg->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false ]);
        $tg->sendMessage([ 'chat_id' => $chatid, 'text' => $reply, 'reply_markup' => $reply_markup ]);
        $db->setCmd($chatid, 'set_number');
        clearCache($mem, $chatid);
        exit();
    }

    if ($phone_id != '' && $phone_vcard == false && $phone_message_bot_unic_id  == BOT_ID) {

        $db->setPhone($chatid, $phone_id);

        $db->setCmd($chatid, 'set_gender');
        clearCache($mem, $chatid);


        $reply = "Сохранено";
        $reply_markup = $tg->buildKeyBoardHide();
        $tg->sendMessage(['chat_id' => $chatid, 'text' => $reply, 'reply_markup' => $reply_markup]);
        $msg->replyHTML($json['text']['шаг1'], $gender_btn);
        exit();

    }else{
        $msg->replyHTML($json['text']['ошибка-телефон']);
		
               $keyboard = array(

            array(
                array(
                    'text'=>"да",
                    'request_contact'=>true
                ), array(
                'text'=>"нет",
                'request_contact'=>false

            )
            )
        ); //user button under keyboard.


        $msg->replyHTML($json['text']['шаг0']);
        $reply = "Ваш текущый номер";
        $reply_markup = $tg->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false ]);
        $tg->sendMessage([ 'chat_id' => $chatid, 'text' => $reply, 'reply_markup' => $reply_markup ]);
        $db->setCmd($chatid, 'set_number');
        clearCache($mem, $chatid);

        exit();
    }
}