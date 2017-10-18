<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>One Page Wonder - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/one-page-wonder.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<style>
		textarea { resize: vertical; }
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            width: 100%;
            padding: 6px 12px;
            cursor: pointer;
        }
	</style>
</head>

<?php
			if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $name = $_POST['name'];
                $subject = $_POST['subject'];
                $message = $_POST['message'];
                $budget = $_POST['budget'];

				require 'PHPMailer/PHPMailerAutoload.php';
				include('PHPMailer/class.phpmailer.php');
				$feedback = "";

				$mail = new PHPMailer;

				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'florimi772@gmail.com';       // SMTP username
				$mail->Password = 'Florimi14100'; // SMTP password
				$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                 // TCP port to connect to

				$mail->setFrom($email, 'From');
				$mail->addReplyTo('florimi772@gmail.com', 'From');
				$mail->addAddress('florimi772@gmail.com');          //$email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');

				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent = 'From: '.$name.'<br>Email: '.$email.'<br>Budget: '.$budget.'<br>Message:<br>'.$message;

				$mail->Subject = $subject;
				$mail->Body    = $bodyContent;

				$uploadOk = 1;
    			$imageFileType = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
    			// Check if image file is a actual image or fake image
   				if(isset($_POST["submit"])) {
        			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        			if($check !== false) {
            			$uploadOk = 1;
        			} else {
            			$uploadOk = 0;
        			}
    			}
    			// Check file size
    			if ($_FILES["fileToUpload"]["size"] > 500000) {
        			$feedback = "Sorry, your file is too large.";
        			$uploadOk = 0;
    			}
    			// Allow certain file formats
   				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        			$feedback = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        			$uploadOk = 0;
    			}
    			// Check if $uploadOk is set to 0 by an error
    			if ($uploadOk == 0) {
        			$feedback = "Sorry, your file was not uploaded.";
    			} else {
    					$mail->AddAttachment( $_FILES['fileToUpload']['tmp_name'], $_FILES['fileToUpload']['name'] );
    					if(!$mail->send()) {
							$feedback = "Message could not be sent.";	
						} else {
						    $feedback = "Message has been sent.";
						}
    				}
				}
			?>


<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">3DLodra</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#about">Rreth nesh</a>
                    </li>
                    <li>
                        <a href="#services">Sherbimet</a>
                    </li>
                    <li>
                        <a href="#contact">Porosit</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Full Width Image Header -->
    <header class="header-image">

        <div class="headline"  >
                <img src="3dlodraCOVER.jpg" width=100%; height=100%; >
            <!-- <div class="container">
                <h1>One Page Wonder</h1>
                <h2>Will Knock Your Socks Off</h2>
            </div> -->

        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

    <hr class="featurette-divider">

    <!-- First Featurette -->
    <div class="featurette" id="about">
        <img class="featurette-image img-circle img-responsive pull-right" src="foto3.jpg">
        <h2 class="featurette-heading">Rreth Nesh
            <span class="text-muted">"Lodra juaj ashtu si e keni vizatuar"</span>
        </h2>
        <p class="lead">Një përshkrim i shkurtër për Biznesin tuaj<!-- Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo. --></p>
    </div>

    <hr class="featurette-divider">

    <!-- Second Featurette -->
    <div class="featurette" id="services">
      <img class="featurette-image img-circle img-responsive pull-left" src="Foto_2.jpg">
            <h2 class="featurette-heading">Shërbimet dhe produktet tona  
                <span class="text-muted">"Nji quote rreth 3dLojes"</span>
            </h2>
            <p class="lead">Përshkrim për produktet tona... PS: Mundet ne rrumbullkë të tillë me u paraqit edhe më shumë produkte në madhësi më të vogla  </p>
        </div>

        <hr class="featurette-divider">

        <!-- Third Featurette -->
        <div class="featurette" id="contact">
            <img class="featurette-image img-circle img-responsive pull-right" src="Foto_1.jpg">
            <h2 class="featurette-heading">Prosit Online
                <span class="text-muted">"Ta bijm edhe te shpija :P"</span>
            </h2>
            <p class="lead">Text rreth mënyrës si te porositet online...</p>
        </div>
        <!--   ******************************************************************
        INPUT FORMA
		****************************************************************** -->
		<h4 id="feedback">
            
            

			<?php
				if (isset($_POST['submit'])) {?>
					<div class="alert alert-success">
                         <?php echo $feedback ?>
                    </div><?php
                }
			?>
		</h4>
        <form id="contact-form" class="contact-form" action='' method='post' action="form_phpm_mailer.php" enctype="multipart/form-data">
			<div class="row">
			    <div class="col-lg-6 col-md-6">
    	            <input type="text" id="name" name="name" class="input-field" placeholder="Your Name">
				</div>
					
				<div class="col-lg-6 col-md-6">
					<input type="email" id="email" name="email" class="input-field" placeholder="Your Email">
				</div>
					
				<div class="col-lg-6 col-md-6">			
					<input type="text" id="subject" name="subject" class="input-field" placeholder="Subject">			
				</div>
			
				<div class="col-lg-6 col-md-6">
					<input type="text" id="budget" name="budget" class="input-field" placeholder="Project Budget">	
				</div>
				
				<div class="col-lg-6 col-md-6">
					<!--<button class="btn btn-default standard-button red-button" >Browse</button>
                    <label for="fileToUpload" class="custom-file-upload">
                        <i class="fa fa-cloud-upload"></i> Custom Upload
                    </label>
                    <input type="file" name="fileToUpload" id="fileToUpload" value="Upload a photo!"/>
                    -->
        			<input type="file" name="fileToUpload" id="fileToUpload" value="Upload a photo!"
                        style="width:100%; border: 1px solid gray; display: inline-block; border-radius: 5px; padding: 6px 12px; cursor: pointer">
                        
				</div>

				<div class="col-lg-12"><br>
	                <textarea name="message" id="message" class="input-field" rows="10" placeholder="Your Message"></textarea>
				</div>
	
				<div class="col-lg-12">
					<input type="submit" value="Dergo Porosine" name="submit" class="btn btn-default standard-button red-button">
        		    <!--<button onclick="window.open('mailto:test@example.com?subject=subject&body=body');" class="btn btn-default standard-button red-button">Dergo Porosine</button>-->
				</div>		
			</div>
    	</form>

        <!-- ****************************************************************** -->

        <hr class="featurette-divider">

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Kiku 3DLodra 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
