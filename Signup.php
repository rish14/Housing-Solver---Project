
<?php
 require_once 'Connect.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  { 
    $useremail = $mysqli->real_escape_string($_POST['useremail']); //getting the email
	$selectunivemailOption = $mysqli->real_escape_string($_POST['univemailOption']);
    $result = $mysqli->query("SELECT * FROM `Student Info` WHERE `User Email`=CONCAT('$useremail','$selectunivemailOption')"); //checking if the email exists in the database

    if ( $result->num_rows == 0 ) { 
      $_SESSION['message'] = "User email does not exist in our database!"; // if email doesn't exist
	}

else { // Email exists
 $password = $mysqli->real_escape_string($_POST['password']);
 $firstname = $mysqli->real_escape_string($_POST['firstname']);
 $lastname = $mysqli->real_escape_string($_POST['lastname']);
 $selectunivnameOption = $mysqli->real_escape_string($_POST['univnameOption']);
 $selectdayOption = $mysqli->real_escape_string($_POST['dayOption']);
 $selectmonthOption = $mysqli->real_escape_string($_POST['monthOption']);
 $selectyearOption = $mysqli->real_escape_string($_POST['yearOption']);
 $sql = "INSERT INTO `Users` (`Day`, `Month`, `Year`, `User Email`, `First Name`, `Last Name`, `Password`, `University`) VALUES ('$selectdayOption', '$selectmonthOption', '$selectyearOption', CONCAT('$useremail','$selectunivemailOption'), '$firstname', '$lastname', '$password', '$selectunivnameOption');";
 if ($mysqli->query($sql) === TRUE) {
    //echo "New record created successfully";
	header("location: https://mansci-db.uwaterloo.ca/~team13/HousingApp/Testing5.php");
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
  }
  }

$mysqli->close();

?>
<html> 
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 25%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #D94E51;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  width: 100%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: #474e5d;
    padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 30%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
}

.close:hover,
.close:focus {
    color: #f44336;
    cursor: pointer;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}

.design{
width:180px; height:40px
}

.design2{
width:80px; height:40px
}

.modal-error {
    background-color: #FFFFFF;
    margin: 0% auto 0% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 0px solid #888;
	width: 25%; /* Could be more or less, depending on screen size */
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}

</style>
<body>

<!--<h2>Landing Page Template</h2>-->

<div class="modal-error animate"><b><?= $_SESSION['message'] ?> </b></div>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content animate" action="signup.php" method="POST">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="useremail"><b>User Email</b></label>
      <input type="text" placeholder="Enter Email Address" name="useremail" required>
	  
	  <select class="design" name="univemailOption">
			<option value="@wlu.ca"> @wlu.ca</option>
			<option value="@edu.uwaterloo.ca"> @edu.uwaterloo.ca</option>
			<option value="@conestogac.on.ca"> @conestogac.on.ca</option>
	  </select>
	
	  <br>
	  
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
	  
	  <label for="univnameOption"><b>University</b></label>
	  <select class="design" name="univnameOption">
			<option value="Wilfrid Laurier University"> Wilfrid Laurier University</option>
			<option value="University of Waterloo"> University of Waterloo</option>
			<option value="Conestoga College"> Conestoga College</option>
	  </select>
	  
	  <br>
	  <label for="firstname"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="firstname" required>
	  
	  <label for="lastname"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="lastname" required>
	  
	  <br>
	  
	  <label for="dob"><b>Date of Birth</b></label>
	  
	  <br>
	  <br>
	  
      Day	
<select class="design2" name="dayOption">
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select>

Month
<select class="design2" name="monthOption">
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
</select>

Year
<select class="design2" name="yearOption">
<option value='1947'>1947</option>
<option value='1948'>1948</option>
<option value='1949'>1949</option>
<option value='1950'>1950</option>
<option value='1951'>1951</option>
<option value='1952'>1952</option>
<option value='1953'>1953</option>
<option value='1954'>1954</option>
<option value='1955'>1955</option>
<option value='1956'>1956</option>
<option value='1957'>1957</option>
<option value='1958'>1958</option>
<option value='1959'>1959</option>
<option value='1960'>1960</option>
<option value='1961'>1961</option>
<option value='1962'>1962</option>
<option value='1963'>1963</option>
<option value='1964'>1964</option>
<option value='1965'>1965</option>
<option value='1966'>1966</option>
<option value='1967'>1967</option>
<option value='1968'>1968</option>
<option value='1969'>1969</option>
<option value='1970'>1970</option>
<option value='1971'>1971</option>
<option value='1972'>1972</option>
<option value='1973'>1973</option>
<option value='1974'>1974</option>
<option value='1975'>1975</option>
<option value='1976'>1976</option>
<option value='1977'>1977</option>
<option value='1978'>1978</option>
<option value='1979'>1979</option>
<option value='1980'>1980</option>
<option value='1981'>1981</option>
<option value='1982'>1982</option>
<option value='1983'>1983</option>
<option value='1984'>1984</option>
<option value='1985'>1985</option>
<option value='1986'>1986</option>
<option value='1987'>1987</option>
<option value='1988'>1988</option>
<option value='1989'>1989</option>
<option value='1990'>1990</option>
<option value='1991'>1991</option>
<option value='1992'>1992</option>
<option value='1993'>1993</option>
<option value='1993'>1994</option>
<option value='1993'>1995</option>
<option value='1993'>1996</option>
<option value='1993'>1997</option>
<option value='1993'>1998</option>
<option value='1993'>1999</option>
<option value='1993'>2000</option>

</select>
      <br>
	  <br>
<!--
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
-->

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
		<button <input class="signupbtn" value="Sign Up" name="Sign Up" type="submit">Sign Up</button>
        <!--<button type="submit" class="signupbtn">Sign Up</button>-->
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
