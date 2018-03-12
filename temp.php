<!DOCTYPE html>
<html>
<head>
	<title>temp</title>
	<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script>
  $(document).ready(function() {
    $("#sel_venue").change(function() {
      var ven_name = $(this).val();
      $.ajax({
        url: 'getTimings.php',
        type: "GET",
        data: {venue: ven_name},
        dataType: 'JSON',
        success:function(response) {
          alert(response.length);
          var len = response.length;
          $("#sel_date_time").empty();
          for( var i = 0; i<len; i++) {
            var dt = response[i].date_time;
            // alert(dt);
            var fin_str = "<option value='dt'>" + dt + "</option>";
            $("#sel_date_time").append(fin_str)
          }
        },
        error: function(response) {
          alert(response.status);
        }
      })
    })
  });
</script>
</head>
<body>
	<?php
	include 'login.php';
	$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);
	$tempname = "select name from tarea order by name";
	?>
	Select Venue - <select name = 'area' id = 'sel_venue'>
	<?php
	foreach ($conn->query($tempname) as $row) {
		$tempname11 = $row['name'];
		echo "<option value='$tempname11'>$tempname11</option>";
	}
	?>
	</select>

	Select Date and Time - <select name ="date" id="sel_date_time">
<!--     <div id="sel_opt"></div>
 -->    
  </select>

</body>
</html>