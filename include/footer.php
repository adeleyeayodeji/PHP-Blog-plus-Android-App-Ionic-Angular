
	<div class="footer">
		<p>Copyright &copy; 2019 BiggiDroid Team - <a style="color: white;text-decoration: none;" href="https://www.adeleyeayodeji.com">Adeleye Ayodeji</a> | <a style="color: white;text-decoration: none;" href="admin/">Admin Panel</a></p>
	</div>
</div>
	<?php if (isset($_SESSION["admin"])) { ?>
<a href="admin/logout.php" class="float" target="_blank">
<i class="fa fa-sign-out my-float"></i>
</a><?php
}; ?>
<script type="text/javascript">
	$(document).ready(function() {
    const socket = io.connect("http://localhost:300");

    //Send function
    $("#send").click(function() {
        const message = $("#message").val();
        const username = $("#username").val();

        //Sending query to the server
        socket.emit("message", {
            "message": message,
            "username": username
        });

        $("#message").val("");
    });

    //Is typing function
    $("#message").keyup(function() {
        const username = $("#username").val();
        const message = $(this).val();

        socket.emit("typing", {
            "username": username,
            "message": message
        });
    });

    //Receive message from server
    socket.on("message", function(response) {
    	console.log(`Response from server ${response}`);
        // $("#typing").html("");
        // $("#chat").append(`
        // <p>
        //     <strong>${response.username}:</strong> ${response.message}
        // </p>
        // `);
    });

    //rescieve typing
    socket.on("typing", function(response) {
        console.log(response);
    });

    //log active users
    socket.on("active", (response) => {
    	console.log(response);
    });
});
</script>
</body>
</html>