<?php
//error_reporting(0);

//$data = file_get_contents('php://input');
//$data = json_decode($data, true);
//ob_start();
//print_r($data);
//$out = ob_get_clean();
//file_put_contents(__DIR__ . '/message.txt', $out);


require_once (__DIR__ . '/init.php');
require_once (__DIR__ . '/App/DBManager/DBManager.php');
require_once (__DIR__ . '/App/Crypto/Crypto.php');
require_once (__DIR__ . '/App/Lang/Lang.php');
require_once (__DIR__ . '/App/Security/Security.php');
require_once (__DIR__ . '/App/Modules/Webhook/Webhook.php');
require_once (__DIR__ . '/App/Modules/Formatter/Formatter.php');
require_once (__DIR__ . '/App/Modules/Buttons/Buttons.php');
require_once (__DIR__ . '/App/Modules/Notifications/Notifications.php');
require_once (__DIR__ . '/App/Modules/Messages/Messages.php');
require_once (__DIR__ . '/App/Modules/Referrals/Referrals.php');


//телега
$tg = new Telegram($token);
//модуль отправки сообщений
$msg = new Messages($tg);
//Модуль защиты от флуда и спама
$securityFlood = new App\Security\Security($tg);
if (!$securityFlood->FloodControlMemCached() ) {
//    $msg->sendHTML('394296212', 'Флуд!!');
    exit();//выходим если это флуд!
    //$msg->sendHTML('394296212', 'Флуд!!');
}

//MySQL
$db = new MysqliDb(DB_HOST, DB_LOGIN, DB_PSWD, DB_NAME, 3306, 'utf8mb4');
$db = new DBManager($db);
//модуль одноразовой установки вебхука
$wb = new Webhook($tg);
//модуль создания кнопок
$bt = new Buttons($tg);
//модуль увндомлений
$notification = new Notifications($tg);
//формирование entity в html разметку
$formatter = new Formatter();

$object = $tg->getData();
$chatid = $tg->ChatID();
$message = $tg->Text();
$name = $tg->FirstName();
$username = $tg->Username();
$message_id = $tg->MessageID();
$data = $tg->Callback_Data();
$location = $tg->Location();
if (isset($location)) {
    $long = $location['longitude'];
    $lat = $location['latitude'];
}
$title = $object['channel_post']['chat']['title'];
$type = $object['channel_post']['chat']['type'];
$channel_username = $object['channel_post']['chat']['username'];
$callback_id = $tg->Callback_ID();
$entities = $object['message']['entities'];
/*--- PHOTO ID ---*/
$photo_id = $object['message']['photo'];
if (is_array($photo_id)) {
    $photo_id = array_pop($photo_id);
}
$photo_id = $photo_id['file_id'];
//if ($photo_id != '') $msg->sendHTML('394296212', $photo_id);
/*--- PHOTO ID ---*/

/*--- AUDIO ID ---*/

$music_id = $object['message']['audio'];

$music_id = $music_id['file_id'];

/*--- VIDEO ID ---*/
$video_id = $object['video']['file_id'];

$video_id = $video_id['file_id'];

$video_id = $object['message']['video']['file_id'];
/*--- VIDEO ID ---*/
//if ($video_id != '') $msg->sendHTML('394296212', $video_id);
//if ($video_id != '') $msg->sendHTML('394296212', $video_id);

/*--- VIDEO NOTE ID ---*/
$video_note_id = $object['message']['video_note']['file_id'];
/*--- VIDEO NOTE ID ---*/

/*--- STICKER ID ---*/
$sticker_id = $object['message']['sticker']['file_id'];
/*--- STICKER ID ---*/

/*--- ANIMATION ID ---*/
$animation_id = $object['message']['animation']['file_id'];
/*--- ANIMATION ID ---*/

/*--- AUDIO ID ---*/
$audio_id = $object['message']['audio']['file_id'];
/*--- AUDIO ID ---*/

/*--- VOICE ID ---*/
$voice_id = $object['message']['voice']['file_id'];
/*--- VOICE ID ---*/

/*--- DOCUMENT ID ---*/
$document_id = $object['message']['document']['file_id'];
/*--- DOCUMENT ID ---*/
$phone_vcard = $object['message']['contact']['vcard'];
/*--- VIDEO ID ---*/
$phone_id = $object['message']['contact']['phone_number'];

$phone_message_bot_unic_id = $object['message']['reply_to_message']['from']['id'];
$caption = $tg->Caption();
$chat_id_response = $object['callback_query']['from']['id'];
//USER INFO
$user_info = memcache_get($mem, 'user_info_' . $chatid);
if (empty($user_info) && stripos($chatid, '-') === false) {
    $user_info = $db->getUserInfo($chatid);
    memcache_set($mem, 'user_info_' . $chatid, $user_info, MEMCACHE_COMPRESSED, 30);
}

