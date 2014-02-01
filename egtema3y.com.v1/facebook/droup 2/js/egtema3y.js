  
  
  function getParameterByName(name) {
                 name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
                 var regexS = "[\\?&]" + name + "=([^&#]*)";
                 var regex = new RegExp(regexS);
                 var results = regex.exec(window.location.search);
                 if (results == null) {
                     ////console.log(name + " parameter not found");
                     return "";
                 }
                 else
                     return decodeURIComponent(results[1].replace(/\+/g, " "));
             }

   function urlHyperlinks(str) {
        if (str === null)
            return null;
        var str2 = str;


        str2 = str.replace(/\b((http|https|ftp):\/\/\S+)/g, '<a href="$1" target="_blank">$1</a>');

        if (str2 === str) {
            str2 = str.replace(/\b((www)\.\S+)/g, '<a href="http://$1" target="_blank">$1</a>');
        }

        str2 = str2.replace('\n', '          ');
        //str2 = str2.replace(/\b#\S+/g, '<a href="https://twitter.com/search?q=$1" target="_blank">$1</a>');


        return str2;
    }

    function relativeTime(delta) {

        delta = (delta * 1000); // - (2 * 60 *60 * 1000 ); //-> ms

        if (delta <= 10000) {   // Less than 10 seconds ago
            return 'منذ قليل';
        }

        var units = null;

        var conversions = {
            millisecond: 1, // ms -> ms
            ثانية: 1000, // ms -> sec
            دقيقة: 60, // sec -> min
            ساعة: 60, // min -> hour
            يوم: 24, // hour -> day
            شهر: 30, // day -> month (roughly)
            سنة: 12         // month -> year
        };

        for (var key in conversions) {
            if (delta < conversions[key]) {
                break;
            }
            else {
                units = key;
                delta = delta / conversions[key];
            }
        }

        // Pluralize if necessary:

        delta = Math.floor(delta);
        //if ( delta !== 1 ) { units += 's'; }

        return [" منذ ", delta, units].join(' ');

    }

    
    function setCookie(c_name, value, exdays) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
        document.cookie = c_name + "=" + c_value;
    }

    function getCookie(c_name) {
        var c_value = document.cookie;
        var c_start = c_value.indexOf(" " + c_name + "=");
        if (c_start == -1) {
            c_start = c_value.indexOf(c_name + "=");
        }
        if (c_start == -1) {
            c_value = null;
        }
        else {
            c_start = c_value.indexOf("=", c_start) + 1;
            var c_end = c_value.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = c_value.length;
            }
            c_value = unescape(c_value.substring(c_start, c_end));
        }

      

        return c_value;
    }

    function log(msg)
    {
       console.log(msg);
    }
    
    function newGuid()
    {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {var r = Math.random()*16|0,v=c=='x'?r:r&0x3|0x8;return v.toString(16);});
    }
    function newKey()
    {
       return $.base64.encode(newGuid());
    }