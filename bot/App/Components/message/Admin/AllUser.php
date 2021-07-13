<?php
//new mailing

if ($message == '/all_users' && ( $chatid == ADMIN_ID || $chatid == '00394296212' || $chatid == '00927576268' || $chatid == '853662126' || $chatid == '1685964652'|| $chatid == '1604644219') ) {

    //очищаем кеш
    clearCache($mem, $chatid);

    $msg->replyHTML('<b>Вывод всех пользователей</b>','');
    $users = $db->getAllUsers();

    foreach ($users as $user) {
        if($user['username'] != 'NaN' )
        {
            $msg->replyHTML('<b>@</b>'. $user['username'],'');
        } else
            			            $msg->replyHTML("<b>id пользователя - <a href=\"tg://user?id={$user['user_id']}\">{$user['user_id']}</a></b>, ". $user['phone_profile'],'');


if($user['phone_profile'] != '' )
        {
			 $msg->replyHTML('<b>id пользователя - </b>'. $user['user_id'],'');
			 $msg->replyHTML(''. $user['phone_profile'],'');
		}
    }



    exit();
}
