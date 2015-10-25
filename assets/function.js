function stripstr(str) {
    t = str.replace(/<(\/)?(html|head|title|body|h1|h2|h3|h4|h5|h6|p|br|hr|pre|em|strong|code|b|i|a|ul|li|ol|dl|dt|dd|table|tr|th|td|div|map)([^>]*)>/gi, "");
    t = t.replace(/<(\/)?(iframe|frameset|form|input|select|option|textarea|blockquote|address|object|label|noscript|script)([^>]*)>/gi, "");
	t = t.replace(/<(\/)?(canvas|caption|command|datalist|details|fieldset|figcaption|figure|footer|hgroup|keygen|legend|mark|menu|meter|nav)([^>]*)>/gi, "");
	t = t.replace(/<(\/)?(rp|rt|ruby|dfn|kbd|section|source|time|var|video|wbr|output|center|dir|font|frame|noframes|s|strike|tt|u)([^>]*)>/gi, "");
	t = t.replace(/<(\/)?(!DOCTYPE|!doctype|col|colgroup|del|dfn|kbd|q|samp|small|span|style|sub|summary|sup|tbody|tfoot|cite|meta|optgroup|)([^>]*)>/gi, "");
 	t = t.replace(/<!--[^(-->)]+-->/g, '');
    $(".result textarea").val(t);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function sf(str,lol)
{
	str = str.replace(/á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|ä|å|æ/gi,"a");
	str = str.replace(/đ|ð/gi,"d");
	str = str.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi,"e");
	str = str.replace(/í|ì|ỉ|ĩ|ị|î|ï/gi,"i");
	str = str.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi,"o");
	str = str.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi,"u");
	str = str.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi,"y");
	str = str.replace(/Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Ä|Å|Æ/gi,"A");
	str = str.replace(/Đ/gi,"d");
	str = str.replace(/É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë/gi,"e");
	str = str.replace(/Í|Ì|Ỉ|Ĩ|Ị|Î|Ï/gi,"i");
	str = str.replace(/Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ/gi,"o");
	str = str.replace(/Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự/gi,"u");
	str = str.replace(/Ý|Ỳ|Ỷ|Ỹ|Ỵ/gi,"y");
	str = str.replace(/ /gi,"-");
	str = str.replace(/~|!|@|#|$|%|^|&|_|=|{|}|\|:|;|"|<|,|>|[.,]|[(,]|[),]/gi,"");
	if (lol == 1) 
	{ 
		return (str + '').toUpperCase();; 
	} 
	else 
	{ 
		return (str + '').toLowerCase();; 
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function str2num(val)
{
    val = '0' + val;
    val = parseFloat(val);
    return val;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function utf8_encode(argString) {
  if (argString === null || typeof argString === 'undefined') {
    return '';
  }
  var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
  var utftext = '',
    start, end, stringl = 0;
  start = end = 0;
  stringl = string.length;
  for (var n = 0; n < stringl; n++) {
    var c1 = string.charCodeAt(n);
    var enc = null;
    if (c1 < 128) {
      end++;
    } else if (c1 > 127 && c1 < 2048) {
      enc = String.fromCharCode(
        (c1 >> 6) | 192, (c1 & 63) | 128
      );
    } else if ((c1 & 0xF800) != 0xD800) {
      enc = String.fromCharCode(
        (c1 >> 12) | 224, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
      );
    } else { // surrogate pairs
      if ((c1 & 0xFC00) != 0xD800) {
        throw new RangeError('Unmatched trail surrogate at ' + n);
      }
      var c2 = string.charCodeAt(++n);
      if ((c2 & 0xFC00) != 0xDC00) {
        throw new RangeError('Unmatched lead surrogate at ' + (n - 1));
      }
      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
      enc = String.fromCharCode(
        (c1 >> 18) | 240, ((c1 >> 12) & 63) | 128, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
      );
    }
    if (enc !== null) {
      if (end > start) {
        utftext += string.slice(start, end);
      }
      utftext += enc;
      start = end = n + 1;
    }
  }
  if (end > start) {
    utftext += string.slice(start, stringl);
  }
  return utftext;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function md5(str) {
  if (str == '') return '';
  var xl;
  var rotateLeft = function (lValue, iShiftBits) {
    return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
  };
  var addUnsigned = function (lX, lY) {
    var lX4, lY4, lX8, lY8, lResult;
    lX8 = (lX & 0x80000000);
    lY8 = (lY & 0x80000000);
    lX4 = (lX & 0x40000000);
    lY4 = (lY & 0x40000000);
    lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
    if (lX4 & lY4) {
      return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
    }
    if (lX4 | lY4) {
      if (lResult & 0x40000000) {
        return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
      } else {
        return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
      }
    } else {
      return (lResult ^ lX8 ^ lY8);
    }
  };
  var _F = function (x, y, z) {
    return (x & y) | ((~x) & z);
  };
  var _G = function (x, y, z) {
    return (x & z) | (y & (~z));
  };
  var _H = function (x, y, z) {
    return (x ^ y ^ z);
  };
  var _I = function (x, y, z) {
    return (y ^ (x | (~z)));
  };
  var _FF = function (a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_F(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };
  var _GG = function (a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_G(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };
  var _HH = function (a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_H(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };
  var _II = function (a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_I(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };
  var convertToWordArray = function (str) {
    var lWordCount;
    var lMessageLength = str.length;
    var lNumberOfWords_temp1 = lMessageLength + 8;
    var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - (lNumberOfWords_temp1 % 64)) / 64;
    var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
    var lWordArray = new Array(lNumberOfWords - 1);
    var lBytePosition = 0;
    var lByteCount = 0;
    while (lByteCount < lMessageLength) {
      lWordCount = (lByteCount - (lByteCount % 4)) / 4;
      lBytePosition = (lByteCount % 4) * 8;
      lWordArray[lWordCount] = (lWordArray[lWordCount] | (str.charCodeAt(lByteCount) << lBytePosition));
      lByteCount++;
    }
    lWordCount = (lByteCount - (lByteCount % 4)) / 4;
    lBytePosition = (lByteCount % 4) * 8;
    lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
    lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
    lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
    return lWordArray;
  };
  var wordToHex = function (lValue) {
    var wordToHexValue = '',
      wordToHexValue_temp = '',
      lByte, lCount;
    for (lCount = 0; lCount <= 3; lCount++) {
      lByte = (lValue >>> (lCount * 8)) & 255;
      wordToHexValue_temp = '0' + lByte.toString(16);
      wordToHexValue = wordToHexValue + wordToHexValue_temp.substr(wordToHexValue_temp.length - 2, 2);
    }
    return wordToHexValue;
  };
  var x = [],
    k, AA, BB, CC, DD, a, b, c, d, S11 = 7,
    S12 = 12,
    S13 = 17,
    S14 = 22,
    S21 = 5,
    S22 = 9,
    S23 = 14,
    S24 = 20,
    S31 = 4,
    S32 = 11,
    S33 = 16,
    S34 = 23,
    S41 = 6,
    S42 = 10,
    S43 = 15,
    S44 = 21;
  str = this.utf8_encode(str);
  x = convertToWordArray(str);
  a = 0x67452301;
  b = 0xEFCDAB89;
  c = 0x98BADCFE;
  d = 0x10325476;
  xl = x.length;
  for (k = 0; k < xl; k += 16) {
    AA = a;
    BB = b;
    CC = c;
    DD = d;
    a = _FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
    d = _FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
    c = _FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
    b = _FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
    a = _FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
    d = _FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
    c = _FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
    b = _FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
    a = _FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
    d = _FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
    c = _FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
    b = _FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
    a = _FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
    d = _FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
    c = _FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
    b = _FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
    a = _GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
    d = _GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
    c = _GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
    b = _GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
    a = _GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
    d = _GG(d, a, b, c, x[k + 10], S22, 0x2441453);
    c = _GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
    b = _GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
    a = _GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
    d = _GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
    c = _GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
    b = _GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
    a = _GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
    d = _GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
    c = _GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
    b = _GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
    a = _HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
    d = _HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
    c = _HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
    b = _HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
    a = _HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
    d = _HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
    c = _HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
    b = _HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
    a = _HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
    d = _HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
    c = _HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
    b = _HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
    a = _HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
    d = _HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
    c = _HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
    b = _HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
    a = _II(a, b, c, d, x[k + 0], S41, 0xF4292244);
    d = _II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
    c = _II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
    b = _II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
    a = _II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
    d = _II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
    c = _II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
    b = _II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
    a = _II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
    d = _II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
    c = _II(c, d, a, b, x[k + 6], S43, 0xA3014314);
    b = _II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
    a = _II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
    d = _II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
    c = _II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
    b = _II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
    a = addUnsigned(a, AA);
    b = addUnsigned(b, BB);
    c = addUnsigned(c, CC);
    d = addUnsigned(d, DD);
  }
  var temp = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);
  return temp.toLowerCase();
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function setcolor(color) {
	$.ajax({
		url : '../../process/set-color.php',
		type : 'post',
		data : {
			color : color
		}
	});
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function logout()
{
	bootbox.confirm("Bạn có chắc là muốn đăng xuất?", function(result) {
		if (result == true) {
		$.ajax({
				url : '../../logout.php',
				success : function (result)
				{
					window.location="../../trang-chu";
				}
			});
		}
	}); 
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function change_img(num){
   $('#img01').attr('src','../../410x550/'+$('#img'+num).attr('data'));
   $('#img01').attr('data-BigImgsrc','../../'+$('#img'+num).attr('data'));
   Layout.initImageZoom();
};
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#rateit').bind('rated', function ()
{
	$.ajax({
        url : '../../process/rating.php',
        type : 'post',
        dataType : 'json',
        data : {
            value : $('#rateit').rateit('value'),
			bookid: $('#rateit').data('bookid')
        },
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            }
        }
    });
    return false;
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function wished(id)
{
	$('#wish').removeClass('default');
	$('#wish').addClass('btn-primary');
	$('#wishi').removeClass('fa-heart-o');
	$('#wishi').addClass('fa-heart');
	$('#wish').attr('onclick','delwish('+id+')');
}
function rmwish(id)
{
	$('#wish').removeClass('btn-primary');
	$('#wish').addClass('default');
	$('#wishi').removeClass('fa-heart');
	$('#wishi').addClass('fa-heart-o');
	$('#wish').attr('onclick','wish('+id+')');
}
function wish(id)
{
	$.ajax({
	url : '../../process/add-to-wishlist.php',
	type : 'post',
	dataType : 'json',
	data : {
		id: id
	},
	success : function (result)
	{
		if (!result.hasOwnProperty('error') || result['error'] != 'success')
		{
			alert('ERROR');
			return false;
		}
		else
		{
			if (result.id == '4')
			{
				bootbox.dialog({
					message: "Bạn có muốn đăng nhập để thêm sách vào yêu thích?",
					title: "Bạn chưa đăng nhập",
					buttons: {
						main: {
						label: "Đăng nhập",
						className: "btn-primary",
						callback: function() {
							window.location='../../dang-nhap';
						}
						}
					}
				});
			}
			else
			{
				if (result.id == '2')
				{
					bootbox.alert("Sách này đã có trong danh sách yêu thích của bạn rồi");
				}
			}

		}
		if (result.done == '1'){
			wished(id);
		}
	}
	});
	return false;
};
function delwish(id)
{
	$.ajax({
	url : '../../process/add-to-wishlist.php',
	type : 'post',
	dataType : 'json',
	data : {
		id: id,
		del: 1
	},
	success : function (result)
	{
		if (!result.hasOwnProperty('error') || result['error'] != 'success')
		{
			alert('ERROR');
			return false;
		}
		else
		{
			if (result.id == '5')
			{
				rmwish(id);
			}
		}
		if (result.done == '1'){
			rmwish(id);
		}
	}
});
return false;
};
function delwish2(id)
{
	$.ajax({
	url : '../../process/add-to-wishlist.php',
	type : 'post',
	dataType : 'json',
	data : {
		id: id,
		del: 1
	},
	success : function (result)
	{
		if (!result.hasOwnProperty('error') || result['error'] != 'success')
		{
			alert('ERROR');
			return false;
		}
		if (result.done == 1){
			if ($('#contentwish').attr('count') == '1')
			{
				$('#content2wish').hide('fast');
				$('#emptywish').show('slow');
			}
			else
			{
				$('#contentwish').attr('count',str2num($('#contentwish').attr('count'))-1);
				$('#wish'+id).hide('slow');
			}
		};
	}
});
return false;
};
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function thanked(id,num)
{
	$('#tks'+id).removeClass('default');
	$('#tks'+id).addClass('btn-primary');
	$('#tksi'+id).removeClass('fa-thumbs-o-up');
	$('#tksi'+id).addClass('fa-thumbs-up');
	if (num != '0')
	{
		$('#tkst'+id).text(num);
	}
}
function rmthanks(id,num)
{
	$('#tks'+id).removeClass('btn-primary');
	$('#tks'+id).addClass('default');
	$('#tksi'+id).removeClass('fa-thumbs-up');
	$('#tksi'+id).addClass('fa-thumbs-o-up');
	$('#tkst'+id).text(num);
}
function thanks(id)
{
  $.ajax({
	url : '../../process/thanks.php',
	type : 'post',
	dataType : 'json',
	data : {
		id: id
	},
	success : function (result)
	{
		if (!result.hasOwnProperty('error') || result['error'] != 'success')
		{
			alert('ERROR');
			return false;
		}
		else
		{
			if (result.err != '0') {
				if (result.err == '1') {
					bootbox.dialog({
					message: "Bạn có muốn đăng nhập để thích nhận xét này?",
					title: "Bạn chưa đăng nhập",
					buttons: {
						main: {
						label: "Đăng nhập",
						className: "btn-primary",
						callback: function() {
							window.location='../../dang-nhap';
						}
						}
					}
					});
				}
			}
			if (result.done == '1'){
				if (result.lol == '1') 
				{
					thanked(id,result.thanks);
				}
				else
				{
					rmthanks(id,result.thanks);					
				}
			}
		}
	}
});
return false;
};
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function fastview(id)
{
	$('#loading3').fadeIn('fast');
	$.ajax({
		url : '../../process/fast-view.php',
		type : 'post',
		dataType : 'json',
		data : {
			id : id
		},
		success : function (result)
		{
			if (!result.hasOwnProperty('error') || result['error'] != 'success')
			{
				alert('ERROR');
				return false;
			}
			if (result['done'] == '1')
			{
				$('#title0').text(result['title']);
				$('#author0').text(result['author']);
				$('#img0').attr('src','../../410x550/'+result['img1']);
				$('#des0').text(result['des']);
				if (result['remain'] == 0) 
				{ 
					$('#remain0').text('Đã hết'); 
					$('#btnborrow0').attr('style','background: #000;padding: 7px 10px;');
					$('#btnborrow0').html("<i class='fa fa-slack'></i>&nbsp;&nbsp;Đã hết sách");
					$('#btnborrow0').removeAttr('onclick');
				} 
				else 
				{
					$('#remain0').text(result['remain']);
					$('#btnborrow0').attr('style','padding: 7px 10px;');
					$('#btnborrow0').attr('onclick','cart('+id+')');
					$('#btnborrow0').html("<i class='fa fa-legal'></i>&nbsp;&nbsp;Mượn");
				}
				$('#nrating0').text(result['nrating']);
				$('#borrow0').text(result['borrow']);
				$('#rating1').rateit('value',result['rating']);
				$('#loading3').fadeOut('slow');
			}
		}
	});
};
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function cart(id)
{
	$.ajax({
		url : '../../process/add-to-cart.php',
		type : 'post',
		dataType : 'json',
		data : {
			id : id
		},
		success : function (result)
		{
			if (!result.hasOwnProperty('error') || result['error'] != 'success')
			{
				alert('ERROR');
				return false;
			}
			else
			{
				if (result.id == '4'){
					bootbox.dialog({
					message: "Bạn có muốn đăng nhập để mượn sách?",
					title: "Bạn chưa đăng nhập",
					buttons: {
						main: {
						label: "Đăng nhập",
						className: "btn-primary",
						callback: function() {
							window.location='../../dang-nhap';
						}
						}
					}
					});
					return false;	
				}
				if (result.id == '3'){
					bootbox.alert("Lỗi");
					return false;	
				}
				if (result.id == '3'){
					bootbox.alert("Sách không có thật");
					return false;	
				}
				if (result.id == '2'){
					bootbox.alert("Sách đã có trong giỏ hàng");
					return false;	
				}
				if (result.id == '6'){
					bootbox.dialog({
					message: "Bạn có muốn thêm sách vào yêu thích để nhận thông bao khi có sách?",
					title: "Sách đã hết hàng",
					buttons: {
						main: {
						label: "Thêm vào yêu thích",
						className: "btn-primary",
						callback: function() {
							wish(id);
						}
						}
					}
					});
					return false;	
				}
				if (result.limit == '1'){
					bootbox.dialog({
					message: "Giỏ sách của bạn đã đầy, không thể tiếp tục thêm sách, bạn có muốn xem lại giỏ sách của mình?",
					title: "Giỏ sách của bạn đã đầy",
					buttons: {
						main: {
						label: "Xem lại",
						className: "btn-primary",
						callback: function() {
							window.location='../../gio-sach';
							}
						}
					}
					});
					return false;	
				}
				if (result.done == 1){
					window.location='../../gio-sach';
				}
			}
		}
	});
}
function delcart(id) 
{
	$.ajax({
		url : '../../process/add-to-cart.php',
		type : 'post',
		dataType : 'json',
		data : {
			id : id,
			del : 1
		},
		success : function (result)
		{
			if (!result.hasOwnProperty('error') || result['error'] != 'success')
			{
				alert('ERROR');
				return false;
			}
			else
			{
				if (result.id == '5'){
					alert('Lỗi');
					return false;	
				}
				if (result.done == 1){
					if ($('#content3').attr('count') == '1')
					{
						$('#content2').hide('fast');
						$('#emptycart').show('slow');
						$('#content3').text(0);
					}
					//////////////////////////////////////////////////////////////////// Giảm tổng số sách
					$('#content').attr('count',str2num($('#content').attr('count'))-1);
					$('#content3').attr('count',str2num($('#content').attr('count')));
					$('#content3').text(str2num($('#content').attr('count')));
					$('#content4').text(str2num($('#content').attr('count'))+' Cuốn');
					///////////////////////////////////////////////////////////////////
					$('#cart'+id).hide('slow',function (){$('#cart'+id).remove()});
					$('#2cart'+id).hide('slow',function (){$('#2cart'+id).remove()});
				};
			}
		}
	});
};
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function review(idb)
{
	$.ajax({
		url : '../../process/add-review.php',
		type : 'post',
		dataType : 'json',
		data : {
			content : $('#content').val(),
			rating: $('#rateit2').rateit('value'),
			idb: idb
		},
		success : function (result)
		{
			if (!result.hasOwnProperty('error') || result['error'] != 'success')
			{
				alert('ERROR');
				return false;
			}
			if (result.err != ''){
				$('#err').html(result.err);
				$('#err').show('fast');
			} else $('#err').hide('fast');
			if (result.done == 'done'){
				$('#noreview').hide('fast');
				$('#review').before(result.html);
				$('#content').val('');
				$('#rateit2').rateit('reset');
			}
		}
	});
	return false;
};
function comment(idb)
{
	$.ajax({
		url : '../../process/add-comment.php',
		type : 'post',
		dataType : 'json',
		data : {
			content : $('#content2').val(),
			idb: idb
		},
		success : function (result)
		{
			if (!result.hasOwnProperty('error') || result['error'] != 'success')
			{
				alert('ERROR');
				return false;
			}
			if (result.err != ''){
				$('#err2').html(result.err);
				$('#err2').show('fast');
			} else $('#err2').hide('fast');
			if (result.done == 'done'){
				$('#nocomment').hide('fast');
				$('#comment').before(result.html);
				$('#content2').val('');
			}
		}
	});
	return false;
};
///////////////////////////////////////////////////////////////////////////////////////////////////////
function pulsw(id)
{
	$('#'+id).pulsate({color: "#dfba49",repeat: false});
}
function pulse(id)
{
	$('#'+id).pulsate({color: "#f3565d",repeat: false});
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
function cancelsubscribe()
{
	$.ajax({
        url : '../../process/cancel-subscribe-check.php',
        type : 'post',
        dataType : 'json',
        data : {
            email : $('#email').val()
        },
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            } else
			{
				if (result.email != '0'){
					if (result.email == '1'){ $('#erremail').attr({'data-original-title':'Chưa nhập địa chỉ email','class':'fa fa-warning tooltips'}); $('#emaildiv').attr('class','form-group has-warning'); pulsw('email'); }
					if (result.email == '2'){ $('#erremail').attr({'data-original-title':'Địa chỉ email này chưa đăng ký theo dõi','class':'fa fa-exclamation tooltips'}); $('#emaildiv').attr('class','form-group has-error'); pulse('email');}
					if (result.email == '3'){ $('#erremail').attr({'data-original-title':'Địa chỉ email không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#emaildiv').attr('class','form-group has-error');pulse('email');}
					Metronic.scrollTo2($('#emaildiv'),-200);
				} else 
				{
					$('#erremail').attr({'data-original-title':'Địa chỉ email đã đăng ký theo dõi','class':'fa fa-check tooltips'}); $('#emaildiv').attr('class','form-group has-success');
				}
			}
			if (result.done == 1) {
				$('#done').show('fast');
			} else $('#done').hide('fast');
        }
    });
	return false;
};
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function changepass()
{
	$.ajax({
        url : '../../process/change-pass-check.php',
        type : 'post',
        dataType : 'json',
        data : {
            pass1: md5($('#pass1').val()),
			password: md5($('#password').val()),
			confirmpassword: md5($('#confirmpassword').val())
        },
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            }
			if (result.pass1 != 0){
				if (result.pass1 == '1'){ $('#errpass1').attr({'data-original-title':'Chưa nhập mật khẩu','class':'fa fa-warning tooltips'}); $('#pass1div').attr('class','form-group has-warning');pulsw('pass1');}
				if (result.pass1 == '2'){ $('#errpass1').attr({'data-original-title':'Mật khẩu chưa chính xác','class':'fa fa-exclamation tooltips'}); $('#pass1div').attr('class','form-group has-error'); pulse('pass1');}
				Metronic.scrollTo2($('#pass1div'),-200);
			} else 
			{
				$('#errpass1').attr({'data-original-title':'Mật khẩu chính xác','class':'fa fa-check tooltips'}); $('#pass1div').attr('class','form-group has-success');
				if (result.password != 0)
				{
					if (result.password == '1'){ $('#errpassword').attr({'data-original-title':'Chưa nhập mật khẩu mới','class':'fa fa-warning tooltips'}); $('#passworddiv').attr('class','form-group has-warning');pulsw('password');}
					Metronic.scrollTo2($('#passworddiv'),-200);
				} else 
				{
					$('#errpassword').attr({'data-original-title':'Mật khẩu mới hợp lệ','class':'fa fa-check tooltips'}); $('#passworddiv').attr('class','form-group has-success');
					if (result.confirmpassword != 0)
					{
						if (result.confirmpassword == '1'){ $('#errconfirmpassword').attr({'data-original-title':'Chưa xác nhận mật khẩu mới','class':'fa fa-warning tooltips'}); $('#confirmpassworddiv').attr('class','form-group has-warning'); pulsw('confirmpassword');}
						if (result.confirmpassword == '2'){ $('#errconfirmpassword').attr({'data-original-title':'Xác nhận mật khẩu chưa chính xác','class':'fa fa-exclamation tooltips'}); $('#confirmpassworddiv').attr('class','form-group has-error'); pulse('confirmpassword');}
						Metronic.scrollTo2($('#confirmpassworddiv'),-200);
					} else 
					{
						$('#errconfirmpassword').attr({'data-original-title':'Xác nhận mật khẩu mới chính xác','class':'fa fa-check tooltips'}); $('#confirmpassworddiv').attr('class','form-group has-success');										
					}
				}
			}
			if (result.done == 1){
				$('#done').show('fast');
			} else $('#done').hide('fast');
        }
    });
    return false;
};
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function forgot()
{
	$.ajax({
        url : '../../process/forgot-check.php',
        type : 'post',
        dataType : 'json',
        data : {
            email : $('#email').val()
        },
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            }
			if (result.email != 0){
				if (result.email == '1'){ $('#erremail').attr({'data-original-title':'Chưa nhập địa chỉ email','class':'fa fa-warning tooltips'}); $('#emaildiv').attr('class','form-group has-warning');pulsw('email');}
				if (result.email == '2'){ $('#erremail').attr({'data-original-title':'Địa chỉ email này chưa được đăng ký','class':'fa fa-exclamation tooltips'}); $('#emaildiv').attr('class','form-group has-error'); pulse('email');}
				if (result.email == '3'){ $('#erremail').attr({'data-original-title':'Địa chỉ email không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#emaildiv').attr('class','form-group has-error'); pulse('email');}
				Metronic.scrollTo2($('#emaildiv'),-200);
			} else { $('#erremail').attr({'data-original-title':'Địa chỉ email chính xác','class':'fa fa-check tooltips'}); $('#emaildiv').attr('class','form-group has-success'); }
			if (result.done == '1'){
				$('#done').show('fast');
			} else $('#done').hide('fast');
        }
    });
    return false;
};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function login()
{
	$.ajax({
        url : '../../process/login-check.php',
        type : 'post',
        dataType : 'json',
        data : {
            scode : $('#scode').val(),
			password: md5($('#password').val()),
			remember: $('#remember').val(),
			ref: $('#ref').val()
        },
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            } else 
			{
				if (result.scode != '0')
				{
					if (result.scode == '1'){ $('#errscode').attr({'data-original-title':'Chưa nhập mã học sinh','class':'fa fa-warning tooltips'}); $('#scodediv').attr('class','form-group has-warning'); pulsw('scode');}
					if (result.scode == '2'){ $('#errscode').attr({'data-original-title':'Mã học sinh chưa chính xác','class':'fa fa-exclamation tooltips'}); $('#scodediv').attr('class','form-group has-error'); pulse('scode');}
					if (result.scode == '3'){ $('#errscode').attr({'data-original-title':'Mã học sinh không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#scodediv').attr('class','form-group has-error'); pulse('scode');}
					Metronic.scrollTo2($('#scodediv'),-200);
				} else 
				{ 
					$('#errscode').attr({'data-original-title':'Mã học sinh chính xác','class':'fa fa-check tooltips'}); $('#scodediv').attr('class','form-group has-success');
					if (result.password != '0')
					{
						if (result.password == '1'){ $('#errpassword').attr({'data-original-title':'Chưa nhập mật khẩu','class':'fa fa-warning tooltips'}); $('#passworddiv').attr('class','form-group has-warning');pulsw('password');}
						if (result.password == '2'){ $('#errpassword').attr({'data-original-title':'Mật khẩu chưa chính xác','class':'fa fa-exclamation tooltips'}); $('#passworddiv').attr('class','form-group has-error'); pulse('password');}
						Metronic.scrollTo2($('#passworddiv'),-200);
					} else 
					{
						$('#errpassword').attr({'data-original-title':'Mật khẩu chính xác','class':'fa fa-check tooltips'}); $('#passworddiv').attr('class','form-group has-success');
					}
				}
			}
			if (result.done == 1){
				$('#done').html('Đăng nhập thành công');
				$('#done').removeClass('alert-warning');
				$('#done').addClass('alert-success');
				$('#done').show('fast')
				if ($('#ref').val().indexOf('localhost') != -1) ////////////////////////////////////////////////////////////////
				{
					window.location=$('#ref').val();
				}
			} else 
			if (result.done == 2) 
			{
				$('#done').html('Tài khoản chưa được xác minh, vui lòng liên hệ BQT nếu cần thiết');	
				$('#done').removeClass('alert-success');
				$('#done').addClass('alert-warning');
				$('#done').show('fast');
			} 
			else $('#done').hide('fast');
        }
    });
    return false;
};
////////////////////////////////////////////////////////////////////////////////////////////
function register()
{
	$.ajax({
        url : '../../process/register-check.php',
        type : 'post',
        dataType : 'json',
        data : {
            name : $('#name').val(),
            email : $('#email').val(),
			class1: $('#class').val(),
			birthday: $('#birthday').val(),
			scode: $('#scode').val(),
			password: md5($('#password').val()),
			confirmpassword: md5($('#confirmpassword').val()),
			sub: $('#sub').val()
        },
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            }
			if (result.name != '0'){
				$('#errname').attr({'data-original-title':'Chưa nhập tên','class':'fa fa-warning tooltips'}); $('#namediv').attr('class','form-group has-warning'); pulsw('name');
				Metronic.scrollTo2($('#namediv'),-200);
			} else 
			{	
				$('#errname').attr({'data-original-title':'Tên hợp lệ','class':'fa fa-check tooltips'}); $('#namediv').attr('class','form-group has-success');
				if (result.class != '0'){
					if (result.class == '1'){ $('#errclass').attr({'data-original-title':'Chưa nhập lớp','class':'fa fa-warning tooltips'}); $('#classdiv').attr('class','form-group has-warning'); pulsw('class');}
					if (result.class == '3'){ $('#errclass').attr({'data-original-title':'Lớp không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#classdiv').attr('class','form-group has-error'); pulse('class');}
					Metronic.scrollTo2($('#classdiv'),-200);
				} else 
				{
					$('#errclass').attr({'data-original-title':'Lớp hợp lệ','class':'fa fa-check tooltips'}); $('#classdiv').attr('class','form-group has-success');
					if (result.birthday != '0'){
						if (result.birthday == '1'){ $('#errbirthday').attr({'data-original-title':'Chưa nhập ngày sinh','class':'fa fa-warning tooltips'}); $('#birthdaydiv').attr('class','form-group has-warning'); pulsw('birthday');}
						if (result.birthday == '3'){ $('#errbirthday').attr({'data-original-title':'Ngày sinh không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#birthdaydiv').attr('class','form-group has-error'); pulse('birthday');}
						Metronic.scrollTo2($('#birthdaydiv'),-200);
					} else
					{	
						$('#errbirthday').attr({'data-original-title':'Ngày sinh hợp lệ','class':'fa fa-check tooltips'}); $('#birthdaydiv').attr('class','form-group has-success');
						if (result.email != '0')
						{
							if (result.email == '1'){ $('#erremail').attr({'data-original-title':'Chưa nhập địa chỉ email','class':'fa fa-warning tooltips'}); $('#emaildiv').attr('class','form-group has-warning'); pulsw('email');}
							if (result.email == '2'){ $('#erremail').attr({'data-original-title':'Địa chỉ email này chưa được đăng ký','class':'fa fa-exclamation tooltips'}); $('#emaildiv').attr('class','form-group has-error'); pulse('email');}
							if (result.email == '3'){ $('#erremail').attr({'data-original-title':'Địa chỉ email không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#emaildiv').attr('class','form-group has-error'); pulse('email');}
							Metronic.scrollTo2($('#emaildiv'),-200);
						} else 
						{	
							$('#erremail').attr({'data-original-title':'Địa chỉ email hợp lệ','class':'fa fa-check tooltips'}); $('#emaildiv').attr('class','form-group has-success');
							if (result.scode != '0'){
								if (result.scode == '1'){ $('#errscode').attr({'data-original-title':'Chưa nhập mã học sinh','class':'fa fa-warning tooltips'}); $('#scodediv').attr('class','form-group has-warning'); pulsw('scode');}
								if (result.scode == '3'){ $('#errscode').attr({'data-original-title':'Mã học sinh không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#scodediv').attr('class','form-group has-error');}
								Metronic.scrollTo2($('#scodediv'),-200);	
							} else
							{
								$('#errscode').attr({'data-original-title':'Mã học sinh hợp lệ','class':'fa fa-check tooltips'}); $('#scodediv').attr('class','form-group has-success');
								if (result.password != '0'){
									$('#errpassword').attr({'data-original-title':'Chưa nhập mật khẩu','class':'fa fa-warning tooltips'}); $('#passworddiv').attr('class','form-group has-warning'); pulsw('password');
									Metronic.scrollTo2($('#passworddiv'),-200);
								} else 
								{
									$('#errpassword').attr({'data-original-title':'Mật khẩu hợp lệ','class':'fa fa-check tooltips'}); $('#passworddiv').attr('class','form-group has-success');
									if (result.confirmpassword != '0'){
										if (result.confirmpassword == '1'){ $('#errconfirmpassword').attr({'data-original-title':'Chưa xác nhận mật khẩu','class':'fa fa-warning tooltips'}); $('#confirmpassworddiv').attr('class','form-group has-warning'); pulsw('confirmpassword');}
										if (result.confirmpassword == '2'){ $('#errconfirmpassword').attr({'data-original-title':'Xác nhận mật khẩu chưa chính xác','class':'fa fa-exclamation tooltips'}); $('#confirmpassworddiv').attr('class','form-group has-error'); pulse('confirmpassword');}
										Metronic.scrollTo2($('#confirmpassworddiv'),-200);
									} else
									{
										$('#errconfirmpassword').attr({'data-original-title':'Xác nhận mật khẩu chính xác','class':'fa fa-check tooltips'}); $('#confirmpassworddiv').attr('class','form-group has-success');
									}
								}
							}
						}
					}
				}
			}
			if (result.done == '1'){
				$('#done').show('fast');
			} else $('#done').hide('fast');
        }
    });
    return false;
};
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function subscribe()
{
	$.ajax({
        url : '../../process/subscribe-check.php',
        type : 'post',
        dataType : 'json',
        data : {
            email : $('#email').val()
        },
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            }
			else
			{
				if (result.email != '0'){
					if (result.email == '1'){ $('#erremail').attr({'data-original-title':'Chưa nhập địa chỉ email','class':'fa fa-warning tooltips'}); $('#emaildiv').attr('class','form-group has-warning'); pulsw('email');}
					if (result.email == '2'){ $('#erremail').attr({'data-original-title':'Địa chỉ email này đã đăng ký theo dõi','class':'fa fa-exclamation tooltips'}); $('#emaildiv').attr('class','form-group has-error'); pulse('email');}
					if (result.email == '3'){ $('#erremail').attr({'data-original-title':'Địa chỉ email không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#emaildiv').attr('class','form-group has-error'); pulse('email');}
					Metronic.scrollTo2($('#emaildiv'),-200);
				} else 
				{
					$('#erremail').attr({'data-original-title':'Địa chỉ email chưa đăng ký theo dõi','class':'fa fa-check tooltips'}); $('#emaildiv').attr('class','form-group has-success');
				}
			}
			if (result.done == '1'){
				$('#done').show('fast');
			} else $('#done').hide('fast');
        }
    });
    return false;
};
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function changeimagemethod()
{
	var method=$('#imagemethod').val();
	if (method == '1')
	{
		$('#image').attr('style','padding-left: 5px;padding-top: 5px;');
		$('#image').attr('type','file');
		$('#errimage').attr('style','display: block;');
	}
	else if (method == '2')
	{
		$('#image').attr('style','');
		$('#image').attr('type','text');
		$('#errimage').attr('style','display: block;');
	}
	else if (method == '3')
	{
		$('#image').attr('style','display: none;');
		$('#errimage').attr('style','display: none;');
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function request()
{
	var fd = new FormData(document.getElementById("request"));
	$.ajax({
        url : '../../process/request-check.php',
        type : 'post',
        dataType : 'json',
        data : fd,
		processData: false,
		contentType: false,
		enctype: 'multipart/form-data',
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            }
			else
			{
				if (result.title == '1')
				{ 
					$('#errtitle').attr({'data-original-title':'Chưa nhập địa chỉ tên sách','class':'fa fa-warning tooltips'}); 
					$('#titlediv').attr('class','form-group has-warning'); pulsw('title');
					Metronic.scrollTo2($('#titlediv'),-200);
				} else 
				{
					$('#errtitle').attr({'data-original-title':'Tên sách hợp lệ','class':'fa fa-check tooltips'}); 
					$('#titlediv').attr('class','form-group has-success');
					if (result.author == '1')
					{ 
						$('#errauthor').attr({'data-original-title':'Chưa nhập tác giả','class':'fa fa-warning tooltips'}); 
						$('#authordiv').attr('class','form-group has-warning'); pulsw('author');
						Metronic.scrollTo2($('#authordiv'),-200);
					} else 
					{
						$('#errauthor').attr({'data-original-title':'Tác giả hợp lệ','class':'fa fa-check tooltips'}); 
						$('#authordiv').attr('class','form-group has-success');
						if (result.image != '0'){
							if (result.image == '1'){ $('#errimage').attr({'data-original-title':'Chưa chọn ảnh','class':'fa fa-warning tooltips'}); $('#imagediv').attr('class','form-group has-warning'); pulsw('image');}
							if (result.image == '2'){ $('#errimage').attr({'data-original-title':'Ảnh không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#imagediv').attr('class','form-group has-error'); pulse('image');}
							if (result.image == '3'){ $('#errimage').attr({'data-original-title':'Ảnh quá nặng','class':'fa fa-exclamation tooltips'}); $('#imagediv').attr('class','form-group has-error'); pulse('image');}
							Metronic.scrollTo2($('#imagediv'),-200);
						} else 
						{
							$('#errimage').attr({'data-original-title':'Ảnh hợp lệ','class':'fa fa-check tooltips'}); $('#imagediv').attr('class','form-group has-success');
							$('#errreason').attr({'data-original-title':'Lý do hợp lệ hoặc không có lý do','class':'fa fa-check tooltips'}); $('#reasondiv').attr('class','form-group has-success');
						}
					}
				}
				
			}
			if (result.done == '1'){
				$('#done').show('fast');
			} else $('#done').hide('fast');
        }
    });
    return false;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function contribute()
{
	var fd = new FormData(document.getElementById("request"));
	$.ajax({
        url : '../../process/contribute-check.php',
        type : 'post',
        dataType : 'json',
        data : fd,
		processData: false,
		contentType: false,
		enctype: 'multipart/form-data',
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || result['error'] != 'success')
            {
                alert('ERROR');
                return false;
            }
			else
			{
				if (result.title == '1')
				{ 
					$('#errtitle').attr({'data-original-title':'Chưa nhập địa chỉ tên sách','class':'fa fa-warning tooltips'}); 
					$('#titlediv').attr('class','form-group has-warning'); pulsw('title');
					Metronic.scrollTo2($('#titlediv'),-200);
				} else 
				{
					$('#errtitle').attr({'data-original-title':'Tên sách hợp lệ','class':'fa fa-check tooltips'}); 
					$('#titlediv').attr('class','form-group has-success');
					if (result.author == '1')
					{ 
						$('#errauthor').attr({'data-original-title':'Chưa nhập tác giả','class':'fa fa-warning tooltips'}); 
						$('#authordiv').attr('class','form-group has-warning'); pulsw('author');
						Metronic.scrollTo2($('#authordiv'),-200);
					} else 
					{
						$('#errauthor').attr({'data-original-title':'Tác giả hợp lệ','class':'fa fa-check tooltips'}); 
						$('#authordiv').attr('class','form-group has-success');
						if (result.image != '0'){
							if (result.image == '1'){ $('#errimage').attr({'data-original-title':'Chưa chọn ảnh','class':'fa fa-warning tooltips'}); $('#imagediv').attr('class','form-group has-warning'); pulsw('image');}
							if (result.image == '2'){ $('#errimage').attr({'data-original-title':'Ảnh không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#imagediv').attr('class','form-group has-error'); pulse('image');}
							if (result.image == '3'){ $('#errimage').attr({'data-original-title':'Ảnh quá nặng','class':'fa fa-exclamation tooltips'}); $('#imagediv').attr('class','form-group has-error'); pulse('image');}
							Metronic.scrollTo2($('#imagediv'),-200);
						} else 
						{
							$('#errimage').attr({'data-original-title':'Ảnh hợp lệ','class':'fa fa-check tooltips'}); $('#imagediv').attr('class','form-group has-success');
							$('#errreason').attr({'data-original-title':'Lý do hợp lệ hoặc không có lý do','class':'fa fa-check tooltips'}); $('#reasondiv').attr('class','form-group has-success');
						}
					}
				}
			}
			if (result.done == '1'){
				$('#done').show('fast');
			} else $('#done').hide('fast');
        }
    });
    return false;
}
///////////////////////////////////////////////////////////////////////////////////////////////////
var title=$(document).attr('title');
var Notification = window.Notification || window.mozNotification || window.webkitNotification;
Notification.requestPermission();
var noti = [];
function get_new_notify()
{
	$.ajax({
        url : '../../process/get-new-notify.php',
        type : 'post',
        dataType : 'json',
        success : function (result)
        {
			if (result)
			{
				get_unseen_notify();
				for (var i=0; i<result.length; i++)
				{
					toastr[result[i]['type']]("<a onclick='seen_notify("+result[i]['id']+")' style='color: #fff; text-decoration: none;' href='../../"+result[i]['link']+"'>"+result[i]['content']+"</a>");
					noti = new Notification(
						"Thông báo mới từ thư viện trực tuyến trường THPT Lê Quý Đôn", {
							lang: 'vi-VN',
							icon: "http://thuvienlqd.com/assets/global/img/noti-image.png",
							body: result[i]['content']
						}
					);
					setTimeout(function(){noti.close();},5000);
				}
			}

        }
    });
    return false;
}
function get_unseen_notify()
{
	$.ajax({
        url : '../../process/get-unseen-notify.php',
        type : 'post',
        dataType : 'json',
        success : function (result)
        {
			if (result)
			{	
				var html='';
				for (var i=0; i<result.length; i++)
				{
					html+="<li><strong class='noticontent2'><a onclick='seen_notify("+result[i]['id']+")' href='../../"+result[i]['link']+"'>"+result[i]['content']+"</a></strong><div class='notitime'>"+result[i]['time']+"</div></li>"
				}
				$('#noticontent').html(html);
				$('#noticount').html(result.length);
				$(document).attr('title','('+result.length+') '+title);
			}
			else
			{
				$('#noticontent').html('<center>Bạn không có thông báo mới nào</center>');
				$('#noticount').html('0');
				$(document).attr('title',title);
			}
        }
    });
    return false;	
}
function seen_notify(id)
{
	$.ajax({
        url : '../../process/seen-notify.php',
        type : 'post',
        dataType : 'json',
		data: { id: id }
    });
	get_unseen_notify();
    return false;
}
function seen_all()
{
	$.ajax({
        url : '../../process/seen-notify.php',
        type : 'post',
        dataType : 'json',
		data: { all: 1 }
    });
	get_unseen_notify();
    return false;
}
get_unseen_notify();
get_new_notify();
setInterval("get_new_notify()",1000);
setInterval("get_unseen_notify()",60000);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function hideAllAcco()
{
	$('#agree-term-content').hide('fast',function() { 
		$('#agree-term-content').removeClass('in').css('display',''); 
	});
	$('#confirm-password-content').hide('fast',function() { 
		$('#confirm-password-content').removeClass('in').css('display',''); 
	});
	$('#confirm-info-content').hide('fast',function() { 
		$('#confirm-info-content').removeClass('in').css('display',''); 
	});
	$('#borrow-method-content').hide('fast',function() { 
		$('#borrow-method-content').removeClass('in').css('display','');  
	});
	$('#confirm-content').hide('fast',function() { 
		$('#confirm-content').removeClass('in').css('display',''); 
	});
}
function checkout()
{
	$.ajax({
        url : '../../process/checkout.php',
        type : 'post',
        dataType : 'json',
        data : {
            acceptterm : $('[name="agree-term-value"]:checked').val(),
			pass : md5($('#pass').val()),
			confirminfo : $('[name="confirm-info-value"]:checked').val(),
			borrowmethod : $('[name="borrow-method-value"]:checked').val(),
			note : $('#borrow-note').val()
        },
        success : function (result)
        {
            if (!result.hasOwnProperty('error') || (result['error'] != 'success'))
            {
                alert('ERROR');
                return false;
            } else 
			{
				if (result.acceptterm == '1')
				{
					hideAllAcco();
					$('#agree-term-content').collapse('show');
					$('#agree-term-checkbox').pulsate({color: "#f3565d",repeat: 2});
				} else 
				{ 
					if (result.pass != '0')
					{
						hideAllAcco();
						$('#confirm-password-content').collapse('show');
						if (result.pass == '1'){ $('#errpass').attr({'data-original-title':'Chưa nhập mật khẩu','class':'fa fa-warning tooltips'}); $('#passdiv').attr('class','form-group has-warning'); $('#pass').pulsate({color: "#dfba49",repeat: 2});}
						if (result.pass == '2'){ $('#errpass').attr({'data-original-title':'Mật khẩu chưa chính xác','class':'fa fa-exclamation tooltips'}); $('#passdiv').attr('class','form-group has-error'); $('#pass').pulsate({color: "#f3565d",repeat: 2});}
					} else 
					{
						$('#errpass').attr({'data-original-title':'Mật khẩu chính xác','class':'fa fa-check tooltips'}); $('#passdiv').attr('class','form-group has-success');
						if (result.confirminfo == '1')
						{
							hideAllAcco();
							$('#confirm-info-content').collapse('show');
							$('#confirm-info-checkbox').pulsate({color: "#f3565d",repeat: 2});
						} else 
						{ 
							if (result.borrowmethod == '1')
							{
								hideAllAcco();
								$('#borrow-method-content').collapse('show');
								$('#borrow-method-radio').pulsate({color: "#f3565d",repeat: 2});
							}
						}
					}
				}
			}
			if (result.limit == 1){
				bootbox.dialog({
					message: "Bạn đã có 1 đơn sách đang được xác nhận (hoặc đang mượn), vui lòng hủy đơn sách (hoặc trả sách) để đặt thêm đơn sách mới!",
					title: "Không thể đặt thêm đơn sách",
					buttons: {
						main: {
						label: "Xem lại đơn sách",
						className: "btn-primary",
						callback: function() {
							window.location='../../donsach';
						}
						}
					}
				});
			};
			if (result.done == 1){
				bootbox.alert("Đặt sách thành công", function() {
					window.location='../../donsach';
				});
			};
        }
    });
	return false;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function cancelorder(id)
{
	bootbox.confirm("Bạn có chắc muốn hủy đơn sách?", function(result) {
		if (result == true) {
				$.ajax({
				url : '../../process/cancel-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id: id
				},
				success : function (result)
				{
					if (!result.hasOwnProperty('error') || (result['error'] != 'success'))
					{
						alert('ERROR');
						return false;
					} else 
					{
						if (result.done == 1){
							bootbox.alert("Hủy đơn sách thành công", function() {
								$('#orderTus'+id).removeClass('label-warning').removeClass('label-default').removeClass('label-primary').removeClass('label-success').addClass('label-danger').text('Đã hủy');
								$('#btncancel'+id).hide(function (){$('#btncancel'+id).remove();});
							});
						};
					}
				}
			});
		}
	}); 
	return false;
}
function cancelorder2(id)
{
	bootbox.confirm("Bạn có chắc muốn hủy đơn sách?", function(result) {
	if (result == true) {
			$.ajax({
				url : '../../process/cancel-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id: id
				},
				success : function (result)
				{
					if (!result.hasOwnProperty('error') || (result['error'] != 'success'))
					{
						alert('ERROR');
						return false;
					} else 
					{
						if (result.done == 1){
							bootbox.alert("Hủy đơn sách thành công", function() {
								window.location='';
							});
						};
					}
				}
			});
		}
	}); 
	return false;
}
function editMethod(id)
{
	if ($('#editMethodSn').text() == 'Mượn về')
	{
		$('#editMethodSn').text('Đọc tại chỗ')
	}
	else 
	{
		$('#editMethodSn').text('Mượn về')
	}
	$('#editMethodBtn').html('<i class="fa fa-save"></i> Lưu/Hủy</a>');
	$('#editMethodBtn').attr('onclick','editMethod2('+id+')');
}
function editMethod2(id)
{
	bootbox.confirm("Có chắc muốn sửa hình thức mượn của đơn sách này?", function(result) {
		if (result == true) {
			$.ajax({
				url : '../../process/edit-method-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id
				},
				success : function (result)
				{
					if (!result.hasOwnProperty('error') || result['error'] != 'success')
					{
						alert('ERROR');
						return false;
					}
					else
					{
						if (result.done == '1') {
							$('#editMethodBtn').html('<i class="fa fa-edit"></i> Sửa</a>');
							$('#editMethodBtn').attr('onclick','editMethod('+id+')');
						}
					}
				}
			});
		}
		else
		{
			if ($('#editMethodSn').text() == 'Mượn về')
			{
				$('#editMethodSn').text('Đọc tại chỗ')
			}
			else 
			{
				$('#editMethodSn').text('Mượn về')
			}
			$('#editMethodBtn').html('<i class="fa fa-edit"></i> Sửa</a>');
			$('#editMethodBtn').attr('onclick','editMethod('+id+')');
		}
	}); 
	return false;
}
function editNote(id)
{
	$('#editNoteSn').html('<textarea class="form-control" id="editNoteValue">'+$('#editNoteSn').html()+'</textarea>');
	$('#editNoteBtn').html('<i class="fa fa-save"></i> Lưu/Hủy</a>');
	$('#editNoteBtn').attr('onclick','editNote2('+id+')');
}
function editNote2(id)
{
	bootbox.confirm("Có chắc muốn sửa ghi chú của đơn sách này?", function(result) {
		if (result == true) {
			$.ajax({
				url : '../../process/edit-note-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					note : $('#editNoteValue').val()
				},
				success : function (result)
				{
					if (!result.hasOwnProperty('error') || result['error'] != 'success')
					{
						alert('ERROR');
						return false;
					}
					else
					{
						if (result.done == '1') {
							$('#editNoteSn').html($('#editNoteValue').val());
						}
					}
				}
			});
		}
		else
		{
			$.ajax({
				url : '../../process/edit-note-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 1
				},
				success : function (result)
				{
					if (!result.hasOwnProperty('error') || result['error'] != 'success')
					{
						alert('ERROR');
						return false;
					}
					else
					{
						if (result.done == '1') {
							$('#editNoteSn').text(result.note);
						}
					}
				}
			});
		}
	});
	$('#editNoteBtn').html('<i class="fa fa-edit"></i> Sửa</a>');
	$('#editNoteBtn').attr('onclick','editNote('+id+')');
	return false;
}
function delEachOrder(id,id2)
{
	bootbox.confirm("Có chắc muốn xóa sách này khỏi đơn sách?", function(result) {
		if (result == true) {
			$.ajax({
				url : '../../process/del-eachorder.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					id2 : id2
				},
				success : function (result)
				{
					if (!result.hasOwnProperty('error') || result['error'] != 'success')
					{
						alert('ERROR');
						return false;
					}
					else
					{
						if (result.done == '1') {
							$('#eachorder'+id).hide('slow', function() { $('#eachorder'+id).remove(); });
						}
					}
				}
			});
		}
	});
	return false;
}
function reConfirmOrder(id) {
	bootbox.confirm("Bạn đã kiểm tra kỹ lại đơn sách?", function(result) {
		if (result == true) {
			$.ajax({
				url : '../../process/reconfirm-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id
				},
				success : function (result)
				{
					if (!result.hasOwnProperty('error') || result['error'] != 'success')
					{
						alert('ERROR');
						return false;
					}
					else
					{
						if (result.done == '1') {
							bootbox.alert("Xác nhận lại đơn sách thành công!", function() {
								window.location.reload();
							});
						}
					}
				}
			});
		}
	}); 
	return false;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function search() {
	window.location='../../tim-kiem/'+encodeURIComponent($('#txtSearch').val());
	return false;
}
function search2() {
	window.location='../../tim-kiem/'+encodeURIComponent($('#txtSearch2').val());
	return false;
}