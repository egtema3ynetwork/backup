
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <?php require ('../global/database.php'); ?>
        <?php include("../content/start.php"); ?>

        <?php
        $membername = isset($_GET['membername']) ? $_GET['membername'] : "";
        ?>

        <meta charset="utf-8">
        <title> شبكة إجتماعى  - برنامج محاكاة الفيسبوك </title>
        <link rel="shortcut icon" type="image/x-icon" href="../img/rss.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta id="description" name="description" content="كثيرا منا لديه صفحات كثيرة او جروبات يقوم بادارتها فاذا اراد نشر موضوع معين يقوم بفتح صفحاته صفحة صفحة او فتح جروباته جروب جروب مما يستهلك الكثير من الوقت والمجهود . ولكن ذلك ليس الان فمع هذا البرنامج اصبح النشر اسهل مما يمكن وبضغطة واحدة انشر رسائلك ومقالاتك وصورك وفيديوهات داخل صفحاتك وجروباتك ">
        <meta name="author" content="Egtema3y.com">
        <meta name="keywords" content="Facebook,Youtube,Twitter,Egtema3y,شبكة إجتماعى,محاكاة الفيسبوك,زيادة المعجبيين,ارسال رسائل متتعددة,ادارة الصفحات والجروبات">
        <meta name="COPYRIGHT" content="&copy; 2013 Egtema3y.com">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta property="fb:admins" content="amr0123060349" />
        <meta property="fb:app_id" content="129108667268260" />
        <meta property="og:image" content="../img/rss.ico" />
        <link rel="image_src" href="../img/rss.ico" />

        <?php include("../content/css.html"); ?>
        <?php include("../content/js.html"); ?>
        <style>
            .facebooktools
            {
                visibility: collapse;
            }
        </style>
        <style type="text/css">
            html, body {
                height: 100%;
                overflow: auto;
            }
            body {
                padding: 0;
                margin: 0;
            }
            #silverlightControlHost {
                height: 100%;
                text-align:center;
            }
        </style>

        <script type="text/javascript">
            function onSilverlightError(sender, args) {
                var appSource = "";
                if (sender != null && sender != 0) {
                    appSource = sender.getHost().Source;
                }

                var errorType = args.ErrorType;
                var iErrorCode = args.ErrorCode;

                if (errorType == "ImageError" || errorType == "MediaError") {
                    return;
                }

                var errMsg = "Unhandled Error in Silverlight Application " + appSource + "\n";

                errMsg += "Code: " + iErrorCode + "    \n";
                errMsg += "Category: " + errorType + "       \n";
                errMsg += "Message: " + args.ErrorMessage + "     \n";

                if (errorType == "ParserError") {
                    errMsg += "File: " + args.xamlFile + "     \n";
                    errMsg += "Line: " + args.lineNumber + "     \n";
                    errMsg += "Position: " + args.charPosition + "     \n";
                }
                else if (errorType == "RuntimeError") {
                    if (args.lineNumber != 0) {
                        errMsg += "Line: " + args.lineNumber + "     \n";
                        errMsg += "Position: " + args.charPosition + "     \n";
                    }
                    errMsg += "MethodName: " + args.methodName + "     \n";
                }

                throw new Error(errMsg);
            }
        </script>
    </head>
    <body>
        <?php include("../content/site-logo.html"); ?>
        <?php include("../content/mainmenu.html"); ?>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <div class="label label-info">
            برنامج محاكاة الفيسبوك
        </div>
        <br>
        هو برنامج تم تصميمه بتقنية السيلفرلايت احدث التقنيات التى انتجتها شركة مايكروسوفت
        <br>
        البرنامج يقوم بمحاكاة الفيسبوك من عرض الجروبات والاصدقاء والصفحات ومشاهدة اخر ماتم مشاركته من مواضيع او صور
        <br>
        ويتمتع بمميزات كثيره منها
        <br>
        كتابة رسالة الى كل اصدقائك او كل جروباتك بضغطة واحدة فقط
        <br>
        نشر صورة او كتابة مقال على جميع صفحاتك الخاصة بضغطة واحدة
        <br>
        النشر المتعدد للرسائل العادية او المتطورة او نشر الصور والفيديوهات وغيرها الكثير
        <br>
        مشاهدة احدث الصور التى على البومات اصدقائك او على البومات الصفحات بطريقة سهلة
        <br>
        فى حالة انقطاع النت يمكنك مشاهدة كل ما تم عرضة قبل انقطاع الانترنت من خلال تقنية الونلود
        <br>
        <br>
        <p class="label label-success"> 01122354855</p>
        لطلبات الاشتراك والتواصل عبر البريد الالكترونى أو الهاتف من داخل مصر
        <p class="label label-warning">
            Egtema3yNetwork@Gmail.Com</p>

        <hr>
    <center>
        <div >
            <strong>
                <<
                <a href="http://www.mediafire.com/download/1v3a1zadepju4pb/Free.rar">أضغط هنا لتحميل البرنامج</a>
                >>
            </strong>
            <br>
            أقل من دقيقة واحدة
            <br>
            حمل البرنامج وفك الضغط بأى برنامج واضغط على الملف
            <br> Login.html
            <br> وسجل دخول الى البرنامج واكتب رسالتك وانشرها الى صفحاتك وجروباتك بضغطة واحدة
            <br>
        </div>
    </center>
    <br>
    <hr>

    <center>
        <div id="app_price" style="width: 80%;">

            <div class="row-fluid" style="padding: 5px;">
                <div class="span3 label label-primary">قيمة الاشتراك</div>
                <div class="span3 label label-primary">
                    مدة الاشتراك
                </div>
                <div class="span6 label label-primary">نوع الاشتراك</div>
            </div>

            <div class="row-fluid" style="padding: 5px;">
                <div class="span3 label label-success">150 جنية</div>
                <div class="span3 label label-success">
                    6 شهور
                </div>
                <div class="span6 label label-success">مستخدم واحد فقط</div>
            </div>
            <div class="row-fluid" style="padding: 5px;">
                <div class="span3 label label-success">250 جنية</div>
                <div class="span3 label label-success">
                    عام كامل
                </div>
                <div class="span6 label label-success">مستخدم واحد فقط</div>
            </div>

            <div class="row-fluid" style="padding: 5px;">
                <div class="span3 label label-success">500 جنية</div>
                <div class="span3 label label-success">
                    شهر واحد فقط
                </div>
                <div class="span6 label label-success">متعدد المستخدمين</div>
            </div>

            <div class="row-fluid" style="padding: 5px;">
                <div class="span3 label label-success">1300 جنية</div>
                <div class="span3 label label-success">
                    3 شهور فقط
                </div>
                <div class="span6 label label-success">متعدد المستخدمين</div>
            </div>

            <div class="row-fluid" style="padding: 5px;">
                <div class="span3 label label-success">2400 جنية</div>
                <div class="span3 label label-success">
                    6 شهور فقط
                </div>
                <div class="span6 label label-success">متعدد المستخدمين</div>
            </div>

            <div class="row-fluid" style="padding: 5px;">
                <div class="span3 label label-success">4500 جنية</div>
                <div class="span3 label label-success">
                    عام كامل
                </div>
                <div class="span6 label label-success">متعدد المستخدمين</div>
            </div>

        </div>
    </center>

    <br />
    <br />
    <br />

</body>
</html>
