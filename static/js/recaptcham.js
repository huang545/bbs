(function () {var dgebd = function(dd){return document.getElementById(dd)};if($('input[name=seccodehash]').length) {var idhash = $('input[name=seccodehash]').val();var onloadid = 'grecol_' + idhash;var data = dgebd('recptc').innerText;var l9 = document.createElement('script');l9.src = 'https://www.recaptcha.net/recaptcha/api.js?onload=grec_ol';document.body.appendChild(l9);var string = '<input name="seccodehash" type="hidden" value="' + idhash + '" /><span id="checkseccodeverify_' + idhash + '" style="display:none"><img src="https://cdn.jsdelivr.net/gh/huang545/bbs@main/static/image/common$('input[name=seccodeverify]').parent().html(string);setTimeout(function () {dgebd(onloadid).innerHTML = data;}, 2000);window.grec_ol = function () {$('#'+onloadid).toggle();};$('input[type=submit],form input[type=button],form button').click(function(){setTimeout(function(){grecaptcha.reset()}, 2000)});}})()