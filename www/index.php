<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>www.kiku3D.com</title>
    <link rel="shortcut icon" href="3dlodraCOVER.jpg" type="image/x-icon" /> 

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
    <!-- Custom CSS -->
    <link href="css/one-page-wonder.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
    
        jQuery(document).ready(function() {
            jQuery("[required]").after("<span class='required'>*</span>");
        });
    </script>

    <script>
        function myFunction() {
            var x = document.getElementById("snackbar")
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
    </script>

    <style>
        .required {
            position: absolute;
            margin-left: -15px;
            color: #FB0000;
            font-size: 25px;
        }


        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;} 
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   
</head>

<?php

    $feedback = '';
    
    if (isset($_POST['submit'])) {
        
        $forma = $_POST['forma'];
        $EmriFemijes = $_POST['emriFemijes'];
        $EmriLodres = $_POST['emriLodres'];
        $Email = $_POST['email'];
        $Adresa = $_POST['adresa'];
        $Telefoni = $_POST['nrTelefonit'];

        require 'PHPMailer/PHPMailerAutoload.php';
        include('PHPMailer/class.phpmailer.php');

        if($forma == "Bëje vet")
        {
            $kategoria = $_POST['Kategoria'];
            $Radio = $_POST['radio'];
            $Message = $_POST['message'];
            $dimensionet = $_POST['Dimensionet'];
    
    
            $mail = new PHPMailer;
            $mail->isSMTP();                                   // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                            // Enable SMTP authentication
            $mail->Username = 'florimi772@gmail.com';       // SMTP username
            $mail->Password = 'Florimi14100'; // SMTP password
            $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                 // TCP port to connect to
    
    
            $mail->setFrom($Email, 'Porosit loder');
            $mail->addReplyTo($Email, 'From');
            $mail->addAddress('florim14hamiti@gmail.com');          //$email);   // Add a recipient
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
    
            $mail->isHTML(true);  // Set email format to HTML
    
            $bodyContent = 'Lloji i porosisë: '.$forma.'<br>Emri i femijës: '.$EmriFemijes.'<br>Emri i lodrës: '.$EmriLodres;
            $bodyContent .='<br>Lloji i lodrës: '.$kategoria.'<br>Paraqitet në galerinë tonë: '.$Radio.'<br>Dimensionet: '.$dimensionet;
            $bodyContent .='<br>Adresa: '.$Adresa.'<br>Numri i telefonit: '.$Telefoni.'<br><br>Mesazhi: '.$Message;
    
            $mail->Subject = "Pososit nje loder!";
            $mail->Body = $bodyContent;
    
            $uploadOk = 1;
            $imageFileType = pathinfo($_FILES["uploadFoto"]["name"],PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["uploadFoto"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }
    
            // Check file size
            if ($_FILES["uploadFoto"]["size"] > 500000) {
                $feedback = "Më falni, madhësia e file-it është shumë e madhe!";
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $feedback = "Më falni, vetëm JPG, JPEG, PNG ose GIF file-at lejohen.";
                $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $feedback = "Më falni, file-i juaj nuk është ngarkuar.";
            } else {
                $mail->AddAttachment( $_FILES['uploadFoto']['tmp_name'], $_FILES['uploadFoto']['name'] );
                if(!$mail->send()) {
                    $feedback = "E-mail nuk eshte derguar!";
                } else {
                    $feedback = "E-mail eshte derguar, do ju pergjigjemi se shpejti";
                }
            }
        }
        else if($forma == "Gjysmë të gatshme")
        {
            $mail = new PHPMailer;
            $mail->isSMTP();                                   // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                            // Enable SMTP authentication
            $mail->Username = 'florimi772@gmail.com';       // SMTP username
            $mail->Password = 'Florimi14100'; // SMTP password
            $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                 // TCP port to connect to
    
    
            $mail->setFrom($Email, 'Porosit loder');
            $mail->addReplyTo($Email, 'From');
            $mail->addAddress('florim14hamiti@gmail.com');          //$email);   // Add a recipient
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
    
            $mail->isHTML(true);  // Set email format to HTML
    
            $bodyContent = 'Lloji i porosisë: '.$forma.'<br>Emri i femijës: '.$EmriFemijes.'<br>Emri i lodrës: '.$EmriLodres;
            $bodyContent .='<br>Adresa: '.$Adresa.'<br>Numri i telefonit: '.$Telefoni;
    
            $mail->Subject = "Pososit nje loder!";
            $mail->Body = $bodyContent;
    
            $uploadOk = 1;
            $imageFileType = pathinfo($_FILES["uploadFoto"]["name"],PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["uploadFoto"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }
    
            // Check file size
            if ($_FILES["uploadFoto"]["size"] > 500000) {
                $feedback = "Më falni, madhësia e file-it është shumë e madhe!";
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $feedback = "Më falni, vetëm JPG, JPEG, PNG ose GIF file-at lejohen.";
                $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $feedback = "Më fal, foto-ja juaj nuk është ngarkuar.";
            } else {
                $mail->AddAttachment( $_FILES['uploadFoto']['tmp_name'], $_FILES['uploadFoto']['name'] );
                if(!$mail->send()) {
                    $feedback = "E-mail nuk eshte derguar!";
                } else {
                    $feedback = "E-mail eshte derguar, do ju pergjigjemi se shpejti";
                }
            }
        }
    }?>
    
    <div id="snackbar"><?php echo $feedback; ?></div>
    <?php
    if($feedback != '')
    {
        echo '<script type="text/javascript">', 'myFunction();', '</script>';
    }
?>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60"  style="background: url(BackgroundTest1.jpg); background-size: 100% 100%;background-repeat: no-repeat; ">

    <!-- Mali: Scripta per 2 variacionet e Porosise te InputForma -->
    <script type="text/javascript">
        function Inputforma ()
        {

           a=document.getElementById('FormA').value;
           console.log(a);
           if (a=='Gjysmë të gatshme') 
           {
            //document.getElementById('InputForma1').style.display='none';
            //document.getElementById('InputForma4').style.display='none';
            //document.getElementById('InputForma5').style.display='none';
            //document.getElementById('InputForma6').style.display='none';
            //document.getElementById('InputForma7').style.display='none';
            //document.getElementById('InputformaGaleri').style.display='inline';
            $('#InputForma4').slideUp();
            $('#InputForma5').slideUp();
            $('#InputForma6').slideUp();
            $('#InputForma7').slideUp();
            $('#InputformaGaleri').slideDown().show();
           }
           else
           {
            //document.getElementById('InputForma1').style.display='inline';
            //document.getElementById('InputForma4').style.display='inline';
            //document.getElementById('InputForma5').style.display='inline';
            //document.getElementById('InputForma6').style.display='inline';
            //document.getElementById('InputForma7').style.display='inline';
            //document.getElementById('InputformaGaleri').style.display='none';
            $('#InputForma4').slideDown();
            $('#InputForma5').slideDown();
            $('#InputForma6').slideDown();
            $('#InputForma7').slideDown();
            $('#InputformaGaleri').slideUp();
           }

        }

    </script>
    </script>
    <script type="text/javascript">
         function play(){
            if($(".video").get(0).paused){
                $(".video").get(0).play();
                $("#playpause").fadeOut();
            
             }else{
                $(".video").get(0).pause();
                $("#playpause").fadeIn();
             }
         }

         function play2(){
            if($(".video2").get(0).paused){
                $(".video2").get(0).play();
                $("#playpause2").fadeOut();
            
             }else{
                $(".video2").get(0).pause();
                $("#playpause2").fadeIn();
             }
         }
</script>
<!-- Mali: Perfundimi i Skriptes -->

    <!-- Navigation -->
    
    <nav class="navbar navbar-inverse navbar-fixed-top" >
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#myPage">3DLodra</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#about">Rreth nesh</a>
                    </li>
                    
                    <!-- Rregullimi i nav barit shtimi menyve GJUPI:-->
                    <li>
                        <a href="#services">Bëje vet</a>
                    </li>
                    <li>
                        <a href="#gjysmeTeGatshme">Gjysëm të gatshme</a>
                    </li>
                    <li>
                        <a href="#galeria">Galeria</a>
                    </li>
                    <li>
                        <a href="#contact">Porosit</a>
                    </li>
                     <li>
                        <a href="#footer">Kontakti</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Full Width Image Header -->
    <header class="header-image">

        <div class="headline">
                <img src="3dlodraCOVER.jpg" width=100%; height=100%; >
            <!-- <div class="container">
                <h1>One Page Wonder</h1>
                <h2>Will Knock Your Socks Off</h2>
            </div> -->

        </div>
    </header>


    <!-- Page Content -->
    <div class="container">

        <div id="about" >
            <hr class="featurette-divider">
            <!-- First Featurette -->
            <div class="featurette" >
                <img class="featurette-image img-circle img-responsive pull-right" src="alieni.png" style="margin-top: 50px;">
                <h2 class="featurette-heading"><!-- Rreth Nesh -->
                    <span class="text-muted">Lodra juaj ashtu si e keni vizatuar</span>
                </h2>
                <p class="lead"Kiku është një start-up që mirret me prodhimin e lodrave me anë të teknologjisë 3D bazuar në vizatime.<br> Letra gjithmonë humbet në shtëpi prandaj vizatimin e fëmijëve tuaj apo të fëmijërisë suaj silleni tek ne dhe ne ju kthejmë ato ne 3D.<br> A ka diçka më të mirë se sa fëmija të kalojë kohën duke luajtur me lodrën të cilën e ka vizatuar vet?<br> Sjell imagjinatën dhe kreativitetin tek ne, ne sjellim realitetin tek ju!<!-- Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo. --></p>
            </div>
        </div>
        

       <div id="services">
            <hr class="featurette-divider" >
        
           
            <!-- Second Featurette -->
            <!-- <div class="featurette" >
                <img class="featurette-image img-circle img-responsive pull-left" src="Foto_2.jpg">
                <h2 class="featurette-heading">Shërbimet dhe produktet tona  
                    <span class="text-muted">"Nji quote rreth 3dLojes"</span>
                </h2>
                <p class="lead">Përshkrim për produktet tona... PS: Mundet ne rrumbullkë të tillë me u paraqit edhe më shumë produkte në madhësi më të vogla  </p>
            </div> GJUPI BEJE VET TEKSTI -->
            <div class="featurette" >
                 <h2 class="featurette-heading"><!-- Beje vet -->
                    <span class="text-muted"><!-- <br/></t> -->Aty ku vizatimi merr jete</span>
                </h2>
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12" onclick="play()">
                    <!-- <video width="80%" height="30%"  loop preload="autoplay" src="Kiku-Bejevet.mp4" controls="">
                      
                    </video> -->
                        <video  class="video" width="80%" height="30%" loop preload="autoplay" src="Kiku-Bejevet.mp4" controls="yourControls">
                      
                        </video>
                        <div id="playpause" ></div>
                    </div>
                    <!-- <div class="col-sm-12 col-md-3 col-lg-3">
                        <h2>Step 1-Vizatimi</h2>
                        <p class="lead" style="height: 145px">Zgjidhni vizatimin qe e keni per zemer</p>
                        <img src="paint.jpg" width="75%" height="75%">
                    </div>
    
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <h2>Step 2-Skenimi</h2>
                        <p class="lead" style="height: 145px">Skenoni ate vizatim dhe ruani ne njerin nga formatet .jpg, .jpeg, .png dhe ngarkojeni ne uebsajtin tone</p>
                         <img src="paint.jpg" width="75%" height="75%">
                    </div>
    
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <h2>Step 3-Printimi3D</h2>
                        <p class="lead" style="height: 145px">Brenda nje kohe te caktuar (do te lajmroheni per kete) pas porositjes me ane te 3DPrintimit vizatimi merr jete</p>
                         <img src="paint.jpg" width="75%" height="75%">
                    </div>
    
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <h2>Step 4-Dergesa</h2>
                        <p class="lead" style="height: 145px">Pasi lodra, figura te jete gati stafi kiki ju sjelle ne dere te shtepise</p>
                         <img src="paint.jpg" width="75%" height="75%">
                    </div>
                </div> -->
            </div>
        </div>
    </div>




        <div id="gjysmeTeGatshme">
            <!-- GJUPI GJYSEM TE GATSHME SHTIM -->
            <hr class="featurette-divider" >
            
            <div class="featurette" >
                <h2 class="featurette-heading"><!-- Gjysem te gateshme -->
                    <span class="text-muted"><!-- <br/></t> -->Aty ku vizatimi merr jete</span>
                </h2>
                <div class="row">
                <!-- Mali test insert videon DIV -->
                <div class="col-sm-12 col-md-12 col-lg-12" onclick="play2()">
                    <video width="80%" height="30%" loop preload="autoplay" src="Gjysem te gatshme.mp4" controls="yourControls" class="video2">
                      
                    </video>
                    <div id="playpause2"></div>
                    
                </div>

                    <!-- <div class="col-sm-12 col-md-3 col-lg-3">
                        <h2>Step 1-Dizajno</h2>
                        <p class="lead" style="height: 145px">Tek "Porosit" zgjidhni opsionin per lodren gjysem te gateshme</p>
                        <img src="paint.jpg" width="75%" height="75%">
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <h2>Step 2-Zgjidh</h2>
                        <p class="lead" style="height: 145px">Nga 5 modelet e ofruara, zgjidhni modelin qe keni deshire</p>
                        <img src="paint.jpg" width="75%" height="75%">
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <h2>Step 3-Printimi3D</h2>
                        <p class="lead" style="height: 145px">Ndryshoni ngjyrat e pjeseve te ndryshme sipas preferencav</p>
                        <img src="paint.jpg" width="75%" height="75%">
                    </div>

                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <h2>Step 4-Dergesa</h2>
                        <p class="lead" style="height: 145px">Pasi lodra,figura te jete gati stafi kiki ju sjelle ne dere te shtepise</p>
                        <img src="paint.jpg" width="75%" height="75%">
                    </div> -->
                </div>
            
            </div>
        </div>


        <div id="galeria">
            <hr class="featurette-divider" >
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px">
                    <section class="single-item slider" style="margin: 0 auto; width: 100%;margin: 0 auto" >
                        <div style="background-color: transparent">
                          <img src="1115x5.png" style="width:50%;height:50%;margin: 0 auto">
                        </div>
                        <div style="background-color: transparent">
                          <img src="4445x5.png" style="width:50%;height:50%;margin: 0 auto">
                        </div>
                        <div style="background-color: transparent" >
                          <img src="5555x5.png" style="width:50%;height:50%;margin: 0 auto">
                        </div>
                        <div style="background-color: transparent" >
                          <img src="7775x5.png" style="width:50%;height:50%;margin: 0 auto">
                        </div>
                    </section>
                </div>
            </div>
        </div>



        
           <div id="contact">
            <hr class="featurette-divider" >
            <!-- Third Featurette -->
            <div class="featurette">
                <!-- <img class="featurette-image img-circle img-responsive pull-right" src="Foto_1.jpg"> -->
                <h2 class="featurette-heading"><!-- Prosit Online -->
                    <span class="text-muted">Ju sjellim në shtëpi</span>
                </h2>
               <!--  <p class="lead">Text rreth mënyrës si te porositet online...</p> -->
                <!--   **************************************************************
        INPUT FORMA
        ************************************************************** -->
         <form action="" method="post" id="contact-form" class="contact-form" action="form_phpm_mailer.php" enctype="multipart/form-data">
                        

                        <div class="row">
                            <!-- class="col-lg-6 col-md-6" -->
                            <div id="InputFormaZgjedh" class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <!--<input id="FormA" list="forma" class="input-field " name="" placeholder="Zgjedh" oninput="Inputforma()"> 
                                 <datalist id="forma" >
                                    <option id="Bëje vet" value="Bëje vet"></option>
                                    <option id="Gjysmë të gatshme" value="Gjysmë të gatshme"></option>
                                </datalist> -->
                                <select id="FormA" class="input-field-select" name="forma" placeholder="Zgjedh" oninput="Inputforma()">
                                    <option id="Bëje vet" value="Bëje vet">Bëje vet</option>
                                    <option id="Gjysmë të gatshme" value="Gjysmë të gatshme">Gjysmë të gatshme</option>
                                </select>
                                <!-- <select id="FormA" class="input-field " name="" placeholder="Zgjedh" oninput="Inputforma()">
                                    <option value="Bëje vet">Bëje vet</option>
                                    <option value="Gjysmë të gatshme">Gjysmë të gatshme</option>
                                </select> -->
                            </div>
                        </div>


                        <div class="row">
                        
                            <div id="InputForma2" class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <input type="text" id="emriFemijes" name="emriFemijes" class="input-field" placeholder="Emri i Femijes" required="required">
                            </div>
                        
                        </div>


                        <div class="row">
                        
                            <div id="InputForma3" class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <input type="text" id="emriLodres" name="emriLodres" class="input-field" placeholder="Emri i Lodres" required="required">
                            </div>
                        
                        </div>


                        <div class="row" id="InputForma4">
                        
                            <div  class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <!-- class="input-field" type="" name="testA"> -->
                                <input list="Kategoria" class="input-field" name="Kategoria" placeholder="Lloji i lodrës"> 
                                <datalist id="Kategoria" >
                                    <option value="Perbindesh" ></option>
                                    <option value="Superhero"></option>
                                    <option value="Alien"></option>
                                    <option value="Robot"></option>
                                    <option value="Kafshe"></option>
                                    <option value="Objekt"></option>
                                    <option value="Tjeter"></option>
                                </datalist>
                            </div>
                            
                        </div>



                        <div class="row" id="InputForma5">
                        
                            <!-- 5 Paragrafi i lodres + radio buttonat -->
                            <div  class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <p class="input-field">A mund të paraqitet lodra dhe të dhënat më lartë në galerinë tonë
                                    <input  type="radio" name="radio" value="Po">PO
                                    <input  type="radio" checked="checked" name="radio" value="Jo">JO
                                </p>
                            </div>
                        
                        </div>


                        <div class="row" id="InputForma6">
                            
                            <div  class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <textarea name="message" id="message" class="input-field" rows="8" placeholder="Tregimi per lodren" title="Na tregoni më shumë për këtë lodër. C'formë është, pse i ka këto ngjyra dhe forma, çfare superfuqi ka etj."></textarea>
                            </div>
                            
                        </div>


                        <div class="row" id="InputformaGaleri" style="display: none;">
                            <div  class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <p class="input-field">Ju lutem zgjidhni njërin nga modelet gjysmë të gatshme klikoni për të shkarkuar ato ngjyrosini dhe na i dërgoni ne që t'ju a sjellim lodër</p>
                            </div>

                        <div class="row">       
                            <div class="col-lg-3 col-sm-12 col-md-3 col-md-offset-2 col-lg-offset-2" id="Fotoja1Galeri" >
                                <a href="paint.jpg" download>
                                    <img src="333.png" width="75%" height="75%">
                                </a>
                            </div>
                        


                            <div class="col-lg-3 col-sm-12 col-md-3 col-md-offset-2 col-lg-offset-2" id="Fotoja2Galeri">
                                <a href="paint.jpg" download>
                                    <img src="666.png" width="75%" height="75%">
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-md-3 col-md-offset-2 col-lg-offset-2" id="Fotoja3Galeri">
                                <a href="paint.jpg" download>
                                    <img src="222.png" width="75%" height="75%">
                                </a>
                                </div>
                            <div class="col-lg-3 col-sm-12 col-md-3 col-md-offset-2 col-lg-offset-2" id="Fotoja4Galeri">
                                <a href="paint.jpg" download>
                                    <img src="888.png" width="75%" height="75%">
                                </a>
                            </div>
                                
                        </div>
                    </div>

                    <div class="row" id="InputForma1">
                                                    
                            
                            <div  class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <input   required type="file" id="uploadFoto"  name="uploadFoto" class="btn btn-default standard-button red-button" placeholder="Upload Foton" title="Ngarko foton e fëmijëve këtu në formatin .jpg .png .jpeg" style="display: none;" />
                                <label  for="uploadFoto" class="btn btn-default standard-button red-button"  style="width: 100%;margin-left: 0px">Ngarko foton</label>    
                            </div>
                
                           
                        </div>  

                        
                        <div class="row" id="InputForma7">
                        
                            <div  class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <input list="Dimensionet" class="input-field" name="Dimensionet" placeholder="Zgjedh Dimensionet">
                                <datalist id="Dimensionet">
                                    <option value="10cm"></option>
                                    <option value="15cm"></option>
                                    <option value="20cm"></option>
                                </datalist>
                            </div>
                        
                        </div>


                        <div class="row">
                        
                            <div id="InputForma8" class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <br><input type="email" id="email" name="email" class="input-field" placeholder="Emaili" title="Ku mund të ju kontaktojmë" required="required">
                            </div>
                        
                        </div>


                        <div class="row">
                        
                            <div id="InputForma9" class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <input type="text" id="adresa" name="adresa" class="input-field" placeholder="Adressa" title="Ku dëshironi tju sjellim produktin" required="required">
                            </div>
                        
                        </div>


                        <div class="row">
                        
                            <div id="InputForma10" class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                <input type="text" id="nrTelefonit" name="nrTelefonit" class="input-field" placeholder="Numri i Telefonit" title="Alternativa tjetër e kontaktit">
                            </div>
                            
                        
                        </div>
                        <div class="row">
                            <div id="InputForma11" class="col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4">
                                <input style="width: 100%; margin-left: 0px" type="submit" id="submit" name="submit" value="Dergo Porosine" class="btn btn-default standard-button red-button">
                            </div>
                        </div>
                    </form>
        <!-- ************************************************************** -->




            </div>
        </div>
       
      <!--   **************************************************************
        INPUT FORMA
        ************************************************************** -->
        <!--  <form id="contact-form" class="contact-form">
                        <div class="row">

                            <div id="InputFormaZgjedh" class="col-md-8 col-lg-8">
                                <input id="FormA" list="forma" class="input-field " name="" placeholder="Zgjedh" onchange="Inputforma()"> 
                                <datalist id="forma" >
                                    <option value="Bëje vet" ></option>
                                    <option value="Gjysmë të gatshme"></option>
                                </datalist>
                            </div>                            
                            <div id="InputForma1" class="col-lg col--8md-8">

                                <input required type="file" id="uploadFoto"  name="foto" class="btn btn-default standard-button red-button col-lg-8 col-md-8 " placeholder="Upload Foton" title="Ngarko foton e fëmijëve këtu në formatin .jpg .png .jpeg" style="display: none;" >
                                <label for="uploadFoto" class="btn btn-default standard-button red-button col-lg-8 col-md-8">Ngarko foton</label>

                                
                            </div>
                            <div id="InputForma2" class="col-lg-8 col-md-8">
                                <input type="text" id="name" name="name" class="input-field" placeholder="Emri i Femijes" required="required">
                            </div>
                            <div id="InputForma3" class="col-lg-8 col-md-8">
                                <input type="text" id="name" name="name" class="input-field" placeholder="Emri i Lodres">
                            </div>

                            <div id="InputForma4" class="col-md-8 col-lg-8">
                               
                                <input list="Kategoria" class="input-field" name="" placeholder="Lloji i lodrës"> 
                                <datalist id="Kategoria" >
                                    <option value="Perbindesh" ></option>
                                    <option value="Superhero"></option>
                                    <option value="Alien"></option>
                                    <option value="Robot"></option>
                                    <option value="Kafshe"></option>
                                    <option value="Objekt"></option>
                                    <option value="Tjeter"></option>
                                </datalist>
                            </div>
                            
                            <div id="InputForma5" class="col-lg-8 col-lg-8">
                                <p class="input-field">A mund të paraqitet lodra dhe të dhënat më lartë në galerinë tonë</p>
                                <input  type="radio" name="radio" value="Po">PO
                                <input  type="radio" name="radio" value="Jo">JO
                            </div>

                            <div id="InputForma6" class="col-lg-12">
                                <textarea name="message" id="message" class="input-field" rows="8" placeholder="Tregimi per lodren" title="Na tregoni më shumë për këtë lodër. C'formë është, pse i ka këto ngjyra dhe forma, çfare superfuqi ka etj."></textarea>
                            </div>

                            <div class="row" id="InputformaGaleri" style="display: none;">
                                <div  class="col-lg-12 col-lg-12">
                                <p class="input-field">Ju lutem zgjidhni njërin nga modelet gjysmë të gatshme klikoni për të shkarkuar ato ngjyrosini dhe na i dërgoni ne që t'ju a sjellim lodër</p>
                                </div>
                                
                                <div class="col-md-3" id="Fotoja1Galeri" >
                                    <a href="paint.jpg" download>
                                    <img src="paint.jpg" width="75%" height="75%">
                                    </a>
                                </div>
                                
                                <div class="col-md-3" id="Fotoja2Galeri">
                                    <a href="paint.jpg" download>
                                    <img src="paint.jpg" width="75%" height="75%">
                                    </a>
                                </div>
                                <div class="col-md-3" id="Fotoja3Galeri">
                                    <a href="paint.jpg" download>
                                    <img src="paint.jpg" width="75%" height="75%">
                                    </a>
                                </div>
                                <div class="col-md-3" id="Fotoja4Galeri">
                                    <a href="paint.jpg" download>
                                    <img src="paint.jpg" width="75%" height="75%">
                                    </a>
                                </div>
                                
                            </div>
                            <br>
                            <div id="InputForma7" class="col-md-8 col-lg-8">
                                <input list="Dimensionet" class="input-field" name="" placeholder="Zgjedh Dimensionet">
                                <datalist id="Dimensionet">
                                    <option value="10cm"></option>
                                    <option value="15cm"></option>
                                    <option value="20cm"></option>
                                </datalist>
                            </div>
                            <div id="InputForma8" class="col-lg-8 col-md-8">
                                <input type="text" id="name" name="name" class="input-field" placeholder="Emaili" title="Ku mund t♪7 ju kontaktojmë">
                            </div>
                            <div id="InputForma9" class="col-lg-8 col-md-8">
                                <input type="email" id="email" name="email" class="input-field" placeholder="Adressa" title="Ku dëshironi tju sjellim produktin">
                            </div>
                            <div id="InputForma10" class="col-lg-8 col-md-8">
                                <input type="text" id="name" name="name" class="input-field" placeholder="Numri i Telefonit" title="Alternativa tjetër e kontaktit">
                            </div>
                            <div id="InputForma11" class="col-lg-12">
                            <button onclick="window.open('mailto:test@example.com?subject=subject&body=body');" class="btn btn-default standard-button red-button">Dergo Porosine</button>
                            </div>
                        </div>
                    </form> -->
        <!-- ************************************************************** -->

        <hr class="featurette-divider">

        <!-- Footer -->
        <footer id="footer">
            <div class="row">
                <div class="col-md-4 col-lg-4" style="text-align: left">
                    <p>Numri i Telefonit: (+386)49467209</p>
                    <p>Email adresa: kiku3dtoys@gmail.com</p>
                    <p>
                </div>
                <div class="col-md-4 col-lg-4">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p style="text-align:center">Copyright &copy; Kiku 3DLodra 2017</p>
                </div>

                <div class="col-md-4 col-lg-4" style="text-align: center">
                   <a href="https://www.facebook.com" target="_blank"><img src="facebook32x32.png"></a>
                    <a href="https://www.instagram.com" target="_blank"><img src="instagram32x32.png"></a>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- scroll i bute GHUPI:-->
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>



<!-- sllajderi script -->
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".single-item").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        
      });
    });
</script>

<!-- **************** -->

</body>

</html>