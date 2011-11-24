
var PR = (function(){

 	// @Private 
	var urls = {
		kAuthCodeVerify 		: "auth_codes/verify",
		kBoardInvitationAll		: "board_invitations/index",
		kBoardInvitationView	: "board_invitations/view/",
		kBoardInvitationAccept	: "board_invitations/accept",
		kBoardInvitationDecline	: "board_invitations/decline",
		kBoardAll				: "boards/index",
		kBoardView				: "boards/view/",
		kBoardAdd				: "boards/add",
		kBoardInvite			: "boards/invite/",
		kBoardLeave				: "boards/leave",
		kCompensationAdd		: "compensations/add/",
		kCompensationEdit		: "compensations/edit/",
		kCompensationDelete		: "compensations/delete",
		kJobAdd					: "jobs/add",
		kJobEdit				: "jobs/edit/",
		kJobDelete				: "jobs/delete",
		kNetworkAdd				: "networks/add",
		kNetworkEdit			: "networks/edit/",
		kNetworkDelete			: "networks/delete",
		kNetworkDeleteMember	: "networks/delete_member",
		kResetPassowrd			: "reset_password/?code=",
		kSiteInvites			: "site_invites/index",
		kUserEdit				: "users/edit",
		kUserLogin				: "users/login",
		kUserSignup				: "users/signup/?code=",
		kUserForgotPassword		: "users/forgot_password",
		kUserUpdatePhone		: "users/update_phone",
		kValidation				: "validation"
	};
	
	var APIGetCall = function(url, success) {
		$.ajax({
			url: BASEURL + url,
			type: "GET",
			dataType: 'html',
			success: function(data){
				success(data);
			}
		});
	};
	
	var APICall = function(url, data, success) {
		$.ajax({
			url: BASEURL + url,
			type: "POST",
			data: data,
			dataType: 'json',
			success: function(data){
				success(data);
			}
		});
	};

	// @Public
	return {
		AuthCode : {
			verify : function(data, success) {
				APICall(urls.kAuthCodeVerify + "?ajax=true&output=json", data, success);
			}
		},
		BoardInvitation : {
			all: function(success) {
				APIGetCall(urls.kBoardInvitationAll + "?no_layout=true", success);
			},
			view: function(invitationId, success) {
				APIGetCall(urls.kBoardInvitationView + invitationId + "?no_layout=true", success);
			},
			accept : function(data, success) {
				APICall(urls.kBoardInvitationAccept + "?ajax=true&output=json", data, success);
			},
			decline : function(data, success) {
				APICall(urls.kBoardInvitationDecline + "?ajax=true&output=json", data, success);
			}
		},
		Board : {
			all : function(success) {
				APIGetCall(urls.kBoardAll + "?no_layout=true", success);
			},
			view : function(boardId, success) {
				APIGetCall(urls.kBoardView + boardId + "?no_layout=true", success);
			},
			add : function(data, success) {
				APICall(urls.kBoardAdd + "?ajax=true&output=json", data, success);
			},
			invite : function(boardId, data, success) {
				APICall(urls.kBoardInvite + boardId + "?ajax=true&output=json", data, success);
			},
			leave : function(data, success) {
				APICall(urls.kBoardLeave + "?ajax=true&output=json", data, success);
			}
		},
		Compensation : {
			add : function(jobId, data, success) {
				APICall(urls.kCompensationAdd + jobId + "?ajax=true&output=json", data, success);
			},
			edit : function(compansationId, data, success) {
				APICall(urls.kCompensationEdit + compansationId + "?ajax=true&output=json", data, success);
			},
			del : function(data, success) {
				APICall(urls.kCompensationDelete + "?ajax=true&output=json", data, success);
			}
		},
		Job : {
			add : function(data, success) {
				APICall(urls.kJobAdd + "?ajax=true&output=json", data, success);
			},
			edit : function(jobId, data, success) {
				APICall(urls.kJobEdit + jobId + "?ajax=true&output=json", data, success);
			},
			del : function(data, success) {
				APICall(urls.kJobDelete + "?ajax=true&output=json", data, success);
			}
		},
		Network : {
			add : function(data, success) {
				APICall(urls.kNetworkAdd + "?ajax=true&output=json", data, success);
			},
			edit : function(networkId, data, success) {
				APICall(urls.kNetworkEdit + networkId + "?ajax=true&output=json", data, success);
			},
			del : function(data, success) {
				APICall(urls.kNetworkDelete + "?ajax=true&output=json", data, success);
			}
			// removed because of duplicate name @TC
			// del : function(data, success) {
			// 	APICall(urls.kNetworkDeleteMember + "?ajax=true&output=json", data, success);
			// }
		},
		ResetCode : {
			reset_password : function(code, data, success) {
				APICall(urls.kResetPassowrd + code + "&ajax=true&output=json", data, success);
			}
		},
		SiteInvite : {
			send : function(data, success) {
				APICall(urls.kSiteInvites + "?ajax=true&output=json", data, success);
			}
		},
		User : {
			edit : function(data, success) {
				APICall(urls.kUserEdit + "?ajax=true&output=json", data, success);
			},
			login : function(data, success) {
				APICall(urls.kUserLogin + "?ajax=true&output=json", data, success);
			},
			signup : function(code, data, success) {
				APICall(urls.kUserSignup + code + "&ajax=true&output=json", data, success);
			},
			forgot_password : function(data, success) {
				APICall(urls.kUserForgotPassword + "?ajax=true&output=json", data, success);
			},
			update_phone : function(data, success) {
				APICall(urls.kUserUpdatePhone + "?ajax=true&output=json", data, success);
			}
		},
		Validation : {
			validate: function(data, success) {
				APICall(urls.kValidation + "?ajax=true&output=json", data, success);
			}
		}		
	};
})();

