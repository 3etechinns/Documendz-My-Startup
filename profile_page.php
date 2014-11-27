
<?php
require_once 'functions.php';
require_once 'email.php';

session_start();
include 'connect.php';
include 'unique_random_alphanumeric.php';

require 'vendor/autoload.php';

use Aws\S3\S3Client;

use Aws\S3\Exception\S3Exception;
?>


<!doctype html>
<meta charset="utf-8">

<title>Documendz</title>
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"> -->

<link rel="stylesheet" href="css/colorbox.css" />
<link rel="stylesheet" href="css/profile.css?var=27112014_1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/introjs.min.css">
  
  
<script src="javascripts/jquery1.9.1.js"></script>
<script src="javascripts/jquery_1.10.4_ui.js"></script>
<script src="javascripts/bootstrap.min.js"></script>
<script src="javascripts/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="javascripts/intro.min.modified.js"></script>

<script src="javascripts/jquery.colorbox.js"></script>




   
<!--<script src="jquery.gritter.min.js"></script>
<link href="jquery.gritter.css"rel="stylesheet" type="text/css" />-->
<script src="javascripts/pusher.js"></script>
<script src="push/PusherNotifier.js"></script>


<style type="text/css">
 
 /// Please style in profile.css ////

</style>


  
  <script type="text/javascript">
    
  $(function() {
  var pusher = new Pusher('ff3fbe3a49687ae0a46d');
  var channel = pusher.subscribe('my_notifications');
  var notifier = new PusherNotifier(channel);
});  
    </script>




<!--The script below executes the modal window jquery function-->

<script type="text/javascript">
 
  
  function show_iframe_upload(){
  
  $("#feedback_close_iframe").addClass("disabled");
  $("#iframe-upload").modal({backdrop:'static',keyboard:false});
  document.getElementById("iframe_upload_message").innerHTML = "";
    $("#iframe-upload").modal('show');
    $("#top-image").attr("src","");
    $('#loading_display').css('display','block');
   

 }
 
 window.token = <?php if(isset($_SESSION['userid'])){echo $_SESSION['userid'];} else {echo "0";} ?> ;
 
 if (parseInt(token) == 0) {
 
  window.location = "http://www.documendz.com";
	     
 }
 
//////////// change username ///////////////////

$(document).ready(function(){
 
   $("#feedback_close_iframe").click(function(){
  
  $(this).addClass("disabled");
  $("#my-iframe").contents().find('#end-message').hide();
  document.getElementById("iframe_upload_message").innerHTML = "";
  $('input[type = "file"]').val(null);
  
  })
 
 
 $(".self_view").colorbox({iframe:true, width:"80%", height:"90%"});
 

	$("#change-username-submit").click(function(){

                var new_username = $("#new-username").val();

        //var mydata = 'field='+text;
		
                if (new_username.length == 0) {

                    $("#change-username-display").text("Please fill all fields");
                    
                }
 
                else{

        var data_pass ={'new_username':new_username};
        	
        $.ajax({
        type:  'post',
        cache:  false ,
        url:  'change_username.php',
        data:  {result:JSON.stringify(data_pass),token : token, toki:"kejt568gkjln"},
        success: function(resp) {
            
	    if (parseInt(resp) == 999) {
	     
	     window.location = "http://www.documendz.com";
	     
	    }
	    else{
	    
	       $("#change-username-display").text("Username changed succesfully");
	       
					      
	      } 
           }
      });

		}

	});

	$("#change-username-close").click(function(){
		
		//$("#feedback-div").show();
		
                $("#new-username").val('');
		$("#change-username-display").text('');
	});

	$("#change-username-modal").click(function(f){
		f.stopPropagation();
		$("#change-username-container").show();
	});

	$(document).click(function(){
		
                $("#new-username").val('');
		$("#change-username-display").text('');

	});

	
	    $(document).on({           
      click:function(e){
       
       var x = $(this).closest('.individual_file_container');
       
       if (x.attr("data-hidden") == 0) {
       
       x.addClass("hide-content");
       x.attr("data-hidden","1");
       var sh_id = x.find('.received-shared-id').attr('data-shared-id');
       var state = 1;
       $(this).html("<a>unhide</a>");
       }
       
       else if (x.attr("data-hidden") == 1) {

       x.toggleClass("hide-content");
       x.attr("data-hidden","0");
       var sh_id = x.find('.received-shared-id').attr('data-shared-id');
       var state = 0;
       $(this).html("<a>hide</a>");
       }
      
       $.ajax({
          type:  'post',
          cache:  false ,
          url:  'file_hide.php',
          data:  {id:sh_id,hid_state:state}
	 
       });
      }
      
  },".hide-file");
     
     
     $(document).on({
      
      change:function(){

	$("#received .individual_file_container").toggleClass("hide-content");
	       
      }
      
      },"#viewit")
	
});

//////////////////////////////////////////////////
 
//////////////change pass //////////////////////

$(document).ready(function(){


	$("#change-password-submit").click(function(){

		
		var curr_pass=$("#current-password").val();
                var new_pass=$("#new-password").val();


        //var mydata = 'field='+text;
		
                if (curr_pass.length == 0 || new_pass.length == 0) {

                    $("#change-password-display").text("Please fill all fields");
                    
                }
                
                else if(curr_pass.length < 6){
			$("#change-password-display").text("The current password you have entered is incorrrect !");
		}

		else if(new_pass.length < 6){
			$("#change-password-display").text("Password should contain minimum 6 characters");
		}
                
                else{

        var data_pass ={'curr_pass':curr_pass,'new_pass':new_pass};
        	
                $.ajax({
        type:  'post',
        cache:  false ,
        url:  'change_password_loggedin.php',
        data:  {result:JSON.stringify(data_pass),token:token, toki:"kjh876hgf"},
        success: function(resp) {
           
	    if (parseInt(resp) == 999) {
	     
	     window.location = "http://www.documendz.com";
	     
	    }
	    else{
         $("#change-password-display").text(resp);
         
	    }					
        } 

      });
}

	});

	$("#change-password-close").click(function(){
		
		//$("#feedback-div").show();
		$("#current-password").val('');
                $("#new-password").val('');
		$("#change-password-display").text('');
	});

	$("#change-password-modal").click(function(f){
		f.stopPropagation();
		$("#change-password-container").show();
	});

	$(document).click(function(){
		$("#current-password").val('');
                $("#new-password").val('');
		$("#change-password-display").text('');
		

	});

});


