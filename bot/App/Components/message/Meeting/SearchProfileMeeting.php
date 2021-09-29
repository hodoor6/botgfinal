<?php

if ($message == $json['buttons']['поиск-meeting'] && $cmddating[0] == '') {

    $user_infomeeting = $db->getUserInfoMeeting($chatid);
    $users_meeting = $db->getAllUsersMeeting($user_infomeeting['min_age'],$user_infomeeting['max_age'],$user_infomeeting['city_filter']);

    if ($users_meeting[0]) {
        $user_one = $users_meeting[0];
        $db->setPaginationDating($chatid, 0,'meeting_users');

        $resp = $local->getResponse('profile_meeting_filter.txt', [
            'name' => $user_one['name'],
            'age' => $user_one['age'],
            'city' => $user_one['city'],
            'goal_communication' => $user_one['goal_communication'],
        ]);
        $profile_meeting_filter = $bt->inlineButtons([
		    [
                $json['inline-dating-filter']['написать'] => 'write-message-meeting/' . $user_one['user_id'],
            ],
            [
                $json['inline-dating-filter']['назад'] => 'switch-meeting/pref',
                $json['inline-dating-filter']['вперёд'] => 'switch-meeting/next',
            ]
        ]);

        $media = [];

        if ($user_one['video_profile'] !== '') {
            $media[] = ['type' => 'video', 'media' => $user_one['video_profile']];
        }
        if ($user_one['photo_profile'] !== '') {
            $media[] = ['type' => 'photo', 'media' => $user_one['photo_profile']];
        }

        $content = array('chat_id' => $chatid, 'media' => json_encode($media));
        $tg->sendMediaGroup($content);

        $contentMessage = array('chat_id' => $chatid, 'text' => $resp,
            'parse_mode' => 'HTML', 'reply_markup' => $profile_meeting_filter);
        $tg->sendMessage($contentMessage);
        // $db->setCmd($chatid, '','dating_users');
        //    //очищаем кеш
        clearCache($mem, $chatid);
        exit();
    }
}
