<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/style.css">
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <style>
        body{
            background-image : url("https://static.vecteezy.com/system/resources/previews/007/164/537/original/fingerprint-identity-sensor-data-protection-system-podium-hologram-blue-light-and-concept-free-vector.jpg")
        }
        .container_login{

        }
        .row_login{
            position: absolute; /* postulat de départ */
            top: 50%; left: 50%; /* à 50%/50% du parent référent */
            transform: translate(-50%, -50%);
            background-color: #f1f1f1;
            padding: 50px;
           
        }
        h2{
            text-align: center;
            color : #000000;
            
        }
        
    </style>

    
    <div class="container_login">
        <div class="row_login">
            <h2>Connexion</h2><br>
            <?php $this->partial("form", $form, $formErrors); ?>

        </div>
    
        
             
    </div>

    
</body>
</html>