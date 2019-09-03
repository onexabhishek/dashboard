function insert_form(){
	$.ajax({
		type:elem.attr('method'),
		url:elem.attr('method'),
		data:elem.attr('method'),
		success:(success)=>{
			console.log(success);
		},
		error:(err)=>{
			console.log(err);
		}
	})
}