<?php include("template/header.php");?>
<?php
$sql_account = $db->query("SELECT * FROM accounts ORDER by saving DESC");
$count_groups = mysqli_num_rows($sql_account);
$sql_account_sum = $db->query("SELECT sum(saving) sumsave FROM `accounts` WHERE `groupType` = 'wedding'");
$rowsumsav = mysqli_fetch_array($sql_account_sum);
$sumsave = $rowsumsav['sumsave'];
$mycutsumsave = $sumsave * 2/100;
$sql_users = $db->query("SELECT * FROM users ORDER by visits DESC");
$count_users = mysqli_num_rows($sql_users);
?>
 <!-- Page -->
  <div class="page animsition">
   
  <div class="page-content container-fluid">
    <div class="row">
      <div class="col-lg-12 col-sm-12">
        <div class="row row-lg">
          <div class="col-lg-12  col-sm-12">
            <!-- Example Tabs Line -->
              <div class="example-wrap margin-lg-0">
                <div class="nav-tabs-horizontal">
                  <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                    <li class="active" role="presentation"><a data-toggle="tab" href="#exampleTabsLineOne" aria-controls="exampleTabsLineOne"
                      role="tab">(<?php echo $count_groups;?>) Groups</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#exampleTabsLineThree" aria-controls="exampleTabsLineThree"
                      role="tab">(<?php echo $count_users;?>) Users</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#exampleTabsLineFour" aria-controls="exampleTabsLineFour"
                      role="tab">Charts</a></li>
                  </ul>
                  <!--ortfolio select-->
                  <div class="row">
                  </div>
                  <!--End of the portfolio-->
                  <div class="tab-content padding-top-20">
                    <div class="tab-pane active" id="exampleTabsLineOne" role="tabpanel">
                  <div class="col-lg-12 col-sm-12">
                      <div class="page-header">
                        <ol class="breadcrumb port">
                          <li class="active"  style="cursor:pointer">ALL</li>
                          <li style="cursor:pointer">SOCIALS</li>
                          <li style="cursor:pointer">SAVINGS</li>
                          <li style="cursor:pointer">RECURRING</li>
                        </ol>
                        <div class="page-header-actions">
                          <ol class="breadcrumb">
                          <li  style="color:#3949ab;" id="current">Current Amount: 0Rwf/ Fee 0Rwf</li>
                          <li style="color:#3949ab;" id="target">Target Amount: <?php echo number_format($sumsave);?> Rwf / Fee: <?php echo number_format($mycutsumsave);?> Rwf</li>
                        </ol>
                        </div>
                      </div>
                    </div>
                      <table class="table table-hover dataTable table-striped width-full portfolioo" id="exampleTableTools">
                        <thead>
                          <tr>
                            <th>Group Name</th>
                            <th>Head Group</th>
                            <th>Phone number</th>
                            <th>Current Amount</th>
                            <th>Target Amount</th>
                            <th>Current fees</th>
                            <th>Target fees</th>
                            <th>************</th>
                          </tr>
                        </thead>
                        <tfoot>
                           <tr>
                            <th>Group Name</th>
                            <th>Head Group</th>
                            <th>Phone number</th>
                            <th>Current Amount</th>
                            <th>Target Amount</th>
                            <th>Current fees</th>
                            <th>Target fees</th>
                            <th>
                        </tfoot>
                        <tbody>
                            <?php  $i = 0;$ii = 0; $iii = 0; $iv = 0;
								while($fetch_account = mysqli_fetch_array($sql_account))
                            {
                             
                                $groupname = $fetch_account['accName'];
                                $headgoup = $fetch_account['adminName'];
                                $earncontr = $fetch_account['adminPhone'];
                                $promisecontr = $fetch_account['contribution'];
                                $headgroupphone = $fetch_account['adminPhone'];
                                $groupType = $fetch_account['groupType'];
                                $Targetacc = $fetch_account['saving'];
                                $groupid = $fetch_account['id'];
                                $select_gbalance = $outCon->query("SELECT Balance FROM groupbalance WHERE groupId = '$groupid'");
                                $fetchgroupbala = mysqli_fetch_array($select_gbalance);
                                $balancegroup = $fetchgroupbala['Balance'];
                                $currentfees = $balancegroup * 2 / 100;
                                $targetfees = $Targetacc * 2 / 100;

                                $i = $i + $targetfees; // target fees
                                $ii = $ii + $currentfees; // current fees
                                $iii = $iii + $balancegroup; //current amount
                                $iv = $iv + $Targetacc; // target amount

                            ?>
                                <tr  class="<?php echo $groupType; ?> ALL">
                                  <td><?php echo $groupname?></td>
                                  <td><?php echo $headgoup?></td>
                                  <td><?php echo $headgroupphone?></td>
                                  <td><?php echo number_format($balancegroup);?></td>
                                  <td><?php echo number_format($Targetacc); ?></td>
                                  <td><?php echo number_format($currentfees); ?></td>
                                  <td><?php echo number_format($targetfees); ?></td>
                                  <td>
                                    <a href="more group.php?blabla=<?php echo $groupid; ?>"><button class="btn btn-primary btn-sm">More</button></a>
                                  </td>
                                </tr>
                          <?php
                              }
                          ?>
                        </tbody>
                      </table> 
                      <?php echo $iv;?>
                    </div>
                    <div class="tab-pane" id="exampleTabsLineThree" role="tabpanel">
                      <table  class="table table-hover dataTable table-striped width-full" id="exampleTableTools">
                      <thead>
                        <tr>
                          <th>Phone</th>
                          <th>Join Date</th>
                          <th>Name</th>
                          <th>Visits</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Phone</th>
                          <th>Join Date</th>
                          <th>Name</th>
                          <th>Visits</th>
                        </tr>
                      </tfoot>
                      <tbody>
                      <?php
                      while ($fetchuser = mysqli_fetch_array($sql_users)) 
                      {
                        $user_phone = $fetchuser['phone'];
                        $user_join = $fetchuser['joinedDate'];
                        $user_name = $fetchuser['name'];
                        $user_visit = $fetchuser['visits'];
                      ?>
                          <tr>
                            <td><?php echo $user_phone; ?></td>
                            <td><?php echo $user_join; ?></td>
                            <td><?php echo $user_name?></td>
                            <td><?php echo $user_visit?></td>
                          </tr>
                      <?php
                    }
                      ?>
                      </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="exampleTabsLineFour" role="tabpanel">
                            <!-- Panel -->
      <div class="panel">
        <div class="panel-body">
          <div id="container" style="min-width: 80%; height: 400px; margin: 0 auto;"></div>
        </div>
        </div>
      </div>
      <!-- End Panel -->
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php include ("template/footer.php");?>
<script type="text/javascript">
  $(document).ready(function()
  {
    var current_amount = <?php echo $iii; ?>;
    var current_fees = <?php echo $ii; ?>;
    
    $("#current").html('Current: fee:'+current_amount+' out of '+target_amount);

  });
</script>>

</body>

</html>              