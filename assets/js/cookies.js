(function (window, undefined){
	"use strict";
	
	var document = window.document;
	
	function log() {
		if (window.console && window.console.log) {
			for (var x in arguments) {
				if (arguments.hasOwnProperty(x)) {
					window.console.log(arguments[x]);
				}
			}
		}
	}
	
	function AcceptCookie() {
		if (!(this instanceof AcceptCookie)) {
			return new AcceptCookie();
		}
				
		this.init.call(this);
		
		return this;
	}
	
	AcceptCookie.prototype = {
		
		init: function () {
			var self = this;
			
			if(self.readCookie('pjAcceptCookie') == null)
			{
				self.appendCss();
				self.addCookieBar();
			}
			
			var clear_cookie_arr = self.getElementsByClass("pjClearCookie", null, "a");
			if(clear_cookie_arr.length > 0)
			{
				self.addEvent(clear_cookie_arr[0], "click", function (e) {
					if (e.preventDefault) {
						e.preventDefault();
					}
					self.eraseCookie('pjAcceptCookie');
					document.location.reload();
					return false;
				});
			}
		},
		getElementsByClass: function (searchClass, node, tag) {
			var classElements = new Array();
			if (node == null) {
				node = document;
			}
			if (tag == null) {
				tag = '*';
			}
			var els = node.getElementsByTagName(tag);
			var elsLen = els.length;
			var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
			for (var i = 0, j = 0; i < elsLen; i++) {
				if (pattern.test(els[i].className)) {
					classElements[j] = els[i];
					j++;
				}
			}
			return classElements;
		},
		addEvent: function (obj, type, fn) {
			if (obj.addEventListener) {
				obj.addEventListener(type, fn, false);
			} else if (obj.attachEvent) {
				obj["e" + type + fn] = fn;
				obj[type + fn] = function() { obj["e" + type + fn](window.event); };
				obj.attachEvent("on" + type, obj[type + fn]);
			} else {
				obj["on" + type] = obj["e" + type + fn];
			}
		},
		createCookie: function (name, value, days){
			var expires;
		    if (days) {
		        var date = new Date();
		        date.setTime(date.getTime()+(days*24*60*60*1000));
		        expires = "; expires="+date.toGMTString();
		    } else {
		        expires = "";
		    }
		    document.cookie = name+"="+value+expires+"; path=/";
		},
		readCookie: function (name) {
		    var nameEQ = name + "=";
		    var ca = document.cookie.split(';');
		    for(var i=0;i < ca.length;i++) {
		        var c = ca[i];
		        while (c.charAt(0) === ' ') {
		            c = c.substring(1,c.length);
		        }
		        if (c.indexOf(nameEQ) === 0) {
		            return c.substring(nameEQ.length,c.length);
		        }
		    }
		    return null;
		},
		eraseCookie: function (name) {
			var self = this;
			self.createCookie(name,"",-1);
		},
		appendCss: function()
		{
			var self = this;
			var cssId = 'pjAcceptCookieCss';
			if (!document.getElementById(cssId))
			{
			    var head  = document.getElementsByTagName('head')[0];
			    var link  = document.createElement('link');
			    link.id   = cssId;
			    link.rel  = 'stylesheet';
			    link.type = 'text/css';
			    link.href = 'https://fonts.googleapis.com/css?family=Open+Sans';
			    link.media = 'all';
			    head.appendChild(link);
			}
			
			var cssCode = "";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarBtn,";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarBtn:after { -webkit-transition: all .5s ease-in-out; -moz-transition: all .5s ease-in-out; -ms-transition: all .5s ease-in-out; -o-transition: all .5s ease-in-out; transition: all .5s ease-in-out; }";
			cssCode += "#pjAcceptCookieBar { position: fixed; bottom: 0; left: 0; z-index: 9999; overflow-x: hidden; overflow-y: auto; width: 100%; max-height: 100%; padding: 30px 0; background: #404040; font-family: 'Open Sans', sans-serif; text-align: center; }";
			cssCode += "#pjAcceptCookieBar * {text-align: left; padding: 0; margin: 0; outline: 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarShell { width: 96%; margin: 0 auto; text-align: left;}";
			cssCode += "#pjAcceptCookieBar a[href^=tel] { color: inherit; }";
			cssCode += "#pjAcceptCookieBar a:focus,";
			cssCode += "#pjAcceptCookieBar button:focus { outline: unset; outline: none; }";
			cssCode += "#pjAcceptCookieBar p { font-size: 13px; line-height: 1.4; color: #fff; font-weight: 400; margin-bottom:15px; }";
			cssCode += "#pjAcceptCookieBar p a { color: #fff; text-decoration:underline;}";
			cssCode += "#pjAcceptCookieBar p strong { font-size: 16px;}";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarActions { padding-top: 10px; }";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarBtn {margin-left: 25px; margin-bottom: 25px; position: relative; display: inline-block; height: 46px; padding: 0 30px; border: 0; background: #fff; font-size: 18px; line-height: 44px; color: #000000; text-decoration: none; vertical-align: middle; cursor: pointer; border-radius: 0; -webkit-appearance: none; -webkit-border-radius: 0; -webkit-transform: translateZ(0); transform: translateZ(0); -webkit-backface-visibility: hidden; backface-visibility: hidden; -moz-osx-font-smoothing: grayscale; }";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarBtn:hover,";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarBtn:focus { text-decoration: none; }";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarBtn:after { position: absolute; top: 0; right: 52%; bottom: 0; left: 52%; z-index: -1; border-bottom: 4px solid #14428d; background: rgba(20, 66, 141, .3); content: ''; }";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarBtn:hover:after,";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarBtn:focus:after { right: 0; left: 0; }";
			cssCode += "@media only screen and (max-width: 767px) {";
			cssCode += "#pjAcceptCookieBar { padding: 15px 0; }";
			cssCode += "#pjAcceptCookieBar .pjAcceptCookieBarShell { width: 96%; }";
			cssCode += "#pjAcceptCookieBar p { font-size: 16px; }";
			cssCode += "}";
			
			var styleElement = document.createElement("style");
			styleElement.type = "text/css";
			if (styleElement.styleSheet) {
			    styleElement.styleSheet.cssText = cssCode;
			} else {
				styleElement.appendChild(document.createTextNode(cssCode));
			}
			document.getElementsByTagName("head")[0].appendChild(styleElement);
		},
		addCookieBar: function(){
			var self = this;
			var htmlBar = '';
			
			htmlBar += '<div class="pjAcceptCookieBarShell">';
			htmlBar += '<form action="#" method="post">';
					htmlBar +=
					'<div class="cookies-modal-body">'+
					'<div class="m-b-20 cookies-div">'+
					'<p>At Moonstone Plates, we want to ensure that your visit to our site is smooth, reliable and as useful to you as possible. To help us do this, we use cookies.</p>'+
					'<p><strong>What are cookies?</strong></p>'+
					'<p>Cookies are small bits of information that are placed on your computer or mobile device when you visit almost any website. Cookies do not recognise you personally and are not harmful to your computer or mobile device. They are used by websites you visit in order to improve your experience on the website.</p>'+
					'<p>For instance, we use cookies on our site to allow you to login without having to type your login name each time. Other cookies help us to understand what did and didn&rsquo;t interest you about our website so we can provide you with features that are more relevant and useful to you next time you visit. We and some of our partners also use cookies on our site to measure the effectiveness of advertising on our site and how visitors use our site.</p>'+
					'<p>As well as setting some cookies ourselves - &quot;first party cookies&quot;, we also work with some partners to help give you access to even more great features on our site. These partners set &quot;third party cookies&quot; which enable their features to be provided on or through our website (such as advertising or videos). Third party cookies do not recognise you personally but can recognise your computer when it visits Moonstone Plates and other websites. This helps to ensure you get the best experience possible when visiting these sites.</p>'+
					'<p>Some cookies, called &quot;session cookies&quot;, stay on your computer only while your website browser is open and are deleted automatically once you close your browser. Other cookies, called &quot;persistent cookies&quot;, remain on your computer or mobile device after your browser is closed. This enables websites to recognise your computer when you later re-open your browser to give you as smooth a browsing experience as possible.</p>'+

					'<p><strong>What types of cookies do we use?</strong></p>'+

					'<p><strong>Essential cookies</strong></p>'+

					'<p>These cookies help you to move around our site and use all its essential features. Without these cookies, our website would not work properly and you would not be able to use features such as the shopping basket or the secure customer account pages.</p>'+

					'<p><strong>Performance and analytics cookies</strong></p>'+

					'<p>At Moonstone Plates, we want to make your experience on our website as smooth and as enjoyable as possible. Performance and analytics cookies help us understand how our website is being used and how we can improve your experience on it. These cookies cannot identify you personally; rather they provide us with anonymous information to help us understand which parts of our website interest our visitors and if they experience any errors. We use these cookies to test different designs and features for our website and we also use them to help us monitor how our visitors reach our sites and how effective our advertising is.</p>'+

					'<p><strong>Functionality cookies</strong></p>'+

					'<p>We use functionality cookies to save your settings on our website such as your language preference and booking information you&rsquo;ve previously used when buying a private plate from us. We also use functionality cookies to remember things such as the last registration plate you searched for so you can easily find it the next time you visit. Some functionality cookies are essential if you want to view videos and maps on our site. We also use &quot;Flash cookies&quot; for some of our animated content and to remember some of your preferences such as your volume settings.</p>'+

					'<p><strong>Advertising cookies</strong></p>'+

					'<p>Advertising cookies help ensure that the advertisements you see on our website are as relevant to you as possible. For example, some advertising cookies help select advertisements that are based on your interests. Others help prevent the same advertisement from continuously reappearing for you. Some of our partners may also use cookies or web beacons (a single-pixel image file) so that you see more relevant advertisements when visiting other websites. The information collected by these cookies and web beacons does not enable us or these third parties to identify your name, contact details or other personally identifying details unless you choose to provide these details.</p>'+

					'<p><strong>Social networking cookies</strong></p>'+

					'<p>We also want to make it as easy as possible for you to share content from Moonstone Plates with your friends through your favourite social networks. Social networking cookies, which are usually set by the social networking provider, enable such sharing to be smooth and seamless.</p>'+

					'<p><strong>How can you manage your cookies?</strong></p>'+

					'<p>You can set or amend your web browser controls to delete or disable cookies. If you choose to disable cookies on your computer or mobile device however, your access to some functionality and areas of our website may be degraded or restricted.&nbsp;<a href="http://www.allaboutcookies.org/">www.allaboutcookies.org</a>&nbsp;provides good simple instructions on how to manage cookies on the different types of web browsers. <a href="http://www.adobe.com/eeurope/special/products/flashplayer/articles/lso/">http://www.adobe.com/eeurope/special/products/flashplayer/articles/lso/</a>&nbsp;also has a good summary of how to manage Flash cookies.</p>'+

					'<p>Most advertising networks offer you a way to opt out of advertising cookies.&nbsp;<a href="http://www.aboutads.info/choices/">www.aboutads.info/choices/</a>&nbsp;and&nbsp;<a href="http://www.youronlinechoices.com/">www.youronlinechoices.com</a>&nbsp;have useful information on how to do this.</p>'+

					'<p><strong>Where can I get further information?</strong></p>'+

					'<p>If you have any questions about our use of cookies or other technologies, please email us at <a href="mailto:info@moonstoneplates.com">info@moonstoneplates.com</a>&nbsp; and we&rsquo;ll do our best to help.</p>'+

					'<p><strong>Cookie settings</strong></p>'+

					'<p><strong>Strictly necessary &amp; functional cookies</strong></p>'+

					'<p>These cookies cannot be disabled.</p>'+

					'<p><strong>Advertising &amp; marketing cookies</strong></p>'+

					'<p>By opting in to our cookie policy, you agree to our use of cookies to display personalised ads and share information about your use of our site with our advertising and analytics partners.</p>'+

					'<p>If you choose to opt out, please also remember to clear any current cookies or site data from your browser otherwise you may still see targeted ads based on cookies that have been set in the past. You can find out how to do this here:&nbsp;<a href="http://www.allaboutcookies.org/manage-cookies">www.allaboutcookies.org/manage-cookies</a>.</p>'+

					'<p><strong>We value your privacy</strong></p>'+

					'<p>Moonstone Plates uses cookies and similar technologies to analyse traffic, personalise content and ads, and provide social media features.</p>'+
					'<p>Accept</p>'+
					'<p><u>Learn more and adjust settings</u></p>'+
					'</div>'+
					'</div>'+
					'</div>'+
					'</div>'+
					'</div>';
			htmlBar += '<div class="pjAcceptCookieBarActions">';
			htmlBar += '<button type="button" class="pjAcceptCookieBarBtn">Accept</button>';
			htmlBar += '<button type="button" class="pjAcceptCookieBarBtn">Reject</button>';
			htmlBar += '</div>';
			htmlBar += '</form>';
			htmlBar += '</div>';
			
			var barDiv = document.createElement('div');
			barDiv.id = "pjAcceptCookieBar";
			document.body.appendChild(barDiv);
			barDiv.innerHTML = htmlBar;
			
			self.bindCookieBar();
		},
		bindCookieBar: function(){
			var self = this;
			var btn_arr = self.getElementsByClass("pjAcceptCookieBarBtn", null, "button");
			if(btn_arr.length > 0)
			{
				self.addEvent(btn_arr[0], "click", function (e) {
					if (e.preventDefault) {
						e.preventDefault();
					}
					self.createCookie('pjAcceptCookie', 'YES', 365);
					
					document.getElementById("pjAcceptCookieBar").remove();
					return false;
				});
			}
		}
	};
	
	window.AcceptCookie = AcceptCookie;	
})(window);

window.onload = function() {
	AcceptCookie = AcceptCookie();
}