 var datavb;
 	$.post('./adp/init_plugin',(data)=>{
    // let plugin_arrays = JSON.parse(data);
    // for(i in plugin_arrays){
    //   console.log(plugin_arrays[i]);
    // }

  localStorage.setItem('active_plugins',JSON.parse(data).ative_plugins);
  localStorage.setItem('checked',JSON.parse(data).checked);
})
  let obj = new Array();
  let lists_obj = new Array();
  let data_obj = new Object();
  let listsFormate = new Object();
  let bundleNodes = new Object();
  let packageArray = new Array();
class Media_gallery {
  constructor(elem){
    this.element = elem;
  }
  setDir(current){
    localStorage.setItem('current_dir',current)
  }
  getDir(){
    return localStorage.getItem('current_dir');
  }
  setPath(current_path){
    localStorage.setItem('path',current_path)
  }
  getPath(){
    return localStorage.getItem('path');
  }
  setBase(base_path){
    localStorage.setItem('base',base_path)
  }
  getBase(){
    return localStorage.getItem('base');
  }
  setMimeType(mime_type){
    localStorage.setItem('mime_type',mime_type);
    localStorage.setItem('mime',true);
  }
  getMime(){
      return {
        "mime" : localStorage.getItem('mime'),
        "mime_type" : localStorage.getItem('mime_type')
      }
  }
  setCurrentPlugin(plugin){
    localStorage.setItem('current_plugin',plugin);
  }
  setPlugins(index,id,action){
    console.log('dfrtyu');
    if(localStorage.getItem('active_plugins') != '' && localStorage.getItem('active_plugins') != null){
      obj = JSON.parse(localStorage.getItem('active_plugins'));
    }
  	if(action == true){
  		for(let x=0;x<obj.length;x++){
  			console.log(obj[x]);
  			if(obj[x].name == id){
  				obj.splice(x,1);
  			}
  		}
  		obj.push({"index":index,"name":id});
  	}else{
  		for(let x=0;x<obj.length;x++){
  			if(obj[x].name == id){
  				obj.splice(x,1);
  			}
  		}
  		console.log(obj);
  	}
    // data_obj = {"index":index,"name":id};
  	console.log(typeof obj);
	localStorage.setItem('active_plugins',JSON.stringify(obj));
    // localStorage.setItem('mime',true);
  }
  setPackage(id,action,formate,parent){
    if(typeof localStorage.getItem('checked') != 'undefined' && localStorage.getItem('checked') != ''){
  
      bundleNodes = JSON.parse(localStorage.getItem('checked'));
    }
    if(typeof bundleNodes[parent] != 'undefined'){
      console.log(JSON.parse(bundleNodes[parent]));
      listsFormate = JSON.parse(bundleNodes[parent]);
      if(typeof listsFormate[formate] != 'undefined' && listsFormate[formate] != ''){
        console.log(listsFormate[formate]);
        lists_obj = listsFormate[formate].split();

        console.log(lists_obj);
      }else{
        lists_obj = [];
      }
    }else{
      listsFormate = {};
      lists_obj = [];
    }
    
  	if(action == true){
  		for(let x=0;x<lists_obj.length;x++){
  			console.log(lists_obj[x]);
  			if(lists_obj[x] == id){
  				lists_obj.splice(x,1);
  			}
  		}
  		lists_obj.push(id);
  	}else{
  		for(let x=0;x<lists_obj.length;x++){
  			if(lists_obj[x] == id){
  				lists_obj.splice(x,1);
  			}
  		}
  		console.log(lists_obj);
  	}
  	
    listsFormate[formate] = lists_obj.join();
    bundleNodes[parent.toString()] = JSON.stringify(listsFormate);
    console.log(bundleNodes);
	localStorage.setItem('checked',JSON.stringify(bundleNodes));
    // localStorage.setItem('mime',true);
  }
  getPackage(){
    return localStorage.getItem('checked');
  }
  getPlugins(){
    return localStorage.getItem('active_plugins');
  }
  isRoot(){
    if(this.getBase() == this.getDir()){
      return true;
    }else{
      return false;
    }
  }
  media_init(folder,action,current=false,isRev=false){
  	folder == '' || folder == null || folder == false ? folder = this.getBase() : '';
    this.setDir(current);
    this.setPath(folder);
    $('.media-back').val(folder.replace(/\/+/g, '\/'));
    $('.media-back').attr('data-rel',current);
    if(current && current != media_gallery.getBase() && !isRev){
       route.push(current); 
    }

    $.post('./adp/get_plugins',{
      "action":action,
      "folder":folder
    },function(data){
      // console.log(data);
      // if(action != 'get_all_files'){
    
          this.create_body(data);
        
      // }
      
    }.bind(this))
  }
  create_body(data){
    let file_data = JSON.parse(data);
    let views = '';
    let i;
    let n=1;
    console.log(this.isRoot());
    if(this.isRoot()){
    for(i in file_data){
      if(file_data[i].type =='folder'){
         // console.log(file_data[i].path.replace(/\.\/+/g, ''));
         views += `<tr><td>${n++}</td><td id="elem${n}" class="path-wraper disable">
         <a href="${file_data[i].path.replace(/\.\/+/g, '')}" class="adp-folder-path adp-plugins disabled" data-id="${file_data[i].name}" disabled="disabled">
            <img class="adp-prev-folder" src="./images/app/folder.png">
            <span class="folder-name">${file_data[i].name}</span>
            </a>
          </td><td><input type="checkbox" data-index="elem${n}" data-rel="${file_data[i].path.replace(/\.\/+/g, '')}" data-id='${file_data[i].name}' class="js-switch adp-check-plugins" /></td></tr>`;

      }
     
    }
  }else{
    for(i in file_data){
      if(file_data[i].type =='folder'){
         // console.log(file_data[i].path.replace(/\.\/+/g, ''));
         views += `<tr><td>${n++}</td><td id="elem${n}" class="path-wraper">
         <a href="${file_data[i].path.replace(/\.\/+/g, '')}" class="adp-folder-path" data-id="${file_data[i].name}" disabled="disabled">
            <img class="adp-prev-folder" src="./images/app/folder.png">
            <span class="folder-name">${file_data[i].name}</span>
            </a>
          </td><td></td></tr>`;

      }
     
    }
  }
    
    for(i in file_data){
      if(file_data[i].type =='file'){
        // if(this.testMime(file_data[i].mime_type)){
        if(file_data[i].mime_type == 'image/jpeg' || file_data[i].mime_type == 'image/jpg' || file_data[i].mime_type == 'image/png' || file_data[i].mime_type == 'image/gif'){
           views += `<tr><td>${n++}</td><td>
            <a href="${file_data[i].path}" class="adp-thumb-wrapper">
            <img class="adp-thumb" src="${file_data[i].path}">
            </a>
            <span class="folder-name">${file_data[i].name.substring(0,25)}</span>
          </td><td><input data-parent=""  data-formate="${file_data[i].formate}" data-id='${file_data[i].path}' type="checkbox" class="flat adp-check"></td></tr>`;
        }else{
          views += `<tr><td>${n++}</td><td>
            <a href="${file_data[i].path}" class="adp-thumb-wrapper">
            <img class="adp-thumb" src="./images/app/${file_data[i].formate}.png">
            </a>
            <span class="folder-name">${file_data[i].name.substring(0,25)}</span>
          </td><td><input data-formate="${file_data[i].formate}" data-id='${file_data[i].path}' type="checkbox" class="flat adp-check"></td></tr>`;
        }
      
      // }
    }
     
    }
    $('.view_folders').html(views);
    react();
    if(this.isRoot()){
      check_data();
    }else{
      check_file();
    }
    
    var elems2 = Array.prototype.slice.call(document.querySelectorAll('.adp-check-plugins'));
      elems2.forEach(function(html3) {
      var switchery = new Switchery(html3);
    });
      // file manager feature
    $('.adp-folder-path').click(function(e){
      e.preventDefault();
      // $('.media-back').attr('data-rel',$(this).attr('data-id'));
      media_gallery.media_init($(this).attr('href'),'get',$(this).attr('data-id'),false);
      // console.log(media_gallery.getCurrent());
        })
    $('.adp-check').on('ifChanged', function(event){
    	console.log(event);
  		media_gallery.setPackage($(this).attr('data-id'),event.target.checked,$(this).attr('data-formate'),route[1]);
	});
	$('.adp-check-plugins').on('change', function(event) {
  		// console.log('triggred'+event.type);
      ativate_plugin($(this).attr('data-index'));
  		media_gallery.setPlugins($(this).attr('data-index'),$(this).attr('data-id'),event.target.checked );
      // media_gallery.media_init($(this).attr('data-rel'),'get_all_files');      
	});
  $('.adp-plugins').click(function(){
    media_gallery.setCurrentPlugin($(this).attr('data-id'));
  });
  }
  
