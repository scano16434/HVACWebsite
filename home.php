<?php
//index.php

include('dbcon.php');
include('session.php');
    
$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);

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


      	<!-- Javascript -->
      	<script>
        	$(function() {
            	$("#datepicker-1").datepicker();
         		$('#timepicker-1').timepicker();
				$('#timepicker-2').timepicker();
         	});
      	</script>
	</head>
	<body>
		<nav class='navbar'>
			<ul class='left'>
                <li><a href="logout.php" <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                <li><a href="#" onClick="window.print()" <i class="fa fa-print" aria-hidden="true"></i></a></li> &nbsp&nbsp
                <li><a href='home.php' class='name'> SCR Schedule </a></li>
			</ul>
			<ul class='right'>
				<li><a href="#"><span style="cursor:pointer" onclick="openNav()">&#9776; New Meeting</span></a></li>
			</ul>
		</nav>
		<br>
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <form method="POST" class="guestform">
			<!--Entering date information-->
			<div id="sidenavheading">
				<p>New Meeting</p>
				<br>
			</div>
			<p><p class="label">Enter Title:</p> <input type="text" id="meetingtitle"></p>
			<p><p class="label">Enter Date:</p> <input type="text" id = "datepicker-1"></p>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#displayButton").click(function(){
						var datetime = $("#datepicker-1").datepicker({ dateFormat: 'dd,MM,yyyy' }).val();
						datetime += " " + ($("#timepicker-1").val() + " to " + $("#timepicker-2").val());
						alert(datetime);
					});
				});
			</script>

			<!--Entering time information-->
			<div class="meetingtimes">
				<p><p class="label">Start Time:</p> <input id='timepicker-1' type='text'name='timepicker-1'/></p>
				<p><p class="label">End Time:</p> <input id='timepicker-2' type='text'name='timepicker-2'/></p>
			</div>

            <br/>
			<div class="attendees">
			<script type="text/javascript">
				$(function(){
				    var counter = 2;
				    $("#addButton").click(function () { //on addButton click
						if(counter>15){
				        	alert("Only up to 15 attendees allowed.");
				        	return false;
						}
						//create new divs with different textbox ids
						var newTextBoxDiv = $(document.createElement('div'))
					    	.attr("id", 'TextBoxDiv' + counter);        
					   	//Add labels to each textbox
						newTextBoxDiv.after().html('<label>Attendee #'+ counter + ' : </label>' +
					    	'<input type="text" name="textbox' + counter + 
					    	'" id="textbox' + counter + '" value="" + class="textboxes">');
				        //add to the group div
						newTextBoxDiv.appendTo("#TextBoxesGroup");
						counter++;
				    });

				    $("#removeButton").click(function () {
						if(counter==1){
				        	alert("Can't remove more textboxes");
				          	return false;
				        }   
						counter--;
				        $("#TextBoxDiv" + counter).remove();	
				    });
				    $("#submitButton").click(function (e) {
						var msg = '';
						var raw_date = "";
						var date_ = "";
						var title_ = "";
						var start_time = "";
						var end_time = "";
						if(($('#datepicker-1').datepicker({ dateFormat: 'dd,MM,yyyy' }).val() == '') || ($('#meetingtitle').val() == '') || ($('#timepicker-1').val() == '') || ($('#timepicker-2').val() == '')){
							alert("Please provide more information");
							return false;
						}
						else{
							//parse date and times
							raw_date = $('#datepicker-1').datepicker({ dateFormat: 'dd,MM,yyyy' }).val();
							var year = raw_date.substr(6,9);
							var month = raw_date[0] + raw_date[1];
							var day = raw_date[3] + raw_date[4];
							var s_hour;
							var s_min;
							var s_time_of_day = '';
							var e_hour;
							var e_min;
							var e_time_of_day = '';
							if (($('#timepicker-1').val()).length == 7){
								s_hour = $('#timepicker-1').val().substr(0,2);
								s_min = ($('#timepicker-1').val()).substr(2,3);
								s_time_of_day = $('#timepicker-1').val().substr(5,6);
							}
							else{
								s_hour = "0" + ($('#timepicker-1').val())[0];
								s_min = ($('#timepicker-1').val()).substr(1,3);
								s_time_of_day = $('#timepicker-1').val().substr(4,5);
							}
							if (($('#timepicker-2').val()).length == 7){
								e_hour = $('#timepicker-2').val().substr(0,2);
								e_min = ($('#timepicker-2').val()).substr(2,3);
								e_time_of_day = $('#timepicker-2').val().substr(5,6);
							}
							else{
								e_hour = "0" + ($('#timepicker-2').val())[0];
								e_min = ($('#timepicker-2').val()).substr(1,3);
								e_time_of_day = $('#timepicker-2').val().substr(4,5);
							}
							if (s_time_of_day == "pm" && s_hour != "12"){
								s_hour = String(Number(s_hour)+12);
							}
							else if (s_time_of_day == "am" && s_hour == "12"){
								s_hour = "00";
							}
							if (e_time_of_day == "pm" && e_hour != "12"){
								e_hour = String(Number(e_hour)+12);
							}
							else if (e_time_of_day == "am" && e_hour == "12"){
								e_hour = "00";
							}
							date_ = year + '-' + month + '-' + day;
							title = $('#meetingtitle').val();

							start_time = date_ + 'T' + s_hour + s_min + ":00";
							end_time = date_ + 'T' + e_hour + e_min + ":00";
							var start_date = new Date(start_time);
							var end_date = new Date(end_time);
							//alert(start_date + " " + end_date);
			      			start_time = moment(start_time).format('YYYY-MM-DDTHH:mm:ss'); 
        					end_time = moment(end_time).format('YYYY-MM-DDTHH:mm:ss'); 
        					//insert the meeting in "events" table, generating an id in the process
				      		$.ajax({
				       			url:"insert.php",
				       			type:"POST",
                                async:false,
				       			data:{title:title, start:start_time, end:end_time},
                                   success:function()	{
				       			},
				       			error:function(jqXHR,textStatus,errorThrown){alert('Exception:'+errorThrown);}
				      		});
				      		$.get("get_id.php", function(data){ 
				      			var id = (JSON.parse(data))[0]["id"];
				      			//alert(id);
				      			var userlist = [];
				      			//add each attendee to the userlist
								for(i=1; i<counter; i++){
				   	  				userlist.push($('#textbox' + i).val());
								}

				      			var j;
				      			//append each user to the "users" table in the database using the same id as the meeting
				      			for (j = 0; j < userlist.length; j++){
				      				var current_user = userlist[j];
				      				$.ajax({
				       					url:"add_users.php",
				       					type:"POST",
				       					data:{id:id, username:current_user},
				       					success:function()	{
				        					$('#calendar').fullCalendar('refetchEvents');
				       					},
				       					error:function(jqXHR,textStatus,errorThrown){alert('Exception:'+errorThrown);}
				      				});
				      			}

                                var data0 = {"id":id, "title":title, "start_time":start_time, "end_time":end_time, "userlist":userlist};
                                var data = JSON.stringify(data0);
                                  
                                $.ajax({
                                    type:"POST",
                                    // url removed from github for security
                                    url:'http://',
                                    data:data,
                                    dataType: "text",
                                    contentType: "application/json; charset=UTF-8",
                                    success:function(){
                                       console.log("submitted")
                                    },
                                    error:function(jqXHR,textStatus,errorThrown){alert('Exception:'+errorThrown);}
                                });
				      		});
                            document.getElementById("mySidenav").style.width = "0";
			     		}
				    });
				});
			</script>

				<div id='TextBoxesGroup'>
					<div id="TextBoxDiv1">
						<label for="textbox1">Attendee #1 : </label><input type='textbox' id='textbox1' class="textboxes" >
					</div>
				</div>
			</div>
            <br/>
			<input type='button' value='Add Attendee' id='addButton'>
			<input type='button' value='Remove Attendee' id='removeButton'>
			<br/> <br/>
			<input type='button' value='Submit' id='submitButton'>
			<br/> <br/> <br/>
			<body> <small>
				<font color="white">Use attendees' email addresses above, in order to <br/>
				keep their SCR profile preferences consistent, and <br/> 
				to avoid creating new profiles automatically for <br/>
		    	the same users. <br/> <br/> </font>
		    </small> </body>
		</form>
	</div>

	<script>
		function openNav() {
	  		document.getElementById("mySidenav").style.width = "275px";
	  		//$('#calendar').animate({'left', '-5px'});
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			//$('#calendar').animate({'left', '-5px'});
		}
	</script>

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
			    eventClick:function(event){
			     	if(confirm("Are you sure you want to remove it?")){
			      		var id = event.id;
			      		$.ajax({
			       			url:"delete.php",
			       			type:"POST",
			       			data:{id:id},
			       			success:function(){
			        			calendar.fullCalendar('refetchEvents');
			        			alert("Event Removed");
			       			}
			      		})
			      		$.ajax({
			      			url:"remove_users.php",
			      			type:"POST",
			      			data:{id:id},
			      			success:function(){
			      				calendar.fullCalendar('refetchEvents');
			      			}
			      		})
                        var data0 = {"id":id};
                        var data = JSON.stringify(data0);
                        $.ajax({
                            type:"POST",
                            // url removed from github for security
                            url:'http://',
                            data:data,
                            dataType: "text",
                            contentType: "application/json; charset=UTF-8",
                            success:function(){
                                console.log("deleted")
                            },
                            error:function(jqXHR,textStatus,errorThrown){alert('Exception:'+errorThrown);}
                        });
			     	}
			    },
			    //Mouse hover not supported by fullcalendar or just poorly documented
			    /*eventMouseEnter:function(event){
			    	console.log("Hovered over event");
			    }*/
	        });
	    });
	</script>
	</body>
</html>
