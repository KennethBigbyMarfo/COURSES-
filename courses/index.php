<?php
session_start();
$path="../";


if(!isset($_SESSION['APP_USER'])){
	header("location: ../auth/login.php");
    
}

include_once($path."config/settings.php");	

include_once($path."classes/templateEngine.class.php");
include_once($path."classes/mysql.class.php");
include_once($path."classes/staff.class.php");
include_once($path."classes/userLogin.class.php");
include_once($path."classes/util.class.php");
require_once($path."classes/department.class.php");
$page=new TemplateEngine($path."template/page.dwt");

$arr=array(
		'page_title'=>'GTUC ERP',
		'page_header'=>'courses',
		'sidebarArea'=>"",
		'stylesheets'=>$path.'inc/stylesheet.php',
		'javascripts'=>$path.'inc/javascript_form.php',
		'top_menu'=>$path.'inc/menubar.php',
		'sidebar_menu'=>$path.'inc/sidebar.php',
		'breadcrumbs'=>"",
		'rightsidebar'=>$path.'inc/rightsidebar.php',
		'server_info2'=>"",
		'recent_activities'=>"",
		'internal_chat'=>"",
		'user_list'=>"",
		'to_do_list'=>"",
		'calendar'=>"",
		'visitors_map'=>"",
		'right_animatedbox'=>"",
		'livechatbox'=>"",
		'footer'=>$path."inc/footer.php",
		'embeded-javascript'=>$path."inc/javascript_embedded.php",
		'content'=>"",
	);

if(isset($_GET['curpage'])){
		$auth=new UserLogin();
	//$curpage=$auth->checkFilePermission($curpage);
	$curpage=$_GET['curpage'];
	
switch ($curpage){
	case "changepwd":
	$arr['content']="files/changePassword.php";
	$arr['page_header']="Change Password";
	if($_SESSION['EVAL_USER']->Level!="L0"){
		$page=new TemplateEngine($path."template/full-page.dwt");
	}
	break;
	
	case "coursedetails":
            $arr['content']="files/coursedetail.php";
            $arr['page_header']="<h3 class='pg-header'>Course Details</h3>";
	
	break;
	case "createcourse":
            $arr['content']="files/create_courses.php";
            $arr['page_header']="<h3 class='pg-header'>Create Staff</h3>";
	
	break;
	case "createmodule":
            $arr['content']="files/create_module.php";
            $arr['page_header']="<h3 class='pg-header'>Create Module</h3>";
	
	break;
	case "createprogramme":
            $arr['content']="files/create_progrmme.php";
            $arr['page_header']="<h3 class='pg-header'>Create Programme </h3>";
	
	break;
	case "deleteitem":
            $arr['content']="files/deleteitem.php";
            $arr['page_header']="<h3 class='pg-header'>Delete Items</h3>";
	
	break;
	case "editcourses":
            $arr['content']="files/edit_courses.php";
            $arr['page_header']="<h3 class='pg-header'>Edit Courses</h3>";
	
	break;
	case "editmodule":
	$arr['content']="files/edit_module.php";
	$arr['page_header']="Edit Module";

	break;
	case "editprogramme":
	$arr['content']="files/edit_programme.php";
	$arr['page_header']="Edit Programme";

	break;
	case "fetchcoursedata":
	$arr['content']="files/fetch_course_data.php";
	$arr['page_header']="LIst Course Data";

	break;
	case "fetchmoduledata":
	$arr['content']="files/fetch_module_data.php";
	$arr['page_header']="Fetch Module Data";

	break;
	case "fetchprogrammedata":
	$arr['content']="files/fetch_programme_data.php";
	$arr['page_header']="Fetch Programme Data";
	
	
	break;
	case "listassignments":
	$arr['content']="files/list_assignments.php";
	$arr['page_header']="List Assignments";

	break;
	case "listcourses":
	$arr['content']="files/list_courses.php";
	$arr['page_header']="<h3 clas>List Courses</h3>";

	break;
	case "listmodules":
	$arr['content']="files/list_modules.php";
	$arr['page_header']="<h3>List Modules</h3>";

	break;
	case "listprogrammme":
	$arr['content']="files/list_programmes.php";
	$arr['page_header']="<h3 class='pg-header'>List Programmes</h3>";

	break;
	case "processcourses":
	$arr['content']="files/process_course_search.php";
	$arr['page_header']="<h3>Process Course Search</h3>";
	
	break;
	case "processmodulesearch":
	$arr['content']="files/process_module_search.php";
	$arr['page_header']="<h3>Process Module Search</h3>";
	
	break;
	case "processprogrammesearch":
	$arr['content']="files/process_programme_search.php";
	$arr['page_header']="<h3>Process Programme Search</h3>";
	
	break;
	case "processGBHL":
	$arr['content']="files/processGBHL.php";
	$arr['page_header']="<h3>List Modules</h3>";

	
	break;
	case "courselist":
	$arr['content']="files/course_list.php";
	$arr['page_header']="<h3>Course List</h3>";
	

	}
}

