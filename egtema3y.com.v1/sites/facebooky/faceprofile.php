<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link href="http://css.egtema3y.com/bootstrap.min.css" rel="stylesheet">
        <link href="http://css.egtema3y.com/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="http://css.egtema3y.com/egtema3y.css" rel="stylesheet">


        <script src="http://js.egtema3y.com/jquery.js"></script>
        <script src="http://js.egtema3y.com/bootstrap.min.js"></script>
        <script src="http://js.egtema3y.com/jquery.base64.js"></script>
        <script src="http://js.egtema3y.com/jquery.tmpl.js"></script>
        <script src="http://js.egtema3y.com/egtema3y.js"></script>


    </head>
    <body >
        <?php include_once("analyticstracking.php") ?>
        <br> <br>
        <div class="row-fluid">

            <div class="span8 offset2">


                <p class="label label-inverse"> +201122354855</p>
                <p class="label label-inverse"> +201009526580</p>
                <p class="label label-inverse"> Egtema3yNetwork@Gmail.com</p>
            </div>
        </div>
        <br>
        <div class=" row-fluid" >


            <div class=" row-fluid span10 offset1 btn-inverse " style="height: 20px;">    </div>




            <div class=" row-fluid">


                <div class="row-fluid span6 offset1">
                    <br>

                    <div id="TT_info"  class=" row-fluid label label-inverse"> </div>
                    <br> <br>


                    <div class="row-fluid " id="divcontent1"></div>
                </div>

                <div class="span3 offset1">

                    <?php include ("profile.tmp.html"); ?>


                    <div id="div_controls" class="row-fluid span10 offset1">

                        <div class="row-fluid"><a id="BB__share_mywall" style="width: 200px;" class="btn btn-inverse" onclick="show_mywall_div();
                                $('html, body').animate({scrollTop: 0}, 'fast');"> اكتب على حـائطى </a></div>

                        <br>
                        <div class="row-fluid"><a id="BB__share_mygroups" style="width: 200px;" class="btn btn-inverse" onclick="show_mygroups_post_div();
                                $('html, body').animate({scrollTop: 0}, 'fast');"> اكتب على حـائط الجروبـات </a></div>
                        <br>
                        <div class="row-fluid"><a id="BB__share_myaccounts" style="width: 200px;" class="btn btn-inverse" onclick="show_myaccounts_post_div();
                                $('html, body').animate({scrollTop: 0}, 'fast');"> اكتب على حـائط صفحاتى الخاصة </a></div>
                        <br>
                        <div class="row-fluid"><a id="BB__ownpages" style="width: 200px;" class="btn btn-inverse" onclick=" loadfacebookownpages();
                                $('html, body').animate({scrollTop: 0}, 'fast');">  صفحاتى الخـاصة </a></div>
                        <br>
                        <div class="row-fluid"><a id="BB__pages" style="width: 200px;" class="btn btn-inverse" onclick="loadfacebookpages();
                                $('html, body').animate({scrollTop: 0}, 'fast');"> الصفحـات </a></div>
                        <br>
                        <div class="row-fluid"><a id="BB__friends" style="width: 200px;" class="btn btn-inverse" onclick="loadfacebookfriends();
                                $('html, body').animate({scrollTop: 0}, 'fast');">  أصدقائـى </a></div>
                        <br>
                        <div class="row-fluid"><a id="BB__groups" style="width: 200px;" class="btn btn-inverse" onclick="loadfacebookgroups();
                                $('html, body').animate({scrollTop: 0}, 'fast');">  جروبـاتى </a></div>

                        <br>
                        <div class="row-fluid"><a id="BB__view_myfeeds" style="width: 200px;" class="btn btn-inverse" onclick="loadmyfacebookfeeds('');
                                $('html, body').animate({scrollTop: 0}, 'fast');">  حـائطى الان </a></div>

                        <br>
                        <div class="row-fluid"><a id="BB__view_publicfeeds" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('');
                                $('html, body').animate({scrollTop: 0}, 'fast');"> الفيسبوك لحظة بلحظة </a></div>

                        <br>
                        <div class="row-fluid"><a id="BB__view_publicfeeds4" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('4');
                                $('html, body').animate({scrollTop: 0}, 'fast');"> كوميديا الفيسبوك  </a></div>

                        <br>
                        <div class="row-fluid"><a id="BB__view_publicfeeds8" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('8');
                                $('html, body').animate({scrollTop: 0}, 'fast');"> الرياضة على الفيسبوك</a></div>

                        <br>
                        <div class="row-fluid"><a id="BB__view_publicfeeds9" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('9');
                                $('html, body').animate({scrollTop: 0}, 'fast');"> المرأة على الفيسبوك </a></div>

                        <br>
                        <div class="row-fluid"><a id="BB__view_publicfeeds9" style="width: 200px;" class="btn btn-inverse" onclick="loadpublicfacebookfeeds('10');
                                $('html, body').animate({scrollTop: 0}, 'fast');"> الديكور على الفيسبوك </a></div>

                        <br>

                    </div>


                </div>
            </div>



        </div>



        <div style="visibility: collapse;height: 20px;width: 20px;position: fixed;">

            <div >   <?php include ("ownpages.tmp.html"); ?></div>
            <div  > <?php include ("groups.tmp.html"); ?></div>
            <div ><?php include ("friends.tmp.html"); ?></div>
            <div  > <?php include ("pages.tmp.html"); ?></div>
            <div  > <?php include ("postwall.tmp.html"); ?></div>
            <div  > <?php include ("postgroups.tmp.html"); ?></div>
            <div  > <?php include ("postaccounts.tmp.html"); ?></div>
            <div  > <?php include ("publicfeeds.tmp.html"); ?></div>
            <div  > <?php include ("myfeeds.tmp.html"); ?></div>
            <div  > <?php include ("chat.tmp.html"); ?></div>
        </div>


        <script>
            $(document).ready(function() {

            var option = getParameterByName('option');
            if (option == "chat") {
            $('#divcontent1').html('');
            $('#chating1').show();
            $("#chating1").appendTo($('#divcontent1'));
            $("<br><br>").appendTo($('#divcontent1'));
            startchat();
            }
            else {
           // loadpublicfacebookfeeds('');
            }
            });
        </script>

    </body>
</html>