///////////////////////////////////////////////
 
/////////////////feedback//////////////////////////////

$(document).ready(function(){


$('[data-toggle="tooltip"]').tooltip();

	$("#feedback_submit").click(function(){

		
		var text=$.trim($("#feedback").val());


        //var mydata = 'field='+text;
		if(text==""){
			$("#feedback_display").text("Please enter your Suggestion");
		}

		else{

		
					
		$("#feedback_display").text("Thank you for your feedback !");
		setTimeout(function(){
		$('#suggestion').modal('hide');
		},1500);
		
		$.ajax(
{
			type:'POST',
			url:'feedback.php',
			cache:false,
			data:{field:text,token:token,toki:"kjrgwlkh8lkwh"},
			datatype:"text",		
			success: function(resp){
			if (parseInt(resp) == 999) {
	     
	               window.location = "http://www.documendz.com";
	     
	                                              }
						
					}
						

				}

			)
		}


	});

	$("#feedback_close").click(function(){
		
		//$("#feedback-div").show();
		$("#feedback").val('');
		$("#feedback_display").text('');
	});

	$("#suggestion").click(function(f){
		f.stopPropagation();
		$("#feedback-div").show();
	});

	$(document).click(function(){
		$("#feedback").val('');
		$("#feedback_display").text('');
		

	});

});





///////////////////////////////////////////////
 
function start_intro(){ 
introJs().oncomplete(function(){
 
  $("#uploaded_container").css('display','block');
  
  $("#demo").css('display','none');
 
 }).
onexit(function(){
 
 $("#uploaded_container").css('display','block');
 $("#demo").css('display','none');
 
 }).
start();
};
 
 $.ajax({
        type:"POST",
        cache:false,
        url:"hb7s6/limit_status/",
	datatype: "text",
	data:{status_check : "show_status"},
	success: function(res){
	 
	 window.limit_array = res.split("#");
	 

	 document.getElementById('file-remain-progress').value = limit_array[2];
	 document.getElementById('file-remain-progress').max = limit_array[1];
	 $("#file-remain-text").text(limit_array[2]);
	 
	 
	}
 });

 
$(document).on({           
	click:function(e){

        // Keeps the share-summary open even on click 
	
	   $.ajax({
        type:"POST",
        cache:false,
        url:"hb7s6/token_check/",
	datatype: "text",
	async:false,
	data:{token : token},
	success: function(response){
	
	 if (parseInt(response) == 0) {
	  chk = Boolean(false);

	window.location = "http://www.documendz.com";
	 }
	else{
	 
	chk =  Boolean(check_remaining());
	
	}
	
	}
 });
	
return chk;


 }
},"#file-browse");
 
 
 
 
 $(document).on({           
	change:function(e){

  var FileExt = this.value.substr(this.value.lastIndexOf('.')+1).toLowerCase();
	
 if(this.files[0].size < 4096000 && (FileExt == "doc" || FileExt == "docx" || FileExt == "pdf" || FileExt == "png" || FileExt == "jpg" || FileExt == "svg" || FileExt == "swf" || FileExt == "bmp" || FileExt == "jpeg" )){
  show_iframe_upload();
   this.form.submit();
  
 }
else {
 
 show_iframe_upload();
 document.getElementById("iframe_upload_message").innerHTML = " Currently images, pdf and word files upto 4MB are supported. Support for other file types will be added soon.";
  $("#top-image").attr("src","images/cross.png");
  $("#feedback_close_iframe").removeClass("disabled");
  $('#loading_display').css('display','none');

 
}

 }
},"#file-browse");




function check_remaining(){
 
 if(limit_array[0] > 0){
  return true;
 }
 
 else{
  
  alert_message('You have reached your upload limit. Kindly contact us for more details.',"alert-danger");
  return false;
 }
 
}
   
   
   $(document).on({           // Keeps the share-summary open even on click 
	click:function(e){

	    e.stopPropagation();
		}
},'.keep-open > .dropdown-menu');
   
   
   
 
$(document).on({
	click:function(){

	
	if(confirm('Are you sure you want to delete the current file and its shared files?')){
	
	
	
	   $(this).closest(".individual_file_container").fadeOut();
		var name = $(this).closest(".individual_file_container").attr("data-file-identity");
        //var mydata = 'file_to_delete='+name; 

	       $.ajax({
	        type:"POST",
	        cache:false,
	        url:"delete_file.php",
	        datatype: "text",
	        data : {file_to_delete: name , token: token , toki:"3qf97459lefh"} ,   // multiple data sent using ajax
	        success: function (response) {
		 
		 if (parseInt(response) == 999) {
		  window.location = "http://www.documendz.com";
		 }
		 else{
		 
					var response_array = response.split("#");
					$("#myfiles_count").html(response_array[1]);
					alert_message("File deleted successfully","alert-success");
					 
		     }
	        },
 	        error: function(){
				alert("Oops, something went wrong.");
				}
	      });
		}
	
	else{
	 //user changed his mind
	}
		
	}		
},'.delete_file');

 
$(document).on({
	click:function(){

	    $(this).closest(".ssc-content").css('background-color','white').attr('data-review-state','0');
	    var id = $(this).closest(".ssc-content").find('.last-edit-time').attr('data-shared-id');
        var mydata = 'shared_id='+id;

	
	       $.ajax({
	        type:"POST",
	        cache:false,
	        url:"share_file_open.php",
	        datatype: "text",
	     
	        data : mydata,   // multiple data sent using ajax
	        success: function (response) {
		
					
	        },
 	        error: function(){
				alert("Oops, something went wrong.");
				}
	      });
		}
},'.share-file-open');


