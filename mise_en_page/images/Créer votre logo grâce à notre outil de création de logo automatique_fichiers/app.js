(function(old) {
  $.fn.attr = function() {
    if(arguments.length === 0) {
      if(this.length === 0) {
        return null;
      }

      var obj = {};
      $.each(this[0].attributes, function() {
        if(this.specified) {
          obj[this.name] = this.value;
        }
      });
      return obj;
    }

    return old.apply(this, arguments);
  };
})($.fn.attr);

$.fn.setCursorPosition = function(pos) {
  this.each(function(index, elem) {
    if (elem.setSelectionRange) {
      elem.setSelectionRange(pos, pos);
    } else if (elem.createTextRange) {
      var range = elem.createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  });
  return this;
};


/**
 * jQuery Plugin to get cursor position
 */

$.fn.getCursorPosition = function () {
	var input = this.get(0);
	if (!input) return; // No (input) element found
	if ('selectionStart' in input) {
		// Standard-compliant browsers
		return input.selectionStart;
	} else if (document.selection) {
		// IE
		input.focus();
		var sel = document.selection.createRange();
		var selLen = document.selection.createRange().text.length;
		sel.moveStart('character', -input.value.length);
		return sel.text.length - selLen;
	}
}

String.prototype.stripAccents = function() {
    var translate_re = /[àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ]/g;
    var translate = 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';
    return (this.replace(translate_re, function(match){
        return translate.substr(translate_re.source.indexOf(match)-1, 1); })
    );
};

String.prototype.containsArabicChar = function() {
    var charset = /[\u0600-\u06FF]/;
	return charset.test(this);
};

String.prototype.containsChinessChar = function() {
  //  var charset = /[\u4e00-\u9fff]|[\u3400-\u4dbf]|[\u{20000}-\u{2a6df}]|[\u{2a700}-\u{2b73f}]|[\u{2b740}-\u{2b81f}]|[\u{2b820}-\u{2ceaf}]|[\uf900-\ufaff]|[\u3300-\u33ff]|[\ufe30-\ufe4f]|[\uf900-\ufaff]|[\u{2f800}-\u{2fa1f}]/u;
//	return charset.test(this);
};

String.prototype.containsCyrilicChar = function() {
    var charset = /[\u0400-\u04FF]*/;
	return charset.test(this);
};


String.prototype.containsJaponeseChar = function() {
    var charset = /[\u3000-\u303f]|[\u3040-\u309f]|[\u30a0-\u30ff]|[\uff00-\uff9f]|[\u4e00-\u9faf]|[\u3400-\u4dbf]/;
	return charset.test(this);
};

String.prototype.containsIndianChar = function() {
	 return this.split("").filter( function(char){ 
        var charCode = char.charCodeAt(); return charCode >= 2309 && charCode <=2361;
      }).length > 0;
};


String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

jQuery.fn.outerHTML = function(s) {
    return s
        ? this.before(s).remove()
        : jQuery("<p>").append(this.eq(0).clone()).html();
};

var WIDTH = 530;
var HEIGHT = 344;

var WIDTH_CONF_SAVE = 400;


var MAX_WIDTH_ICON = 250;
var MAX_HEIGHT_ICON = 165;


var MAX_WIDTH_SHAPE = 500;
var MAX_HEIGHT_SHAPE = 324;


var FONT_SIZE_COMPANY = 62;
var FONT_SIZE_ACCROCHE = 34;

var SPACING_TEXT = 20; /* entre ligne 1 et ligne 2 */
var SPACING_SUB_TEXT = 15;
var PADDING_LINE = 15;

var app = angular.module('editor', ['angularSpectrumColorpicker', 'ngScrollbars']);

window.mobileAndTabletcheck = function() {
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
};

app.config(function (ScrollBarsProvider) {
	// the following settings are defined for all scrollbars unless the
	// scrollbar has local scope configuration
	ScrollBarsProvider.defaults = {
		scrollButtons: {
			scrollAmount: 'auto', // scroll amount when button pressed
			enable: false // enable scrolling buttons by default
		},
		scrollInertia: 100, // adjust however you want
		axis: 'y', // enable 2 axis scrollbars by default,
		theme: 'dark',
		autoHideScrollbar: false
	};
});


function makePath(tag, attrs, html) {
	var el= document.createElementNS('http://www.w3.org/2000/svg', tag);
	for (var k in attrs){
		el.setAttribute(k, attrs[k]);
	}
	if(html.length > 0)
	{ 
		////console.log("el", $(el), html);
		//el.innerHTML = "####" + html;
		el.textContent = html;
		//$(el).html(html);
		
	}
	
	//el.innerHTML = html;
	//else  el.innerHTML = '';
	
	return el; 
	//return $(el);
}

function  cleansvg (input) {
	  var i = input.replace(/width="[0-9]+px"/, 'width="100%"');
	  i = i.replace(/height="[0-9]+px"/, 'height="100%"');
	
	   i = i.replace(/id="g-/g, 'id="engine-');
	   i = i.replace(/#g-/g, '#engine-');

      return i;
}

function makeid (length) {
  var text = "";
  var possible = "abcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < length; i++)
	text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

function rgb2hex(rgb) {
		 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		// //console.log('rgb : ', rgb);
		 return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}
		
function hex(x) {
	var hexDigits = new Array ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 
	return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

function extractColors(svgItem, svg){
	var colors = [];
	var color = svgItem.attr('fill');
	
	if(color){
		if(color == 'none') {
			////console.log('Bug color none: ', color, svg);
		}
		else if(color.substring(0,1) == '#')
		{
			color = color.toLowerCase();
			colors.push(color);
		}
		else 
		{
			var regExp = /\(([^)]+)\)/;
			var matches = regExp.exec(color);
			
			
			var g = svg.find(matches[1]);
			var nodes = g.children();
			angular.forEach(nodes, function(node, key) {
				c = $(node).css('stop-color');
				if(c.substring(0,1) != '#')
				{
					c = rgb2hex(c);
				}
				c = c.toLowerCase();
				colors.push(c);
			});
		}
	}	
	return colors;
}

function buildSvgItem(container, graphics){
	angular.forEach(graphics, function(g, key) {
		
		var item = makePath(g.nodeName, g.attr,'');
		
		if(g.colors.length == 1) item.setAttribute('fill', g.colors[0]);
		else {
			var randomid = makeid(32);
			var index = 'SVGID_' + randomid;
			item.setAttribute('fill', 'url(#' + index +')');
			
			var linear = makePath( 'linearGradient', {id: index, x1:"0%", y1: "0%", x2:"100%", y2:"0%", 'gradientTransform': 'rotate(' + g.angle + ')'}, '');
			angular.forEach(g.colors, function(color, key) {
				var c = makePath( 'stop', {offset: (key* 100) + '%', 'stop-color': color, 'stop-opacity': 1}, '');
				linear.appendChild(c);
			});

			container.appendChild(linear);
		}
		container.appendChild(item);
	});
}

			
createSvgElement = function(svg){
	var graphics = [];
	var formes = svg.children();
	angular.forEach(formes, function(s, key) {
		var nodeName = $(s)[0].nodeName;
		if ( nodeName != 'linearGradient')
		{ 
			var colors = extractColors($(s), svg);
			var cc = angular.copy(colors); 
			
			$(s).removeAttr('fill');
			var attr = $(s).attr();
			var graphic = {'svg':s.outerHTML, colors: cc, 'nodeName': nodeName, 'angle':90,  'attr' : attr, 'innerHTML' : $(s).html()};
			graphics.push(graphic);
		}
	});
	return 	graphics;
}



function getMouseEventCaretRange(evt) {
    var range, x = evt.clientX, y = evt.clientY;
    
        // Try the simple IE way first
        if (document.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToPoint(x, y);
			//console.log(range);
        }
    
    else if (typeof document.createRange != "undefined") {
        // Try Mozilla's rangeOffset and rangeParent properties, which are exactly what we want
        
        if (typeof evt.rangeParent != "undefined") {
            range = document.createRange();
            range.setStart(evt.rangeParent, evt.rangeOffset);
            range.collapse(true);
        }
    
        // Try the standards-based way next
        else if (document.caretPositionFromPoint) {
            var pos = document.caretPositionFromPoint(x, y);
            range = document.createRange();
            range.setStart(pos.offsetNode, pos.offset);
            range.collapse(true);
        }
    
        // Next, the WebKit way
        else if (document.caretRangeFromPoint) {
            range = document.caretRangeFromPoint(x, y);
        }
    }
    
    return range;
}

function selectRange(range) {
    if (range) {
        if (typeof range.select != "undefined") {
            range.select();
        } else if (typeof window.getSelection != "undefined") {
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }
}




app.directive('icheck', function($timeout, $parse) {
    return {
        require: 'ngModel',
        link: function($scope, element, $attrs, ngModel) {
            return $timeout(function() {
                var value = $attrs['value'];
                $scope.$watch($attrs['ngModel'], function(newValue){
                    $(element).iCheck('update');
                })

                $scope.$watch($attrs['ngDisabled'], function(newValue) {
                    $(element).iCheck(newValue ? 'disable':'enable');
                    $(element).iCheck('update');
                })

                return $(element).iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
					increaseArea: '40%' 
                }).on('ifToggled', function(event) {
                    if ($(element).attr('type') === 'checkbox' && $attrs['ngModel']) {
                        $scope.$apply(function() {
                            return ngModel.$setViewValue(event.target.checked);
                        });
                    }
                    if ($(element).attr('type') === 'radio' && $attrs['ngModel']) {
                        return $scope.$apply(function() {
                            return ngModel.$setViewValue(value);
                        });
                    }
                });
            });
        }
    };
})



	

app.directive('selectBox', function($timeout, $parse) {
    return {
        require: 'ngModel',
		
        link: function($scope, element, $attrs, ngModel) {
            return $timeout(function() {
				
				$scope.$eval($attrs['ngChange']);
				 ngModel.$viewChangeListeners.push(function() {
            		$scope.$eval($attrs.ngChange);
        		});
		
                var value = $attrs['value'];
                $scope.$watch($attrs['ngModel'], function(newValue){
					$(element).selectBox('value', newValue);
                })

				
				
  				return $(element).selectBox({
					mobile: true,
					menuTransition:'fade',
					hideOnWindowScroll: 'false',
					menuSpeed: 150
                }).change(function (event) {
						return ngModel.$setViewValue($(this).val());
				});

            });
        }
    };
})


app.directive('ngEnter', function() {
        return function(scope, element, attrs) {
            element.bind("keydown keypress", function(event) {
                if(event.which === 13) {
                    scope.$apply(function(){
                        scope.$eval(attrs.ngEnter, {'event': event});
                    });

                    event.preventDefault();
                }
            });
        };
    });

app.directive('stopEvent', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
            element.bind(attr.stopEvent, function (e) {
                e.stopPropagation();
            });
        }
    };
});





