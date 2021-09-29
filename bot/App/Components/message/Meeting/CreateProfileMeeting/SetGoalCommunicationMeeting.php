<?php

if (!empty($message) && $cmddating[0] == 'set_goal_communication_meeting') {

    $db->setCmd($chatid, 'set_video_meeting', 'dating_users');
    $goal = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');
    $db->setGoalCommunication($chatid, $goal,'meeting_users');
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-meeting']['загрузите видео о себе']);
    exit();
}
