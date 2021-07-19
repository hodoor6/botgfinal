<?php

function clearCache($mem, $chatid)
{
    memcache_set($mem, 'user_info_' . $chatid, NULL, false, 30);
    memcache_set($mem, 'user_info_dating_' . $chatid, NULL, false, 30);
}
