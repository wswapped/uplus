
<?php  

	if (isset($_POST['ticketId'])) {
		include 'db.php';
		$ticketId = $_POST['ticketId'];
		$selectjoined = $db ->query("SELECT * FROM joinedpeople WHERE ticketId = '$ticketId'");
		$selectticket = $db ->query("SELECT * FROM eventticket WHERE ticketId = '$ticketId'");
		$ticket = mysqli_fetch_array($selectticket);
?>
	<div id="ticket" class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                <?php echo $ticket['ticketName']; ?>
                <i style="cursor: pointer; padding: 5px;" class="uk-position-small uk-position-top-right" onclick="backtoTicket(backticketId = <?php echo $ticketId; ?>);">&times;</i>
            </h3>
        </div>
        <div class="md-card-content" id="ticketrange">
			<table class="uk-table dataTable no-footer">
	            <?php
					while ($joined = mysqli_fetch_array($selectjoined)) {
						echo ''.$joined['Name'].'<br>';
					}	
				?> 
			</table>
       </div>
    </div>
<?php	
	}

?>

<script type="text/javascript">
	function backtoTicket(backticketId) {
		$.ajax({
			url : "eventprocedure.php",
			type : "post",
			async : false,
			data : {
				backticketId : backticketId
			},
			success: function(data) {
				$("#ticket").html(data);
			}
		})
	}
</script>