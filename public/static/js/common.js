$(function(){

	init();

})

function init(){

	var registerObj = $("#registerForm");
	if(registerObj.length > 0 ){
		registerObj.submit(function(e) {
			ajaxPost(e,registerObj,"/user/registerPost");
		});
	}

	var loginObj = $("#loginForm");
	if(loginObj.length > 0 ){
		loginObj.submit(function(e) {
			ajaxPost(e,loginObj,"/user/loginPost");
		});
	}


	var activeObj = $("#activeForm");
	if(activeObj.length > 0 ){
		activeObj.submit(function(e) {
			ajaxPost(e,activeObj,"/user/activePost");
		});
	}

	var settingObj = $("#settingForm");
	if(settingObj.length > 0 ){
		settingObj.submit(function(e) {
			ajaxPost(e,settingObj,"/user/settingPost");
		});
	}

	var createObj = $("#createForm");
	if(createObj.length > 0 ){
		createObj.submit(function(e) {
			ajaxPost(e,createObj,"/post/createPost");
		});
	}

	var commentObj = $("#commentForm");
	if(commentObj.length > 0 ){
		commentObj.submit(function(e) {
			ajaxPost(e,commentObj,"/post/commentPost");
		});
	}


	var uploadUserAvatar = $("#uploadUserAvatar");
	if(uploadUserAvatar.length > 0 ){

		uploadUserAvatar.click(function(){
			$("#imageInput").click();
		});

		changeUploadImage()
	}


    // init editor    
    var editorObj = $("#editor");

    if(editorObj.length > 0){
        
        var editor = new Editor({
            element: editorObj.get(0),
            status:false
        });
        editor.render();

		$("#imageLocalButton").click(function(){
		 	return  $("#imageInput").click();
		});

        changeUploadImage();

    }  



    var showComments = $("#showComment");
    var post_id = $("#post_id").val();
    if(showComments.length > 0 ){
    	var url = "/post/comment?post_id="+post_id;
    	getPostComments(showComments,url);

    }

    var showCategory = $("#categories_list");
    if(showCategory.length > 0){
    	getCategoriesList();
    }

    var showPostsList = $("#posts_list");
    if(showPostsList.length > 0){
    	getPostsList();
    }


    initAjaxCSRF();

}

function clickCategory(){
	$('.category-item').bind('click',function(){
	  	var id = $(this).attr("data-id");
	  	$("#category_id").val(id);
	  	getPostsList();
	});
}

function initPage(){
	$('.page-button').bind('click',function(){
	  	var id = $(this).attr("data-id");
	  	$("#page").val(id);
	  	getPostsList();
	});
}

function initTimeago(){
    $('.timeago').each(function(){
        var time_str = $(this).text();
        if(moment(time_str, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
            $(this).text(moment(time_str).fromNow());
        }
    });
}

function getCategoriesList(){


	var url = BASE_URL+"post/category";
	$.ajax({
		type: "get",
		url: url,
		timeout : 10000,
		dataType: "json",
		success: function(data){				
			$("#categories_list").html(data.categories_list);
			clickCategory();
		},
       	error:function(error) {

        },
		complete : function(XMLHttpRequest,status){
		}
    });
}

function getPostsList(){
	var user_id = $("#user_id").val();
	var category_id = $("#category_id").val();
	var page = $("#page").val();
	
	if(page == undefined){
		page = 0;
	}
	var url = BASE_URL+"post/query?page="+page;
	if(user_id != undefined){
		url+='&user_id='+user_id;
	}
	if(category_id != undefined){
		url+='&category_id='+category_id;
	}
	var loading = "<div style='text-align:center'><img src='"+BASE_URL+"public/static/img/loading.gif'/></div>"
	$("#posts_list").html(loading);
	$.ajax({
		type: "get",
		url: url,
		timeout : 10000,
		dataType: "json",
		success: function(data){				
			$("#posts_list").html(data.posts_list);
			initTimeago();
			initPage();
		},
       	error:function(error) {

        },
		complete : function(XMLHttpRequest,status){

		}
    });

}

function getPostComments(obj,url){
	$.ajax({
		type: "get",
		url: url,
		timeout : 10000,
		dataType: "json",
		success: function(data){				

			obj.html(data.comments_list);
			initTimeago();
		},
       	error:function(error) {

        },
		complete : function(XMLHttpRequest,status){
		}
    });
}



function ajaxPost(e,obj,url){

		hideAlertNotice();

		showBtnLoading();

		var data = obj.serialize();
		$.ajax({
			type: "POST",
			url: url,
			timeout : 10000,
			dataType: "json",
			data: data, // serializes the form's elements.
			success: function(data){

				if(data.error){
					showAlertNotice(data.error);
					refreshFormCSRF(data.csrf);
				}else if(data.success){
					showSuccessNotice(data.success);
				}else if(data.redirect){
					location.href = data.redirect;
				};				

			},
           	error:function(error) {

            },
			complete : function(XMLHttpRequest,status){
				hideBtnLoading();
			}
        });
		e.preventDefault(); // avoid to execute the actual submit of the form.
		
}

function refreshFormCSRF(data){
	CSRF_HASH = data.hash;
}

function initAjaxCSRF(){

	$(document).ajaxSend(function (event,xhr,options) {
		var csrf_name = CSRF_NAME;
		var csrf_hash = CSRF_HASH;
		var type = options.type.toUpperCase();
		if (type == 'POST') {
			if(options.data == null || options.data == undefined || options.data == ""){
				options.data = {};
				options.data[csrf_name] = csrf_hash;
			}else{
				if(typeof(options.data) == "object"){
					options.data[csrf_name] = csrf_hash;
				}else{
					options.data += "&"+csrf_name+"="+csrf_hash;
				}
			}
		  		
		}
	});
	

}

function showBtnLoading(){
	var btn = $(":submit");
	btn.attr("data-loading-text","Going...");
	btn.button("loading");
}

function hideBtnLoading(){
	var btn = $(":submit");
	btn.button("reset");
}


function hideAlertNotice(){
	$(".alert-required").each(function(){
	    var value = $(this).hide(); 
	});
}

function showAlertNotice(data){
	for(var name in data){
		$("#"+name+"Alert").html(data[name]).show();
	}
	
}

function showSuccessNotice(data){
	$("#"+data.name+"Success").html(data.notice).show();
}


function changeUploadImage(){
	$("#imageInput").off("change");
	$("#imageInput").on("change", function () {
		ajaxUploadImage();
	});	
}


function ajaxUploadImage(){
	hideAlertNotice();
	showBtnLoading();
	var url = "/upload/image";
	var data = {};
	$.ajaxFileUpload({
		url:url,
		timeout:60000,
		secureuri:false,                       
		fileElementId:["imageInput"],            
		dataType:"json",
		type : "post",                       
		data:data,
		success:function(data, status ){ 
				if(data.error){
					showAlertNotice(data.error);
				}else if(data.success){
					if($("#avatar").length > 0 ){
						$("#avatar").attr("src",BASE_URL+data.success.url);
						$("#userAvatar").val(data.success.url);
					};
					if($("#imageUrl").length > 0)
					{
						$("#imageUrl").val(data.success.url);
					}
				}	
				refreshFormCSRF(data.csrf);		
		},
		error:function(data, status, e ,w){

		},
		
		complete:function(data, status){
			hideBtnLoading();
			changeUploadImage();
		}
		
		
	  
	});
}
