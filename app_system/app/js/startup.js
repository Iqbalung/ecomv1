app = {};

app.startup = function(args) {
    app.loader(args);
};

app.onReady = function(args) {
    var load_js = args.load.js_second || {};

    var loaded = {};
    loaded.js = '';

    for (i = 0; i < load_js.length; i++) {
        app.load_js(load_js[i]);
        loaded.js += load_js[i] + ' ';
    }

    app.body_unmask();

    $(document).on('show.bs.modal', '.modal', function() {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        // $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            $('body').css('padding-right', '0px');
        }, 0);
    });
};

app.loader = function(args) {
    var load_css = args.load.css || {};
    var load_js = args.load.js || {};


    var loaded = {};
    loaded.css = '';
    loaded.js = '';
    for (i = 0; i < load_css.length; i++) {
        app.load_css(load_css[i]);
        loaded.css += load_css[i] + ' ';
    }

    for (i = 0; i < load_js.length; i++) {
        app.load_js(load_js[i]);
        loaded.js += load_js[i] + ' ';
    }

    if (typeof args.load.success == 'function') {
        typeof args.load.success();
    }
};


app.rupiah = function(args){
    var number_string = args.toString(),
    sisa    = number_string.length % 3,
    rupiah  = number_string.substr(0, sisa),
    ribuan  = number_string.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    return rupiah;
}

app.load_js = function(url) {
    var head = document.getElementsByTagName('head')[0];
    var link = document.createElement('script');
    link.type = 'text/javascript';
    link.charset = 'UTF-8';
    link.src = url;
    head.appendChild(link);
    // document.write('<script type="text/javascript" charset="UTF-8" src="' + url + '"></script>');
};

app.load_css = function(url) {
    var head = document.getElementsByTagName('head')[0];
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = url;
    link.media = 'all';
    head.appendChild(link);
    // document.write('<link href="' + url + '" rel="stylesheet">');
};

app.body_mask = function() {
    $('.loader').show();
    $('body').css('overflow', 'hidden');
};

app.body_unmask = function() {
    $('.loader').hide();
    $('body').css('overflow', 'auto');
};

app.convert_form = function(param) {
    var out = {};
    for (var i = 0; i < param.length; i++) {
        out[param[i].name] = param[i].value;
    }

    return out;
};

app.params_serialize = function(params) {
    var out = {};
    params.forEach(function(item, index, arr) {

    });

    return out;
};

app.set_form_value = function(frm, data) {
    $.each(data, function(key, value) {
        value = value || '-';
        var $ctrl = $('[name=' + key + ']', frm);
        switch ($ctrl.attr("type")) {
            case "text":
                $ctrl.val(value);
                break;
            case "hidden":
                $ctrl.val(value);
                break;
            case "radio":
                break;
            case "checkbox":
                $ctrl.each(function() {
                    if ($(this).attr('value') == value) {
                        $(this).attr("checked", value);
                    }
                });
                break;
            case "html":
                $ctrl.html(value);
                break;
            case "select":
                $(this).val(value);
                break;
            default:
                $ctrl.val(value);
        }
    });
};

app.image_exists = function(image_url) {

    var http = new XMLHttpRequest();

    http.open('HEAD', image_url, false);
    http.send();

    return http.status != 404;
};

app.clear_form = function(form) {    
    $(form).find('input[type=text], input[type=hidden], input[type=search], input[type=number], input[type=password], input[type=date], input[type=email], input[type=file], textarea, select').val('');
    $(form).find('.select2').val('').trigger('change.select2');
    $(form).find('.displayfield').html('');
    $(form).find('.input-date').val('').datepicker('update');
    $(form).find('.error').removeClass('error');
};

