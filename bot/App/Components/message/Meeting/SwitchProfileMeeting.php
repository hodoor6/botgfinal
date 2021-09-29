<?php


if ($data[0] == 'switch-meeting') {

    $user_infomeeting = $db->getUserInfoMeeting($chatid);
    $users_meeting = $db->getAllUsersMeeting($user_infomeeting['min_age'],
    $user_infomeeting['max_age'],$user_infomeeting['city_filter']);
    $index = $db->getPaginationDating($chatid,'meeting_users');
    $last = count($users_meeting) - 1; # опрелеяем номер последнего элемент в массиве

    $first = 0; # задаем номер первого элемента в массиве

    if (!isset($index)) $index = key($users_meeting);
    switch ($data['1']) # Выбор действия в зависимости от нажатой кнопки
    {
        case 'pref':
            if ($index != $first) {
                $index--;
            } elseif ($index == $first) {
                $index = $last;
            }
            break;
        case 'next':
            if ($index != $last) {
                $index++;
            } elseif ($index == $last) {
                $index = $first;
            }
            break;
    };
//вывод анкеты после переключения
    $user_one = $users_meeting[$index];

    $db->setPaginationDating($chatid, $index,'meeting_users');
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
            $json['inline-dating-filter']['вперёд'] => 'switch-meeting/next'
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
    //очищаем кеш
    clearCache($mem, $chatid);
    exit();
}