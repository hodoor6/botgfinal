<?php

        if ($data[0] == 'comment-question-answer-main-menu-dating') {

            $db->setCmd($chatid, 'comment-question-answer-main-menu-dating/'.$data[1].'/'.$data[2],'dating_users');
            $msg->replyHTML("Напишите комментарий к выбраному вопросу",$back_main_menu_question_answer_dating_btn_dating);
            clearCache($mem, $chatid);
            exit();
         }