//USER INFO dating
$user_infodating = memcache_get($mem, 'user_info_dating_' . $chatid );
if (empty($user_infodating) && stripos($chatid, '-') === false) {
    $user_infodating = $db->getUserInfoDating($chatid);
    memcache_set($mem, 'user_info_dating_' . $chatid, $user_infodating, MEMCACHE_COMPRESSED, 30);
}

//if ($chatid != ADMIN_ID) exit();


if (empty($entities)) {
    $entities = $object['message']['caption_entities'];
}

if ($channel_username == '') $channel_username = 'none';

//полчение языкового выбора
try {
    $local = new Lang('ru');
    $json = $local->getLang();
} catch (Exception $e) { }

$new_user = false;
if ($user_info['user_id'] != $chatid && stripos($chatid, '-') === false ) {
    $new_user = true;
    $db->addUser($chatid);
}

//анкета знакомства
$new_user_dating = false;
if ($user_infodating['user_id'] != $chatid && stripos($chatid, '-') === false &&  $message == $json['buttons']['знакомства'] ) {
    $new_user_dating = true;
    $db->addUserDating($chatid,$user_info['gender'],$user_info['age'],$user_info['username']);
}

if ($username == '') $username = 'NaN';
if ($user_info['username'] != $username && $user_info['username'] != 'NaN') {
    $db->setUsername($chatid, $username);
}

$cmd = $user_info['cmd'];
if (isset($cmd)) $cmd = explode('/', $cmd);

//анкета знакомства
$cmddating = $user_infodating['cmd'];
if (isset($cmddating)) $cmddating = explode('/', $cmddating);

$message_arr = '';
if (isset($message)) $message_arr = explode(' ', $message);
if (is_array($message_arr) && $message_arr[1] != '' && $message_arr[0] == '/start') {
    $message = '/start';
    $ref_id = $message_arr[1];
}

if (time() - $user_info['last_update'] >= 1170 ) {
    $db->setLastUpdate($chatid, time()); //устанавливаем последнюю активность
}

if (empty($data)) $data = $object['callback_query']['data'];
if (!empty($data)) $data = explode('/', $data);

if ($user_info['ban'] == 1)
{
    $msg->replyHTML($local->getResponse('ban.txt'));
    exit();
}

//includes Global Vars
require (__DIR__ . '/GlobalVars.php');
require_once (__DIR__ . '/App/Components/message/Dating.php');
//подключаение компонентов
//START SYS
require_once (__DIR__ . '/App/Components/message/ShowProfileDating/BackMenuProfileDatingShow.php');

require_once (__DIR__ . '/App/Components/data/set_number.php');

require_once (__DIR__ . '/App/Components/data/set_gender.php');
require_once (__DIR__ . '/App/Components/message/SetAge.php');

require_once (__DIR__ . '/App/Components/message/start.php');
require_once (__DIR__ . '/App/Components/message/Statistic.php');
require_once (__DIR__ . '/App/Components/message/Cancel.php');


require_once (__DIR__ . '/App/Components/message/filter/Filter.php');
require_once (__DIR__ . '/App/Components/message/filter/SetGenderFilter.php');
require_once (__DIR__ . '/App/Components/message/filter/SetAgeMinFilter.php');
require_once (__DIR__ . '/App/Components/message/filter/SetAgeMaxFilter.php');


require_once (__DIR__ . '/App/Components/message/SearchRnd.php');
require_once (__DIR__ . '/App/Components/message/SearchBoy.php');
require_once (__DIR__ . '/App/Components/message/SearchGirl.php');

require_once (__DIR__ . '/App/Components/message/MyProfile.php');
require_once (__DIR__ . '/App/Components/data/edit_profile.php');
require_once (__DIR__ . '/App/Components/message/EditProfile.php');
require_once (__DIR__ . '/App/Components/data/profile_photo_what.php');

require_once (__DIR__ . '/App/Components/message/Rules.php');

require_once (__DIR__ . '/App/Components/message/DeAnon.php');
require_once (__DIR__ . '/App/Components/message/CloseDialog.php');
require_once (__DIR__ . '/App/Components/data/rate.php');

require_once (__DIR__ . '/App/Components/data/different_layout.php');
require_once (__DIR__ . '/App/Components/message/Dialog.php');

require_once (__DIR__ . '/App/Components/message/Admin/mailing.php');

require_once (__DIR__ . '/App/Components/message/Admin/MenuUser.php');
require_once (__DIR__ . '/App/Components/data/Admin/menu_user.php');
require_once (__DIR__ . '/App/Components/message/Admin/AllUser.php');

