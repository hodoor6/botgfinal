<?php

if ($data[0] == 'like') {
    if ($db->isLikeDating($data[1], $chatid) == false) {
        $db->setLikeDating($data[1], $chatid);
        $db->countLikeDating($data[1]);

        $users_dating = $db->getAllUsersDating($user_infodating['gender_filter'],$user_infodating['min_age'],$user_infodating['max_age'],$user_infodating['goal_communication_filter'],$user_infodating['children_filter'],$user_infodating['find_country_filter']);

        $index = $db->getPaginationDating($chatid);

        if (!isset($index)) $index = key($users_dating);

        $user_one = $users_dating[$index];

        $profile_dating_filter = $bt->inlineButtons([
            [
                $json['inline-dating-filter']['нравиться'] . " " . $user_one['count_like'] => 'like/' . $user_one['user_id'],
                $json['inline-dating-filter']['написать'] => 'write-message/' . $user_one['user_id'],
                $json['inline-dating-filter']['подарить'] => 'present/' . $user_one['user_id']
            ],
            [
                $json['inline-dating-filter']['просмотреть анкету'] => 'full-profile/' . $user_one['user_id'],
                $json['inline-dating-filter']['комментировать'] . " " . $user_one['count_comment'] => 'comments/' . $user_one['user_id'],
            ],
            [
                $json['inline-dating-filter']['назад'] => 'switch/pref',
                $json['inline-dating-filter']['вперёд'] => 'switch/next',
            ]
        ]);

        $msg->editMessageКeyboard($profile_dating_filter);

        //очищаем кеш
        clearCache($mem, $chatid);
        exit();
//
    } else {
        $tg->answerCallbackQuery(["callback_query_id" => $callback_id, "text" => "Вы уже поставили отметку нравиться этой анкете", "show_alert" => true]);
//очищаем кеш
        clearCache($mem, $chatid);
        exit();

    }
}