app.directive("ngPreview", function($sce,$compile, $rootScope, $filter, $timeout) {
    return {
			restrict: 'A',
			scope: {
				icon: '=ngModel',
				shapes: '=ngShapes',
				etape: '=ngEtape'
			},
			link: function($scope, $element) {
			var compiled = false;
			var config = $scope.icon;
			
			$scope.findShapeById = function(id){
				for(var i=0;i<$scope.shapes.length;i++){
					var shape = $scope.shapes[i];	
					if(shape.id == id){
						 return shape;
					}
				}
				return false;
			}
			$scope.findLineByType = function(type, texts){
				var textes = [];
				for(var i=0;i<texts.length;i++){
					var text = texts[i];	
					if(text.type == type){
						 textes.push(text);
					}
				}
				if(textes.length == 1) return textes[0];
				else if(textes.length > 1) return textes;
				else return false;
			}
			
		
			$scope.createShape = function($div,shape, max_width, config){

				var ss = $scope.findShapeById(shape.id);
				
				var html = '<g class="custom">' + $(ss.svg).html() + '</g>';
				$div.find('#texts').html($div.find('#texts').html() + html);
				var lastItem = $div.find('#texts').find('.custom:last-child');
				
				if(shape.position == 'top'){
					var left = (WIDTH - max_width) / 2;
					
					if(shape.width == 'auto') var w = max_width;
					else var w = shape.width;
								
					var scale = w / lastItem[0].getBoundingClientRect().width;
					var scaleY = (shape.aspectRatio == true ? scale : 1);
					var left = (WIDTH - w) / 2;
								
					var s = 1;
					var top = config.font.paddingTop - scaleY * lastItem.height() - shape.paddingBottom;
					lastItem.attr('transform', 'translate('+ (left > 0 ? left : 0) +' '+ top+ ') scale(' + scale + ' ' + scaleY+ ')');	
				}
			}
			
			$scope.createTmpShape = function(shape, width, color){

				var ss = $scope.findShapeById(shape.id);
				
				var svg =  $(ss.svg);
				var graphics = createSvgElement(svg);			
				var container = makePath("g",{"class":"custom"},'');
				
				buildSvgItem(container,graphics);
				$('#tmp').empty();
				$('#tmp').append(container);
				
				//var html = '<g class="custom">' + $(ss.svg).html() + '</g>';
				//$('#tmp').html(html);
				var lastItem = $('#tmp').find('.custom');
				
				
				
				shape.x = shape.y = 0;
				shape.width = shape.originalWidth = lastItem[0].getBoundingClientRect().width;
				shape.height = shape.originalHeight = lastItem[0].getBoundingClientRect().height;
				
				if(typeof width != "undefined"){
					width = (shape.w == 'auto') ?  width : shape.w;
					var s = width / shape.width;
					shape.width = width;
					if(shape.aspectRatio == true){
						shape.height = shape.height *s;
					}
				}
				shape.id_categorie = ss.id_categorie;
				shape.symetrieX = typeof shape.symetrieX == 'undefined' ? 1 : shape.symetrieX;
				shape.symetrieY = typeof shape.symetrieY == 'undefined' ? 1 : shape.symetrieY;

				if(typeof color !="undefined") shape.color = color.toLowerCase();
				var html =  ss.svg;
				
				if(color) html =  html.replace(/fill="[^"]+"/g, 'fill="'+ shape.color+'"');
				shape.svg = html;
	
				return lastItem;
			}
			
			
			
			
			
			$scope.createTexts = function($div, config, $parent){
				

				var x = {'firstLine':0,'sndLine':0,'thirdLine':0, 'initial':0};

				var firstLine = $parent.find('.firstLine');
				var sndLine = $parent.find('.sndLine');
				var thirdLine = $parent.find('.thirdLine');
				
				
				firstLine.empty();
				sndLine.empty();
				thirdLine.empty();
				angular.forEach(config.texts, function(t, key) {
					

					if(t.type == 'firstLine') var line = firstLine;
					else if(t.type == 'sndLine') var line = sndLine;
					else  var line = thirdLine;
					
					var html = line.html();
					
					t.letterSpacing = typeof t.letterSpacing == 'undefined' ? 0 : t.letterSpacing;
					t.color = t.color.toLowerCase();
					//html += '<text class="c-text-' + key +'" dominant-baseline="auto" alignment-baseline="auto" font-family="'+ t.family + '" font-size="'+ t.size + 'px" fill="'+ t.color + '" letter-spacing="'+ t.letterSpacing+'"  xml:space="preserve">'+t.text+'</text>'; 
					
					var id = makeid(32);
					t.randomid = id;
					var item = makePath( 'text', {'id':'item-'+id, 'key' : key, 'dominant-baseline':'auto','alignment-baseline':'auto','font-family': t.family,'font-size':t.size+'px','fill': t.color, 'letter-spacing':'0','xml:space':'preserve','class':''}, t.text);				
					item.setAttribute('id', 'item-'+id);
					line.append(item);
					
					//var boundRect = item.getBoundingClientRect();
					
					
					var lastItem = line.find('#item-' + id);
					
					var bbox = lastItem[0].getBBox(); //{y:0}; //
					
					if( t.family == 'this'){
						var boundRect = item.getBoundingClientRect();
						//console.log("text", t.text);
						//console.log('boundRect', boundRect);
						//console.log('bbox', bbox);
					}
					
					////console.log("bbox", bbox);
					
					t.x = x[t.type];
					t.bbox = bbox;
					t.y = 0;
					t.ratio = 1;
					t.font = config.font;
					t.size = t.size;
					t.originalWidth = t.width = bbox.width;
					t.originalHeight =  t.height = bbox.height;
					lastItem.attr('transform', 'translate('+ t.x +' '+ -bbox.y +')');
					x[t.type] =  bbox.width + 20;
				});
				
				//return;
			
				if(config.type =='conf'){
					//console.log("config.type =='conf'");
					WIDTH_CONF = WIDTH_CONF_L2 = WIDTH_CONF_SAVE;
					if (typeof config.conf.width != 'undefined'){
							WIDTH_CONF = config.conf.width;
					}
					var WIDTH_CONF_L2 = WIDTH_CONF;
					if (typeof config.conf.width_l2 != 'undefined'){
						WIDTH_CONF_L2 = config.conf.width_l2;
					}
					var s = s2 = 1;
					
					var ll = $scope.findLineByType('firstLine',config.texts);
	
					var l0 = Array.isArray(ll) ? ll[0] : ll; //ll;//ll.length == 1 ? ll : ll[0];
					var l1 = typeof ll[1] != "undefined" ? ll[1] : false;
					var l2 = $scope.findLineByType('sndLine',config.texts);;
					var l3 = $scope.findLineByType('thirdLine',config.texts);;
					var l4 = $scope.findLineByType('initial',config.texts);;
					
					
					
					var inside = false;
					var inside_width = 0;
					var l1_width = firstLine[0].getBoundingClientRect().width;//firstLine.width();
					
					if(typeof config.conf.shapes.inside != "undefined"){
						var inside = config.conf.shapes.inside;
						var tmp = $scope.createTmpShape(inside,500);
						
						inside.height = inside.h * (firstLine[0].getBoundingClientRect().height - config.font.paddingTop -  config.font.paddingBottom); 
						inside.width = (tmp[0].getBoundingClientRect().width / tmp[0].getBoundingClientRect().width) * inside.height; 
						
						inside_width = inside.paddingLeft + inside.paddingRight + inside.width;
						
						l1_width = l0.width + l1.width + inside_width;
						inside.x =  l0.width + inside.paddingLeft;
						l1.x = l0.x + l0.width + inside_width; 
						
					}
			

					if(l1_width > WIDTH_CONF) s = WIDTH_CONF / (l1_width);	
					
					l0.ratio  = s;				
					if(sndLine[0].getBoundingClientRect().width > WIDTH_CONF_L2)	s2 = WIDTH_CONF_L2 / sndLine[0].getBoundingClientRect().width;
					
					l0.width = l0.width * s;
					l0.height = l0.height * s;
					
					
					if(l1){
						l1.width = l1.width * s;
						l1.height = l1.height * s;
						l1.ratio = s;
					}
					l2.width = sndLine[0].getBoundingClientRect().width * s2;
					l2.height = sndLine[0].getBoundingClientRect().height * s2;
					l2.ratio = s2;
					
					l3.width = thirdLine[0].getBoundingClientRect().width * s2;
					l3.height = thirdLine[0].getBoundingClientRect().height * s2;
					l3.ratio = s2;
					
					if(inside){
						inside.width = inside.width * s;
						inside.height = inside.height * s;
					}
	
					if(config.conf.align == 'center')
					{
						var left =  (WIDTH - l1_width *s) / 2;
						l0.x = left;
						l0.y = 0;
						
						if(l1){
							l1.x = l0.x + l0.width + 20 * s;
						}
						
						var left = (WIDTH - l2.width) / 2;
						var top = l0.height - config.font.paddingBottom * s - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_TEXT;
						l2.x = left;
						l2.y = top;
 
						var left = (WIDTH - l3.width) / 2;
						var top = top + l2.height - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 - config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_SUB_TEXT;
						l3.x = left;
						l3.y = top;
					}
					else{
						var max_width = l1_width;
						if(l2) max_width = Math.max(l2.width, max_width);
						if(l3)  max_width = Math.max(l3.width, max_width);
						
						
						var left = (WIDTH - max_width) / 2;
						l0.x = left;
						l0.y = 0;
						
						if(l1){
							l1.x = l0.x + l0.width + 20 * s;
						}
						var top = l0.height - config.font.paddingBottom * s - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_TEXT;
						l2.x = left;
						l2.y = top;
						
						var top = top + l2.height - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 - config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_SUB_TEXT;
						l3.x = left;
						l3.y = top;
					} 
					
					var max_width = l1_width *s;
					if(l2) max_width = Math.max(l2.width, max_width);
					if(l3)  max_width = Math.max(l3.width, max_width);
					
					////console.log("max_width",config.shape, max_width);
					var shapes = [];
					angular.forEach(config.conf.shapes, function(shape, key){
						
						var add = true;
						var color = (typeof shape.color == "undefined") ? config.color : shape.color;
						var m = max_width;//typeof shape.width != 'undefined' ? shape.width : max_width;
						
						if(key != 'insides') var tmp = $scope.createTmpShape(shape, m, color);

						if(key == 'top'){
							shape.x = (WIDTH - shape.width) / 2;
							shape.y = shape.paddingTop * s;

							var top = (shape.height - config.font.paddingTop * s) + shape.paddingBottom *s + shape.paddingTop *s;
							$scope.deplaceShape([l0,l1,l2,l3],0, top);	
							$scope.deplaceShape(shapes,0, top);	
						} 
						else if(key == 'middle'){
							
							if(l2 == false) add = false;
							else{
								shape.x = (WIDTH - shape.width) / 2;
								shape.y = l0.y + l0.height - config.font.paddingBottom * s + shape.paddingTop;
								$scope.deplaceShape([l2,l3],0, (shape.height + shape.paddingTop + shape.paddingBottom));	
							}
						}
						else if(key == 'bottom'){
							shape.x = (WIDTH - shape.width) / 2;
							var l = l3 ? l3 : l2 ? l2 : l0;
							
							var p = (l3 || l2) ? (config.font.paddingBottom  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2) : config.font.paddingBottom  * s;
							shape.y = l.y + l.height - p + shape.paddingTop ;
							//$scope.deplaceShape([l2,l3],0, (shape.height - config.font.paddingTop) + shape.paddingTop);	
						}
						else if(key == 'l1-left'){
							
							shape.width = shape.width * s;
							shape.height = shape.height * s;
							
							shape.x = l0.x - shape.width - shape.paddingRight * s;
							shape.y = l0.y + (  l0.height - (shape.height + config.font.paddingBottom * s - config.font.paddingTop *s)) /2;
							
						}
						else if(key == 'l1-right'){
							shape.width = shape.width * s;
							shape.height = shape.height * s;
							var l = l1 ? l1 : l0;
							shape.x = l.x + l.width + shape.paddingLeft *s;
							shape.y = l0.y + ( l0.height - (shape.height + config.font.paddingBottom * s - config.font.paddingTop *s)) /2;
							
						}
						else if(key == 'l2-left'){
							if(l2 == false) add = false;
							else{
								shape.width = shape.width * s2;
								shape.height = shape.height * s2;
								
								shape.x = l2.x - shape.width - shape.paddingRight *s2;
								shape.y =  l2.y + ( l2.height - (shape.height + config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 - config.font.paddingTop  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2)) /2;
							}
							
						}
						else if(key == 'l2-right'){
							if(l2 == false) add = false;
							else{
								shape.width = shape.width * s2;
								shape.height = shape.height * s2;
								shape.x = l2.x + l2.width + shape.paddingLeft *s2;
								shape.y =  l2.y + (l2.height - (shape.height + config.font.paddingBottom  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 - config.font.paddingTop  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2)) /2;
							}
							
						}
						else if(key == 'top-left'){
							var w = l1_width *s;
							//if(w == config.conf.width)
							{
							//shape.x = l0.x - shape.width - shape.paddingRight * s;
								$scope.deplaceShape([l0,l1,l2,l3],0, shape.height / 2);	
								$scope.deplaceShape(shapes,0,  shape.height / 2);	
								
								shape.x =( WIDTH - max_width) / 2  + shape.paddingRight - shape.width;
								shape.y =  l0.y + config.font.paddingTop  * s - shape.height + shape.paddingTop; 
								//( l2.height - (shape.height + config.font.paddingBottom  * s - config.font.paddingTop  *  s)) /2;
								
								
							}
							//else  add=false;
							
							
						}
						else if(key == 'bottom-right'){
							var w = l1_width *s;
							//if(w == config.conf.width)
							{
								
								shape.x = WIDTH - ( WIDTH - max_width) / 2  + shape.paddingLeft;
								var l = l3 ? l3 : l2 ? l2 : l0;
								var p = (l3 || l2) ? (config.font.paddingBottom  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2) : config.font.paddingBottom  * s;
								shape.y =  l.y + l.height -  p   + shape.paddingBottom;
							}
							//else  add=false;
							
						}
						else if(key == 'l0_over'){

							l0.color = shape.txt_color;	
							shape.width = l0.width + shape.paddingLeft + shape.paddingRight;
							shape.height = l0.height -  config.font.paddingTop  * s -  config.font.paddingBottom  * s + shape.paddingBottom + shape.paddingTop;
							shape.x = l0.x - shape.paddingLeft;
							shape.y = l0.y - shape.paddingTop + config.font.paddingTop  * s;
							$scope.deplaceShape([l2,l3],0, shape.paddingBottom);	
						}
						else if(key == 'l1_over'){
							if(!l1) add=false;
							else{
								//$scope.deplaceShape([l2,l3],0, shape.paddingTop);	
								//$scope.deplaceShape([l3],0, shape.paddingBottom);	
								
								l1.color = shape.txt_color;	
								shape.width = l1.width + shape.paddingLeft + shape.paddingRight;
								shape.height = l1.height -  config.font.paddingTop  * s -  config.font.paddingBottom  * s + shape.paddingBottom + shape.paddingTop;
								shape.x = l1.x - shape.paddingLeft;
								shape.y = l1.y - shape.paddingTop + config.font.paddingTop  * s;
							}
						}
						else if(key == 'l2_over'){
							if(l2 == false) add = false;
							else{
								$scope.deplaceShape([l2,l3],0, shape.paddingTop);	
								$scope.deplaceShape([l3],0, shape.paddingBottom);	
								l2.color = shape.txt_color;	
								shape.width = l2.width + shape.paddingLeft + shape.paddingRight;
								shape.height = l2.height -  config.font.paddingTop  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 -  config.font.paddingBottom  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + shape.paddingBottom + shape.paddingTop;
								shape.x = l2.x - shape.paddingLeft;
								shape.y = l2.y - shape.paddingTop + config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2;
							}
						}
						else if(key == "inside"){
							shape.height = shape.h * (l0.height - config.font.paddingTop*s -  config.font.paddingBottom *s); 
							shape.width = (tmp[0].getBoundingClientRect().width / tmp[0].getBoundingClientRect().height) * shape.height; 
						
							shape.x = l0.x + l0.width + shape.paddingLeft *s;
							if(shape.align == "bottom") shape.y = l0.y + ( (l0.height 	-  config.font.paddingBottom *s) - shape.height);
							else{
								shape.y = l0.y + ( l0.height - shape.height + config.font.paddingTop *s - config.font.paddingBottom *s) /2;
							}
							//else shape.y = l0.y;
							l1.x = shape.x + shape.width + shape.paddingRight *s;
						}
						else if (key == 'left'){
							
							var p = (l3 || l2) ? (config.font.paddingBottom  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2) : config.font.paddingBottom  * s;
							var l = l3 ? l3 : l2 ? l2 : l0;
							txt_height = (l.y - l0.y + l.height - p -  config.font.paddingTop  * s);
							shape.height = txt_height * 1.3;
							var r = shape.height / shape.originalHeight;
							shape.width = shape.originalWidth * r;
							
							shape.x = (WIDTH - max_width) / 2  - shape.paddingRight *s - shape.width;
							shape.y = l0.y +  config.font.paddingTop  * s - (shape.height - txt_height) /2;
							
							var decX =  shape.paddingRight *s + shape.width
							//$scope.deplaceShape([l0,l1,l2,l3],decX, 0);
							//$scope.deplaceShape(shapes,decX, 0);
							
						}
						else if (key == 'right'){
		
							shape.x = WIDTH - ( WIDTH - max_width) / 2  + shape.paddingLeft *s;
							var p = (l3 || l2) ? (config.font.paddingBottom  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2) : config.font.paddingBottom  * s;
							
							var l = l3 ? l3 : l2 ? l2 : l0;
							var txt_height = (l.y - l0.y + l.height - p -  config.font.paddingTop *s);
							shape.height = txt_height * 1.3;
		
							var r = shape.height / shape.originalHeight ;
							shape.width = shape.originalWidth * r;
							shape.y = l0.y +  config.font.paddingTop  * s - (shape.height - txt_height) /2;
							
						}
						
						else if(key == "initial"){
							///shape.height = shape.h * (l0.height - config.font.paddingTop*s -  config.font.paddingBottom *s); 
							//shape.width = (tmp.width() / tmp.height()) * shape.height; 
							//shape.height = 121;//l2.y - l0.y + l2.y;//-  $div.find('#texts').height(); //l.y - l0.y + l.height - p -  config.font.paddingTop  * s;
							
							var p = (l2) ? (config.font.paddingBottom  * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2) : config.font.paddingBottom  * s;
							var l = l2 ? l2 : l0;
							
							var txt_height = (l.y - l0.y + l.height - p -  config.font.paddingTop  * s);
							var h = (l.y - l0.y + l.height - p -  config.font.paddingTop  * s) * shape.h;
							shape.height = (!l2 ? h * 2.1 : h);

							shape.y = 0;//l0.y +  config.font.paddingTop  * s
							var r = shape.height / shape.originalHeight;
							shape.width = shape.originalWidth * r;
	
							
							var decY = (shape.height - txt_height ) / 2 - config.font.paddingTop  * s;
							var totalWidth = shape.width + shape.paddingRight + max_width;
							
							var decX = (WIDTH - totalWidth) /2;
							
							var w = -l0.x + shape.width + shape.paddingRight;
							$scope.deplaceShape([l0,l1,l2,l3], w + decX, decY);
							$scope.deplaceShape(shapes, w + decX, decY);	
							shape.x = l0.x - shape.width - shape.paddingRight;
							
							l4.color = "#ffffff";
							var w = shape.r * shape.height;
							var r = w / l4.height ;
							l4.height = l4.height * r;
							l4.width = l4.width * r;
							l4.ratio = r;
							l4.x = shape.x + (shape.width - l4.width + config.font.paddingRight * r)/2;
							l4.y = shape.y + (shape.height - l4.height - config.font.paddingTop * r + config.font.paddingBottom * r ) / 2;
							if(typeof shape.margin_top != "undefined") l4.y += shape.margin_top * r;
							
						}
						if(add == true) shapes.push(shape);
						
					});
					
					
					var html ='';
					angular.forEach(shapes, function(shape, key){
						var x = (shape.symetrieX == 1 ? shape.x : shape.x + shape.width);
						var y = shape.y;
					//	var h = '<g class="custom" name="'+key+'" transform="translate('+(shape.symetrieX == 1 ? shape.x : shape.x + shape.width)+' '+(shape.symetrieY == 1 ? shape.y : shape.y + shape.height)+') scale('+(shape.width / shape.originalWidth * shape.symetrieX)+' '+(shape.height / shape.originalHeight * shape.symetrieY)+')">' + shape.svg + '</g>';
						
						var svg = $(shape.svg);
						var graphics = createSvgElement(svg);			
						var container = makePath("g",{"class":"custom","name":key, "transform":'translate('+(shape.symetrieX == 1 ? shape.x : shape.x + shape.width)+' '+(shape.symetrieY == 1 ? shape.y : shape.y + shape.height)+') scale('+(shape.width / shape.originalWidth * shape.symetrieX)+' '+(shape.height / shape.originalHeight * shape.symetrieY)+')'},'');
						buildSvgItem(container,graphics);
						$div.find('.formes').append(container);
						
						//$(h).children().attr('fill', shape.color);
						////console.log($(h).html());
						//html += h;
					});
					//$div.find('.formes').html(html);
					
					
					angular.forEach(config.texts, function(t, key) {
						var tt = $('#item-' + t.randomid);
						//$div.find('#texts').find(".c-text-" + key).attr('transform', 'translate('+ t.x +' '+ (t.y - t.bbox.y * t.ratio) + ') scale(' + t.ratio + ')');
						//$div.find('#texts').find(".c-text-" + key).attr('fill', t.color);
						
						tt.attr('transform', 'translate('+ t.x +' '+ (t.y - t.bbox.y * t.ratio) + ') scale(' + t.ratio + ')');
						tt.attr('fill', t.color);
					});
					
					config.lignes = shapes;
					firstLine.attr('transform', '');
					sndLine.attr('transform', '');
					thirdLine.attr('transform', '');
					
				}


				

				if(config.forme){

					var formes = $div.find('.formes');

					/*var inlineShape = $div.find('.inline-shape');
					var html = formes.html();
					var svg = $(config.forme.svg);
					html += '<g class="forme">' + svg.html() + '</g>';*/

				//	formes.html(html);
						
					var svg = $(config.forme.svg);
					var graphics = createSvgElement(svg);			
					var container = makePath("g",{"class":"forme"},'');
					buildSvgItem(container,graphics);
					formes.append(container);
					
					
					var lastItem = $div.find('.forme:last-child');
					lastItem.children().attr('fill', config.forme.color);
					config.forme.originalWidth = lastItem[0].getBoundingClientRect().width;
					config.forme.originalHeight = lastItem[0].getBoundingClientRect().height;
					
					var ll = $scope.findLineByType('firstLine',config.texts);;
					var l0 = Array.isArray(ll) ? ll[0] : ll; //ll;//ll.length == 1 ? ll : ll[0];
					var l1 = typeof ll[1] != "undefined" ? ll[1] : false;
					var l2 = $scope.findLineByType('sndLine',config.texts);;
					var l3 = $scope.findLineByType('thirdLine',config.texts);;
					var l4 = $scope.findLineByType('initial',config.texts);;
					
					/* Mise a l'echelle de la shape */
					if( (config.forme.originalWidth / config.forme.originalHeight) < (MAX_WIDTH_SHAPE / MAX_HEIGHT_SHAPE) ){
						var r = MAX_HEIGHT_SHAPE / config.forme.originalHeight;
						config.forme.height = MAX_HEIGHT_SHAPE;
						config.forme.width = config.forme.originalWidth * r;
					}
					else{
						var r = MAX_WIDTH_SHAPE / config.forme.originalWidth;
						config.forme.width = MAX_WIDTH_SHAPE;
						config.forme.height = config.forme.originalHeight * r;
					}
					
					if(config.forme.position == 'over'){
						//var r = (3.30 * totalHeight) / lastItem.height();
						lastItem.attr('transform', 'scale('+ r + ')');
						
						
						var s = s2 = 1;
						if(firstLine[0].getBoundingClientRect().width > WIDTH) s = WIDTH / firstLine[0].getBoundingClientRect().width;					
						if(sndLine[0].getBoundingClientRect().width > WIDTH)	s2 = WIDTH / sndLine[0].getBoundingClientRect().width;
						

						var left1 = (WIDTH - firstLine[0].getBoundingClientRect().width * s) / 2;
						var top1 = 0;
						firstLine.attr('transform', 'translate('+ (left1 > 0 ? left1 : 0) +' '+ top1+') scale(' + s+ ')');

						//$scope.deplaceShape(config.texts,left1,0, 'firstLine');
						if(l0){
							l0.x = left1;
							l0.y = 0;
							l0.width = l0.originalWidth * s;
							l0.height = l0.originalHeight * s;
							l0.ratio = s;
						}

						var left2 = (WIDTH - sndLine[0].getBoundingClientRect().width * s2) / 2;
						var top2 = firstLine[0].getBoundingClientRect().height - config.font.paddingBottom * s - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_TEXT;
						sndLine.attr('transform', 'translate('+ (left2 > 0 ? left2 : 0) +' ' + top2 + ')  scale(' + s2+ ')');
						
						
						if(l2){
							l2.x = left2;
							l2.y = top2;
							l2.ratio = s2;
							l2.width = l2.originalWidth * s2;;
							l2.height =  l2.originalHeight * s2;;
						}

						var ll = l2 ? l2 : l0;
						p = l2 ? config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 : config.font.paddingBottom * s;
						var real_height = (ll.y - l0.y + ll.height - p - config.font.paddingTop * s); 
						var start = (MAX_HEIGHT_SHAPE - real_height - ( config.font.paddingTop * s + p) ) / 2   ;
						
						$scope.deplaceShape(config.texts,0,start);
						firstLine.attr('transform', 'translate('+ (left1 > 0 ? left1 : 0) +' '+ (top1 + start) +') scale(' + s+ ')');
						sndLine.attr('transform', 'translate('+ (left2 > 0 ? left2 : 0) +' ' + (top2 + start) + ')  scale(' + s2+ ')');
											

						var left = ( WIDTH - lastItem[0].getBoundingClientRect().width ) / 2;
						var top = 0;

						config.forme.x = left;
						config.forme.y = top;
						lastItem.attr('transform', 'translate('+ config.forme.x +' '+ config.forme.y+') scale('+ r + ')');

					
					}
					else{
						lastItem.attr('transform', 'scale('+ r + ')');

						var left = (WIDTH - lastItem[0].getBoundingClientRect().width) / 2;
						var top = 0;//logo.height() + 20 - config.font.paddingTop * s;
					
						$div.find('.main').attr('transform', 'translate('+ (left > 0 ? left : 0) +' '+ top +')');
						config.forme.x = 0;//(left > 0 ? left : 0);
						config.forme.y = 0;
						config.forme.aspectRatio = true;
						var maxTextWidth = config.forme.width * config.shape.pourcent;
						
						var s = maxTextWidth / firstLine[0].getBoundingClientRect().width;					
						var s2 = maxTextWidth / sndLine[0].getBoundingClientRect().width;

						
						var leftLine1 = config.originalText.length == 0 ? 0 : (config.forme.width - firstLine[0].getBoundingClientRect().width * s) / 2;
						var topLine1 = 0;
						firstLine.attr('transform', 'translate('+ (leftLine1 > 0 ? leftLine1 : 0) +' '+ topLine1 +') scale(' + s+ ')');

						var l1 = $scope.findLineByType('firstLine',config.texts);
						if(l1){
							l1.x = leftLine1;
							l1.y = topLine1;
							l1.width = firstLine[0].getBoundingClientRect().width;
							l1.height = firstLine[0].getBoundingClientRect().height;
							l1.ratio = s;
							
							var paddingTop = config.font.paddingTop *s;
						}
						else{
							 var paddingTop = config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2;
						}
						
						if(config.phraseAccroche.length > 0)
						{
							var leftLine2 = (config.forme.width - sndLine[0].getBoundingClientRect().width * s2) / 2;
							var topLine2 = firstLine[0].getBoundingClientRect().height - config.font.paddingBottom * s - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_TEXT;
						
							sndLine.attr('transform', 'translate('+ (leftLine2 > 0 ? leftLine2 : 0) +' ' + topLine2 + ')  scale(' + s2+ ')');
							var l2 = $scope.findLineByType('sndLine',config.texts);
							if(l2){
								l2.x = leftLine2;
								l2.y = topLine2;
								l2.width = sndLine[0].getBoundingClientRect().width;
								l2.height = sndLine[0].getBoundingClientRect().height
								l2.ratio = s2;
							}	
							
							var leftLine3 = (config.forme.width - thirdLine[0].getBoundingClientRect().width * s2) / 2;
							var topLine3 = topLine2 + sndLine[0].getBoundingClientRect().height - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 - config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2  + SPACING_SUB_TEXT;

							thirdLine.attr('transform', 'translate('+ (leftLine3 > 0 ? leftLine3 : 0) +' ' + topLine3 + ')  scale(' + s2+ ')');
							var l3 = $scope.findLineByType('thirdLine',config.texts);
							if(l3){
								l3.x = leftLine3;
								l3.y = topLine3;
								l3.width = thirdLine[0].getBoundingClientRect().width;
								l3.height = thirdLine[0].getBoundingClientRect().height;
								l3.ratio = s2;
							}	
							var paddingBottom = config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY);
						}
						else{
							 paddingBottom = config.font.paddingBottom;
						}
											
						
						if(config.shape.config){
	
							var obj = angular.fromJson(config.shape.config);
							angular.forEach(obj.shapes, function(sh, key) {
								
	
								/*var ss = $scope.findShapeById(sh.id);
								var html = '<g class="custom">' + $(ss.svg).html() + '</g>';
								
								$div.find('#texts').html($div.find('#texts').html() + html);
								var lastItem = $div.find('.custom:last-child');
								*/
								
								var ss = $scope.findShapeById(sh.id);
								var svg = $(ss.svg);
								var graphics =createSvgElement(svg);			
								var container = makePath("g",{"class":"custom"},'');
								buildSvgItem(container,graphics);
								$div.find('#texts').append(container);
								var lastItem = $div.find('.custom:last-child');
								
								var ligne = {};
								
								ligne.originalWidth = lastItem[0].getBoundingClientRect().width;
								ligne.originalHeight = lastItem[0].getBoundingClientRect().height;
								ligne.x = 0;
								ligne.y = 0;
								ligne.zindex = 100;
								
								var scale = 1;
								
								if(sh.width == 'auto') var w = maxTextWidth;
								else var w = sh.width;
								
								var scale = w / lastItem[0].getBoundingClientRect().width;
								var scaleY = (sh.aspectRatio == true ? scale : 1);
								var left = (config.forme.width - w) / 2;
								
		
								
								lastItem.attr('transform', 'scale('+ scale + ' ' + scaleY +') translate('+ (left / scale) +' 0)');
								lastItem.children().attr('fill', config.color);
								
								ligne.x = left;
								
								ligne.y = 0;
								if(sh.position == 'top'){
									var top = lastItem[0].getBoundingClientRect().height - config.font.paddingTop * s + sh.paddingBottom;
									//(lastItem.height() - config.font.paddingTop + 10);
									$div.find('.firstLine').attr('transform', 'translate('+ (leftLine1 > 0 ? leftLine1 : 0) +' '+ (topLine1 + top ) +') scale(' + s + ')');
									l1.y = topLine1 + top;
									$div.find('.sndLine').attr('transform', 'translate('+ (leftLine2 > 0 ? leftLine2 : 0) +' '+ (topLine2 + top  ) +') scale(' + s2 + ')');
									if(l2) l2.y = topLine2 + top;
									$div.find('.thirdLine').attr('transform', 'translate('+ (leftLine3 > 0 ? leftLine3 : 0) +' '+ (topLine3 + top ) +') scale(' + s2 + ')');
									if(l3) l3.y = topLine3 + top;
									paddingTop = 0;
									
								}
								else if(sh.position == 'middle'){
									
									//(lastItem.height() - config.font.paddingTop + 10);
									//$div.find('.firstLine').attr('transform', 'translate('+ (leftLine1 > 0 ? leftLine1 : 0) +' '+ top +') scale(' + s + ')');
									var fl = $div.find('.firstLine');
									
									var t = fl[0].getBoundingClientRect().height - config.font.paddingBottom * s +  sh.paddingTop;; 
									
									ligne.x = left;
									ligne.y = t;
									
									lastItem.attr('transform', 'scale('+ scale + ' ' + scaleY +') translate('+ (left / scale) +' '+ (t / scaleY) +')');
									
									var top = t + lastItem[0].getBoundingClientRect().height - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 +  sh.paddingBottom;;
									$div.find('.sndLine').attr('transform', 'translate('+ (leftLine2 > 0 ? leftLine2 : 0) +' '+ (top) +') scale(' + s2 + ')');
									if(l2) l2.y = top;
									
									var sl = $div.find('.sndLine');
									var top = top + sl[0].getBoundingClientRect().height - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 - config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_SUB_TEXT;
									$div.find('.thirdLine').attr('transform', 'translate('+ (leftLine3 > 0 ? leftLine3 : 0) +' '+ (top) +') scale(' + s2 + ')');
									if(l3) l3.y = top;
									
								}
								else if(sh.position == 'bottom'){
									
									var ttt = $div.find('#texts');
									if(config.phraseAccroche.length > 0) var t = ttt[0].getBoundingClientRect().height - config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + sh.paddingTop;
									else  var t =  ttt[0].getBoundingClientRect().height - config.font.paddingBottom * s +  sh.paddingTop;
									
									lastItem.attr('transform', 'scale('+ scale + ' ' + scaleY +') translate('+ (left / scale) +' '+ (t / scaleY) +')');
									ligne.x = left;
									ligne.y = t ;
									paddingBottom = 0;

								}
								
								ligne.width = lastItem[0].getBoundingClientRect().width;
								ligne.height = lastItem[0].getBoundingClientRect().height;
								
								ligne.id = Math.floor(Math.random() *200) + 50;
								ligne.shape_id=sh.id;
								ligne.id_categorie = ss.id_categorie;
								ligne.graphics =[];
								ligne.type = 'ligne';
								ligne.colors = [];
								ligne.rotate =0;
								ligne.color = config.color;
								ligne.svg = ss.svg; 
								ligne.aspectRatio = ss.aspectRatio;
								
								
								config.lignes.push(angular.copy(ligne));

							});
						}
						
						var left = 0;
		
						var top = (config.forme.height - $div.find('.inline-shape')[0].getBoundingClientRect().height - paddingTop + paddingBottom ) / 2;
						//top = top - (paddingTop - paddingBottom) / 2;
						
						
						////console.log('pt',paddingTop, 'pb',paddingBottom,'fh', config.forme.height,'h', $div.find('.inline-shape').height(), 'top', top); 
						
						$div.find('.inline-shape').attr('transform', 'translate('+ (left > 0 ? left : 0) +' '+ top +')');								
						$scope.deplaceShape(config.texts, left,top);
						$scope.deplaceShape(config.details, left,top);
						$scope.deplaceShape([config.picto], left,top);
						$scope.deplaceShape(config.lignes, left,top);
					}

				}
				if(config.logo){
					

					var logo = $div.find('.logo-ctn');
					logo.empty();
					
					
					var html = logo.html();
					
					var svg = $(config.logo.svg);
					var graphics = createSvgElement(svg);			
					var container = makePath("g",{"class":"logo"},'');
					var id = makeid(32);
					container.setAttribute('id', 'item-'+ id);
					
					
					buildSvgItem(container,graphics);
					
					logo.append(container);
					
					
					var boundRect = container.getBoundingClientRect();

					var lastItem = logo.find('#item-'+ id);

					config.logo.originalWidth = boundRect.width; //lastItem.width();
					config.logo.originalHeight = boundRect.height; //lastItem.height();

					
					var ww = (typeof svg.attr('width') != 'undefined') ?  svg.attr('width').replace('px', ''): false;
					var hh = (typeof svg.attr('height') != 'undefined') ?  svg.attr('height').replace('px', ''): false;
					if(ww === false|| hh === false){
					//	//console.log(config.logo.id, ' has no property height or width');
					}
					else if(( Math.abs(config.logo.originalWidth - ww) > 4) || ( Math.abs(config.logo.originalHeight - hh)) > 4){
					//	//console.log('icon ', config.logo.id, ' - ', config.logo.name, ' smell bad',lastItem.height(),  hh, lastItem.outerHeight());	
					}

					
					
					if( (config.logo.originalWidth / config.logo.originalHeight) < (MAX_WIDTH_ICON / MAX_HEIGHT_ICON) ){
						config.logo.height = MAX_HEIGHT_ICON;
						var r = MAX_HEIGHT_ICON / config.logo.originalHeight;
						config.logo.width = config.logo.originalWidth * r;
					}
					else{
						config.logo.width = MAX_WIDTH_ICON;
						var r = MAX_WIDTH_ICON / config.logo.originalWidth;
						config.logo.height = config.logo.originalHeight * r;
					}

						
					var l1 = $scope.findLineByType('firstLine',config.texts);
					var l2 = $scope.findLineByType('sndLine',config.texts);
					var l3 = $scope.findLineByType('thirdLine',config.texts);
					
					//config.align = 'left';
					if(config.align == 'top')
					{
						
						var s = s2 = 1;
						firstLineWidth =  firstLine[0].getBoundingClientRect().width;
						sndLineWidth =  sndLine[0].getBoundingClientRect().width;
						
						if(firstLineWidth > WIDTH) s = WIDTH / firstLineWidth;					
						if(sndLineWidth > WIDTH)	s2 = WIDTH / sndLineWidth;
						
						
						lastItem.attr('transform', 'scale('+ r + ')');	
						
						var left = (lastItem[0].getBoundingClientRect().width - WIDTH) / 2;
						var top = lastItem[0].getBoundingClientRect().height + 25 - config.font.paddingTop * s;
					
						$div.find('.main').attr('transform', 'translate('+ (left > 0 ? left : 0) +' '+ top +')');
						config.logo.x = (left < 0 ? -left : 0 );
						config.logo.y = 0;
						lastItem.attr('transform', 'translate('+ config.logo.x +' '+ config.logo.y+') scale('+ r + ')');


						var left = (WIDTH - firstLineWidth * s) / 2;
						
						//var boundRect = firstLine[0].getBoundingClientRect().width;
					
						////console.log('LEFT', WIDTH, firstLine.width());
						
						firstLine.attr('transform', 'translate('+ (left > 0 ? left : 0) +' 0) scale(' + s+ ')');
						
						if(config.bicolor){
							
							l1[0].width = l1[0].width * s;
							l1[0].height = l1[0].height * s;
							
							l1[1].width = l1[1].width * s;
							l1[1].height = l1[1].height * s;
							
							l1[1].x =  l1[0].width + 20 * s;
						}
						if(l1)
						{
							$scope.deplaceShape(config.texts,left,0, 'firstLine');
						}
						//else if(l1) l1.x = left;
						
						//$scope.deplaceShape(config.texts,left,0, 'firstLine');	


							
						var left = (WIDTH - sndLine[0].getBoundingClientRect().width * s2) / 2;
						var top = firstLine[0].getBoundingClientRect().height  - config.font.paddingBottom * s - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_TEXT;
						 
						sndLine.attr('transform', 'translate('+ (left > 0 ? left : 0) +' ' + top + ')  scale(' + s2+ ')');
						$scope.deplaceShape(config.texts,left,top, 'sndLine');	
						if(l2){
							l2.x = left;
							l2.y = top;
						}
						
						var left = (WIDTH - thirdLine[0].getBoundingClientRect().width * s2) / 2;
						var top = top + sndLine[0].getBoundingClientRect().height - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 - config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_SUB_TEXT;
						 
						thirdLine.attr('transform', 'translate('+ (left > 0 ? left : 0) +' ' + top + ')  scale(' + s2+ ')');
						if(l3){
							l3.x = left;
							l3.y = top;
						}
						
						/* on decal les text */
						
						var left = (lastItem[0].getBoundingClientRect().width - WIDTH) / 2;
						var top = lastItem[0].getBoundingClientRect().height  + 25 - config.font.paddingTop * s;
						$scope.deplaceShape(config.texts, (left > 0 ? left : 0),top);
						
					}
					else if(config.align == 'left'){
						
						lastItem.attr('transform', 'scale('+ r + ')');	
						
						var s = s2 = 1;
						
						/*
						 sndLine[0].getBoundingClientRect().width
						 
					   firstLine[0].getBoundingClientRect().width*/
						if(firstLine[0].getBoundingClientRect().width > (WIDTH - lastItem[0].getBoundingClientRect().width - 20) ) s = (WIDTH - lastItem[0].getBoundingClientRect().width - 20) / firstLine[0].getBoundingClientRect().width;					
						if(sndLine[0].getBoundingClientRect().width > (WIDTH  - lastItem[0].getBoundingClientRect().width - 20))	s2 = (WIDTH - lastItem[0].getBoundingClientRect().width - 20) / sndLine[0].getBoundingClientRect().width;
						
						firstLine.attr('transform', 'scale(' + s+ ')');
						var left = 0;//(WIDTH - sndLine.width() * s2) / 2;
						var top = firstLine[0].getBoundingClientRect().height - config.font.paddingBottom * s - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_TEXT;
						sndLine.attr('transform', 'translate('+ left +' ' + top + ')  scale(' + s2+ ')');	
						
						
						if(config.bicolor){

							l1[0].width = l1[0].width * s;
							l1[0].height = l1[0].height * s;
							
							l1[1].width = l1[1].width * s;
							l1[1].height = l1[1].height * s;
							
							l1[1].x =  l1[0].width + 20 * s;
						}
						
						
						if(l2){
							l2.x = left;
							l2.y = top;
						}
							
						
						var top = top + sndLine[0].getBoundingClientRect().height - config.font.paddingTop * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 - config.font.paddingBottom * (FONT_SIZE_ACCROCHE / FONT_SIZE_COMPANY) * s2 + SPACING_SUB_TEXT;
						thirdLine.attr('transform', 'translate('+ left +' ' + top + ')  scale(' + s2+ ')');
						if(l3){
							l3.x = left;
							l3.y = top;
						}
						
						var main = $div.find('.main');
						var top = ((lastItem[0].getBoundingClientRect().height) - main[0].getBoundingClientRect().height) / 2; 
						var left = lastItem[0].getBoundingClientRect().width + 20;
				
						$div.find('.main').attr('transform', 'translate('+ left + ' '+ (top > 0 ? top : 0) + ')');
						
						$scope.deplaceShape(config.texts, left,(top > 0 ? top : 0));
						
						config.logo.x = 0;
						config.logo.y = (top < 0 ? -top : 0 );
						lastItem.attr('transform', 'translate('+ config.logo.x +' '+ config.logo.y+') scale( ' + r + ')');
						
					}
					/* On recalcule la longeur des texts */
					angular.forEach(config.texts, function(t, key) {
						if(t.type == 'firstLine'){
							t.ratio = s;
							t.width = t.originalWidth * s;
							t.height = t.originalHeight * s;
						}
						if(t.type == 'sndLine'){
							t.width = t.originalWidth * s2;
							t.height = t.originalHeight * s2;
							t.ratio = s2;
						}
					});
					
					config.logo.width = lastItem[0].getBoundingClientRect().width; //lastItem.width();
					config.logo.height = lastItem[0].getBoundingClientRect().height; //lastItem.height();
					
				}	
				
				return;
			}//
			

			
			$scope.createPreviewIcon = function($element, config)
			{
				var randomId = makeid(32);

				var $parent = $element.parent();

				var $div = $parent.find('.logo-preview');
				$scope.createTexts($div, config, $parent);
				return;
				
			}
			
			$scope.deplaceShape = function(shapes, x, y, filter){
				angular.forEach(shapes, function(s, key) {
						
						if(s){
							if(!filter || s.type == filter){
								s.x += x;
								s.y += y;
							}
						}
				});

				
			}
			
			$scope.isScrolledIntoView = function(elem) {
				var $elem = $(elem);
				var $window = $(window);
			
				var docViewTop = $window.scrollTop();
				var docViewBottom = docViewTop + $window.height();
			
				var elemTop = $elem.offset().top + $elem.height();
				var elemBottom = $elem.offset().top;
			//	//console.log('elemTop', elemTop, 'elemBottom', elemBottom, '$elem.offset().top', $elem.offset().top);
				
				if( elemBottom == 0 )return false;
				return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
			}
			
			$scope.compile = function()
			{
				if($scope.etape == 2 && $scope.isScrolledIntoView($element.parent()))
				{
					if(compiled == false)
					{
						
						$scope.createPreviewIcon($element, config);
						
						//return;
						var width = $element.parent().width();
						var item = $element.find('.logo-preview');
						item.attr(	'transform', 'scale(' + (width / WIDTH) + ')');
						
						
						var paddingTop = 0;
						var paddingLeft = 0;
		
						
						var width = $element.parent().width();
						var height = $element.parent().height()
						
						var ratio = (width -  2 * paddingLeft) / (height -  2 * paddingTop);
						var svgRatio = $element.width() / $element.height();
						
		
						
						
						var item = $element.find('.logo-preview');
						
						var top = (height - item[0].getBoundingClientRect().height)  / 2;
						
						
						$element.attr(	'transform', 'translate(0 ' + top + ')');
						if(config.align == 'left')
						{
							var item = $element.find('.logo-preview');
							var left = (width - item[0].getBoundingClientRect().width)  / 2 > 0 ? (width -  item[0].getBoundingClientRect().width)  / 2 : 0;
							$element.attr(	'transform', 'translate('+left+' ' + top  + ')');
						}
							
						$compile($element.contents())($scope);
						config.html = $element.parent().html();		
						
					//	//console.log($element.parent().html());					
						compiled = true;
					}
				//	$element.parent().css('border','2px solid green');
				}
			//	else $element.parent().css('border','2px solid transparent');

			}
			$(window).resize(function(e){
				$scope.compile();
			});
			$(window).scroll(function(e) {
				$scope.compile();
			});
			
			$element.on("reload", function (e) {
				//console.log('reload');
				$scope.compile();


			});
			
			
			
			$scope.compile();

        }
    };
});


