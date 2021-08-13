<?php

if(!define('IN_DISCUZ')) {
    exit('Acces Denied');
}

function parse_code($param){
    global $_G;
    return "<pre><code><ol>".$param."</ol></code></pre>";
}