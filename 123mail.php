<?php
$to = $_POST[mail]; 
			$subject = 'Signup | Verification'; // Give the email a subject
			$from = "100Bonuspoints<100BonusPoints@100bonusPoints.com>";
			$message = " 
           	Thanks for signing up! 
			<p style='color:red;'>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
			 </p>
            <table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
			<p>Please click this link to activate your account: </p>
			 
		
			"; // Our message above including the link  
		// Always set content-type when sending HTML email
$headers .= "Content-type: text/html\r\n"; 
			$headers .= "From:" .$from. "\r\n"; // Set from headers  
			mail($to, $subject, $message, $headers); // Send our email  
echo $to;
?> 