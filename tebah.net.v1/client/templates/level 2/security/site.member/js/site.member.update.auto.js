$(function() {

	__.member.doUpdate = function(id) {
		var email = $('#emailtxt_' + id).val();
		var password = $('#passwordtxt_' + id).val();
		var name = $('#nametxt_' + id).val();
		var gender = $('#gendertxt_' + id + " option:selected").text();
		var role = $('#roletxt_' + id + " option:selected").text();
		var member = $('#membertxt_' + id).val();
		var faceid = $('#faceidtxt_' + id).val();
		 
		$('#memberdetailsinfotxt_' + id).html('Loading ....');
		__.ajax({
		    serviceName: "site.member",
			
				method : "update",
				name : __.spy(name),
				password : __.spy(password),
				email : __.spy(email),
				gender : __.spy(gender),
				id : __.spy(id.toString()),
				role : __.spy(role),
				member : __.spy(member),
				faceid : __.spy(faceid)
			},
			 function(data, textStatus, jqXHR) {

				$('#memberdetailsinfotxt_' + id).html('Data Saved Succeed !!');
				$('#memberinfoview_' + id).toggle('slow');
			},
			 function(jqXHR, textStatus, errorThrown) {
				__.logErr("ajax member update error : " + errorThrown);
				$('#memberdetailsinfotxt_' + id).html('');
			},
			 function(jqXHR, textStatus) {
				__.logInfo("ajax member updatd complete : " + textStatus);
			}
		);

	};

});
