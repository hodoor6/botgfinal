<?php


if ($data[0] == 'comments-question-answer') {

    if ($db->getCommentsQuestion($data[1], $data[2], 'question_answer_comments') !== []) {
        $msg->replyHTML("Комментарий");
        $users_comments_question_answer_dating = $db->getCommentsQuestion($data[1], $data[2], 'question_answer_comments');

        foreach ($users_comments_question_answer_dating as $user_comments_question_answer_dating) {
            $comment = $local->getResponse('myquestion_question_answer.txt', [
                'question' => $user_comments_question_answer_dating['comment'],

            ]);

            $contentMessage = array('chat_id' => $chatid, 'text' => $comment,
                'parse_mode' => 'HTML');
            $tg->sendMessage($contentMessage);
        }

        $key_comment_question_answer_main_menu_btn_dating = $bt->inlineButtons([
            [
                $json['inline-dating']['комментарий написать комментарий'] => 'comment-question-answer-main-menu-dating/' . $data[1] . '/' . $data[2],
            ],
            [
                $json['inline-question-answer-dating']['возрат в меню вопроса'] => 'back-question-answer-main-menu-dating'
            ]
        ]);


        $msg->replyHTML($json['text-dating']['комментарии описание'], $key_comment_question_answer_main_menu_btn_dating);

        //очищаем кеш
        clearCache($mem, $chatid);
        exit();
    } else {
        $key_comment_question_answer_main_menu_btn_dating = $bt->inlineButtons([
            [
                $json['inline-dating']['комментарий написать комментарий'] => 'comment-question-answer-main-menu-dating/' . $data[1] . '/' . $data[2],
            ],
            [
                $json['inline-question-answer-dating']['возрат в меню вопроса'] => 'back-question-answer-main-menu-dating'
            ]
        ]);
        $msg->replyHTML($json['text-dating']['комментарии описание'], $key_comment_question_answer_main_menu_btn_dating);
    }
    //очищаем кеш
    clearCache($mem, $chatid);
    exit();
}