<?php

if (!empty($message) && $cmddating[0] == 'set_question_question_answer') {


    $db->setCmd($chatid, '', 'dating_users');
    $question = mb_convert_case($message, MB_CASE_TITLE, 'UTF-8');
    $db->setQuestionQuestion($chatid, $question,'question_answer_users');
    clearCache($mem, $chatid);
    $db->setRegStatus($chatid, 0,'question_answer_users');
    $msg->replyHTML($json['text']['сохранено']);
    $msg->replyHTML($json['text-question-answer-dating']['после регистрации'],$question_answer_dating_btn_dating);
    //  $msg->replyHTML($json['text-meeting']['рег объявление'],  $meeting_btn_dating);
    exit();
}
