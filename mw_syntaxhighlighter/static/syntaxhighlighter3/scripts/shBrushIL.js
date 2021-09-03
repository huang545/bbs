/**
 * SyntaxHighlighter
 * http://alexgorbatchev.com/SyntaxHighlighter
 *
 * SyntaxHighlighter is donationware. If you are using it, please donate.
 * http://alexgorbatchev.com/SyntaxHighlighter/donate.html
 *
 * @version
 * 3.0.83 (July 02 2010)
 * 
 * @copyright
 * Copyright (C) 2004-2010 Alex Gorbatchev.
 *
 * @license
 * Dual licensed under the MIT and GPL licenses.
 */
;(function()
{
	// CommonJS
	typeof(require) != 'undefined' ? SyntaxHighlighter = require('shCore').SyntaxHighlighter : null;

	function Brush()
	{
		function getKeywordsIL(str)
		{
			str = str
				.replace(/^\s+|\s+$/g, '')
				.replace(/\s+/g, '|')
				;
			
			return '(?<=([^A-Za-z0-9_.]|^|$))(?:' + str + ')(?=([^A-Za-z0-9_.]|^|$))';
		}
		
		var keywords =	'nop break ldarg.0 ldarg.1 ldarg.2 ldarg.3 ldloc.0 ldloc.1 ldloc.2 ldloc.3 stloc.0 ' + 
						'stloc.1 stloc.2 stloc.3 ldarg.s ldarga.s starg.s ldloc.s ldloca.s stloc.s ldnull ldc.i4.m1 ' + 
						'ldc.i4.M1 ldc.i4.0 ldc.i4.1 ldc.i4.2 ldc.i4.3 ldc.i4.4 ldc.i4.5 ldc.i4.6 ldc.i4.7 ldc.i4.8 ' + 
						'ldc.i4.s ldc.i4 ldc.i8 ldc.r4 ldc.r8 dup pop jmp call calli ret br.s brfalse.s brnull.s brzero.s ' + 
						'brinst.s brtrue.s beq.s bge.s bgt.s ble.s blt.s bne.un.s bge.un.s bgt.un.s ble.un.s blt.un.s ' + 
						'br brfalse brnull brzero brinst brtrue beq bge bgt ble blt bne.un bge.un bgt.un ble.un blt.un ' + 
						'switch ldind.i1 ldind.u1 ldind.i2 ldind.u2 ldind.i4 ldind.u4 ldind.i8 ldind.u8 ldind.i ldind.r4 ' + 
						'ldind.r8 ldind.ref stind.ref stind.i1 stind.i2 stind.i4 stind.i8 stind.r4 stind.r8 add sub mul div ' + 
						'div.un rem rem.un and or xor shl shr shr.un neg not conv.i1 conv.i2 conv.i4 conv.i8 conv.r4 ' + 
						'conv.r8 conv.u4 conv.u8 callvirt cpobj ldobj ldstr newobj castclass isinst conv.r.un unbox ' + 
						'throw ldfld ldflda stfld ldsfld ldsflda stsfld stobj conv.ovf.i1.un conv.ovf.i2.un conv.ovf.i4.un ' + 
						'conv.ovf.i8.un conv.ovf.u1.un conv.ovf.u2.un conv.ovf.u4.un conv.ovf.u8.un conv.ovf.i.un conv.ovf.u.un ' + 
						'box newarr ldlen ldelema ldelem.i1 ldelem.u1 ldelem.i2 ldelem.u2 ldelem.i4 ldelem.u4 ldelem.i8 ldelem.u8 ' + 
						'ldelem.i ldelem.r4 ldelem.r8 ldelem.ref stelem.i stelem.i1 stelem.i2 stelem.i4 stelem.i8 stelem.r4 ' + 
						'stelem.r8 stelem.ref ldelem stelem unbox.any conv.ovf.i1 conv.ovf.u1 conv.ovf.i2 conv.ovf.u2 conv.ovf.i4 ' + 
						'conv.ovf.u4 conv.ovf.i8 conv.ovf.u8 refanyval ckfinite mkrefany ldtoken conv.u2 conv.u1 conv.i conv.ovf.i ' + 
						'conv.ovf.u add.ovf add.ovf.un mul.ovf mul.ovf.un sub.ovf sub.ovf.un endfault endfinally leave leave.s ' + 
						'stind.i conv.u arglist ceq cgt cgt.un clt clt.un ldftn ldvirtftn ldarg ldarga starg ldloc ldloca stloc ' + 
						'localloc endfilter (alignment) volatile tail initobj constrained cpblk initblk rethrow sizeof refanytype ' + 
						'readonly .try catch .locals .method public bool instance valuetype string int32 cil managed [out] hidebysig .maxstack ' + 
						'class uint8 void private protected internal bytearray privatescope famandassem assembly family famorassem final newslot specialname pinvokeimpl ' + 
						'rtspecialname native runtime unmanaged internalcall synchronized noinlining box unbox ' + 
						'br.s nearer ' + 
						'abstract as base bool break byte case catch char checked class const ' +
						'continue decimal default delegate do double else enum event explicit ' +
						'extern false finally fixed float for foreach get goto if implicit in int ' +
						'interface internal is lock long namespace new null object operator out ' +
						'override params private protected public readonly ref return sbyte sealed set ' +
						'short sizeof stackalloc static string struct switch this throw true try ' +
						'typeof uint ulong unchecked unsafe ushort using virtual void while';

		var r = SyntaxHighlighter.regexLib;
		
		this.regexList = [
			{ regex: r.multiLineDoubleQuotedString,					css: 'string' },			// double quoted strings
			{ regex: r.multiLineSingleQuotedString,					css: 'string' },			// single quoted strings
			{ regex: r.singleLineCComments,							css: 'comments' },			// one line comments
			{ regex: r.multiLineCComments,							css: 'comments' },			// multiline comments
			{ regex: new RegExp(getKeywordsIL(keywords), 'gm'),	    css: 'keyword' },			// keywords
			{ regex: /\[[^\[\]]+\]/gm,                              css: 'color3' },
			{ regex: /IL_[0-9a-fA-F]+\:/gm,                         css: 'preprocessor'},
			{ regex: /IL_[0-9a-fA-F]+/gm,                           css: 'preprocessor'},
			{ regex: /\b[0-9A-Fa-f]+\b/gm,                          css: 'value'},
			{ regex: /V_[0-9a-fA-F]+/gm,                            css: 'variable'},
			];
	
		this.forHtmlScript(r.scriptScriptTags);
	};

	Brush.prototype	= new SyntaxHighlighter.Highlighter();
	Brush.aliases	= ['il'];

	SyntaxHighlighter.brushes.IL = Brush;
	SyntaxHighlighter.brushes.il = Brush;

	// CommonJS
	typeof(exports) != 'undefined' ? exports.Brush = Brush : null;
})();
