<?php

if ($message == $json['buttons']['question-answer-dating мои вопросы'] && $cmddating[0] == '' && empty($cmd[0]) && $user_infodating['reg_status'] === 0) {

    $users_question = $db->getUsersInfoQuestion($chatid);
    foreach ($users_question as $user_question) {
        if ($user_question['reg_status'] == 0) {


            $user_one = $user_question;
            $db->setPaginationDating($chatid, 0, 'question_answer_users');

            $resp = $local->getResponse('myquestion_question_answer.txt', [
                'question' => $user_one['question']
            ]);
            $myquestion_delete_btn = $bt->inlineButtons([
                [
                    $json['inline-question-answer-dating']['удалить вопрос'] => 'delete-question-answer/' . $id = $user_one['id'],
                ]
            ]);


            if ($user_one['video_profile'] !== '') {
                $video = $user_one['video_profile'];

                $contentMessage = array('chat_id' => $chatid, 'video' => $user_one['video_profile'], 'caption' => $resp,
                    'parse_mode' => 'HTML', 'reply_markup' => $myquestion_delete_btn);
                $tg->sendVideo($contentMessage);
            }


            if ($user_one['photo_profile'] !== '') {
                $video = $user_one['video_profile'];

                $contentMessage = array('chat_id' => $chatid, 'photo' => $user_one['photo_profile'], 'caption' => $resp,
                    'parse_mode' => 'HTML', 'reply_markup' => $myquestion_delete_btn);
                $tg->sendPhoto($contentMessage);
            }

        }
    }

}
