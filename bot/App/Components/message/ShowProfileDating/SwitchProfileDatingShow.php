<?php


if ($data[0] == 'switch') {
          $users_dating = $db->getAllUsersDating($user_infodating['gender_filter'],$user_infodating['min_age'],$user_infodating['max_age'],$user_infodating['goal_communication_filter'],$user_infodating['children_filter'],$user_infodating['find_country_filter']);

    $index = $db->getPaginationDating($chatid);
    $last = count($users_dating) - 1; # опрелеяем номер последнего элемент в массиве

    $first = 0; # задаем номер первого элемента в массиве

    if (!isset($index)) $index = key($users_dating);
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
    $user_one = $users_dating[$index];

    $db->setPaginationDating($chatid, $index);
    $resp = $local->getResponse('profile_dating_filter.txt', [
        'name' => $user_one['name'],
        'age' => $user_one['age']
    ]);

    $profile_dating_filter = $bt->inlineButtons([
        [
            $json['inline-dating-filter']['нравиться'] . " " . $user_one['count_like'] => 'like/' . $user_one['user_id'],
            $json['inline-dating-filter']['написать'] => 'write-message/' . $user_one['user_id'],
            $json['inline-dating-filter']['подарить'] => 'present/' . $user_one['user_id'],
        ],
        [
            $json['inline-dating-filter']['просмотреть анкету'] => 'full-profile/' . $user_one['user_id'],
            $json['inline-dating-filter']['комментировать'] . " " . $user_one['count_comment'] => 'comments/' . $user_one['user_id'],
        ],
        [
            $json['inline-dating-filter']['назад'] => 'switch/pref',
            $json['inline-dating-filter']['вперёд'] => 'switch/next'
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
    //очищаем кеш
    clearCache($mem, $chatid);
    exit();
}