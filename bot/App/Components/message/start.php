<?php

if ($message == '/start' || ($message != '' && $new_user == true) ) {

    //очищаем кеш
    clearCache($mem, $chatid);

    if ($new_user || $cmd[0] == 'set_number') {


        if ($new_user) {

            $msg->replyHTML($local->getResponse('start.txt'));

        }





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

    } else if ($cmd[0] == 'set_gender') {
        //рефералка
        if (!empty($ref_id)) {
            $db->setRefer($chatid, $ref_id);
            $vip_day = $db->getVipDay($ref_id);
            $vip_day++;
            $db->setVipDay($ref_id, $vip_day);
            $msg->sendHTML($ref_id, $json['text']['реферал']);
        }


        $msg->replyHTML($json['text']['шаг1'], $gender_btn);
        $db->setCmd($chatid, 'set_gender');
    } else if ($cmd[0] == 'set_age') {
        $msg->replyHTML($json['text']['шаг2']);
    } else {
		  if($user_infodating['reg_status'] === 1)
        {
            $db->deleteUser($chatid);
        }
        $db->setCmd($chatid, '');
        $db->setSearchBoy($chatid, 0);
        $db->setSearchGirl($chatid, 0);
        $db->setCompanion($chatid, 0);
        $msg->replyHTML($local->getResponse('start.txt'), $btn_menu);
    }
    exit();
}