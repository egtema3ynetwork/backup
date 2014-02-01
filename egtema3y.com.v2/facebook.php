 <!DOCTYPE html>
    <html xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
    </head>
    <body>

    <a href="#" onClick="postToFacebook()">Post to Facebook</a>

    <script>
    function postToFacebook() {
        var body = 'Reading Connect JS documentation';

        FB.api('/me/feed', 'post', { body: body, message: 'yes !!' }, function(response) {
          if (!response || response.error) {
            alert(response.error);
          } else {
            alert('Post ID: ' + response);
          }
        });
    }
    </script>

    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId  : '129108667268260',
          status : true, // check login status
          cookie : true, // enable cookies to allow the server to access the session
          xfbml  : true  // parse XFBML
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>

    </body>
    </html>