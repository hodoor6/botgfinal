<?php

if ($message == $json['buttons']['вопросы и ответы от вас'] && empty($cmd[0]) && empty($cmddating[0]) && $user_infodating['reg_status'] === 0) {

    clearCache($mem, $chatid);
    $msg->reply($json['text-question-answer-dating']['меню вопросов'], $question_answer_dating_btn_dating);
    exit();
}
