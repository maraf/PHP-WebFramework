Ajax = function(selector, parentPageId) {
    this.Selector = selector;
    this.LoadingHandlers = [];
    this.CompletedHandlers = [];
    this.FailedHandlers = [];

    if (typeof(parentPageId) != 'undefined') {
        this.ParentPageId = parentPageId;
    } else {
        this.ParentPageId = null;
    }

    window.addEventListener("popstate", this._OnPopState.bind(this));
}

Ajax.prototype = Object.create(Ajax.prototype);

Ajax.prototype.AddEventListener = function(eventName, handler) {
    if (eventName == 'loading') {
        this.LoadingHandlers.push(handler);
    } else if(eventName == 'completed') {
        this.CompletedHandlers.push(handler);
    } else if(eventName == 'failed') {
        this.FailedHandlers.push(handler);
    } else {
        throw new Error('Not supported event name "' + eventName + '".');
    }
};

Ajax.prototype.Initialize = function(root) {
    root.find("a").not("[target=_blank]").not("[data-ajax=false]").click(this._OnLinkClick.bind(this));
};

Ajax.prototype._StopEvent = function(e) {
    e.preventDefault();
};

Ajax.prototype._RaiseEvent = function(eventName) {
    var handlers = null;
    if (eventName == 'loading') {
        handlers = this.LoadingHandlers;
    } else if(eventName == 'completed') {
        handlers = this.CompletedHandlers;
    } else if(eventName == 'failed') {
        handlers = this.FailedHandlers;
    } else {
        throw new Error('Not supported event name "' + eventName + '".');
    }

    if (handlers != null) {
        for (var i = 0, j = handlers.length; i < j; i++) {
            var handler = handlers[i];
            if (typeof(handler) == 'function') {
                handler(this);
            }
        }
    }
}

Ajax.prototype._OnLinkClick = function(e) {
    var url = e.currentTarget.href;

    this.Load(url);
    this._UpdateHistory(url);
    this._StopEvent(e);
};

Ajax.prototype.Load = function(url) {
    var parentPageId = this.ParentPageId;
    
    this._RaiseEvent('loading');
    $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-Template', 'xml');
            if (parentPageId != null) {
                xhr.setRequestHeader('X-Parent-Page-Id', parentPageId);
            }
        },
        success: this._OnLoadCompleted.bind(this),
        error: this._OnLoadCompleted.bind(this)
    });
};

Ajax.prototype._UpdateHistory = function(url) {
    if (window.history) {
        window.history.pushState(url, document.title, url);
    }
};

Ajax.prototype._OnLoadCompleted = function(responseText) {
    if (typeof(responseText) == "object") {
        if (responseText.status == 200) {
            responseText = responseText.responseText;
        } else {
            this._RaiseEvent('failed');
            return;
        }
    }

    var response = document.createElement("document");
    response.innerHTML = responseText;

    var head = this._FindElement(response, "rssmm:head");
    if (head != null) {
        var title = this._FindElement(head, "rssmm:title");
        if (title != null) {
            document.title = title.innerHTML;
        }

        var styles = this._FindElement(head, "rssmm:styles");
        if (styles != null) {
            styles = styles.getElementsByTagName("rssmm:link-ref");
            for (var i = 0, count = styles.length; i < count; i++) {
                var linkUrl = styles[i].innerHTML;
                if (document.querySelector("link[href='" + linkUrl + "']") == null) {
                    var link = document.createElement("link");
                    link.rel = "stylesheet";
                    link.href = linkUrl;
                    link.type = "text/css";
                    document.head.appendChild(link);
                }
            }
        }
        
        var scripts = this._FindElement(head, "rssmm:scripts");
        if (scripts != null) {
            scripts = scripts.getElementsByTagName("rssmm:script-ref");
            for (var i = 0, count = scripts.length; i < count; i++) {
                var linkUrl = scripts[i].innerHTML;
                if (document.querySelector("script[src='" + linkUrl + "']") == null) {
                    var link = document.createElement("script");
                    link.src = linkUrl;
                    link.type = "text/javascript";
                    document.head.appendChild(link);
                }
            }
        }
    }

    var content = this._FindElement(response, "rssmm:content");
    if (content != null) {
        var html = content.innerHTML;
        html = html.replace(/\?__TEMPLATE=xml/g, '').replace(/\&__TEMPLATE=xml/g, '');

        var oldContent = $(this.Selector);
        var newContent = $(html).find(this.Selector);
        if (newContent.length == 1) {
            oldContent.replaceWith(newContent);
            this.Initialize(newContent);
        } else {
            oldContent.html(html)
            this.Initialize(oldContent); 
        }   
    }

    this._RaiseEvent('completed');
};

Ajax.prototype._FindElement = function(container, name) {
    var elements = container.getElementsByTagName(name);
    if (elements.length > 0) {
        return elements[0];
    }

    return null;
};

Ajax.prototype._OnPopState = function(e) {
    var url = e.state;
    if (url == null) {
        url = window.location.href;
    }

    this.Load(url);
    this._StopEvent(e);
};