$(document).on({
	click:function(){

	    $(this).parent().siblings('.received-badge-wrapper').find('#received-badge').html("");
		var id = $(this).closest('.individual_file_container').find('.received-shared-id').attr('data-shared-id');
        var mydata = 'shared_id='+id;
	
	       $.ajax({
	        type:"POST",
	        cache:false,
	        url:"share_file_open.php",
	        datatype: "text",
	        data : mydata ,   // multiple data sent using ajax
	        success: function (response) {
					
	        },
 	        error: function(){
				alert("Oops, something went wrong.");
				}
	      });
		}
},'#received-file-open');

$(document).on({
	submit:function(e){

		//$(this).parent().parent().removeClass('open');  // used to force close dropdown		
		$("#send-file-button").prop('disabled','disabled');
		$("#send-file-button").val('Sending');
		
		e.preventDefault(); //stops default submit action... (doesnt show page submit at top)

		var this_el = $(this);
		var post_data = $(this).serializeArray();
		
		


	    $.ajax({
	        type:"POST",
	        cache:false,
	        url:"share_file.php?token="+ token,
	        datatype: "json",
	        data : post_data, 
			success: function(response){
			 
			 if (parseInt(response) == 999) {
			  
			  window.location = "http://www.documendz.com";
			  
			 }
			 else if (parseInt(response) == 998) {
			  
			  setTimeout(function(){
					 $("#send-file-button").prop('disabled','');
					 $("#send-file-button").val('Send');
					 alert_message("Email id you entered seems incorrect. Please try again","alert-danger");
					}, 2000);
			  
			 }
			else{
		     
			 
					if ($.trim(response).localeCompare("self_sending") == 0) {
					 setTimeout(function(){
					 $("#send-file-button").prop('disabled','');
					 $("#send-file-button").val('Send');
					 alert_message("Sorry, you cannot share a file with yourself","alert-danger");
					}, 2000);
					
					 	
					}
					else{
					 
					
					 
	  var obj = jQuery.parseJSON(response);
					
					 
     var share_add = "<li class='ssc-content' data-review-state='0' style='background-color:white'>"+
     
     "<table cellpadding='0' cellspacing='0' style='table-layout:fixed; width:400px'>"+
    "<tr>"+
     "<td style='width: 40%;overflow:hidden;text-align:left;'>"+obj['username']+"</td>"+
     "<td style='width: 15%;text-align: center;'><a class='share-file-open doc-viewer' href ="+obj['href_path']+">Edit</a></td>"+
     "<td style='width: 15%;text-align: center;'>"+obj['share_dt']+"</td>"+
     "<td class='last-edit-time' data-shared-id='"+obj['shared_id']+"' style='width: 30%;text-align: center;'>Not reviewed</td>"+
    "</tr>"+
  "</table>"+
 
     "</li>";
									
	       var elem = $('div[data-file-identity="'+obj['unique_filename']+'"]'); //share summary based on data-file-identity attribute in self-uploaded
			
		
				
	       elem.find('.share_summary_container').children('.ssc-header').after(share_add);					
									
					//this_el.parent().parent().siblings('.share_summary_container').children('.ssc-header').after(share_add);

					this_el.children('.input-sm').val('');
					
					setTimeout(function(){
					 $("#send-file-button").prop('disabled','');
					 $("#send-file-button").val('Send');
					 alert_message("File shared successfully","alert-success");
					}, 2000);
					
					
					}
					
				}
 $(".doc-viewer").colorbox({iframe:true, width:"100%", height:"100%"});
			},
			error: function(resp){
			
					setTimeout(function(){
					 $("#send-file-button").prop('disabled','');
					 $("#send-file-button").val('Send');
					 alert_message("Oops, something went wrong","alert-danger");
					}, 2000);
					}
		    });

		}
		
	},'.share-file-form');


/////////////////////////////////////////////
///////  delete all files  //////////////////
/////////////////////////////////////////////

$(document).on({
	click:function(){

		if(confirm('Files that you have uploaded and shared will be deleted permanently. Do you wish to continue?')){  // Confirmation for deleting all files
			

			$('#search_tab').css("display","none");
			$("#self_uploaded > .individual_file_container").css("display","block");
			$("#received > .individual_file_container").css("display","block");
			$("#search-input").val('');
			
$("#self_uploaded").contents().fadeOut();

	       $.ajax({
	        type:"POST",
	        cache:false,
	        url:"delete_all_files.php",
	        datatype: "text",
	        data :{token: token, toki:"pipi7463kjg"},
	        success: function (response) {
		 if (parseInt(response) == 999) {
		  
		   window.location = "http://localhost/";
		 
		 }
		 else{
			   
    				alert_message("All your files have been deleted","alert-info");
				$("#myfiles_count").html('0');
		 }
	        }
	      });
		}
		else{
              // User has changed his mind
			}
   
		}
},'#delete-all');

 
 var timeSince = function(date) {
   
       d = new Date();
   
   
   var seconds = Math.floor((d.getTime()/1000 - date) );
   var intervalType;

   var interval = Math.floor(seconds / 31536000);
   if (interval >= 1) {
       intervalType = 'year';
   } else {
       interval = Math.floor(seconds / 2592000);
       if (interval >= 1) {
           intervalType = 'month';
       } else {
           interval = Math.floor(seconds / 86400);
           if (interval >= 1) {
               intervalType = 'day';
           } else {
               interval = Math.floor(seconds / 3600);
               if (interval >= 1) {
                   intervalType = "hour";
               } else {
                   interval = Math.floor(seconds / 60);
                   if (interval >= 1) {
                       intervalType = "minute";
                   } else {
                       interval = seconds;
                       intervalType = "second";
                   }
               }
           }
       }
   }
if (interval < 0 ) {
 return 'just now';
}
  else{ if (interval > 1 || interval === 0) {
       intervalType += 's';
   }

   return interval + ' ' + intervalType+' ago';
}
 };

