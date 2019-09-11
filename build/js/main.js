let siteUrl = window.location.protocol+'//'+window.location.hostname+'/dashboard/';
$(".form-insert").on('submit',(e)=>{
		e.preventDefault();
		// console.log(e.target.action);
		insert_form(e.target.action,e.target.method,e.target.getAttribute('data-target'));
	});
$(".form-update").on('submit',(e)=>{
		e.preventDefault();
		// console.log(e.target.action);
		update_form(e.target.action,e.target.method,e.target.getAttribute('data-target'));
});
function insert_form(url,type,table){
	$.ajax({
		type:type,
		url:url+'?form_insert=true&table='+table,
		data:$(".form-insert").serializeArray(),
		success:(success)=>{
			if(success.trim() == 1){
				// init_alert();
				window.location.reload();
			}else if(success.trim() == 0){
				init_alert();
			}
			console.log(success);
		},
		error:(err)=>{
			console.log(err);
		}
	})
}
function update_form(url,type,table){
	$.ajax({
		type:type,
		url:url+'?form_update=true&table='+table,
		data:$(".form-update").serializeArray(),
		success:(success)=>{
			if(success.trim() == 1){
				// init_alert();
				window.location.reload();
			}else if(success.trim() == 0){
				init_alert();
			}
			console.log(success);
		},
		error:(err)=>{
			console.log(err);
		}
	})
}

function init_alert(){
	$.ajax({
		type:'POST',
		url:siteUrl+'adp/init_alert',
		success:(success)=>{
		let data = JSON.parse(success);
			alert_msg(data.type,data.msg);
		console.log(data);
		},
		error:(err)=>{
			alert_msg('danger',err);
		}
	})	
}

let inp = $('.adp-validate');
 $.each(inp,(e,v) =>{
       v.after(document.createElement('span'));
    });
$('.adp-validate-form .adp-submit').on('click',(e)=>{
	
let proceed = false;
	let err_msg = `<span class="text-danger err_msg"></span>`;
	
	let regBundle = {notEmpty:/([^\s])/,name:/^[a-zA-Z ]+$/,email:/^\w+([-+.']\w+)*@\w+([-. ]\w+)*\.\w+([-. ]\w+)*$/,password:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/};
	for(let i=0;i<inp.length;i++){

		if(inp.eq(i).val() == ''){
			if($('#validationErr'+i).length != 0){
				$('#validationErr'+i).html(`<span class="text-danger"> * Field is Required </span>`);
			}else{
				gen_err_container(inp,i);
				$('#validationErr'+i).html(`<span class="text-danger"> * Field is Required </span>`);
			}
      		e.preventDefault();
		}
		else if(!inp.eq(i).val().match(new RegExp(regBundle[inp.eq(i).attr('data-validate')]))){

			if($('#validationErr'+i).length != 0){
				$('#validationErr'+i).html(`<span class="text-danger">* Please Enter a valid ${typeof inp.eq(i).attr('placeholder') != 'undefined' ? inp.eq(i).attr('placeholder') : 'data'} </span>`);
			}else{
				gen_err_container(inp,i);
				$('#validationErr'+i).html(`<span class="text-danger"> * Please Enter a valid ${typeof inp.eq(i).attr('placeholder') != 'undefined' ? inp.eq(i).attr('placeholder') : 'data'} </span>`);
			}
      			e.preventDefault();
		}else{
      		$('#validationErr'+i).empty();
		      proceed = true;
		}
	}
// if(proceed){
//    $('.reg-form').submit();
// }
});
function gen_err_container(dom,i){
dom.eq(i).after(`<div class="adp_error_container" id="validationErr${i}"></div>`);
}

$('.unique').on('keyup',()=>{
	let table = $(this).attr('unique-in');
	let feild = $(this).attr('name');
	let value = $(this).val();
	$.ajax({
		type:'POST',
		url:'./adp/validate',
		data:JSON.stringify({table:table,feild:feild,value:value}),
		success:(success)=>{
			console.log(success);
		}
	})
})