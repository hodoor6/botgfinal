<?php

if ($cmddating[0] == 'set_video_photo_question_answer') {



    if ($cmddating[0] == 'set_video_photo_question_answer' && !empty($video_id)) {
        $db->setCmd($chatid, 'set_question_question_answer', 'dating_users');
        $db->setVideoQuestion($chatid, $video_id, 'question_answer_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
        $msg->replyHTML($json['text-question-answer-dating']['напишите свой вопрос']);
        exit();

    }elseif ($cmddating[0] == 'set_video_photo_question_answer' && !empty($photo_id)) {
         $db->setCmd($chatid, 'set_question_question_answer', 'dating_users');
        $db->setPhotoQuestion($chatid, $photo_id,'question_answer_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
       $msg->replyHTML($json['text-question-answer-dating']['напишите свой вопрос']);
        exit();
    }else{
        $msg->replyHTML($json['text-dating']['загрузите приветственное ошибка']." или фото только в формате .jpg");
        exit();
    }
}
