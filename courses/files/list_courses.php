<?php
//require_once('../classes/mysql.class.php');

$security = new MySQL();
//$security->checkLogin();

	$sub1 = "list_courses";

	$navSecurity = new MySQL();
	//$navSecurity->checkNavigation($sub1);

$prog = new MySQL();
$prog->Query("SELECT * FROM programs ORDER BY name");



?>


                        <form method="POST" action="" id="find_course_form">

                            <table style="width: 650px;" align="center" class="table table-striped table-bordered table-hover table-responsive">
                                <thead>

                                <tr>
                                    <th colspan="3" style="text-align: center;"><h5><strong>FILTER BY PROGRAM</strong></h5></th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr>
                                    <td>
                                        <select class="form-control" id="program" name="program" style="height: 35px; width: 500px;">
                                            <option selected disabled>--SELECT PROGRAM--</option>
											<?php while(!$prog->EndOfSeek()){ $prow = $prog->Row(); ?>
                                            <option value="<?php echo $prow->code;?>"><?php echo $prow->name;?></option>
                                            <?php } ?>
                                        </select>
                                    </td>

                                    <td><input  type="submit" name="find" id="find" class="btn btn-primary" value="Search"></td>
                                </tr>

                                <input type="hidden" name="do" value="studentList">
                                </tbody>
                            </table>

                        </form>


	<!-- scripts -->

<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script src="../js/jquery-latest.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap.datepicker.js"></script>
<script src="../js/theme.js"></script>
<script src="../js/checkTermUserSession.js"></script>



    <script type="text/javascript">



        $(document).on("click","#coursedetail",function(){
            var dropvalue = $(this).attr('name');

            $('#d_result').empty();
            $.ajax({
                type: "POST",
                url: "fetch_course_data.php",
                data: {cid : dropvalue
                },
                success:function(sdata) {

                    $('#record').html(sdata);



                }

            });
        });


        $(function () {

            var $btns = $("#find");
            $btns.click(function (e) {

                e.preventDefault();
                $('#result').empty();
                $("#wait").css("display","block");
                $("#find").attr("disabled", "disabled");

                $.ajax({
                    type: "POST",
                    url: "process_course_search.php",
                    data: $('#find_course_form').serialize(),
                    success: function(e) {


                        if(e=="zero"){

                            $("#wait").css("display","none");

                            $("#result").html("<br><div align='center'><span class='alert alert-danger' style='text-align: center'> No results found for this search.</span></div>");
                            $("#result").hide().fadeIn(2000);
                            $("#find").removeAttr('disabled')

                        }else{

                            $("#wait").css("display","none");
                            $('#result').html(e);
                            $("#find").removeAttr('disabled');

                        }



                    }
                });
                return false;

            });

        });


    </script>

</body>
</html>
