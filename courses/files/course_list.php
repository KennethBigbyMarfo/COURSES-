<?php
/**
 * Created by PhpStorm.
 * User: software
 * Date: 9/24/2018
 * Time: 11:23 AM
 */
//require_once('../classes/mysql.class.php');
$object =  new MySQL();
$object->Query("Select * from staff_cat where status = 1");
?>
<div class="row">
    <div class="col-lg-12">


        <!-- Latest posts -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Course List</h6>
               
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="box-body">
                        <table class="table dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Course Code</th>
                                <th>Creadit</th>
                                <th>Semester</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Level</th>
                                <th>Description</th>
                            
                               
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter=0;
                            while (!$object->EndOfSeek())
                            {
                                $row = $object->Row();
                                $counter +=1;
                                ?>
                                <tr>
                                    <td><?php echo $counter?></td>
                                    <td><?php echo $row->name;?></td>
                                    <td><?php echo $row->description;?></td>
                                    <td><?php echo $row->medical_allocation;?></td>
                                    <td><?php echo $row->leave_allocation;?></td>
                                    <td><?php 

                                    if($row->status==1){
                                      echo $r=MYSQL::getStatusDesign('Active');
                                    
                                    }else{
                                        $object->getStatusDesign("Deactivated");
                                    } ?></td>

                                    <td>
                                        <ul class="nav"><li class="dropdown">    
                                        <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" role="button" aria-haspopups="true" aria-expanded="false">Select <i class="linea-icon linea-basic" data-icon='&#xe006;'></i><span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a  href="index.php?curpage=editstaffcat&id=<?php echo base64_encode($row->id);?>"  ><i class="fa fa-edit fa-fw" > </i>Edit</a></li>
              <li><a href='javascript:;' class="delete" type='staffcat' data-id="<?php echo base64_encode($row->id);?>" ><i class='fa fa-trash'></i> Remove</a></li>
              </ul>
                                            </li></ul>

                                       
                                    </td>

                                </tr>
                            <?php }?>
                            </tbody>


                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /latest posts -->

    </div>
    <!-- /dashboard content -->
</div>
