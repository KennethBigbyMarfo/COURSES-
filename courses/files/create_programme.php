<?php

//require_once('../classes/mysql.class.php');

$security = new MySQL();
//$security->checkLogin();

	$sub1 = "create_programme";

	$navSecurity = new MySQL();
	//$navSecurity->checkNavigation($sub1);

$progs = new MySQL();
$progs->Query("SELECT * FROM departments");
$security->Query("SELECT * FROM partner_institutions WHERE  status = 'Active' order by institution_name");


?>


                            <form method="post" name="form1" id="frmAdmin" action="" class="form-wrapper">

                              <table align="center" class="table table-striped table-bordered">
                                  <tr>
                                      <td colspan="4" style="text-align: center;"><h5><strong>Create Programme</strong></h5></td>
                                  </tr>
                                <tr>
                                   <td align="right">Department:</td>
                                  <td><select style="width: 300px;" name="department" id="department" class="form-control">
                                          <option disabled selected>--SELECT DEPARTMENT--</option>
                                          <?php while(!$progs->EndOfSeek()){ $prow = $progs->Row();?>
                                          <option  value="<?php echo $prow->id;?>"><?php echo $prow->name;?></option>
                                          <?php } ?>
                                  </select><div id="progerror"></div></td>
                                    <td nowrap align="right">Programme Code:</td>
                                  <td><input style="width: 280px;" type="text" name="code" id="code" value="" size="32"><div id="codeerror"></div></td>
                                </tr>

                                <tr valign="baseline">
                                  <td nowrap align="right">Programme Name:</td>
                                  <td><input style="width: 280px;" type="text" name="name" id="name" value="" size="32"><div id="nameerror"></div></td>
                                     <td nowrap align="right">Index Start:</td>
                                  <td><input style="width: 280px;"  type="text" name="index_starts" id="index_starts"/> <div id="indexerror"></div></td>
                                </tr>
                                <tr valign="baseline">
                                  <td nowrap align="right">Official Name:</td>
                                  <td><input style="width: 280px;"  type="text" name="official_name" id="official_name" /> <div id="offNameerror"></div></td>

                                  <td nowrap align="right">Partner Name:</td>
                                  <td><select name="partners_id" id="partners_id" class="form-control" style="width: 300px;">
                                          <option disabled selected>--SELECT PARTNER--</option>
                                          <?php while(!$security->EndOfSeek()){ $prow = $security->Row();?>
                                              <option  value="<?php echo $prow->id;?>"><?php echo $prow->institution_name;?></option>
                                          <?php } ?>
                                      </select><div id="partnererror"></div></td>
                                </tr>
                           		<tr valign="baseline">
                                      <td nowrap align="right">Status:</td>
                                  <td>
                                        <select class="form-control" name="status" id="status" style="width: 300px;">
                                            <option disabled selected>--SELECT STATUS--</option>
                                            <option value="Active">active</option>
                                            <option value="Inactive">inactive</option>
                                        </select><div id="staterror"></div>
                                    </td>
                                     <td nowrap align="right">Level:</td>
                                  <td>
                                        <select class="form-control" name="status" id="status" style="width: 300px;" required >
                                            <option  value="">--- Select ---</option>
                                            <option value="3">Diploma</option>
                                            <option value="4">Degree</option>
                                            <option value="5">Masters</option>
                                            <option value="6">Masters</option>
                                        </select><div id="staterror"></div>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    <td colspan="2">
                                        <input type="submit" id="save" value="Save" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="submit" id="close" value="Close" class="btn btn-primary" onclick="window.close()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                              </table>
                                <input type="hidden" name="do" value="insertProgramme">

                            </form>


<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script src="../js/jquery-latest.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap.datepicker.js"></script>
<script src="../js/theme.js"></script>

    <script type="text/javascript">

        //header update

        $(function () {


            var $buttons = $("#save");
            var $form = $("#frmAdmin");

            $buttons.click(function (e) {

                e.preventDefault();
                $("#result").empty();
                $("#progerror").empty();
                $("#codeerror").empty();
                $("#nameerror").empty();
                $("#indexerror").empty();
                $("#offNameerror").empty();
                $("#partnererror").empty();
                $("#staterror").empty();


                var progs = $.trim($("#department").val());
                var ccode = $.trim($("#code").val());
                var cname = $.trim($("#name").val());
                var indexstart = $.trim($("#index_starts").val());
                var officialname = $.trim($("#official_name").val());
                var partner = $.trim($("#partners_id").val());
                var desc = $.trim($("#desc").val());
                var stat = $.trim($("#status").val());


                if(progs.length == 0){

                    $("#progerror").html('<p><small style="color:red;">No department selected.</small><p/>');
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
                if(ccode.length == 0){

                    $("#codeerror").html('<p><small style="color:red;">Enter programme code.</small><p/>');
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
                if(cname.length == 0){

                    $("#nameerror").html('<p><small style="color:red;">Enter programme name.</small><p/>');
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
                if(indexstart.length == 0){

                    $("#indexerror").html('<p><small style="color:red;">Enter index start.</small><p/>');
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
                if(officialname.length == 0){

                    $("#offNameerror").html('<p><small style="color:red;">Enter official name.</small><p/>');
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
                if(partner.length == 0){

                    $("#partnererror").html('<p><small style="color:red;">No partner selected.</small><p/>');
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }
                if(stat.length == 0){

                    $("#staterror").html('<p><small style="color:red;">No status selected.</small><p/>');
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }


                if(progs.length != 0 && ccode.length != 0 && cname.length != 0 && indexstart.length != 0 && officialname.length != 0 && partner.length != 0  && stat.length != 0){

                    $("#save").attr("disabled", "disabled");
                    $("#close").attr("disabled", "disabled");
                    $("#wait").css("display","block");
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    $.ajax({
                        type: "POST",
                        url: "../classes/courses.php",
                        data: $form.serialize(),
                        success: function(e) {


                             if(e=="c_ok"){

                                $('#result').html("<br><div align='center'><span class='alert alert-success' style='text-align: center;'><i class='icon icon-ok-sign'></i> Programme created successfully</span></div><br>").hide().fadeIn(1000);
                                $("#code").val("");
                                 $("#name").val("");
                                 $("#desc").val("");
                                 $("#wait").css("display","none");
                                $("#save").removeAttr('disabled');
                                 $("#close").removeAttr('disabled');

                            }else(e=="c_fail"){

                                $('#result').html("<br><div align='center'><span class='alert alert-danger' style='text-align: center;'><i class='icon icon-remove-sign'></i> Programme creation failed</span></div><br>").hide().fadeIn(1000);
                                $("#wait").css("display","none");
                                $("#save").removeAttr('disabled');
                                 $("#close").removeAttr('disabled');

                            }

                        }
                    });
                    return false;
                }
            });
        });


    </script>

</body>
</html>
