<?php


if(!defined('IN_DISCUZ')){
	exit('Access Denied');    
}


class plugin_zhaisoul_code_highlight {
    function discuzcode($param){
        global $_G;
        if($param['caller'] == 'discuzcode') {
            $_G['forum_discuzcode']['newcodecount'] == null ? 0 : $_G['forum_discuzcode']['newcodecount'];
            $test = $_G['discuzcodemessage'];
            preg_match_all('/\[code\](.+?)\[\/code\]/is',$param['param'][0],$code);
            $head = '<div class="code_div"><div class="code_tools">';
            if(count($code) >0){
                $test = lang('plugin/zhaisoul_code_highlight','copy');
                $count=$_G['forum_discuzcode']['newcodecount'];
                for($i = 0; $i <= $_G['forum_discuzcode']['pcodecount']-$count; $i++) {
                    $randomid = 'code_'.random(3);
                    $_G['forum_discuzcode']['codehtml'][$i+$count] = $head.'<a onclick="copycode($(\''.$randomid.'\'));">'.lang('plugin/zhaisoul_code_highlight','copy').'</a></div><pre id="'.$randomid.'"><code>'.dhtmlspecialchars($code[1][$i]).'</code></pre></div>';
                    $_G['forum_discuzcode']['newcodecount']++;
                }
            }
        }
    }

    function global_footer(){
        global $_G;
        //有code代码的时候才添加js与css，否则不会添加
        if($_G['forum_discuzcode']['pcodecount']>=0){
            $theme_name = str_replace(' ','-',strtolower($_G['cache']['plugin']['zhaisoul_code_highlight']['theme_select']));
            $theme = '<link rel="stylesheet" href="'.$_G["siteurl"].'source/plugin/zhaisoul_code_highlight/highlightjs/styles/'.$theme_name.'.css" >';
            $css = '<style type="text/css"> @font-face {font-family:"Cascadia Code";src: url("https://127.0.0.1/BBS/DZ3.4BBS/source/plugin/zhaisoul_code_highlight/assets/Cascadia.ttf");text-rendering: optimizeLegibility;} pre{'.$_G['cache']['plugin']['zhaisoul_code_highlight']['custom_pre'].'} .code_div{position: relative;} .code_tools{text-align: center;float: right;background: #778899;position: absolute;padding:2px;right:0;margin:5px;width:40px;transition-duration: .3s;} .code_tools a{cursor: pointer;color:white; text-decoration: none;} .code_tools:hover{opacity:0.2} code{font: 14px/12px '.($_G['cache']['plugin']['zhaisoul_code_highlight']['cascadia_font'] ? '"Cascadia Code"' : '"Courier New"').';} </style>';
            $js = '<script src="'.$_G["siteurl"].'source/plugin/zhaisoul_code_highlight/highlightjs/highlight.pack.js"></script><script>hljs.initHighlightingOnLoad();</script>';
            return $theme.$css.$js;
        }
        return '';
    }
}