app.random_char = function(jml) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    jml = (typeof jml == 'undefined') ? 8 : jml;

    for (var i = 0; i < jml+1; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
};
app.submit_form = function(form, button, callback) {
    $(form).delegate('input', 'keyup keypress', function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $(form).delegate('input', 'keyup', function(e) {
        if (e.keyCode === 13) {
            $(button).click();
        }
    });

    $(button).on('click', function(e) {
        e.preventDefault();
        if (typeof callback == 'function') {
            callback.call(this);
        }
    });
};
app.showErrors = function(errorMessage, errormap, errorlist) {
    if (errorMessage) {
        var val = this;
        errormap.forEach(function(error, index) {
            val.settings.highlight.call(val, error.element, val.settings.errorClass, val.settings.validClass);
            val.showLabel(error.element, error.message);
        });
    } else {
        this.defaultShowErrors();
    }

};
app.fixValidFieldStyles = function($form, validator) {
    var errors = {};
    $form.find("input,select").each(function(index) {
        var name = $(this).attr("name");
        errors[name] = validator.errorsFor(name);
    });
    validator.showErrors(errors);
    var invalidFields = $form.find("." + validator.settings.errorClass);
    if (invalidFields.length) {
        invalidFields.each(function(index, field) {
            if ($(field).valid()) {
                $(field).removeClass(validator.settings.errorClass);
            }
        });
    }
};
app.round10 = function(number, precision) {
    var factor = Math.pow(10, precision),
        tempNumber = number * factor,
        roundedTempNumber = Math.round(tempNumber);
        
    return roundedTempNumber / factor;
};
app.getFileExtension = function(filename) {
    return filename.split('.').pop();
};
app.loading = '<div class="loading">' +
    '               <svg viewBox="0 0 32 32" width="32" height="32">' +
    '                   <circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>' +
    '               </svg>' +
    '           </div>';
app.get_param = function(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
};

app.requestAjax = function(url,args,method,callback)  {
    $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        data: args,
    })
    .done(function(result) {
        if (callback) {
            callback(result);
        }
    })
    .fail(function(err) {
        swal("Information","(" + err.status + ") " + err.statusText,"warning");
    })
    .always(function() {
        setTimeout(function(){
            app.body_unmask();
        },500);
    });
    
};

app.get_data_list = function(cmp,link,args,config, callback) {
    $(cmp).select2({
        placeholder: 'Loading...'
    });

    try{
        var can_clear = config.can_clear;        
    }catch(e)
    {
        var can_clear = false;            
    }

    try
    {
        var placeholder = config.placeholder;
    }
    catch(e)
    {
        var placeholder = '';
    }

    try
    {
        var display_value = config.display_value;
    }
    catch(e)
    {
        var display_value = 'text';
    }

    try
    {
        var value = config.value;
    }
    catch(e)
    {
        var value = 'id';
    }

    $.ajax({
            url: link,
            method: 'POST',
            dataType:'json',
            data: args
        })
        .done(function(result) {            
            $(cmp).html('');
            $(cmp).select2({
                allowClear:can_clear,
                placeholder: placeholder
            });
            var component = $(cmp);

            for (var i = 0; i < component.length; i++) {
                var comp = component[i],
                    default_value = $(comp).attr("value");
                
                $.each(result.data, function(index, val) {                
                    
                    var html = `<option value="` + val[value] + `" >` + val[display_value] + `</option>`;

                    $(comp).append(html);
                });

                $(comp).val('').trigger('change');
                $(comp).val(default_value).trigger('change');
                $(comp).val(default_value).trigger('select2.change');
            }

            if (callback) {
                callback(result)
            }
        })
        .fail(function() {
            console.log('gagal terhubungan dengan server');
        });
};

app.requestAjaxForm = function(url,params,method,callback) {
    $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        data: params,        
        async: false,
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(result) {
        if (callback) 
        {
            callback(result);
        }
    })
    .fail(function(result) {                        
        swal({
            title: "Informasi!",
            text: '('+result.status+') '+result.statusText,                         
            icon: "warning",
        });
    })
    .always(function() {
        setTimeout(function() {
            app.body_unmask();
        },500);
    });     

};

