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
    $msg->reply("Добро пожаловать в Раздел Знакомства!", $dating_menu_btn);
            $users_dating = $db->getAllUsersDating($user_infodating['gender_filter'],$user_infodating['min_age'],$user_infodating['max_age'],$user_infodating['goal_communication_filter'],$user_infodating['children_filter'],$user_infodating['find_country_filter']);

        if ($users_dating[0]) {
            $user_one = $users_dating[0];
            $db->setPaginationDating($chatid, 0);

            $resp = $local->getResponse('profile_dating_filter.txt', [
                'name' => $user_one['name'],
                'age' => $user_one['age']
            ]);
            $profile_dating_filter =
                $bt->inlineButtons([
                [
                    $json['inline-dating-filter']['нравиться'] . " ".$user_one['count_like']=> 'like/' .$user_one['user_id'],
                    $json['inline-dating-filter']['написать'] => 'write-message/' . $user_one['user_id'],
                    $json['inline-dating-filter']['подарить'] => 'present/' . $user_one['user_id']

                ],
                [
                    $json['inline-dating-filter']['просмотреть анкету'] => 'full-profile/' . $user_one['user_id'],
                    $json['inline-dating-filter']['комментировать'] . " ".$user_one['count_comment'] => 'comments/' . $user_one['user_id'],
                ],
                [
                    $json['inline-dating-filter']['назад'] => 'switch/pref',
                    $json['inline-dating-filter']['вперёд'] => 'switch/next',
                ]
            ]);

            $media = [];

            if ($user_one['video_profile'] !== '') {
                $media[] = ['type' => 'video', 'media' => $user_one['video_profile']];
            }
            if ($user_one['photo_profile'] !== '') {
                $media[] = ['type' => 'photo', 'media' => $user_one['photo_profile']];
            }
            if ($user_one['photo_profile_two'] !== '') {
                $media[] = ['type' => 'photo', 'media' => $user_one['photo_profile_two']];
            }
            if ($user_one['photo_profile_three'] !== '') {
                $media[] = ['type' => 'photo', 'media' => $user_one['photo_profile_three']];
            }

            $content = array('chat_id' => $chatid, 'media' => json_encode($media));
            $tg->sendMediaGroup($content);

            $contentMessage = array('chat_id' => $chatid, 'text' => $resp,
                'parse_mode' => 'HTML', 'reply_markup' => $profile_dating_filter);
            $tg->sendMessage($contentMessage);
     $countProfile= count($users_dating);

               $msg->reply("По вашему фильтру найденно ". $countProfile ." анкет");
            clearCache($mem, $chatid);
            exit();
        }
        $msg->reply("По вашему фильтру ничего не найденно измените критерии поиска");
        clearCache($mem, $chatid);
        exit();
    }
}