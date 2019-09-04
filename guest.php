<?php
//guest.php
    
?>

<!DOCTYPE html>
<html>
	<head>
		<!--Basic stylesheet-->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!--For JQuery use-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!--Datepicker-->
      	<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      	<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      	<!--Timepicker-->
		<script type="text/javascript" src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
		<link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
		<script type="text/javascript" src="https://jonthornton.github.io/jquery-timepicker/lib/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/lib/bootstrap-datepicker.css">

      	<!--Semantic UI Calendar-->
      	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css">
      	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css">
      	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.js"></script>
      	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
      	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

        <!--Font Awesome-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<body>
		<nav class='navbar'>
			<ul class='left'>
                <li><a href='guest.php' class='name'> SCR Schedule </a></li>
			</ul>
			<ul class='right'>
                <li><a href="logout.php" <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                <li><a href="#" onClick="window.print()" <i class="fa fa-print" aria-hidden="true"></i></a></li> &nbsp&nbsp
			</ul>
		</nav>
		<br>
	<div class="ui container">
  		<div class="ui grid">
    		<div class="ui sixteen column">
      			<div id="calendar"></div>
    		</div>
  		</div>
	</div>
	<script>
		$(document).ready(function() {
        	var calendar = $('#calendar').fullCalendar({
	            header: {
	                left: 'prev,next today',
	                center: 'title',
	                right: 'month,agendaWeek,agendaDay,listWeek'
	            },
	            defaultDate: new Date(),
	            navLinks: true, // can click day/week names to navigate views
	            editable: false,
	            eventLimit: true, // allow "more" link when too many events]
	            events: 'load.php',
	            selectable:true,
	            selectHelper:true,
			    //Mouse hover not supported by fullcalendar or just poorly documented
			    /*eventMouseEnter:function(event){
			    	console.log("Hovered over event");
			    }*/
	        });
	    });
	</script>
	</body>
</html>
