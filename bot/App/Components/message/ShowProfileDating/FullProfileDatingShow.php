<?php

    if ($data[0] == 'full-profile') {

        $user_infodating = $db->getUserInfoDating($data[1]);
        $resp = $local->getResponse('profile_dating.txt', [
            'name' => $user_infodating['name'],
            'age' => $user_infodating['age'],
            'country' => $user_infodating['country'],
            'city' => $user_infodating['city'],
            'goal_communication' => $user_infodating['goal_communication'],
            'children' => $user_infodating['children'],

            'present' => $user_infodating['present'],
            'find_country' => $user_infodating['find_country'],
            'email' => $user_infodating['email'],
            'contact_address' => $user_infodating['contact_address'],

        ]);
        $media = [];

        if ($user_infodating['video_profile'] !== '') {
            $media[] = ['type' => 'video', 'media' => $user_infodating['video_profile']];
        }
        if ($user_infodating['photo_profile'] !== '') {
            $media[] = ['type' => 'photo', 'media' => $user_infodating['photo_profile']];
        }
        if ($user_infodating['photo_profile_two'] !== '') {
            $media[] = ['type' => 'photo', 'media' => $user_infodating['photo_profile_two']];

        }
        if ($user_infodating['photo_profile_three'] !== '') {
            $media[] = ['type' => 'photo', 'media' => $user_infodating['photo_profile_three']];
        }
        $content = array('chat_id' => $chatid, 'media' => json_encode($media));
        $tg->sendMediaGroup($content);

        $contentMessage = array('chat_id' => $chatid,  'text' => $resp,
            'parse_mode' => 'HTML','reply_markup' => $keyb_cancel_back_main_menu_btn_dating);

        $tg->sendMessage($contentMessage);
        clearCache($mem, $chatid);
        exit();
    }



