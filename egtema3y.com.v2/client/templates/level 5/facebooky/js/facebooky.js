
var menuimage = "<img style='width: 24px;height: 24px;margin:5px;align:left;' src='images/twitter.ico'/>";
db.menu_facebooky = [

  
  
    {name: "Facebook", en: "Facebook", ar: "الفيســـبوك", id: 1, action: "__.facebooky.show(1);  ", css: "theme ", role : "Administrator Member anyone"
    , submenu :[
    {name: "Write Post", en: "Write Post", ar: " نشــر  بوســــت ", id: "x", action: "__.facebooky.wallDisplay();", css: "", role : "anyone"},
          {name: "Member Management", en: "Member Management", ar: "إدارة المشـتركين", id: "x", action: "__.facebooky.manage();", css: "", role : "Administrator"},
                         
    ]},
    
   
    
];


$(function() {
	
	
	
	
    

    __FACEBOOKY = function() {

        if (this === window)
        {
            return new __SITE_MENU();
        }

       this.post = function function_name () {};
       
        this.display = function() {

$('#facebooky-menu-content').remove();

            __.layout.right().append(__.tmp2html('#facebooky-menu-tmp' , [1]));
            $('#facebooky-menu-content').append(__.tmp2html('#facebooky-menu-button-tmp'  ,db.menu_facebooky));
           $('.facebookybutton').css("font-weight" , "bold");
           $('.facebookybutton').css("font-size" , "larger");
           
          
           
           
           
           
            $.each(db.menu_facebooky , function(index , item){
             $('#menu_image_' + item.id).remove();
        		$('#facebooky-menu-button-content_' + item.id).append(__.tmp2html('#facebooky-menu-button-tmp'  ,item.submenu));
        		$('#facebooky-menu-button-content_' + item.id).show('slow');
        	});
        	
            $(document).trigger("site/newContent");
         
        };
        this.show = function(id) {
            $('#facebooky-menu-button-content_' + id).slideToggle();
        };


   this.wallAutoPost =   function()
    {
        var accesstoken = getParameterByName('accesstoken');
        var did = getParameterByName('did');
        if (did == "insert" || did == "update")
        {



            var message = "#موفع_رائع_للادارة_الجروبات_و_الصفحات_على_الفيسبوك";
            message += " \n\r ";
            message += " Facebooky.Egtema3y .com من هنا ";
            message += " \n\r ";
            message += " لايك وشير وكومنت وجرب الموقع مجانا ";


            $.base64.utf8encode = true;
            message = $.base64.encode(message);

            var _url = "http://webservices.egtema3y.com/postfacefeed.php?accesstoken=" + accesstoken + "&message=" + message;
            console.log("call service : " + _url);

            $.getJSON(_url, function(data)
            {
            });
        }
    };
 
       
   this.postToWall =  function (type) {
      $('.facebooky-post-btn-share').hide('slow');

       var accesstoken = __.getValue('accesstoken');

        var message = "";
        var lines = $('#post_message').val().split('\n');
        for (var i = 0; i < lines.length; i++) {
            message += lines[i] ;
            if(lines.length > 1)
            {
            	 message += " \n\r ";
            }
        }

   
  var link = $('#post_link').val();
  var name = $('#post_name').val();
  var caption = $('#post_caption').val();
  var picture = $('#post_picture').val();
 var description = "";
        var lines = $('#post_description').val().split('\n');
        for (var i = 0; i < lines.length; i++) {
            description += lines[i] ;
            if(lines.length > 1)
            {
            	 description += " \n\r ";
            }
        }
        

$('#post-wall-info-div').html( 'جــارى نشـر البوســـت ' + '<img src="./client/images/load.gif"/>');
        var _url = __.getWebServicesURL() +  "/facebook.post.php" ;

        __.log("call service : " + _url);

      $.ajax({
				url : _url,
				data : {
					accesstoken : __.spy(accesstoken),
					type : __.spy(type),
					link : __.spy(link),
					message : __.spy(message),
					name : __.spy(name),
					caption : __.spy(caption),
					picture : __.spy(picture),
					description : __.spy(description)
					
				},
				type : "POST",
				dataType : "json",
				crossDomain : true,
				
				success : function(data, textStatus, jqXHR) {
						$('#post-wall-info-div').html('');
$.each(data.messages , function(){

	$('#post-wall-info-div').append(this + "<br>");
});
			

				},
				error : function(jqXHR, textStatus, errorThrown) {
					__.logErr("ajax post feed error : " + errorThrown);
					 $('#post-wall-info-div').html(errorThrown);
				},
				complete : function(jqXHR, textStatus) {
					__.logInfo("ajax post feed complete : " + textStatus);
					 $('.facebooky-post-btn-share').show('slow');

				}
			});
      
      
      

    };
       
         this.wallDisplay =   function () {
       
       var tmp = __.tmp2html("#facebooky-post-wall-tmp" , [1]);
       $(tmp).hide();
        __.layout.content().html(tmp);
         $(tmp).show('slow');
          __.layout.content().append(__.tmp2html("#facebooky-post-help-tmp" , [1]));
          
           $('#post_message').val(__.facebooky.post.message);
           $('#post_link').val(__.facebooky.post.link);
           $('#post_name').val(__.facebooky.post.linkname);
           $('#post_caption').val(__.facebooky.post.caption);
           $('#post_description').val(__.facebooky.post.description);
           $('#post_picture').val(__.facebooky.post.picture);
           
           
           $('html, body').animate({
				scrollTop : 0
			}, 500);
			
        $(document).trigger("site/newContent");
   };
    
    };

    CORE.prototype.facebooky = new __FACEBOOKY();

    __.facebooky.display();

	__.facebooky.managementToggle = function() {
		$('.membermanagementdetails').slideToggle();
	};


	__.facebooky.loadAll = function() {
		$('.membermanagementdetails').html('<div class="loadtxt row-fluid" ><img src="./client/images/load.gif"/><div data-en="Loading Members " data-ar="جارى تحميل المشتركين من فضلك انتظر قليلا" > ' + 'جارى تحميل المشتركين من فضلك انتظر قليلا   ' + '</div></div> ');
		var value = $('#member-filter-txt').val();
		var _url = __.getWebServicesURL() + "/facebooky.member.php";
		__.log("call service = " + _url);

		$.ajax({
			url : _url,
			data : {
				method : "all",
				value : __.spy(value)
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				__.log("ajax member load all success fire");
				if (data.data.length > 0) {
					var i = 1;
					$.each(data.data, function() {
						this.index = i;
						i++;
						if (!!this.userid) {
							this.imageurl = 'https://graph.facebook.com/' + this.userid + '/picture?type=square';
						} else {
							this.imageurl = './client/images/' + this.gender + '.jpg';
						}
						this.time = __.relativeTime(this.timeago);

					});

					var divtmp = __.tmp2html('#facebooky-member-management-details-tmp', data.data);

					$('.membermanagementdetails').html(divtmp);
					$('.membermanagementdetails').hide();
					$('.membermanagementdetails').show('slow');

					$.each(data.data, function() {

						var id = this.id;
						var role = this.role;
						var gender = this.gender;

						__.setSelect('#roletxt_' + id, role);
						__.setSelect('#gendertxt_' + id, gender);
					});

					$(document).trigger("site/newContent");
				} else {
					__.logWarn("ajax member load all  : data.lenght == 0 ");
					$('.membermanagementdetails').html('no data');
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member load all error : " + errorThrown);
				$('.membermanagementdetails').html(errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax member load all complete : " + textStatus);
				
			}
		});
	};
	__.facebooky.manage = function() {
		$('.membermanagementparent').remove();
		__.layout.content().html(__.tmp2html('facebooky-member-management-tmp', [1]));
		$(document).trigger("site/newContent");
		$('.membermanagementparent').hide();
		$('.membermanagementparent').show('slow');
		if (__.layout.content().children().length > 7) {
			$('html, body').animate({
				scrollTop : $('.membermanagementparent').last().offset().top - 100
			}, 500);
		}

		$("#member-filter-txt").bind("keypress", function(e) {

			if (e.keyCode == 13) {
				__.facebooky.loadAll();
			}
		});

	};
	__.facebooky.doUpdate = function(id) {
		var email = $('#emailtxt_' + id).val();
		var password = $('#passwordtxt_' + id).val();
		var name = $('#nametxt_' + id).val();
		var gender = $('#gendertxt_' + id + " option:selected").text();
		var role = $('#roletxt_' + id + " option:selected").text();
var member = $('#membertxt_' + id).val();
		var _url = __.getWebServicesURL() + "/facebooky.member.php";
		__.log("call service = " + _url);
		$('#memberdetailsinfotxt_' + id).html('Loading ....');
		$.ajax({
			url : _url,
			data : {
				method : "update",
				name : __.spy(name),
				password : __.spy(password),
				email : __.spy(email),
				gender : __.spy(gender),
				id : id,
				role : __.spy(role),
				member : __.spy(member)
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				$('#memberdetailsinfotxt_' + id).html('Data Saved Succeed !!');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member update error : " + errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax member updatd complete : " + textStatus);
			}
		});

	};
	__.facebooky.doDelete = function(id) {

		var name = $('#nametxt_' + id).val();
		var _url = __.getWebServicesURL() + "/facebooky.member.php";
		__.log("call service = " + _url);
		$('#memberdetailsinfotxt_' + id).html('Loading ....');
		$.ajax({
			url : _url,
			data : {
				method : "delete",
				id : __.spy(id.toString())
			},
			type : "POST",
			dataType : "json",
			crossDomain : true,
			timeout : 60000,
			success : function(data, textStatus, jqXHR) {

				$('#memberinfocontent_' + id).html('<hr><div style="color: red;font-weight: bold;"> ' + name + ' was Deleted !!' + "</div><hr>");
			},
			error : function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member update error : " + errorThrown);
			},
			complete : function(jqXHR, textStatus) {
				__.logInfo("ajax member updatd complete : " + textStatus);
			}
		});

	};
	__.facebooky.showDetails = function(id) {
		$('#memberinfoview_' + id).slideToggle();
	};



    $(document).trigger("template/activated", "Facebooky");
    	$(document).on("site/member/changed", function(e, args) {
		__.facebooky.display();
	});
});