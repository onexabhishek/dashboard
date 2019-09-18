let siteUrl = window.location.protocol+'//'+window.location.hostname+'/dashboard/';

$(".form-create-question").on('submit',(e)=>{
		e.preventDefault();
		// console.log(e.target.action);
		insert_form(e.target,$(".form-create-question").serializeArray(),e.target.getAttribute('next-step'));
});



$(".form-insert").on('submit',(e)=>{
		e.preventDefault();
		// console.log(e.target.action);
		insert_form(e.target,$(".form-insert").serializeArray());
	});


$(".form-update").on('submit',(e)=>{
		e.preventDefault();
		// console.log(e.target.action);
		update_form(e.target,$(".form-insert").serializeArray());
});


function insert_form(e,data,next=false){
	$.ajax({
		type:e.method,
		url:e.action+'?form_insert=true&table='+e.getAttribute('data-target'),
		data:data,
		success:(success)=>{
			if(success.trim() == 1){
				// init_alert();
				if(next){
					window.location.href = window.location.href+'/'+next;
				}else{
				window.location.reload();
			}
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
function update_form(e,data){
	$.ajax({
		type:e.method,
		url:e.action+'?form_update=true&table='+e.getAttribute('data-target'),
		data:data,
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


// Unique Element Initial Value Container
let unique_values = {};
$.each($('.unique'),(index,value)=>{
	unique_values[$('.unique').eq(index).attr('id')] = $('.unique').eq(index).val();

})
// console.log(unique_values);
$('.unique').on('keyup',(e)=>{
	e.preventDefault();
	let table = e.target.getAttribute('unique-in');
	let feild = e.target.getAttribute('name');
	let value = e.target.value;
	let id = e.target.id;
	if(value != unique_values[id]){
	$.post('../adp/validate',{table:table,feild:feild,value:value},(success)=>{
		console.log(success);
		if(success.trim() == '1'){
			// $('#'+id).hide();
			form_alert(id,'danger',value+' already taken');
			$('.adp-submit').addClass('disabled');
		}else{
			form_alert(id,'','');
			$('.adp-submit').removeClass('disabled');
		}
	})
}

})

function json_to_params(val){
	Object.keys(val).map(function(k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(val[k])
}).join('&')
}

function form_alert(id,priority,msg){
	if(!($('#alert'+id).length > 0)){
		$('#'+id).after(`<div class="adp-form-alert" id="alert${id}"></div>`);
	}
	$('#alert'+id).html(`<p class="text-${priority}">${msg}</p>`);
}

// Question Controoler
$('.question_type').on('change',()=>{
	if($(this).val() == 'check'){
		// $('.answer-container').html('');
	}else if($(this) == 'radio'){
		$('.answer-container').html('<button class="btn btn-default" data-type="radio">Add Option</button>');
	}else{
		$('.answer-container').html('<button class="btn btn-default" data-type="check">Add Option</button>');
	}
});


$('#question_editor').summernote({
        placeholder: 'Add Description..',
        tabsize: 2,
        height:200,
        callbacks:{
            onBlur:function(){
                $('#question_value').val($(this).summernote("code"));
            }
        },
    codemirror: { // codemirror options
    theme: 'monokai'
  }
});

// $('#summernote').summernote("code"); 
// $('#summernote').summernote("code",`<?=isset($respage->des) ? $respage->des : '';?>`); 