function search_results(search_input){    //search operations

	$("#self_uploaded_no_search").css("display", "none");
 	$("#received_no_search").css("display", "none"); 
	var self_search = 0;
	var received_search = 0;
	
    
    $("#self_uploaded > .individual_file_container").each(function() {

            if ($(this).find('.file_name')[0].innerHTML.toLowerCase().indexOf(search_input) > -1) {
                    $(this).css('display', 'block');
                    $("#search_tab").css("display", "block");
                   self_search = 1;
           }

            else {
                    $(this).css('display', 'none');
                    $("#search_tab").css('display', 'block');
                   
            }
    });
    
    $("#received > .individual_file_container").each(function() {

            if ($(this).find('.file_name')[0].innerHTML.toLowerCase().indexOf(search_input) > -1) {
                    $(this).css('display', 'block');
                    $("#search_tab").css('display', 'block');
               		 received_search = 1;
            }

            else {
                    $(this).css('display', 'none');
                    
            }
    });

    if(self_search != 1){$("#self_uploaded_no_search").css("display", "block");}
    if(received_search != 1){$("#received_no_search").css("display", "block");}
};


    $(document).ready(function() {
  

/*      $("#myTabContent").slimScroll({
		
    	position: 'left',
    	height:'350px',
    	size:'6px',
    	alwaysVisible: true
    	
    	
    });  */

    
    $("#myfiles_count").html($("#self_uploaded").children('.individual_file_container').length);

    
/////////////////////////////////////////////////////////////////
///////  update files share summary on page refresh  ////////////
/////////////////////////////////////////////////////////////////

    $.ajax({
        type:"POST",
        cache:false,
        url:"update_share_summary.php",
        datatype: "json",
		success: function(response){
	 	
			JSON.parse(response).forEach(function(obj){


			
			
		var link_path ="'"+obj['Uploaded_file_location']+"?jp="+obj['json_file_name']+ "&si="+obj['shared_id']+"&file="+obj['file_name']+"&auth="+obj['sender_id']+"&key=1'";
		
				
		if (parseInt(obj['last_edit']) == -1) {
		 
		 var timeago = "Not reviewed";
		 
		}
		else
		{
		var timeago = timeSince(parseInt(obj['last_edit']));
		
		
		
		}
		
		 
		
		if (parseInt(obj['review_state']) == 1 && (parseInt(obj['last_reviewer_id']) != parseInt(obj['sess'])) ) {
		
		 
		 var share_add = "<li class='ssc-content' data-review-state='1' style='background-color:lightgreen'>"+
		 
		 
		 
  "<table cellpadding='0' cellspacing='0' style='table-layout:fixed; width:400px'>"+
    "<tr>"+
    "<td style='width: 40%;overflow:hidden'; text-align:left;>"+obj['receiver_name']+"</td>"+
    "<td style='width: 15%;text-align: center;'><a class='share-file-open doc-viewer' href ="+link_path+">Edit</a></td>"+
    "<td style='width: 15%;text-align: center;'>"+obj['share_dt']+"</td>"+
    "<td class='last-edit-time' data-shared-id='"+obj['shared_id']+"' style='width: 30%;text-align: center;'>"+timeago+"</td>"+
    "</tr>"+
  "</table>"+
 		    
	            "</li>";

$("#self_uploaded").find("[data-file-identity = '"+obj['unique_filename']+ "']").find('.new-review-count').html("new updates");		    
		 
		}
		
		else if (parseInt(obj['review_state']) == 1 && (parseInt(obj['last_reviewer_id']) == parseInt(obj['sess']))) {
		 
		
		 
		  var share_add = "<li class='ssc-content' data-review-state='0' style='background-color:white'>"+
	           
		   "<table cellpadding='0' cellspacing='0' style='table-layout:fixed; width:400px'>"+
    "<tr>"+
    "<td style='width: 40%;overflow:hidden;text-align:left;'>"+obj['receiver_name']+"</td>"+
    "<td style='width: 15%;text-align: center;'><a class='share-file-open doc-viewer' href ="+link_path+">Edit</a></td>"+
    "<td style='width: 15%;text-align: center;'>"+obj['share_dt']+"</td>"+
    "<td class='last-edit-time' data-shared-id='"+obj['shared_id']+"' style='width: 30%;text-align: center;'>"+timeago+"</td>"+
    "</tr>"+
  "</table>"+
		   
		    //
		    //"<span style='width: 100px;text-align: center;'><a class='share-file-open' target='_blank' href ="+link_path+">"+obj['receiver_name']+"</a></span>"+
		    //"<span class='last-edit-time' style='font-size: 13px;width:100px;float:right; text-align: center;' data-shared-id='"+obj['shared_id']+"'>"+timeago+"</span>"+
		    //"<span style='width: 100px;text-align: center; float:right;'>"+obj['share_dt']+"</span>"+
		    //      
		   
		   
		   
		    "</li>";
		    
		}
		
		else if (parseInt(obj['review_state']) == 0) {
		 
		 var share_add = "<li class='ssc-content' data-review-state ='0' style='background-color:white'>"+
	            
		    "<table cellpadding='0' cellspacing='0' style='table-layout:fixed; width:400px'>"+
    "<tr>"+
    "<td style='width: 40%;overflow:hidden;text-align: left;'>"+obj['receiver_name']+"</td>"+
    "<td style='width: 15%;text-align: center;'><a class='share-file-open doc-viewer' href ="+link_path+">Edit</a></td>"+
    "<td style='width: 15%;text-align: center;'>"+obj['share_dt']+"</td>"+
    "<td class='last-edit-time' data-shared-id='"+obj['shared_id']+"' style='width: 30%;text-align: center;'>"+timeago+"</td>"+
    "</tr>"+
  "</table>"+
		    //
		    //"<span style='width: 100px;text-align: center;'><a class='share-file-open' target='_blank' href ="+link_path+">"+obj['receiver_name']+"</a></span>"+
		    //"<span class='last-edit-time' style='font-size: 13px;width:100px;float:right; text-align: center;' data-shared-id='"+obj['shared_id']+"'>"+timeago+"</span>"+
		    //"<span style='width: 100px;text-align: center; float:right;'>"+obj['share_dt']+"</span>"+
		    //       
		    
		    
		    "</li>";
		 
		}
		
	       
	       var elem = $('div[data-file-identity="'+obj['unique_filename']+'"]'); //share summary based on data-file-identity attribute in self-uploaded
				
	       elem.find('.share_summary_container').children('.ssc-header').after(share_add);
		
		
	$("#received").find("[data-shared-id = '"+obj['shared_id']+"']").html(timeago); //only time of update on refresh

				});
        $(".doc-viewer").colorbox({iframe:true, width:"100%", height:"100%"});
			},
		error: function(){
				alert("Oops! There seems to be something wrong, please try again");
				}
	    });


    $("#search-input").keyup(function(e) {
        
        if(e.keyCode == 13){        
            
        var search_input = $.trim($(this)[0].value).toLowerCase();
       
        if(search_input != ""){
        search_results(search_input);
        }
    }
    });

    $( ".display_share" ).click(function() {
    	
  	  $(this).siblings('.share_summary_container').slideToggle("fast");
  	/* $(this).siblings('.ssc-holder').slideToggle("fast"); */	  
    	  
    	});

    
});    

