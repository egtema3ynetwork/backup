$(function () {

    __.member.managementToggle = function () {
        $('.membermanagementdetails').slideToggle();
    };
    __.member.loadAll = function () {
        $('.membermanagementdetails').html('<div class="loadtxt row-fluid" ><img src="./client/images/load.gif"/><div data-en="Loading Members " data-ar="جارى تحميل المشتركين من فضلك انتظر قليلا" > ' + 'جارى تحميل المشتركين من فضلك انتظر قليلا   ' + '</div></div> ');
        var value = $('#member-filter-txt').val();
       
        __.ajax({
            serviceName: "site.member",
           
                method: "all",
                value: __.spy(value)
            },
            function (data, textStatus, jqXHR) {

                __.log("ajax member load all success fire");
                if (data.data.length > 0) {
                    var i = 1;
                    $.each(data.data, function () {
                        this.index = i;
                        i++;
                        if (!!this.userid) {
                            this.imageurl = 'https://graph.facebook.com/' + this.userid + '/picture?type=square';
                        } else {
                            this.imageurl = './client/images/' + this.gender + '.jpg';
                        }
                        this.time = __.relativeTime(this.timeago);

                    });

                    var divtmp = __.tmp2html('#site-member-management-details-div-tmp', data.data);

                    $('.membermanagementdetails').html(divtmp);
                    $('.membermanagementdetails').hide();
                    $('.membermanagementdetails').show('slow');

                    $.each(data.data, function () {

                        var id = this.id;
                        var role = this.role;
                        var gender = this.gender;

                      $("#roletxt_" + id).append(__.tmp2html(db.select_option_tmp, __.member.roles));
                        __.setSelect('#roletxt_' + id, role);
                        __.setSelect('#gendertxt_' + id, gender);
                    });

                    $(document).trigger("site/newContent");
                } else {
                    __.logWarn("ajax member load all  : data.lenght == 0 ");
                    $('.membermanagementdetails').html('no data');
                }
            },
           function ( errorThrown) {
                __.logErr("ajax member load all error : " + errorThrown);
                $('.membermanagementdetails').html(errorThrown);
            },
             function ( textStatus) {
                __.logInfo("ajax member load all complete : " + textStatus);

            }
        );
    };
    __.member.manage = function (_value) {
        $('.membermanagementparent').remove();
        __.layout.content().html(__.tmp2html('site-member-management-div-tmp', [1]));
        $(document).trigger("site/newContent");
        $('.membermanagementparent').hide();
        $('.membermanagementparent').show('slow');
        $('#member-filter-txt').val(_value);
        __.member.loadAll();
        if (__.layout.content().children().length > 7) {
            $('html, body').animate({
                scrollTop: $('.membermanagementparent').last().offset().top - 100
            }, 500);
        }

        $("#member-filter-txt").bind("keypress", function (e) {

            if (e.keyCode == 13) {
                __.member.loadAll();
            }
        });

    };

    __.member.doDelete = function (id) {

        var name = $('#nametxt_' + id).val();
      
        $('#memberdetailsinfotxt_' + id).html('Loading ....');
        __.ajax({
            serviceName: "site.member",
          
                method: "delete",
                id: __.spy(id.toString())
            },
            function (data, textStatus, jqXHR) {

                $('#memberinfocontent_' + id).html('<hr><div style="color: red;font-weight: bold;"> ' + name + ' was Deleted !!' + "</div><hr>");
            },
            function ( errorThrown) {
                __.logErr("ajax member update error : " + errorThrown);
            },
            function ( textStatus) {
                __.logInfo("ajax member updatd complete : " + textStatus);
            }
        );

    };
    __.member.showDetails = function (id) {
        $('#memberinfoview_' + id).slideToggle();
    };

   

});

