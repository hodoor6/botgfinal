<?php

if ($message == $json['buttons']['question-answer-dating вопросы для парней'] && $cmddating[0] == '' && empty($cmd[0]) && $user_infodating['reg_status'] === 0) {

    $user_gender_question = $db->setGenderFilterQuestion($chatid,1);
    $users_question = $db->getAllUsersQuestion($user_gender_question['gender_question']);

    if ($users_question[0]) {
        $user_one = $users_question[0];
        $db->setPaginationDating($chatid, 0,'question_answer_users');

        $resp = $local->getResponse('myquestion_question_answer.txt', [
            'question' => $user_one['question']
        ]);
        $question_inline_btn = $bt->inlineButtons([
            [
                $json['inline-question-answer-dating']['нравиться'] . " ".$user_one['count_like']=> 'like-question-answer/' .$user_one['user_id'].'/'.$user_one['id'],
                $json['inline-question-answer-dating']['не нравиться'] . " ".$user_one['count_dislike']=> 'dislike-question-answer/' .$user_one['user_id'].'/'.$user_one['id'],
            ],
            [
                $json['inline-dating-filter']['комментировать'] . " " . $user_one['count_comment'] => 'comments-question-answer/' . $user_one['user_id'].'/'.$user_one['id'],
                $json['inline-dating-filter']['написать'] => 'write-message-question-answer/' . $user_one['user_id'],
            ],
            [
                $json['inline-dating-filter']['назад'] => 'switch-question-answer/pref',
                $json['inline-dating-filter']['вперёд'] => 'switch-question-answer/next',
            ]
        ]);

        $media = [];

        if ($user_one['video_profile'] !== '') {
            $media[] = ['type' => 'video', 'media' => $user_one['video_profile']];

        }

        if ($user_one['photo_profile'] !== '') {
            $media[] = ['type' => 'photo', 'media' => $user_one['photo_profile']];
        }

        $content = array('chat_id' => $chatid, 'media' => json_encode($media));
        $tg->sendMediaGroup($content);

        $contentMessage = array('chat_id' => $chatid, 'text' => $resp,
            'parse_mode' => 'HTML', 'reply_markup' => $question_inline_btn);
        $tg->sendMessage($contentMessage);
//       $countProfile= count($users_question);
//
//        $msg->reply("По вашему фильтру найденно ". $countProfile ." анкет");

        //    //очищаем кеш
        clearCache($mem, $chatid);
        exit();
    }
//    $msg->reply("По вашему фильтру ничего не найденно измените критерии поиска");
    clearCache($mem, $chatid);
    exit();
}
