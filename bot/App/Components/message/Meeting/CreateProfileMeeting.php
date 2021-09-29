<?php

if ($message == $json['buttons']['создать-meeting'] && $cmddating[0] == '') {


    $user_infomeeting = $db->getUserInfoMeeting($chatid);
    if( $user_infomeeting['user_id'] != $chatid && stripos($chatid, '-') === false){
        $db->addUserMeeting($chatid,$user_info['gender'],$user_info['username']);
    }
    if($user_infomeeting == false || $user_infomeeting['reg_status'] === 1)
    {

       // $msg->reply("ЗАПОЛНИТЕ АНКЕТУ ИЛИ НАЖМИТЕ ПОИСК");

        $msg->replyHTML($json['text-meeting']['как вас зовут'], $keyb_cancel_meeting_btn_meeting);
        $db->setCmd($chatid, 'set_name_meeting', 'dating_users');
        clearCache($mem, $chatid);
        exit();
    }else{
        $user_one = $user_infomeeting;
        $db->setPaginationDating($chatid, 0,'meeting_users');

        $resp = $local->getResponse('profile_meeting_filter.txt', [
            'name' => $user_one['name'],
            'age' => $user_one['age'],
            'city' => $user_one['city'],
            'goal_communication' => $user_one['goal_communication'],
        ]);
        $profile_meeting_filter = $bt->inlineButtons([
            [
                $json['inline-meeting']['удалить анкету'] => 'delete-meeting/' . $chatid,
            ]
        ]);



      if ($user_one['video_profile'] !== '') {
           $video = $user_one['video_profile'];

            $contentMessage = array('chat_id' => $chatid, 'video'=>$user_one['video_profile'], 'caption' => $resp,
                'parse_mode' => 'HTML', 'reply_markup' => $profile_meeting_filter);
            $tg->sendVideo($contentMessage);
        }


        if ($user_one['photo_profile'] !== '') {
            $video = $user_one['video_profile'];

            $contentMessage = array('chat_id' => $chatid, 'photo'=>$user_one['photo_profile'], 'caption' => $resp,
                'parse_mode' => 'HTML', 'reply_markup' => $profile_meeting_filter);
            $tg->sendPhoto($contentMessage);
        }

    }
}