app.directive('extSvg', [ '$compile',  function ($compile) {
      return {
        restrict: 'E',
        scope: {

          content: '='
        },
        link: function($scope, $element) {
          $element.replaceWith($compile('<svg>' + $scope.content + '</svg>')($scope.$parent));
        }
      };
}]);

app.directive("ngIcon", function($sce,$compile, $rootScope,$timeout) {
    return {
			restrict: 'A',
			scope: {
				shape: '=ngModel',
			},
			link: function($scope, $element) {
				
			$scope.compile = function(){
				
				var html = cleansvg($scope.shape.svg);
				$element.replaceWith($compile('<svg>' + html + '</svg>')($scope.$parent));
			}
			
			$scope.compile();

        }
    };
});


app.directive("ngShape", function($sce,$compile, $rootScope,$timeout) {
    return {
			restrict: 'A',
			scope: {
				shape: '=ngModel',
				clickCallback: '&ngClick',
			},
			link: function($scope, $element) {
				
			$scope.mouseDown = function(e, index){
				$rootScope.colorShape = $scope.shape.graphics[index].colors;
				$rootScope.graphicShape = $scope.shape.graphics[index];
				
				//console.log('mousedown path', $scope.shape.id);

				 $("#color-picker-shape").spectrum("set", "#ff0000");
				$timeout(function(){
					//console.log('clignoter');
					$('#shape-' + $scope.shape.id).find('.clignoter').removeClass('clignoter');
					$('#PATH_' + $scope.shape.id + '_'+ index).addClass('clignoter');
					$scope.clickCallback({'e': e,'shape' : $scope.shape});
				}, 0 );
				e.preventDefault();
				e.stopPropagation();
			}
			
			
			$scope.compile = function(){
				
				$element.empty();
				
				angular.forEach($scope.shape.graphics, function(g, key) {
					
					var item = makePath( g.nodeName, g.attr, '');
					item.setAttribute('ng-click', 'mouseDown($event,'+ key + ')');
					
					
					item.setAttribute('id', 'PATH_' + $scope.shape.id + '_'+ key);
					
					if(g.colors.length == 1) item.setAttribute('fill', g.colors[0]);
					else {
						var index = 'SVGID_' + $scope.shape.id + '_'+ key;
						item.setAttribute('fill', 'url(#' + index +')');
						
						var linear = makePath( 'linearGradient', {id: index, x1:"0%", y1: "0%", x2:"100%", y2:"0%", 'gradientTransform': 'rotate(' + g.angle + ')'}, '');
						angular.forEach(g.colors, function(color, key) {
							var c = makePath( 'stop', {offset: (key* 100) + '%', 'stop-color': color, 'stop-opacity': 1}, '');
							
							linear.appendChild(c);
						});

						$element.append(linear);
					}
					$element.append(item);
				});
				$compile($element.contents())($scope);
			}
			
			
			
			
			if($scope.shape.unbindWatcher)$scope.shape.unbindWatcher();
			$scope.shape.unbindWatcher = $rootScope.$watchCollection('graphicShape.angle', function(newValue, oldValue) {
				////console.log('change shape angle');
				$scope.compile();
			});
			
			if($scope.shape.unbindWatcher1) $scope.shape.unbindWatcher1();
			$scope.shape.unbindWatcher1 = $rootScope.$watchCollection('graphicShape.colors', function(newValue, oldValue) {
				//console.log('change shape colorShape', newValue);
				
					
					$scope.compile();
		
			});
			
			$scope.compile();

        }
    };
});


app.directive('resizable', function ($timeout, $parse) {
    return {
        restrict: 'A',
        scope: {
            callback: '&onResize',
			drag: '&onDrag',
			dragstop: '&onDragstop',
			dragstart: '&onDragstart',
			rotateCallback: '&onRotate',
			stopCallback: '&onStopResize',
			startRotate:'&onStartRotate',
			stopRotate: '&onStopRotate',
			resizestart: '&onStartresize'
			
        },
        link: function postLink(scope, elem, attrs) {
			
			var nw = jQuery("<div>", {	class: "ui-rotatable-handle" });
			var param =   scope.$eval(attrs.resizable);
			
			
			var handles =  handles = "se";//"nw, ne, se, sw";
		//	if(param.aspectRatio == false)  handles = "nw, ne, se, sw, n, s, e, w";
						  
            elem.resizable({  handles: handles,aspectRatio: param.aspectRatio,containment: "parent", cancel: ".ui-rotatable-handle", snap: true}).draggable({cancel: ".ui-rotatable-handle", snapMode:'both', containment: "parent"});    
			
			elem.find('.ui-resizable-handle').addClass("svg-icon icon-scaling");

			//var shape = param.shape;
			var rotatable;
			
			if(param.type == 'text') rotatable = false;
			else if(param.type == 'shape' && param.id_categorie == 201) rotatable = false
			else rotatable = true;
			
			

				if(rotatable) 
				{
					elem.rotatable({"snap":true,"step":1});
					elem.find('div.ui-rotatable-handle').addClass("ui-rotatable-handle-nw svg-icon icon-rotation");
				}
				if(!rotatable) {
					nw.addClass('minimize');
					elem.append(nw); 
				}

				elem.find("div[class*='ui-rotatable-handle-']").bind("mousedown", function(e) {
						if(rotatable) elem.rotatable("instance").startRotate(e);
				});
				elem.on('rotate', function (evt, ui) {
					if (scope.rotateCallback && rotatable) { scope.rotateCallback({e: evt, ui:ui}); }
				});
				elem.on('rotatestart', function (evt, ui) {
					if (scope.startRotate && rotatable) { 
						scope.startRotate({e: evt, ui:ui}); 
					}
				});
				elem.on('rotatestop', function (evt, ui) {
					if (scope.stopRotate && rotatable) { scope.stopRotate({e: evt, ui:ui}); }
				});

				
				
            elem.on('resize', function (evt, ui) {
				
                if (scope.callback) { 
					scope.callback({e: evt, ui:ui}); 
				}
            });

			elem.on('resizestart', function (evt, ui) {
                if (scope.resizestart) { 
					scope.resizestart({e: evt, ui:ui}); 
				}
            });
			elem.on('resizestop', function (evt, ui) {
                if (scope.stopCallback) { scope.stopCallback({e: evt, ui:ui}); }
            });
			
			elem.on('dragstart', function (evt, ui) {
				if (scope.dragstart) { scope.dragstart({e: evt, ui:ui}); }
			});
			
			elem.on('dragstop', function (evt, ui) {
				if (scope.dragstop) { scope.dragstop({e: evt, ui:ui}); }
			});
			
			elem.on('drag', function (evt, ui) {
				if (scope.drag) { scope.drag({e: evt, ui:ui}); }
			});
        }
		
		
    };
});

app.directive('ngRightClick', function($parse) {
    return function(scope, element, attrs) {
        var fn = $parse(attrs.ngRightClick);
        element.bind('contextmenu', function(event) {
            scope.$apply(function() {
                event.preventDefault();
                fn(scope, {$event:event});
            });
        });
    };
});

angular.module('editor')
	.filter('trustAsResourceUrl', ['$sce', function($sce) {
		return function(val) {
			return $sce.trustAsResourceUrl(val);
		};
}])

angular.module('editor')
    .filter('to_trusted', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }]);
	
angular.module('editor')
    .filter('clean_accent', ['$sce', function($sce){
        return function(text, opt) {
            //console.log("clean_accent");
			if(opt.replace_accent == 1) return text.stripAccents();
		    else return text;
        };
    }]);
	
