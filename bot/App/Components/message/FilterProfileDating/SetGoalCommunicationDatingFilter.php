<?php

if ($data[0] == 'set_goal_communication_dating' && $cmddating[0] == 'set_goal_communication_dating_filter') {
    if ($data[1] == '1') {
        $goal = 'Общение';
    } elseif ($data[1] == '2') {
        $goal = 'Дружба';
    } elseif ($data[1] == '3') {
        $goal = 'Семья';
    } elseif ($data[1] == '4') {
        $goal = 'Нет в списке';
    } elseif ($data[1] == '5') {
        $goal = 'Всё';
    }
    $db->setCmd($chatid, 'set_children_dating_filter', 'dating_users');
    $db->setGoalCommunicationFilter($chatid, $goal,'dating_users');
    clearCache($mem, $chatid);
    $msg->replyHTML($json['text-dating']['дети'], $children_btn_dating);
    exit();
}
