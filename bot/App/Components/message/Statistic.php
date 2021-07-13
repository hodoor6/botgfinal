<?php

if ($message == $json['buttons']['статистика'] && $cmd[0] == '') {

    $today = time();
    $job = mktime(0, 0, 0, 5, 6, 2021);
    $days = floor(($today - $job) / 86400); //сколько дней работает проект

    $c_users = $db->countUsers();
    $c_users_online = $db->getCountUsersOnline($today - 60*10);
    $new_users = $db->getCountNewUsersNowDay(date('Y-m-d'));

    $resp = $local->getResponse('state.txt',
        [
            'days' => $days,
            'users' => $c_users,
            'users_online' => $c_users_online,
            'new_users' => $new_users
        ]);
    $msg->replyHTML($resp, $btn_menu);
    exit();
}