app.filter('cleansvg', function () {
  return function (input) {
	  var i = input.replace(/width="[0-9]+px"/, 'width="100%"');
	  i = i.replace(/height="[0-9]+px"/, 'height="100%"');
	
	   i = i.replace(/id="g-/g, 'id="engine-');
	   i = i.replace(/#g-/g, '#engine-');
	   

      return i;
  };
});
app.controller('EditorCtrl', function($scope, filterFilter, $http, $location,  $timeout, $filter, $rootScope){
	
	$scope.activeShape = null;
	$scope.left = 0; //78;
	$scope.top = 0; //50;
	$scope.etape = 1;
	$scope.padding = 10;
	$scope.magnetisme = true;
	$scope.showEditBar = false;
	$scope.colors = [];
	$scope.colorIndex = 0;
	$scope.tmpFont = false;
	$scope.history = [];
	$scope.saveIndex = 0;
	$scope.modifyTooltip = false;
	$scope.startTooltip = false;
	$scope.infoTooltip = false;
			
	$scope.companyName = '';
	$scope.phraseAccroche = '';
	$scope.categorieId = 1000;
	$scope.fontType = 0;
	
	$scope.backgroundColor = "#ffffff";
	$rootScope.colorShape  = ["#ffffff"];
	$rootScope.graphicShape = null;

	
	$scope.loading = true;
	
	$scope.q = "";
	$rootScope.editing = false;
	
	$scope.backgroundColors = ['#ffffff', '#000000', '#4d4d4d'];
	$scope.activeTuto = {};
	
	$scope.selectedItems = [];
	$scope.dragging = false;
	$scope.hasDragging = false;
	$scope.resizing = false;
	$scope.rotating = false;
	$scope.displayIcons = [];
	$scope.configs = [];
	$scope.favoris = [];
	$scope.currentConfig = false;
	$scope.categorieShape = false;
	$scope.mobilecheck = window.mobileAndTabletcheck();

	
	var div = document.getElementById('select-area'), x1 = 0, y1 = 0, x2 = 0, y2 = 0;
	
	$scope.area = {"width": 0, "height": 0, "left": 0, "top": 0 };

	$scope.icons = [];
	$scope.FONT_SIZE_COMPANY = FONT_SIZE_COMPANY;
	$scope.simple_configs = [];
	$scope.fonts = [];
	$scope.saving = false;
	$scope.logo = {'shapes' : [] };
	$scope.fonts = [];
	$scope.shapes = [];
	$scope.tutos = [];
	$scope.mixedColors = [];
	$scope.indexColor = 0;
	$scope.indexedShapes = [];
	$scope.indexedFonts = [];
	$scope.indexedSimpleFonts = [];
	$scope.index = 0;
	$scope.align = "left";
	$scope.rightclic = {'visible': false, 'left':0,'top':0};
	$scope.text = '';
	$scope.family = [];
	$scope.favbar = false;
	$scope.id_categorie = null;
	$scope.filters = {'icons' : true, 'shapes' : true, 'texts' : true};
	
	$scope.company = 'Votre entreprise';
	$scope.slogan = 'Votre phrase d\'accroche';
	
	$scope.companyNameChange = false;
	$scope.accrocheChange = false;
	$scope.logo_url = "/images/loader-download.gif";
	
	$scope.getUrlParameter = function getUrlParameter(sParam) {
		
		//var sPageURL = decodeURIComponent(window.location.search.substring(1));	
		var sPageURL = window.location.search.substring(1);
		
		var	sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;
		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
	
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
	}
	
	$scope.MIN_DISTANCE = 3; // minimum distance to "snap" to a guide
	$scope.guides = []; // no guides available ... 
	
	$scope.companyName = typeof $scope.getUrlParameter('text') != 'undefined' ? $scope.getUrlParameter('text') :'';
	//console.log('url parameter : ', $scope.getUrlParameter('text'));
	$scope.companyName  = $scope.companyName.replaceAll('\\+', ' ');
	
	//$scope.companyName  = $scope.companyName.replaceAll('\\+', ' ');
	
	
	//console.log( ' companyName ',  $scope.companyName , $scope.companyName.length );
	//$scope.nnerOffsetX, $scope.innerOffsetY; // we'll use those during drag ... 
	var d = {}
	
	var id =  $scope.getUrlParameter('id');
	$scope.modify_id_logo = false
	if(id) {
		d = {'id_logo' : id};
		$scope.loading = true;
		$scope.modify_id_logo = id;
	}
	
	var redirect =  $scope.getUrlParameter('r');
	$scope.redirect = false;
	if(redirect) {
		$scope.redirect  = redirect;
	}
	
	$http({
	  method: 'GET',
	//  url: '/v2/config.php'
	  
	  url: '/xml/config',
	  params: d
	}).then(function successCallback(response) {
		

		if(window.mobileAndTabletcheck()){
			//console.log('Mobile');	
		}
		else{
			//console.log('PC Fixe');	
		}
		
		//console.log("Config loaded", response);
		$scope.etape = 2;
		 $scope.categories = response.data.categories;
		 
		 
		 $scope.fonts = response.data.fonts;
		 $scope.icons = response.data.icons;
		 
		 $scope.icons_id = response.data.icons_id
		// //console.log( " $scope.randomIcons", $scope.icons_id);
		 $scope.shapes = response.data.shapes;
		 $scope.tutos = response.data.tutos;
		 $scope.activeTuto = $scope.getDefaultTuto();
		 $scope.favoris_icons = response.data.favoris;
		
		
		
		 $scope.family = response.data.family;
		 $scope.simple_configs = response.data.simple_configs;

		 $scope.previewShapes = angular.copy(response.data.shapes);
		 $scope.overShapes = [];
		 $scope.insideShapes = [];
		 
		 /* On supprime toutes les shapes qui ont l'attribut preview a 0 */
		  angular.forEach($scope.previewShapes, function(categorie, key) {
			  for(var i = categorie.shapes.length -1; i > 0; i--){
				  if( categorie.shapes[i].preview == 0) categorie.shapes.splice(i,1);
			  }
		 });
		 
		 $scope.showBar("info");

		angular.forEach($scope.shapes[203].shapes, function(s, key) {
			if(s.position == 'over' && s.preview == 1) $scope.overShapes.push(s);
			if(s.position == 'inside' && s.preview == 1)  $scope.insideShapes.push(s);
		});

		 $scope.mixedColors = response.data.colors;


		 $scope.categorieShape = $scope.shapes[200].categorie.id;
		 $scope.backgroundColor = "#ffffff";
		 
		 angular.forEach($scope.shapes, function(categorie, key) {
			angular.forEach(categorie.shapes, function(s, key) {
				$scope.indexedShapes.push(s);
			});
		 });
		 
		 angular.forEach($scope.fonts, function(family, key) {
			angular.forEach(family.fonts, function(font, key) {
				$scope.indexedFonts.push(font);
				if(font.preview == 1) $scope.indexedSimpleFonts.push(font);
			});
		 });

		
		$scope.infoTooltip = 1;
		
		if(response.data.logo){
			// ON est sur la modification d'un logo
			$scope.showBar("text");
			$scope.infoTooltip = 2;
			var c = $scope.categories[1000]; // categorie les plus populaires
			
			$scope.backgroundColor = response.data.background;
			$scope.setEtape(3);
			//console.log("categorie", c);
			
			$scope.changeCategorie(c, true, true);
			
			$scope.logo = response.data.logo;
			
			/* on remet les id des shapes, textes, logo a 0 */
			var i = 0;
			angular.forEach($scope.logo.shapes, function(s, key) {
				s.id = i;
				i++;
			});
		
			$scope.info_logo = response.data.info_logo;
			$scope.loading = false;
			$scope.align = null;
			
			$('.loader-container').removeClass('visible');

			$timeout(function(){
				$scope.loading = false;
				$scope.calculateBoxes();
				//$scope.initStage();
				$scope.centerOnStage($scope.logo.shapes);
				
				
				$scope.index = $scope.logo.shapes.length;
				//console.log('$scope.index',$scope.index);
				
				$scope.initColor();
				$scope.save();
				return;
			}, 0 );
		}
		
		/* initialisation des champs */
		//console.log("initialisation des champs",$scope.company);
		if($scope.companyName.length == 0) $scope.companyName = $scope.default_company;
		$scope.phraseAccroche = $scope.default_slogan;
		$scope.id_categorie = $scope.categorieId;
		
		/* end */
		
		if($scope.etape == 2 && $scope.id_categorie){
			//$scope.generateConfigs($scope.icons); // humm a virer ?
			var c = $scope.categories[$scope.categorieId];
			$scope.changeCategorie(c);
		}
		$timeout(function(){
			$('.ng-presentation').trigger('reload');
			$scope.loading = false;
			
		}, 0 );
		
		
	  }, function errorCallback(response) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });

		
	 $scope.displayFavorisBar = function(){
		 //console.log("favbar", $scope.favbar);
		$scope.favbar = !$scope.favbar;
	 }
	
	  $scope.extractLogoColors = function (svg){
		  var cc = svg.match(/#[0-9A-F]{6}/gi);
		  
		  var colors = [];
		  if(!cc) {
				return colors; 
		  }
		  for(var i = 0; i < cc.length; i++){
			var c = cc[i];
			if(  colors.indexOf(c) == -1) colors.push(c);
		  }
		  return colors;
	  }
	  
	 $scope.capitalizeFirstLetter = function capitalizeFirstLetter(string) {
   		 return string.charAt(0).toUpperCase() + string.slice(1);
	 }
	 
		$scope.shuffle = function(a) {
			var j, x, i;
			for (i = a.length; i; i--) {
				j = Math.floor(Math.random() * i);
				x = a[i - 1];
				a[i - 1] = a[j];
				a[j] = x;
			}
		}

	  
	  $scope.generateFormeConfig = function(shape, font, c, c2){
		  
		var text = $scope.companyName;  
		var accroche = $scope.phraseAccroche;
		var index = Math.floor(Math.random() * $scope.indexedSimpleFonts.length);
		

		 if(typeof font == 'undefined' || font == false)
		 {
			
			 if($scope.fontType == 0){
				 var index = Math.floor(Math.random() * $scope.indexedSimpleFonts.length);
				 var font = $scope.indexedSimpleFonts[index];
			 }
			 else{
				var index = Math.floor(Math.random() * $scope.fonts[$scope.fontType].fonts.length);
				var font = $scope.fonts[$scope.fontType].fonts[index];

			 }
		 }
		
		 if(font.replace_accent == 1){
				text = text.stripAccents();
				accroche = accroche.stripAccents();
		 }
		 if(font.uppercase == 1){
			text = text.toUpperCase(); 
			accroche = accroche.toUpperCase();
		 }
		
		var colors = $scope.mixedColors.forme[Math.floor(Math.random() *  $scope.mixedColors.forme.length)]; 
		if(typeof c == 'undefined') var c =  colors.match_color ;
		if(typeof c2 == 'undefined') var c2 = colors.color;
		 
		var forme = angular.copy(shape);
		
		forme.color = c2;
		if(forme.default_text_color) c = forme.default_text_color;
		textes = [{text:  text, color: c, size:FONT_SIZE_COMPANY, family: font.family, 'type': 'firstLine'}];	
		
		if(accroche.length > 0) {
			
			cut = true;
			if(shape.position == 'over') cut = false;
			if(cut && accroche.length > 15 && accroche.indexOf(" ")){
				
				 var index = accroche.indexOf(" ", (accroche.length / 2)); 
				 if(index == -1)
				 {
					 var t = {text:  accroche, color: c, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'sndLine'}
					 textes.push(t);
				 }
				 else{
			
					 var firstText = accroche.substring(0, index);
				 	 var t = {text:  firstText, color: c, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'sndLine'}
				 	 textes.push(t);
				 
					 var sndText = accroche.substring(index + 1);
					 var t = {text:  sndText, color: c, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'thirdLine'}
					 textes.push(t);
				 }
			}
			else{
				textes.push({text:  accroche, color: c, size:FONT_SIZE_ACCROCHE, family: font.family,letterSpacing:0, type:'sndLine'});
			}
		}
		
		shape.font = font;
		shape.c = c;
		shape.c2 = c2;
		
		
		var config = {'originalText': text, 'color': c, 'c': c, 'c2': c2, 'phraseAccroche': accroche,  align: null, texts:textes, 'logo':null, 'lignes': [], 'details': [], 'forme': forme, 'picto': null, 'type':'shape',font: font,'shape': shape, 'priority':parseInt(shape.priority)};
		$scope.configs.push(config);
		 
	  }
	  
	
	 $scope.generateSimpleConfig = function(conf, font, c, c2){
 
		 /* regles sur le nom d'entreprise */ 
		 var strings = [{"name": $scope.companyName,"key":"name"},{"name": $scope.phraseAccroche, "key": "accroche"}];
		 conf.conf =  angular.fromJson(conf.conf);
		 var display = true;
		 angular.forEach(strings, function(obj) {
			 
			var key = obj.key;
			var rule = conf.conf.rules[key];
			var count = (obj.name.match(/ /g) || []).length + 1;
			var length = obj.name.length;

		 	if(typeof rule.words != 'undefined' && count != rule.words) display = false;
		 	if(typeof rule.min_length != 'undefined' && length < rule.min_length) display = false;
		 	if(typeof rule.max_length != 'undefined' && length > rule.max_length) display = false;
		 });
		 if(display == false) return;

		 var text = $scope.companyName; 
		 var accroche = $scope.phraseAccroche; 
		 if(typeof font == 'undefined' || font == false)
		 {
			
			 if($scope.fontType == 0){
				 var index = Math.floor(Math.random() * $scope.indexedSimpleFonts.length);
				 var font = $scope.indexedSimpleFonts[index];
			 }
			 else{
				var index = Math.floor(Math.random() * $scope.fonts[$scope.fontType].fonts.length);
				var font = $scope.fonts[$scope.fontType].fonts[index];

			 }
		 }
		
		
		
		var colors = $scope.mixedColors.forme[Math.floor(Math.random() *  $scope.mixedColors.forme.length)]; 
		if(typeof c == 'undefined') var c =  colors.match_color ;
		if(typeof c2 == 'undefined') var c2 = colors.color;
		 

		var count = (text.match(/ /g) || []).length;
		var l1 = false;
		var b = true;
		if(typeof conf.conf.shapes.l0_over != 'undefined') b = false;
		var l1_over = false;
		if(typeof conf.conf.shapes.l1_over != 'undefined') l1_over = true;	
		
		
		 if(font.replace_accent == 1){
				text = text.stripAccents();
				accroche = accroche.stripAccents();
		 }
		 if(font.uppercase == 1){
			text = text.toUpperCase(); 
			accroche = accroche.toUpperCase();
		 }
		 
		
		
		var inside = typeof conf.conf.shapes.inside != "undefined";
		if( b && ( inside || Math.floor((Math.random() * 2) + 1) == 1 && (count == 1 || count == 2)) ||l1_over) {
			 
			 var textes = $scope.generateTextWithColor(text, c, c2, font,FONT_SIZE_COMPANY,'firstLine');
			 l0 = textes[0];
			 l1 = textes[1];
			 bicolor = true;
		}
		else{
			var l0 = {text:  text, color: c, size:FONT_SIZE_COMPANY, family: font.family, 'type': 'firstLine'};
			textes = [l0];	
		}
		


		var cut = conf.conf.rules.accroche.cut ? conf.conf.rules.accroche.cut : false;
		if(cut && accroche.length > 0) {
			
			if(accroche.length > cut && accroche.indexOf(" ")){
				
				 var index = accroche.indexOf(" ", (accroche.length / 2)); 
				 if(index == -1)
				 {
					 var l2 = {text:  accroche, color: c, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'sndLine'}
					 textes.push(l2);
				 }
				 else{
			
					 var firstText = accroche.substring(0, index);
				 	 var l2 = {text:  firstText, color: c, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'sndLine'}
				 	 textes.push(l2);
				 
					 var sndText = accroche.substring(index + 1);
					 var l3 = {text:  sndText, color: c, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'thirdLine'}
					 textes.push(l3);
				 }
			}
			else{
				var l2 = {text:  accroche, color: c, size:FONT_SIZE_ACCROCHE, family: font.family,letterSpacing:0, type:'sndLine'}
				textes.push(l2);
			}
		}
		
		if(typeof conf.conf.shapes.initial != 'undefined')
		{
			var res = text.split(" ");
			var str = text.substring(0,1);
			if(res.length == 2) str = res[0].substring(0,1) +  res[1].substring(0,1);
			var l4 = {text:  str.toUpperCase(), color: "#fffff", size:FONT_SIZE_COMPANY, family: font.family, 'type': 'initial'};
			textes.push(l4);
		}
		
		align = false;
		if(conf.conf.align == "center") align = "conf";
		conf.font = font;
		conf.c = c;
		conf.c2 = c2;
		var config = {'originalText': text, 'inside': inside, 'color': c, 'phraseAccroche': accroche,  align: align, texts:textes, 'logo':null, 'lignes': [], 'details': [], 'forme': false, 'picto': null, 'c': colors.id,'type':'conf',font: font,'conf': conf.conf,'priority':parseInt(conf.priority),'shape': conf}
		$scope.configs.push(config);
		
		 
	 }
	 
	 $scope.sorterFunc = function(config){
		// //console.log("c", config.type);
		 if(config.type == 'icon') return parseInt(config.priority) 
    	 else return parseInt(config.priority) - 0.1;
	};

	 
	 $scope.savePosition = function (config, id)
	 {
		 if(config.type != 'shape' && config.type !='conf'){
			return; 
		 }
		 var val = $('#' + id).val();
		 //console.log('changement de position', val);
		 

		var d = {'id' : config.shape.id, 'type' : config.type,'v':val};
		$http({
		  method: 'GET',
		//  url: '/v2/config.php'
		  
		  url: '/xml/save-position',
		  params: d
		});
		config.priority = val;
		config.shape.priority = val;
	 }
	 
	 $scope.shuffle = function(a) {
		var j, x, i;
		for (i = a.length - 1; i > 0; i--) {
			j = Math.floor(Math.random() * (i + 1));
			x = a[i];
			a[i] = a[j];
			a[j] = x;
		}
	}
	 $scope.generateTextWithColor = function(text, c, c2, font,size,typeLine){
		 
		 var textes = [];
		 var index = text.indexOf(" ");
		 var firstText = text.substring(0, index);
		 var color = c; //(key == 0) ? c : c2;
		 var t = {text:  firstText, color: c, size:size, family: font.family,'type': typeLine}
		 textes.push(t);
			 
		 if(index)
		 {
			 var sndText = text.substring(index + 1);
			 var t = {text:  sndText, color: c2, size:size, family: font.family,'type': typeLine}
			 textes.push(t);
		 }
		 return textes;
	 }
	 

	  $scope.createIconConfig = function(icon, font, align, bicolor, key){
		 
		 
		 var text = $scope.companyName;
		 var accroche = $scope.phraseAccroche;
		 if(!icon.svg || typeof icon.svg == 'undefined'){
				//console.log('erreur color', icon.id); 
				return;
		 }
		 var colors = $scope.extractLogoColors(icon.svg);
		 if(!colors){
			 //console.log('Erreur on ', icon.id);
			 return false;
		 }

		 var c = colors.length >= 1 ? colors[colors.length-1] : '#4d4d4d';
		 var c2 = colors.length >= 2 ? colors[colors.length-2] : c;
		 var c3 = colors.length >= 2 ? colors[colors.length-2] : '#4d4d4d';
		 var ico = angular.copy(icon);
		 
		
		 
		 if(typeof font == 'undefined' || font == false)
		 {
			
			 if($scope.fontType == 0){
				 var index = Math.floor(Math.random() * $scope.indexedSimpleFonts.length);
				 var font = $scope.indexedSimpleFonts[index];
			 }
			 else{
				var index = Math.floor(Math.random() * $scope.fonts[$scope.fontType].fonts.length);
				var font = $scope.fonts[$scope.fontType].fonts[index];

			 }
		 }
		 		 
		 if(font.replace_accent == 1){
				text = text.stripAccents();
				accroche = accroche.stripAccents();
		 }
		 if(font.uppercase == 1){
			text = text.toUpperCase(); 
			accroche = accroche.toUpperCase();
		 }
		 
		 
		 var count = (text.match(/ /g) || []).length;
		 if( count != 1 ) bicolor = false;

		 if( bicolor || Math.floor((Math.random() * 2) + 1) == 1 && colors.length >= 2 && count == 1 ) {
			 
			 var textes = $scope.generateTextWithColor(text, c, c2, font,FONT_SIZE_COMPANY,'firstLine');
			 bicolor = true;
		 }
		 else{
			 textes = [{text:  text, color: c, size:FONT_SIZE_COMPANY, family: font.family, type:'firstLine'}];
			 bicolor = false;
			 
			
		 }

		 if(typeof align == 'undefined')
		 {
		 	var align = Math.floor((Math.random() * 3) + 1) == 1 ? 'left' : 'top';
		 }
		 if(text.length > 15) align = 'top';
		 
		 var MAX_LENGTH = align == 'top' ? 25 : 25;
		 if(accroche.length > 0) {
			
			if(accroche.length > MAX_LENGTH && accroche.indexOf(" ")){
				
				 var index = accroche.indexOf(" ", (accroche.length / 2)); 
				 if(index == -1)
				 {
					 var t = {text:  accroche, color: c3, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'sndLine'}
					 textes.push(t);
				 }
				 else{
			
					 var firstText = accroche.substring(0, index);
				 	 var t = {text:  firstText, color: c3, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'sndLine'}
				 	 textes.push(t);
				 
					 var sndText = accroche.substring(index + 1);
					 var t = {text:  sndText, color: c3, size:FONT_SIZE_ACCROCHE, family: font.family,'type': 'thirdLine'}
					 textes.push(t);
				 }
			}
			else{
				textes.push({text:  accroche, color: c3, size:FONT_SIZE_ACCROCHE, family: font.family,letterSpacing:0, type:'sndLine'});
			}
		}
		 icon.font = font;
		 icon.align = align;
		 icon.bicolor = bicolor;
		

		 var accroche = angular.copy(textes);
		 var config = {'originalText': text, align: align, texts:textes, 'logo':ico, 'lignes': [], 'details': [], 'forme': null, 'picto': null, f:font.id,'type':'icon',font: font, 'icon' : icon, 'bicolor': bicolor, 'priority' : key,'shape': icon}
		  $scope.configs.push(config);
	  }

	/* WATCH */
	
	$scope.$watch('showEditBar', function(newValue, oldValue) {
		
		var speed = 150;
		//console.log("showEditBar", newValue, oldValue);
		$scope.colorIndex = 0;
		
		
		$("#color-picker").spectrum("set", "#000000")
		//$("#color-picker").trigger('foo');
		//$scope.startTooltip = false;
		//$scope.modifyTooltip = true;	
		
		if(newValue == 'text')
		{
			if( !($scope.selectedItems.length == 1 && $scope.selectedItems[0].type == 'text'))
			{
				var text = $filter('filter')($scope.logo.shapes, {type: 'text'})[0];
				$scope.unSelectAllItems();
				if(text)$scope.selectShape(text);
			}
		}
		else if(newValue == 'change_icon')
		{
			$scope.unSelectAllItems();
			
			if($scope.modify_id_logo){
				var logo = $filter('filter')($scope.logo.shapes, {type: 'logo'})[0];
				if(logo){
					$scope.activeShape = logo;
					
					if($scope.activeShape && $rootScope.graphicShape == null){
						$rootScope.colorShape = $scope.activeShape.graphics[0].colors;
						$rootScope.graphicShape = $scope.activeShape.graphics[0];
						$scope.colorIndex = 0;
					}
					$scope.selectShape(logo);
					$scope.showBar("logo");
				}
				else 
				{
					if($scope.info_logo.paid == 1){
						speed = 0;
						$scope.showEditBar = false;
						return;
					}
				}
			}
				 
			/* il faut faire un truc */
			
			
			//if(logo)$scope.selectShape(logo);
		//	$scope.showEditBar = newValue;
		}
		

			var newItem = $('.'+newValue+'-palette');
			if(oldValue == false &&  newValue != false)
			{
				$('.edit-bar').animate({left: "74" }, speed, function() { });
			}
			else if(newValue == false) {
				$('.edit-bar').animate({left: "-195" }, speed, function(){  });
			}
	


		else if(oldValue != newValue && newValue != false)
		{

			/* $scope.$broadcast('scrollable.scroll.top');
			 $('.scrollbar').mCustomScrollbar('scrollTo',['top',0]);*/
		}
	
	});
	
	$scope.$watch('selectedItems', function(newValue, oldValue) {
			if(newValue.length == 1 && newValue[0])
			{
				
				if($scope.showEditBar != 'change_icon' ) $scope.showEditBar = newValue[0].type;
			}

		});

	/* END WATCH */
	
	
	$scope.setGraphic = function(g){
		//console.log("setGraphic", g);
	};
	
	$scope.changeTextColorSpectrum = function(color){
		$scope.modifyTooltip = 2;
		if($('input').is(':focus')){
			
			$('input').blur();
		}
	}
	
	$scope.focusItem = function(obj){

		$('#' + obj).css('pointer-events', 'auto');
		$('#' + obj).focus();
	
	}
	$scope.blurColor = function(obj){
		$('#' + obj).css('pointer-events', 'none')
	}

	$scope.changeBackgroundColor = function(color){
		$scope.backgroundColor = color;

		var index = $scope.backgroundColors.indexOf(color);
		if(index == -1){
			$scope.backgroundColors.push(color);
		}
	}
	

	$scope.changeAutoAlign = function(position)
	{
		$scope.align = position;
		$scope.save();

	}
	
	$scope.changeAngle = function(value)
	{
		var v = $rootScope.graphicShape.angle + value;
		
		if(v > 90) $rootScope.graphicShape.angle = 90;
		else if (v < 0) $rootScope.graphicShape.angle = 0;
		else $rootScope.graphicShape.angle = v;	
	}
	$scope.searchHttp = function(q, r){
		$scope.suggests = [];
		$http({
		  method: 'GET',
		  url: '/xml/search',
		  params: {'q': q, 'v2':1, 'r': r }
		}).then(function successCallback(response) {
			//console.log(response.data.words);
			$scope.suggests = response.data;
		});
	}
	
	$scope.skav = function(e, shape)
	{
		$scope.unSelectAllItems();
		$scope.selectShape(shape);
		$scope.activeShape = shape;
	}
	
	
	$scope.searchInputChange = function(){
		//console.log("$scope.q", $scope.q, $scope.q.length);
		if($scope.lastCategorie == null &&  $scope.q.length == 0){
			//console.log('on reinitialise la recherche');
			var c = $scope.categories[$scope.categorieId];
			$scope.changeCategorie(c, true);
			$scope.lastCategorie = c;
			$scope.lastSearch = "";
		}
	}
	
	$scope.searchKeyword = function(suggest)
	{
		$scope.q = suggest;
		$scope.searchIconsAndConfig();
	}
	
	$scope.searchIcons = function(checkLength)
	{
		//console.log('******** $scope.searchIcons *******');
		$scope.lastCategorie = null;
		if($scope.lastSearch !=  $scope.q){
			var exact = ($scope.q.length == 1);
			if($scope.q.length == 0) $scope.displayIcons = angular.copy($scope.icons);
			else {
				$scope.displayIcons = $scope.search($scope.q, $scope.icons, exact);
				$scope.searchHttp($scope.q, $scope.displayIcons.length);
			}
		}
		$scope.lastSearch = $scope.q;
	}
	
	$scope.searchIconsAndConfig = function(checkLength)
	{
		$scope.lastCategorie = null;
		if($scope.q && $scope.lastSearch !=  $scope.q){
			
			$scope.loading = true;
			
			$timeout(function(){
				var exact = ($scope.q && $scope.q.length == 1);
				if($scope.q.length > 0) 
				{
					icons = $scope.search($scope.q, $scope.icons, exact);				
					$scope.searchHttp($scope.q, icons.length);
					
					
					$scope.generateConfigs(icons, false, true);
					$scope.displayIcons = icons;
				}
				else {
					var c = $scope.categories[$scope.categorieId];
					$scope.changeCategorie(c, true);	
				}
				$scope.loading = false;
				 $(window).scrollTop(0);
			},10);
		}
		$scope.lastSearch = $scope.q;
		
		
	}
	
	$scope.pressEnterConfig = function(){
		
		document.activeElement.blur();
		$scope.loadConfig(false);	
	}
	
	$scope.loadConfig = function(force, up){
		if($scope.categorieId && $scope.loading == false){
			//console.log('Reload Icon');
			if($scope.companyNameChange == true || $scope.accrocheChange == true || force){
				

				$scope.companyNameChange = false;
				$scope.accrocheChange = false;
				if($scope.companyName.length == 0) return;
				if(up == true) $(window).scrollTop(0);
				$scope.loading = true;
				$timeout(function(){
					
					//console.log('loadConfig');
					
					if($scope.q && $scope.q.length > 0 && force == false){
						var icons = $scope.search($scope.q, $scope.icons, false);
						$scope.generateConfigs(icons,false , true);
						$scope.displayIcons = icons;
					}
					else{
						var c = $scope.categories[$scope.categorieId];
						$scope.changeCategorie(c, true);
					}
	
					$scope.loading = false;
					//$('.ng-presentation').trigger('reload');
				},10);
			}
		}
	}
	
	$scope.goEtape2 = function(id_categorie){
		if($scope.companyName.length == 0) return;
		//console.log('Goto Etape 2', id_categorie);
		
		$scope.companyNameChange = $scope.accrocheChange = false;
		
		$scope.etape = 2;
		if(id_categorie == 0) id_categorie = 1000;
		if($scope.loading == true) 
		{
			
			$scope.id_categorie = id_categorie;
			
		}
		else{
			$scope.loading = true;
			$timeout(function(){
				var c = $scope.categories[id_categorie];
				$scope.changeCategorie(c, true);	
				$scope.loading = false;
			}, 0 );

		}
		$timeout(function(){
			$scope.categorieId = id_categorie;
			
			// remove
			//$(".search-bar-container-fixed").sticky({topSpacing:40});	
			//  $(".sidebar-step2-container").sticky({topSpacing:40});	
		 }, 0 );
		
	}
	
	
	
	
	$scope.changeFontType = function(){
		//console.log("changeFontType");
		if($scope.loading == false)
		{
			$scope.loading = true;
			//$('.selectBox-dropdown-menu').
			$timeout(function(){
				
				angular.forEach($scope.icons, function(icon, key) {
					icon.font = false;
				});
				var s = $scope.q && $scope.q.length > 0 ? true : false;
				$scope.generateConfigs($scope.displayIcons, false, s);
				$scope.loading = false;
				
			},10);
		}
	}
	
	$scope.findFontById = function(id){
		 var font = false;
		 
		 angular.forEach($scope.indexedFonts, function(f, key) {
		 	if(f.id == id) font = angular.copy(f);
		 });
		 return font;
		
	}
	
	$scope.generateConfigs = function(icons, font, hideShapes)
	{
		  //console.log('Generate configs');
		  var text = $scope.companyName;
		  
		  $scope.configs = []
		  if ($scope.companyName==false  && $scope.phraseAccroche==false ) return;
		  

		  if($scope.companyName.containsArabicChar() || $scope.phraseAccroche.containsArabicChar()){
			  var ff = $scope.findFontById(139);
		  }
		  
		  else if($scope.companyName.containsIndianChar() || $scope.phraseAccroche.containsIndianChar()){
			  var ff = $scope.findFontById(141);
		  }
		  else if($scope.companyName.containsCyrilicChar() || $scope.phraseAccroche.containsCyrilicChar()){
			  var ff = $scope.findFontById(140);
		  }
		  if($scope.filters.icons == true){
			  angular.forEach(icons, function(icon, key) {
				 var f = (font === false) ? false : icon.font;
				 if(ff) f = ff;
				 $scope.createIconConfig(icon, f, icon.align, icon.bicolor, key);
				
			  });
		  }
		
		  if(typeof hideShapes == 'undefined' || hideShapes == false ){		
			  if($scope.filters.shapes == true){
				   angular.forEach($scope.overShapes, function(shape, key) {
						 
						//if(($scope.companyName==false || ($scope.companyName.length >=3 && $scope.companyName.length <= 15)) && ($scope.phraseAccroche == false || ($scope.phraseAccroche.length >=3 && $scope.phraseAccroche.length <= 34) )  ) 
						{
							var f = (font === false) ? false : shape.font;
							if(ff) f = ff;
							if( $scope.companyName.length >= 6) $scope.generateFormeConfig(shape, f, shape.c, shape.c2);;
						}
				  });
				  
				  angular.forEach($scope.insideShapes, function(shape, key) {
						if(($scope.companyName==false || ($scope.companyName.length >=3 && $scope.companyName.length <= 15)) && ($scope.phraseAccroche == false || ($scope.phraseAccroche.length >=3 && $scope.phraseAccroche.length <= 34) )  ) 
						{
							var f = (font === false) ? false : shape.font;
							if(ff) f = ff;
							$scope.generateFormeConfig(shape, f, shape.c, shape.c2);;
						}
				  });
			   }
	
			  if($scope.filters.texts == true){
				   angular.forEach($scope.simple_configs, function(conf, key) {
					  // conf = angular.fromJson(conf);
					  var f = (font === false) ? false : conf.font;
					  if(ff) f = ff;
					  
					  $scope.generateSimpleConfig(conf, f, conf.c, conf.c2);
				   });
			  }
		  }
		//	$scope.shuffle($scope.configs);
		   return; 



	}
	

	
	$scope.search = function (keyword,icons, exact)
	{
		keyword = keyword.toLowerCase();
		keyword = keyword.stripAccents();
		keyword.trim();
		keyword = keyword.replace(/ +(?= )/g,'');
			
		
		words = keyword.split(/[\s,]+/);
		
		//console.log("word split", words);
		var length = words.length;
		for(var i=0;i<length; i++){
			if(words[i].length > 3 && words[i].slice(-1) == 's' && words[i].slice(-2) != 'ss' )
			{				
				//words[i] = 
				var w = words[i].slice(0,-1)	;
				words.push(w);
				
			}
		}
		
		//console.log('word clean', words);
		if(words.length == 2 && (words[0] == 'letter' || words[0] == 'lettre') && words[1].length == 1 ){
			words.splice(0,1);	
		}
		
		
		if(words.length > 1){
			for(var i=words.length -1;i>=0; i--){
				
				if(words[i].length == 1){
					words.splice(i,1);
				}
			}
			if(words.indexOf(keyword) == -1) words.push(keyword);
		}
		
		
		
		//console.log(keyword, words);
		var results = [];
		
		angular.forEach($scope.icons_id, function(id, key) {	
			var icon = $scope.icons[id];
			//icons_id
			var keepGoing = true;
			var t = false;
			
			if(icon.name.toLowerCase() == keyword)
			{
				results.push(icon);
			}
			else
			{
				for (var i = 0; i < icon.keywords.length && keepGoing; i++) {
					q = icon.keywords[i];
					
					if(q){
						q = q.stripAccents();

						var t = false
						for(var j = 0; j<words.length && t == false;j++){
							t = (q == words[j]);
						}
						if(t)
						{
							results.push(icon);
							keepGoing = false;
						}
					}
				}
			}
		});
		
		
		return results.reverse();
	}
	
	
	$scope.isRotatable = function(shape)
	{
		//console.log('isRotatable', shape); //fonction appeler tout le temps
		if(shape.type == 'text') return '0';
		else if(shape.type == 'shape' && shape.id_categorie == 201) return '0';
		return '1';
	}
	
	$scope.extractColors = function (svgItem, svg){
		var colors = [];
		var color = svgItem.attr('fill');
		
		if(color){
			if(color == 'none') {
				////console.log('Bug color none: ', color, svg);
			}
			else if(color.substring(0,1) == '#')
			{
				color = color.toLowerCase();
				colors.push(color);
			}
			else 
			{
				var regExp = /\(([^)]+)\)/;
				var matches = regExp.exec(color);
				
				
				var g = svg.find(matches[1]);
				var nodes = g.children();
				angular.forEach(nodes, function(node, key) {
					c = $(node).css('stop-color');
					if(c.substring(0,1) != '#')
					{
						c = $scope.rgb2hex(c);
					}
					c = c.toLowerCase();
					colors.push(c);
				});
			}
		}	
		return colors;
	}
	
	
	$scope.doubleClick = function(e){
		//console.log("doubleClick");
	}
	
	$scope.rotate = function(value){
		$scope.activeShape.rotate += value;	
		
		$scope.activeShape.rotate = $scope.activeShape.rotate%360
	}
	
	$scope.rightClick = function($event)
	{
		//console.log('right click');	
		
		$scope.rightclic.left = $event.originalEvent.clientX ;
		$scope.rightclic.top = $event.originalEvent.clientY;
		
		$scope.rightclic.visible = true;
	}
	$scope.moreInformations = function($event){
		$('.clignoter').removeClass('clignoter');
		$scope.rightClick($event);
		$event.preventDefault();
		$event.stopPropagation();
	}
	
	$scope.letterSpacingArray = function(text, letterSpacing){
		var length = text.length;
		var spacing = [];
		spacing.push(0);
		for(var i = 1; i< length;i++){
			spacing.push(letterSpacing);
		}
		
		return spacing.join(' ');
	}

	$scope.removePlaceholder = function(type)
	{
		if(type == 'company')
		{
			if($scope.companyName == $scope.default_company) {
				
				$scope.companyName = '';
			}
		}
		
		if(type == 'accroche')
		{
			if($scope.phraseAccroche == $scope.default_slogan) 
			{
				$scope.phraseAccroche = '';
				$scope.accrocheChange=true;
			}
		}
	}

	
	$scope.loadIcon = function (icon, etape, favoris)
	{
		$scope.favbar = false;
		if($scope.logo.shapes.length && typeof favoris == 'undefined'){
			//	$scope.loadFavoris(icon, false);
			var txt = $scope.confimraton_msg;
			var r = confirm(txt);
			if (r == false) {
				$scope.etape = 3;
				return;
			} 
		}
		
		$scope.infoTooltip = 2;
		$scope.scrollTop = window.scrollY;
		//console.log('scrollTop', $scope.scrollTop);
		config = icon;
		$scope.logo.shapes = [];
		
		
		angular.forEach(config.texts, function(s, key) {
			
			var txt = {"id": (++$scope.index),'text': s.text, 'size': s.size, 'ratio' : typeof s.ratio != 'undefined' ? s.ratio : 1, "originalWidth":s.originalWidth,"originalHeight":s.originalHeight,  'width' : s.width, 'height' : s.height, 'color': s.color,'family':s.family, "rotate" : 0, "type" :"text", "x":s.x,"y":s.y, 'letterSpacing': s.letterSpacing, 'zindex' :2,'aspectRatio' : true,'font':s.font, 'dx' : $scope.letterSpacingArray(s.text,s.letterSpacing)}
			//console.log("txt", txt);
			$scope.logo.shapes.push(txt);

		});
		
		if(config.logo)	
		{
			var logo = {"id": (++$scope.index),'graphics': [], 'id_icon': config.logo.id, "width": config.logo.width,"height":config.logo.height,"originalWidth":config.logo.originalWidth,"originalHeight":config.logo.originalHeight, "symetrieX" : 1, "symetrieY" : 1, 'colors': [],"rotate" : 0, "type" :"logo", "x":config.logo.x,"y":config.logo.y, 'data' : config.logo.svg, 'zindex' :1,'aspectRatio' : true}
			$scope.initSvg(logo);
			$scope.logo.shapes.push(logo);
			var l = angular.copy(logo);
			//console.log("LOGO : ",l);
		}
		
		
		var shapes = [config.details, config.lignes, [config.picto], [config.forme]];
		var shapes = [].concat.apply([], shapes); 
		
		angular.forEach(shapes, function(s, key) {
			if(s){
				var ss = {"id": (++$scope.index), 'shape_id': s.id, "x": s.x,"y":s.y, "width":s.width,"height":s.height,"originalWidth":s.originalWidth,"originalHeight":s.originalHeight,  'id_categorie' : s.id_categorie,'graphics': [],'type_shape': s.type, "symetrieX" : (typeof s.symetrieX != 'undefined' ? s.symetrieX : 1), "symetrieY" : (typeof s.symetrieY != 'undefined' ? s.symetrieY : 1), 'colors': [], "rotate" : 0, 'color' : s.color, "type" :'shape', 'data' : s.svg, 'zindex' :  (typeof s.zindex != 'undefined' ? s.zindex : 1), 'aspectRatio' : s.aspectRatio}; //s.zindex

				$scope.initSvg(ss);
			
				$scope.logo.shapes.push(ss);
				//$scope.setGraphicsColors(ss.graphics,s.color);
			}
		});
		
		if($scope.mobilecheck == true){
			etape = 4;
			$('#redirect-login').val('/paiement/order');			
		}
		else $scope.showBar("change_icon");
		
		$scope.setEtape(3);
		$scope.align = config.align;

		$timeout(function(){
			config.shape.favoris = true;
			//$scope.addToFavoris(config);
			$scope.favoris = [];
			
			try{
				angular.forEach($scope.configs, function(c, key) {
					if(c.shape.favoris == true){
						if(c.shape.id != config.shape.id){
							//console.log('config :', c.shape.html);
							var html = c.html.replace(/g\-/g, 'fav-g-');
							var fav = {'html':html, 'config': c};
							$scope.favoris.push(fav);
						}
						
					}
				});
			}
			catch(e){
				//console.log(e);
			}
			
			$scope.currentConfig = config;
			//if($scope.favoris.length == 1) $scope.favoris = [];
			
			var shapes = $filter('filter')($scope.logo.shapes, {type: 'shape'});
			angular.forEach(shapes, function(s, key) {

			$scope.setGraphicsColors(s.graphics,s.color);

			});
			
			$scope.initStage();
			$scope.centerOnStage($scope.logo.shapes);
			$scope.initColor();
			$scope.save();
			
			if(etape == 4){
				$timeout(function(){
					$scope.generateSVG();	
					
				}, 0 );
				
			}
		}, 0 );
		if($scope.modifyTooltip == false) $scope.modifyTooltip = 0;
		$timeout(function(){
			if($scope.startTooltip == false) $scope.startTooltip = 1;
			
		}, 500 );
		
	}
	
	$scope.removeFavoris = function (config, $index)
	{
		
		$scope.favoris.splice($index,1);
		config.favoris = false; //remove
		config.shape.favoris = false;
		var d = {'id_logo' : config.shape.id,'type': config.type};
		//console.log("removeFavoris", d);
		$http({
		  method: 'GET',
		  url: '/xml/add-to-favorite',
		  params: d
		});
		
	}
	
	$scope.addToFavoris = function(config){
		
		//console.log("addToFavoris", $scope.favoris.length, config.shape.id);
		config.shape.favoris = !config.shape.favoris;
		
		
		var d = {'id_logo' : config.shape.id,'type': config.type};
		$http({
		  method: 'GET',
		  url: '/xml/add-to-favorite',
		  params: d
		});

	}
	
	$scope.initStage = function(){
		angular.forEach($scope.logo.shapes, function(shape, key) {
			$scope.initShape(shape);
		});
	}
	
	$scope.initSvg = function(shape){
		
		//var html = shape.svg != 'undefined' ? shape.svg : shape.data;
	//	var svg = $(html);
		var svg = $(shape.data); 
		
		////console.log(svg, svg.attr('width'), svg.attr('height'), svg.attr('viewBox'));

		if(shape.type == "logo" || shape.type == "shape")
		{
			shape.attr = {width:svg.attr('width'), height:svg.attr('height'), viewBox: svg.attr('viewBox') };
			var formes = svg.children();
			angular.forEach(formes, function(s, key) {
				var nodeName = $(s)[0].nodeName;
				if ( nodeName != 'linearGradient')
				{
					var colors = $scope.extractColors($(s), svg);
					var cc = angular.copy(colors); 
					angular.forEach($scope.colors, function(c, key) {
						var c = c.toLowerCase();
						if($scope.colors.indexOf(c) == -1)
						{
							$scope.colors.push(c);
						}
					});
					
				//	$scope.colors = $.merge(colors, $scope.colors);

					$(s).removeAttr('fill');
					var attr = $(s).attr();
					
					var graphic = {'svg':s.outerHTML, 'angle':90, 'colors': cc,'nodeName': nodeName,  'attr' : attr, 'innerHTML' : $(s).html()};
					shape.graphics.push(graphic);
				}
			});	
			//$scope.colors = Array.from(new Set($scope.colors));
		}
	}
	
	$scope.initShape = function(shape, force){

		//var svg = $(shape.data); 
		////console.log('initShape', shape);
		var svg = $('#shape-'+ shape.id);
	
		
		if(!shape.originalWidth) shape.originalWidth = svg[0].getBoundingClientRect().width; // svg.width(); //svg[0].getBoundingClientRect().width;
		if(!shape.originalHeight) shape.originalHeight = svg[0].getBoundingClientRect().height; //svg.height(); //svg[0].getBoundingClientRect().height;

		
		if(shape.type == "text"){
			var text = $('#text-' + shape.id);
			shape.bbox =  text[0].getBBox();
			if(force == true){
				shape.height = shape.bbox.height;
				shape.width = shape.bbox.width;
			}
			return; /* nouvelle version */
		//	$scope.calculateSize(shape);
		}
		//console.log('svg[0].getBBox()', svg[0].getBBox());
		
		//shape.width = svg.width();
		//shape.height = svg.height();
		shape.height = svg[0].getBoundingClientRect().height;
		shape.width = svg[0].getBoundingClientRect().width;
		

		
		shape.originalPosition = {"left" : shape.x, "top" : shape.y };
	
	}
	
	$scope.changeText = function(shape)
	{
			/*I guess you could replace each space by &#160; (that's the unicode non-breaking space character).

			In javascript it would be written as \u00A0 though.
			*/

		//	//console.log('chgangeText', shape.text);
		//	shape.text = shape.text.replace(' ', "\u00A0" );
			
			var h =  shape.height;
			var w = shape.width;
			
			
			

			$scope.calculateLetterSpacing(shape);
			$timeout(function(){
				
				//console.log('changeText');
				var svg = $('#shape-'+ shape.id);
				var bbox = svg[0].getBBox();
				
				ratio = shape.height / shape.originalHeight;
				shape.originalWidth = svg[0].getBoundingClientRect().width / ratio;
				shape.width = svg[0].getBoundingClientRect().width,
				$scope.save();
				
				
				//shape.x -= (shape.width - w) / 2;
			},0);
	}
	
	$scope.ngChangeText = function(shape){
		//console.log('change');
		
		/*$timeout(function(){
			$scope.setFocus($scope.activeShape);	
		});*/
	}
	
	$scope.setFocus = function(shape){
		//$timeout(function(){
			//console.log("setFocus");
			var input = $('#editing-txt-' + shape.id);
			var index = input.getCursorPosition();
			shape.text_focus = shape.text.substring(0,index);
			var width = $('#custom-txt').width();
			$scope.cursor = {'x': width + 1 * shape.ratio};
		//},0);
	}
	

	$scope.calculateSize = function(shape){
		var svg = $('#shape-'+ shape.id);
		var ratio = shape.ratio;
		//console.log(ratio);
		
		var text = $('#text-' + shape.id);
		shape.bbox =  text[0].getBBox();
			
		//shape.height = svg.height();
		//shape.orininalWidth = svg.widt /ratio;
		shape.originalWidth = svg[0].getBoundingClientRect().width / ratio; // svg.width() / ratio;
		shape.originalHeight = svg[0].getBoundingClientRect().height / ratio; // svg.height() / ratio;
		
		
	//	if(typeof shape.bbox == "undefined") 
	{
			var text = $('#text-' + shape.id);
			shape.bbox =  text[0].getBBox();
		}
		
		shape.width = svg[0].getBoundingClientRect().width;
		shape.height = svg[0].getBoundingClientRect().height;
			
	}

	$scope.changeFinitionCategorie = function(categorie)
	{
		if($scope.categorieShape !=  categorie.categorie.id)
		{
			$scope.categorieShape = categorie.categorie.id;
		}
		else  $scope.categorieShape = false;
	}
	$scope.setEtape = function(etape)
	{
		//console.log('etape', etape);
		$scope.etape = etape;	
	}
	
	$scope.changeCategorie = function(categorie, force, onlyicon)
	{
		$scope.q = null;
		$scope.lastSearch = null;
		if(categorie != $scope.lastCategorie || force == true){
			
			angular.forEach($scope.categories, function(categorie, key) {
				categorie.active = false;
			});
			categorie.active = true;
			$scope.displayIcons = [];	
			
			/* On ajoute les favoris en premier */
			
			if( typeof $scope.favoris_icons.icon != 'undefined')
			{
				angular.forEach($scope.icons_id, function(id, key) 
				{
					var icon = $scope.icons[id];
					var id_icon = Math.ceil(icon.id);
					if( $scope.favoris_icons.icon.indexOf( id_icon) != -1 )
					{
						
						icon.favoris = 1;
						$scope.displayIcons.push(icon);
					}
				});
			}
			
			
			/* recherche des logos par nom / phrase d'accroche */
			var s = $scope.companyName+ " " + $scope.phraseAccroche+" "+$scope.keyword;
			var icons = $scope.search(s, $scope.icons, false);
			for (var i=0; i<icons.length; i++){
					
					var icon = icons[i];
					if($scope.displayIcons.indexOf(icon) == -1) {
						$scope.displayIcons.push(icon);
					}
			}
			
			categorie.icons.forEach(function(id_icon){
				var icon = $scope.icons[id_icon]
				if($scope.displayIcons.indexOf(icon) == -1) {
					$scope.displayIcons.push(icon);
				}
			});
			
			/* recherche des logos par nom / phrase d'accroche */
			// recuperation des logo avec la premiere lettre 
			if($scope.companyName != $scope.default_company) {
				var letter = $scope.companyName.substring(0,1);
				var icons =  $scope.search(letter, $scope.icons, true);
	
	
				var index = 1;
				for (var i=0; i<icons.length; i++){
					
					var icon = icons[i];
					if($scope.displayIcons.indexOf(icon) == -1) {
						
						$scope.displayIcons.splice( (index * 7) - 1 , 0, icon);
						//$scope.actions.data.push(data[i]);
						index++;
					}
				}
			}
			
			//$scope.displayIcons = $scope.icons;
			if(typeof onlyicon == 'undefined') 
			{	
				$scope.generateConfigs($scope.displayIcons);
				//$scope.shuffle($scope.configs); 
				$(window).scrollTop();
			}
		}
		$scope.lastCategorie = categorie;
	}
	
	$scope.calculateLetterSpacing = function (shape){

		shape.dx = $scope.letterSpacingArray(shape.text, shape.letterSpacing);
	}
	
	$scope.inscreaseLetterSpacing = function(){
		
		var h =  $scope.activeShape.height;
		var w = $scope.activeShape.width;
			
		$scope.activeShape.letterSpacing = $scope.activeShape.letterSpacing + 1;
		$scope.calculateLetterSpacing($scope.activeShape);
		$timeout(function(){
			$scope.calculateSize($scope.activeShape);
			
				$scope.activeShape.x -= ($scope.activeShape.width - w) / 2;
				$scope.activeShape.y -= ($scope.activeShape.height - h) / 2;
		},0);
		$scope.save();
	}
	
	$scope.decreaseLetterSpacing = function(){
		if($scope.activeShape.letterSpacing > 0){
			var h =  $scope.activeShape.height;
			var w = $scope.activeShape.width;
			$scope.activeShape.letterSpacing = $scope.activeShape.letterSpacing - 1;
			$scope.calculateLetterSpacing($scope.activeShape);
			$timeout(function(){
				$scope.calculateSize($scope.activeShape);
				$scope.activeShape.x -= ($scope.activeShape.width - w) / 2;
				$scope.activeShape.y -= ($scope.activeShape.height - h) / 2;
				
			},0);
			$scope.save();
		}
	}

	$scope.calculateGuides = function (item, pos, tolerance)
	{
		var chosenGuides = { top: { dist: tolerance+1 }, left: { dist: tolerance+1 } }; 
		
		var w = item[0].offsetWidth - 1; 
		var h = item[0].offsetHeight - 1; 
		////console.log("(",w,", ",  h,")");
		var elemGuides = $scope.computeGuidesForElement( null, pos, w, h); 
		
		$.each( $scope.guides, function( i, guide ){
			$.each( elemGuides, function( i, elemGuide ){
				if( guide.type == elemGuide.type ){
					var prop = guide.type == "h"? "top":"left"; 
					var d = Math.abs( elemGuide[prop] - guide[prop] ); 
					
					////console.log('d', d);
					if( d < chosenGuides[prop].dist ){
						
						chosenGuides[prop].dist = d; 
						chosenGuides[prop].offset = elemGuide[prop] - pos[prop]; 
						chosenGuides[prop].guide = guide; 
					}
				}
			} ); 
		} );
		
		return chosenGuides;
	}

	$scope.stopResizeShape = function(e, ui)
	{
		//console.log('stop resize');	
		$scope.activeShape.x = ui.position.left + $scope.padding;
		$scope.activeShape.y = ui.position.top + $scope.padding;
		
		if($scope.tmp_resize.width){
			$scope.activeShape.width = $scope.tmp_resize.width;
			$scope.activeShape.height = $scope.tmp_resize.height;
			$scope.activeShape.ratio = $scope.tmp_resize.ratio;
		}
		

		e.preventDefault();
		e.stopPropagation();
		$scope.resizing = false;
		$scope.save();
		
	}
	
	$scope.startResizeCallback = function(e, ui) 
	{
		$('.clignoter').removeClass('clignoter');
		$scope.tmp_resize = {}
		$scope.tmp_resize.width = $scope.tmp_resize.height = $scope.tmp_resize.ratio = false;
		$scope.resizing = true;
		$scope.tmp_resize.x = $scope.activeShape.x + ($scope.activeShape.width - $scope.activeShape.originalWidth) / 2;
		$scope.tmp_resize.y = $scope.activeShape.y + ($scope.activeShape.height - $scope.activeShape.originalHeight) / 2 
	}
	
	$scope.resizeShape = function(e, ui){
		
		
		if($scope.activeShape){
			
			var shape = $scope.activeShape;
			var item = $(e.target);
			var ratioW = (ui.size.width  - 2 * $scope.padding) / $scope.activeShape.originalWidth;
			
			
			
			//$scope.$apply(function () {
					$scope.tmp_resize.ratio = ratioW;

					$scope.tmp_resize.width =  ui.size.width  - 2 * $scope.padding;

					
					if($scope.activeShape.aspectRatio === true){
						$scope.tmp_resize.height =  $scope.activeShape.originalHeight * ratioW;
					//	$scope.activeShape.height =  $scope.activeShape.originalHeight * ratioW;
						//$scope.activeShape.height = ui.size.height  - 2 * $scope.padding;
					}
					else 
					{
						//console.log("ui.size", ui.size.height);
						$scope.tmp_resize.height = ui.size.height  - 2 * $scope.padding;
					//	$scope.activeShape.height = ui.size.height  - 2 * $scope.padding;
					}
					
					var ratioH = $scope.tmp_resize.height /  $scope.activeShape.originalHeight;
					
					ui.position.left = $scope.tmp_resize.x - ($scope.tmp_resize.width - $scope.activeShape.originalWidth) / 2 - $scope.padding;
					ui.position.top = $scope.tmp_resize.y - ($scope.tmp_resize.height - $scope.activeShape.originalHeight) / 2 - $scope.padding;
					
					//$('#shape-' + $scope.activeShape.id).attr('transform', 'translate(' + (ui.position.left + $scope.padding) +","+ (ui.position.top + $scope.padding) + ") scale("+ratioW + " "+ ratioW + ') rotate('+ $scope.activeShape.rotate +')');
					
					
					var shape = $scope.activeShape;
					var left = ui.position.left + $scope.padding;
					var top = ui.position.top + $scope.padding;
					
					
					if(shape.type == "text"){
						
						top += (shape.bbox.y * -1 * ratioW);

						$('#shape-' + shape.id).attr('transform', 'translate(' + left +","+ top + ') scale('+ratioW + " "+ ratioW + ')');
						//console.log('transform', 'translate(' + left +","+ top + ") scale("+ratioW + " "+ ratioW + ')');
						//ui.height = 
						
						////console.log(ui);
					}
					else
					{
						$('#shape-' + shape.id).attr('transform', 'translate(' + (shape.symetrieX == 1 ? left : left + $scope.tmp_resize.width)  +","+ (shape.symetrieY == 1 ? top : top + $scope.tmp_resize.height) + ") scale("+ratioW * shape.symetrieX + " "+ ratioH * shape.symetrieY + ')  rotate(' + (shape.rotate * shape.symetrieX * shape.symetrieY) + ' ' + (shape.originalWidth/2) + ' ' + (shape.originalHeight / 2)+")");
					}
					ui.size.height = $scope.tmp_resize.height + 2 * $scope.padding;
					
					e.stopPropagation(); 
				
		//	});
			
		}
	}
	
	$scope.startDragCallback = function(e, ui, shape) 
	{
		//console.log('startDragCallback');
		$scope.activeShape.unplaced = false;
		$('.clignoter').removeClass('clignoter');
		//console.log('angle :', $scope.activeShape.rotate);
				
		//$scope.lastAlign = $scope.align;
		$scope.align = null;
		$scope.dragging = true;
		$scope.hasDragging = true;
		var item = $(e.target);
		var id = item.attr('data-shape')
		$('#shape-' + id).addClass('noclick');
		 
		$scope.guides = $.map( $( ".resizer:not(.active)" ).not( this ), $scope.computeGuidesForElement );
		
		
		/* calcul de la postion top et left lorqu'il y a un angle de l'angle */ 	
		if($scope.activeShape.rotate != 0)
		{
			var item = $('#resizer-' + $scope.activeShape.id);
			item.css({'transform' : 'rotate('+ 0 +'deg)'});
			var position = item.position();
			item.css({'transform' : 'rotate('+ $scope.activeShape.rotate +'deg)'});
	
	
			$scope.activeShape.tmp = {'left' : position.left - ui.position.left, 'top' : position.top - ui.position.top };
		}
	}
	
	$scope.stopDragCallback = function(e, ui)
	{
		//console.log("stopDrag");
		$timeout(function(){
			$('.clignoter').removeClass('clignoter');
		},10);
		
		$scope.selectedItems.forEach(function(shape){
			
			var item = $('#resizer-' + shape.id);

			shape.x = item.position().left + $scope.padding;
			shape.y = item.position().top + $scope.padding;// - ($scope.activeShape.font ? $scope.activeShape.font.paddingTop *  $scope.activeShape.size / $scope.FONT_SIZE_COMPANY * $scope.activeShape.ratio : 0);
			
			//var top = left = 0;
			if(typeof  $scope.activeShape.tmp != 'undefined' && $scope.activeShape.tmp)
			{
				shape.x += $scope.activeShape.tmp.left;
				shape.y += $scope.activeShape.tmp.top;
			}
			shape.originalPosition = {'left': shape.x, "top": shape.y };
		});
		$scope.activeShape.tmp = null;
		$( "#guide-v, #guide-h" ).hide(); 
		
		
		//console.log(	'dragCallback');
		if($scope.modifyTooltip == false && $scope.selectedItems.length == 1) $scope.modifyTooltip = 1;
		
		$scope.save();

	}
	
	$scope.gotoStep = function(etape){
		
		if($scope.etape > etape) $scope.etape = etape
	}
	
	$scope.nextStep = function()
	{
		//console.log('nextStep');
		if($scope.mobilecheck){
			$scope.etape = 4;
		}
		else
		{
			$scope.etape = 3;
			$scope.showBar('change_icon');
		}
	}
	
	$scope.backStep = function(){
		//console.log('backStep', $scope.etape);
		if($scope.mobilecheck){
			$scope.etape = 2;
		}
		else{
			if($scope.etape == 3){
				
				$scope.showBar('info');	
			}

			if($scope.etape > 1){
				$scope.etape = $scope.etape - 1;
				
				
				$scope.id_logo = false;
				$scope.folder = false;
				$scope.logo_url = "/images/loader-download.gif";
				
				$timeout(function(){
					if($scope.etape == 3) $scope.centerOnStage($scope.logo.shapes);	
					$('html, body').animate({scrollTop: $scope.scrollTop}, 0);
					$('.ng-presentation').trigger('reload');
	
				},0);
			}
		}
		
	}
	
	$scope.displayCategorieStep = function(){
		//console.log('displayCategorieStep');
		
		
		if(!$('.input-home').val()){
			$('.tooltip-error').fadeIn();
		} 
		else{
			$('.block-categorie').fadeIn();
			$('.block-information').hide();
			$('body').removeClass('no-info');
			$scope.text = $('.input-home').val();
			$scope.lastCategorie = false;
			
			
			
		
		}
	//	//console.log('txt : ', $scope.text,  $('.input-home') );
	}
	$scope.test = function(e){
		
		
		
		var r = getMouseEventCaretRange(e);
		$('#editing-txt-' + $scope.activeShape.id).focus();
		$('#editing-txt-' + $scope.activeShape.id).setCursorPosition(r.startOffset);
		$rootScope.editing = true;
		/*$timeout(function(){
			$scope.setFocus($scope.activeShape);
		},0);*/
		
		//console.log('dbl-click', r.startOffset, r);
		////console.log(r);
	}
	$scope.dragCallbackTest = function(e, ui){
		////console.log('ok', ui.position.left);	
		
	}
	
	$scope.dragCallback = function(e, ui){
		
		////console.log(	'dragCallback');
		$scope.startTooltip = 2;
		if($scope.selectedItems.length > 0)
		{
			//$scope.$apply(function () {
				//$scope.align = null;
				
				
				
				if( $scope.magnetisme){
					var item = $(e.target);
					var top = $scope.activeShape.font ?  $scope.activeShape.font.paddingTop * $scope.activeShape.size / $scope.FONT_SIZE_COMPANY * $scope.activeShape.ratio : 0;
						
					var pos = { top: ui.position.top  , left: ui.position.left }; 
					var chosenGuides = $scope.calculateGuides(item, pos, $scope.MIN_DISTANCE);
					
					
					if( chosenGuides.top.dist <= $scope.MIN_DISTANCE ){
						$( "#guide-h" ).css( "top", chosenGuides.top.guide.top ).show(); 
						ui.position.top = chosenGuides.top.guide.top - chosenGuides.top.offset;
						
					}
					else{
						$( "#guide-h" ).hide(); 
						ui.position.top = pos.top; 
					}
					
					if( chosenGuides.left.dist <= $scope.MIN_DISTANCE ){
						$( "#guide-v" ).css( "left", chosenGuides.left.guide.left ).show(); 
						ui.position.left = chosenGuides.left.guide.left - chosenGuides.left.offset; 
					}
					else{
						$( "#guide-v" ).hide(); 
						ui.position.left = pos.left; 
					}
				}
				
				if(typeof  $scope.activeShape.tmp != 'undefined' && $scope.activeShape.tmp)
				{
					ui.position.left += $scope.activeShape.tmp.left;
					ui.position.top += $scope.activeShape.tmp.top;
				}
				
				var decalageX = ui.position.left - ui.originalPosition.left;
				var decalageY = ui.position.top - ui.originalPosition.top;


				$scope.selectedItems.forEach(function(shape){
					var left = shape.originalPosition.left + decalageX;
					var top = shape.originalPosition.top + decalageY;
					
					

					
					if($scope.activeShape.id != shape.id){
						$('#resizer-' + shape.id).css('left', left - $scope.padding + "px");
						$('#resizer-' + shape.id).css('top', top  - $scope.padding + "px");
					}
					if(shape.type == "text"){
							$('#text-edit-' + shape.id).css('left', left + "px");
							$('#text-edit-' + shape.id).css('top', top + "px");
							top += (shape.bbox.y * -1 * shape.ratio);
							$('#shape-' + shape.id).attr('transform', 'translate(' + left +","+ top + ") scale("+shape.ratio + " "+ shape.ratio + ')');
					}
					else
					{
						if(typeof  $scope.activeShape.tmp != 'undefined' && $scope.activeShape.tmp)
						{
							left -= $scope.activeShape.tmp.left;
							top -= $scope.activeShape.tmp.top;
						}

						$('#shape-' + shape.id).attr('transform', 'translate(' + (shape.symetrieX == 1 ? left : left + shape.width)  +","+ (shape.symetrieY == 1 ? top : top + shape.height) + ") scale("+shape.width / shape.originalWidth * shape.symetrieX + " "+ shape.height / shape.originalHeight * shape.symetrieY + ')  rotate(' + (shape.rotate * shape.symetrieX * shape.symetrieY) + ' ' + (shape.originalWidth/2) + ' ' + (shape.originalHeight / 2)+")");
					}
				});

				
				
		//	});
		}
	}
	
	$scope.computeGuidesForElement = function( elem, pos, w, h ){
		var l = 0;
		var t = 0;
		if( elem != null ){
			var $t = $(elem); 
			pos = $t.offset(); 
			w = $t.outerWidth() - 1; 
			h = $t.outerHeight() - 1;
			t = $scope.top;
			l= $scope.left;
		}

		
		return [
			{ type: "h", left: pos.left - l, top: pos.top - t }, 
			{ type: "h", left: pos.left - l, top: pos.top + h - t  }, 
			{ type: "v", left: pos.left - l, top: pos.top  - t }, 
			{ type: "v", left: pos.left + w - l, top: pos.top  - t },
			// you can add _any_ other guides here as well (e.g. a guide 10 pixels to the left of an element)
			{ type: "h", left: pos.left - l, top: pos.top + h/2  - t },
			{ type: "v", left: pos.left + w/2  - l, top: pos.top  - t } 
		]; 
	}

	

	
	

	$scope.editingText = function(shape){
		
		$scope.unSelectAllItems();
		$scope.selectShape(shape)	;
		$rootScope.editing=true;
	}
	
	$scope.inscreaseSizeItem = function(value){

			var h =  $scope.activeShape.height;
			var w = $scope.activeShape.width;
			
			var nh = $scope.activeShape.height + value;
			var nw = ($scope.activeShape.width * nh) / $scope.activeShape.height;

			
			$timeout(function(){
				$scope.activeShape.ratio = nh / $scope.activeShape.originalHeight; 
				$scope.activeShape.width = nw;
				$scope.activeShape.height = nh;
				
				$scope.activeShape.x -= (nw - w) / 2;
				$scope.activeShape.y -= (nh - h) / 2;
				//$scope.calculateSize($scope.activeShape);
			},0);
			$scope.save();
	}
	

	
	$scope.setWidth = function (shape, value, keepRatio)
	{
		var ratioW = (value) / shape.originalWidth;
		shape.width = value;
		
		if(shape.aspectRatio == true || typeof keepRatio != "undefined")
		{
			//console.log('on recalcule la height');
			shape.height = shape.height * ratioW;
		}
		//console.log(shape.originalWidth, shape.originalHeight);
	}
	
	$scope.setHeight = function (shape, value)
	{
		var ratioH = (value) / shape.originalHeight;
		shape.height = value;
		
		if(shape.aspectRatio == true)
		{
			shape.width = shape.width * ratioH;
		}
		//console.log(shape.originalWidth, shape.originalHeight);
	}

	
	$scope.startRotateCallback = function(e, ui)
	{
		//console.log('startRotateCallback');
		$('.clignoter').removeClass('clignoter');
		$scope.rotating = true;
	}

	$scope.stopRotateCallback = function(e, ui)
	{
		//console.log('stoptRotateCallback');
		$scope.rotating = false;
		$scope.save();
	}

	$scope.rotateShape = function(e, ui){
		if($scope.activeShape)
		{
			$scope.$apply(function () {
				var degres = $scope.rad2deg(ui.angle.current);
				$scope.activeShape.rotate  = degres;
			});
		}
	}
	
	$scope.deg2rad = function(deg){
		var rad = (deg / 180) * Math.PI;
		return rad;
	}
	
	$scope.rad2deg = function (rad){
		var degres = rad * (180/Math.PI);
		return degres;
	}
	
	$scope.selectShape = function(shape)
	{		
		shape.originalPosition = {"left" : shape.x, "top" : shape.y };
		shape.selected = true;
		var index = $scope.selectedItems.indexOf(shape);
		
		if(index == -1) $scope.selectedItems.push(shape);
		if($scope.selectedItems.length == 1) $scope.activeShape = shape;
	}
	
	$scope.unSelectShape = function(shape)
	{
		//$scope.activeShape = shape;
		//shape.selected = false
		var index = $scope.selectedItems.indexOf(shape);
		if(index != -1) $scope.selectedItems.splice(index, 1);
		
		shape.selected = false;
	}
	
	$scope.mouseDownItem = function(e,shape){
		$timeout(function(){
			var inArray = false;
			angular.forEach($scope.selectedItems, function(s, key) {
				if(s == shape) inArray = true;
			});
			
			if(!inArray && !e.shiftKey) $scope.unSelectAllItems();
			
			
			$scope.activeShape = shape;
			if(e.shiftKey && shape.selected) $scope.unSelectShape(shape);
			else {
				$scope.selectShape(shape);
				//if($scope.selectedItems.indexOf(shape) == -1)  $scope.selectedItems.push(shape);
			}
			
			/* a  revoir  */
			if($scope.selectedItems.length == 1) $scope.showBar($scope.selectedItems[0].type);
			
			 //*/
			if(e.which == 1) $('#resizer-' + shape.id).trigger(e);
			
		},0);

	}
	$scope.force_reload = function(){
		//console.log('force_reload');
		$timeout(function(){
			$scope.loadConfig(false, false);
			$('.ng-presentation').trigger('reload');
		},0);		
	}
	
	$scope.mouseUpItem = function(e,shape){
		//console.log("mouseUpItem");
		if($scope.dragging == false && $scope.resizing == false && $scope.rotating == false) $('#resizer-' + shape.id).css('opacity', 0.5);
	}
	
	$scope.mouseOutItem = function(e,shape){
		//console.log("mouseOutItem");
		$('#resizer-' + shape.id).css('opacity', 0);
	}
	
	
	$scope.symetrieX = function(){
		$('.clignoter').removeClass('clignoter');
		if($scope.activeShape){
			
			$scope.activeShape.symetrieX = $scope.activeShape.symetrieX * -1;
			$scope.save();
		}
		
	}
	
	$scope.symetrieY = function(){
		$('.clignoter').removeClass('clignoter');
		$scope.activeShape.symetrieY = $scope.activeShape.symetrieY * -1;
		$scope.save();
	}
	
	$scope.unSelectAllItems = function()
	{
		$scope.logo.shapes.forEach(function(shape){
			shape.selected = false;
		});
		$scope.selectedItems = [];
	}
	
	$scope.addNewText = function()
	{
		var text = null;
		var i = 0;
		$scope.logo.shapes.forEach(function(shape){
			if(shape.type == "text") 
			{
				text = shape;
				i++;
			}
		});
		
		if(!text) text = {'x': 480, 'y':100,'ratio' : 1,  'height':0, 'size': FONT_SIZE_COMPANY, 'family': 'Fontastique'};
		text = angular.copy(text);
		if(i < 10){
			var txt = {"id": (++$scope.index),'text': $scope.company, 'color': (i > 0 && $scope.colors.length > 1) ? $scope.colors[1] : $scope.colors.length > 0 ? $scope.colors[0] : '#4d4d4d','family': text.family,'size': (i == 0 ? FONT_SIZE_COMPANY : FONT_SIZE_ACCROCHE), 'ratio' :1, "rotate" : 0, "type" :"text", "x":text.x,"y":text.y + text.height + 2 * $scope.padding,'zindex' : $scope.logo.shapes.length,'letterSpacing':0, 'aspectRatio' : true}
			//console.log('push', txt);
			$scope.logo.shapes.push(txt);
			$timeout(function(){
				$scope.initShape(txt, true);
				$scope.unSelectAllItems();
				$scope.selectShape(txt);
				$scope.save();
			}, 0 );
			
		}

	}
	
	$scope.hasTextOnStage = function()
	{
		var textes = $filter('filter')($scope.logo.shapes, {type: 'text'});
		return textes.length > 0;
	}
	$scope.deleteItem = function(shape, force)
	{
		$scope.deleteShape(shape,force);
		$scope.unSelectAllItems();
		var textes = $filter('filter')($scope.logo.shapes, {type: 'text'});
		if(textes.length > 0)
		{
			var text = textes[textes.length -1];
			$scope.selectShape(text);
		}
		$scope.initColor();
		//$scope.logo.shapes.splice(index, 1);
	}
	
	$scope.clickOnBackground = function()
	{
		//console.log("clickOnBackground");
		$scope.favbar = false;//vbar
		$('.pointer').css("pointer-events", 'none');
		$('.contenteditable').attr("contenteditable", "false");
	}
	
	$scope.showBar = function(type)
	{

		$scope.showEditBar = type;
		$scope.rightclic.visible = false;
		
	}
	
	$scope.editTodo = function(todo){
		todo.editing = false;
	}

	$scope.checkAllTodo = function(allchecked){
		$scope.todos.forEach(function(todo){
			todo.completed = allchecked;
		})
	}
	
	$scope.reCalc = function()
	{
		var x3 = Math.min(x1,x2);
		var x4 = Math.max(x1,x2);
		var y3 = Math.min(y1,y2);
		var y4 = Math.max(y1,y2);
		
		$scope.area.width= x4 - x3
		$scope.area.height= y4 - y3
		$scope.area.left = x3;
		$scope.area.top = y3;
		////console.log($scope.area);
	}
	
	$scope.mouseDownEditor = function(e) {
	//	//console.log('mouseDownEditor')
	
		if(e.which == 1)
		{
			div.hidden = 0;
			x1 = e.originalEvent.clientX - $scope.left;
			y1 = e.originalEvent.clientY - $scope.top;
			$scope.reCalc();
		}
	};
	
	$scope.mouseOverEditor = function(e){
		x2 = e.originalEvent.clientX - $scope.left;
		y2 = e.originalEvent.clientY - $scope.top;
		$scope.reCalc();
	}
	
	$scope.intersection = function(a, b){
		 return (a.left <= b.right &&
          b.left <= a.right &&
          a.top <= b.bottom &&
          b.top <= a.bottom);
	}
	
	$scope.mouseUpEditor = function(e){

			if($scope.modifyTooltip == 1) $scope.modifyTooltip = 2;
			$('.clignoter').removeClass('clignoter');
			//console.log('mouseUpEditor');
			$scope.colorIndex = 0;
			if(e.which == 3) return;
			
			$scope.rightclic.visible = false;
			div.hidden = 1;

			
			if($scope.dragging == false && $scope.resizing == false && $scope.rotating == false){
				
				if(e.shiftKey) {
					//console.log('Shift-Click OK');
					return;
				}

				var rect1 = {'top':$scope.area.top, 'left': $scope.area.left , 'bottom': $scope.area.top + $scope.area.height , 'right': $scope.area.left + $scope.area.width };
				
				//if($scope.area.width > 3 && $scope.area.height  > 3)
				{
				
						if(!e.shiftKey) {
							$scope.selectedItems = [];
						//	////console.log('Shift-Click');
						//	return;
						}
						
						var selectItem = [];
						angular.forEach($scope.logo.shapes, function(shape, key) {
							var ui = $('#shape-' + shape.id);
							var rect2 = {'top':ui[0].getBoundingClientRect().top - $scope.top, 'left': ui[0].getBoundingClientRect().left - $scope.left, 'bottom': ui[0].getBoundingClientRect().top + ui[0].getBoundingClientRect().height  - $scope.top , 'right': ui[0].getBoundingClientRect().left + ui[0].getBoundingClientRect().width - $scope.left };
							var intersection = $scope.intersection(rect1,rect2);
							shape.selected = intersection;
							if(intersection) {
								if(!e.shiftKey) $scope.selectShape(shape);
							}
						});
				}
				

				if($scope.selectedItems.length == 0){
					
					$scope.activeShape = null;
					if($scope.modify_id_logo == false) $scope.showBar("change_icon");
					else $scope.showEditBar=false;
					
					$rootScope.graphicShape = null;
					$rootScope.editing = false;
				}
				else if($scope.selectedItems.length == 1){
					$scope.startTooltip = 2;
					if($scope.modifyTooltip == 0) $scope.modifyTooltip = 1; 	
					
					$scope.activeShape = $scope.selectedItems[0];
					$scope.showBar($scope.activeShape.type);
					/* j'ai fait un cradre de selection et j'ia un item de selectionné */
					
					if(($scope.activeShape.type == 'shape' || ($scope.activeShape.type == 'logo')) ){
							
							//console.log('mouseUpEditor selectedItems.length == 1');
							setTimeout(function(){
								
								//console.log('$scope.activeShape.graphicShape', $rootScope.graphicShape );
								if($scope.activeShape && $rootScope.graphicShape == null){
									//console.log('mouseUpEditor setTimeout');
									$rootScope.colorShape = $scope.activeShape.graphics[0].colors;
									$rootScope.graphicShape = $scope.activeShape.graphics[0];
									$scope.colorIndex = 0;
								}
								
							}, 30); // (*)

					}
				}
				else{
					//console.log("Plusieurs items selectionné");
				//	$scope.startTooltip = false;
				}
			}
			
			//$('.pointer').css("pointer-events", 'none');
			//$('.contenteditable').attr("contenteditable", "false");
			$scope.dragging = false;
			$scope.resizing = false;
			$scope.rotating = false;
	//	}
	}

	
	$scope.doubleClickItem = function (e,shape){
		//console.log("doubleClickItem");	
	}

	$scope.clickOnItem = function(e,shape){
			
		$scope.startTooltip = 2;
		
		//console.log('click item');
		//$rootScope.editing = false;
		//$("#color-picker").spectrum("set", $scope.activeShape.color);
		////console.log($scope.activeShape.color.toLowerCase());
		if ($scope.hasDragging) {
			$scope.hasDragging = false;
		}
		else {
			if(!e.shiftKey)
			{
				
				$scope.unSelectAllItems();
				$scope.selectShape(shape);
				$scope.showBar(shape.type);
			}
		}
		e.preventDefault();
		e.stopPropagation();

	};
	
	$scope.getMaxIndex = function(){
		var zindex = 0;
		angular.forEach($scope.logo.shapes, function(shape, key) {
			zindex = Math.max(zindex,shape.zindex);
		});
		return zindex + 1;
	}
	
	$scope.getMinIndex = function(){
		var zindex = false
		angular.forEach($scope.logo.shapes, function(shape, key) {
			if(zindex === false) zindex = shape.zindex;
			zindex = Math.min(zindex, shape.zindex);
		});
		return (zindex === false) ? 0 : zindex;
	}
		
	$scope.moveItemsBack = function (shapes){
		
		var index = $scope.getMinIndex();
		angular.forEach(shapes, function(shape, key) {
			shape.zindex = index -1;
			//console.log('mise en arriere de ', shape.id, shape.zindex);
		});
		$scope.rightclic.visible = false;
	}
	
	$scope.moveItemsFront = function (shapes){
		
		var index = $scope.getMaxIndex();
		angular.forEach(shapes, function(shape, key) {
			shape.zindex = index +1;
			//console.log('mise en avant de ', shape.id, shape.zindex);
		});
		$scope.rightclic.visible = false;
	}
	
	$scope.inverseMagnetism = function()
	{
		//console.log('inverseMagnetism');
		$scope.magnetisme = !$scope.magnetisme;
		if($scope.magnetisme) $( ".resizer" ).draggable( "option", "snap", '.resizer:not(active)' );
		else  $( ".resizer" ).draggable( "option", "snap", false );
		$scope.rightclic.visible = false;
	}
	
	$scope.editTextShape = function(shape)
	{	
		//$('#div-txt-' + shape.id).trigger( "dblclick" );
		$rootScope.editing = true;
		$('#div-txt-' + shape.id).attr("contentEditable", true);
		$('#div-txt-' + shape.id).focus();
		$scope.rightclic.visible = false;
	}
	
	$scope.moveSelectedItem = function (x, y){
		
		//if($scope.logo.shapes.length != $scope.selectedItems.length) $scope.align = null;
		$scope.selectedItems.forEach(function(shape){
			
			//shape.box.left += x	
			shape.x += x; 
			//shape.box.top += y	
			shape.y += y; 
			
		});
	}
	
	$scope.deleteShapes = function(shapes)
	{
		angular.forEach(shapes, function(shape, key) {
			$scope.deleteShape(shape);
		});
		$scope.rightclic.visible = false;
		//console.log('deleteShapes')
		$timeout(function(){
			$scope.centerOnStage($scope.logo.shapes);
		}, 0 );	
		
		if(!$scope.modify_id_logo) $scope.showBar('change_icon');
		else $scope.showBar(false);
		
		
	}
	
	$scope.deleteGraphicShape = function(shape, g)
	{
		/*angular.forEach(shapes, function(shape, key) {
			$scope.deleteShape(shape);
		});
		*/
		var index = $scope.activeShape.graphics.indexOf(g);
		if(index != -1)
		{
			 //console.log('deletegraphics');
			 $scope.activeShape.graphics.splice(index,1);
			 $rootScope.graphicShape = null;
			 $scope.save();	
		}
		$scope.rightclic.visible = false;
	}
	
	$scope.deleteShape = function(shape, force)
	{
		var index = $scope.logo.shapes.indexOf(shape);
		if(index != -1 && ($rootScope.editing == false || force == true)) {
			$scope.logo.shapes.splice(index, 1);
		}
	}
	
	$scope.replaceShape = function(newShape, oldShape)
	{
		var needToReplace = false;
		if($scope.modifyTooltip == 1) $scope.modifyTooltip = 2;
		
		if(oldShape == false)
		{
			var l = $filter('filter')($scope.logo.shapes, {type: 'logo'})[0];
			if(l) {
				oldShape = l;
				oldShape.unplaced = l.unplaced;
				needToReplace = true;
			}
			else{
				
				var noLogo = true;
				var p = ($('#svg-editor-canvas').height() - 150) / 2;
				
				oldShape = {"id": ++($scope.index), 'ratio' : 1,  "symetrieX" : 1, "symetrieY" : 1, "x": 350,"y":p, 'zindex' : 1, 'width': 150, "type": 'logo', 'unplaced': true};

			}
			
		}
		if(oldShape.type == "logo") {
			newShape.aspectRatio = true;
			newShape.id_categorie = false;
		}
		//console.log("newShape", newShape);
		
		var s = {"id": oldShape.id, 'shape_id': newShape.id, 'ratio' : oldShape.ratio,  'id_categorie' : newShape.id_categorie,'graphics': [],'type_shape': newShape.type, "symetrieX" : oldShape.symetrieX, "symetrieY" : oldShape.symetrieY, 'colors': [], "rotate" : 0, "type" :oldShape.type, "x": oldShape.x,"y":oldShape.y, 'data' : newShape.svg, 'zindex' : oldShape.zindex, 'aspectRatio' : newShape.aspectRatio, 'unplaced': typeof oldShape.unplaced !='undefined' ? oldShape.unplaced : false };
		
		if(s.type == "logo") s.id_icon = newShape.id;
		$scope.initSvg(s);
		
		var index = $scope.logo.shapes.indexOf(oldShape);
		if(index != -1) {
			//console.log('on replace la forme');
			$scope.logo.shapes[index].unbindWatcher();
			$scope.logo.shapes[index].unbindWatcher1();
			delete $scope.logo.shapes[index];
			$scope.logo.shapes.splice(index, 1);
			$scope.logo.shapes.splice(index, 0, s)
		}
		else{
			$scope.logo.shapes.push(s);
		}
		
		if(s.type != "logo") 
		{
			
			$scope.setGraphicsColors(s.graphics,oldShape.graphics[0].colors[0], false);
		}
					
		$timeout(function(){
				$scope.initStage();
				$scope.setWidth(s, oldShape.width,1);
				//oldShape.height = s.height;
				if(s.type != "logo")
				{
					//$scope.setGraphicsColors(s.graphics,oldShape.graphics[0].colors[0]);
					
					$rootScope.colorShape = s.graphics[0].colors;
					$rootScope.graphicShape = s.graphics[0];
					$scope.colorIndex = 0;
					$scope.unSelectAllItems();
					$scope.selectShape(s);
					$scope.showBar(s.type);
				}
				else{
					if(oldShape.type == "logo") {
						if(needToReplace == true)	s.y = s.y - s.height + oldShape.height ;
						else s.y = 250;
						/* on calcule le X */
					}
					$scope.unSelectAllItems();
					$scope.showBar("change_icon");
					
				}
				$scope.initColor();

				$scope.centerOnStage($scope.logo.shapes);
				$scope.save();
		}, 0 );
		
	}
	
	
	angular.element(window).on('keydown', function($event) {
		$scope.$apply(function () {
			
			if($rootScope.editing == false && $scope.etape == 3){
				if ($event.keyCode == 38){$scope.moveSelectedItem(0,-1);}
				else if ($event.keyCode == 39){$scope.moveSelectedItem(1,0)}
				else if ($event.keyCode == 40){$scope.moveSelectedItem(0,1);}
				else if ($event.keyCode == 37){$scope.moveSelectedItem(-1,0);}
				else if ($event.keyCode == 37){$scope.moveSelectedItem(-1,0);}
	
				 else if( $event.which === 90 && $event.ctrlKey ){
					 //console.log('control + z'); 
					 $scope.undo();
				  } 
				  else if( $event.which === 89 && $event.ctrlKey ){
					 //console.log('control + Y'); 
					 $scope.redo();
				  } 
				  else if( $event.keyCode == 46){
					  
					 $scope.deleteShapes($scope.selectedItems);
					 
					/* angular.forEach($scope.selectedItems, function(shape, key) {
						  //console.log('Suppr:', shape); 
						 $scope.deleteShape(shape);
					 });*/
					 $scope.unSelectAllItems();

					
					 
					/* else if($scope.info_logo.paid == false) $scope.showBar('change_icon');
					 else  $scope.showBar(false);*/
				  } 
			  }
		});
    });
	      
	$scope.changeTextColor = function(color)
	{
		$scope.activeShape.color=color ;
		$scope.save();
	}
	
	$scope.changeColorIndex = function(index)
	{
		$scope.colorIndex = index;
	}

	$scope.changeGraphicColor = function (color, save)
	{
			$scope.modifyTooltip = 2;
			//console.log("changeGraphicColor", $scope.colorIndex, $rootScope.colorShape[$scope.colorIndex]);
			/* remove focus */
			if($('input').is(':focus')){
				$('input').blur();
			}
			$rootScope.colorShape[$scope.colorIndex] = angular.copy(color);
			$scope.initColor();
			if(save) $scope.save();
	}
	
	$scope.dragstopColorPicker = function(e,color,rgb){
		$scope.$apply(function () {
			// il faut recalculer le tableu de colors
			$scope.initColor();
		});
		$scope.save();
	}

	$scope.initColor = function(){
		$scope.colors = [];
		angular.forEach($scope.logo.shapes, function(shape, key) {
			if(shape.type == "text") 
			{
				var color = shape.color.toLowerCase();
				if($scope.colors.indexOf(color) == -1)
				{
					 
					 $scope.colors.push(color);
				}
			}
			else{
				angular.forEach(shape.graphics, function(graphic, key) {
					angular.forEach(graphic.colors, function(color, key) {
						color = color.toLowerCase();
						if($scope.colors.indexOf(color) == -1){
							$scope.colors.push(color);
						}
					});
				});
			}
		});
	}

	
	$scope.checkBoxDegradeClick = function()
	{
			//$scope.activeShape.degrade = !$scope.activeShape.degrade;
			
			//console.log('degradé click');
			
			if($rootScope.colorShape.length == 1)
			{
				//console.log('on ajoute une couleur');
				$rootScope.colorShape[1] = $scope.ColorLuminance($rootScope.colorShape[0], -0.30);	// "#7ab8f5" - 20% lighter
				$scope.colorIndex = 1;
			}
			else
			{
				if($rootScope.colorShape.length > 1)
				{
					//console.log('on supprime une couleur');
					$rootScope.colorShape.splice(1,1);
					$scope.colorIndex = 0;
				}
			}
			$scope.initColor();
	}
	
	$scope.ColorLuminance = function (hex, lum) {

		// validate hex string
		hex = String(hex).replace(/[^0-9a-f]/gi, '');
		if (hex.length < 6) {
			hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
		}
		lum = lum || 0;
	
		// convert to decimal and change luminosity
		var rgb = "#", c, i;
		for (i = 0; i < 3; i++) {
			c = parseInt(hex.substr(i*2,2), 16);
			c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
			rgb += ("00"+c).substr(c.length);
		}
	
		return rgb;
	}
	
	$scope.openFontPalette = function(){
		$scope.showBar('font');
		$scope.tmpFont = angular.copy($scope.activeShape.family);

	}
	
	$scope.blurFont = function(font){
		$scope.activeShape.family = $scope.tmpFont;
		$timeout(function(){
			/*shape.bbox.y = 0;*/
			var text = $('#text-' + $scope.activeShape.id);
			var bb =  text[0].getBBox();
			//console.log('bbox over', bb);
			$scope.calculateSize($scope.activeShape);
		},0);
	}
	
	$scope.changeFont = function(font)
	{
		//console.log(font);
		$scope.activeShape.family = font.family;
		$timeout(function(){
			/*shape.bbox.y = 0;*/
			$scope.calculateSize($scope.activeShape);
		},0);
	}
	
	$scope.clickOnFont = function(font){
		//console.log("//console.log($scope.activeShape);", $scope.activeShape);
		$scope.activeShape.family = font.family;
		$scope.tmpFont = font.family;
		$scope.showBar('text');
		$scope.calculateSize($scope.activeShape);
		$scope.save();
	}
	
	
	$scope.inscreaseSize = function(){
		//$scope.activeShape.ratio.w = ($scope.activeShape.width + 5)  / $scope.activeShape.width;
		//$scope.activeShape.ratio.h = $scope.activeShape.ratio.w
		$scope.activeShape.width+= 5;
		
	}
	

	
	$scope.save = function(){
		
		$scope.history.splice($scope.saveIndex + 1); // on supprimer toutes les sauvegarde apres $scope.saveIndex
		var save =  angular.copy($scope.logo);
		$scope.history.push(save);
		$scope.saveIndex = ($scope.history.length - 1);
	}
	
	$scope.selectShapeUndoRedo = function(){
		var count = 0;
		var s = false;
		angular.forEach($scope.logo.shapes, function(shape, key) {
			if(shape.selected == true){
				 s = shape;	
				 count++;
			}
		});
		if(count == 1 && s) {
			//
			$scope.unSelectAllItems();
			$scope.activeShape = s;
			$scope.selectShape(s);
			
			$scope.showBar(s.type);
		}
		else{
			$scope.showBar('change_icon');
		}
	}
	$scope.undo = function(){

		if($scope.saveIndex  > 0 ){
			$scope.activeShape = null;
			//$scope.showBar('change_icon');
			//$scope.showEditBar = false;
			$scope.saveIndex = $scope.saveIndex - 1;
			
			var shapes = $filter('filter')($scope.logo.shapes, {type: 'shape'});
			angular.forEach(shapes, function(shape, key) {
				shape.unbindWatcher();
				shape.unbindWatcher();
			});
			var save = $scope.history[$scope.saveIndex];
			$scope.logo = save;	
			$scope.initColor();
			$scope.selectShapeUndoRedo();
		}
		$scope.rightclic.visible = false;
		
	}
	
	$scope.redo = function(){
		if($scope.saveIndex  <  ($scope.history.length - 1)){
			
			//$scope.showBar('change_icon');
			//$scope.showEditBar = false;
			$scope.activeShape = null;
			$scope.saveIndex = $scope.saveIndex + 1;
			var shapes = $filter('filter')($scope.logo.shapes, {type: 'shape'});
			angular.forEach(shapes, function(shape, key) {
				shape.unbindWatcher();
				shape.unbindWatcher1();
			});
			var save = $scope.history[$scope.saveIndex];
			$scope.logo = save;
			$scope.initColor();
			$scope.selectShapeUndoRedo();
		}
		$scope.rightclic.visible = false;
	}
	
	
	

	$scope.rgb2hex = function(rgb) {
	 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	// //console.log('rgb : ', rgb);
	 return "#" + $scope.hex(rgb[1]) + $scope.hex(rgb[2]) + $scope.hex(rgb[3]);
	}

	$scope.hex = function(x) {
  		var hexDigits = new Array ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 
		return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
 	}
	
	
	/*
		Gestion des alignements
	
	*/
	


	
	$scope.setOriginalPosition = function (shapes)
	{
		angular.forEach(shapes, function(shape, key) {
			shape.originalPosition.left = shape.x;
			shape.originalPosition.top = shape.y;
		});
	}
	
	$scope.centerOnStage = function(shapes)
	{
		minX = Infinity;
		minY = Infinity;
		maxX = 0;
		maxY = 0;
		angular.forEach(shapes, function(shape, key) {
			
			//console.log(shape.unplaced);
			if(typeof shape.unplaced == 'undefined' || shape.unplaced == false){
				minX = Math.min(minX, shape.x);
				minY = Math.min(minY, shape.y);
				
				
				maxX = Math.max(maxX, shape.x + shape.width);
				maxY = Math.max(maxY, shape.y + shape.height);
				//console.log(shape.id, minX, maxX, minY, maxY);
			}
			
		});

		var left = 74;
		var top = 50;
		var minLeft = Infinity;

		var sideBarWidth = $scope.modify_id_logo ? 0 : 240;
		
		angular.forEach(shapes, function(shape, key) {
			if(typeof shape.unplaced == 'undefined' || shape.unplaced == false){
				shape.x =  $scope.left + shape.x - minX + (($('#svg-editor-canvas').width() + left + sideBarWidth) - (maxX - minX)) / 2;
				minLeft = Math.min(minLeft, shape.x);
				shape.y =  $scope.top + shape.y  - minY + (($('#svg-editor-canvas').height() + top) - (maxY - minY)) / 2;
			}
		});
		var minPadding = 380;
		if(minLeft < 380)
		{
			angular.forEach(shapes, function(shape, key) {
				if(typeof shape.unplaced == 'undefined' || shape.unplaced == false) shape.x += $scope.left + minPadding - minLeft;
				
			});
		}
		
		var logo_height = (maxY - minY);
		
		
		$scope.tooltipY = ($('#svg-editor-canvas').height() - logo_height) /2 - $('#tooltip-start').height() - 50;
		$scope.tooltipY = $scope.tooltipY < 55 ? 55 : $scope.tooltipY;
		
		//console.log("height : ",  (maxY - minY));
	}
	
	
	
	$scope.getLogo = function()
	{
		var logo = $filter('filter')($scope.logo.shapes, {type: 'logo'})[0];
		if(logo) return logo;
		return null;	
	}

	$scope.isColorDark = function (hex)
	{
		var color = $scope.hex2rgb(hex);
		if(!color) return false;
		var  darkness = 1-(0.299*color.red + 0.587*color.green + 0.114*color.blue)/255;
		if(darkness < 0.5){
			return false; // It's a light color
		}else{
			return true; // It's a dark color
		}
		
	}
		
	$scope.hex2rgb = function (hex){
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		return result ? {
			red: parseInt(result[1], 16),
			green: parseInt(result[2], 16),
			blue: parseInt(result[3], 16)
		} : null;
	}
	
	$scope.setGraphicsColors = function(graphics,color, apply){
		
		if(typeof apply == "undefined"){
			$scope.$apply(function(){
				angular.forEach(graphics, function(g, key) {
					$rootScope.graphicShape = g;
					g.colors = [color];
				});
			});
		}
		else{
			angular.forEach(graphics, function(g, key) {
					$rootScope.graphicShape = g;
					g.colors = [color];
			});
		}
		$rootScope.graphicShape = null;
	}
	
	$scope.placeUnplacedShape = function()
	{
		var column = 3;
		var left = l = 350;
		var maxWidth = 220;
		var top = 80;
		var height = 0;
		var width = 0;
		var shapes = $filter('filter')($scope.logo.shapes, {unplaced: true});	
		angular.forEach(shapes, function(shape, key) {
			
			if((width + shape.width) > maxWidth){
				//console.log('(width + shape.width) > maxWidth', (width + shape.width), maxWidth);
				l = left;
				top += height + 2 * $scope.padding;
				height = 0;
				width = 0;
			}
			shape.x = l;
			l += shape.width + 2 * $scope.padding;
			height = Math.max(height, shape.height);
			shape.y = top;
			
			width += shape.width + 2 * $scope.padding;
		});
	}
	
	$scope.cleanNode = function (node){
		
		node.removeAttr('class');	
		node.removeClass (function (index, className) {
			return (className.match (/\ng-\S+/g) || []).join(' ');
		});
		
		return node;
	}
	
	$scope.getDefaultTuto = function(){	
		for (var i=0; i<$scope.tutos.length; i++){
				var tuto = $scope.tutos[i];
				if(tuto.default == 1) {
					return tuto;
				}
		}
		return false;
	}
	
	$scope.setActiveTuto = function(tuto){
		$scope.activeTuto = tuto;	
	}
	
	$scope.calculateBoxes = function(){
		angular.forEach($scope.logo.shapes, function(shape, key) {
			if(shape.type == "text"){
				
				var text = $('#text-' + shape.id);
				shape.bbox =  text[0].getBBox();	
				//console.log('shape.bbox', shape.bbox);
				$scope.calculateLetterSpacing(shape);
			}
		});
	}
	
	$scope.hideTooltipModif = function(){
		if( $scope.modifyTooltip==1) $scope.modifyTooltip=2;
	}
	
	$scope.generateSVG = function(){
		
		var svgCanvas = $('#svg-editor-canvas');

		$scope.infoTooltip = 2;
		$scope.startTooltip = 2;
		$scope.modifyTooltip = 2;
		$scope.etape = 2;
		if($scope.saving == true) return;
		$scope.saving = true;
		//var w = $('.logo-container-svg').width();
		//var h = $('.logo-container-svg').height();
		//console.log('generateSVG');
		var svgCanvas = $('#svg-engine');
		var position = svgCanvas.position();
		
		var width = Math.ceil(svgCanvas[0].getBoundingClientRect().width);
		var height = Math.ceil(svgCanvas[0].getBoundingClientRect().height);
		
		minX = svgCanvas[0].getBoundingClientRect().left;
		minY = svgCanvas[0].getBoundingClientRect().top;
		
		//console.log("position", position, width, height);
		
		if(!$scope.redirect) $scope.etape = 4;
		else{
			$scope.loadingRedirect = true;	
		}

		angular.forEach($scope.logo.shapes, function(shape, key) {
			shape.x =  shape.x - minX;
			//minLeft = Math.min(minLeft, shape.x);
			shape.y = shape.y  - minY;
		});
		
		
		$timeout(function(){
			
			var html =  $('#full-container-svg').html();
			
			
			var reg2=/<g id="svg-engine">(.+)<\/g>/gm;
			var matches = reg2.exec(html);
			if(matches){
				html = matches[1];
			}

			
			//console.log('logo = $filter');
			var logo = $filter('filter')($scope.logo.shapes, {type: 'logo'})[0];
			var texts = $filter('filter')($scope.logo.shapes, {type: 'text'});
			var name = texts.length > 0 ? texts[0].text : '';
			var accroche = texts.length > 1 ? texts[1].text : '';
			var additionnal = texts.length > 2 ? texts[2].text : '';
			
			var fonts = []
			angular.forEach(texts, function(t, key) {
				if(fonts.indexOf(t.family) == -1) fonts.push(t.family);
			});
			
			var id_icon = (logo) ? logo.id_icon: null;
			var id_logo = $scope.modify_id_logo ? $scope.modify_id_logo : false;
			var serializedData = { 'svg' : html, 'data': JSON.stringify($scope.logo), 'width': width, 'background': $scope.backgroundColor,  'height' : height, 'id_logo': id_logo, 'id_icon': id_icon,'name':name, 'accroche' : accroche, 'additionnal' : additionnal, 'colors' : JSON.stringify($scope.colors), 'fonts': fonts};	
			
			angular.forEach($scope.logo.shapes, function(shape, key) {
				shape.x =  shape.x + minX;
				shape.y = shape.y  + minY;
			});
		
			//console.log('serializedData');
			request = $.ajax({
				url: "/v2/save-logo",
				type: "post",
				data: serializedData,
				dataType: "json"
			});
			 
			//console.log('$.ajax');
			request.done(function (response, textStatus, jqXHR){
				 $scope.$apply(function(){
					 $scope.redirectSoon = true;
                    $scope.saving = false;
					$scope.previewUrl = response.url;
					$scope.folder = response.folder;
					$scope.id_logo = response.id_logo;
					$scope.logo_url = "/download/preview/engine/" + response.id_logo;
					
					if($scope.redirect) {
						//console.log('$scope.redirect');
						$(location).attr('href', $scope.redirect);
					}
					else{
						if($scope.modify_id_logo && response.paid == 1){
							$('#btn-go-paiement').attr('href', '/users/');
						}
					}
					
					
				 });
			});
		
			// Callback handler that will be called on failure
			request.fail(function (jqXHR, textStatus, errorThrown){
				// Log the error to the console
				console.error(
					"The following error occurred: "+
					textStatus, errorThrown
				);
			});
	
		},0);
		return;
		
	}
	
	$scope.addShape = function(shape){
		
		var min = 100;
		var max = 200;

		var random = Math.floor(Math.random() * (max - min + 1)) + min;
		

		var s = {"id": (++$scope.index), 'ratio':1, 'shape_id': shape.id, 'id_categorie' : shape.id_categorie,'graphics': [],'type_shape': shape.type, "symetrieX" : 1, "symetrieY" : 1, 'colors': [],"rotate" : 0, "type" :"shape", "x":280,"y":140, 'data' : shape.svg, 'zindex' : ($scope.index + 1), 'aspectRatio' : shape.aspectRatio};
		$scope.initSvg(s);
		$scope.logo.shapes.push(s);
		$timeout(function(){
			$scope.initShape(s);
			var textes = $filter('filter')($scope.logo.shapes, {type: 'text'});
			var shapes = $filter('filter')($scope.logo.shapes, {type: 'shape'});
			var formes = {};
			angular.forEach(shapes, function(f, key) {
				if(typeof formes[f.type_shape] == 'undefined') formes[f.type_shape] = [shape];
				else formes[f.type_shape].push(f);
			});
			var item = $('#shape-' + random);
			
			if(shape.type == 'detail'){
								
				
				if(typeof formes[s.type_shape] != 'undefined')
				{
					//console.log("shape.type == 'detail'");
					if((formes[s.type_shape].length % 2 == 0)) s.symetrieX = -1;	
				}
				var index = Math.floor((formes['detail'].length - 1) / 2);
				if(typeof textes[index] != 'undefined')
				{
					var text = textes[index];
					$scope.setGraphicsColors(s.graphics,text.color);
					s.y = text.y + ( text.height - s.height) / 2;
					if(formes['detail'].length % 2 == 1){
						s.x = text.x - s.width -  2 * $scope.padding;
					}
					else{
						s.x = text.x + text.width + 2 * $scope.padding;
					}
				}
				else{
					s.unplaced = true;
					if(typeof textes[0] != 'undefined'){
						var text = textes[0];
						$scope.setGraphicsColors(s.graphics,text.color);
					}
				}
			
			}
			
			else if(shape.type == 'ligne'){
				
				var index = formes['ligne'].length - 1;
				if(typeof textes[index] != 'undefined')
				{
					var text = textes[index];
					//console.log('index', index, formes, text);
					s.x = text.x;
				//	s.y = text.y + text.height - text.font.paddingBottom  * (text.size / $scope.FONT_SIZE_COMPANY) * text.ratio + 20 - ;
					
					
					$scope.setWidth(s, text.width);
					
					var padding = typeof text.font != 'undefined' ? text.font.paddingBottom : 0;
					////console.log('ff', text.font.paddingBottom , text.size, $scope.FONT_SIZE_COMPANY, text.ratio, s.height);
					s.y = text.y + text.height - padding  * (text.size / $scope.FONT_SIZE_COMPANY) * text.ratio + (20 - s.height) /2;
					
					$scope.setGraphicsColors(s.graphics,text.color);

				}
				else{
					s.unplaced = true;
					if(typeof textes[0] != 'undefined'){
						var text = textes[0];
						$scope.setGraphicsColors(s.graphics,text.color);
					}
				}
			}
			else if(shape.type == 'forme'){
				
				s.unplaced = true;	
				s.zindex = $scope.getMinIndex() - 1;
				$scope.setWidth (s, 150, 1);
				if(typeof textes[0] != 'undefined'){
						var text = textes[0];
						$scope.setGraphicsColors(s.graphics,text.color);
				}
			}
			else
			{
				s.unplaced = true;	
				if(typeof textes[0] != 'undefined'){
					var text = textes[0];
					$scope.setGraphicsColors(s.graphics,text.color);
				}
			}
			//console.log(s.graphics);
			$rootScope.colorShape = s.graphics[0].colors;
			$rootScope.graphicShape = s.graphics[0];
				
			//$rootScope.colorShape = s.graphics[0];
			$scope.colorIndex = 0;
			
			$scope.unSelectAllItems();
			$scope.selectShape(s);
			$scope.showBar(s.type);
			
			$scope.placeUnplacedShape();
			$scope.save();
		},0);
	}
	$(document).unbind('keydown').bind('keydown', function (event) {
			if (event.keyCode === 8) {
				var doPrevent = true;
				var types = ["text", "password", "file", "search", "email", "number", "date", "color", "datetime", "datetime-local", "month", "range", "search", "tel", "time", "url", "week"];
				var d = $(event.srcElement || event.target);
				var disabled = d.prop("readonly") || d.prop("disabled");
				if (!disabled) {
					if (d[0].isContentEditable) {
						doPrevent = false;
					} else if (d.is("input")) {
						var type = d.attr("type");
						if (type) {
							type = type.toLowerCase();
						}

						if (types.indexOf(type) > -1) {
							doPrevent = false;
						}
					} else if (d.is("textarea")) {
						doPrevent = false;
					}
				}
				if (doPrevent) {
					if($scope.etape == 3) $scope.deleteShapes($scope.selectedItems);
					//$(window).redraw();
					//event.preventDefault();
					//return false;
				}
			}
		});
	
	
	window.onbeforeunload = function(e) {
		
		var t = $(e.target);
		var c = t.attr('confirm');
		
		var ok = $('#changeUrl').val();
		if(ok == 1) return ;
		if(!$scope.redirectSoon) return "Vous êtes en train de créer un logo. Si vous quittez cette page, il ne sera pas sauvegardé.";
		
		
	}

	$(window).resize(function(e){

		$scope.$apply(function(){
			if($scope.etape == 3)  $scope.centerOnStage($scope.logo.shapes);
		});

	});
	

});