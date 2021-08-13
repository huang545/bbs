<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_mw_syntaxhighlighter {

	var $libversion = '';//note 使用高亮版本
	var $theme = '';//note 颜色主题
	var $libfolder = '';//note 高亮库所在目录
	var $autolinks = '';
	var $quickcodecopy = '';
	var $gutter = '';
	var $startlinenumber = '';
	var $linenumberpadding = '';
	var $toolbar = '';
	var $collapse = '';
	var $smarttabs = '';
	var $tabsize = '';
	var $wraplines = '';
	var $title = '';
	var $maxheight = '';
	var $legacy_enable = '';
	var $legacy = '';
	var $collapse_lable_text = '';
	var $collapse_lable = '';

	var $pluginurl = '';
	var $brush_files = '';
	var $sh_lang_3 = '';
	var $sh_lang_2 = '';
	var $select_language = '';

	public function __construct() {
		global $_G;

		$this->pluginurl = $_G['siteurl'].'source/plugin/mw_syntaxhighlighter/static/';

		$this->sh_lang_3 = array(
			"applescript" => array('AppleScript', 'true'),
			"actionscript3" => array('Actionscript3', 'true'),
			"bash" => array('Bash shell', 'true'),
			"coldfusion" => array('ColdFusion', 'true'),
			"c" => array('C', 'true'),
			"cpp" => array('C++', 'true'),
			"csharp" => array('C#', 'true'),
			"css" => array('CSS', 'true'),
			"delphi" => array('Delphi', 'true'),
			"diff" => array('Diff', 'true'),
			"erlang" => array('Erlang', 'true'),
			"groovy" => array('Groovy', 'true'),
			"html" => array('HTML', 'true'),
			"java" => array('Java', 'true'),
			"javafx" => array('JavaFX', 'true'),
			"javascript" => array('JavaScript', 'true'),
			"pascal" => array('Pascal', 'true'),
			"patch" => array('Patch', 'true'),
			"perl" => array('Perl', 'true'),
			"php" => array('PHP', 'true'),
			"text" => array('Plain Text', 'true'),
			"powershell" => array('PowerShell', 'true'),
			"python" => array('Python', 'true'),
			"ruby" => array('Ruby', 'true'),
			"rails" => array('Ruby on Rails', 'true'),
			"sass" => array('Sass', 'true'),
			"scala" => array('Scala', 'true'),
			"scss" => array('Scss', 'true'),
			"shell" => array('Shell', 'true'),
			"sql" => array('SQL', 'true'),
			"vb" => array('Visual Basic', 'true'),
			"vbnet" => array('Visual Basic .NET', 'true'),
			"xhtml" => array('XHTML', 'true'),
			"xml" => array('XML', 'true'),
			"xslt" => array('XSLT', 'true'),
			"objc" => array('Objective-C', 'true'),
			"asm" => array('Asm', 'true'),
			"aauto" => array('AAuto', 'true'),
			"golang" => array('Golang', 'true'),
			"lua" => array('Lua', 'true'),
		);

		$this->sh_lang_2 = array(
			"actionscript3" => array('Actionscript3', 'true'),
			"bash" => array('Bash shell', 'true'),
			"coldfusion" => array('ColdFusion', 'true'),
			"c" => array('C', 'true'),
			"cpp" => array('C++', 'true'),
			"csharp" => array('C#', 'true'),
			"css" => array('CSS', 'true'),
			"delphi" => array('Delphi', 'true'),
			"diff" => array('Diff', 'true'),
			"erlang" => array('Erlang', 'true'),
			"groovy" => array('Groovy', 'true'),
			"html" => array('HTML', 'true'),
			"java" => array('Java', 'true'),
			"javafx" => array('JavaFX', 'true'),
			"javascript" => array('JavaScript', 'true'),
			"pascal" => array('Pascal', 'true'),
			"patch" => array('Patch', 'true'),
			"perl" => array('Perl', 'true'),
			"php" => array('PHP', 'true'),
			"text" => array('Plain Text', 'true'),
			"powershell" => array('PowerShell', 'true'),
			"python" => array('Python', 'true'),
			"ruby" => array('Ruby', 'true'),
			"rails" => array('Ruby on Rails', 'true'),
			"scala" => array('Scala', 'true'),
			"shell" => array('Shell', 'true'),
			"sql" => array('SQL', 'true'),
			"vb" => array('Visual Basic', 'true'),
			"vbnet" => array('Visual Basic .NET', 'true'),
			"xhtml" => array('XHTML', 'true'),
			"xml" => array('XML', 'true'),
			"xslt" => array('XSLT', 'true'),
			"objc" => array('Objective-C', 'true'),
			"asm" => array('Asm', 'true'),
			"aauto" => array('AAuto', 'true'),
			"golang" => array('Golang', 'true'),
			"lua" => array('Lua', 'true'),
		);

		$this->brush_files = array(
			"AppleScript" => array('shBrushAppleScript.js', 'applescript', '3.0', 'true'),
			"ActionScript3" => array('shBrushAS3.js', 'as3 actionscript3', '2.1', 'true'),
			"Bash" => array('shBrushBash.js', 'bash shell', '2.1', 'true'),
			"ColdFusion" => array('shBrushColdFusion.js', 'cf coldfusion', '2.1', 'true'),
			"C++" => array('shBrushCpp.js', 'cpp c', '1.5', 'true'),
			"C#" => array('shBrushCSharp.js', 'c# c-sharp csharp', '1.5', 'true'),
			"CSS" => array('shBrushCss.js', 'css', '1.5', 'true'),
			"Delphi" => array('shBrushDelphi.js', 'delphi pas pascal', '1.5', 'true'),
			"Diff" => array('shBrushDiff.js', 'diff patch', '2.1', 'true'),
			"Erlang" => array('shBrushErlang.js', 'erl erlang', '2.1', 'true'),
			"Groovy" => array('shBrushGroovy.js', 'groovy', '2.1', 'true'),
			"Java" => array('shBrushJava.js', 'java', '1.5', 'true'),
			"JavaFX" => array('shBrushJavaFX.js', 'jfx javafx', '2.1', 'true'),
			"JavaScript" => array('shBrushJScript.js', 'js jscript javascript', '1.5', 'true'),
			"Perl" => array('shBrushPerl.js', 'perl pl', '2.1', 'true'),
			"PHP" => array('shBrushPhp.js', 'php', '1.5', 'true'),
			"PlainText" => array('shBrushPlain.js', 'plain text', '2.1', 'true'),
			"PowerShell" => array('shBrushPowerShell.js', 'ps powershell', '2.1', 'true'),
			"Python" => array('shBrushPython.js', 'py python', '1.5', 'true'),
			"Ruby" => array('shBrushRuby.js', 'rails ror ruby rb', '1.5', 'true'),
			"Sass" => array('shBrushSass.js', 'sass scss', '3.0', 'true'),
			"Scala" => array('shBrushScala.js', 'scala', '2.1', 'true'),
			"SQL" => array('shBrushSql.js', 'sql', '1.5', 'true'),
			"VisualBasic" => array('shBrushVb.js', 'vb vbnet', '1.5', 'true'),
			"XML" => array('shBrushXml.js', 'xml xhtml xslt html', '1.5', 'true'),
			"Objective-C" => array('shBrushObjC.js', 'objc', '2.1', 'true'),
			"Asm" => array('shBrushAsm.js', 'asm', '2.1', 'true'),
			"AAuto" => array('shBrushAAuto.js', 'aauto', '2.1', 'true'),
			"Golang" => array('shBrushGo.js', 'go golang', '2.1', 'true'),
			"Lua" => array('shBrushLua.js', 'lua', '2.1', 'true'),
		);

		if($_G['cache']['plugin']['mw_syntaxhighlighter']['libversion'] == 2) {
			$this->libversion = '2.1.382';
			$this->libfolder = 'syntaxhighlighter2';
		} else {
			$this->libversion = '3.0.83';
			$this->libfolder = 'syntaxhighlighter3';
		}

		$this->theme = $_G['cache']['plugin']['mw_syntaxhighlighter']['theme'] ? $_G['cache']['plugin']['mw_syntaxhighlighter']['theme'] : 'Random';//note 没有选择则随机显示
		$this->select_language = unserialize($_G['cache']['plugin']['mw_syntaxhighlighter']['language']);
		$this->autolinks = $_G['cache']['plugin']['mw_syntaxhighlighter']['autolinks'];
		$this->quickcodecopy = $_G['cache']['plugin']['mw_syntaxhighlighter']['quickcodecopy'];
		$this->gutter = $_G['cache']['plugin']['mw_syntaxhighlighter']['gutter'];
		$this->startlinenumber = intval($_G['cache']['plugin']['mw_syntaxhighlighter']['startlinenumber']);
		$this->linenumberpadding = $_G['cache']['plugin']['mw_syntaxhighlighter']['linenumberpadding'];
		$this->toolbar = $_G['cache']['plugin']['mw_syntaxhighlighter']['toolbar'];
		$this->collapse = $_G['cache']['plugin']['mw_syntaxhighlighter']['collapse'];
		$this->smarttabs = $_G['cache']['plugin']['mw_syntaxhighlighter']['smarttabs'];
		$this->tabsize = intval($_G['cache']['plugin']['mw_syntaxhighlighter']['tabsize']);
		$this->wraplines = $_G['cache']['plugin']['mw_syntaxhighlighter']['wraplines'];
		$this->title = str_replace('\'', '&#39;', $_G['cache']['plugin']['mw_syntaxhighlighter']['title']);
		$this->maxheight = $_G['cache']['plugin']['mw_syntaxhighlighter']['maxheight'];
		$this->legacy_enable = $_G['cache']['plugin']['mw_syntaxhighlighter']['legacy'];//note 暂时未做表单提交
		$this->cdn = $_G['cache']['plugin']['mw_syntaxhighlighter']['cdn'];
		if($this->legacy_enable == 1) {
			$this->legacy = "dp.SyntaxHighlighter.HighlightAll('code')";
		} else {
			$this->legacy = '';
		}
		if($this->cdn) {
			$this->pluginurl = $this->cdn;
		}
		$this->collapse_lable_text = str_replace('\'', '&#39;', $_G['cache']['plugin']['mw_syntaxhighlighter']['collapse_lable_text']);//note 暂时未做表单提交
		if($this->libversion == '3.0.83') {
			if($this->collapse_lable_text != '' && $this->title == '') {
				$this->collapse_lable = $this->collapse_lable_text;
			} else {
				$this->collapse_lable = '+ expand source';
			}
		} elseif($this->libversion == '2.1.382') {
			if($this->collapse_lable_text != '') {
				$this->collapse_lable = $this->collapse_lable_text;
			} else {
				$this->collapse_lable = 'show source';
			}
		}

		foreach($this->brush_files as $lang => $val) {
			$intersectarray = array_intersect(explode(' ', $val[1]), $this->select_language);
			if(empty($intersectarray)) {
				unset($this->brush_files[$lang]);
			}
		}
	}

	function global_header() {
		global $_G;
		if(CURMODULE == 'viewthread') {
			if($_G['mw_flag']) {
				return $this->_syntaxhighlighter_load_header_css();
			}
		}
	}

	function global_footer() {
		global $_G;
		$codebox = $syntaxhighlighter = $codbox_script = '';
		if(CURMODULE == 'viewthread') {
			$codebox = $this->_mw_shl_codebox_script('fastpost');
		} elseif(CURMODULE == 'forumdisplay') {
			$codebox = $this->_mw_shl_codebox_script('fastpost');
		} elseif(CURMODULE == 'post') {
			$codebox = $this->_mw_shl_codebox_script('newthread');
		}
		if(CURMODULE == 'viewthread' && $_G['mw_flag']) {
			include_once template('mw_syntaxhighlighter:module');
			$syntaxhighlighter = $this->_syntaxhighlighter_load_footer_script();
			$syntaxhighlighter .= mw_code_toolbar_handler($this->libversion).
					'<script type="text/javascript" src="'.$this->pluginurl.'js/toolbar.js?'.VERHASH.'"></script>';
		}
		if(CURMODULE == 'viewthread' || CURMODULE == 'forumdisplay' || CURMODULE == 'post') {
			include_once template('mw_syntaxhighlighter:module');
			if($this->libversion == '3.0.83') {
				$sh_lang = $this->sh_lang_3;
			} elseif($this->libversion == '2.1.382') {
				$sh_lang = $this->sh_lang_2;
			} else {
				return;
			}

			$sh_lang_new = array();
			if($this->select_language) {
				$displayorder_list = C::t('common_setting')->fetch('mw_syntaxhighlighter_displayorder_lang');
				$displayorder_list = $displayorder_list ? unserialize($displayorder_list) : array();
				$displayorder = array();
				foreach($sh_lang as $lang => $val) {
					if(!in_array($lang, $this->select_language)) {
						unset($sh_lang[$lang]);
						continue;
					}
					$displayorder[$lang] = isset($displayorder_list[$lang]) ? $displayorder_list[$lang] : 0;
				}
				//arsort($displayorder);
				$this->_mw_mergesort($displayorder, function($a, $b) {
					if($a == $b) {
						return 0;
					}
					return $a < $b ? 1 : -1;
				});
				foreach($displayorder as $lang => $v) {
					$sh_lang_new[$lang] = $sh_lang[$lang];
				}
			} else {
				return;
			}
			$codbox_script = mw_syntaxhighlighter_shl_codebox($sh_lang_new, $this->gutter).
					'<script type="text/javascript" src="'.$this->pluginurl.'js/mw_syntaxhighlighter.js?'.VERHASH.'"></script>';
		}
		return $codbox_script.$codebox.$syntaxhighlighter;
	}

	function _syntaxhighlighter_load_header_css() {
		global $_G;

		$theme_css_list['Default'] = array('1', 'shCoreDefault.css', 'shThemeDefault.css');
		$theme_css_list['Django'] = array('2', 'shCoreDjango.css', 'shThemeDjango.css');
		$theme_css_list['Eclipse'] = array('3', 'shCoreEclipse.css', 'shThemeEclipse.css');
		$theme_css_list['Emacs'] = array('4', 'shCoreEmacs.css', 'shThemeEmacs.css');
		$theme_css_list['FadeToGrey'] = array('5', 'shCoreFadeToGrey.css', 'shThemeFadeToGrey.css');
		$theme_css_list['MDUltra'] = array('8', 'shCoreMDUltra.css', 'shThemeMDUltra.css');
		$theme_css_list['Midnight'] = array('6', 'shCoreMidnight.css', 'shThemeMidnight.css');
		$theme_css_list['RDark'] = array('7', 'shCoreRDark.css', 'shThemeRDark.css');
		//$csslink = '<link rel="stylesheet" type="text/css" href="'.$this->pluginurl.$this->libfolder.'/styles/shCore.css?ver='.$this->libversion.'&'.VERHASH.'" />';
		$csslink = '<style type="text/css">'."\r\n";
		$csslink .= '@import url(\''.$this->pluginurl.$this->libfolder.'/styles/shCore.css?ver='.$this->libversion.'\');'."\r\n";
		if($this->theme == 'Random') {
			if($this->libversion == '3.0.83') {
				$theme_no = mt_rand(1, 8);
				foreach($theme_css_list as $themename => $val) {
					if($theme_no == $val[0]) {
						//$csslink .= '<link rel="stylesheet" type="text/css" href="'.$this->pluginurl.$this->libfolder.'/styles/'.$val[1].'?ver='.$this->libversion.'&'.VERHASH.'" />';
						//$csslink .= '<link rel="stylesheet" type="text/css" href="'.$this->pluginurl.$this->libfolder.'/styles/'.$val[2].'?ver='.$this->libversion.'&'.VERHASH.'" />';
						$csslink .= '@import url(\''.$this->pluginurl.$this->libfolder.'/styles/'.$val[1].'?ver='.$this->libversion.'\');'."\r\n";
						$csslink .= '@import url(\''.$this->pluginurl.$this->libfolder.'/styles/'.$val[2].'?ver='.$this->libversion.'\');'."\r\n";
					}
				}
			}
			if($this->libversion == '2.1.382') {
				$theme_no = mt_rand(1, 7);
				foreach($theme_css_list as $themename => $val) {
					if($theme_no == $val[0]) {
						//$csslink .= '<link rel="stylesheet" type="text/css" href="'.$this->pluginurl.$this->libfolder.'/styles/'.$val[2].'?ver='.$this->libversion.'&'.VERHASH.'" />';
						$csslink .= '@import url(\''.$this->pluginurl.$this->libfolder.'/styles/'.$val[2].'?ver='.$this->libversion.'\');'."\r\n";
					}
				}
			}
		} else {
			if($this->libversion == '2.1.382' && $this->theme == 'MDUltra') {
				//$csslink .= '<link rel="stylesheet" type="text/css" href="'.$this->pluginurl.$this->libfolder.'/styles/shThemeDefault.css?ver='.$this->libversion.'&'.VERHASH.'" />';
				$csslink .= '@import url(\''.$this->pluginurl.$this->libfolder.'/styles/shThemeDefault.css?ver='.$this->libversion.'\');'."\r\n";
			} else {
				if($this->libversion == '3.0.83') {
					//$csslink .= '<link rel="stylesheet" type="text/css" href="'.$this->pluginurl.$this->libfolder.'/styles/'.$theme_css_list[$this->theme][1].'?ver='.$this->libversion.'&'.VERHASH.'" />';
					$csslink .= '@import url(\''.$this->pluginurl.$this->libfolder.'/styles/'.$theme_css_list[$this->theme][1].'?ver='.$this->libversion.'\');'."\r\n";
				}
				//$csslink .= '<link rel="stylesheet" type="text/css" href="'.$this->pluginurl.$this->libfolder.'/styles/'.$theme_css_list[$this->theme][2].'?ver='.$this->libversion.'&'.VERHASH.'" />';
				$csslink .= '@import url(\''.$this->pluginurl.$this->libfolder.'/styles/'.$theme_css_list[$this->theme][2].'?ver='.$this->libversion.'\');'."\r\n";
			}
		}
		//$csslink .= '<meta id="syntaxhighlighteranchor" name="syntaxhighlighter-version" content="3.1.3" />';

		$csslink .= '@import url(\''.$this->pluginurl.'css/mw_syntaxhighlighter.css'.'?ver='.$this->libversion.'\');'."\r\n";
		$csslink .= '.syntaxhighlighter {'.($this->maxheight ? 'max-height: '.$this->maxheight.'px !important;' : '').($this->maxheight ? 'height:expression(this.scrollHeight > '.$this->maxheight.' ? "'.$this->maxheight.'px" : "auto");' : '')."}\r\n";
		if($this->libversion == '3.0.83') {
			$csslink .= '.syntaxhighlighter .line {white-space: nowrap !important;}'."\r\n";
		}
		$csslink .= "\r\n".'</style>'."\r\n";
		return $csslink;
	}

	function _syntaxhighlighter_load_footer_script() {
		global $_G;

		$script = "\n<!-- mw_syntaxhighlighter ver.".$this->libversion." Begin -->\n";
		$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/shCore.js?ver=".$this->libversion."\"></script>\n";
		if($this->legacy_enable == 1) {
			$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/shLegacy.js?ver=".$this->libversion."\"></script>\n";
		}
		if($this->libversion == '3.0.83' && $this->legacy_enable == 0) {
			$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/shAutoloader.js?ver=".$this->libversion."\"></script>\n";
			if($this->brush_files[XML][3] == 'true' || $_G['adminid'] == 1) {
				$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/shBrushXml.js?ver=".$this->libversion."\"></script>\n";
			}
		} elseif($this->libversion == '3.0.83' && $this->legacy_enable == 1) {
			$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/shAutoloader.js?ver=".$this->libversion."\"></script>\n";
			foreach($this->brush_files as $lang => $val) {
				$brush_file = $val[0];
				$brush_ver = $val[2];
				$brush_enable = $val[3];
				if(($brush_ver == '3.0' || $brush_ver == '2.1' || $brush_ver == '1.5') && $brush_enable == 'true') {
					$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/".$brush_file."?ver=".$this->libversion."\"></script>\n";
				} elseif (($brush_ver == '3.0' || $brush_ver == 'all') && $brush_enable == 'added') {
					$script .= "<script type=\"text/javascript\" src=\"".$brush_file."?ver=".$this->libversion."\"></script>\n";
				}
			}
			if($_G['adminid'] == 1 && $this->brush_files[XML][3] == 'false') {
				$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/shBrushXml.js?ver=".$this->libversion."\"></script>\n";
			}
		} elseif($this->libversion == '2.1.382') {
			foreach($this->brush_files as $lang => $val) {
				$brush_file = $val[0];
				$brush_ver = $val[2];
				$brush_enable = $val[3];
				if (($brush_ver == '2.1' || $brush_ver == '1.5') && $brush_enable == 'true') {
					$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/".$brush_file."?ver=".$this->libversion."\"></script>\n";
				} elseif (($brush_ver == '2.1' || $brush_ver == 'all') && $brush_enable == 'added') {
					$script .= "<script type=\"text/javascript\" src=\"".$brush_file."?ver=".$this->libversion."\"></script>\n";
				}
			}
			if($_G['adminid'] == 1 && $this->brush_files[PHP][3] == 'false') {
				$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/shBrushPhp.js?ver=".$this->libversion."\"></script>\n";
			}
			if($_G['adminid'] == 1 && $this->brush_files[XML][3] == 'false') {
				$script .= "<script type=\"text/javascript\" src=\"".$this->pluginurl.$this->libfolder."/scripts/shBrushXml.js?ver=".$this->libversion."\"></script>\n";
			}
		}

		if($this->libversion == '3.0.83') {
			$script .= "<script type=\"text/javascript\">//<![CDATA[
	SyntaxHighlighter.autoloader(\n";
			$count = 0;
			foreach($this->brush_files as $lang => $val) {
				$brush_file = $val[0];
				$brush_alias = $val[1];
				$brush_ver = $val[2];
				$brush_enable = $val[3];
				if ($brush_enable == 'true' || ($_G['adminid'] == 1 && $lang == "PHP")) {
					$count = $count + 1;
					if ($count == 1) {
						$script .= "	\"".$brush_alias."	".$this->pluginurl.$this->libfolder."/scripts/".$brush_file."?ver=".$this->libversion."\"\n";
					} else {
						$script .= "	,\"".$brush_alias."	".$this->pluginurl.$this->libfolder."/scripts/".$brush_file."?ver=".$this->libversion."\"\n";
					}
				} elseif (($brush_ver == '3.0' || $brush_ver == 'all') && $brush_enable == 'added') {
					$count = $count + 1;
					if ($count == 1) {
						$script .= "	\"".$brush_alias."	".$brush_file."?ver=".$this->libversion."\"\n";
					} else {
						$script .= "	,\"".$brush_alias."	".$brush_file."?ver=".$this->libversion."\"\n";
					}
				}
			}

			$script .= "	);
	SyntaxHighlighter.defaults['auto-links'] = ".($this->autolinks ? 'true' : 'false').";
	SyntaxHighlighter.defaults['quick-code'] = ".($this->quickcodecopy ? 'true' : 'false').";
	SyntaxHighlighter.defaults['title'] = '".$this->title."';
	SyntaxHighlighter.defaults['class-name'] = 'notranslate';
	SyntaxHighlighter.defaults['collapse'] = ".($this->collapse ? 'true' : 'false').";
	SyntaxHighlighter.defaults['first-line'] = ".$this->startlinenumber.";
	SyntaxHighlighter.defaults['gutter'] = ".($this->gutter ? 'true' : 'false').";
	SyntaxHighlighter.defaults['pad-line-numbers'] = ".($this->linenumberpadding ? $this->linenumberpadding : 'false').";
	SyntaxHighlighter.defaults['smart-tabs'] = ".($this->smarttabs ? 'true' : 'false').";
	SyntaxHighlighter.defaults['tab-size'] = ".$this->tabsize.";
	SyntaxHighlighter.defaults['toolbar'] = ".($this->toolbar ? 'true' : 'false').";\n";
			if($this->legacy_enable == 1) {
				$script .= " SyntaxHighlighter.config.stripBrs = true;\n";
			}
			$script .= "	SyntaxHighlighter.config.strings.expandSource = '".$this->collapse_lable."';
	SyntaxHighlighter.config.strings.help = '?';
	SyntaxHighlighter.config.strings.alert = 'SyntaxHighlighter';
	SyntaxHighlighter.config.strings.noBrush = \"Can\'t find brush for: \";
	SyntaxHighlighter.config.strings.brushNotHtmlScript = \"Brush wasn\'t configured for html-script option: \";
	SyntaxHighlighter.all();
	".$this->legacy."
//]]></script>
<!-- mw_syntaxhighlighter ver.".$this->libversion." End -->\n";
		} elseif($this->libversion == '2.1.382') {
			$script.= "<script type=\"text/javascript\">//<![CDATA[
	SyntaxHighlighter.config.clipboardSwf = '".$this->pluginurl.$this->libfolder."/scripts/clipboard.swf';
	SyntaxHighlighter.defaults['auto-links'] = ".$this->autolinks.";
	SyntaxHighlighter.defaults['class-name'] = '';
	SyntaxHighlighter.defaults['collapse'] = ".$this->collapse.";
	SyntaxHighlighter.defaults['first-line'] = ".$this->startlinenumber.";
	SyntaxHighlighter.defaults['gutter'] = ".$this->gutter.";
	SyntaxHighlighter.defaults['pad-line-numbers'] = ".$this->linenumberpadding.";
	SyntaxHighlighter.defaults['smart-tabs'] = ".$this->smarttabs.";
	SyntaxHighlighter.defaults['tab-size'] = ".$this->tabsize.";
	SyntaxHighlighter.defaults['toolbar'] = ".$this->toolbar.";
	SyntaxHighlighter.defaults['wrap-lines'] = ".$this->wraplines.";\n";
			if ($this->legacy_enable == 1) {
				$script .= " SyntaxHighlighter.config.stripBrs = true;\n";
			}
			$script .= "	SyntaxHighlighter.config.strings.expandSource = '".$this->collapse_lable."';
	SyntaxHighlighter.config.strings.viewSource = 'view source';
	SyntaxHighlighter.config.strings.copyToClipboard = 'copy to clipboard';
	SyntaxHighlighter.config.strings.copyToClipboardConfirmation = 'The code is in your clipboard now';
	SyntaxHighlighter.config.strings.print = 'print';
	SyntaxHighlighter.config.strings.help = '?';
	SyntaxHighlighter.config.strings.alert = 'SyntaxHighlighter';
	SyntaxHighlighter.config.strings.noBrush = \"Can\'t find brush for: \";
	SyntaxHighlighter.config.strings.brushNotHtmlScript = \"Brush wasn\'t configured for html-script option: \";
	SyntaxHighlighter.all();
	".$this->legacy."
//]]></script>
<!-- mw_syntaxhighlighter ver.".$this->libversion." End -->\n";
		}
		return $script;
	}

	function _mw_shl_codebox_script($textareaid) {
		return '<script type="text/javascript" reload="1">mw_syntaxhighlighter("'.$textareaid.'");</script>';
	}

	function discuzcode($param) {
		global $_G;
		if(strpos($_G['discuzcodemessage'], 'mw_shl_code') !== false) {
			$_G['mw_flag'] = true;
		}
		if($param['caller'] == 'discuzcode') {
			$_G['discuzcodemessage'] = preg_replace_callback('/\[mw_shl_code=(.+?),(.+?)\](.*?)\[\/mw_shl_code\]/is', array($this, '_mw_shl_code_to_pre'), $_G['discuzcodemessage']);
		}
		if($param['caller'] == 'messagecutstr') {
			$_G['discuzcodemessage'] = preg_replace('/\[mw_shl_code=(.+?)\](.*?)\[\/mw_shl_code\]/is', '', $_G['discuzcodemessage']);
		}
	}

	function _mw_shl_code_to_pre($matches) {
		global $_G, $post;

		$brush = $matches[1];
		$gutter = $matches[2];
		$code = $matches[3];

		if($this->libversion == '3.0.83') {
			$sh_lang = $this->sh_lang_3;
		} elseif($this->libversion == '2.1.382') {
			$sh_lang = $this->sh_lang_2;
		} else {
			return;
		}
		$code = str_replace(array('<br />', '<br>'), '', $code);
		//$code = dhtmlspecialchars(str_replace('\\"', '"', $code));
		$_G['mw_code'][$post['pid']][] = $code;
		$toolbarstr = '<div style="font-size:12px;">['.$sh_lang[$brush][0].']';
		if(defined('IN_MOBILE') && IN_MOBILE == 1) {
			$toolbarstr .= '</div>';
		} else {
			$toolbarstr .= ' <em class="viewsource" style="cursor:pointer;font-size:12px;color:#369 !important;">'.lang('plugin/mw_syntaxhighlighter', 'syntaxhighlighter_viewsource').'</em> <em class="copycode" style="cursor:pointer;font-size:12px;color:#369 !important;">'.lang('plugin/mw_syntaxhighlighter', 'syntaxhighlighter_copycode').'</em></div>';
		}
		return '<div style="padding:15px 0;">'.$toolbarstr.'<pre class="brush: '.strtolower($brush).'; gutter: '.$gutter.'">'.$code.'</pre></div>';
	}

	function _mw_mergesort(&$array, $cmp_function = 'strcmp') {
		$arraycount = count($array);
		if($arraycount < 2) {
			return;
		}
		$halfway = $arraycount / 2;
		$array1 = array_slice($array, 0, $halfway, true);
		$array2 = array_slice($array, $halfway, null, true);
		$this->_mw_mergesort($array1, $cmp_function);
		$this->_mw_mergesort($array2, $cmp_function);

		$array = array();
		$ptr1 = $ptr2 = 0;
		$array1keys = array_keys($array1);
		$array1 = array_values($array1);
		$array2keys = array_keys($array2);
		$array2 = array_values($array2);
		$array1count = count($array1);
		$array2count = count($array2);
		while ($ptr1 < $array1count && $ptr2 < $array2count) {
			if (call_user_func($cmp_function, $array1[$ptr1], $array2[$ptr2]) < 1) {
				$array[$array1keys[$ptr1]] = $array1[$ptr1];
				$ptr1++;
			}
			else {
				$array[$array2keys[$ptr2]] = $array2[$ptr2];
				$ptr2++;
			}
		}
		while ($ptr1 < $array1count) {$array[$array1keys[$ptr1]] = $array1[$ptr1]; $ptr1++;}
		while ($ptr2 < $array2count) {$array[$array2keys[$ptr2]] = $array2[$ptr2]; $ptr2++;}

		return;
	}
}

class plugin_mw_syntaxhighlighter_forum extends plugin_mw_syntaxhighlighter {

	function viewthread_bottom_output() {
		global $postlist;
		foreach($postlist as $pid => $post) {
			$post['message'] = preg_replace_callback('/<pre[^>](.*?)>(.*?)<\/pre>/is', create_function('$matches', 'return plugin_mw_syntaxhighlighter_forum::_brreplace($matches[1], $matches[2], '.intval($pid).');'), $post['message']);
			$postlist[$pid] = $post;
		}
		return '';
	}

	function _brreplace($param, $codecontent, $pid) {
		global $_G;
		return '<pre '.stripslashes($param).'>'.str_replace(array('<br>', '<br />'), '', array_shift($_G['mw_code'][$pid])).'</pre>';
	}

	function post_infloat_btn_extra_output() {
		if(CURMODULE == 'post') {
			return $this->_mw_shl_codebox_script('post');
		} else {
			return '';
		}
	}
}

?>