$page->replace_tags($arr);
print  $page->output();

/*<!--@session_start();
require("classes/userLogin.class.php");
$user = new userLogin();

if(!$user->checkLogin()){
header("location: ../index.php");
exit();
}
	require_once("classes/church.class.php");
-->*/
 


?>

<script>
$(document).ready(function(e) {
	SwitchController("bank-switch");
	SwitchController("dependant-switch");
	 $(".datepicker").datepicker({dateFormat:'yy-mm-dd',changeMonth:true,changeYear:true});	


//Get email handlers
	$(document).on("click",'.sendemail',function(e){
		ch=$(this).attr('data-id');
		
		$.ajax({url:"files/sendmail_personal.php",type:"POST",data:"userID="+ch,success: function(text){
			
			bootbox.confirm(text,function(e){
				if(e){
					$("#frm_Sendmail").submit();
				}
				});			
		}})
		
		
	});
	
	$(document).on("submit","#frm_Sendmail",function(e){
        e.preventDefault();
		$.ajax({url:"user_handler.php",type:"POST",data:$("#frm_Sendmail").serialize(),success: function(text){
				if(text==1){
					popNotify("Failed to send Message!","bg-success");
					$("#frm_Sendmail")[0].reset();
				}else if(text==0){
					popNotify("Sorry Email Could not be sent at the moment, Please try again soon!","bg-danger");
					
				}else if(text==2){
					popNotify("Message Empty","bg-danger");
					
				}else{
					
					popNotify(text,"bg-danger");
				};	
			}})	
	});
	


    $(document).on("click",".change_single_pwd",function(e){
        var userid=$(this).attr('data-id');
        $("#user_id").val(userid);
        bootbox.confirm($(".single_mail").html(),function(em){
            if(em){
              sdata= $(".bootbox  #single_mail").serialize();
                 $.ajax({url:"user_handler.php",type:"POST",data:sdata,success: function(text){
                    if(text==1){
                        popNotify("Password Changed Successfully","bg-success");
                    }else{
                        popNotify(text,"bg-danger");
                    }
                 }})
            }else{

            }

        })


    })
  $(document).on("submit","#frm_changePassword",function(e){
		e.preventDefault();
		var c=$("#frm_changePassword").parsley().validate();
     // alert(c)
		if(c){
			$.ajax({url:"user_handler.php",type:"POST",data:$("#frm_changePassword").serialize(),success: function(text){
				if(text==1){
					popNotify("Password Reset was successful!","bg-success");
					$("#frm_changePassword")[0].reset();
					window.setTimeout(function(){
						window.location="http://localhost/evaluation/evaluation/?curpage=viewqtn&qid=MTQ=";
						//window.location="http://unicefevaluation.org/evaluation/?curpage=viewqtn&qid=MTQ=";
						},2000);
				}else if(text==0){
					popNotify("Reset Failed!","bg-danger");
					
				}else if(text==-1){
					popNotify("You provided a wrong password!","bg-danger");
					
				}else{
					
					popNotify(text,"bg-danger")
				};	
			}})	
			
			
		}	
	})
	

	//
	
	
       
	//Sending email
	   $(".multiSelect").select2();
	$(document).on("submit","#frmSendmail",function(e){
		e.preventDefault();
		var c=$("#frmSendmail").parsley().validate();
		if(c){
			$.ajax({url:"user_handler.php",type:"POST",data:$("#frmSendmail").serialize(),success: function(text){
				if(text==1){
					popNotify("Email was sent!","bg-success");
					$("#frmSendmail")[0].reset();
				}else if(text==0){
					popNotify("Error sending message!","bg-danger");
					
				}else if(text==2){
					popNotify("Some users did not receive the email!","bg-danger");
					
				}else{
					
					popNotify(text,"bg-danger")
				};	
			}})	
			
			
		}	
	})
	
	$(document).on("click","#backpage",function(e){
		e.preventDefault();
		window.history.back();
	})
	//PhD Management Control, Organizational Learning and Big Data in Auditing Firms

	if($(".dataTable").length===0)
  		$(".dataTable").DataTable({"lengthMenu": [[30, 60, 100, -1], [30, 60, 100, "All"]]});
  }); 
  (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });
        
            })();
                  

				
  </script>