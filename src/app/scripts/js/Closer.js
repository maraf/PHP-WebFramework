/**
 *
 *  @author  Marek Fišera marek.fisera@email.cz
 *  @date    2009/06/26
 *
 */
function Closer(frameCover) {
	var Own = this;
	var FrameCover = frameCover;
	var Anchor;
	var Head;
	var Content;
	var CookieName = '';
  
	this.init = function() {
		var elms = frameCover.getElementsByTagName('*');
		for(var i = 0; i < elms.length; i ++) {
			elm = elms[i];
			if(elm.className.indexOf("frame-head") != -1) {
				Head = elm;
			} else if(elm.className.indexOf("frame-body") != -1) {
				Content = elm;
			} else if(elm.className.indexOf("click-able-roll") != -1) {
				Anchor = elm;
			}
		}
	
		var c = new Cookies();
		var val = c.read(frameCover.id);
	
		if(val == 'closed') {
			Own.closeFrame();
		} else if(val == 'opened') {
			Own.openFrame();
		}
    
		Own.addEvent(Head, "click", Own.headClick, false);
	}
  
	this.headClick = function(event) {
		if(FrameCover.className.indexOf(" closed-frame") != -1) {
			Own.openFrame();
		} else {
			Own.closeFrame();
		}
		Own.stopEvent(event);
	}
  
	this.openFrame = function() {
		if(FrameCover.className.indexOf(" closed-frame") != -1) {
			FrameCover.className = FrameCover.className.substring(0,FrameCover.className.indexOf(" closed-frame"));
		}
		Content.style.display = "block";
		var c = new Cookies();
		c.create(frameCover.id, 'opened');
	}
	
	this.closeFrame = function() {
		FrameCover.className += " closed-frame";
		Content.style.display = "none";
		//Own.saveToCookie(CookieName, 'closed');
		var c = new Cookies();
		c.create(frameCover.id, 'closed');
	}

	this.addEvent = function (obj, ev, func, b) {
		if(obj.addEventListener) {
			obj.addEventListener(ev, func, b);
		} else {
			obj.attachEvent("on" + ev, func);
		}
	}
	
	this.stopEvent = function (event) {
		if(typeof event == 'undefined' || event == null) return;
		if(navigator.appName != "Microsoft Internet Explorer") {
			event.stopPropagation();
			event.preventDefault();
		} else {
			event.cancelBubble = true;
			event.returnValue = false;
		}
	}
  
	this.findInCookie = function(pattern) {
		var retVal = null;
		cookies = document.cookie.split(";");
		for(i in cookies) {
			cookie = cookies[i].split("=");
			if (cookie[0] == pattern) { 
				retVal = cookie[1];
			}
		}
		return retVal;
	}
	
	this.saveToCookie = function(key, value) {
		var date = new Date();
		date.setTime((date.getTime() + 1000 * 60 * 60 * 24 * 3));
		document.cookie = key + "=" + value + "; expires=" + date.toGMTString();
	}
  
	this.init();
}
