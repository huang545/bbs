function mw_syntaxhighlighter(textareaid) {
	if(textareaid == 'fastpost') {
		var code = $('fastpostcode');
		if(code) {
			code.onclick = function() {
				syntaxhighlighter_code_box('fastpost');
			};
		}
	} else if(textareaid == 'newthread') {
		var code = $(editorid + '_code');
		if(code) {
			$(editorid + '_body').onmouseup = function(e) {
				var code = $(editorid + '_code');
				code.onclick = function() {
					return false;
				};
				e = e || window.event;
				if((e.target || e.srcElement) == code) {
					syntaxhighlighter_code_box('newthread');
				}
			}
		}
	} else if(textareaid == 'post') {
		var code = $('postcode');
		if(code) {
			code.onclick = function() {
				syntaxhighlighter_code_box('post');
			};
		}
	}
}

function syntaxhighlighter_code_box(editortype) {
	mw_syntaxhighlighter_show_editor_codebox(editortype);
}

function mw_syntaxhighlighter_show_editor_codebox(editortype) {
	var tag = 'code';
	var mw_syntaxhighlighter_tag = 'mw_shl_code';
	var str = mw_lang_codebox['select_lang'];
	str += '<select id="brush_lang" name="lang">';
	for(var lang in mw_brush) {
		str += '<option value="'+ lang + '">'+ mw_brush[lang][0] + '</option>';
	}
	str += '</select><br>';
	if(mw_gutter == 1) {
		str += mw_lang_codebox['show_gutter'];
		str += '<input type="checkbox" id="show_gutter" name="show_gutter" value="1" checked><br>';
	}

	if(editortype == 'newthread') {

		var sel, selection;
		var str1 = '', strdialog = 0, stitle = '';
		var ctrlid = editorid + '_' + tag;
		var menu = $(ctrlid + '_menu');
		var pos = [0, 0];
		var menuwidth = 270;
		var menupos = '43!';
		var menutype = 'menu';

		str += '<div id="mw_codearea">'+ mw_lang_codebox['your_code'] +'<br>';
		str += '<textarea id="' + ctrlid + '_param_1" style="width: 98%" cols="50" rows="5" class="txtarea"></textarea></div>';

		//note 修改了ie下的不兼容问题
		if(BROWSER.ie) {
			if(wysiwyg) {
				editdoc.body.focus();
				sel = editdoc.selection.createRange();
			} else {
				sel = document.selection.createRange();
			}
			pos = getCaret();
		}

		selection = sel ? (wysiwyg ? sel.text : sel.text) : mw_highlighter_getSel();//note 修改sel.HtmlText修改为Text，编辑器中的可视化用插件实现比较困难
		if(menu) {
			if($(ctrlid).getAttribute('menupos') !== null) {
				menupos = $(ctrlid).getAttribute('menupos');
			}
			if($(ctrlid).getAttribute('menuwidth') !== null) {
				menu.style.width = $(ctrlid).getAttribute('menuwidth') + 'px';
			}

			if(selection) {//note 如果选择了内容的处理
				$('mw_codearea').style.display = 'none';
			}

			showMenu({'ctrlid':ctrlid,'evt':'click','pos':menupos,'timeout':250,'duration':in_array(tag, ['fontname', 'fontsize', 'sml']) ? 2 : 3,'drag':1});
		} else {

			var menu = document.createElement('div');
			menu.id = ctrlid + '_menu';
			menu.style.display = 'none';
			menu.className = 'p_pof upf';
			menu.style.width = menuwidth + 'px';

			s = '<div class="p_opt cl"><span class="y" style="margin:-10px -10px 0 0"><a onclick="hideMenu();return false;" class="flbc" href="javascript:;">'+ mw_lang_codebox['close'] +'</a></span><div>' + str + '</div><div class="pns mtn"><button type="submit" id="' + ctrlid + '_submit" class="pn pnc"><strong>'+ mw_lang_codebox['submit'] +'</strong></button></div></div>';
			menu.innerHTML = s;
			$(editorid + '_editortoolbar').appendChild(menu);

			if(selection) {//note 如果选择了内容的处理
				$('mw_codearea').style.display = 'none';
			}

			showMenu({'ctrlid':ctrlid,'mtype':menutype,'evt':'click','duration':3,'cache':0,'drag':1,'pos':menupos});
		}

		try {
			if($(ctrlid + '_param_1')) {
				$(ctrlid + '_param_1').focus();
			}
		} catch(e) {}
		var objs = menu.getElementsByTagName('*');
		for(var i = 0; i < objs.length; i++) {
			_attachEvent(objs[i], 'keydown', function(e) {
				e = e ? e : event;
				obj = BROWSER.ie ? event.srcElement : e.target;
				if((obj.type == 'text' && e.keyCode == 13) || (obj.type == 'textarea' && e.ctrlKey && e.keyCode == 13)) {
					if($(ctrlid + '_submit') && tag != 'image') $(ctrlid + '_submit').click();
					doane(e);
				} else if(e.keyCode == 27) {
					hideMenu();
					doane(e);
				}
			});
		}
		if($(ctrlid + '_submit')) $(ctrlid + '_submit').onclick = function() {
			checkFocus();
			if(BROWSER.ie && wysiwyg) {
				setCaret(pos[0]);
			}
			if(wysiwyg) {
				if(!BROWSER.ie) {
					selection = selection ? selection : '';
				}
			}
			str1 = $(ctrlid + '_param_1') && $(ctrlid + '_param_1').value ? $(ctrlid + '_param_1').value : (selection ? selection : '');

			var opentag = '[' + mw_syntaxhighlighter_tag + '=' + $('brush_lang').value + ',' + (($('show_gutter') && $('show_gutter').checked) ? 'true' : 'false') + ']';
			var closetag = '[/' + mw_syntaxhighlighter_tag + ']';

			if(wysiwyg) {
				str1 = preg_replace(['<', '>'], ['&lt;', '&gt;'], str1);
				str1 = str1.replace(/\r?\n/g, '<br />');
			}
			str1 = opentag + str1 + closetag;
			insertText(str1, strlen(opentag), strlen(closetag), false, sel);
			hideMenu();
		};

	} else if(editortype == 'fastpost' || editortype == 'post') {

		var sel = false;
		var seditorkey = editortype;
		if(!isUndefined($(seditorkey + 'message').selectionStart)) {
			sel = $(seditorkey + 'message').selectionEnd - $(seditorkey + 'message').selectionStart;
		} else if(document.selection && document.selection.createRange) {
			$(seditorkey + 'message').focus();
			var sel = document.selection.createRange();
			$(seditorkey + 'message').sel = sel;
			sel = sel.text ? true : false;
		}

		var ctrlid = seditorkey + tag;
		var menuid = ctrlid + '_menu';

		str += '<div id="mw_codearea">'+ mw_lang_codebox['your_code'] +'<br>';
		str += '<textarea id="' + ctrlid + '_param_1" style="width: 98%" cols="50" rows="5" class="txtarea"></textarea></div>';

		if(!$(menuid)) {
			var submitstr = "seditor_insertunit('" + seditorkey + "', '[" + mw_syntaxhighlighter_tag + "=' + $('brush_lang').value + ',' + (($('show_gutter') && $('show_gutter').checked) ? 'true' : 'false') + ']'+$('" + ctrlid + "_param_1').value, '[/" + mw_syntaxhighlighter_tag + "]', null, 1);hideMenu();";
			var menu = document.createElement('div');
			menu.id = menuid;
			menu.style.display = 'none';
			menu.className = 'p_pof upf';
			menu.style.width = '270px';
			$('append_parent').appendChild(menu);
			menu.innerHTML = '<span class="y"><a onclick="hideMenu()" class="flbc" href="javascript:;">'+ mw_lang_codebox['close'] +'</a></span><div class="p_opt cl"><form onsubmit="' + submitstr + ';return false;" autocomplete="off"><div>' + str + '</div><div class="pns mtn"><button type="submit" id="' + ctrlid + '_submit" class="pn pnc"><strong>'+ mw_lang_codebox['submit'] +'</strong></button><button type="button" onClick="hideMenu()" class="pn"><em>'+ mw_lang_codebox['cancle'] +'</em></button></div></form></div>';
		}
		if(sel) {//note 如果选择了内容的处理
			$('mw_codearea').style.display = 'none';
		}
		showMenu({'ctrlid':ctrlid,'evt':'click','duration':3,'cache':0,'drag':1});
	}
}

function mw_highlighter_getSel() {
	if(wysiwyg) {
		try {
			selection = editwin.getSelection();
			return selection.toString();
			//checkFocus();
			//range = selection ? selection.getRangeAt(0) : editdoc.createRange();
			//return readNodes(range.cloneContents(), false);
		} catch(e) {
			try {
				var range = editdoc.selection.createRange();
				if(range.htmlText && range.text) {
					return range.text;
				} else {
					var htmltext = '';
					for(var i = 0; i < range.length; i++) {
						htmltext += range.item(i).outerHTML;
					}
					return htmltext;
				}
			} catch(e) {
				return '';
			}
		}
	} else {
		if(!isUndefined(editdoc.selectionStart)) {
			return editdoc.value.substr(editdoc.selectionStart, editdoc.selectionEnd - editdoc.selectionStart);
		} else if(document.selection && document.selection.createRange) {
			return document.selection.createRange().text;
		} else if(window.getSelection) {
			alert(editdoc);
			return window.getSelection() + '';
		} else {
			return false;
		}
	}
}
