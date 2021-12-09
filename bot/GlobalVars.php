<?php

$gender_btn = $bt->inlineButtons([
    [
        $json['inline']['парень'] => 'set_gender/boy'
    ],
    [
        $json['inline']['девушка'] => 'set_gender/girl'
    ]
]);

$gender_btn_filter = $bt->inlineButtons([
    [
        $json['inline']['парня'] => 'set_gender/boy'
    ],
    [
        $json['inline']['девушку'] => 'set_gender/girl'
    ]
]);

$btn_menu = $bt->keyButtons([
    [
        $json['buttons']['случайный'] => ''
    ],
   [
        $json['buttons']['фильтр'] => ''
    ],
    [
        $json['buttons']['статистика'] => '',
        $json['buttons']['анкета'] => ''
    ],
    [
        $json['buttons']['знакомства'] => ''
    ]
]);


$dating_menu_btn = $bt->keyButtons([
    [
        $json['buttons']['анкета-dating'] => '',
        $json['buttons']['фильтр-dating'] => '',
    ],
    [
        $json['buttons']['вопросы и ответы от вас'] => ''
    ],
    [
        $json['buttons']['встречи'] => '',
        $json['buttons']['подарки'] => '',
        $json['buttons']['чат'] => ''
    ],
    [
        $json['buttons']['анонимное общение'] => ''
    ]
]);

$search_dialog_btn = $bt->keyButtons([
    [
        $json['buttons']['завершить'] => ''
    ]
]);

$btn_invite = $bt->inlineButtons([
    [
        $json['inline']['пригласить'] => 'https://t.me/share/url?url=https://t.me/RuGenChatBot?start=' . $chatid . '&text=Зацени'
    ]
]);

$dialog_btn = $bt->keyButtons([
    [
        $json['buttons']['деанон'] => ''
    ],
    [
        $json['buttons']['завершить'] => ''
    ]
]);

$what_btn = $bt->inlineButtons([
    [
        $json['inline']['почему'] => 'profile_photo_what'
    ]
]);

$keyb_cancel = $bt->keyButtons([
    [
        $json['buttons']['отмена'] => ''
    ]
]);

$goal_communication_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['цель общение'] => 'set_goal_communication_dating/1'
    ],
    [
        $json['inline-dating']['цель дружба'] => 'set_goal_communication_dating/2'
    ],
    [
        $json['inline-dating']['цель семья'] => 'set_goal_communication_dating/3'
    ],
    [
        $json['inline-dating']['цель нет в списке'] => 'set_goal_communication_dating/4'
    ],
    [
		$json['inline-dating']['цель всё'] => 'set_goal_communication_dating/5'
    ]
]);

$children_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['дети нет'] => 'set_children_dating/1'
    ],
    [
        $json['inline-dating']['дети рано'] => 'set_children_dating/2'
    ],
    [
        $json['inline-dating']['дети хочется'] => 'set_children_dating/3'
    ],
    [
        $json['inline-dating']['дети есть и хочу ещё'] => 'set_children_dating/4'
    ],
    [
        $json['inline-dating']['дети есть больше не хочу'] => 'set_children_dating/5'
    ],
    [
        $json['inline-dating']['дети не имеет значения'] => 'set_children_dating/6'
    ]
]);

$find_country_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['страна поиска украина'] => 'set_find_country/1'
    ],
    [
        $json['inline-dating']['страна поиска беларусь'] => 'set_find_country/2'
    ],
    [
        $json['inline-dating']['страна поиска россия'] => 'set_find_country/3'
    ],
    [
        $json['inline-dating']['страна поиска молдова'] => 'set_find_country/4'
    ],
    [
        $json['inline-dating']['страна поиска все страны мира'] => 'set_find_country/5'
    ]
]);

$present_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['подарок утреннее кофе'] => 'set_present_dating/1'
    ],
    [
        $json['inline-dating']['подарок пицца'] => 'set_present_dating/2'
    ],
    [
        $json['inline-dating']['подарок салон красоты'] => 'set_present_dating/3'
    ],
    [
        $json['inline-dating']['подарок на мечту'] => 'set_present_dating/4'
    ]
]);


$skip_upload_photos_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['фото пропустить загрузку фото'] => 'skip_upload_photos'
    ]
]);

$skip_upload_photos_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['фото пропустить загрузку фото'] => 'skip_upload_photos'
    ]
]);


$skip_upload_video_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['видео пропустить загрузку видео'] => 'skip_upload_video'
    ]
]);

$profile_btn_dating = $bt->keyButtons([
    [
        $json['buttons']['просмотреть анкету'] => '',
        $json['buttons']['изменить анкету'] => ''
    ],
    [
        $json['buttons']['удалить анкету'] => '',
        $json['buttons']['изменить фото'] => ''
    ],
    [
        $json['buttons']['знакомства'] => ''
    ]
]);

$keyb_cancel_profile_btn_dating = $bt->keyButtons([
    [
        $json['buttons']['анкета возврат меню'] => ''
    ]
]);
$keyb_cancel_back_main_menu_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['возрат в меню знакомства'] => 'back-main-menu-dating',
    ],

]);
$keyb_comment_main_menu_btn_dating = $bt->inlineButtons([
    [
        $json['inline-dating']['комментарий написать комментарий'] => 'comment-main-menu-dating/',
    ],
    [
        $json['inline-dating']['возрат в меню знакомства'] => 'back-main-menu-dating'
    ]
]);


$back_main_menu_btn_dating = $bt->keyButtons([
    [
        $json['buttons']['меню знакомства возрат в меню знакомства'] => ''
    ]
]);


$meeting_btn_dating = $bt->keyButtons([
    [
        $json['buttons']['поиск-meeting'] => '',
        $json['buttons']['фильтр-meeting'] => ''
    ],
    [
        $json['buttons']['знакомства'] => '',
        $json['buttons']['создать-meeting'] => ''
    ]
]);

$keyb_cancel_meeting_btn_meeting = $bt->keyButtons([
    [
        $json['buttons']['meeting возврат меню встречи'] => ''
    ]
]);

$question_answer_dating_btn_dating = $bt->keyButtons([
    [
        $json['buttons']['question-answer-dating вопросы для девушек'] => '',
    ],
    [
        $json['buttons']['question-answer-dating вопросы для парней'] => ''
    ],
    [
        $json['buttons']['question-answer-dating задать вопрос'] => '',
    ],
    [
        $json['buttons']['question-answer-dating мои вопросы'] => '',
    ],
    [
        $json['buttons']['знакомства'] => '',
    ]
]);

$gender_question_answer_dating_btn_dating = $bt->inlineButtons([
    [
        $json['inline-question-answer-dating']['парням'] => 'set_gender_question_answer/boy'
    ],
    [
        $json['inline-question-answer-dating']['девушкам'] => 'set_gender_question_answer/girl'
    ]
]);

$back_main_menu_question_answer_dating_btn_dating = $bt->keyButtons([
    [
        $json['buttons']['question-answer-dating возрат в меню вопроса'] => ''
    ]
]);

$keyb_cancel_create_ask_question_question_answer_dating_btn_dating = $bt->keyButtons([
    [
        $json['buttons']['question-answer-dating возврат меню вопросы'] => ''
    ]
]);