// delete search input
    
    $(document).on({
    	click:function(){

    			$('#search_tab').css("display","none");
    			$("#self_uploaded > .individual_file_container").css("display","block");
    			$("#received > .individual_file_container").css("display","block");
    			$("#search-input").val('');
    			$("#self_uploaded_no_search").css('display', 'none');
    			$("#received_no_search").css('display', 'none');

        	}

	},'#delete-search');


   
  

function alert_message(message,message_type_class) {
 
  $("#alert-container > p").html(message);
  
  $("#alert-container").addClass(message_type_class);
   
  $("#alert-container").slideDown("slow");
   
    setTimeout(function(){
      $("#alert-container").slideUp("slow");
      setTimeout(function(){
	       $("#alert-container").removeClass(message_type_class); 
       },1000);
      
    },4000);
     
      
     
};



	

</script>

</head>

<body>
   
   <?php include_once('analyticstracking.php'); ?>
   
    <div id='alert-container' class="alert" align="center" role="alert">
    <p></p>
    </div>
   
   <nav class="navbar navbar-default" role="navigation" style="padding :0px 90px;" >
   
   
   <ul class="nav navbar-nav navbar-right">
                                
				
				
				<li>
				<div id = "file-notification" style="height: 30px; width: 100px; margin-top: 10px;">
				 <progress id= "file-remain-progress" value='0' max="30" style="height: 10px; width: 90px; margin: 5px;"></progress>
				<div style="height: 20px; margin: 5px; font-size: 11px;">
				<div id= "file-remain-text" style="float: left; min-width: 13px; height: 20px; text-align: right;"></div>
				<div style="float: left">&nbsp;/&nbsp;</div>
				<div style="float: left">30 uploaded</div>
				</div>
				</div>
                                </li>
   
   
                                 <li>
				 <a class="btn btn-sm btn-default" style="padding:3px; margin:11px 5px 0px 0px;" data-toggle="tooltip" data-placement="bottom" title="Take a tour" href="javascript:void(0);" onclick="start_intro()"><i class="glyphicon glyphicon-info-sign" ></i>&nbsp;Tour</a>
				 
				</li>

   <li >
     <a  style="margin-right: 2px;
margin-top: 11px;
padding: 3px;" class="btn btn-default btn-sm"  href="#suggestion" data-toggle="modal">
   
   <i class="glyphicon glyphicon-comment" ></i>&nbsp;Feedback
     </a>
   </li>
   

    <li>
       			   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo htmlspecialchars($_SESSION['Username']); ?><span class="caret"></span></a>
        		   <ul class="dropdown-menu" role="menu">
       		  		  <li><a href="#change-password-modal" data-toggle="modal">Change password</a></li>
        	  		  <li><a href="#change-username-modal" data-toggle="modal">Change username</a></li>
				
          	  		  <li class="divider"></li>
         	  		  <li><a href='t_logout.php'>Logout</a></li>
         		   </ul>
       			 </li>
    
    
     </ul>
  
  <ul class="nav navbar-nav navbar-left"  style="padding:8px;">
 <li>
  <img src="images/logo1.gif" style="width: 145px; margin-right:10px;" />
 </li>
<li>
                                       <div role="search">
                                               <input id="search-input" type="text" class="form-control" placeholder="Search files">
                                      </div>
                               </li>
                               
  </ul>
   
                    
                        
   
   
   </nav>  
   
   
   <!-- modal body for suggestions--> 
   
   <div class="modal fade" id="suggestion" for="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				
					<div class="modal-header">
						<div style="font-size: 20px;"> Help us improve ! </div>
					</div>
		
						<div id="feedback-div">
							<div class="col-lg-12">
								 
								  <textarea id="feedback" style="width:467px; height:100px;margin-top:10px;" placeholder="Your feedback"></textarea>
								</div>
							</div>
							
						
						<div style="font-size: 15px; margin: 5px 0px 0px 15px;" id="feedback_display"></div>
					

					<div class="modal-footer">
					
						<a id="feedback_close" class="btn btn-default" data-dismiss="modal">close</a>
						<a id="feedback_submit" class="btn btn-success">submit</a>
					</div>
					
				
			</div>
		</div>
	</div>
   
   
   
   <div class="modal fade" id="change-password-modal" for="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				
					<div class="modal-header">
						<div style="font-size: 20px;"> Change password </div>
					</div>
					
						
							<div id="change-password-container">
								<div class="col-lg-12">
								 
					    <input id="current-password" class="login_blank" style=" margin: 10px 5px 0px 0px;" type="password" name="pwd" placeholder="Current password"/>
					    <input id="new-password" class="login_blank" style=" margin: 10px 0px 0px 5px;" type="password" name="pwd" placeholder="New password"/>
								  
								</div>
							</div>
							
						
						<div style="font-size: 15px; margin: 5px 0px 0px 15px;"  id="change-password-display"></div>
					

					<div class="modal-footer">
						<a id="change-password-close" class="btn btn-default" data-dismiss="modal">close</a>
						<a id="change-password-submit" class="btn btn-success">submit</a>
					</div>	
				
			</div>
		</div>
	</div>
   
   
   <div class="modal fade" id="change-username-modal" for="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				
					<div class="modal-header">
						<div style="font-size: 20px;">Change username</div>
					</div>
					
						
							<div id="change-username-container">
								<div class="col-lg-12">
								 
					    
					    <input id="new-username" style="margin-top: 10px; " class="login_blank" type="text" name="pwd" placeholder="New name"/>
								  
								</div>
							</div>
							
						
						<div style="font-size: 15px; margin: 5px 0px 0px 15px;" id="change-username-display"></div>
					

					<div class="modal-footer">
						<a id="change-username-close" class="btn btn-default" data-dismiss="modal">close</a>
						<a id="change-username-submit" class="btn btn-success">submit</a>
					</div>	
				
			</div>
		</div>
	</div>
  
    <div class="modal fade" id="iframe-upload" for="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				
					<div class="modal-header">
						<div style="font-size: 20px;"> File upload
						<img id="top-image" style="float:right;margin-right:4px;width:25px" src=""> </div>
						<p style="font-size: 12px;">Larger files with more images may take longer to process</p>
					</div>

		<p id="loading_display" style="padding-left: 15px;padding-top: 12px;color: grey;">Uploading file
		<img src="images/loader.gif" style="width: 29px;height: 16px;"></p>	
					
		<iframe style="border: none;width: 100%;height: 110px;" id="my-iframe" name="my-iframe" src="iframe_upload.php"></iframe>
					
					<div style="font-size: 15px;padding: 0 10px;color: rgb(143, 41, 53);" id="iframe_upload_message"></div>

					<div style="margin-top:0px; padding-top:0px;" class="modal-footer">
					 
					<button id="feedback_close_iframe" class="btn btn-danger" data-dismiss="modal">close</button>
	
					</div>
					
				
			</div>
		</div>
	</div>
  
   
    <div style="margin-bottom: 0px;width: 420px;float: right;position:absolute;top:96px;right:92px;" class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <b>We now support Microsoft Word files as well !!</b><br><br> You can now upload doc and docx
 file formats in addition to existing pdf and images, all upto 4 MB. We will keep on adding more file types.<br>Enjoy using Documendz, its <u>absolutely free</u> :)
