<hr>
<!-- Share button -->
				<p class="share">
					<!-- Print -->
					Share via:
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" target="_blank">
					    <i class="fa fa-facebook"></i>
					</a>

					<!-- Twitter -->
					<a href="https://twitter.com/home?status=<?php echo $link; ?>" target="_blank">
					    <i class="fa fa-twitter"></i>
					</a>

					<!-- Whatsapp -->
					<a href="https://api.whatsapp.com/send?text=<?php echo $row2['title']." ".$link; ?>" data-action="share/whatsapp/share">
						 <i class="fa fa-whatsapp"></i>
					</a>
			    </p>
				<!-- Share button ends-->
				<div style="margin-top: 0px;padding-top: 0px;">

					<h3 style="margin-top: 0px;padding-top: 0px;font-family: calibri;">Comment Below:</h3>
					<div id="mycomment">
					<?php
					$id = $_GET["id"];
					$query = mysqli_query($con, "SELECT * FROM comment WHERE postid='$id' ORDER BY id ASC");
					while ($row = mysqli_fetch_assoc($query)) {
					?>
						<p style="font-family: calibri;padding: 3px;"><span style="background: blueviolet;color: white;padding: 3px;font-weight: bold;font-family: calibri;"><?php echo $row['name']; ?>:</span> <?php echo $row['message']; ?></p>
						<hr>
					<?php } ?>
					</div>
					<form>
						<input type="text" id="name" placeholder="Enter you name" style="width: 100%;">
						<!-- Getting ID from post -->
						<?php
							$id = $_GET["id"];
							$query = mysqli_query($con, "SELECT * FROM post WHERE id='$id' ");
							$row2 = mysqli_fetch_assoc($query);
						?>
						<input type="hidden" id="postid" value="<?php echo $row2['id']; ?>">
						<!-- Getting ID from post -->
						<p>Message</p>
						<textarea placeholder="Enter your text" rows="5" cols="53" id="message" style="width: 100%;"></textarea><br>
						<input type="button" id="send" value="Submit" style="width: 100%;background: blueviolet;outline: none;padding: 5px;color: white;border:none;cursor: pointer;">
					</form>
					<script type="text/javascript">
						$(document).ready(function () {
							$("#send").click(function () {

								// alert(this.value);
								var name = $("#name").val();
								var postid = $("#postid").val();
								var message = $("#message").val();
								// console.log(name+postid);

								//Validation begin
								if (name == "") {
									$("#name").notify("Your name should not be empty",{ position:"top" }, "error");
								}else if (message == "") {
									$("#message").notify("Comment is required",{ position:"top" }, "error");
								}else{
									//Send to database after validation
									$.ajax({
										type: "post",
										url: "include/ajaxcomment.php",
										data: {
											"submit": 1,
											"name" : name,
											"postid": postid,
											"message": message
										},
										success: function (result) {
											var name = $("#name").val();
											var message = $("#message").val();
											$("#mycomment").append("<p style='font-family: calibri;padding: 3px;'><span style='background: blueviolet;color: white;padding: 3px;font-weight:bold;font-family: calibri;'>"+name+":  </span> "+message+"</p>").hide().fadeIn();
											console.log("result");
											// console.log("Am working");
											var name = $("#name").val("");
											var message = $("#message").val("");
											$("#send").notify(result, "success");
										}
									})


								}
							});

							// $.notify("Hello World");
						})
					</script>
					<br>
				</div>
			</div>
