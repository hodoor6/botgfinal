<?php

if ($message == $json['buttons']['случайный'] && empty($cmd[0])) {


    if ($user_info['gender_filter'] === 0) {

        $db->setCmd($chatid, '');
        $response = $local->getResponse('not_filter.txt');
        // $msg->delete();
        $msg->replyHTML($response, $btn_menu);

        exit();
    }

    if ($user_info['min_age'] === 0) {

        $db->setCmd($chatid, '');
        $response = $local->getResponse('not_filter.txt');
        // $msg->delete();
        $msg->replyHTML($response, $btn_menu);

        exit();
    }


    if ($user_info['max_age'] === 0) {

        $db->setCmd($chatid, '');
        $response = $local->getResponse('not_filter.txt');
        // $msg->delete();
        $msg->replyHTML($response, $btn_menu);

        exit();
    }


//поиск парней
    if ($user_info['gender_filter'] == 1) {


        $db->setCmd($chatid, 'chat');
        if ($user_info['gender'] == 1) {
            $boys = $db->SearchBoy();
            foreach ($boys as $boy) {
                if ($boy['gender'] != 1) {
                    continue;
                } else {
                    $ch_boy = $boy;
                    break;
                }
            }
            if ($ch_boy == '') {
                $boy['id'] = '';
            } else {
                $boy = $ch_boy;
            }
        } else if ($user_info['gender'] == 2) {
            $girls = $db->SearchGirl();
            foreach ($girls as $boy) {
                if ($boy['gender'] != 1) {
                    continue;
                } else {
                    $ch_boy = $boy;
                    break;
                }
            }
            if ($ch_boy == '') {
                $boy['id'] = '';
            } else {
                $boy = $ch_boy;
            }
        }
        if ($boy['id'] != '') {
            echo 'ок' . '</br>';
            {
                //Ок мин возраст
                if ($boy['age'] < $user_info['min_age']) {
                    $boy = '';
                }

                //Ок максимальный возраст
                if ($boy['age'] > $user_info['max_age']) {
                    $boy = '';
                }

                //Ок возраст опонента меньше
                if ($boy['min_age'] > $user_info['age']) {
                    $boy = '';
                }

                //возраст минимальныый больше максимального
                if ($boy['min_age'] > $boy['max_age']) {
                    $boy = '';
                }

                //возраст  максимального поиска меньше возраста пользователя
                if ($user_info['age'] > $boy['max_age']) {
                    $boy = '';
                }

            }
        }


        //свои параметри неверны  возраст минимальныый больше максимального
        if ($user_info['min_age'] > $user_info['max_age']) {
            $boy = '';
        }


        if ($boy['id'] == '') {

            $db->setSearchBoy($chatid, time());
            $msg->replyHTML($json['text']['поиск'], $search_dialog_btn);
        } else {
            $db->setCompanion($boy['user_id'], $chatid);
            $db->setCompanion($chatid, $boy['user_id']);

            $db->setSearchBoy($boy['user_id'], 0);
            $db->setSearchGirl($boy['user_id'], 0);

            clearCache($mem, $boy['user_id']);
            $msg->sendHTML($boy['user_id'], $json['text']['найден'], $dialog_btn);
            $msg->replyHTML($json['text']['найден'], $dialog_btn);

        }
        clearCache($mem, $chatid);
        exit();

    }

    //поиск девушек
    if ($user_info['gender_filter'] == 2) {

        $db->setCmd($chatid, 'chat');
        if ($user_info['gender'] == 1) {
            $girls = $db->SearchBoy();
            foreach ($girls as $girl) {
                if ($girl['gender'] != 2) {
                    continue;
                } else {
                    $ch_girl = $girl;
                    break;
                }
            }
            if ($ch_girl == '') {
                $girl['id'] = '';
            } else {
                $girl = $ch_girl;
            }
        } else if ($user_info['gender'] == 2) {
            $girls = $db->SearchGirl();
            foreach ($girls as $girl) {
                if ($girl['gender'] != 2) {
                    continue;
                } else {
                    $ch_girl = $girl;
                    break;
                }
            }
            if ($ch_girl == '') {
                $girl['id'] = '';
            } else {
                $girl = $ch_girl;
            }
        }
        if ($girl['id'] != '') {

            {
                // Ок мин возраст
                if ($girl['age'] < $user_info['min_age']) {
                    $girl = '';
                }

                // Ок максимальный возраст
                if ($girl['age'] > $user_info['max_age']) {
                    $girl = '';
                }

                //Ок возраст опонента меньше
                if ($girl['min_age'] > $user_info['age']) {
                    $girl = '';
                }


                //возраст минимальныый больше максимального
                if ($girl['min_age'] > $girl['max_age']) {
                    $girl = '';
                }

                //возраст  максимального поиска меньше возраста пользователя
                if ($user_info['age'] > $girl['max_age']) {
                    $girl = '';
                }

            }
        }

        //свои параметри неверны  возраст минимальныый больше максимального
        if ($user_info['min_age'] > $user_info['max_age']) {
            $girl = '';
        }


        if ($girl['id'] == '') {
            $db->setSearchGirl($chatid, time());
            $msg->replyHTML($json['text']['поиск'], $search_dialog_btn);
        } else {
            $db->setCompanion($girl['user_id'], $chatid);
            $db->setCompanion($chatid, $girl['user_id']);

            $db->setSearchBoy($girl['user_id'], 0);
            $db->setSearchGirl($girl['user_id'], 0);

            clearCache($mem, $girl['user_id']);
            $msg->sendHTML($girl['user_id'], $json['text']['найден'], $dialog_btn);
            $msg->replyHTML($json['text']['найден'], $dialog_btn);
        }
        clearCache($mem, $chatid);
        exit();
    }
}