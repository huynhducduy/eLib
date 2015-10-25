///////////////////////////////////////////////////////////////////////////////////////
function str2num(val)
{
    val = '0' + val;
    val = parseFloat(val);
    return val;
}
///////////////////////////////////////////////////////////////////////////////////////
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
///////////////////////////////////////////////////////////////////////////////////////
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
///////////////////////////////////////////////////////////////////////////////////////
function pulsw(id)
{
	$('#'+id).pulsate({color: "#dfba49",repeat: false});
}
function pulse(id)
{
	$('#'+id).pulsate({color: "#f3565d",repeat: false});
}
///////////////////////////////////////////////////////////////////////////////////////
var Book = function() {
    var handleProducts = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_products"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-book.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleProducts();
        }
    };
}();
///////////////////////////////////////////////////////////////////////////////////////
var BookEdit = function () {
    var handleReviews = function () {
        var grid = new Datatable();
        grid.setAjaxParam("bid",$("#bookid").val());
        grid.init({
            src: $("#datatable_reviews"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-review.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
				grid.setAjaxParam("bid",$("#bookid").val());
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    var handleComments = function () {
        var grid = new Datatable();
        grid.setAjaxParam("bid",$("#bookid").val());
        grid.init({
            src: $("#datatable_comments"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-comment.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
				grid.setAjaxParam("bid",$("#bookid").val());
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    var handleHistory = function () {
        var grid = new Datatable();
		grid.setAjaxParam("bid",$("#bookid").val());
        grid.init({
            src: $("#datatable_history"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20, 
                "ajax": {
                    "url": "process/get-eachorder.php", 
                },
                "order": [
                    [1, "desc"]
                ] 
            }
        });
    } 
    var initComponents = function () {
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }
	var handleTagsInput = function () {
        if (!jQuery().tagsInput) {
            return;
        }
       $('[name="book[keyword]"]').tagsInput({
            width: 'auto',
            'onAddTag': function () {
            },
        });
    }
    return {
        init: function () {
            initComponents();
            handleReviews();
            handleComments();
            handleHistory();
			handleTagsInput();
			$('#bookkeyword_tagsinput').attr('class','form-control tagsinput');
        }
    };
}();
///////////////////////////////////////////////////////////////////////////////////////
function addbookimage() {
	var next=str2num($('#countbookimage tr:last td:first').html())+1;
	var last=next-1;
	if (last < 6) {
	$('#bookimage'+last+'tr').after("<tr id='bookimage"+next+"tr'><td>"+next+"</td><td><a href='../../assets/global/img/no-image.gif' class='fancybox-button' id='bookimagebig"+next+"'><img class='img-responsive' width='135' height='180' id='bookimagethumb"+next+"' src='../../135x180/assets/global/img/no-image.gif'></a></td><td><input type='text' name='book[images]["+next+"]' id='bookimagetext"+next+"' style='margin-bottom: 5px;' class='form-control'><div id='bookimage"+next+"div'><div class='input-icon right'><i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errbookimage"+next+"'></i><input type='file' id='bookimage"+next+"' class='form-control' onchange='uploadbookimage("+next+")'/></div></div></td><td><div id='bookimagebutton"+next+"' style='display: none;'><div class='margin-bottom-5'><a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitbookimage("+next+")'><i class='fa fa-check'></i> Chấp nhận</a></div><div class='margin-bottom-5'><a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelbookimage("+next+")'><i class='fa fa-ban'></i> Hủy</a></div></div><a href='javascript:delbookimage("+next+");' class='btn default btn-sm'><i class='fa fa-times'></i> Xóa </a></td></tr>");
	}
	if (last == 5) { $('#buttonaddbookimage').hide('fast'); }
}
function delbookimage(id) {
	if (id != 1)
	{
		$('#bookimage'+id+'tr').hide('slow', function() { $('#bookimage'+id+'tr').remove(); });
		for (var i=id+1;i<=6;i++)
		{
			kq=i-1;
			$('#bookimage'+i+'tr td:first').text(kq);
			$('#bookimage'+i+'tr td:last a:last').attr('href','javascript:delbookimage('+kq+')');
			$('#bookimage'+i).attr('onchange','uploadbookimage('+kq+')');
			$('#bookimagebutton'+i+' div:first a:first').attr('href','javascript:submitbookimage('+kq+')');
			$('#bookimagebutton'+i+' div:last a:first').attr('href','javascript:cancelbookimage('+kq+')');
			$('#bookimage'+i+'tr').attr('id','bookimage'+kq+'tr');
			$('#bookimagebig'+i).attr('id','bookimagebig'+kq);
			$('#bookimagethumb'+i).attr('id','bookimagethumb'+kq);
			$('#bookimagetext'+i).attr('name','book[image]['+kq+']');
			$('#bookimagetext'+i).attr('id','bookimagetext'+kq);
			$('#errbookimage'+i).attr('id','errbookimage'+kq);
			$('#bookimage'+i).attr('id','bookimage'+kq);
			$('#bookimagebutton'+i).attr('id','bookimagebutton'+kq);
			$('#bookimage'+i).attr('id','bookimage'+kq);
			$('#bookimage'+i).attr('id','bookimage'+kq);
		}
		$('#buttonaddbookimage').show('fast');
	}
}
function submitbookimage(id) {
	$('#bookimagebutton'+id).hide('fast');
	$('#bookimage'+id).val('');
	$('#errbookimage'+id).attr({'data-original-title':'Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp','class':'fa fa-info-circle tooltips'});
	$('#bookimagetext'+id).removeAttr('old');
	$('#bookimagebig'+id).removeAttr('old');
	$('#bookimagethumb'+id).removeAttr('old');
	$('#bookimage'+id+'div').removeAttr('class','has-success');
}
function cancelbookimage(id) {
	$('#bookimagethumb'+id).attr('src',$('#bookimagethumb'+id).attr('old'));
	$('#bookimagebig'+id).attr('href',$('#bookimagebig'+id).attr('old'));
	$('#bookimagetext'+id).attr('value',$('#bookimagetext'+id).attr('old'));
	$('#bookimagebutton'+id).hide('fast');
	$('#bookimage'+id).val('');
	$('#errbookimage'+id).attr({'data-original-title':'Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp','class':'fa fa-info-circle tooltips'});
	$('#bookimagetext'+id).removeAttr('old');
	$('#bookimagebig'+id).removeAttr('old');
	$('#bookimagethumb'+id).removeAttr('old');
	$('#bookimage'+id+'div').removeAttr('class','has-success');
}
function uploadbookimage(id) {
	var file_data = document.getElementById("bookimage"+id).files[0];
	if (file_data != null)
	{
		var fd = new FormData();
		fd.append("image", file_data);
		$.ajax({
			url : 'process/upload.php',
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
					if (result.image != '0')
					{
						if (result.image == '2') { $('#errbookimage'+id).attr({'data-original-title':'Định dạng không hợp lệ','class':'fa fa-warning tooltips'}); }
						else if (result.image == '3') { $('#errbookimage'+id).attr({'data-original-title':'Tệp vượt quá dung lượng cho phép','class':'fa fa-warning tooltips'}); }
						$('#bookimage'+id+'div').attr('class','has-warning');
						pulsw('bookimage'+id);
						Metronic.scrollTo2($('#bookimage'+id+'div'),-200);
					}
					if (result.done == '1'){
						$('#errbookimage'+id).attr({'data-original-title':'Ảnh hợp lệ','class':'fa fa-check tooltips'}); $('#imagediv').attr('class','form-group has-success');
						$('#bookimagethumb'+id).attr('old',$('#bookimagethumb'+id).attr('src'));
						$('#bookimagethumb'+id).attr('src','../../135x180/'+result.link);
						$('#bookimagebig'+id).attr('old',$('#bookimagebig'+id).attr('href'));
						$('#bookimagebig'+id).attr('href','../../'+result.link);
						$('#bookimagetext'+id).attr('old',$('#bookimagetext'+id).attr('value'));
						$('#bookimagetext'+id).attr('value',result.link);
						$('#bookimagebutton'+id).show('fast');
						$('#bookimage'+id).val('');
						$('#bookimage'+id+'div').attr('class','has-success');
						Metronic.scrollTo2($('#bookimage'+id+'div'),-200);
					}
				}
			}
		});
	}
}
///////////////////////////////////////////////////////////////////////////////////////
function getproofread() {
	var num=str2num($('#countproofread tr:last td:first').html());
	var text = '';
	for (var i=1;i<=num-1;i++)
	{
		text+=$('#proofreadtext'+i).attr('value')+','+$('#proofreaddes'+i).attr('value')+'|';
	}
	text+=$('#proofreadtext'+num).attr('value')+','+$('#proofreaddes'+num).attr('value');
	$('#proofreadmaintext').attr('value',text);
}
function addproofread() {
	var next=str2num($('#countproofread tr:last td:first').html())+1;
	var last=next-1;
	if (last != 0) {
		$('#proofread'+last+'tr').after("<tr id='proofread"+next+"tr'><td>"+next+"</td><td><a href='../../assets/global/img/no-image.gif' class='fancybox-button' id='proofreadbig"+next+"'><img class='img-responsive' width='135' height='180' id='proofreadthumb"+next+"' src='../../135x180/assets/global/img/no-image.gif'></a></td><td><input type='text' class='form-control' id='proofreaddes"+next+"'></td><td><input type='text' name='book[images][]' id='proofreadtext"+next+"' style='margin-bottom: 5px;' class='form-control'><div id='proofread"+next+"div'><div class='input-icon right'><i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errproofread"+next+"'></i><input type='file' id='proofread"+next+"' class='form-control' onchange='uploadproofread("+next+")'/></div></div></td><td><div id='proofreadbutton"+next+"' style='display: none;'><div class='margin-bottom-5'><a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitproofread("+next+")'><i class='fa fa-check'></i> Chấp nhận</a></div><div class='margin-bottom-5'><a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelproofread("+next+")'><i class='fa fa-ban'></i> Hủy</a></div></div><a href='javascript:delproofread("+next+");' class='btn default btn-sm'><i class='fa fa-times'></i> Xóa </a></td></tr>");
	}
	else
	{
		$('#countproofread').html("<tr id='proofread"+next+"tr'><td>"+next+"</td><td><a href='../../assets/global/img/no-image.gif' class='fancybox-button' id='proofreadbig"+next+"'><img class='img-responsive' width='135' height='180' id='proofreadthumb"+next+"' src='../../135x180/assets/global/img/no-image.gif'></a></td><td><input type='text' class='form-control' id='proofreaddes"+next+"'></td><td><input type='text' name='book[images][]' id='proofreadtext"+next+"' style='margin-bottom: 5px;' class='form-control'><div id='proofread"+next+"div'><div class='input-icon right'><i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errproofread"+next+"'></i><input type='file' id='proofread"+next+"' class='form-control' onchange='uploadproofread("+next+")'/></div></div></td><td><div id='proofreadbutton"+next+"' style='display: none;'><div class='margin-bottom-5'><a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitproofread("+next+")'><i class='fa fa-check'></i> Chấp nhận</a></div><div class='margin-bottom-5'><a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelproofread("+next+")'><i class='fa fa-ban'></i> Hủy</a></div></div><a href='javascript:delproofread("+next+");' class='btn default btn-sm'><i class='fa fa-times'></i> Xóa </a></td></tr>");
	}
}
function delproofread(id) {
	$('#proofread'+id+'tr').hide(500, function () { $('#proofread'+id+'tr').remove(); });
	for (var i=id+1;i<=6;i++)
	{
		kq=i-1;
		$('#proofread'+i+'tr td:first').text(kq);
		$('#proofread'+i+'tr td:last a:last').attr('href','javascript:delproofread('+kq+')');
		$('#proofread'+i).attr('onchange','uploadproofread('+kq+')');
		$('#proofreadbutton'+i+' div:first a:first').attr('href','javascript:submitproofread('+kq+')');
		$('#proofreadbutton'+i+' div:last a:first').attr('href','javascript:cancelproofread('+kq+')');
		$('#proofread'+i+'tr').attr('id','proofread'+kq+'tr');
		$('#proofreadbig'+i).attr('id','proofreadbig'+kq);
		$('#proofreadthumb'+i).attr('id','proofreadthumb'+kq);
		$('#proofreadtext'+i).attr('id','proofreadtext'+kq);
		$('#errproofread'+i).attr('id','errproofread'+kq);
		$('#proofread'+i).attr('id','proofread'+kq);
		$('#proofreadbutton'+i).attr('id','proofreadbutton'+kq);
		$('#proofread'+i).attr('id','proofread'+kq);
		$('#proofread'+i).attr('id','proofread'+kq);
	}
	$('#buttonaddproofread').show('fast');
}
function submitproofread(id) {
	$('#proofreadbutton'+id).hide('fast');
	$('#proofread'+id).val('');
	$('#errproofread'+id).attr({'data-original-title':'Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp','class':'fa fa-info-circle tooltips'});
	$('#proofreadtext'+id).removeAttr('old');
	$('#proofreadbig'+id).removeAttr('old');
	$('#proofreadthumb'+id).removeAttr('old');
	$('#proofread'+id+'div').removeAttr('class','has-success');
	getproofread();
}
function cancelproofread(id) {
	$('#proofreadthumb'+id).attr('src',$('#proofreadthumb'+id).attr('old'));
	$('#proofreadbig'+id).attr('href',$('#proofreadbig'+id).attr('old'));
	$('#proofreadtext'+id).attr('value',$('#proofreadtext'+id).attr('old'));
	$('#proofreadbutton'+id).hide('fast');
	$('#proofread'+id).val('');
	$('#errproofread'+id).attr({'data-original-title':'Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp','class':'fa fa-info-circle tooltips'});
	$('#proofreadtext'+id).removeAttr('old');
	$('#proofreadbig'+id).removeAttr('old');
	$('#proofreadthumb'+id).removeAttr('old');
	$('#proofread'+id+'div').removeAttr('class','has-success');
}
function uploadproofread(id) {
	var file_data = document.getElementById("proofread"+id).files[0];
	if (file_data != null)
	{
		var fd = new FormData();
		fd.append("image", file_data);
		$.ajax({
			url : 'process/upload.php',
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
					if (result.image != '0')
					{
						if (result.image == '2') { $('#errproofread'+id).attr({'data-original-title':'Định dạng không hợp lệ','class':'fa fa-warning tooltips'}); }
						else if (result.image == '3') { $('#errproofread'+id).attr({'data-original-title':'Tệp vượt quá dung lượng cho phép','class':'fa fa-warning tooltips'}); }
					}
					if (result.done == '1'){
						$('#errproofread'+id).attr({'data-original-title':'Ảnh hợp lệ','class':'fa fa-check tooltips'}); $('#imagediv').attr('class','form-group has-success');
						$('#proofreadthumb'+id).attr('old',$('#proofreadthumb'+id).attr('src'));
						$('#proofreadthumb'+id).attr('src','../../135x180/'+result.link);
						$('#proofreadbig'+id).attr('old',$('#proofreadbig'+id).attr('href'));
						$('#proofreadbig'+id).attr('href','../../'+result.link);
						$('#proofreadtext'+id).attr('old',$('#proofreadtext'+id).attr('value'));
						$('#proofreadtext'+id).attr('value',result.link);
						$('#proofreadbutton'+id).show('fast');
						$('#proofread'+id).val('');
						$('#proofread'+id+'div').attr('class','has-success');
					}
				}
			}
		});
	}
}
///////////////////////////////////////////////////////////////////////////////////////
function removeActiveTab() {
	$('li',$('#click')).each(function(index){
		$(this).removeClass('active');
    });
	$('.tab-pane').each(function(index){
		$(this).removeClass('active');
    });
}
function goToGeneral() {
	removeActiveTab();
	$('#tab_general').addClass('active');
	$('#click_general').addClass('active');
}
function goToImages() {
	removeActiveTab();
	$('#tab_images').addClass('active');
	$('#click_images').addClass('active');
}
////////////////////////////////////////////////////////////////////////////////////////
function bookedit() {
	$.ajax({
		url : 'process/edit-book.php',
		type : 'post',
		dataType : 'json',
		data : {
			bookid : $('[name="book[id]"]').val(),
			bookname : $('[name="book[name]"]').val(),
			bookdescription : $('[name="book[description]"]').code(),
			bookshortdescription : $('[name="book[short-description]"]').val(),
			bookkeyword : $('[name="book[keyword]"]').val(),
			bookcate : $('[name="book[cate]"]:checked').val(),
			bookbcode : $('[name="book[bcode]"]').val(),
			booknumber : $('[name="book[number]"]').val(),
			bookauthor : $('[name="book[author]"]').val(),
			bookpublisher : $('[name="book[publisher]"]').val(),
			bookpublishtime : $('[name="book[publish-time]"]').val(),
			bookpagen : $('[name="book[pagen]"]').val(),
			booklang : $('[name="book[lang]"]').val(),
			booklabelnew : $('[name="book[label][new]"]:checked').val(),
			booklabelhot : $('[name="book[label][hot]"]:checked').val(),
			booklabelrec : $('[name="book[label][rec]"]:checked').val(),
			bookimages1 : $('[name="book[images][1]"]').val(),
			bookimages2 : $('[name="book[images][2]"]').val(),
			bookimages3 : $('[name="book[images][3]"]').val(),
			bookimages4 : $('[name="book[images][4]"]').val(),
			bookimages5 : $('[name="book[images][5]"]').val(),
			bookimages6 : $('[name="book[images][6]"]').val(),
			bookproofread : $('[name="book[proofread]"]').val()
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
				if (result.bookid != '0') {
					Metronic.alert({
						type: 'danger',
						icon: 'warning',
						message: 'Có lỗi xảy ra',
						place: 'prepend'
					});
				}
				else
				{
					if (result.bookname != '0') {
						goToGeneral();
						$('#errname').attr({'data-original-title':'Chưa nhập tên sách','class':'fa fa-warning tooltips'}); 
						$('#namediv').attr('class','form-group has-warning'); 
						pulsw('bookname');
						Metronic.scrollTo2($('#namediv'),-100);
					}
					else
					{
						$('#errname').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
						$('#namediv').attr('class','form-group');
						if (result.bookdescription != '0') {
							goToGeneral();
							$('.note-editor').attr('id','bookdescription');
							$('#errdescription').attr({'data-original-title':'Chưa nhập mô tả','class':'fa fa-warning tooltips'}); 
							$('#descriptiondiv').attr('class','form-group has-warning'); 
							pulsw('bookdescription');
							Metronic.scrollTo2($('#namediv'),-100);
						}
						else
						{
							$('#errdescription').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
							$('#descriptiondiv').attr('class','form-group');
							if (result.bookshortdescription != '0') {
								goToGeneral();
								$('#errshortdescription').attr({'data-original-title':'Chưa nhập mô tả ngắn','class':'fa fa-warning tooltips'}); 
								$('#shortdescriptiondiv').attr('class','form-group has-warning'); 
								pulsw('bookshortdescription');
								Metronic.scrollTo2($('#shortdescriptiondiv'),-100);
							}
							else
							{
								$('#errshortdescription').attr({'data-original-title':'Chưa nhập mô tả ngắn','class':'fa fa-info-circle tooltips'}); 
								$('#shortdescriptiondiv').attr('class','form-group');
								if (result.bookkeyword != '0') {
									goToGeneral();
									$('#errkeyword').attr({'data-original-title':'Chưa nhập từ khóa','class':'fa fa-warning tooltips'}); 
									$('#keyworddiv').attr('class','form-group has-warning'); 
									pulsw('bookkeyword_tagsinput');
									Metronic.scrollTo2($('#keyworddiv'),-100);
								}
								else
								{
									$('#errkeyword').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
									$('#keyworddiv').attr('class','form-group');
									if (result.bookcate != '0') {
										goToGeneral();
										if (result.bookcate == '1') {
											$('#errcate').attr({'data-original-title':'Chưa chọn danh mục','class':'fa fa-warning tooltips'}); 
											$('#catediv').attr('class','form-group has-warning');
											pulsw('bookcate');
										} else if (result.bookcate == '2') {
											$('#errcate').attr({'data-original-title':'Danh mục này không có thật','class':'fa fa-exclamation tooltips'}); 
											$('#catediv').attr('class','form-group has-error');
											pulse('bookcate');
										}
										Metronic.scrollTo2($('#catediv'),-100);
									}
									else
									{
										$('#errcate').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
										$('#catediv').attr('class','form-group');
										if (result.bookbcode != '0') {
											goToGeneral();
											if (result.bookbcode == '1') {
												$('#errbcode').attr({'data-original-title':'Chưa nhập mã sách','class':'fa fa-warning tooltips'}); 
												$('#bcodediv').attr('class','form-group has-warning');
												pulsw('bookbcode');
											} else if (result.bookbcode == '2') {
												$('#errbcode').attr({'data-original-title':'Mã sách này đã bị trùng','class':'fa fa-exclamation tooltips'}); 
												$('#bcodediv').attr('class','form-group has-error');
												pulse('bookbcode');
											}
											Metronic.scrollTo2($('#bcodediv'),-100);
										}
										else
										{
											$('#errbcode').attr({'data-original-title':'Chưa nhập mã sách','class':'fa fa-info-circle tooltips'}); 
											$('#bcodediv').attr('class','form-group');
											if (result.booknumber != '0') {
												goToGeneral();
												if (result.booknumber == '1') {
													$('#errnumber').attr({'data-original-title':'Chưa nhập số lượng sách','class':'fa fa-warning tooltips'}); 
													$('#numberdiv').attr('class','form-group has-warning');
													pulsw('booknumber');
												} else if (result.booknumber == '2') {
													$('#errnumber').attr({'data-original-title':'Số lượng sách chỉ gồm số (0-9)','class':'fa fa-exclamation tooltips'}); 
													$('#numberdiv').attr('class','form-group has-error');
													pulse('booknumber');
												}
												Metronic.scrollTo2($('#numberdiv'),-100);
											}
											else
											{
												$('#errnumber').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
												$('#numberdiv').attr('class','form-group');
												if (result.bookauthor != '0') {
													goToGeneral();
													$('#errauthor').attr({'data-original-title':'Chưa nhập tác giả','class':'fa fa-warning tooltips'}); 
													$('#authordiv').attr('class','form-group has-warning'); 
													pulsw('bookauthor');
													Metronic.scrollTo2($('#authordiv'),-100);
												}
												else
												{
													$('#errauthor').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
													$('#authordiv').attr('class','form-group');
													if (result.bookpagen != '0') {
														goToGeneral();
														if (result.bookpagen == '1') {
															$('#errpagen').attr({'data-original-title':'Chưa nhập số trang sách','class':'fa fa-warning tooltips'}); 
															$('#pagendiv').attr('class','form-group has-warning');
															pulsw('bookpagen');
														} else if (result.bookpagen == '2') {
															$('#errpagen').attr({'data-original-title':'Số trang sách chỉ gồm số (0-9)','class':'fa fa-exclamation tooltips'}); 
															$('#pagendiv').attr('class','form-group has-error');
															pulse('bookpagen');
														}
														Metronic.scrollTo2($('#pagendiv'),-100);
													}
													else
													{
														$('#errpagen').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
														$('#pagendiv').attr('class','form-group');
														if (result.booklang != '0') {
															goToGeneral();
															if (result.booklang == '1') {
																$('#errlang').attr({'data-original-title':'Chưa chọn ngôn ngữ','class':'fa fa-warning tooltips'}); 
																$('#langdiv').attr('class','form-group has-warning');
																pulsw('booklang');
															} else if (result.booklang == '2') {
																$('#errlang').attr({'data-original-title':'Ngôn ngữ này không có thật','class':'fa fa-exclamation tooltips'}); 
																$('#langdiv').attr('class','form-group has-error');
																pulse('booklang');
															}
															Metronic.scrollTo2($('#langdiv'),-100);
														}
														else
														{
															$('#errlang').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
															$('#langdiv').attr('class','form-group');
															if (result.bookimages1 != 0) {
																goToImages();
																$('#errbookimages1').attr({'data-original-title':'Ảnh đầu tiên là bắt buộc','class':'fa fa-warning tooltips'}); 
																$('#bookimages1div').attr('class','has-warning');
																pulsw('bookimagetext1');
																Metronic.scrollTo2($('#langdiv'),-100);
															}
															else
															{
																$('#errbookimages1').attr({'data-original-title':'Ảnh đầu tiên là bắt buộc','class':'fa fa-info-circle tooltips'}); 
																$('#bookimages1div').attr('class','');
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				if (result.done == '1'){
					Metronic.alert({
						type: 'success',
						icon: 'check',
						message: 'Đã lưu',
						place: 'prepend'
					});
				}
			}
		}
	});
	return false;
}
///////////////////////////////////////////////////////////////////////////////////////
function addMoreBook(id)
{
	bootbox.prompt("Bao nhiêu sách được thêm?", function(result) {               
		if (result != null) {                                             
			$.ajax({
				url : 'process/add-more-book.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					number : result
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
							bootbox.alert("Thêm sách thành công!", function() {
								window.location.reload();
							});
						}
					}
				}
			});                          
		}
	});
}
///////////////////////////////////////////////////////////////////////////////////////
var FormWizard = function () {
    return {
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }
			if (!jQuery().tagsInput) {
				return;
			}
			$('.date-picker').datepicker({
				rtl: Metronic.isRTL(),
				autoclose: true
			});
			$('[name="book[keyword]"]').tagsInput({
				width: 'auto',
				'onAddTag': function () {
				},
			});
			$('#bookkeyword_tagsinput').attr('class','form-control tagsinput');
			var form = $('#form_wizard_1');
            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) { // Get value của radio
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
					if ($(this).attr("data-display") == 'book[description]')  // Nếu là summernote (text-area) thì lấy bằng code()
					{
						$(this).html(input.code());
					}
					else if ($(this).attr("data-display") == 'book[label]') // Lấy label (custom)
					{
                        var label = [];
						if ($('[name="book[label][hot]"]').is(':checked')) {
							label.push('Hot');
						}
						if ($('[name="book[label][new]"]').is(':checked')) {
							label.push('New');
						}
                        $(this).html(label.join("<br/>"));
                    }					
					else  if (input.is(":text") || input.is("textarea")) // Nếu là text hoặc texarea thường thì lấy bằng val()
					{
                        $(this).html(input.val());
                    } 
					else if (input.is("select")) // Nếu là select thì lấy selected[text]
					{
                        $(this).html(input.find('option:selected').text());
                    } 
					else if ((input.is(":radio") || input.is(":checkbox"))  && input.is(":checked")) // Nếu là radio hoặc checkbox thì lấy checked[data-title]
					{
                        $(this).html(input.attr("data-title"));
                    }
                });
				var contentbookimage = '<img src="../../135x180/'+$('[name="book[images][1]"]').val()+'" class="thumbnail" style="display: inline-block; margin: 5px 2px;" width="145px" height="190px"></a>';
				if ($('[name="book[images][2]"]').val() !=  null) {
					contentbookimage += '<img src="../../135x180/'+$('[name="book[images][2]"]').val()+'" class="thumbnail" style="display: inline-block; margin: 5px 2px;" width="145px" height="190px"></a>';
				}
				if ($('[name="book[images][3]"]').val() !=  null) {
					contentbookimage += '<img src="../../135x180/'+$('[name="book[images][3]"]').val()+'" class="thumbnail" style="display: inline-block; margin: 5px 2px;" width="145px" height="190px"></a>';
				}
				if ($('[name="book[images][4]"]').val() !=  null) {
					contentbookimage += '<img src="../../135x180/'+$('[name="book[images][4]"]').val()+'" class="thumbnail" style="display: inline-block; margin: 5px 2px;" width="145px" height="190px"></a>';
				}
				if ($('[name="book[images][5]"]').val() !=  null) {
					contentbookimage += '<img src="../../135x180/'+$('[name="book[images][5]"]').val()+'" class="thumbnail" style="display: inline-block; margin: 5px 2px;" width="145px" height="190px"></a>';
				}
				if ($('[name="book[images][6]"]').val() !=  null) {
					contentbookimage += '<img src="../../135x180/'+$('[name="book[images][6]"]').val()+'" class="thumbnail" style="display: inline-block; margin: 5px 2px;" width="145px" height="190px"></a>';
				}
				$('#bookimageconfirm').html(contentbookimage);
				var num2=str2num($('#countproofread tr:last td:first').html());
				var contentproofread = '';
				var text = '';
				for (var i=1;i<=num2;i++)
				{
					if ($('#proofreaddes'+i).attr('value') != '') {
						text = $('#proofreaddes'+i).attr('value');
					} else { text = 'Không có chú thích'; }
					contentproofread +='<div class="thumbnail" style="display: inline-block; margin: 5px 2px;"><img src="../../135x180/'+$('#proofreadtext'+i).attr('value')+'" width="135px" height="180px"/><div class="caption" style="width: 135px;">'+text+'</div></div>';
				}
				$('#bookproofreadconfirm').html(contentproofread);
            }
            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                $('.step-title', form).text('Bước ' + current + '/' + total);
                jQuery('li', form).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }
                if (current == 1) {
                    form.find('.button-previous').hide();
                } else {
                    form.find('.button-previous').show();
                }
                if (current >= total) {
                    form.find('.button-next').hide();
                    form.find('.button-submit').show();
                    displayConfirm();
                } else {
                    form.find('.button-next').show();
                    form.find('.button-submit').hide();
                }
                Metronic.scrollTo($('.page-title'));
            }
			var goToTab = function (tab) {
				var total = $('#click').find('li').length;
				$('.step-title', form).text('Bước ' + tab + '/' + total);
				jQuery('li', $('#click')).removeClass("done").removeClass("active");
				var li_list = form.find('li');
				for (var i = 0; i < tab-1; i++) {
                    jQuery(li_list[i]).addClass("done");
                }
				jQuery(li_list[tab-1]).addClass("active");
				$('.tab-pane',$('.tab-content')).removeClass("active");
				$('#tab'+tab,$('.tab-content')).addClass("active");
                var $percent = (tab / total) * 100;
                form.find('.progress-bar').css({
                    width: $percent + '%'
                });
			}
///////////////////////////////////////////////////////////////////////////////////////
			var validateBook = function (tab) {
				var kt;
				switch (tab)
				{
					case 1:
						$.ajax({
							url : 'process/create-book.php',
							type : 'post',
							dataType : 'json',
							async: false,
							data : {
								tab: 1,
								bookid : $('[name="book[id]"]').val(),
								bookname : $('[name="book[name]"]').val(),
								bookdescription : $('[name="book[description]"]').code(),
								bookshortdescription : $('[name="book[short-description]"]').val(),
								bookkeyword : $('[name="book[keyword]"]').val(),
								bookcate : $('[name="book[cate]"]:checked').val(),
								bookbcode : $('[name="book[bcode]"]').val(),
								booknumber : $('[name="book[number]"]').val(),
								bookauthor : $('[name="book[author]"]').val(),
								bookpublisher : $('[name="book[publisher]"]').val(),
								bookpublishtime : $('[name="book[publish-time]"]').val(),
								bookpagen : $('[name="book[pagen]"]').val(),
								booklang : $('[name="book[lang]"]').val(),
								booklabelnew : $('[name="book[label][new]"]:checked').val(),
								booklabelhot : $('[name="book[label][hot]"]:checked').val()
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
									if (result.bookname != '0') {
										$('#errname').attr({'data-original-title':'Chưa nhập tên sách','class':'fa fa-warning tooltips'}); 
										$('#namediv').attr('class','form-group has-warning'); 
										pulsw('bookname');
										Metronic.scrollTo2($('#namediv'),-100);
									}
									else
									{
										$('#errname').attr({'data-original-title':'Chưa nhập tên sách','class':'fa fa-info-circle tooltips'}); 
										$('#namediv').attr('class','form-group');
										if (result.bookdescription != '0') {
											$('.note-editor').attr('id','bookdescription');
											$('#errdescription').attr({'data-original-title':'Chưa nhập mô tả','class':'fa fa-warning tooltips'}); 
											$('#descriptiondiv').attr('class','form-group has-warning'); 
											pulsw('bookdescription');
											Metronic.scrollTo2($('#namediv'),-100);
										}
										else
										{
											$('#errdescription').attr({'data-original-title':'Chưa nhập mô tả','class':'fa fa-info-circle tooltips'}); 
											$('#descriptiondiv').attr('class','form-group');
											if (result.bookshortdescription != '0') {
												$('#errshortdescription').attr({'data-original-title':'Chưa nhập mô tả ngắn','class':'fa fa-warning tooltips'}); 
												$('#shortdescriptiondiv').attr('class','form-group has-warning'); 
												pulsw('bookshortdescription');
												Metronic.scrollTo2($('#shortdescriptiondiv'),-100);
											}
											else
											{
												$('#errshortdescription').attr({'data-original-title':'Chưa nhập mô tả ngắn','class':'fa fa-info-circle tooltips'}); 
												$('#shortdescriptiondiv').attr('class','form-group');
												if (result.bookkeyword != '0') {
													$('#errkeyword').attr({'data-original-title':'Chưa nhập từ khóa','class':'fa fa-warning tooltips'}); 
													$('#keyworddiv').attr('class','form-group has-warning'); 
													pulsw('bookkeyword_tagsinput');
													Metronic.scrollTo2($('#keyworddiv'),-100);
												}
												else
												{
													$('#errkeyword').attr({'data-original-title':'Chưa nhập từ khóa','class':'fa fa-info-circle tooltips'}); 
													$('#keyworddiv').attr('class','form-group');
													if (result.bookcate != '0') {
														if (result.bookcate == '1') {
															$('#errcate').attr({'data-original-title':'Chưa chọn danh mục','class':'fa fa-warning tooltips'}); 
															$('#catediv').attr('class','form-group has-warning');
															pulsw('bookcate');
														} else if (result.bookcate == '2') {
															$('#errcate').attr({'data-original-title':'Danh mục này không có thật','class':'fa fa-exclamation tooltips'}); 
															$('#catediv').attr('class','form-group has-error');
															pulse('bookcate');
														}
														Metronic.scrollTo2($('#catediv'),-100);
													}
													else
													{
														$('#errcate').attr({'data-original-title':'Danh mục này không có thật','class':'fa fa-info-circle tooltips'}); 
														$('#catediv').attr('class','form-group');
														if (result.bookbcode != '0') {
															if (result.bookbcode == '1') {
																$('#errbcode').attr({'data-original-title':'Chưa nhập mã sách','class':'fa fa-warning tooltips'}); 
																$('#bcodediv').attr('class','form-group has-warning');
																pulsw('bookbcode');
															} else if (result.bookbcode == '2') {
																$('#errbcode').attr({'data-original-title':'Mã sách này đã bị trùng','class':'fa fa-exclamation tooltips'}); 
																$('#bcodediv').attr('class','form-group has-error');
																pulse('bookbcode');
															}
															Metronic.scrollTo2($('#bcodediv'),-100);
														}
														else
														{
															$('#errbcode').attr({'data-original-title':'Chưa nhập mã sách','class':'fa fa-info-circle tooltips'}); 
															$('#bcodediv').attr('class','form-group');
															if (result.booknumber != '0') {
																if (result.booknumber == '1') {
																	$('#errnumber').attr({'data-original-title':'Chưa nhập số lượng sách','class':'fa fa-warning tooltips'}); 
																	$('#numberdiv').attr('class','form-group has-warning');
																	pulsw('booknumber');
																} else if (result.booknumber == '2') {
																	$('#errnumber').attr({'data-original-title':'Số lượng sách chỉ gồm số (0-9)','class':'fa fa-exclamation tooltips'}); 
																	$('#numberdiv').attr('class','form-group has-error');
																	pulse('booknumber');
																}
																Metronic.scrollTo2($('#numberdiv'),-100);
															}
															else
															{
																$('#errnumber').attr({'data-original-title':'Số lượng sách chỉ gồm số (0-9)','class':'fa fa-info-circle tooltips'}); 
																$('#numberdiv').attr('class','form-group');
																if (result.bookauthor != '0') {
																	$('#errauthor').attr({'data-original-title':'Chưa nhập tác giả','class':'fa fa-warning tooltips'}); 
																	$('#authordiv').attr('class','form-group has-warning'); 
																	pulsw('bookauthor');
																	Metronic.scrollTo2($('#authordiv'),-100);
																}
																else
																{
																	$('#errauthor').attr({'data-original-title':'Chưa nhập tác giả','class':'fa fa-info-circle tooltips'}); 
																	$('#authordiv').attr('class','form-group');
																	if (result.bookpagen != '0') {
																		if (result.bookpagen == '1') {
																			$('#errpagen').attr({'data-original-title':'Chưa nhập số trang sách','class':'fa fa-warning tooltips'}); 
																			$('#pagendiv').attr('class','form-group has-warning');
																			pulsw('bookpagen');
																		} else if (result.bookpagen == '2') {
																			$('#errpagen').attr({'data-original-title':'Số trang sách chỉ gồm số (0-9)','class':'fa fa-exclamation tooltips'}); 
																			$('#pagendiv').attr('class','form-group has-error');
																			pulse('bookpagen');
																		}
																		Metronic.scrollTo2($('#pagendiv'),-100);
																	}
																	else
																	{
																		$('#errpagen').attr({'data-original-title':'Số trang sách chỉ gồm số (0-9)','class':'fa fa-info-circle tooltips'}); 
																		$('#pagendiv').attr('class','form-group');
																		if (result.booklang != '0') {
																			if (result.booklang == '1') {
																				$('#errlang').attr({'data-original-title':'Chưa chọn ngôn ngữ','class':'fa fa-warning tooltips'}); 
																				$('#langdiv').attr('class','form-group has-warning');
																				pulsw('booklang');
																			} else if (result.booklang == '2') {
																				$('#errlang').attr({'data-original-title':'Ngôn ngữ này không có thật','class':'fa fa-exclamation tooltips'}); 
																				$('#langdiv').attr('class','form-group has-error');
																				pulse('booklang');
																			}
																			Metronic.scrollTo2($('#langdiv'),-100);
																		}
																		else
																		{
																			$('#errlang').attr({'data-original-title':'Ngôn ngữ này không có thật','class':'fa fa-info-circle tooltips'}); 
																			$('#langdiv').attr('class','form-group');
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
								if (result.done == '1')	{ kt=true; } else { kt=false; }
							}
						});
					break;
					case 2:
						$.ajax({
							url : 'process/create-book.php',
							type : 'post',
							dataType : 'json',
							async: false,
							data : {
								tab: 2,
								bookimages1 : $('[name="book[images][1]"]').val()
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
									if (result.bookimages1 != 0) {
										$('#errbookimages1').attr({'data-original-title':'Ảnh đầu tiên là bắt buộc','class':'fa fa-warning tooltips'}); 
										$('#bookimages1div').attr('class','has-warning');
										pulsw('bookimagetext1');
										Metronic.scrollTo2($('#langdiv'),-100);
									}
									else
									{
										$('#errbookimages1').attr({'data-original-title':'Ảnh đầu tiên là bắt buộc','class':'fa fa-info-circle tooltips'}); 
										$('#bookimages1div').attr('class','');
									}
									if (result.done == '1')	{ kt = true; } else { kt = false; }
								}
							}
						});
					break;
					case 3:
						kt=true;
					break;
				}
				return kt;
			}
///////////////////////////////////////////////////////////////////////////////////////
            // Set Form Wizzard
            form.bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
					// Khi  chuyển tab bằng navigation
                    // return false; // Để disable
					// index+1: tab hiện tại, clickedIndex+1: tab chuyển
					if (index+1 == clickedIndex) {
						if (validateBook(index+1) == false) {
							return false;
						}
						handleTitle(tab, navigation, clickedIndex);
					} else if (index+1 < clickedIndex) {
						for (var i = index+1; i <= clickedIndex; i++) {
							if (validateBook(i) == false) {
								if (index+1 != i) {
									goToTab(i);
								}
								return false;
								break;
							}
						}
						handleTitle(tab, navigation, clickedIndex);
					} else if (clickedIndex < index) {
						handleTitle(tab, navigation, clickedIndex);
					}
                },
                onPrevious: function (tab, navigation, index) {
					// Khi quay lại
                    handleTitle(tab, navigation, index);
                },
				onNext: function (tab, navigation, index) {
					// Khi tiếp tục
					if (validateBook(index) == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
					// Khi hiển thị tab
					// Chỉnh sửa Progress-bar (Không cần sửa)
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    form.find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });
            $('.button-submit', form).click(function () {
				// Khi SUBMIT
                $.ajax({
					url : 'process/create-book.php',
					type : 'post',
					dataType : 'json',
					data : {
						tab: 69,
						bookid : $('[name="book[id]"]').val(),
						bookname : $('[name="book[name]"]').val(),
						bookdescription : $('[name="book[description]"]').code(),
						bookshortdescription : $('[name="book[short-description]"]').val(),
						bookkeyword : $('[name="book[keyword]"]').val(),
						bookcate : $('[name="book[cate]"]:checked').val(),
						bookbcode : $('[name="book[bcode]"]').val(),
						booknumber : $('[name="book[number]"]').val(),
						bookauthor : $('[name="book[author]"]').val(),
						bookpublisher : $('[name="book[publisher]"]').val(),
						bookpublishtime : $('[name="book[publish-time]"]').val(),
						bookpagen : $('[name="book[pagen]"]').val(),
						booklang : $('[name="book[lang]"]').val(),
						booklabelnew : $('[name="book[label][new]"]:checked').val(),
						booklabelhot : $('[name="book[label][hot]"]:checked').val(),
						bookimages1 : $('[name="book[images][1]"]').val(),
						bookimages2 : $('[name="book[images][2]"]').val(),
						bookimages3 : $('[name="book[images][3]"]').val(),
						bookimages4 : $('[name="book[images][4]"]').val(),
						bookimages5 : $('[name="book[images][5]"]').val(),
						bookimages6 : $('[name="book[images][6]"]').val(),
						bookproofread : $('[name="book[proofread]"]').val()
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
								Metronic.alert({
									type: 'success',
									icon: 'check',
									message: 'Đã thêm sách mới',
									place: 'prepend'
								});
							}
						}
					}
				});
            });
        }
    };
}();
////////////////////////////////////////////////////////////////////////////////////////////////////
$.fn.EasyTree = function (options) {
        var defaults = {
            selectable: true,
            deletable: false,
            editable: false,
            addable: false,
            i18n: {
                collapseTip: 'Thu nhỏ danh mục',
                expandTip: 'Mở rộng danh mục',
                selectTip: 'Chọn danh mục',
                unselectTip: 'Bỏ chọn danh mục',
                editTip: 'Chỉnh sửa danh mục',
                addTip: 'Thêm danh mục',
                deleteTip: 'Xóa danh mục'
            }
        };

        var warningAlert = $('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong></strong><span class="alert-content"></span></div>');
        var dangerAlert = $('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong></strong><span class="alert-content"></span></div>');
        var successAlert = $('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong></strong><span class="alert-content"></span></div>');
        
		options = $.extend(defaults, options);

        this.each(function () {
            var easyTree = $(this);
            $.each($(easyTree).find('ul > li'), function() {
                var text;
				var type;
				var id;
                if ($(this).is('li:has(ul)')) {
                    var children = $(this).find(' > ul');
                    $(children).remove();
                    text = $(this).text();
					type = $(this).attr('data-type');
					id = $(this).attr('data-id');
                    $(this).html('<span><span class="glyphicon"></span><a href="javascript: void(0);"></a> </span><div style="display: inline-block;float: right;margin-top: 7px;"><button onclick="window.location=&#39;cate-create.php?cid='+id+'&#39;" class="btn btn-success btn-circle" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-plus"></i></button> <button onclick="window.location=&#39;cate-edit.php?id='+id+'&type='+type+'&#39;" class="btn btn-primary btn-circle" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-edit"></i></button> <button onclick="delCate2('+id+','+type+')" class="btn btn-danger btn-circle" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-remove"></i></button></div><hr style="margin-top: 5px;margin-bottom: 0;">');
                    $(this).find(' > span > span').addClass('glyphicon-folder-open');
                    $(this).find(' > span > a').text(text);
                    $(this).append(children);
                }
                else {
                    text = $(this).text();
					type = $(this).attr('data-type');
					id = $(this).attr('data-id');
					id2 = $(this).parents('li').attr('data-id');
                    $(this).html('<span><span class="glyphicon"></span><a href="javascript: void(0);"></a> </span><div style="display: inline-block;float: right;margin-top: 7px;"><button onclick="window.location=&#39;cate-create.php?cid='+id2+'&#39;" class="btn btn-success btn-circle" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-plus"></i></button> <button onclick="window.location=&#39;cate-edit.php?id='+id+'&type='+type+'&#39;" class="btn btn-primary btn-circle" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-edit"></i></button> <button onclick="delCate2('+id+','+type+')" class="btn btn-danger btn-circle" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-remove"></i></button></div><hr style="margin-top: 5px;margin-bottom: 0;">');
                    $(this).find(' > span > span').addClass('glyphicon-file');
                    $(this).find(' > span > a').text(text);
                }
            });

            $(easyTree).find('li:has(ul)').addClass('parent_li').find(' > span').attr('title', options.i18n.collapseTip);
			
			// addable
            if (options.addable) {
                $('.easy-tree-toolbar').append('<span class="create"><button class="btn btn-success btn-circle" style="font-size: 13px; padding: 5px 10px;"><i class="fa fa-plus"></i> Thêm</button></span> ');
                $('.easy-tree-toolbar .create > button').attr('title', options.i18n.addTip).click(function () {
					// Thêm danh mục
					if (getSelectedItems().length > 0)
					{
						var cid;
						if (getSelectedItems().attr('data-type') == '1') { cid = getSelectedItems().attr('data-id'); }
						else if (getSelectedItems().attr('data-type') == '2') { cid = getSelectedItems().parents('li').attr('data-id'); }
						window.location='cate-create.php?cid='+cid;
					}
					else
					{
						window.location='cate-create.php';
					}
				});
            }
            // editable
            if (options.editable) {
                $('.easy-tree-toolbar').append('<span class="edit"><button class="btn btn-primary btn-circle disabled" style="font-size: 13px; padding: 5px 10px;"><i class="fa fa-edit"></i> Sửa</button></span> ');
                $('.easy-tree-toolbar .edit > button').attr('title', options.i18n.editTip).click(function () {
					// Sửa danh mục
					if (getSelectedItems().length > 0)
					{
						var ctype;
						if (getSelectedItems().attr('data-type') == '1'){ ctype = '1'; } else if (getSelectedItems().attr('data-type') == '2') { ctype = '2'; }
						var cid = getSelectedItems().attr('data-id');
						window.location='cate-edit.php?id='+cid+'&type='+ctype;
					}
                });
            }
            // deletable
            if (options.deletable) {
                $('.easy-tree-toolbar').append('<span class="remove"><button class="btn btn-danger btn-circle disabled" style="font-size: 13px; padding: 5px 10px;"><i class="fa fa-remove"></i> Xóa</button></span> ');
                $('.easy-tree-toolbar .remove > button').attr('title', options.i18n.deleteTip).click(function () {
                    var selected = getSelectedItems();
                    if (selected.length <= 0) {
						$(successAlert).remove();
                        $(easyTree).prepend(warningAlert);
                        $(easyTree).find('.alert .alert-content').html('Chọn một danh mục để xóa');
						// Chưa chọn danh mục để xóa
                    } else {
						if (selected.attr('data-type') == '1') { var ctype = '1'; } else if (selected.attr('data-type') == '2') { var ctype = '2'; }
						var cid = selected.attr('data-id');
						bootbox.confirm("Bạn có chắc là muốn xóa danh mục này?", function(result) {
						if (result == true) {
							$.ajax({
								url : 'process/del-cate.php',
								type : 'post',
								dataType : 'json',
								data : {
									id : cid,
									type : ctype
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
										$(selected).find(' ul ').remove();
										if($(selected).parent('ul').find(' > li').length <= 1) {
											$(selected).parents('li').removeClass('parent_li').find(' > span > span').removeClass('glyphicon-folder-open').addClass('glyphicon-file');
											$(selected).parent('ul').remove();
										}                            
										$(selected).remove();
										$(dangerAlert).remove();
										$(easyTree).prepend(successAlert);
										$(easyTree).find('.alert .alert-content').html('Xóa thành công');
										$('.easy-tree-toolbar .edit > button').addClass('disabled');
										$('.easy-tree-toolbar .remove > button').addClass('disabled');
									}
								}
								});
							}
						});
                    }
                });
            }
            // collapse or expand
            $(easyTree).delegate('li.parent_li > span', 'click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(':visible')) {
                    children.hide('fast');
                    $(this).attr('title', options.i18n.expandTip)
                        .find(' > span.glyphicon')
                        .addClass('glyphicon-folder-close')
                        .removeClass('glyphicon-folder-open');
                } else {
                    children.show('fast');
                    $(this).attr('title', options.i18n.collapseTip)
                        .find(' > span.glyphicon')
                        .addClass('glyphicon-folder-open')
                        .removeClass('glyphicon-folder-close');
                }
                e.stopPropagation();
            });
            // selectable, only single select
            if (options.selectable) {
                $(easyTree).find('li > span > a').attr('title', options.i18n.selectTip);
                $(easyTree).find('li > span > a').click(function (e) {
                    var li = $(this).parent().parent();
                    if (li.hasClass('li_selected')) {
                        $(this).attr('title', options.i18n.selectTip);
                        $(li).removeClass('li_selected');
                    }
                    else {
                        $(easyTree).find('li.li_selected').removeClass('li_selected');
                        $(this).attr('title', options.i18n.unselectTip);
                        $(li).addClass('li_selected');
                    }
                    if (options.deletable || options.editable || options.addable) {
                        var selected = getSelectedItems();
                        if (options.editable) {
                            if (selected.length <= 0 || selected.length > 1)
                                $('.easy-tree-toolbar .edit > button').addClass('disabled');
                            else
                                $('.easy-tree-toolbar .edit > button').removeClass('disabled');
                        }
                        if (options.deletable) {
                            if (selected.length <= 0 || selected.length > 1)
                                $('.easy-tree-toolbar .remove > button').addClass('disabled');
                            else
                                $('.easy-tree-toolbar .remove > button').removeClass('disabled');
                        }
                    }
                    e.stopPropagation();
                });
            }
            var getSelectedItems = function () {
                return $(easyTree).find('li.li_selected');
            };
        });
    };
///////////////////////////////////////////////////////////////////////////////////////////////
var CreateCate = function () {
	var handleTagsInput = function () {
        if (!jQuery().tagsInput) {
            return;
        }
       $('[name="catekeyword"]').tagsInput({
            width: 'auto',
            'onAddTag': function () {
            },
        });
    }
    return {
        init: function () {
            handleTagsInput();
			$('#catekeyword_tagsinput').attr('class','form-control tagsinput');
        }
    };
}();
function uncheckCate() {
	$('[name="catecate"]:checked').parent().removeClass('checked');
	$('[name="catecate"]:checked').prop('checked',false);
}
function createCate() {
	var fd = new FormData(document.getElementById("catedata"));
	$.ajax({
        url : 'process/create-cate.php',
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
				if (result.title != '0') {
					$('#errtitle').attr({'data-original-title':'Chưa nhập tên danh mục','class':'fa fa-warning tooltips'});
					$('#titlediv').attr('class','form-group has-warning'); 
					pulsw('catetitle');
					Metronic.scrollTo2($('#titlediv'),-100);
				}
				else
				{
					$('#errtitle').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
					$('#titlediv').attr('class','form-group');
					if (result.description != '0') {
						$('#errdescription').attr({'data-original-title':'Chưa nhập mô tả','class':'fa fa-warning tooltips'});
						$('#descriptiondiv').attr('class','form-group has-warning'); 
						pulsw('catedescription');
						Metronic.scrollTo2($('#descriptiondiv'),-100);
					}
					else
					{
						$('#errdescription').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
						$('#descriptiondiv').attr('class','form-group');
						if (result.keyword != '0') {
							$('#errkeyword').attr({'data-original-title':'Chưa nhập từ khóa','class':'fa fa-warning tooltips'});
							$('#keyworddiv').attr('class','form-group has-warning'); 
							pulsw('catekeyword');
							Metronic.scrollTo2($('#keyworddiv'),-100);
						}
						else
						{
							$('#errkeyword').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
							$('#keyworddiv').attr('class','form-group');
							if (result.cate != '0') {
								$('#errcate').attr({'data-original-title':'Danh mục không hợp lệ','class':'fa fa-warning tooltips'});
								$('#catediv').attr('class','form-group has-warning'); 
								pulsw('catecate');
								Metronic.scrollTo2($('#catediv'),-100);
							}
							else
							{
								$('#errcate').attr({'data-original-title':'Mục này không bắt buộc','class':'fa fa-info-circle tooltips'}); 
								$('#catediv').attr('class','form-group');
								if (result.image != '0') {
									if (result.image == '2') { $('#errimage').attr({'data-original-title':'Ảnh không hợp lệ, chỉ cho phép các tệp định dạng jpg, jpeg ,png ,gif ,tiff ,bmp','class':'fa fa-warning tooltips'}); }
									else if (result.image == '3') { $('#errimage').attr({'data-original-title':'Ảnh không hợp lệ, chỉ cho phép các tệp dưới 3mb','class':'fa fa-warning tooltips'}); }
									else if (result.image == '4') { $('#errimage').attr({'data-original-title':'Ảnh không hợp lệ, chỉ cho phép ảnh kích thước lớn hơn hoặc bằng 1500x280 và tỉ lệ với 1500x280','class':'fa fa-warning tooltips'}); }
									$('#imagediv').attr('class','form-group has-warning'); 
									pulsw('cateimage');
									Metronic.scrollTo2($('#imagediv'),-100);
								}
								else
								{
									$('#errimage').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
									$('#imagediv').attr('class','form-group');
									if (result.done == '1') {
										Metronic.alert({
											type: 'success',
											icon: 'check',
											message: 'Đã thêm danh mục mới',
											place: 'prepend'
										});
									}
								}
							}
						}
					}
				}
			}
		}
	});
	return false;
}
function handleCateImage() {
	if ( $('[name="cateimagestatus"]:checked').val() == '1' )
	{
		$('#hidecateimage').show('fast');
		Metronic.scrollTo2($('#hidecateimage'),-100);
	}
	else
	{
		$('#hidecateimage').hide('fast');
	}
}
function editCate() {
	var fd = new FormData(document.getElementById("catedata"));
	$.ajax({
        url : 'process/edit-cate.php',
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
				if (result.title != '0') {
					$('#errtitle').attr({'data-original-title':'Chưa nhập tên danh mục','class':'fa fa-warning tooltips'});
					$('#titlediv').attr('class','form-group has-warning'); 
					pulsw('catetitle');
					Metronic.scrollTo2($('#titlediv'),-100);
				}
				else
				{
					$('#errtitle').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
					$('#titlediv').attr('class','form-group');
					if (result.description != '0') {
						$('#errdescription').attr({'data-original-title':'Chưa nhập mô tả','class':'fa fa-warning tooltips'});
						$('#descriptiondiv').attr('class','form-group has-warning'); 
						pulsw('catedescription');
						Metronic.scrollTo2($('#descriptiondiv'),-100);
					}
					else
					{
						$('#errdescription').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
						$('#descriptiondiv').attr('class','form-group');
						if (result.keyword != '0') {
							$('#errkeyword').attr({'data-original-title':'Chưa nhập từ khóa','class':'fa fa-warning tooltips'});
							$('#keyworddiv').attr('class','form-group has-warning'); 
							pulsw('catekeyword');
							Metronic.scrollTo2($('#keyworddiv'),-100);
						}
						else
						{
							$('#errkeyword').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
							$('#keyworddiv').attr('class','form-group');
							if (result.cate != '0') {
								$('#errcate').attr({'data-original-title':'Danh mục không hợp lệ','class':'fa fa-warning tooltips'});
								$('#catediv').attr('class','form-group has-warning'); 
								pulsw('catecate');
								Metronic.scrollTo2($('#catediv'),-100);
							}
							else
							{
								$('#errcate').attr({'data-original-title':'Mục này không bắt buộc','class':'fa fa-info-circle tooltips'}); 
								$('#catediv').attr('class','form-group');
								if (result.image != '0') {
									if (result.image == '2') { $('#errimage').attr({'data-original-title':'Ảnh không hợp lệ, chỉ cho phép các tệp định dạng jpg, jpeg ,png ,gif ,tiff ,bmp','class':'fa fa-warning tooltips'}); }
									else if (result.image == '3') { $('#errimage').attr({'data-original-title':'Ảnh không hợp lệ, chỉ cho phép các tệp dưới 3mb','class':'fa fa-warning tooltips'}); }
									else if (result.image == '4') { $('#errimage').attr({'data-original-title':'Ảnh không hợp lệ, chỉ cho phép ảnh kích thước lớn hơn hoặc bằng 1500x280 và tỉ lệ với 1500x280','class':'fa fa-warning tooltips'}); }
									$('#imagediv').attr('class','form-group has-warning'); 
									pulsw('cateimage');
									Metronic.scrollTo2($('#imagediv'),-100);
								}
								else
								{
									$('#errimage').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
									$('#imagediv').attr('class','form-group');
									if (result.done == '1') {
										Metronic.alert({
											type: 'success',
											icon: 'check',
											message: 'Đã lưu',
											place: 'prepend'
										});
									}
								}
							}
						}
					}
				}
			}
		}
	});
	return false;
}
function delCate(id, type) {
	bootbox.confirm("Bạn có chắc là muốn xóa danh mục này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/del-cate.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : type
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
						window.location='cate-list.php';
					}
				}
			});
		}
	}); 
}
function delBook(id) {
	bootbox.confirm("Bạn có chắc là muốn xóa sách này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/del-book.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
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
						window.location='book-list.php';
					}
				}
			});
		}
	}); 
}
function delCate2(id, type) {
	bootbox.confirm("Bạn có chắc là muốn xóa danh mục này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/del-cate.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : type
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
						$('[data-type="'+type+'"][data-id="'+id+'"]').remove();
					}
				}
			});
		}
	}); 
}
////////////////////////////////////////////////////////////////////////////////////////
var UserList = function() {
    var handleUsers = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_users"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-user.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleUsers();
        }
    };
}();
///////////////////////////////////////////////////////////////////////////////////////
var UserEdit = function () {
	var handleWishlist = function () {
        var grid = new Datatable();
        grid.setAjaxParam("userid",$("#userid").val());
        grid.init({
            src: $("#datatable_wishlist"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-wishlist.php",
                },
                "order": [
                    [3, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
				grid.setAjaxParam("userid",$("#userid").val());
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một sách yêu thích',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
	var handleRequest = function () {
        var grid = new Datatable();
        grid.setAjaxParam("userid",$("#userid").val());
        grid.init({
            src: $("#datatable_request"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-request.php",
                },
                "order": [
                    [3, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
				grid.setAjaxParam("userid",$("#userid").val());
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một yêu cầu sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
	var handleContribute = function () {
        var grid = new Datatable();
        grid.setAjaxParam("userid",$("#userid").val());
        grid.init({
            src: $("#datatable_contribute"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-contribute.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
				grid.setAjaxParam("userid",$("#userid").val());
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một đóng góp sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
	var handleOrder = function () {
        var grid = new Datatable();
        grid.setAjaxParam("userid",$("#userid").val());
        grid.init({
            src: $("#datatable_order"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-order.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
				grid.setAjaxParam("userid",$("#userid").val());
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một đơn hàng',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    var handleReviews = function () {
        var grid = new Datatable();
        grid.setAjaxParam("userid",$("#userid").val());
        grid.init({
            src: $("#datatable_reviews"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-review2.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    var handleComments = function () {
        var grid = new Datatable();
        grid.setAjaxParam("userid",$("#userid").val());
        grid.init({
            src: $("#datatable_comments"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, -1],
                    [20, 50, 100, 150, "All"] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-comment2.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
				grid.setAjaxParam("userid",$("#userid").val());
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    var initComponents = function () {
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }
    return {
        init: function () {
            initComponents();
			handleWishlist();
			handleRequest();
			handleContribute();
			handleOrder();
            handleReviews();
            handleComments();
        }
    };
}();
function confirmUser(id) {
	bootbox.confirm("Bạn có chắc là muốn xác nhận thành viên này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/confirm-user.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
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
						if (result.done == '1')
						{
							$('#textConfirm').removeClass('label-danger').addClass('label-success').text('Đã xác nhận');
							$('#btnConfirm').remove();
						}
					}
				}
			});
		}
	}); 
}
function userMd5PassEncode() {
	$('[name="user[pass]"]').val(md5($('[name="user[pass]"]').val()));
}
function useredit() {
	$.ajax({
        url : 'process/edit-user.php',
        type : 'post',
        dataType : 'json',
        data : {
			userid : $('[name="user[id]"]').val(),
			username : $('[name="user[name]"]').val(),
			userclass : $('[name="user[class]"]').val(),
			userbirthday : $('[name="user[birthday]"]').val(),
			useremail : $('[name="user[email]"]').val(),
			userscode : $('[name="user[scode]"]').val(),
			userpass : $('[name="user[pass]"]').val()
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
				if (result.name != '0') {
					$('#errname').attr({'data-original-title':'Chưa nhập tên thành viên','class':'fa fa-warning tooltips'});
					$('#namediv').attr('class','form-group has-warning'); 
					pulsw('username');
					Metronic.scrollTo2($('#namediv'),-100);
				}
				else
				{
					$('#errname').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
					$('#namediv').attr('class','form-group');
					if (result.class != '0') {
						if (result.class == '1') { 
							$('#errclass').attr({'data-original-title':'Chưa nhập lớp','class':'fa fa-warning tooltips'}); 
							$('#classdiv').attr('class','form-group has-warning'); 
							pulsw('userclass');
						}
						else if (result.class == '2') { 
							$('#errclass').attr({'data-original-title':'Lớp không hợp lệ','class':'fa fa-exclamation tooltips'}); 
							$('#classdiv').attr('class','form-group has-error'); 
							pulse('userclass');
						}
						Metronic.scrollTo2($('#classdiv'),-100);
					}
					else
					{
						$('#errclass').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
						$('#classdiv').attr('class','form-group');
						if (result.birthday != '0') {
							if (result.birthday == '1') { 
								$('#errbirthday').attr({'data-original-title':'Chưa nhập ngày sinh','class':'fa fa-warning tooltips'}); 
								$('#birthdaydiv').attr('class','form-group has-warning'); 
								pulsw('userbirthday');
							}
							else if (result.birthday == '2') { 
								$('#errbirthday').attr({'data-original-title':'Ngày sinh không hợp lệ','class':'fa fa-exclamation tooltips'}); 
								$('#birthdaydiv').attr('class','form-group has-error'); 
								pulse('userbirthday');
							}
							Metronic.scrollTo2($('#birthdaydiv'),-100);
						}
						else
						{
							$('#errbirthday').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
							$('#birthdaydiv').attr('class','form-group');
							if (result.email != '0') {
								if (result.email == '1') { 
									$('#erremail').attr({'data-original-title':'Chưa nhập email','class':'fa fa-warning tooltips'}); 
									$('#emaildiv').attr('class','form-group has-warning'); 
									pulsw('useremail');
								}
								else if (result.email == '2') { 
									$('#erremail').attr({'data-original-title':'Email không hợp lệ','class':'fa fa-exclamation tooltips'}); 
									$('#emaildiv').attr('class','form-group has-error'); 
									pulse('useremail');
								}
								else if (result.email == '3') { 
									$('#erremail').attr({'data-original-title':'Email đã có người sử dụng','class':'fa fa-exclamation tooltips'}); 
									$('#emaildiv').attr('class','form-group has-error'); 
									pulse('useremail');
								}
								Metronic.scrollTo2($('#emaildiv'),-100);
							}
							else
							{
								$('#erremail').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
								$('#emaildiv').attr('class','form-group');
								if (result.scode != '0') {
									if (result.scode == '1') { 
										$('#errscode').attr({'data-original-title':'Chưa nhập mã học sinh','class':'fa fa-warning tooltips'}); 
										$('#scodediv').attr('class','form-group has-warning'); 
										pulsw('userscode');
									}
									else if (result.scode == '2') { 
										$('#errscode').attr({'data-original-title':'Mã học sinh không hợp lệ','class':'fa fa-exclamation tooltips'}); 
										$('#scodediv').attr('class','form-group has-error'); 
										pulse('userscode');
									}
									Metronic.scrollTo2($('#scodediv'),-100);
								}
								else
								{
									$('#errscode').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
									$('#scodediv').attr('class','form-group');
									if (result.pass != '0') {
										if (result.pass == '1') { 
											$('#errpass').attr({'data-original-title':'Chưa nhập mật khẩu','class':'fa fa-warning tooltips'}); 
											$('#passdiv').attr('class','form-group has-warning'); 
											pulsw('userpass');
										}
										else if (result.pass == '2') { 
											$('#errpass').attr({'data-original-title':'Mật khẩu không hợp lệ','class':'fa fa-exclamation tooltips'}); 
											$('#passdiv').attr('class','form-group has-error'); 
											pulse('userpass');
										}
										Metronic.scrollTo2($('#passdiv'),-100);
									}
									else
									{
										$('#errpass').attr({'data-original-title':'Mục này là bắt buộc','class':'fa fa-info-circle tooltips'}); 
										$('#passdiv').attr('class','form-group');
										if (result.done == '1') {
											Metronic.alert({
												type: 'success',
												icon: 'check',
												message: 'Đã lưu',
												place: 'prepend'
											});
										}
									}
								}
							}
						}
					}
				}
			}
		}
	});
	return false;
}
///////////////////////////////////////////////////////////////////////////////////////
var Order = function() {
    var handleOrders = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_order"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-order2.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một đơn sách',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleOrders();
        }
    };
}();
/////////////////////////////////////////////////////////////////////////////////////////
function cancelOrder(id) {
	bootbox.confirm("Bạn có chắc là muốn hủy đơn sách này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-order.php',
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
							bootbox.alert("Hủy đơn sách thành công!", function() {
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
function confirmOrder(id) {
		bootbox.confirm("Bạn có chắc là muốn xác nhận đơn sách này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 2
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
							bootbox.alert("Xác nhận đơn sách thành công!", function() {
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
function startOrder(id) {
	bootbox.confirm("Đơn sách này đã được mượn?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 3
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
							bootbox.alert("Xác nhận mượn sách thành công!", function() {
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
function stopOrder(id) {
	bootbox.confirm("Đơn sách này đã được trả?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 4
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
							bootbox.alert("Xác nhận trả sách thành công!", function() {
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
function warnOrder(id) {
	bootbox.confirm("Yêu cầu trả sách?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 6
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
							bootbox.alert("Thành công!", function() {
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
				url : 'process/edit-method-order.php',
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
				url : 'process/edit-note-order.php',
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
				url : 'process/edit-note-order.php',
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
				url : 'process/del-eachorder.php',
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
	bootbox.confirm("Yêu cầu thành viên xác nhận lại đơn sách?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-order.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 5
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
							bootbox.alert("Yêu cầu thành công!", function() {
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
//////////////////////////////////////////////////////////////////////////////////////////
var Problem = function () {
    var handleBook = function() {
        var selectBook = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: 'process/select-book.php?q=%QUERY'
        });
        selectBook.initialize();
        $('#book').typeahead(null, {
		  name: 'book',
          displayKey: 'id',
          source: selectBook.ttAdapter(),
          hint: true,
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<img src="../../50x67/{{img1}}"/>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<h4 class="media-heading">{{title}}</h4>',
                        '<p style="margin-bottom: 5px">{{id}}</p>',
						'<p>{{cate}}</p>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });
    };
	var handleUser = function() {
        var selectUser = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: 'process/select-user.php?q=%QUERY'
        });
        selectUser.initialize();
        $('#user').typeahead(null, {
		  name: 'user',
          displayKey: 'id',
          source: selectUser.ttAdapter(),
          hint: true,
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<img src="../../50x67/{{image}}"/>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<h4 class="media-heading">{{name}}</h4>',
                        '<p style="margin-bottom: 5px">{{id}}</p>',
						'<p>{{scode}}</p>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });
    };
    return {
        init: function () {
            handleBook();
			handleUser();
        }
    };
}();
/////////////////////////////////////////////////////////////////////////////////////////
function addProblem()
{
	$.ajax({
        url : 'process/add-problem.php',
        type : 'post',
        dataType : 'json',
        data : {
			book : $('#book').val(),
			user : $('#user').val(),
			type : $('#type').val(),
			note : $('#note').val()
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
				if (result.book != '0') {
					if (result.book == '1') { $('#errbook').attr({'data-original-title':'Chưa nhập id sách','class':'fa fa-warning tooltips'}); $('#bookdiv').attr('class','form-group has-warning'); pulsw('book');}
					else if (result.book == '2') { $('#errbook').attr({'data-original-title':'Không có sách này','class':'fa fa-exclamation tooltips'}); $('#bookdiv').attr('class','form-group has-error'); pulse('book'); }
					Metronic.scrollTo2($('#bookdiv'),-100);
				}
				else
				{
					$('#errbook').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
					$('#bookdiv').attr('class','form-group has-success');
					if (result.user != '0') {
						if (result.user == '1') { $('#erruser').attr({'data-original-title':'Chưa nhập id thành viên','class':'fa fa-warning tooltips'}); $('#userdiv').attr('class','form-group has-warning'); pulsw('user');}
						else if (result.user == '2') { $('#erruser').attr({'data-original-title':'Không có thành viên này','class':'fa fa-exclamation tooltips'}); $('#userdiv').attr('class','form-group has-error'); pulse('user');}
						Metronic.scrollTo2($('#userdiv'),-100);
					}
					else
					{
						$('#erruser').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#userdiv').attr('class','form-group has-success');
						if (result.type != '0') {
							$('#errtype').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'}); $('#typediv').attr('class','form-group has-error'); pulse('type');
							Metronic.scrollTo2($('#typediv'),-100);
						}
						else
						{
							$('#errtype').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
							$('#typediv').attr('class','form-group has-success');
							if (result.done == '1') {
								window.location='problem-list.php';
							}
						}
					}
				}
			}
		}
	});
	return false;
}
////////////////////////////////////////////////////////////////////////////////////////
var ProblemList = function() {
    var handleProblems = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_problems"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-problem.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một vấn đề',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleProblems();
        }
    };
}();
///////////////
function editProblem()
{
	$.ajax({
        url : 'process/edit-problem.php',
        type : 'post',
        dataType : 'json',
        data : {
			id : $('#proid').val(),
			book : $('#book').val(),
			user : $('#user').val(),
			type : $('#type').val(),
			note : $('#note').val()
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
				if (result.id != '0') {
					alert('ERROR');
				}
				else
				{
					if (result.book != '0') {
						if (result.book == '1') { $('#errbook').attr({'data-original-title':'Chưa nhập id sách','class':'fa fa-warning tooltips'}); $('#bookdiv').attr('class','form-group has-warning'); pulsw('book');}
						else if (result.book == '2') { $('#errbook').attr({'data-original-title':'Không có sách này','class':'fa fa-exclamation tooltips'}); $('#bookdiv').attr('class','form-group has-error'); pulse('book'); }
						Metronic.scrollTo2($('#bookdiv'),-100);
					}
					else
					{
						$('#errbook').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#bookdiv').attr('class','form-group has-success');
						if (result.user != '0') {
							if (result.user == '1') { $('#erruser').attr({'data-original-title':'Chưa nhập id thành viên','class':'fa fa-warning tooltips'}); $('#userdiv').attr('class','form-group has-warning'); pulsw('user');}
							else if (result.user == '2') { $('#erruser').attr({'data-original-title':'Không có thành viên này','class':'fa fa-exclamation tooltips'}); $('#userdiv').attr('class','form-group has-error'); pulse('user');}
							Metronic.scrollTo2($('#userdiv'),-100);
						}
						else
						{
							$('#erruser').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
							$('#userdiv').attr('class','form-group has-success');
							if (result.type != '0') {
								$('#errtype').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'}); $('#typediv').attr('class','form-group has-error'); pulse('type');
								Metronic.scrollTo2($('#typediv'),-100);
							}
							else
							{
								$('#errtype').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
								$('#typediv').attr('class','form-group has-success');
								if (result.done == '1') {
									window.location.reload();
								}
							}
						}
					}
				}
			}
		}
	});
	return false;
}
////////////////////////////////////////////////////////////////////////////////////////
var CommentList = function() {
    var handleComments = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_comments"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-comment3.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một bình luận',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleComments();
        }
    };
}();
////////////////////////////////////////////////////////////////////////////////////////
var ReviewList = function() {
    var handleReviews = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_reviews"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-review3.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một nhận xét',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleReviews();
        }
    };
}();
///////////////////////////////////////////////////////////////////////////////////////
var CmtRvw = function () {
    var handleBook = function() {
        var selectBook = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: 'process/select-book.php?q=%QUERY'
        });
        selectBook.initialize();
        $('#book').typeahead(null, {
		  name: 'book',
          displayKey: 'id',
          source: selectBook.ttAdapter(),
          hint: true,
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<img src="../../50x67/{{img1}}"/>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<h4 class="media-heading">{{title}}</h4>',
                        '<p style="margin-bottom: 5px">{{id}}</p>',
						'<p>{{cate}}</p>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });
    };
	var handleUser = function() {
        var selectUser = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: 'process/select-user.php?q=%QUERY'
        });
        selectUser.initialize();
        $('#user').typeahead(null, {
		  name: 'user',
          displayKey: 'id',
          source: selectUser.ttAdapter(),
          hint: true,
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<img src="../../50x67/{{image}}"/>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<h4 class="media-heading">{{name}}</h4>',
                        '<p style="margin-bottom: 5px">{{id}}</p>',
						'<p>{{scode}}</p>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });
    };
    return {
        init: function () {
            handleBook();
			handleUser();
        }
    };
}();
/////////////////////////////////////////////////////////////////////////////////////////
function editComment()
{
	$.ajax({
        url : 'process/edit-comment.php',
        type : 'post',
        dataType : 'json',
        data : {
			id : $('#proid').val(),
			book : $('#book').val(),
			user : $('#user').val(),
			content : $('#content').val()
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
				if (result.id != '0') {
					alert('ERROR');
				}
				else
				{
					if (result.book != '0') {
						if (result.book == '1') { $('#errbook').attr({'data-original-title':'Chưa nhập id sách','class':'fa fa-warning tooltips'}); $('#bookdiv').attr('class','form-group has-warning'); pulsw('book');}
						else if (result.book == '2') { $('#errbook').attr({'data-original-title':'Không có sách này','class':'fa fa-exclamation tooltips'}); $('#bookdiv').attr('class','form-group has-error'); pulse('book'); }
						Metronic.scrollTo2($('#bookdiv'),-100);
					}
					else
					{
						$('#errbook').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#bookdiv').attr('class','form-group has-success');
						if (result.user != '0') {
							if (result.user == '1') { $('#erruser').attr({'data-original-title':'Chưa nhập id thành viên','class':'fa fa-warning tooltips'}); $('#userdiv').attr('class','form-group has-warning'); pulsw('user');}
							else if (result.user == '2') { $('#erruser').attr({'data-original-title':'Không có thành viên này','class':'fa fa-exclamation tooltips'}); $('#userdiv').attr('class','form-group has-error'); pulse('user');}
							Metronic.scrollTo2($('#userdiv'),-100);
						}
						else
						{
							$('#erruser').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
							$('#userdiv').attr('class','form-group has-success');
							if (result.content != '0') {
								$('#errcontent').attr({'data-original-title':'Chưa nhập nội dung','class':'fa fa-exclamation tooltips'}); $('#contentdiv').attr('class','form-group has-error'); pulse('content');
								Metronic.scrollTo2($('#contentdiv'),-100);
							}
							else
							{
								$('#errcontent').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
								$('#contentdiv').attr('class','form-group has-success');
								if (result.done == '1') {
									window.location.reload();
								}
							}
						}
					}
				}
			}
		}
	});
	return false;
}
/////////////////////////////////////////////////////////////////////////////////////////
function editReview()
{
	$.ajax({
        url : 'process/edit-review.php',
        type : 'post',
        dataType : 'json',
        data : {
			id : $('#proid').val(),
			book : $('#book').val(),
			user : $('#user').val(),
			content : $('#content').val(),
			rating : $('#rating').val()
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
				if (result.id != '0') {
					alert('ERROR');
				}
				else
				{
					if (result.book != '0') {
						if (result.book == '1') { $('#errbook').attr({'data-original-title':'Chưa nhập id sách','class':'fa fa-warning tooltips'}); $('#bookdiv').attr('class','form-group has-warning'); pulsw('book');}
						else if (result.book == '2') { $('#errbook').attr({'data-original-title':'Không có sách này','class':'fa fa-exclamation tooltips'}); $('#bookdiv').attr('class','form-group has-error'); pulse('book'); }
						Metronic.scrollTo2($('#bookdiv'),-100);
					}
					else
					{
						$('#errbook').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#bookdiv').attr('class','form-group has-success');
						if (result.user != '0') {
							if (result.user == '1') { $('#erruser').attr({'data-original-title':'Chưa nhập id thành viên','class':'fa fa-warning tooltips'}); $('#userdiv').attr('class','form-group has-warning'); pulsw('user');}
							else if (result.user == '2') { $('#erruser').attr({'data-original-title':'Không có thành viên này','class':'fa fa-exclamation tooltips'}); $('#userdiv').attr('class','form-group has-error'); pulse('user');}
							Metronic.scrollTo2($('#userdiv'),-100);
						}
						else
						{
							$('#erruser').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
							$('#userdiv').attr('class','form-group has-success');
							if (result.rating != '0') {
								$('#errrating').attr({'data-original-title':'Không hợp lệ','class':'fa fa-exclamation tooltips'}); $('#ratingdiv').attr('class','form-group has-error'); pulse('rating');
								Metronic.scrollTo2($('#ratingdiv'),-100);
							}
							else
							{
								$('#errrating').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
								$('#ratingdiv').attr('class','form-group has-success');
								if (result.content != '0') {
									$('#errcontent').attr({'data-original-title':'Chưa nhập nội dung','class':'fa fa-exclamation tooltips'}); $('#contentdiv').attr('class','form-group has-error'); pulse('content');
									Metronic.scrollTo2($('#contentdiv'),-100);
								}
								else
								{
									$('#errcontent').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
									$('#contentdiv').attr('class','form-group has-success');
									if (result.done == '1') {
										window.location.reload();
									}
								}
							}
						}
					}
				}
			}
		}
	});
	return false;
}
////////////////////////////////////////////////////////////////////////////////////////
function delComment(id) {
	bootbox.confirm("Bạn có chắc là muốn xóa bình luận này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/del-comment.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
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
						window.location='comment-list.php';
					}
				}
			});
		}
	}); 
}
////////////////////////////////////////////////////////////////////////////////////////
function delReview(id) {
	bootbox.confirm("Bạn có chắc là muốn xóa nhận xét này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/del-review.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
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
						window.location='review-list.php';
					}
				}
			});
		}
	}); 
}
////////////////////////////////////////////////////////////////////////////////////////
function delProblem(id) {
	bootbox.confirm("Bạn có chắc là muốn xóa vấn đề này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/del-problem.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
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
						window.location='problem-list.php';
					}
				}
			});
		}
	}); 
}
////////////////////////////////////////////////////////////////////////////////////////
var RequestList = function() {
    var handleRequests = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_requests"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-request2.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một yêu cầu',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleRequests();
        }
    };
}();
////////////////////////////////////////////////////////////////////////////////////////
var ContributeList = function() {
    var handleContributes = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_contributes"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-contribute2.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một đóng góp',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleContributes();
        }
    };
}();
////////////////////////////////////////////////////////////////////////////////////////
function acceptRequest(id) {
	bootbox.confirm("Bạn có chắc là muốn xác nhận yêu cầu này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-request.php',
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
							bootbox.alert("Xác nhận yêu cầu thành công!", function() {
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
function dismissRequest(id) {
	bootbox.confirm("Bạn có chắc là muốn hủy yêu cầu này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-request.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 2
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
							bootbox.alert("Hủy yêu cầu thành công!", function() {
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
function requested(id) {
	bootbox.prompt("Nhập id sách đã được đáp ứng", function(result) {
		if (result === null) {
			bootbox.alert("Lỗi!");
		} else  {
			$.ajax({
				url : 'process/handle-request.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 3,
					idb : result
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
						if (result.idb != '0')
						{
							bootbox.alert("Lỗi!");
						}
						if (result.done == '1') {
							bootbox.alert("Đáp ứng yêu cầu thành công!", function() {
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
////////////////////////////////////////////////////////////////////////////////////////
function acceptContribute(id) {
	bootbox.confirm("Bạn có chắc là muốn xác nhận đóng góp này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-contribute.php',
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
							bootbox.alert("Xác nhận đóng góp thành công!", function() {
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
function dismissContribute(id) {
	bootbox.confirm("Bạn có chắc là muốn hủy đóng góp này?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/handle-contribute.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 2
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
							bootbox.alert("Hủy đóng góp thành công!", function() {
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
function contributed(id) {
	bootbox.prompt("Nhập id sách đã được đóng góp", function(result) {
		if (result === null) {
			bootbox.alert("Lỗi!");
		} else  {
			$.ajax({
				url : 'process/handle-contribute.php',
				type : 'post',
				dataType : 'json',
				data : {
					id : id,
					type : 3,
					idb : result
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
						if (result.idb != '0')
						{
							bootbox.alert("Lỗi!");
						}
						if (result.done == '1') {
							bootbox.alert("Nhận đóng góp thành công!", function() {
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

///////////////////////////////////////////////////////////////////////////////////////
var Basic = function () {
	var handleTagsInput = function () {
        if (!jQuery().tagsInput) {
            return;
        }
       $('#keyword').tagsInput({
            width: 'auto',
            'onAddTag': function () {
            },
        });
    }
    return {
        init: function () {
			handleTagsInput();
			$('#keyword_tagsinput').attr('class','form-control tagsinput');
			$('#summernote').summernote();
			$('#summernote2').summernote();
			$('#summernote3').summernote();
        }
    };
}();
////////////////////////////////////////////////////////////////////////////////////////
var SubList = function() {
    var handleSubs = function() {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_subs"),
            onSuccess: function (grid) { },
            onError: function (grid) { },
            loadingMessage: 'Đang tải...',
            dataTable: {
                "lengthMenu": [
                    [20, 50, 100, 150, 200],
                    [20, 50, 100, 150, 200] 
                ],
                "pageLength": 20,
                "ajax": {
                    "url": "process/get-sub.php",
                },
                "order": [
                    [1, "desc"]
                ]
            }
        });
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một hành động',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Hãy chọn một đăng ký theo dõi',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    return {
        init: function () {
            handleSubs();
        }
    };
}();
///////////////////////////////////////////////////////////////////////////////////////
function basic()
{
	$.ajax({
		url : 'process/edit-basic.php',
		type : 'post',
		dataType : 'json',
		data : {
			title : $('#title').val(),
			des : $('#summernote').code(),
			intro : $('#summernote2').code(),
			term : $('#summernote3').code(),
			keyword : $('#keyword').val(),
			domain : $('#domain').val()
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
				if (result.title != '0') {
					$('#errtitle').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
					$('#titlediv').attr('class','form-group has-error');
					pulse('title');
					Metronic.scrollTo2($('#titlediv'),-100);
				}
				else
				{
					$('#errtitle').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
					$('#titlediv').attr('class','form-group has-success');
					if (result.des != '0') {
						$('#errdescription').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
						$('#descriptiondiv').attr('class','form-group has-error');
						pulse('description');
						Metronic.scrollTo2($('#descriptiondiv'),-100);
					}
					else
					{
						$('#errdescription').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#descriptiondiv').attr('class','form-group has-success');
						if (result.intro != '0') {
							$('#errintroduce').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
							$('#introducediv').attr('class','form-group has-error');
							pulse('introduce');
							Metronic.scrollTo2($('#intrducediv'),-100);
						}
						else
						{
							$('#errintroduce').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
							$('#introducediv').attr('class','form-group has-success');
							if (result.term != '0') {
								$('#errterm').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
								$('#termdiv').attr('class','form-group has-error');
								pulse('term');
								Metronic.scrollTo2($('#termdiv'),-100);
							}
							else
							{
								$('#errterm').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
								$('#termdiv').attr('class','form-group has-success');
								if (result.keyword != '0') {
									$('#errkeyword').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
									$('#keyworddiv').attr('class','form-group has-error');
									pulse('keyword');
									Metronic.scrollTo2($('#keyworddiv'),-100);
								}
								else
								{
									$('#errkeyword').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
									$('#keyworddiv').attr('class','form-group has-success');
									if (result.domain != '0') {
										$('#errdomain').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
										$('#domaindiv').attr('class','form-group has-error');
										pulse('domain');
										Metronic.scrollTo2($('#domaindiv'),-100);
									}
									else
									{
										if (result.done == '1') {
											window.location.reload();
										}
									}
								}
							}
						}
					}
				}
			}
		}
	});
	return false;
}
///////////////////////////////////////////////////////////////////////////////////////
function info()
{
	$.ajax({
		url : 'process/edit-info.php',
		type : 'post',
		dataType : 'json',
		data : {
			mail : $('#mail').val(),
			phone : $('#phone').val(),
			addr : $('#addr').val(),
			skype : $('#skype').val(),
			yh : $('#yh').val()
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
				if (result.mail != '0') {
					$('#errmail').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
					$('#maildiv').attr('class','form-group has-error');
					pulse('mail');
					Metronic.scrollTo2($('#maildiv'),-100);
				}
				else
				{
					$('#errmail').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
					$('#maildiv').attr('class','form-group has-success');
					if (result.phone != '0') {
						$('#errphone').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
						$('#phonediv').attr('class','form-group has-error');
						pulse('phone');
						Metronic.scrollTo2($('#phonediv'),-100);
					}
					else
					{
						$('#errphone').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#phonediv').attr('class','form-group has-success');
						if (result.addr != '0') {
							$('#erraddrduce').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
							$('#addrducediv').attr('class','form-group has-error');
							pulse('addrduce');
							Metronic.scrollTo2($('#addrducediv'),-100);
						}
						else
						{
							$('#erraddrduce').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
							$('#addrducediv').attr('class','form-group has-success');
							if (result.skype != '0') {
								$('#errskype').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
								$('#skypediv').attr('class','form-group has-error');
								pulse('skype');
								Metronic.scrollTo2($('#skypediv'),-100);
							}
							else
							{
								$('#errskype').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
								$('#skypediv').attr('class','form-group has-success');
								if (result.yh != '0') {
									$('#erryh').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
									$('#yhdiv').attr('class','form-group has-error');
									pulse('yh');
									Metronic.scrollTo2($('#yhdiv'),-100);
								}
								else
								{
									if (result.done == '1') {
										window.location.reload();
									}
								}
							}
						}
					}
				}
			}
		}
	});
	return false;
}
///////////////////////////////////////////////////////////////////////////////////////
function social()
{
	$.ajax({
		url : 'process/edit-social.php',
		type : 'post',
		dataType : 'json',
		data : {
			admin : $('#admin').val(),
			page : $('#page').val(),
			app : $('#app').val(),
			gcs : $('#gcseid').val(),
			gkey : $('#gkey').val()
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
				if (result.admin != '0') {
					$('#erradmin').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
					$('#admindiv').attr('class','form-group has-error');
					pulse('admin');
					Metronic.scrollTo2($('#admindiv'),-100);
				}
				else
				{
					$('#erradmin').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
					$('#admindiv').attr('class','form-group has-success');
					if (result.page != '0') {
						$('#errpage').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
						$('#pagediv').attr('class','form-group has-error');
						pulse('page');
						Metronic.scrollTo2($('#pagediv'),-100);
					}
					else
					{
						$('#errpage').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#pagediv').attr('class','form-group has-success');
						if (result.app != '0') {
							$('#errapp').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
							$('#appdiv').attr('class','form-group has-error');
							pulse('app');
							Metronic.scrollTo2($('#appdiv'),-100);
						}
						else
						{
							$('#errapp').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
							$('#appdiv').attr('class','form-group has-success');
							if (result.gcs != '0') {
								$('#errgcs').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
								$('#gcsdiv').attr('class','form-group has-error');
								pulse('gcs');
								Metronic.scrollTo2($('#gcsdiv'),-100);
							}
							else
							{
                                $('#errgcs').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
                                $('#gcsdivdiv').attr('class','form-group has-success');
                                if (result.gkey != '0') {
                                    $('#errgkey').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
                                    $('#gkeydiv').attr('class','form-group has-error');
                                    pulse('gkey');
                                    Metronic.scrollTo2($('#gkeydiv'),-100);
                                }
                                else
                                {
    								$('#errgkey').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
    								$('#gkeydiv').attr('class','form-group has-success');
    								if (result.done == '1') {
    									window.location.reload();
								    }
                                }
							}
						}
					}
				}
			}
		}
	});
	return false;
}
///////////////////////////////////////////////////////////////////////////////////////
function slide()
{
	$.ajax({
		url : 'process/edit-slide.php',
		type : 'post',
		dataType : 'json',
		data : {
			slide1 : $('#slide1').val(),
			slide2 : $('#slide2').val(),
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
				if (result.slide1 != '0') {
					$('#errslide1').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
					$('#slide1div').attr('class','form-group has-error');
					pulse('slide1');
					Metronic.scrollTo2($('#slide1div'),-100);
				}
				else
				{
					$('#errslide1').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
					$('#slide1div').attr('class','form-group has-success');
					if (result.slide2 != '0') {
						$('#errslide2').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
						$('#slide2div').attr('class','form-group has-error');
						pulse('slide2');
						Metronic.scrollTo2($('#slide2div'),-100);
					}
					else
					{
						$('#errslide2').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#slide2div').attr('class','form-group has-success');
						if (result.done == '1') {
							window.location.reload();
						}
					}
				}
			}
		}
	});
	return false;
}
///////////////////////////////////////////////////////////////////////////////////////
function borrow()
{
	$.ajax({
		url : 'process/edit-borrow.php',
		type : 'post',
		dataType : 'json',
		data : {
			inorder : $('#inorder').val(),
			dayorder : $('#dayorder').val(),
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
				if (result.inorder != '0') {
					$('#errinorder').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
					$('#inorderdiv').attr('class','form-group has-error');
					pulse('inorder');
					Metronic.scrollTo2($('#inorderdiv'),-100);
				}
				else
				{
					$('#errinorder').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
					$('#inorderdiv').attr('class','form-group has-success');
					if (result.dayorder != '0') {
						$('#errdayorder').attr({'data-original-title':'Lỗi','class':'fa fa-error tooltips'});
						$('#dayorderdiv').attr('class','form-group has-error');
						pulse('dayorder');
						Metronic.scrollTo2($('#dayorderdiv'),-100);
					}
					else
					{
						$('#errdayorder').attr({'data-original-title':'Hợp lệ','class':'fa fa-check tooltips'}); 
						$('#dayorderdiv').attr('class','form-group has-success');
						if (result.done == '1') {
							window.location.reload();
						}
					}
				}
			}
		}
	});
	return false;
}
////////////////////////////////////////////////////////////////////////////////////////
function adminLogout()
{
	bootbox.confirm("Bạn có chắc là muốn đăng xuất?", function(result) {
		if (result == true) {
			$.ajax({
				url : 'process/logout.php',
				success : function (result)
				{
					window.location='/admin';
				}
			});
		}
	});
	return false;
}