</div>  
   
   
   
   
    <div id='uploaded_container' class='bs-docs-example'>
   
    <div id='message' class="alert alert-warning" role="alert" style="display: none;">
    <p>You cannot share a file with yourself</p>
    </div>
    
    
    
    

<br>
    <!--The name and File select down here would go in the modal window-->            
   
    <div class="input-group" style="margin-bottom:10px; width: 100px;">
               <span class="input-group-btn">
                <span class="btn btn-primary  btn-sm btn-file"> 
                <i class="glyphicon glyphicon-open"></i>&nbsp;&nbsp;Upload file
              
    <form  enctype = 'multipart/form-data' action="iframe_upload.php" target="my-iframe" method="post">
        <input id="file-browse" type="file" name="file[]" />
      
    </form>
 </span>
               </span> 
               
       </div>

              
 
    
    <!--This is the horizontal title bar to be shown on every profile page-->

   


    <?php
    
/////////////////////////////////////////////////////////    
//To display self uploaded files by the user on refresh//     
/////////////////////////////////////////////////////////
  
    echo "
		
		<ul id='myTab' class='nav nav-tabs'>
      <li  class='active switch_tab'><a href='#self_uploaded' data-toggle='tab'>My files&nbsp; <span id='myfiles_count' class='badge'>&nbsp;&nbsp</span></a></li>
      <li   class='switch_tab'><a href='#received' data-toggle='tab'>Files for reviewing</a></li>
       <li id='search_tab'>Search results <i id='delete-search' class='glyphicon glyphicon-remove'></i></li>
		    

		</ul>
		<div id='myTabContent' class='tab-content'>
		<div id = 'self_uploaded' class='tab-pane fade in active'><div style='text-align:right;padding-bottom:3px;'>
		 <button id='delete-all' style= 'background-image: linear-gradient(#f8f8f8,#d9d9d9);' class='btn btn-default btn-xs'>Delete All</button>
		 </div>";
		
    echo "<div id='self_uploaded_no_search'>No results found</div>";
    $s = mysql_real_escape_string($_SESSION[userid]);
    $uploaded_files_of_signed_in_user = mysql_query("SELECT * FROM uploaded_files WHERE user_id = '$s' ORDER BY file_id DESC");

    while ($row = mysql_fetch_array($uploaded_files_of_signed_in_user)) {
		
        echo "<div class='individual_file_container' data-file-identity =".$row['unique_filename'].">
	
	<table width='520px' table-layout='fixed' style='margin-bottom:2px;'>
	<tr>
	<td width='20px' ><i class='glyphicon glyphicon-file' style='color:#393c3f'></i></td>
       	<td width='350px' ><a class='file_name self_view' style='color:#393c3f;' name='file_name' href='uploaded/jhg76".$_SESSION['userid']."kd84/" . $row['unique_filename'] . ".html?file=".htmlentities($row['file_name'])."&key=0'>" . $row['file_name'] . "</a></td>"
	."<td width='130px' style='text-align:right;'><a><i class='glyphicon glyphicon-remove delete_file'></i><a></td>"
	."</tr></table>
	
	
	<table width='520px' table-layout='fixed' style='margin-bottom:2px;'>
	<tr>
	
        	<td width='200px' ><div class='dropdown' >
               		               		
      			<a class='dropdown-toggle btn btn-success btn-xs' href='#' data-toggle='dropdown'>Share&nbsp;<i class='glyphicon glyphicon-share-alt'></i></a>
        		<div class='dropdown-menu' style='padding: 15px;'>
        		<form class ='share-file-form' enctype = 'multipart/form-data' method='post'>
        		<input type='text' class='form-control input-sm' style='width:180px;margin-bottom:10px' name='Email' placeholder='Emailid' />
        		<input type='hidden' name='file_name' value='" . htmlentities($row['file_name']) . "' />
        	<input type='hidden' name='unique_filename' value='" . htmlentities($row['unique_filename']) . "' />	
       		<input  id='send-file-button' type='submit' class='btn btn-primary btn-sm' name='share_file' value='Send' /> 
        		</form>
        	</div>
        	</div></td>
		
		<td width='100px'><span class='badge new-review-count'></span></td>
       		      
		
		
		<td width='200px' style='text-align:right;'><div class='dropdown keep-open'>
		<a class='dropdown-toggle' data-toggle='dropdown' href='#'><i class='glyphicon glyphicon-list'></i>&nbsp;Shared files</a>	
		         							
        <ul class='share_summary_container dropdown-menu' style='left: 104%;width: 400px;top: -140%'>
			<li class='ssc-content ssc-header'>
            
	    
	    
			<table cellpadding='0' cellspacing='0' style='table-layout:fixed; width:400px'>
    <tr>
    <td style='width: 40%;text-align:center;overflow:hidden'><i class='glyphicon glyphicon-user'></i></td>
    <td style='width: 15%;text-align: center;'><i class='glyphicon glyphicon-eye-open'></i></td>
    <td style='width: 15%;text-align: center;'><i class='glyphicon glyphicon-calendar'></i></td>
    <td style='width: 30%;text-align: center;'><i class='glyphicon glyphicon-time'></i></td>
    </tr>
 </table>
	    
	    
            </li>
            
			</ul>
			</div></td>
			</tr>
			</table>
			
			</div>";
        
    }
    echo"</div>";
    echo "<div id = 'received' class='tab-pane fade in'> 
     <div style='text-align:right;padding-bottom:3px;'>
	<span style='color:#333;font-size:12px'>Show hidden files<span>" ;?>
        <input id="viewit" type="checkbox" >
     
      </div>
    <div id='received_no_search'>No results found</div>
