<?php

if ($data[0] == 'like-question-answer') {
    if ($db->isLikeQuestion($data[1], $chatid,$data[2]) == false) {
        $db->setLikeQuestion($data[1], $chatid,$data[2]);
        $db->countLikeQuestion($data[1],$data[2]);

        $users_question = $db->getAllUsersQuestion($user_infodating['gender_question']);
        $index = $db->getPaginationDating($chatid,'question_answer_users');

        if (!isset($index)) $index = key($users_question);

        $user_one = $users_question[$index];

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

        $msg->editMessageКeyboard($question_inline_btn);

        //очищаем кеш
        clearCache($mem, $chatid);
        exit();
//
    } else {
        $tg->answerCallbackQuery(["callback_query_id" => $callback_id, "text" => "Вы уже поставили отметку нравиться этому вопросу", "show_alert" => true]);
//очищаем кеш
        clearCache($mem, $chatid);
        exit();

    }
}