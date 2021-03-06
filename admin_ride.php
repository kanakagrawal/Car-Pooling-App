<?php require('header2.php'); ?>

<?php
    require("db_connect.php");
    echo "<p></p>";
    
    $rides = pg_query($con, "SELECT car.owner, r.origin, r.destination, r.time_stamp, r.price, c.client, r.rideid, r.bid_price
    FROM car,ride_price r LEFT OUTER JOIN complete_ride c ON r.rideid=c.rideid 
    WHERE car.carid=r.carid ORDER BY r.time_stamp;");
    if (pg_num_rows($rides) == 0) { 
		echo '<div class="error-msg">
				<i class="fa fa-times-circle"></i>
				There are no rides
			  </div>';
	} else {
		?>

		<div class="table-responsive">          
		  <table class="table table-hover">
		    <thead>
		      <tr>
				<th>Driver</th>
		        <th>Origin</th>
		        <th>Destination</th>
		        <th>Date</th>
		        <th>Price</th>
		        <th>Status</th>
		        <th>Client</th>
		        <th></th>
		       <th colspan="2"><button class='btn btn-success' align = "center" onclick="location.href = './admin_addRide.php'">Add Ride</button></th>
		      </tr>
		    </thead>
		    <tbody>
		<?php
		while($row = pg_fetch_assoc($rides)){
			echo " <tr>
				<td>".$row['owner']."</td>
		        <td>".$row['origin']."</td>
		        <td>".$row['destination']."</td>
		        <td>".$row['time_stamp']."</td>
		        <td>".(($row['bid_price'])?$row['bid_price']:$row['price'])." $</td>";
		        if($row['client']){
		        	echo "<td style='background-color:green'> Completed </td>
							<td>".$row['client']."</td>";
		        }
		        else{
		        	echo "<td style='background-color:orange'> Pending </td>
							<td> ... </td>";
		        }
		  		echo '<td><form action = "admin_modifyride.php" method="GET">
		  	<input type = "hidden" name = "rideid" value = "'.$row["rideid"].'">
		  	  <button type="submit" class="btn">Modify</button>
		  </form></td>';
		  		echo '<td><form action = "admin_deleteride.php" method="POST">
		  	<input type = "hidden" name = "rideid" value = "'.$row["rideid"].'">
		  	  <button type="submit" class="btn btn-danger">Delete</button>
		  </form></td>';
			echo " </tr>";
		}
		?>
		</tbody>
		  </table>
		  </div>
		<?php 
	} 
    
    require("db_close.php");
?>

	
</body>

</html>