require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetNameDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetCountyDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetCityDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetGoalCommunicationDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetChildrenDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetPresentDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetFindCountryDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetEmailDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetContactAddressDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetPhotoDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetPhotoTwoDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetPhotoThreeDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetVideoDating.php');
require_once (__DIR__ . '/App/Components/message/CreateProfileDating/SetMusicDating.php');

require_once (__DIR__ . '/App/Components/message/ProfileDating/BackMenuBtnProfileDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/MyDatingProfile.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/DatingProfile.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/DeleteDatingProfile.php');

//изменение фото видео
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditMediaProfileDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditMediaHendler/EditProfilePhotoVideoDataDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditMediaHendler/EditProfilePhotoVideoDating.php');

//изменение данных анкеты
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditNameDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditCountyDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditCityDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditGoalCommunicationDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditChildrenDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditPresentDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditFindCountryDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditEmailDating.php');
require_once (__DIR__ . '/App/Components/message/ProfileDating/EditProfileDating/EditContactAddressDating.php');

require_once (__DIR__ . '/App/Components/message/BackBtnMenu.php');


require_once (__DIR__ . '/App/Components/message/ShowProfileDating/SwitchProfileDatingShow.php');
require_once (__DIR__ . '/App/Components/message/ShowProfileDating/FullProfileDatingShow.php');
require_once (__DIR__ . '/App/Components/message/ShowProfileDating/CommentsProfileDatingShow.php');
require_once (__DIR__ . '/App/Components/message/ShowProfileDating/PresentProfileDatingShow.php');
require_once (__DIR__ . '/App/Components/message/ShowProfileDating/CommentWriteProfileDatingShow.php');
require_once (__DIR__ . '/App/Components/message/ShowProfileDating/CommentSendProfileDatingShow.php');
require_once (__DIR__ . '/App/Components/message/ShowProfileDating/LikeProfileDatingShow.php');
require_once (__DIR__ . '/App/Components/message/ShowProfileDating/MessageProfileDatingShow.php');


require_once(__DIR__ . '/App/Components/message/FilterProfileDating/DatingFilter.php');
require_once(__DIR__ . '/App/Components/message/FilterProfileDating/SetGenderDatingFilter.php');
require_once(__DIR__ . '/App/Components/message/FilterProfileDating/SetAgeMinDatingFilter.php');
require_once(__DIR__ . '/App/Components/message/FilterProfileDating/SetAgeMaxDatingFilter.php');
require_once(__DIR__ . '/App/Components/message/FilterProfileDating/SetGoalCommunicationDatingFilter.php');
require_once(__DIR__ . '/App/Components/message/FilterProfileDating/SetChildrenDatingFilter.php');
require_once(__DIR__ . '/App/Components/message/FilterProfileDating/SetFindCountryDatingFilter.php');


require_once(__DIR__ . '/App/Components/message/Meeting/BackMenuBtnProfileMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/MeetingProfile.php');
require_once(__DIR__ . '/App/Components/message/Meeting/CreateProfileMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/CreateProfileMeeting/SetNameMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/CreateProfileMeeting/SetAgeMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/CreateProfileMeeting/SetCityMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/CreateProfileMeeting/SetGoalCommunicationMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/CreateProfileMeeting/SetVideoMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/SearchProfileMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/MessageProfileMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/SwitchProfileMeeting.php');
require_once(__DIR__ . '/App/Components/message/Meeting/DeleteMeetingProfile.php');


require_once(__DIR__ . '/App/Components/message/Meeting/FilterProfileMeeting/MeetingFilter.php');
require_once(__DIR__ . '/App/Components/message/Meeting/FilterProfileMeeting/SetAgeMinMeetingFilter.php');
require_once(__DIR__ . '/App/Components/message/Meeting/FilterProfileMeeting/SetAgeMaxMeetingFilter.php');
require_once(__DIR__ . '/App/Components/message/Meeting/FilterProfileMeeting/SetCityMeetingFilter.php');


require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/BackMenuBtnCreateAskQuestionQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/MenuQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/MyQuestionQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/DeleteMyQuestionQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/QuestionForGirl/QuestionForGirlQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/QuestionForBoy/QuestionForBoyQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/LikeQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/DislikeQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/BackMenuQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/CommentsQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/CommentWriteQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/CommentSendQuestionAnswerDating.php');

require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/MessageQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/SwitchQuestionAnswerDating.php');



require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/AskQuestion/CreateAskQuestionQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/AskQuestion/SetGenderQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/AskQuestion/SetVideoQuestionAnswerDating.php');
require_once(__DIR__ . '/App/Components/message/QuestionAnswerDating/AskQuestion/SetAskQuestionQuestionAnswerDating.php');