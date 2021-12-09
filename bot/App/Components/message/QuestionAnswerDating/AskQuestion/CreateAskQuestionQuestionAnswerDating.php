<?php

if ($message == $json['buttons']['question-answer-dating задать вопрос'] && $cmddating[0] == '' && empty($cmd[0]) && $user_infodating['reg_status'] === 0) {

    $msg->reply("Меню задачи вопроса",$keyb_cancel_create_ask_question_question_answer_dating_btn_dating);
    $user_question = $db->getUserInfoQuestion($chatid);
    if( $user_question['user_id'] != $chatid && stripos($chatid, '-') === false){
        $db->addUserQuestion($chatid,$user_info['username']);
    }


    if($user_question == false || $user_question['reg_status'] === 1)
    {
        $msg->replyHTML($json['text-question-answer-dating']['кому хотите задать вопрос'],$gender_question_answer_dating_btn_dating);
//         $keyb_cancel_meeting_btn_meeting
        $db->setCmd($chatid, 'set_gender_question_answer', 'dating_users');
        clearCache($mem, $chatid);
        exit();
    }

     $users_question = $db->getUsersInfoQuestion($chatid);

     foreach($users_question as $user)
     {
        if($user['reg_status'] == 1)
        {
             $msg->replyHTML($json['text-question-answer-dating']['кому хотите задать вопрос'],$gender_question_answer_dating_btn_dating);
//         $keyb_cancel_meeting_btn_meeting
             $db->setCmd($chatid, 'set_gender_question_answer', 'dating_users');
             clearCache($mem, $chatid);
             exit();
        }
     }

     if( $user_question['user_id'] = $chatid &&  $user_question['reg_status'] === 0){
          $db->addUserQuestion($chatid,$user_info['username']);
         $msg->replyHTML($json['text-question-answer-dating']['кому хотите задать вопрос'],$gender_question_answer_dating_btn_dating);
         $db->setCmd($chatid, 'set_gender_question_answer', 'dating_users');
         clearCache($mem, $chatid);
         exit();

     }

}

