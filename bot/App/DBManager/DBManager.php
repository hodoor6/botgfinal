<?php

class DBManager
{
    public $db;

    public function __construct(MysqliDb $db)
    {
        $this->db = $db;
    }

    public function isUser($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        if (isset($result['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function setToCloseDialogCron($user_id)
    {
        $db = $this->db;
        $content = array('cmd' => '', 'companion' => 0, 'search_rnd' => 0, 'search_boy' => 0,
            'search_girl' => 0);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    //метод ищет диалоги которые долго ищут напарника(девушка)
    public function getClosedDialogsGirl($time)
    {
        $db = $this->db;
        $db->where('search_girl', '0', '!=');
        $res = $db->where('search_girl', $time, '<=')->get('users');
        return $res;
    }

    //метод ищет диалоги которые долго ищут напарника(парень)
    public function getClosedDialogsBoy($time)
    {
        $db = $this->db;
        $db->where('search_boy', '0', '!=');
        $res = $db->where('search_boy', $time, '<=')->get('users');
        return $res;
    }

    //метод ищет диалоги которые долго ищут напарника(парень)
    public function getClosedDialogsRnd($time)
    {
        $db = $this->db;
        $db->where('search_rnd', '0', '!=');
        $res = $db->where('search_rnd', $time, '<=')->get('users');
        return $res;
    }

    public function getUserInfo($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result;
    }

    public function getUserInfoByUserName($username)
    {
        $db = $this->db;
        $result = $db->where('username', $username)->getOne('users');
        return $result;
    }

    public function addUser($user_id)
    {
        $db = $this->db;
        $content = array('user_id' => $user_id, 'username' => '', 'cmd' => '', 'age' => 0, 'gender' => 0,
            'last_update' => 0, 'country' => '', 'city' => '', 'photo_profile' => '', 'rating' => 0);
        $id = $db->insert('users', $content);
        return $id;
    }

    public function getUsername($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['username'];
    }

    public function setUsername($user_id, $username)
    {
        $db = $this->db;
        $content = array('username' => $username);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function getRating($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['rating'];
    }

    public function setRating($user_id, $rating)
    {
        if (stripos($rating, '.') !== false) {
            $rating = explode('.', $rating);
            $rating[1] = substr($rating[1], 0, 2);
            $rating = implode('.', $rating);
        }
        $db = $this->db;
        $content = array('rating' => $rating);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function setCountChats($user_id, $c)
    {
        $db = $this->db;
        $content = array('count_chats' => $c);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function getAge($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['age'];
    }

    public function setAge($user_id, $age,$table = 'users')
    {
        $db = $this->db;
        $content = array('age' => $age);
        $db->where('user_id', $user_id)->update($table, $content);
    }


	
    public function getRefer($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['refer'];
    }

    public function setRefer($user_id, $refer)
    {
        $db = $this->db;
        $content = array('refer' => $refer);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function getVipDay($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['vip_day'];
    }

    public function setVipDay($user_id, $vip_day)
    {
        $db = $this->db;
        $content = array('vip_day' => $vip_day);
        $db->where('user_id', $user_id)->update('users', $content);
    }


    public function getCompanion($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['companion'];
    }

    public function setCompanion($user_id, $companion)
    {
        $db = $this->db;
        $content = array('companion' => $companion);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function setSearchRnd($user_id, $date)
    {
        $db = $this->db;
        $content = array('search_rnd' => $date);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function setSearchBoy($user_id, $date)
    {
        $db = $this->db;
        $content = array('search_boy' => $date);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function setSearchGirl($user_id, $date)
    {
        $db = $this->db;
        $content = array('search_girl' => $date);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    public function SearchRnd()
    {
        $db = $this->db;
        $db->where('search_rnd', '0', '!=');
        $res = $db->orderBy('search_rnd', 'Asc')->get('users');
        return $res;
    }

    public function SearchBoy()
    {
        $db = $this->db;
        $db->where('search_boy', '0', '!=');
        $res = $db->orderBy('search_boy', 'Asc')->get('users');
        return $res;
    }

    public function SearchGirl()
    {
        $db = $this->db;
        $db->where('search_girl', '0', '!=');
        $res = $db->orderBy('search_girl', 'Asc')->get('users');
        return $res;
    }

    public function getLastUpdate($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['last_update'];
    }

    public function setLastUpdate($user_id, $time = '')
    {
        if (empty($time)) $time = time();
        $db = $this->db;
        $content = array('last_update' => $time);
        $db->where('user_id', $user_id)->update('users', $content);
    }
   //получения номера телефона
    public function setPhone($user_id, $phone_id)
    {
        $db = $this->db;
        $content = array('phone_profile' => $phone_id);
        $db->where('user_id', $user_id)->update('users', $content);
    }

    //date = 2020-07-02
    public function getCountNewUsersNowDay($date)
    {
        $db = $this->db;
        $res = $db->where('register_date', $date, '>=')->getValue('users', 'count(*)');
        return $res;
    }

    public function getCountUsersOnline($timestamp)
    {
        $db = $this->db;
        $res = $db->where('last_update', $timestamp, '>=')->get('users');
        return count($res);
    }

    public function countUsers()
    {
        $db = $this->db;
        $res = $db->getValue ("users", "count(*)");
        return $res;
    }



    public function getBan($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['cmd'];
    }

    public function setBan($user_id, $cmd)
    {
        $db = $this->db;
        $content = array('ban' => $cmd);
        $db->where('user_id', $user_id)->update('users', $content);
    }




    //метод обнуляет кол-во чатов до 0
    public function CountChatsNull()
    {
        $db = $this->db;
        $db->update('users', array('count_chats' => 0));
    }

    public function getGender($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['gender'];
    }

    public function setGender($user_id, $gender)
    {
        $db = $this->db;
        $content = array('gender' => $gender);
        $db->where('user_id', $user_id)->update('users', $content);
    }


    public function getRegDate($user_id)
    {
        $db = $this->db;
        $res = $db->where('user_id', $user_id)->getOne('users');
        return $res['register_date'];
    }

    public function getAllUsersByLang($lang)
    {
        $db = $this->db;
        $res = $db->where('lang', $lang)->get('users');
        return $res;
    }

    public function countAllUsersByLang($lang)
    {
        $db = $this->db;
        $res = $db->where('lang', $lang)->getValue('users', 'count(*)');
        return $res;
    }

    public function getAllUsers()
    {
        $db = $this->db;
        $res = $db->get('users');
        return $res;
    }

    //GEO
    public function isCity($name)
    {
        $db = $this->db;
        $db->where('city', $name);
        $res = $db->getOne('geo');
        if (empty($res['id'])) {
            return false;
        }
        return true;
    }

    //получаем ближайшую страну по координатам
    public function getCountryByCoordinates($lat, $lng)
    {
        $db = $this->db;
        $query = "SELECT country, ( 3959 * acos( cos( radians(?) ) * cos( radians( lat ) )
            * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin(radians(lat)) ) ) AS distance 
FROM geo
HAVING distance < 50
ORDER BY distance LIMIT 1";
        $res = $db->rawQuery($query, [$lat, $lng, $lat]);
        return $res[0]['country'];
    }

    //получаем ближайший город по координатам
    public function getCityByCoordinates($lat, $lng)
    {
        $db = $this->db;
        $query = "SELECT city, ( 3959 * acos( cos( radians(?) ) * cos( radians( lat ) )
            * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin(radians(lat)) ) ) AS distance 
FROM geo
HAVING distance < 50
ORDER BY distance LIMIT 1";
        $res = $db->rawQuery($query, [$lat, $lng, $lat]);
        return $res[0]['city'];
    }
	
	    public function getUserInfoDating($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('dating_users');
        return $result;
    }

    public function addUserDating($user_id,$gender,$age,$username)
    {
        $db = $this->db;
        $content = array('user_id' => $user_id, 'username' => $username, 'cmd' => '', 'age' => $age, 'gender' => $gender,
            'last_update' => 0, 'country' => '', 'city' => '', 'photo_profile' => '', 'rating' => 0,'reg_status'=> 1);
        $id = $db->insert('dating_users', $content);
        return $id;
    }
	
	    public function getCmd($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('users');
        return $result['cmd'];
    }

    public function setCmd($user_id, $cmd,$table='users')
    {
        $db = $this->db;
        $content = array('cmd' => $cmd);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function setCity($user_id, $city,$table='users')
    {
        $db = $this->db;
        $content = array('city' => $city);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function setCountry($user_id, $country,$table='users')
    {
        $db = $this->db;
        $content = array('country' => $country);
        $db->where('user_id', $user_id)->update($table, $content);
    }

// получение имени пользователя
    public function getName($user_id,$table='dating_users')
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne($table);
        return $result['name'];
    }

    public function setName($user_id, $name,$table='dating_users')
    {
        $db = $this->db;
        $content = array('name' => $name);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    //удаление пользователя
    public function deleteUser($user_id,$table='dating_users')
    {
        $db = $this->db;
        $db->where('user_id', $user_id)->delete($table,1);
    }

// статус регестрации для знакомст


    public function getRegStatus($user_id,$table='dating_users')
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne($table);
        return $result['reg_status'];
    }


    public function setRegStatus($user_id, $status,$table='dating_users')
    {
        $db = $this->db;
        $content = array('reg_status' => $status);
        $db->where('user_id', $user_id)->update($table, $content);
    }
    public function setGoalCommunication($user_id, $goal,$table='dating_users')
    {
        $db = $this->db;
        $content = array('goal_communication' => $goal);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function setChildren($user_id, $children,$table='dating_users')
    {
        $db = $this->db;
        $content = array('children' => $children);
        $db->where('user_id', $user_id)->update($table, $content);
    }
    public function setPresent($user_id, $present,$table='dating_users')
    {
        $db = $this->db;
        $content = array('present' => $present);
        $db->where('user_id', $user_id)->update($table, $content);
    }
// в какой стране хотят найти собеседника
    public function setFindCountry($user_id, $country,$table='dating_users')
    {
        $db = $this->db;
        $content = array('find_country' => $country);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function setEmail($user_id, $email,$table='dating_users')
    {
        $db = $this->db;
        $content = array('email' => $email);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function setContactAddress ($user_id, $contactaddress,$table='dating_users')
    {
        $db = $this->db;
        $content = array('contact_address' => $contactaddress);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function setPhotoProfile($user_id, $photo,$table='users')
    {
        $db = $this->db;
        $content = array('photo_profile' => $photo);
        $db->where('user_id', $user_id)->update($table, $content);
    }
    public function setPhotoProfileTwo($user_id, $photo,$table='dating_users')
    {
        $db = $this->db;
        $content = array('photo_profile_two' => $photo);
        $db->where('user_id', $user_id)->update($table, $content);
    }
    public function setPhotoProfileThree($user_id, $photo,$table='dating_users')
    {
        $db = $this->db;
        $content = array('photo_profile_three' => $photo);
        $db->where('user_id', $user_id)->update($table, $content);
    }


    public function setVideoProfile($user_id, $video,$table='dating_users')
    {
        $db = $this->db;
        $content = array('video_profile' => $video);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function setMusicProfile($user_id, $music,$table='dating_users')
    {
        $db = $this->db;
        $content = array('music_profile' => $music);
        $db->where('user_id', $user_id)->update($table, $content);
    }


/* 
    public function getAllUsersDating($table = 'dating_users')
    {
        $db = $this->db;
        $res = $db->get($table);
        return $res;
    } */


//    public function getAllUsersDating($table = 'dating_users')
//    {
//        $db = $this->db;
//        $res = $db->get($table);
//        return $res;
   // }
   

public function getAllUsersDating($gender_filter = 0,$min_age = 0, $max_age = 0, $goal = '', $children = '', $country = '',$table = 'dating_users')
    {
        $db = $this->db;
           if ($min_age !== 0) {
            $db->where('gender', $gender_filter, '=');
        }

        if ($min_age !== 0) {
            $db->where('age', $min_age, '>=');
        }
        if ($max_age !== 0) {
            $db->where('age', $max_age, '<=');
        }
        if ($goal !== ''&& $goal !=='Всё') {
            $db->where('goal_communication', $goal, '=');
        }

        if ($goal == 'Всё') {
            $$goal = 1;
            $db->where('id', $goal, '>');
        }
	
        if ($children !== ''&& $children !=='Не имеет значения') {
            $db->where('children', $children, '=');
        }
        if ($children == 'Не имеет значения') {
            $children = 1;
            $db->where('id', $children, '>');
        }
        if ($country !== '' && $country !=='Все страны мира' ) {
            $db->where('country', $country, '=');
        }

        if ( $country =='Все страны мира' ) {
            $country = 1;
            $db->where('id', $country, '>');
        }

        $res = $db->get($table);
        //  $res =    $db->where('search_rnd', '0', '!=')->get('users');
//        $db->where('gender_filter', 'gender', '=');
//        $res = $db->orderBy('search_rnd', 'Asc')->get('users');
    return $res;

    }


    public function getPaginationDating($user_id, $table = 'dating_users')
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne($table);
        return $result['pagination_dating'];
    }

    public function setPaginationDating($user_id, $pagination, $table = 'dating_users')
    {
        $db = $this->db;
        $content = array('pagination_dating' => $pagination);
        $db->where('user_id', $user_id)->update($table, $content);
    }



    public function getCommentsDating($user_id, $table = 'dating_comments')
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->get($table);
        return $result;
    }

    public function setCommentsDating($user_id, $name, $age, $comment, $comm_user_id, $table = 'dating_comments')
    {
        $db = $this->db;
        $content = array('user_id' => $user_id, 'name' => $name, 'age' => $age, 'comment' => $comment, 'user_id_companion' => $comm_user_id);
        $db->insert($table, $content);
    }

    

    public function getPresent($user_id, $table = 'dating_users')
    {

        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne($table);
        return $result['present'];
    }

    public function getCmdDating($user_id, $table = 'dating_users')
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne($table);
        return $result['cmd'];
    }


    public function countCommentDating($user_id,$table = 'dating_comments',$table1='dating_users')
    {
        $db = $this->db;
        $res = $db->where('user_id', $user_id)->getValue($table, 'count(*)');
        $content = array('count_comment' => $res);
        $db->where('user_id', $user_id)->update($table1, $content);
    }
    public function isLikeDating($user_id, $comm_user_id, $table = 'dating_like')
    {
        $db = $this->db;
        $db->where('user_id', $user_id);
        $result = $db->where('user_id_companion', $comm_user_id)->getOne($table);


        if (isset($result['id'])) {
            return true;
        } else {
            return false;
        }

    }

    public function setLikeDating($user_id,  $comm_user_id, $table = 'dating_like')
    {
        $db = $this->db;
        $content = array('user_id' => $user_id, 'user_id_companion' => $comm_user_id);
        $db->insert($table, $content);
    }


    public function countLikeDating($user_id,$table = 'dating_like',$table1='dating_users')
    {
        $db = $this->db;
        $res = $db->where('user_id', $user_id)->getValue($table, 'count(*)');
        $content = array('count_like' => $res);
        $db->where('user_id', $user_id)->update($table1, $content);
    }
	 
   
    // установка пола для

     public function setGenderFilter($user_id, $gender, $table = 'users')
    {
        $db = $this->db;
        $content = array('gender_filter' => $gender);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    //установка возраста минимального для фильтра

    public function setAgeMinFilter($user_id, $age, $table = 'users')
    {
        $db = $this->db;
        $content = array('min_age' => $age);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    //установка возраста максимального для фильтра

    public function setAgeMaxFilter($user_id, $age, $table = 'users')
    {
        $db = $this->db;
        $content = array('max_age' => $age);
        $db->where('user_id', $user_id)->update($table, $content);
    }


    public function setGoalCommunicationFilter($user_id, $goal, $table = 'dating_users')
    {
        $db = $this->db;
        $content = array('goal_communication_filter' => $goal);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function setChildrenFilter($user_id, $children, $table = 'dating_users')
    {
        $db = $this->db;
        $content = array('children_filter' => $children);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    // в какой стране хотят найти собеседника
    public function setFindCountryFilter($user_id, $country, $table = 'dating_users')
    {
        $db = $this->db;
        $content = array('find_country_filter' => $country);
        $db->where('user_id', $user_id)->update($table, $content);
    }


    public function getAllUsersDatingFilter($min_age = 0, $max_age = 0, $goal = '', $children = '', $country = '')
    {
        $db = $this->db;
        // $db->where('gender', $gender_filter, '=');
        if ($min_age !== 0) {
            $db->where('age', $min_age, '>=');
        }
        if ($max_age !== 0) {
            $db->where('age', $max_age, '<=');
        }
        if ($goal !== '') {
            $db->where('goal_communication', $goal, '=');
        }
        if ($children !== '') {
            $db->where('children', $children, '=');
        }
        if ($country !== '') {
            $db->where('find_country', $country, '=');
        }

        $res = $db->get('dating_users');
        //  $res =    $db->where('search_rnd', '0', '!=')->get('users');
//        $db->where('gender_filter', 'gender', '=');
//        $res = $db->orderBy('search_rnd', 'Asc')->get('users');
        return $res;
    }

    public function addUserMeeting($user_id, $gender, $username)
    {
        $db = $this->db;
        $content = array('user_id' => $user_id, 'username' => $username, 'cmd' => '', 'age' => '', 'gender' => $gender,
            'last_update' => 0, 'country' => '', 'city' => '', 'rating' => 0, 'reg_status' => 1);
        $id = $db->insert('meeting_users', $content);
        //return $id;
    }



    public function setCityFilter($user_id, $city, $table = 'meeting_users')
    {
        $db = $this->db;
        $content = array('city_filter' => $city);
        $db->where('user_id', $user_id)->update($table, $content);
    }

    public function getUserInfoMeeting($user_id)
    {
        $db = $this->db;
        $result = $db->where('user_id', $user_id)->getOne('meeting_users');
        return $result;
    }


    public function getAllUsersMeeting($min_age = 0, $max_age = 0,$city = '')
    {
        $db = $this->db;
        // $db->where('gender', $gender_filter, '=');
        if ($min_age !== 0) {
            $db->where('age', $min_age, '>=');
        }
        if ($max_age !== 0) {
            $db->where('age', $max_age, '<=');
        }

        if ($city !== '') {
            $db->where('city', $city, '=');
        }

//        if ($goal !== '') {
//            $db->where('goal_communication', $goal, '=');
//        }
        $db->where('reg_status', 0, '=');


        $res = $db->get('meeting_users');
        //  $res =    $db->where('search_rnd', '0', '!=')->get('users');
//        $db->where('gender_filter', 'gender', '=');
//        $res = $db->orderBy('search_rnd', 'Asc')->get('users');
        return $res;
    }

}
