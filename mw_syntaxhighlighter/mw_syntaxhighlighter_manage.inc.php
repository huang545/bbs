<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

cpheader();

$op = $_GET['op'] ? $_GET['op'] : 'lang_displayorder';

$pluginid = !empty($_GET['pluginid']) ? intval($_GET['pluginid']) : 0;
$do = $_GET['do'] ? intval($_GET['do']) : '';

if($op == 'lang_displayorder') {
	if(!submitcheck('langdisplayordersubmit')) {
		showformheader('plugins&operation=config&do='.$do.'&pluginid='.$do.'&identifier=mw_syntaxhighlighter&pmod=mw_syntaxhighlighter_manage&op=lang_displayorder');
		showtableheader();
		showsubtitle(array('display_order', 'message'));

		loadcache('plugin');
		$select_lang_list = unserialize($_G['cache']['plugin']['mw_syntaxhighlighter']['language']);
		$displayorder_list = C::t('common_setting')->fetch('mw_syntaxhighlighter_displayorder_lang');
		$displayorder_list = $displayorder_list ? unserialize($displayorder_list) : array();
		foreach ($select_lang_list as $key => $value) {
			$displayorder = isset($displayorder_list[$value]) ? $displayorder_list[$value] : 0;
			showtablerow('', array('class="td25"', 'class="td28"'), array(
				"<input type=\"text\" class=\"txt\" name=\"displayordernew[{$value}]\" value=\"$displayorder\" size=\"2\">",
				$value,
			));
		}
		showsubmit('langdisplayordersubmit', 'submit');
		showtablefooter();
		showformfooter();

	} else {

		if(is_array($_GET['displayordernew'])) {
			C::t('common_setting')->update('mw_syntaxhighlighter_displayorder_lang', $_GET['displayordernew']);
		}

		cpmsg('plugins_setting_succeed', 'action=plugins&operation=config&do='.$pluginid.'&identifier=mw_syntaxhighlighter&pmod=mw_syntaxhighlighter_manage&op='.$op, 'succeed');
	}
}
