
var menuimage = "<img style='width: 24px;height: 24px;margin:5px;align:left;' src='images/twitter.ico'/>";
db.menu = [

  {name: "Control Panal", en: "Control Panal", ar: "وحدة التحكم", id: 1, action: "__.menu.show(1);", css: "theme ", role : "Administrator"
   , submenu :[
    {name: "Members Management", en: "Members Management", ar: "إدارة المشتركين", id: "x", action: "__.member.manage();", css: "", role : "Administrator member"},
     {name: "Members Management", en: "Members Management", ar: " تحديث البوستات اوتوماتك الان", id: "x", action: "__.facebook.autoUpdateFeeds ();", css: "", role : "Administrator member"},
     
   ] },
  
    {name: "Social Feeds", en: "Social Feeds", ar: "شبكة التواصل الاجتماعى", id: 2, action: "__.menu.show(2);  ", css: "theme ", role : "anyone"
    , submenu :[
    {name: "Latest Feeds", en: "Latest Feeds", ar: "احدث البوستات ", id: "x", action: "__.facebook.loadFeeds(0);", css: "", role : "anyone"},
    {name: "Islamic Feeds", en: "Islamic Feeds", ar: "بوستات اسلامية", id: "x", action: "__.facebook.loadFeeds(0,1);", css: "", role : "anyone"},
    {name: "Revolutionary Feeds", en: "Revolutionary Feeds", ar: "بوستات ثورية", id: "x", action: "__.facebook.loadFeeds(0,2);", css: "", role : "anyone"},
    {name: "Political Feeds", en: "Political Feeds", ar: "بوستات سياسية واخبارية", id: "x", action: "__.facebook.loadFeeds(0,3);", css: "", role : "anyone"},
        {name: "Comic Feeds", en: "Comic Feeds", ar: "بوستات ترفيهية وكوميديه", id: "x", action: "__.facebook.loadFeeds(0,4);", css: "", role : "anyone"},
            {name: "Cultural Feeds", en: "Cultural Feeds", ar: "بوستات علمية وثقافيه", id: "x", action: "__.facebook.loadFeeds(0,5);", css: "", role : "anyone"},
                {name: "Jobs Feeds", en: "Jobs Feeds", ar: "بوستات وظائف وتعليم", id: "x", action: "__.facebook.loadFeeds(0,6);", css: "", role :"anyone"},
                    {name: "Variety Feeds", en: "Variety Feeds", ar: "بوستات منوعة", id: "x", action: "__.facebook.loadFeeds(0,7);", css: "", role : "anyone"},
                        {name: "Sport Feeds", en: "Sport Feeds", ar: "بوستات رياضية", id: "x", action: "__.facebook.loadFeeds(0,8);", css: "", role : "anyone"},
                            {name: "Girls Feeds", en: "Girls Feeds", ar: "بوستات للبنات فقط", id: "x", action: "__.facebook.loadFeeds(0,9);", css: "", role : "anyone"},
                                {name: "Decor Feeds", en: "Decor Feeds", ar: "بوستات الديكور", id: "x", action: "__.facebook.loadFeeds(0,10);", css: "", role : "anyone"},
                                    {name: "Arts Feeds", en: "Arts Feeds", ar: "بوستات فنية", id: "x", action: "__.facebook.loadFeeds(0,11);", css: "", role : "anyone"},
                                        {name: "Unspecified Feeds", en: "Unspecified Feeds", ar: "بوستات جارى تصنيفها", id: "x", action: "__.facebook.loadFeeds(0,12);", css: "", role : "anyone"},
                                         {name: "Forbidden Feeds", en: "Forbidden Feeds", ar: "بوستات ممنوعة من العرض", id: "x", action: "__.facebook.loadFeeds(0,666);", css: "", role : "Administrator"},
                                        
    ]},
    
    {name: "Social Applications", en: "Social Applications", ar: " برامج تسويق الكترونى", id: 3, action: "__.menu.show(3);  ", css: "theme ", role : " anyone"
    , submenu : [
     {name: "Facebook SilverLight", en: "Facebook SilverLight", ar: "برنامج محاكاة الفيسبوك", id: "x", action: "window.open('http://egtema3y.com/facebook/silverlight.php?membername=_free');", css: "", role : "  anyone"},
     {name: "Facebooky Website", en: "Facebooky Website", ar: "موقع فيسبوكى", id: "x", action: "window.open('http://facebooky.egtema3y.com');", css: "", role : "  anyone"},
     {name: "Free Messages", en: "Free Messages", ar: "فيسبوك دسك توب", id: "x", action: "window.open('http://freemessages.webs.com/download')", css: "", role : "  anyone"},
     {name: "Yoonoo", en: "Yoonoo", ar: "البرنامج اليابانى يونو", id: "x", action: "window.open('http://yoonoo.webs.com/');", css: "", role : "  anyone"},
   
    ]},
    
    {name: "Services", en: "Services", ar: "خدمات", id: 4, action: "__.menu.show(4); " , css: "theme ", role : "anyone"
    ,submenu :[
     {name: "Chat Rooms", en: "Chat Rooms", ar: "شات إجتماعى", id: "x", action: "window.open('http://chat.egtema3y.com');", css: "", role : "anyone"},
    {name: "Shorten URL", en: "Shorten URL", ar: "موقع رائع  لاختصار لينكاتك", id: "x", action: "window.open('http://share2.in');", css: "", role : "anyone"},
    {name: "Egtema3y PHPBB", en: "Egtema3y PHPBB ", ar: "منتدى  إجتماعى", id: "x", action: "window.open('http://phpbb.egtema3y.com');", css: "", role : "anyone"},
   {name: "Smart Marketing", en: "Smart Marketing", ar: "سمارت للتسويق الالكترونى", id: "x", action: "window.open('http://smartmarketing.egtema3y.com');", css: "", role : "anyone"},
   
    
    ]},
    
];


$(function() {

    __SITE_MENU = function() {

        if (this === window)
        {
            return new __SITE_MENU();
        }

       
        this.display = function() {

$('#site-main-menu-content').remove();

            __.layout.left().append(__.tmp2html('#site-main-menu-tmp' , [1]));
            $('#site-main-menu-content').append(__.tmp2html('#site-main-menu-button-tmp'  ,db.menu));
           $('.menubutton').css("font-weight" , "bold");
           $('.menubutton').css("font-size" , "large");
           
            $.each(db.menu , function(index , item){
             $('#menu_image_' + item.id).remove();
        		$('#site-main-menu-button-content_' + item.id).append(__.tmp2html('#site-main-menu-button-tmp'  ,item.submenu));
        		$('#site-main-menu-button-content_' + item.id).show('slow');
        	});
        	
            $(document).trigger("site/newContent");
         
        };
        this.show = function(id) {
            $('#site-main-menu-button-content_' + id).slideToggle();
        };

    };

    CORE.prototype.menu = new __SITE_MENU();

    __.menu.display();

    $(document).trigger("template/activated", "Site Menu");
    	$(document).on("site/member/changed", function(e, args) {
		__.menu.display();
	});
});