  testMime(mime){
    // console.log(media_gallery.getMime().mime);
    if(this.getMime().mime != 'false'){
      if(this.getMime().mime_type == mime){
        return true;
      }
      }else{
      return true;
    }
  }
  activate_plugins(){
    $.post('./adp/info_db',{checked : media_gallery.getPackage(),ative_plugins:media_gallery.getPlugins()},function(data){
      console.log(data);
    })
  }
 

}
const media_gallery = new Media_gallery;
media_gallery.setBase('./vendors');
var route = [media_gallery.getBase()];
// media_gallery.setMimeType('image/jpeg');
$('.media-back').click(()=>{
  if(route.join() != media_gallery.getBase()){
    route.pop();
  }
  let currentDir = media_gallery.getDir();
  let path = media_gallery.getPath();
  let level_up = path.substring(0,path.lastIndexOf(currentDir)-1);
  media_gallery.media_init(level_up,'get',route[route.length-1],true);
})
media_gallery.media_init(media_gallery.getBase(),'get',route[route.length-1]);
function react(){
	$(".adp-check").iCheck({checkboxClass:"icheckbox_flat-green",radioClass:"iradio_flat-green"});
}
function check_data(){
  let tar_elem_array = JSON.parse(localStorage.getItem('active_plugins'));
  for(i in tar_elem_array){
    // console.log(typeof tar_elem_array[i].index);
    ativate_plugin(tar_elem_array[i].index);
    $('input[data-index='+tar_elem_array[i].index+']').click();
  }
}
function check_file(){
  let current_plugin = localStorage.getItem('current_plugin');
  if(localStorage.getItem('checked') != ''){
  let active_files = JSON.parse(localStorage.getItem('checked'));
  if(typeof active_files[current_plugin] != 'undefined'){
    let js_arry = JSON.parse(active_files[current_plugin]).js.split(',');
    for(let i=0;i<js_arry.length;i++){
      $("input[data-id|='"+js_arry[i]+"']").iCheck('check');
    }
    
  console.log(JSON.parse(active_files[current_plugin]).js || JSON.parse(active_files[current_plugin]).css);
  }
  console.log(active_files);

  }
}
function ativate_plugin(id){
  // console.log(id);
    let tar_elem = $('#'+id);
    tar_elem.removeClass('disable');
    tar_elem.children().removeClass('disabled');

}
$('.activate-plugins').click(()=>{
  media_gallery.activate_plugins();
})
$('.bolt').click(()=>{
  $.post('./adp/init_plugin/DateJS',(data)=>{
    console.log(data);
  })
})
