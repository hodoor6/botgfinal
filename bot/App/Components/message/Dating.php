<?php

if ($message == $json['buttons']['знакомства'] && empty($cmd[0])) {

    //очищаем кеш
    if ($new_user_dating) {

        $msg->replyHTML($local->getResponse('start_dating.txt'));
    }

    if ($new_user_dating || $cmddating[0] == 'set_name_dating') {

//        clearCache($mem, $chatid);
        $msg->replyHTML($json['text-dating']['имя'],$keyb_cancel);
        $db->setCmd($chatid, 'set_name_dating','dating_users');
    }
	
    if ($cmddating[0] == 'edit_profile_dating' && $message == $json['buttons']['знакомства']) {
        $db->setCmd($chatid, '', 'dating_users');
        clearCache($mem, $chatid);
        $cmddating[0] = '';
    }
	
    if($new_user_dating == false && empty($cmddating[0])) {
        $photo_dating_menu = DEFAULT_PHOTO_DATING_MENU;

        $content = array('chat_id' => $chatid, 'photo' => $photo_dating_menu,
            'parse_mode' => 'HTML', 'reply_markup' => $dating_menu_btn);
        $tg->sendPhoto($content);
        $msg->replyHTML("Этот отдел бота в наполнении
В ближайшее время  вы сможете воспользоваться всеми функциями.",'');
        $photo_profile = (empty($user_info['photo_profile']))?DEFAULT_PHOTO_PROFILE:$user_info['photo_profile'];
        $resp = $local->getResponse('profile_dating_filter.txt', [
            'name' => 'Cергей',
            'age' => '38'
        ]);
      $profile_dating_filter = $bt->inlineButtons([
        [
            $json['inline-dating-filter']['нравиться']. " 99" =>'/1',
            $json['inline-dating-filter']['написать'] => '/2',
            $json['inline-dating-filter']['подарить'] => '/5'
        ],
        [
            $json['inline-dating-filter']['просмотреть анкету'] => '/4',
            $json['inline-dating-filter']['комментировать'] . " 99" => '/3',
        ],
        [
            $json['inline-dating-filter']['назад'] => '/6',
            $json['inline-dating-filter']['вперёд'] => '/7',
        ]
    ]);

        $content3 = array('chat_id' => $chatid, 'media' => json_encode([
            ['type' => 'photo', 'media' => $photo_profile],
            ['type' => 'photo', 'media' => $photo_profile],
            ['type' => 'photo', 'media' => $photo_profile],
            ['type' => 'photo', 'media' => $photo_profile],
//            ['type' => 'video', 'media' => $video_profile],

        ]));
        $tg->sendMediaGroup($content3);
        $content = array('chat_id' => $chatid,  'text' => $resp,
            'parse_mode' => 'HTML', 'reply_markup' => $profile_dating_filter);
        $tg->sendMessage($content);
        exit();
    }
}