<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Online munkaidő nyilvántartó rendszer</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap" rel="stylesheet">    
        <link rel="stylesheet" href="styles/style.css">
        <script type="text/javascript">

            var http;

            if (window.XMLHttpRequest) {

            http = new XMLHttpRequest();
            }
            else {

            http = new ActiveXObject("Microsoft.XMLHTTP");
            }

            function pageLoad(page) {
            var time = new Date().getTime();
            
            http.open("GET", "menu_" + page + ".php?time=" + time, true);
            
            http.onreadystatechange = function() {
                if(http.readyState == 4) {
                document.getElementById('content').innerHTML = http.responseText;
                }
            }
            
            http.send(null);
            }
        </script>    
    </head>

    <body>
        <div class="container">
            <div class="information">
                <div class="information-left">
                    <span>Online munkaidő nyilvántartó rendszer</span>
                </div>
                <div class="information-right">
                    <span>Lengyel Gábor</span>
                    <span style="padding: 0 1rem;"> - </span>
                    <span style="padding-right: 1rem;">Fiktív Kft.  </span>
                    <span>
                        <a href="dsadasd">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                        </a>
                    </span>
                </div>
            </div>