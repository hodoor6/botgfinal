<?php

if ($message == $json['buttons']['просмотреть анкету'] && $cmd[0]=='' && $cmddating[0] == 'edit_profile_dating') {


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

    $content1 = array('chat_id' => $chatid,  'text' => $resp,
        'parse_mode' => 'HTML');

    $tg->sendMessage($content1);

    exit();
}
