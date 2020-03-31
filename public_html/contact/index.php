<?php 
$nameErr = $emailErr = $messageErr = "";

if(isset($_POST['submit'])){
	if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
  if (empty($_POST["textarea"])) {
    $messageErr = "Message is required";
  }
  if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["textarea"])) {
    $to = "info@coronajass.ch"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $subject = "Contact - Submission";
    $subject2 = "Submission on coronajass.ch";
    $message = $name . " with the E-Mail: " . $from . " wrote the following:" . "\n\n" . $_POST['textarea'] . "\n\n";
    $message2 = "Mail sent: " . $name . "\n\n" . $_POST['textarea'] . "\n\nI will contact you shortly.";

    $headers = "From:" . $from; # "pas.schaerli@sunrise.ch"
    $headers2 = "From:" . $to; # "passcha@student.ethz.ch"
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    header('Location: /thanks');
	}
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Kontakt - Corona Jass</title>
  <link rel="shortcut icon" href="game/assets/favicon/CoronaJass.ico?v=1.0">
  <link rel="icon" sizes="16x16 32x32 64x64" href="game/assets/favicon/CoronaJass.ico?v=1.0">
  <link rel="icon" type="image/png" sizes="196x196" href="game/assets/favicon/CoronaJass-192.png?v=1.0">
  <link rel="icon" type="image/png" sizes="160x160" href="game/assets/favicon/CoronaJass-160.png?v=1.0">
  <link rel="icon" type="image/png" sizes="96x96" href="game/assets/favicon/CoronaJass-96.png?v=1.0">
  <link rel="icon" type="image/png" sizes="64x64" href="game/assets/favicon/CoronaJass-64.png?v=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="game/assets/favicon/CoronaJass-32.png?v=1.0">
  <link rel="icon" type="image/png" sizes="16x16" href="game/assets/favicon/CoronaJass-16.png?v=1.0">
  <link rel="apple-touch-icon" href="game/assets/favicon/CoronaJass-57.png?v=1.0">
  <link rel="apple-touch-icon" sizes="114x114" href="game/assets/favicon/CoronaJass-114.png?v=1.0">
  <link rel="apple-touch-icon" sizes="72x72" href="game/assets/favicon/CoronaJass-72.png?v=1.0">
  <link rel="apple-touch-icon" sizes="144x144" href="game/assets/favicon/CoronaJass-144.png?v=1.0">
  <link rel="apple-touch-icon" sizes="60x60" href="game/assets/favicon/CoronaJass-60.png?v=1.0">
  <link rel="apple-touch-icon" sizes="120x120" href="game/assets/favicon/CoronaJass-120.png?v=1.0">
  <link rel="apple-touch-icon" sizes="76x76" href="game/assets/favicon/CoronaJass-76.png?v=1.0">
  <link rel="apple-touch-icon" sizes="152x152" href="game/assets/favicon/CoronaJass-152.png?v=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="game/assets/favicon/CoronaJass-180.png?v=1.0">
  <meta name="msapplication-TileColor" content="#FFFFFF">
  <meta name="msapplication-TileImage" content="game/assets/favicon/CoronaJass-144.png?v=1.0">
  <meta name="msapplication-config" content="game/assets/favicon/browserconfig.xml">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../game/assets/css/style.css">
	</head>
	<body class="is-preload">

		<!-- Heading -->
			<div id="mail" >
			</div>
		<!-- Form -->
		<section id="main" class="wrapper">
			<div class="inner">
				<header class="special">
						<h2>Contact</h2>
					</header>
					<div class="content">
									<form method="post" action="#">
										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
												<input type="text" name="name" id="name" value="" placeholder="Name" />
												<span class="error"> <?php echo $nameErr;?></span>
											</div>
											<div class="col-6 col-12-xsmall">
												<input type="email" name="email" id="email" value="" placeholder="Email" />
												<span class="error"> <?php echo $emailErr;?></span>
											</div>
											<div class="col-12">
												<textarea name="textarea" id="textarea" placeholder="Question about the Solar House" rows="6"></textarea>
												<span class="error"> <?php echo $messageErr;?></span>
											</div>
											<!-- Break -->
											<div class="col-12">
												<ul class="actions">
													<li><input type="submit" name="submit" value="Submit Form" class="primary" /></li>
													<li><input type="reset" value="Reset" /></li>
												</ul>
											</div>
										</div>
									</form>	
								</div>
							</div>
			</section>
	</body>
</html>