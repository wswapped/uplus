<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Fata Isuka team">
        <link rel="shortcut icon" href="assets/images/logo.png">
        <link rel="stylesheet" type="text/css" href="css/facss/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Fata Isuka</title>
    </head>
    <?php
        include 'admin/db.php';
        include_once "functions.php";

    ?>
<body>
    <div class="page">
        <div class="container">
            <div class="mt-3"></div>
            <div class="row">
                <div class="col-md-12">
                    
                </div>
                <div class="col-md-8">
                    <div class="card mod-title text-success" style="padding: 20px">Fata Isuka</div>
                    <div class="mt-3"></div>
                    <div class="card">
                        <div class="card-block card-body">
                            <div class="card-title text-center mod-title">Location crops</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Location</th>
                                      <th scope="col">Crops</th>
                                      <th scope="col">Quantity (kg)</th>
                                      <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>                            
                                <?php
                                    $fields = array();
                                    $query = $conn->query("SELECT * FROM locations") or die("error getting fields $conn->error");
                                    $n = 0;
                                    while ($data = $query->fetch_assoc()) {
                                        $fields[$data['id']] = $data;
                                        $ownerName = $data['ownerName']??"Muhinzi";

                                        //getting message
                                        $next_message = next_message($data['id']);
                                        $nmessage = $next_message['text'];

                                        $message = str_ireplace("\$name", $ownerName, str_ireplace("\$litters", rand(10, 20), 
                                            str_ireplace("\$fert_kg", rand(6, 9), $nmessage)));
                                        ?>
                                        <tr class="locElem" data-location="<?php echo $data['name']; ?>">
                                          <th scope="row"><?php echo $n+1; ?></th>
                                          <td><?php echo $data['name']; ?></td>
                                          <td><?php echo $data['crops']; ?></td>
                                          <td><?php echo $data['quantity']; ?></td>
                                          <td class="text-info">Not notified</td>
                                        </tr>
                                        <?php
                                        $n++;
                                    } 
                                ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td data-role='phone'></td>
                                        <td></td>
                                        <td><button class="btn btn-info" id="sendbroadcasts" data-message="<?php echo $message; ?>">Confirm <i class="fa fa-check"></i></button></td>
                                    </tr>             
                                </tbody>
                            </table>
                        </div>
                    </div>               
                </div>
            </div>
        </div>
        <div class="mt-3"></div>
        <div class="container-fluid menu-stick-footer container-full">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col col-4">
                        <div class="menu-item m_active">
                            <a href="index.php"><span><i class="fa fa-2x fa-dashboard"> </i></span> Home</a>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="menu-item">
                            <a href="fertilizer.php"><span><i class="fa fa-2x fa-shopping-basket"> </i></span> Resources</a>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="menu-item">
                            <a href="ussd"><span><i class="fa fa-2x fa-mobile"> </i></span> USSD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="modal fade" id="locModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-block card-body">
                        <div class="card-title text-center mod-title">Fields and Alerts subscriptions</div>
                        <table class="table">
                            <thead>
                                <tr>
                                	<th scope="col">#</th>
                                	<th scope="col">Owner Name</th>
                                	<th scope="col">Phone</th>
                                	<th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody id="message_table">                            
                            <?php
                                $fields = array();
                                $query = $conn->query("SELECT * FROM farmer") or die("error getting fields $conn->error");
                                $n = 1;
                                while ($data = $query->fetch_assoc()) {
                                    $fields[$data['id']] = $data;
                                    $ownerName = $data['name']??"Muhinzi";

                                    //getting message
                                    $next_message = next_message($data['id']);
                                    $nmessage = $next_message['text'];

                                    $message = str_ireplace("\$name", $ownerName, str_ireplace("\$litters", rand(10, 20), 
                                        str_ireplace("\$fert_kg", rand(6, 9), $nmessage)));
                                    ?>
                                    <tr data-message="<?php echo $message; ?>" data-phone="<?php echo $data['phone']; ?>">
                                    	<th scope="row"><?php echo $n; ?></th>
                                    	<td><?php echo $ownerName; ?></td>
                                    	<td data-role='phone'><?php echo $data['phone']; ?></td>
                                    	<td><?php echo substr($message, 0, 15) ?>..</td>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            ?>
                            <tr>
                                <th scope="row">+</th>
                                <td id="nameInput"><input type="text" name="owner" placeholder="Ownername" class="form-control" /></td>
                                <td id="phoneInput"><input type="number" name="phone" placeholder="Phone number" class="form-control" /></td>
                                <td><button class="btn btn-default" id="addUser">Add <i class="fa fa-plus"></i></button></td>
                            </tr>               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add <span data-fill='name'></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $("#sendbroadcasts").on('click', function(){
            //getting messages to send
            messages_elem = $("#message_table").find("tr:not(:last-child)");
            // log(messages_elem);

            //Looping through messages
            for(n=0; n<messages_elem.length; n++){
                message_elem = messages_elem[n]
                message = $(message_elem).data('message');
                phone = $(message_elem).data('phone');

                $.post('api/index.php', {action:'send_sms', phone:phone, message:message}, function(data){
                    console.log(data);
                })
            }
        });
        $("#addUser").on('click', function(){
            phone = $(this).parents("tr").find("td#phoneInput input").val();
            name = $(this).parents("tr").find("td#nameInput input").val();

            n = $("#message_table").find('tr').length-1
            $("#message_table").append("<tr><td>"+n+"</td><td>"+name+"</td><td>"+phone+"</td><td>Broadcast</td></tr>")


            $.post("api/index.php", {action:'add_user', 'name':name, 'phone':phone, 'location':chose_loc}, function(data){
                ret = JSON.parse();
                log(ret);
            });

            $('#addModal').modal('show')
        })


        $(".locElem").on('click', function(){
            chose_loc = $(this).data('location');
            $('#locModal').modal('show')
        })

        function fillin(parent, child, data){
            elems = $(parent).find("span[data-fill="+child+"]");
            log(elems)
        }

        function log(data){
            console.log(data)
        }
    </script>
</body>

</html>
