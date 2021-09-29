<?php


if ($data[0] == 'comments') {


    if ($db->getCommentsDating($data[1]) !== []) {
        $msg->replyHTML("Комментарий");
        $users_comments_dating = $db->getCommentsDating($data[1]);

        foreach ($users_comments_dating as $user_comments_dating) {
            $comment = $local->getResponse('comments_profile_dating_filter.txt', [
                'name' => $user_comments_dating['name'],
                'age' => $user_comments_dating['age'],
                'comment' => $user_comments_dating['comment'],

            ]);
            
			        $contentMessage = array('chat_id' => $chatid, 'text' => $comment,
            'parse_mode' => 'HTML');
			     $tg->sendMessage($contentMessage);
        }


   

            $key_comment_main_menu_btn_dating = $bt->inlineButtons([
                [
                    $json['inline-dating']['комментарий написать комментарий'] => 'comment-main-menu-dating/' . $data[1],
                ],
                [
                    $json['inline-dating']['возрат в меню знакомства'] => 'back-main-menu-dating'
                ]
            ]);

            $msg->replyHTML($json['text-dating']['комментарии описание'], $key_comment_main_menu_btn_dating);

        //очищаем кеш
        clearCache($mem, $chatid);
        exit();
    } else {
        $key_comment_main_menu_btn_dating = $bt->inlineButtons([
            [
                $json['inline-dating']['комментарий написать комментарий'] => 'comment-main-menu-dating/' . $data[1],
            ],
            [
                $json['inline-dating']['возрат в меню знакомства'] => 'back-main-menu-dating'
            ]
        ]);
        $msg->replyHTML($json['text-dating']['комментарии описание'], $key_comment_main_menu_btn_dating);
    }
    //очищаем кеш
    clearCache($mem, $chatid);
    exit();
}