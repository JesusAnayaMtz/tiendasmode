<?php 
    session_start(); 
    if (!empty($_SESSION['usuario'])) header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="promociones, cerveza, modelhogar, mode, cordoba veracruz"/>
    <meta name="description" content="Depositos mode de venta de cerveza, refrescos, vinos y licores del centro de veracruz, siempre precios bajos"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <title>MODE - Siempre Precios Bajos</title>
    <link href="../assets/css/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="../assets/css/flowbite.min.css"  rel="stylesheet" />
    <script src="../assets/js/flowbite.min.js"></script>
    <style>
        .bg-gradient-blue {
            background: linear-gradient(180deg, #144a8d  0%, #081633 100%);
        }
        .m-0-auto {
            margin: 0 auto;
        }

        .text {
            font-size:38px;
            font-family:helvetica;
            font-weight:bold;
            color: #0070ff;
            text-transform:uppercase;
        }
        hr {
            height: 7px;
            width: 100%;
            margin-bottom: 6px;
        }
        .hrblue {
            background-color: #0070ff;
        }
        .hrgreen {
            background-color: #3bff00;
        }
        .hrred {
            background-color: #ff0000;
        }
        .parpadea {
            animation-name: parpadeo;
            animation-duration: 1s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;

            -webkit-animation-name:parpadeo;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: linear;
            -webkit-animation-iteration-count: infinite;
        }
        @-moz-keyframes parpadeo {
            0% { opacity: 1.0; }
            50% { opacity: 0.0; }
            100% { opacity: 1.0; }
        }
        @-webkit-keyframes parpadeo {  
            0% { opacity: 1.0; }
            50% { opacity: 0.0; }
            100% { opacity: 1.0; }
        }

        @keyframes parpadeo {  
            0% { opacity: 1.0; }
            50% { opacity: 0.0; }
            100% { opacity: 1.0; }
        }
    </style>
</head>
<body class="bg-gradient-blue">
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <a href="https://modetiendas.mx/" class="flex items-center mt-6">
                    <img class="h-20 m-0-auto" src="../assets/images/logo.png" alt="logo">    
                </a>
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Identifíquese para acceder
                    </h1>
                    <form class="space-y-4 md:space-y-6" id="loginForm" action="#">
                        <div>
                            <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario</label>
                            <input type="text" name="user" id="user" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required="" autocomplete="off">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" autocomplete="off" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <span class="text-red-600" id="txtError"></span>
                        <div class="flex items-center text-center">
                            
                            <button type="submit" class="m-0-auto w-3/4 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Ingresar</button>
                        </div>
                        <p class="text-sm pt-2 font-light text-gray-500 dark:text-gray-400">
                            Representaciones HGP S.A. de C.V. 
                        </p>
                    </form>
                </div>
                <span class="parpadea"><hr id="hranimate" class="hrblue"></span>
            </div>
            
        </div>
    </section>
    <script>
        document.getElementById('loginForm').addEventListener('submit', processLoginAction);

        function processLoginAction(event) {
            event.preventDefault();
            let hrel = document.getElementById('hranimate');
            hrel.className = 'hrgreen';
            const formData = new FormData(event.target);
            const datos = new URLSearchParams(formData);
            var msjresp = document.getElementById('txtError');
            msjresp.innerHTML = '';

            fetch("../funciones.php?accion=login", {
                method: 'POST',
                body: datos,
            })
            .then(responseData => responseData.json())
            .then(response => {
                //event.target.reset();
                if (response.success) {
                    setTimeout(function() {
                        window.location.replace("https://"+window.location.hostname+"/adminpanel/");
                    },1000);
                } else {
                    hrel.className = 'hrred';
                    msjresp.innerHTML = response.message;
                }
            })
            .catch(err => {
                hrel.className = 'hrred';
                msjresp.innerHTML = 'Error de conexión con el servidor';
                console.error("ERROR: ", err.message)
            });
        }
    </script>
</body>
</html>