<?php
//To display received files for editing from other users

$m = mysql_real_escape_string($_SESSION[userid]);
    $received_files_of_signed_in_user = mysql_query("SELECT * FROM shared_files WHERE receiver_id = '$m' ORDER BY (review_state+0) ASC");
   
    while ($row = mysql_fetch_array($received_files_of_signed_in_user)) {
	
      if($row['review_state'] == 1){
		if($row['last_reviewer_id'] != $_SESSION['userid']){
		 
		 $badge = "<text style='color: rgb(44, 134, 2);font-size: 11px;border: 1px solid green;border-radius: 6px;padding: 2px;'>new updates</text>";
		 
		}
		else{
		 
		 $badge = "";
		 
		}
       }
       else{
	
	$badge = "";
	
       }
	
	  if ($row['hidden_state'] == 1) {
	      
	      $disp_class = "hide-content";
	      $val = 1;
	      $g = "unhide";
	     }
	     
	     else if  ($row['hidden_state'] == 0){
	      
	      $disp_class = "";
	      $val = 0;
	      $g = "hide";
	     }		
		
        echo "<div class='individual_file_container ".$disp_class."' data-hidden='".$val."'>
	           
		   <table style='width:520px; table-layout:fixed; margin-bottom:2px;'>
		   <tr>
		   <td style='width:20px' ><i class='glyphicon glyphicon-file' style='color:#393c3f'></i></td>
		   <td style='width:350px; overflow:hidden'><a style='color:#393c3f' id='received-file-open' class='file_name doc-viewer' name='file_name' target='_blank' href='" . $row['Uploaded_file_location'] . "?jp=" . $row['json_file_name'] . "&si=" . $row['shared_id'] . "&file=".htmlentities($row['file_name'])."&auth=".$row['sender_id']."&key=1'>" . $row['file_name'] . "</a></td>
		   <td class='received-badge-wrapper' style='width:130px; text-align:right;'><span id='received-badge'>".$badge."</span></td>
		   <td style='width:20px'>
		    <div class='dropdown'>
			 <button style='padding:5px;font-size:4px;' class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>
			 <span class='caret'></span>
			 </button>
			 <ul class='dropdown-menu'>
			 <li style='cursor:pointer' class='hide-file' role='presentation'><a>".$g."</a></li>
			 </ul>
			</div>
		    </td>
		   </tr>
		   </table>
		   
		   <table style='width:520px; table-layout:fixed; margin-bottom:2px;'>
		   <tr>
		   <td style='width:50px; color:#66757f;font-size:13px;' >Author:</td>
		   <td style='width:350px; color:#66757f; font-size:13px;overflow:hidden'><div class='author-name'>".$row['sender_name']."</div></td>
		   
		   <td style='width:100px; text-align:right;color: #66757F;font-size: 13px;'><div class='received-shared-id' data-shared-id='".$row['shared_id']."' style='width:100px; height: 15px;float:right'></div></td>
		   </tr>
		   </table>
		   
                   </div>"
		   
		   ;}

        echo"</div></div>";


    //To display re - received files after editing from other users

   
   // share_file isset was here
    
    ?>
    
    

</div>
<div id="demo" style="display: none;">
<div id="demo_uploaded_container" class="bs-docs-example">
  

