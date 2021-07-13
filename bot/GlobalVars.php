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


$btndating_menu = $bt->keyButtons([
     [
        $json['buttons']['анкета-dating'] => '',
        $json['buttons']['фильтр-dating'] => ''
    ],
    [
        $json['buttons']['приколы'] => '',
        $json['buttons']['встречи'] => ''
    ],
    [
        $json['buttons']['основнойбот'] => '',
        $json['buttons']['форум'] => ''
    ],
    [
        $json['buttons']['назад'] => '',
        $json['buttons']['подарок'] => '',
        $json['buttons']['чат'] => '',
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