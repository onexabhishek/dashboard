var info_addon = `<span class="input-group-addon" id="info_addon"></span>`;
		var info_ok = `<span class="glyphicon text-success glyphicon-ok" aria-hidden="true"></span>`;
		var danger = `<span class="glyphicon text-danger glyphicon-remove" aria-hidden="true"></span>`;
		var info_error = `<span class="glyphicon text-danger glyphicon-exclamation-sign" aria-hidden="true"></span>`;
		
		var msg_body = '<span class="adp-form-msg text-danger text-right" id="msg-body" style="display:block;"></span>';
		
		var msg_taken = 'Already taken';
		var msg_reg_success = 'Your account has been successfully created.';
		var msg_wrong = 'Something Went Wrong ! Try Again in a Little Bit.';
		var msg_saved = 'Thumbnail Saved Successfully';
	let info_icons = {danger:'glyphicon-exclamation-sign',success:'glyphicon-ok'};
	function info_body(priority){
		return `<span class="glyphicon text-danger ${info_icons[priority]}" aria-hidden="true"></span>`;
	}
	function alert_msg(t,m){
		   $('#adpAlertTrigger').remove();
		    var adp_alert_msg = `<div class="adp-alert" id="adpAlertTrigger" style="display:none;"><span class="btn-close" id="alert_msg_close">&times;</span><p class="adp-alert-msg"></p></div>`;
		    $('body').append(adp_alert_msg);
		    $('#adpAlertTrigger').fadeIn(500).addClass('alrt-bg-'+t);
		    $('#adpAlertTrigger p').html(info_body(t) + m);
		    $('#alert_msg_close').click(function(){
		        $('#adpAlertTrigger').fadeOut(1000,()=>{
		        	$(this).remove();
		        });
		    });
		     $('#adpAlertTrigger').delay(2000).fadeOut(4000,()=>{
		     	$(this).remove();
		     });
		    
		}
