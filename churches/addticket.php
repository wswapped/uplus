<?php  

	if (isset($_POST['eventId'])) {
		include 'db.php';
		$eventId = $_POST['eventId'];
		$ticketName = $_POST['ticketName'];
		$ticketPrice = $_POST['ticketPrice'];
		$ticketPlace = $_POST['ticketPlace'];
		$insertNewticket = $db ->query("INSERT INTO eventticket(eventId,ticketName,ticketprice,ticketPlace,joinedPeople) 
			VALUES('$eventId', '$ticketName', '$ticketPrice', '$ticketPlace', '0')");
?>

	<div id="ticket" class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                <b>Event Pass</b>
            </h3>
        </div>
        <div class="md-card-content">
			<table class="uk-table dataTable no-footer">
				<tr>
					<th>Pass</th>
					<th>Price</th>
					<th>Booked</th>
				</tr>
				<?php

					$selectPass = $db ->query("SELECT * FROM eventTicket WHERE eventId = '$eventId'");
					while ($Pass = mysqli_fetch_array($selectPass)) {
						?>
							<tr style="cursor: pointer;">
								<td><?php echo $Pass['ticketName']?></td>
								<td><?php echo $Pass['ticketPrice']?></td>
								<td><?php echo ''.$Pass['joinedPeople'] .'/'. $Pass['ticketPlace'].''?></td>
							</tr>
						<?php
					}

				?>
			</table>
        	<button class="md-btn md-btn-success md-fab uk-position-small uk-position-bottom-right" onclick="addPass(eventId)">&plus;
        	</button>
       </div>
    </div>
	<div style="display: none;" id="addpass" class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                <b>Add Event Pass</b>
            </h3>
        </div>
        <div class="md-card-content">
            <div class="md-input-wrapper">
                Pass Name: <input type="text" id="ticketName" class="md-input">
                <span class="md-input-bar "></span>
            </div>
            <div class="md-input-wrapper">
                Pass Price: <input type="number" id="ticketPrice" class="md-input">
                <span class="md-input-bar "></span>
            </div>
            <div class="md-input-wrapper">
                Pass Place: <input type="number" id="ticketPlace" class="md-input">
                <span class="md-input-bar "></span>
            </div>
        	<button class="md-btn md-btn-success md-fab uk-position-small uk-position-bottom-right" onclick="addPassbutton(eventId)">&plus;
        	</button>
       </div>
    </div>
<?php
	}

?>

<script type="text/javascript"> 
    function addPassbutton(eventId) {
        var eventId = eventId;
        var ticketName = document.getElementById('ticketName').value;
        var ticketPrice = document.getElementById('ticketPrice').value;
        var ticketPlace = document.getElementById('ticketPlace').value;
        if (ticketName == "" || ticketName == null) {
            alert("Fill pass name");
            return false;
        }
        else if (ticketPlace == "" || ticketPlace == null) {
            alert("Fill pass number of place you have");
            return false;
        }
        else if (ticketPrice == "" || ticketPrice == null) {
            alert("Fill pass price. by default is zero");
            return false;
        }
        else {
            $.ajax({
                url: "addticket.php",
                type: "POST",
                async: false,
                data: {
                    "eventId" : eventId,
                    "ticketName" : ticketName,
                    "ticketPlace" : ticketPlace,
                    "ticketPrice" : ticketPrice
                },
                success: function (data) {
                    $("#leftcard").html(data);
                }
            })
        }
    }
    
    function addPass() {
        document.getElementById('addpass').style.display = 'block';
        document.getElementById('ticket').style.display = 'none';
    }

    function showjoiner(ticket) {
        var ticketId = ticket;
        $.ajax({
            url: "server.php",
            type: "post",
            async: false,
            data: {
                // eventId : eventId,
                ticketId : ticketId
            },
            success: function (data) {
                $("#ticket").html(data);
            }
        })
    }
</script>