<?php

if ($data[0] == 'switch-question-answer') {

    $users_question = $db->getAllUsersQuestion($user_infodating['gender_question']);
    $index = $db->getPaginationDating($chatid, 'question_answer_users');
    $last = count($users_question) - 1; # опрелеяем номер последнего элемент в массиве

    $first = 0; # задаем номер первого элемента в массиве

    if (!isset($index)) $index = key($users_question);
    switch ($data['1']) # Выбор действия в зависимости от нажатой кнопки
    {
        case 'pref':
            if ($index != $first) {
                $index--;
            } elseif ($index == $first) {
                $index = $last;
            }
            break;
        case 'next':
            if ($index != $last) {
                $index++;
            } elseif ($index == $last) {
                $index = $first;
            }
            break;
    };
//вывод анкеты после переключения
    $user_one = $users_question[$index];

    $db->setPaginationDating($chatid, $index, 'question_answer_users');
    $resp = $local->getResponse('myquestion_question_answer.txt', [
        'question' => $user_one['question']
    ]);
    $question_inline_btn = $bt->inlineButtons([
        [
            $json['inline-question-answer-dating']['нравиться'] . " " . $user_one['count_like'] => 'like-question-answer/' . $user_one['user_id'] . '/' . $user_one['id'],
            $json['inline-question-answer-dating']['не нравиться'] . " " . $user_one['count_dislike'] => 'dislike-question-answer/' . $user_one['user_id'] . '/' . $user_one['id'],
        ],
        [
            $json['inline-dating-filter']['комментировать'] . " " . $user_one['count_comment'] => 'comments-question-answer/' . $user_one['user_id'] . '/' . $user_one['id'],
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
    //очищаем кеш
    clearCache($mem, $chatid);
    exit();
}