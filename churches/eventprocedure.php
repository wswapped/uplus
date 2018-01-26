<?php

	include("db.php");
	
	if (isset($_POST['deleteId'])) {
		$deleteId = $_POST['deleteId'];
		$deleteEventSql = $db -> query("DELETE FROM event WHERE eventId = '$deleteId'");
		$deleteEventticketSql = $db -> query("DELETE FROM eventticket WHERE eventId = '$deleteId'");
	    $selectEvents = $db ->query("SELECT * FROM event");
	    while($rowevent = mysqli_fetch_array($selectEvents))
	    {
	        echo'
	            <div>
                    <div class="md-card">
		                <a href="javascript:void();=" onclick="selfevent(eventId='.$rowevent['eventId'].')">
		                       <img src="gallery/event/'.$rowevent['profile'].'" alt="'.$rowevent['eventName'].'" height="250px">
		                </a>
                        <div class="md-card-content">
                        	<button title="Remove event '.$rowevent['eventName'].'" class="md-btn md-btn-danger md-fab uk-position-small uk-position-bottom-right" onclick="deleteEvent(deleteId='.$rowevent['eventId'].')">&times</button>
                            <strong>'.$rowevent['eventName'].'</strong><br>
                            <span class="uk-text-muted">'.$rowevent['eventDate'].'</span>
                            <span class="uk-text-muted">'.$rowevent['eventTime'].'</span>
                        </div>
                    </div>
	            </div>
	        ';
	    }
	}
?>

<?php  

	if (isset($_POST['backticketId'])) {
		$backticketId = $_POST['backticketId'];
		?>
		<div id="ticket" class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Event Pass
                </h3>
            </div>
            <div class="md-card-content" id="ticketrange">
				<table class="uk-table dataTable no-footer">
					<tr>
						<th>Pass</th>
						<th>Price</th>
						<th>Booked</th>
					</tr>
					<?php

						$selectticket = $db ->query("SELECT * FROM eventTicket WHERE ticketId = '$backticketId'");
						$backticket = mysqli_fetch_array($selectticket);
						$backeventId = $backticket['eventId'];
						$selectPass = $db ->query("SELECT * FROM eventTicket WHERE eventId = '$backeventId'");
						while ($Pass = mysqli_fetch_array($selectPass)) {
							$ticketId = $Pass['ticketId'];
							?>
								<tr style="cursor: pointer;" onclick="showjoiner(ticket = <?php echo $ticketId; ?>)">
									<td><?php echo $Pass['ticketName']?></td>
									<td><?php echo $Pass['ticketPrice']?></td>
									<td><?php echo ''.$Pass['joinedPeople'] .'/'. $Pass['ticketPlace'].''?></td>
								</tr>
							<?php
						}

					?>
				</table>
            	<button class="md-btn md-btn-success md-fab uk-position-small uk-position-bottom-right" onclick="addPass(eventId = <?php echo $backeventId;?>)">&plus;
            	</button>
           </div>
        </div>
		<div style="display: none;" id="addpass" class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Add Event Pass
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
            	<button class="md-btn md-btn-success md-fab uk-position-small uk-position-bottom-right" onclick="addPassbutton(eventId = <?php echo $backeventId;?>)">&plus;
            	</button>
           </div>
        </div>
        <?php
	}

?>

<?php
	if (isset($_POST['eventId'])) {
		$eventId = $_POST['eventId'];
		$selectEventSql = $db -> query("SELECT * FROM event WHERE eventId = '$eventId' LIMIT 1")or die (mysqli_error());
		$rowevent = mysqli_fetch_array($selectEventSql);
	    $ename = $rowevent['eventName'];
?>
<style>
a{
	color: #00897b;
}
</style>
<div style="margin-left: 3px; margin-top: 5px;" class="uk-grid uk-grid-medium" data-uk-grid-margin>
	<div class="uk-width-large-4-6">
		<div class="md-card">
			<div style="background-size: cover;
				background-repeat: no-repeat;
				background-position: center center;
				background-image: url(gallery/event/<?php echo $rowevent['profile'];?>); height: 400px;">
				<div style="background: linear-gradient(to bottom,transparent 0,rgba(0,0,0,.82) 100%);
					text-shadow: 2px 2px 14px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
					margin: 0 auto;
					position: relative;
					width: 100%;
					height: inherit;">
				</div>
			</div>
			<div class="md-card-content uk-grid uk-grid-medium" data-uk-grid-margin">
				<div class="uk-width-large-1-2">
                    <strong>Event Name:</strong> <?php echo $rowevent['eventName']?><br>
					<strong>Event Date:</strong> <?php echo $rowevent['eventDate']?><br>
					<strong>Event Time:</strong> <?php echo $rowevent['eventTime']?><br>
					<strong>Event Location:</strong> <?php echo $rowevent['eventLocation']?><br>
                    <strong>Event Status:</strong> <?php echo $rowevent['eventStatus']?><br>
				</div>
				<div class="uk-width-large-1-2">
                    <button class="md-btn md-btn-success md-fab" onclick="editevent(editId=<?php echo $eventId;?>)">Edit</button>
                    <button class="md-btn md-btn-info md-fab" onclick="cover(editId=<?php echo $eventId;?>)">cover</button>
				</div>
			</div>
			<div class="md-card-footer" style="min-height: 250px;">
			
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5131133701275!2d30.10321761446213!3d-1.9477667372540528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca6e4f2e1ec51%3A0x74c833cc1f7b5dab!2sChristian+Life+Assembly!5e0!3m2!1sen!2srw!4v1494090536376" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
	<div id="leftcard" class="uk-width-large-2-6">
		<div id="ticket" class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Event Pass
                </h3>
            </div>
            <div class="md-card-content" id="ticketrange">
				<table class="uk-table dataTable no-footer">
					<tr>
						<th>Pass</th>
						<th>Price</th>
						<th>Booked</th>
					</tr>
					<?php

						$selectPass = $db ->query("SELECT * FROM eventTicket WHERE eventId = '$eventId'");
						while ($Pass = mysqli_fetch_array($selectPass)) {
							$ticketId = $Pass['ticketId'];
							?>
								<tr style="cursor: pointer;" onclick="showjoiner(ticket = <?php echo $ticketId; ?>)">
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
                    Add Event Pass
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