<?php

if ($data[0] == 'write-message') {


    $resp = $local->getResponse('write-message-profile_dating_filter.txt', [

        'chatid' => $data[1],
    ]);

    $content = array('chat_id' => $chatid, 'text' => $resp,
        'parse_mode' => 'HTML');

    $tg->sendMessage($content);
    clearCache($mem, $chatid);
    exit();

}


