
<?php

if ($message == $json['buttons']['question-answer-dating возврат меню вопросы'] && empty($cmd[0]) && empty($cmd[0]) && $user_infodating['reg_status'] === 0) {

    $msg->delete();
    //очищаем кеш
    memcache_set($mem, 'user_info_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    memcache_set($mem, 'user_info_dating_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    $db->setCmd($chatid, '','dating_users');
    clearCache($mem, $chatid);
    $msg->delete();
    $msg->reply($json['text-question-answer-dating']['меню вопросов'], $question_answer_dating_btn_dating);
    exit();
}