app.ifvalnull = function(val,dflt) {
    if (val == null)
    {
        val = dflt;
    }
    return val;
}





 /*
     * Date Format 1.2.3
     * (c) 2007-2009 Steven Levithan <stevenlevithan.com>
     * MIT license
     *
     * Includes enhancements by Scott Trenda <scott.trenda.net>
     * and Kris Kowal <cixar.com/~kris.kowal/>
     *
     * Accepts a date, a mask, or a date and a mask.
     * Returns a formatted version of the given date.
     * The date defaults to the current date/time.
     * The mask defaults to dateFormat.masks.default.
     */

    var dateFormat = function () {
        var    token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
            timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
            timezoneClip = /[^-+\dA-Z]/g,
            pad = function (val, len) {
                val = String(val);
                len = len || 2;
                while (val.length < len) val = "0" + val;
                return val;
            };
    
        // Regexes and supporting functions are cached through closure
        return function (date, mask, utc) {
            var dF = dateFormat;
    
            // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
            if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
                mask = date;
                date = undefined;
            }
    
            // Passing date through Date applies Date.parse, if necessary
            date = date ? new Date(date) : new Date;
            if (isNaN(date)) throw SyntaxError("invalid date");
    
            mask = String(dF.masks[mask] || mask || dF.masks["default"]);
    
            // Allow setting the utc argument via the mask
            if (mask.slice(0, 4) == "UTC:") {
                mask = mask.slice(4);
                utc = true;
            }
    
            var    _ = utc ? "getUTC" : "get",
                d = date[_ + "Date"](),
                D = date[_ + "Day"](),
                m = date[_ + "Month"](),
                y = date[_ + "FullYear"](),
                H = date[_ + "Hours"](),
                M = date[_ + "Minutes"](),
                s = date[_ + "Seconds"](),
                L = date[_ + "Milliseconds"](),
                o = utc ? 0 : date.getTimezoneOffset(),
                flags = {
                    d:    d,
                    dd:   pad(d),
                    ddd:  dF.i18n.dayNames[D],
                    dddd: dF.i18n.dayNames[D + 7],
                    m:    m + 1,
                    mm:   pad(m + 1),
                    mmm:  dF.i18n.monthNames[m],
                    mmmm: dF.i18n.monthNames[m + 12],
                    yy:   String(y).slice(2),
                    yyyy: y,
                    h:    H % 12 || 12,
                    hh:   pad(H % 12 || 12),
                    H:    H,
                    HH:   pad(H),
                    M:    M,
                    MM:   pad(M),
                    s:    s,
                    ss:   pad(s),
                    l:    pad(L, 3),
                    L:    pad(L > 99 ? Math.round(L / 10) : L),
                    t:    H < 12 ? "a"  : "p",
                    tt:   H < 12 ? "am" : "pm",
                    T:    H < 12 ? "A"  : "P",
                    TT:   H < 12 ? "AM" : "PM",
                    Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                    o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                    S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
                };
    
            return mask.replace(token, function ($0) {
                return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
            });
        };
    }();
    
    // Some common format strings
    dateFormat.masks = {
        "default":      "ddd mmm dd yyyy HH:MM:ss",
        shortDate:      "m/d/yy",
        mediumDate:     "mmm d, yyyy",
        longDate:       "mmmm d, yyyy",
        fullDate:       "dddd, mmmm d, yyyy",
        shortTime:      "h:MM TT",
        mediumTime:     "h:MM:ss TT",
        longTime:       "h:MM:ss TT Z",
        isoDate:        "yyyy-mm-dd",
        isoTime:        "HH:MM:ss",
        isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
        isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
    };
    
    // Internationalization strings
    dateFormat.i18n = {
        dayNames: [
            "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
            "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
        ],
        monthNames: [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
            "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
        ]
    };
    
    // For convenience...
    Date.prototype.format = function (mask, utc) {
        return dateFormat(this, mask, utc);
    };
	
	
	
	



	function GetNextWeekStart() {
		var today = moment();
		//edited part
		var daystoMonday = 0 - (today.isoWeekday() - 1) + 7;       
		var nextMonday = today.subtract('days', daystoMonday);

		return nextMonday;
	}

	function GetNextWeekEnd() {
		var nextMonday = GetNextWeekStart();
		var nextSunday = nextMonday.add('days', 6);

		return nextSunday;
	}

	function GetLastWeekStart() {
		var today = moment();
		var daystoLastMonday = 0 - (1 - today.isoWeekday()) + 7;

		var lastMonday = today.subtract('days', daystoLastMonday);

		return lastMonday;
	}

	function GetLastWeekEnd() {
		var lastMonday = GetLastWeekStart();
		var lastSunday = lastMonday.add('days', 6);

		return lastSunday; 
	}