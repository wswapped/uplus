<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <?php
        if(empty($_GET['branch'])){
            die("Provide the branch ID");
        }

        include_once "functions.php";

        $branchid = $_GET['branch'];
        $branch_data = get_branch($branchid);
        $branch_name = $branch_data['name'];
        $title = "$branch_name branch";

        $representative = branch_leader($branchid, 'representative');

        $leaders = branch_leader($branchid);

        //This branch members
        $members = branch_members($branchid);
        

        //Including common head configuration
        include_once "head.php";

        $groups = branch_groups($branchid);
    ?>
</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <?php
        include_once "menu-header.php";

    ?>
    <!-- main header end -->
    <!-- main sidebar -->
     <?php
        include_once "sidebar.php";
    ?>
    <!-- main sidebar end -->

    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">
                    <div class="md-card">
                        <div class="user_heading user_heading_bg" style="background-image: url(<?php echo $branch_data["profile_picture"] ?>); background-size:cover; background-position: center center;">
                            <div class="bg_overlay">
                                <div class="user_heading_menu hidden-print">
                                    <div class="uk-display-inline-block" data-uk-dropdown="{pos:'left-top'}">
                                        <i class="md-icon material-icons md-icon-light">&#xE5D4;</i>
                                        <div class="uk-dropdown uk-dropdown-small">
                                            <ul class="uk-nav">
                                                <li><a href="#">Action 1</a></li>
                                                <li><a href="#">Action 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="uk-display-inline-block"><i class="md-icon md-icon-light material-icons" id="page_print">&#xE8ad;</i></div>
                                </div>
                                <div class="user_heading_avatar">
                                    <div class="thumbnail">
                                        <img src="<?php echo $representative[0]['profileImage']; ?>" alt="user avatar"/>
                                    </div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo "$branch_name"; ?></span><span class="sub-heading">at <?php echo $branch_data['location'];  ?></span></h2>
                                    <ul class="user_stats">
                                        <li>
                                            <h4 class="heading_a"><?php echo count($members); ?> <span class="sub-heading">Members</span></h4>
                                        </li>
                                        <li>
                                            <h4 class="heading_a"><?php echo count($groups); ?> <span class="sub-heading">Groups</span></h4>
                                        </li>
                                        <li>
                                            <h4 class="heading_a">1407 <span class="sub-heading">Broadcasts</span></h4>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="user_heading">
                            <!-- <div class="user_heading_menu hidden-print">
                                <div class="uk-display-inline-block" data-uk-dropdown="{pos:'left-top'}">
                                    <i class="md-icon material-icons md-icon-light">&#xE5D4;</i>
                                    <div class="uk-dropdown uk-dropdown-small">
                                        <ul class="uk-nav">
                                            <li><a href="#">Action 1</a></li>
                                            <li><a href="#">Action 2</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="uk-display-inline-block"><i class="md-icon md-icon-light material-icons" id="page_print">&#xE8ad;</i></div>
                            </div> -->
                            <!-- <div class="user_heading_avatar">
                                <div class="thumbnail">
                                    <img src="assets/img/avatars/avatar_11.png" alt="user avatar"/>
                                </div>
                            </div> -->
                            <!-- <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate">Makayla Glover</span><span class="sub-heading">Land acquisition specialist</span></h2>
                                <ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a">2391 <span class="sub-heading">Posts</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">120 <span class="sub-heading">Photos</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">284 <span class="sub-heading">Following</span></h4>
                                    </li>
                                </ul>
                            </div> -->
                            <!-- <a class="md-fab md-fab-small md-fab-accent hidden-print" href="page_user_edit.html">
                                <i class="material-icons">&#xE150;</i>
                            </a> -->
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">Members</a></li>
                                <li><a href="#">Groups</a></li>
                                <li><a href="#">Announcements</a></li>
                            </ul>

                                

                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    <div class="md-card-content">
                                        <div class="dt_colVis_buttons">
                                        </div>
                                        <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Branch</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Type</th>
                                                    <th>Date In</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $n=0;

                                                $sqlGetMembers = $db->query("SELECT * FROM `members` WHERE branchid = \"$branchid\" ORDER BY id DESC")or die (mysqli_error());
                                                while($rowMember = mysqli_fetch_array($sqlGetMembers))
                                                    {
                                                        $branchid = $rowMember['branchid'];
                                                        $sqlGetMembersloc = $db->query("SELECT * FROM `branches` WHERE id = '$branchid'")or die (mysqli_error());
                                                        $branches = mysqli_fetch_array($sqlGetMembersloc);
                                                        $n++;
                                                        echo '<tr>
                                                        <td>'.$n.'</td>
                                                        <td>'.$rowMember['name'].'</td>
                                                        <td>'.$branches['name'].'</td>
                                                        <td>'.$rowMember['phone'].'</td>
                                                        <td>'.$rowMember['email'].'</td>
                                                        <td>'.$rowMember['address'].'</td>
                                                        <td>'.$rowMember['type'].'</td>
                                                        <td>'.$rowMember['createdDate'].'</td>
                                                        <td><a href="editmember.php?memberid='.$rowMember['id'].'"><i class="material-icons">mode_edit</i></a></td>
                                                        </tr>';
                                                    }
                                                ?> 
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="md-card uk-margin-medium-bottom">
                                <div class="md-card-content">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-vertical-align">
                                                <div class="uk-vertical-align-middle">
                                                    <ul id="contact_list_filter" class="uk-subnav uk-subnav-pill uk-margin-remove">
                                                        <li class="uk-active" data-uk-filter=""><a href="#">All</a></li>
                                                        <?php
                                                            //Looping through group types
                                                            $group_types = group_types();
                                                            for($n=0; $n<count($group_types); $n++){
                                                                $gtype = $group_types[$n]['name'];
                                                                ?>
                                                                    <li data-uk-filter="<?php echo strtolower($gtype); ?>"><a href="#"><?php echo ucfirst($gtype); ?></a></li>
                                                                <?php
                                                            }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <label for="contact_list_search">Search... (min 3 char.)</label>
                                            <input class="md-input" type="text" id="contact_list_search"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3 class="heading_b uk-text-center grid_no_results" style="display:none">No results found</h3>

                            <div class="uk-grid-width-medium-1-2 uk-grid-width-large-1-3 hierarchical_show" id="contact_list">
                                <?php
                                    //looping through groups
                                    for($n=0; $n<count($groups); $n++){
                                        $group = $groups[$n]; //current group
                                        $groupname = $group['name'];
                                        // $branchname = $group['branchname'];
                                        $group_img = $group['profile_picture'];
                                        $group_type = $group['type'];

                                        $repdata = user_details($group['representative']);
                                        $repemail = $repdata['email'];
                                        $repphone = $repdata['phone'];

                                        $searchabledata = array(strtolower($groupname), strtolower($group_type));
                                ?>
                                    <div data-uk-filter="<?php echo implode(", ", $searchabledata); ?>">
                                        <div class="md-card md-card-hover md-card-horizontal">
                                            <div class="md-card-head">
                                                <div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-left'}">
                                                    <i class="md-icon material-icons">&#xE5D4;</i>
                                                    <div class="uk-dropdown uk-dropdown-small">
                                                        <ul class="uk-nav">
                                                            <li><a href="#">Edit</a></li>
                                                            <li><a class="grp_remove" data-grp = <?php echo $group['id'] ?> href="#">Remove</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="uk-text-center">
                                                    <img class="md-card-head-avatar" src="<?php echo $group_img;?>" alt=""/>
                                                </div>
                                                <!-- <h3 class="md-card-head-text uk-text-center">
                                                    <?php echo $groupname; ?>                                <span class="uk-text-truncate"><?php echo $branchname; ?> </span>
                                                </h3> -->
                                                <div class="md-card-head-footmenu">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-medium-1-3">
                                                            <a class="md-btn md-btn-edit md-btn-wave-light waves-effect waves-button waves-light" href="groups.php?group=<?php echo $group['id']; ?>">GOTO</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="md-card-content">
                                                <ul class="md-list">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Info</span>
                                                            <span class="uk-text-small uk-text-muted">Type: <?php echo ucfirst($group['type']); ?></span>
                                                            <span class="uk-text-small uk-text-muted">Location: <?php echo $group['location']; ?></span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Email</span>
                                                            <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo $repemail; ?></span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading">Phone</span>
                                                            <span class="uk-text-small uk-text-muted"><?php echo $repphone; ?></span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                              </div>
                                </li>
                                <li>
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Ut porro maxime id dolor aut quasi.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">24 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">24</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">681</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Ut quasi qui velit accusamus nobis quisquam.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">06 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">26</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">720</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Mollitia maiores dolorem id.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">14 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">1</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">531</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Ipsum nemo esse et nostrum nulla ea.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">18 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">22</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">430</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Provident ab cumque voluptas.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">19 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">20</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">721</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Molestiae voluptatibus inventore porro sit.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">17 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">17</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">806</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Beatae dolorem nostrum dolores sunt autem esse.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">23 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">22</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">488</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Distinctio quam sit minus.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">10 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">27</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">768</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Maiores voluptatum repellat omnis corporis dolore quaerat eum.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">17 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">7</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">803</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Nobis quia magnam quasi aperiam.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">26 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">2</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">739</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Totam est voluptas dolorem ipsam iste tempora veritatis.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">26 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">24</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">598</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Vitae laudantium ex sed.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">16 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">1</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">532</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Numquam quos corrupti aut quo.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">08 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">13</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">535</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Ad illum dolorem esse aperiam neque.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">21 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">1</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">323</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Totam rerum sunt eligendi dolor.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">03 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">19</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">952</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Non velit ipsum vero deleniti autem.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">23 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">6</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">583</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Saepe voluptatem laudantium tenetur.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">17 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">28</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">376</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Magnam rerum vero ut aut esse.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">29 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">8</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">334</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Modi totam et ratione cumque voluptatem iusto vitae.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">21 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">24</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">546</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a href="#">Corrupti voluptatem a veritatis repudiandae.</a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">15 Jan 2018</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">20</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">589</span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-3-10 hidden-print">
                    <div class="md-card">
                        <div class="md-card-content">
                            <!-- <div class="uk-margin-medium-bottom">
                                <h3 class="heading_c uk-margin-bottom">Alerts</h3>
                                <ul class="md-list md-list-addon">
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Nulla autem soluta.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Ut aut sapiente consequatur dolor omnis voluptatem atque.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Fuga dolorem tempore.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Rerum aliquam aut ea deserunt fugiat suscipit.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-danger">&#xE001;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Iure incidunt modi.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Fugit rerum consectetur reiciendis distinctio in laboriosam.</span>
                                        </div>
                                    </li>
                                </ul>
                            </div> -->
                            <h3 class="heading_c uk-margin-bottom">Staff</h3>
                            <ul class="md-list md-list-addon uk-margin-bottom">
                                <?php
                                    for($n=0; $n<count($leaders); $n++){
                                        $leader = $leaders[$n];
                                        ?>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <img class="md-user-image md-list-addon-avatar" src="<?php echo ucfirst($leader['profileImage']); ?>" alt=""/>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?php echo $leader['fname']." ".$leader['lname']; ?></span>
                                                    <span class="uk-text-small uk-text-muted"><?php echo ucfirst($leader['position']); ?></span>
                                                </div>
                                            </li>  
                                        <?php
                                    }
                                ?>
                            </ul>
                            <!-- <a class="md-btn md-btn-flat md-btn-flat-primary" href="#">Show all</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- google web fonts -->
    <script data-cfasync="false" src="cdn-cgi/scripts/d07b1474/cloudflare-static/email-decode.min.js"></script><script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!--  contact list functions -->
    <script src="assets/js/pages/page_contact_list.min.js"></script>

    <!-- datatables -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables buttons-->
    <script src="bower_components/datatables-buttons/js/dataTables.buttons.js"></script>
    <script src="assets/js/custom/datatables/buttons.uikit.js"></script>
    <script src="bower_components/jszip/dist/jszip.min.js"></script>
    <script src="bower_components/pdfmake/build/pdfmake.min.js"></script>
    <script src="bower_components/pdfmake/build/vfs_fonts.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.colVis.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.html5.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.print.js"></script>
    
      <!-- datatables custom integration -->
    <script src="assets/js/custom/datatables/datatables.uikit.min.js"></script>

    <!--  datatables functions -->
    <script src="assets/js/pages/plugins_datatables.min.js"></script>


    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "assets/js/custom/dense.min.js", function(data) {
                    // enable hires images
                    altair_helpers.retina_images();
                });
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>
</body>
</html>