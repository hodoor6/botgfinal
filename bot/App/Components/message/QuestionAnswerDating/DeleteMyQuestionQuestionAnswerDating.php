<?php

if ($data[0] == 'delete-question-answer' && $cmddating[0] == '') {
    //очищаем кеш
    memcache_set($mem, 'user_info_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    memcache_set($mem, 'user_info_dating_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    $db->setCmd($chatid, '', 'dating_users');
    $db->setCmd($chatid, '');
    $db->deleteQuestionQuestion($data[1],$chatid,'question_answer_users');
    $msg->delete();
    exit();
}
