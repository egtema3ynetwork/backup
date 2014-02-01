$(function(){

    
    __.showFiles = function(id) {
        $('#files_' + id).html('Searching ...');

	
        __.ajax({
            serviceName : "uploader/manage",
        		    method : "list",
            id : id},
		
			 function(data, textStatus, jqXHR) {
			     $('#files_' + id).html('');
			     var dir = __.webServicesURL() + '/uploader/files/' + id + "/";
			     if (!!data && !!data.files && data.files.length > 0)
			     {
			         $.each(data.files, function () {
			             $('<div class="row-fluid" ><a href="' + dir + '/' + this + '" target="_blank" class="span10">' + this + '</a> <div class="btn btn-small btn-danger span2" align="left">X</div></div><br/>').appendTo('#files_' + id);

			         });
			     }else
			     {
			         $('#files_' + id).html('No Files');
			     }
				

			 },
			function(errorThrown , textStatus, jqXHR  ) {
			    __.logErr("ajax  error : " + errorThrown);
			    $('#files_' + id).html('No Files');
			},
			 function(textStatus ,jqXHR ) {
			     __.logInfo("ajax complete : " + textStatus);

			 }
        );
    };

});