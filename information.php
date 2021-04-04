<?php
	require ('inc/auth_session.php');
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Online munkaidő nyilvántartó rendszer</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap" rel="stylesheet"> 
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/js.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
		<script src="js/bootstrap-datepicker.hu.min.js"></script>
		

        <link rel="stylesheet" href="styles/bootstrap-table.css"> 
        <link rel="stylesheet" href="styles/bootstrap-datepicker_min.css"> 
        <link rel="stylesheet" href="styles/style.css">
		
	</head>

    <body>
        <div class="container">
            <div class="information">
                <div class="information-left">
                    <span>Online munkaidő nyilvántartó rendszer</span>
                </div>
                <div class="information-right">
                    <span>
						<?php 
							echo $userinfo['lastname'] . ' ' . $userinfo['firstname'] . ' ';
							if ($userinfo['superuser']) {echo '(admin)';} 
						?>
					</span>
                    <span> - </span>
                    <span>Fiktív Kft.</span>
                    <span>
                        <a href="logout.php">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 -1.5 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                        </a>
                    </span>
                </div>
            </div>