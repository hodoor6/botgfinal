<?php

if ($message == $json['buttons']['встречи'] && empty($cmd[0]) && empty($cmddating[0]) && $user_infodating['reg_status'] === 0) {

   // $db->setCmd($chatid, 'edit_profile_dating', 'dating_users');
    clearCache($mem, $chatid);
    $msg->reply("ЭТОТ СЕРВИС ДОСТУПЕН \nТЕМ, КОМУ ЗА 30 ЛЕТ \n ЗАПОЛНИТЕ АНКЕТУ ИЛИ НАЖМИТЕ ПОИСК", $meeting_btn_dating);
    exit();
}
