<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include_once DISCUZ_ROOT.'./source/plugin/mw_syntaxhighlighter/mw_syntaxhighlighter.class.php';

class mobileplugin_mw_syntaxhighlighter extends plugin_mw_syntaxhighlighter {

	public function __construct() {
		parent::__construct();
	}

	function global_header() {
		return '';
	}

	function global_footer() {
		return '';
	}

	function global_header_mobile() {
		return parent::global_header();
	}

	function global_footer_mobile() {
		global $_G;
		$syntaxhighlighter = '';

		if(CURMODULE == 'viewthread' && $_G['mw_flag']) {
			$syntaxhighlighter .= $this->_syntaxhighlighter_load_footer_script();
			if(!(defined('IN_MOBILE') && IN_MOBILE == 1)) {
				include_once template('mw_syntaxhighlighter:module_mobile');
				$syntaxhighlighter .= mw_code_toolbar_handler($this->libversion).
					'<script type="text/javascript" src="'.$this->pluginurl.'js/toolbar_mobile.js?'.VERHASH.'"></script>';
			}
		}
		return $syntaxhighlighter;
	}
}

class mobileplugin_mw_syntaxhighlighter_forum extends plugin_mw_syntaxhighlighter_forum {

	function viewthread_bottom_output() {
		return '';
	}

	function viewthread_bottom_mobile_output() {
		return parent::viewthread_bottom_output();
	}

}

?>