<br>
    <!--The name and File select down here would go in the modal window-->            
   
    <div class="input-group" style="margin-bottom:10px; width: 100px;">
               <span class="input-group-btn">
                <span data-step="1" data-intro="Upload your files" class="btn btn-primary btn-file"> 
                <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;Upload file
 </span>
               </span> 
               
       </div>

       
		
		<ul class="nav nav-tabs">
      <li data-step="2" data-intro="View all your files here" class="active switch_tab"><a href="#" data-toggle="tab">My files&nbsp; <span id="myfiles_count" class="badge">2</span></a></li>
      <li data-step="5" data-intro="View and annotate files that others have shared with you" class="switch_tab"><a href="#" data-toggle="tab">Files for reviewing</a></li>
       
		    
 
		</ul>
		<div class="tab-content">
		<div id="demo_self_uploaded" class="tab-pane fade in active">
		  
		 
		<!--1st Individual COntainer-->
		 
		 <div class="individual_file_container" >
		<table width="500px" table-layout="fixed" style="margin-bottom:2px;">
	<tbody><tr>
	<td width="20px"><i class="glyphicon glyphicon-file" style="color:#393c3f"></i></td>
       	<td width="350px"><a class="file_name  cboxElement" style="color:#393c3f;" name="file_name" href="#">Resume.pdf</a></td>
	<td width="130px" style="text-align:right;"><a href="#"><i class="glyphicon glyphicon-remove delete_file"></i></a></td></tr></tbody></table>
	
	
	<table width="500px" table-layout="fixed" style="margin-bottom:2px;">
	<tbody><tr>
	
        	<td width="200px"><div class="dropdown open">
               		               		
      			<a class="dropdown-toggle btn btn-success btn-xs" href="#" data-toggle="dropdown">Share&nbsp;<i class="glyphicon glyphicon-share-alt"></i></a>
        		<div  data-step="3" data-intro="Enter emailid of the person with whom you wish to share your file" class="dropdown-menu" style="padding: 15px;display: block;">
        		<form class="share-file-form" >
        		<input type="text" class="form-control input-sm" style="width:180px;margin-bottom:10px" name="email" placeholder="Emailid">
        		
        	
       		<input  type="submit" class="btn btn-primary btn-sm" name="share_file" value="Send" disabled="disabled"> 
        		</form>
        	</div>
        	</div></td>
		
		<td width="100px"><span class="badge new-review-count"></span></td>
       		      
		
		
		<td width="200px" style="text-align:right;"><div class="dropdown keep-open">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list"></i>&nbsp;Shared files</a>	
		         							
      
			</div></td>
			</tr>
			</tbody></table>
		 </div>
		 
		 
		 <!--2nd Individual COntainer-->
		 
		  <div class="individual_file_container" >
		<table width="500px" table-layout="fixed" style="margin-bottom:2px;">
	<tbody><tr>
	<td width="20px"><i class="glyphicon glyphicon-file" style="color:#393c3f"></i></td>
       	<td width="350px"><a class="file_name  cboxElement" style="color:#393c3f;" name="file_name" href="#">Architetcture.jpg</a></td>
	<td width="130px" style="text-align:right;"><a href="#"><i class="glyphicon glyphicon-remove delete_file"></i></a></td></tr></tbody></table>
	
	
	<table width="500px" table-layout="fixed" style="margin-bottom:2px;">
	<tbody><tr>
	
        	<td width="200px"><div class="dropdown open">
               		               		
      			<a class="dropdown-toggle btn btn-success btn-xs" href="#" data-toggle="dropdown">Share&nbsp;<i class="glyphicon glyphicon-share-alt"></i></a>
        		
        	</div></td>
		
		<td width="100px"><span class="badge new-review-count"></span></td>
       		      
		
		<td width="200px" style="text-align:right;"><div class="dropdown keep-open">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list"></i>&nbsp;Shared files</a>	
		         							
      
			</div></td>
			</tr>
			</tbody></table>
		 </div>
		 
		 
		  
		  
		  <!-- 3rd Individual COntainer-->
		  
		  <div class="individual_file_container" >
	
	<table width="500px" table-layout="fixed" style="margin-bottom:2px;">
	<tbody><tr>
	<td width="20px"><i class="glyphicon glyphicon-file" style="color:#393c3f"></i></td>
       	<td width="350px"><a class="file_name cboxElement" style="color:#393c3f;" name="file_name" href="#">Company Brochure.pdf</a></td><td width="130px" style="text-align:right;"><a><i class="glyphicon glyphicon-remove delete_file"></i></a><a></a></td></tr></tbody></table>
	
	
	<table width="500px" table-layout="fixed" style="margin-bottom:2px;">
	<tbody><tr>
	
        	<td width="200px"><div class="dropdown">
               		               		
      			<a class="dropdown-toggle btn btn-success btn-xs" href="#" data-toggle="dropdown">Share&nbsp;<i class="glyphicon glyphicon-share-alt"></i></a>
        		
        	</div></td>
		
		<td width="100px"><span class="badge new-review-count"></span></td>
       		      
		
		
		<td width="200px" style="text-align:right;"><div class="dropdown keep-open ">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-list"></i>&nbsp;Shared files</a>	
		         							
        <ul data-step="4" data-intro="View, edit and update your shared files right here." class="share_summary_container dropdown-menu" style=" display: block;left: 104%;width: 400px;top: -140%">
			<li class="ssc-content ssc-header">
            
	    
	    
			<table cellpadding="0" cellspacing="0" style="table-layout:fixed; width:400px">
    <tbody><tr>
    <td style="width: 40%;text-align:center;overflow:hidden"><i class="glyphicon glyphicon-user"></i></td>
    <td style="width: 15%;text-align: center;"><i class="glyphicon glyphicon-eye-open"></i></td>
    <td style="width: 15%;text-align: center;"><i class="glyphicon glyphicon-calendar"></i></td>
    <td style="width: 30%;text-align: center;"><i class="glyphicon glyphicon-time"></i></td>
    </tr>
 </tbody></table>
	    
	    
            </li>
			<li class="ssc-content" style="background-color:white">
			 <table cellpadding="0" cellspacing="0" style="table-layout:fixed; width:400px">
			   <tr>
			    <td style="width: 40%;overflow:hidden;text-align:left;">John</td>
			    <td style="width: 15%;text-align: center;">Edit</td>
			    <td style="width: 15%;text-align: center;">Sep 20</td>
			    <td class="last-edit-time" style="width: 30%;text-align: center;">Not reviewed</td>
			   </tr>
			  </table>
			</li>
			
			<li class="ssc-content" style="background-color:white">
			 <table cellpadding="0" cellspacing="0" style="table-layout:fixed; width:400px">
			  <tbody><tr><td style="width: 40%;overflow:hidden;text-align:left;">Michelle</td>
			  <td style="width: 15%;text-align: center;">Edit</td>
			  <td style="width: 15%;text-align: center;">Sep 21</td>
			  <td class="last-edit-time" style="width: 30%;text-align: center;">3 days ago</td>
			  </tr>
			  </table>
			</li>
			
			<li class="ssc-content"  style="background-color:lightgreen">
			 <table cellpadding="0" cellspacing="0" style="table-layout:fixed; width:400px">
			  <tr>
			   <td style="width: 40%;overflow:hidden; text-align:left">peterson@gmail.com</td>
			   <td style="width: 15%;text-align: center;">Edit</td>
			   <td style="width: 15%;text-align: center;">Sep 26</td>
			   <td class="last-edit-time"  style="width: 30%;text-align: center;">2 minutes ago</td>
			  </tr>
			  </table>
			</li>
            
			</ul>
			</div></td>
			</tr>
			</tbody></table>
			
			</div>
		
		
		
		
		
		
		
		</div><div id="demo_received" class="tab-pane fade in">
			</div>
		</div>    

</div>


</body>
</html>

