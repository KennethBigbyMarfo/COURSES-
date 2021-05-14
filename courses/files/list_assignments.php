
<?php

if(!isset($_SESSION)){session_start();}
//require_once('../classes/mysql.class.php');
$security = new MySQL();
//$security->checkLogin();

$prog = new MySQL;
$prog->Query("SELECT * FROM programs");

$acy = new MySQL;
$acy->Query("SELECT * FROM gb_years");

?>
<?php 
 error_reporting(-1);
$courseLogs = new MySQL;
$sql = "SELECT gb_header.id, gb_header.session, gb_header.status, CONCAT(courses.`code`,' - ',courses.`name`) AS course, gb_header.credit AS credit, CONCAT(staff_employee_pdetail.fname,staff_employee_pdetail.lname) AS lecturer, programs.`code` AS program, gb_header.level
FROM gb_header INNER JOIN courses ON gb_header.courseid = courses.id
INNER JOIN staff_employee_pdetail ON gb_header.lecturerid = staff_employee_pdetail.empID
INNER JOIN programs ON gb_header.program_code = programs.code";

$courseLogs->Query($sql);
$courseLogs->MoveFirst();



$lec = new MySQL;
$lec->Query("SELECT * FROM staff_employee_pdetail");
$lec->MoveFirst();

$select = ""; 
while(!$lec->EndOfSeek()){ 
$lrow = $lec->Row();
if(is_object($lrow)){$empID = 0;$name = "";$empID = $lrow->empID;$name = "$lrow->fname $lrow->lname";$select .=  "<option value=\"$empID\">$name</option>";}
} 
?>

			<form method="POST" action="" id="gbhlform">
			
			<table class="table table-striped table-bordered table-hover table-responsive">
				<thead>
				
				
				<tr>
					<th>Program</th>
					<th>Academic Year</th>
				  </tr>
				</thead>
				<tbody>
						
				
					  <tr>
					  <td>
					 
						<select name="program" id="program" class="input-xlarge">
						<option>--SELECT PROGRAM--</option>
						 <?php while (!$prog->EndOfSeek()){ $row = $prog->Row();?>
						<option value="<?php echo $row->code; ?>"><?php echo $row->name; ?></option>
						<?php } ?>
						</select>
					  </td>
					  
					  <td>
					 
						<select name="ac_year" id="ac_year" class="input-xlarge">
						<option>--SELECT ACADEMIC YEAR--</option>
						 <?php while (!$acy->EndOfSeek()){ $acrow = $acy->Row();?>
						<option value="<?php echo $acrow->id; ?>"><?php echo $acrow->id; ?></option>
						<?php } ?>
						</select>
					  </td>
					  
				
					 
					  <td><input type="submit" name="add" id="add" class="btn btn-success" value="Go"></td>
					  </tr>
					  

				 </tbody>
				</table>
                <input type="hidden" name="gb_years_id" value="<?php //echo base64_decode($_GET['id']); ?>">
				</form>
				
	
	<script type="text/javascript" src="DataTables/media/js/jquery.js"></script>

	
	
    <script src="../js/jquery-latest.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-ui-1.10.2.custom.min.js"></script>
    <script type="text/javascript" src="media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="media/js/jquery.dataTables.min.js"></script>
    <!-- knob -->
    <script src="../js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="../js/jquery.flot.js"></script>
    <script src="../js/jquery.flot.stack.js"></script>
    <script src="../js/jquery.flot.resize.js"></script>
    <script src="../js/theme.js"></script>

    <script type="text/javascript" charset="utf-8">
	$(function () {

            var $btns = $("#add");
            $btns.click(function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "processGBHL.php",
                    data: $('#gbhlform').serialize(),
                    success: function(e) {
							
							
							$('#list').html(e);
                            
                    }
                });
                return false;

            });

        });
	
    $(document).ready(function() {
    $('#example').dataTable({"sPaginationType": "full_numbers"});
    });
    </script>
	
</body>
</html>