<?php


if ($cmddating[0] == 'comment-main-menu-dating') {

    if ($message == $json['buttons']['меню знакомства возрат в меню знакомства'] && $cmd[0] == '') {
        $msg->delete();
        $msg->reply("Меню просмотра анкет", $dating_menu_btn);
        $msg->delete();
    } elseif ($cmddating[0] == 'comment-main-menu-dating' && !empty($message)) {
        $users_comment = $db->getUserInfoDating($cmddating[1]);
        $message= mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');
        $db->setCmd($chatid, '', 'dating_users');
        $db->setCommentsDating($users_comment['user_id'], $user_infodating['name'], $user_infodating['age'],$message, $chatid);
        $msg->replyHTML($json['text']['сохранено'],$dating_menu_btn);
        $db->countCommentDating($users_comment['user_id']);
    }

          $users_dating = $db->getAllUsersDating($user_infodating['gender_filter'],$user_infodating['min_age'],$user_infodating['max_age'],$user_infodating['goal_communication_filter'],$user_infodating['children_filter'],$user_infodating['find_country_filter']);

    $index = $db->getPaginationDating($chatid);

    if (!isset($index)) $index = key($users_dating);

    $user_one = $users_dating[$index];

    $resp = $local->getResponse('profile_dating_filter.txt', [
        'name' =>   $user_one['name'],
        'age' =>   $user_one['age']
    ]);
    $profile_dating_filter = $bt->inlineButtons([
        [
            $json['inline-dating-filter']['нравиться'] . " ".$user_one['count_like']=> 'like/' .$user_one['user_id'],
            $json['inline-dating-filter']['написать'] => 'write-message/' . $user_one['user_id'],
            $json['inline-dating-filter']['подарить'] => 'present/' .   $user_one['user_id']

        ],
        [
            $json['inline-dating-filter']['просмотреть анкету'] => 'full-profile/' .   $user_one['user_id'],
            $json['inline-dating-filter']['комментировать'] . " ".  $user_one['count_comment'] => 'comments/' .   $user_one['user_id'],
        ],
        [
            $json['inline-dating-filter']['назад'] => 'switch/pref',
            $json['inline-dating-filter']['вперёд'] => 'switch/next',
        ]
    ]);

    $media = [];

    if (  $user_one['video_profile'] !== '') {
        $media[] = ['type' => 'video', 'media' =>   $user_one['video_profile']];
    }
    if (  $user_one['photo_profile'] !== '') {
        $media[] = ['type' => 'photo', 'media' =>   $user_one['photo_profile']];
    }
    if (  $user_one['photo_profile_two'] !== '') {
        $media[] = ['type' => 'photo', 'media' =>   $user_one['photo_profile_two']];
    }
    if (  $user_one['photo_profile_three'] !== '') {
        $media[] = ['type' => 'photo', 'media' =>   $user_one['photo_profile_three']];
    }

    $content = array('chat_id' => $chatid, 'media' => json_encode($media));
    $tg->sendMediaGroup($content);

    $contentMessage = array('chat_id' => $chatid, 'text' => $resp,
        'parse_mode' => 'HTML', 'reply_markup' => $profile_dating_filter);
    $tg->sendMessage($contentMessage);
    $db->setCmd($chatid, '','dating_users');
    clearCache($mem, $chatid);
    exit();
}

