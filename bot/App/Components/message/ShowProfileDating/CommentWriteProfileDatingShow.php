<?php

        if ($data[0] == 'comment-main-menu-dating') {

            $db->setCmd($chatid, 'comment-main-menu-dating/'.$data[1],'dating_users');
            $msg->replyHTML("Напишите комментарий к выбраной анкете",$back_main_menu_btn_dating);
            clearCache($mem, $chatid);
            exit();
         }