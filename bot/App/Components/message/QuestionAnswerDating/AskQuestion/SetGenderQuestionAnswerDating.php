
<?php

if ($data[0] == 'set_gender_question_answer') {
    if ($data[1] == 'boy') {
        $gender = 1;
    } else {
        $gender = 2;
    }

    $db->setCmd($chatid, 'set_video_photo_question_answer','dating_users');
    $db->setGenderQuestion($chatid, $gender,'question_answer_users');
    clearCache($mem, $chatid);
//    $msg->Rupdate($json['text-question-answer-dating']['загрузите фото или видео']);
    $msg->replyHTML($json['text-question-answer-dating']['загрузите фото или видео']);
    exit();
}
