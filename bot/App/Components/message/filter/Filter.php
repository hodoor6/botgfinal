<?php

if ($message == $json['buttons']['фильтр'] && $cmd[0] == '' || $cmd[0] == 'set_gender_filter') {


    //очищаем кеш
    clearCache($mem, $chatid);

    if($cmd[0] == 'set_gender_filter' && !empty($message) && $user_info['gender_filter'] != 0 &&  $cmd[0] == '')
    {
        $msg->replyHTML($json['text']['ошибка возраст максимум']);

    }



if ($cmd[0] == 'set_gender_filter' &&  $data[0] != 'set_gender' || $user_info['gender_filter'] == 0 &&  $data[0] != 'set_gender'  || $user_info['gender_filter'] != 0 && $data[0] != 'set_gender') {



        $msg->replyHTML($json['text']['фильтр пол'], $gender_btn_filter);
        $db->setCmd($chatid, 'set_gender_filter');





    } else if ($cmd[0] == 'set_age_min_filter') {
           $msg->replyHTML($json['text']['фильтр возраст минимум']);
    } else if ($cmd[0] == 'set_age_max_filter') {
           $msg->replyHTML($json['text']['фильтр возраст максимум']);
    }

}
