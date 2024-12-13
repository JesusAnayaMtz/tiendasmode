<?php 
session_start(); 
if (empty($_SESSION['usuario'])) header('Location: login.php');

$ruta = "../assets/images/promos/";
$arrPromGroups = array();
$iterator = new FilesystemIterator($ruta);
foreach($iterator as $entry) {
    $arrPromGroups[] = $entry->getFilename();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <title>MODE - Siempre Precios Bajos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        p {
            color: #173861;
        }
        h2 {
            color: #173861;
        }
        .bg-gradient {
            background: linear-gradient(180deg, #144a8d  0%, #081633 100%);
        }        
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        #backToTop {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        #backToTop.show {
            opacity: 1;
            visibility: visible;
        }
        #backToTop:hover {
            transform: translateY(-5px); /* Pequeño desplazamiento al hacer hover */
        }
        
        /* Estilos para el menú móvil */
        @media (max-width: 768px) {
            .mobile-menu {
                display: none;
            }
            .mobile-menu.active {
                display: block;
            }
            #banne-brands-m {
                display: block;
            }
        }
        .styleimgitem {
            border-radius: 1rem;
        }
        .item-menu:hover {
            border-bottom: 1px solid #80b8ff;
            color: rgb(0 76 172);
        }
        .quejabtn {
            background-color: #fff0f0;
        }
        .sugerenciabtn {
            background-color: #f0faff;
        }
        input[type="radio"]:checked + label span {
            --tw-border-opacity: 1;
            border-color: rgb(99 102 241 / var(--tw-border-opacity));
            --tw-bg-opacity: 1;
            background-color: rgb(99 102 241 / var(--tw-bg-opacity));
            --tw-shadow: inset 0 0px 0px 3.5px #E7E7FF;
            --tw-shadow-colored: inset 0 0px 0px 3.5px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }
        input[type="radio"] + label span {
            transition: background .2s, transform .2s;
        }
        .ps-3\.5 {
            -webkit-padding-start: .875rem;
            padding-inline-start: .875rem;
        }
        .start-0 {
            inset-inline-start: 0;
        }
        .ps-10 {
            -webkit-padding-start: 2.5rem;
            padding-inline-start: 2.5rem;
        }
        @media (min-width: 768px) {
            .md\:me-4 {
                -webkit-margin-end: 1rem;
                margin-inline-end: 1rem;
            }
        }
        .me-3 {
            -webkit-margin-end: .3rem;
            margin-inline-end: .3rem;
        }
        .bg-red-mode {
            --tw-bg-opacity: 1;
            background-color: rgb(166 43 43);
        }
        .-topend-2 {
            top: -.2rem;
            inset-inline-end: -.2rem;
        }
        .ease-in-out {
            transition-timing-function: cubic-bezier(.4,0,.2,1);
        }
        .duration-150 {
            transition-duration: .15s;
        }
        .w-m30 {
            width: 30rem;
        }
        .activebtn {
            color: rgb(255 255 255 / 1) !important;
            background-color: rgb(166 43 43) !important;
        }
        .inactivebtn {
            background-color: rgb(249 250 251 / 1) !important;
        }
        .inactivebtn:hover {
            color: rgb(17 24 39 / 1);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-8 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="../assets/images/logo.png" alt="Tiendas MODE Logo" title="Ya nos conoces! Siempre Precios Bajos" class="h-11 mr-4">
                </div>
                <div class="hidden md:block">
                    <p class=" text-3xl font-bold text-center ">Panel de Gestión de Contenido</p>
                </div>
                <div class="hidden md:flex items-center font-medium">
                    <a href="../index.php" class="text-gray-900 hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 mx-3 item-menu">Inicio</a>
                    <a href="../promociones/" class="text-gray-900 hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 mx-3 item-menu">Promociones</a>
                    <a href="../funciones.php?accion=logout" class="text-gray-900 hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 mx-3 item-menu">Cerrar Sesión</a>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-800 hover:text-blue-600">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <div id="mobile-menu" class="mobile-menu mt-4 md:hidden">
                <a href="../index.php" class="block text-gray-800 hover:text-blue-600 py-2">Inicio</a>
                <a href="../promociones/" class="block text-gray-800 hover:text-blue-600 py-2">Promociones</a>
                <a href="../funciones.php?accion=logout" class="block text-gray-800 hover:text-blue-600 py-2">Cerrar Sesión</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="bg-gradient py-3">
            <div class="container mx-auto">
                <div class="md:flex">
                    <ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                        <li>
                            <a href="#" class="inline-flex items-center px-3 py-3 activebtn rounded-lg w-full btnAction" aria-current="page" id="btnmainbanner">
                                <svg class="w-5 h-5 me-3 activebtn btnAction" id="iconmainbanner" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M15 4H9v16h6V4Zm2 16h3a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-3v16ZM4 4h3v16H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" clip-rule="evenodd"/>
                                </svg>
                                Main-Banner
                            </a>
                        </li>
                        <li>
                            <a href="#" class="inline-flex items-center px-3 py-3 rounded-lg inactivebtn w-full btnAction" id="btnpromotions">
                                <svg class="w-5 h-5 me-3 text-gray-500 inactivebtn btnAction" id="iconpromotion" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.597 3.2A1 1 0 0 0 7.04 4.289a3.49 3.49 0 0 1 .057 1.795 3.448 3.448 0 0 1-.84 1.575.999.999 0 0 0-.077.094c-.596.817-3.96 5.6-.941 10.762l.03.049a7.73 7.73 0 0 0 2.917 2.602 7.617 7.617 0 0 0 3.772.829 8.06 8.06 0 0 0 3.986-.975 8.185 8.185 0 0 0 3.04-2.864c1.301-2.2 1.184-4.556.588-6.441-.583-1.848-1.68-3.414-2.607-4.102a1 1 0 0 0-1.594.757c-.067 1.431-.363 2.551-.794 3.431-.222-2.407-1.127-4.196-2.224-5.524-1.147-1.39-2.564-2.3-3.323-2.788a8.487 8.487 0 0 1-.432-.287Z"/>
                                </svg>
                                Promociones
                            </a>
                        </li>
                    </ul>
                    <div class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full" id="mainbanner">
                        <button type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center me-2 mb-2 float-right inline-flex" data-drawer-target="drawer-upload-files" data-drawer-show="drawer-upload-files" aria-controls="drawer-upload-files">
                            <svg class="w-6 h-6 text-white me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"></path>
                            </svg>
                            Agregar Imagen
                        </button>

                        <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 float-right inline-flex items-center" id="delMainBanner" data-modal-target="popup-confirm" data-modal-toggle="popup-confirm" >
                            <svg class="w-6 h-6 text-white me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                            </svg>
                            Eliminar Seleccionadas
                        </button>


                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Banner de imágenes principal</h3>
                        <div class="container pt-4">
                            <h4 class="mb-2">Formato de imágen para versión web</h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-6" id="banner-web">
                                
                            </div>
                        </div>

                        <div class="container pt-4">
                            <h4 class="mb-2">Formato de imágen para versión movil</h2>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="banner-movil">
                                
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full hidden" id="promotions">
                        <button type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center me-2 mb-2 float-right inline-flex" data-drawer-target="drawer-upload-promo" data-drawer-show="drawer-upload-promo" aria-controls="drawer-upload-promo" id="btn-promotions">
                            <svg class="w-6 h-6 text-white me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"></path>
                            </svg>
                            Agregar Imagen
                        </button>

                        <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 float-right inline-flex items-center" id="delPromotional" data-modal-target="popup-confirm" data-modal-toggle="popup-confirm" >
                            <svg class="w-6 h-6 text-white me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                            </svg>
                            Eliminar Seleccionadas
                        </button>
                        
                        <form class="max-w-sm mb-2">
                            <label for="promolist" class="sr-only">Underline select</label>
                            <select id="promolist" class="block py-2.5 px-0 w-full text-lg font-semibold text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option value="" selected>&nbsp;Seleccione Grupo/Familia</option>
                                
                            </select>
                        </form>

                        <div class="container pt-4">
                            <h4 class="mb-2">Imagenes publicadas de promociones vigentes</h2>
                            <div class="grid grid-cols-6 md:grid-cols-6 gap-6" id="promotionals">
                                <span class="h-20"></span>
                            </div>
                        </div>
                    </div>

                    <!-- drawer component main banner -->
                    <div id="drawer-upload-files" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-m30 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="false">
                        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">

                            <svg class="w-6 h-6 text-gray-800 dark:text-white me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
                            </svg>                                  
                            <span id="drawer-title">Carga archivos BANNER PRINCIPAL</span>
                        </h5>
                        <button type="button" data-drawer-hide="drawer-upload-files" aria-controls="drawer-upload-files" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close menu</span>
                        </button>
                        
                        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Seleccione una o más imagenes para cargar. Se recomienda que tenga un tamaño de 1140px por 380px para el formato grande y de 675px por 450px para la versión móvil. Se recomienda usar el formato de imagen .jpg</p>
                        <p>Recuerda que por cada imagen en formato grande debes incluir una para versión móvil.</p>
                        <form class="max-w-lg mx-auto" id="form-up-mainbanner" enctype="multipart/form-data">
                            <div class="mt-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="inputmainban">Seleccione Archivos</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="inputmainban" type="file" accept="image/png, image/jpeg" required multiple>
                                <div id="fileListMainB" class="grid grid-cols-3 md:grid-cols-3 gap-2 mt-4"></div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-3">
                                <button type="button"  data-drawer-hide="drawer-upload-files" aria-controls="drawer-upload-files" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" id="cancel-uf-mainbanner">Cancelar</button>

                                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 flex" id="exec-uf-mainbanner">
                                    <svg class="w-6 h-6 text-white me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8"/>
                                    </svg>
                                    Subir Archivos
                                </button>
                            </div>
                            <div role="status" class="text-center" id="spinnerLoadMainBan" style="display: none;">
                                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </form>
                    </div>

                    <!-- drawer component promotional -->
                    <div id="drawer-upload-promo" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-m30 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="false">
                        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">

                            <svg class="w-6 h-6 text-gray-800 dark:text-white me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
                            </svg>                                  
                            <span id="drawer-title">Carga archivos de PROMOCIONES</span>
                        </h5>
                        <button type="button" data-drawer-hide="drawer-upload-promo" aria-controls="drawer-upload-promo" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close menu</span>
                        </button>
                        
                        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Seleccione una o más imagenes para cargar. Se recomienda que tenga un tamaño de 370px por 460px. Se recomienda usar el formato de imagen .jpg</p>
                        <form class="max-w-lg mx-auto" id="form-up-promotional" enctype="multipart/form-data">
                            <div class="mt-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="inputpromo">Seleccione Archivos</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="inputpromo" type="file" accept="image/png, image/jpeg" required multiple>
                                <div id="fileListPromo" class="grid grid-cols-3 md:grid-cols-3 gap-2 mt-4"></div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-3">
                                <button type="button" data-drawer-hide="drawer-upload-promo" aria-controls="drawer-upload-promo" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" id="cancel-uf-promotional">Cancelar</button>

                                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 flex" id="exec-uf-promotional">
                                    <svg class="w-6 h-6 text-white me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8"/>
                                    </svg>
                                    Subir Archivos
                                </button>
                            </div>
                            <div role="status" class="text-center" id="spinnerLoadPromo" style="display: none;">
                                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>

        
        <button data-modal-target="popup-notice" data-modal-toggle="popup-notice" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hidden" id="btnnotice" type="button">
        Toggle modal
        </button>

        <div id="popup-notice" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" aria-hidden="false">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-notice">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="msjnotice"></h3>
                    </div>
                </div>
            </div>
        </div>






        <div id="popup-confirm" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-confirm">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="textConfirm">¿Desea eliminar la imágen seleccionada?</h3>
                        <button data-modal-hide="popup-confirm" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center" id="execConfirm">Eliminar</button>
                        <button data-modal-hide="popup-confirm" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" id="cancelConfirm">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6">
            <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-center">
                <p class="text-white">&copy; 2024 Tiendas MODE. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <button id="backToTop" class="fixed bottom-8 right-8 bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none transition-all duration-300 opacity-0 invisible">
        <i class="fas fa-arrow-up" title="Ir arriba"></i>
    </button>
    <script>
        var imagesMainWeb = new Array("banner-1.jpg","banner-2.jpg","banner-3.jpg","banner-4.jpg","banner-5.jpg");
        var imagesMainMovil = new Array("banner-1movil.jpg","banner-2movil.jpg","banner-3movil.jpg","banner-4movil.jpg","banner-5movil.jpg");
        var conta = 0;
        var itemsRemove = new Array();
        var promotionalImages;
        const promoGroups = <?= json_encode($arrPromGroups) ?>;
        var eraseType = 'mainBanner';

        document.addEventListener('DOMContentLoaded', function () {
            const backToTopButton = getElement('#backToTop');
            const btnCancelUpMainBanner = getElement('#cancel-uf-mainbanner');
            const btnExecUpMainBanner = getElement('#form-up-mainbanner');
            const btnExecUpPromotional = getElement('#form-up-promotional');
            const inputMainBanner = getElement('#inputmainban');
            const inputPromotional = getElement('#inputpromo');
            const listMainBanner = getElement('#fileListMainB');
            const listPromotional = getElement('#fileListPromo');
            const btnDelMainBanner = getElement('#delMainBanner');
            const btnDelPromotional = getElement('#delPromotional');
            const btnMainBanner = getElement('#btnmainbanner');
            const btnPromotions = getElement('#btnpromotions');
            const mbtag = getElement('#mainbanner');
            const promtag = getElement('#promotions');
            const promListSel = getElement('#promolist');
            //var eraseType = 'mainBanner';

            const options = {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
                onHide: () => {
                    console.log('modal is hidden');
                },
                onShow: () => {
                    console.log('modal is shown');
                    checkSelectedItems();
                },
                onToggle: () => {
                    console.log('modal has been toggled');
                },
            };

            // instance options object
            const instanceOptions = {
                id: 'popup-confirm',
                override: true
            };

            btnCancelUpMainBanner.addEventListener('click', function(){
                getElement('#fileListMainB').innerHTML = '';
                getElement('#inputmainban').value = '';
            });

            btnExecUpMainBanner.addEventListener('submit', function(event){
                event.preventDefault();
                showHideLoader('#exec-uf-mainbanner', '#spinnerLoadMainBan', 1);
                let element = getElement('#alert-mainBanner'); 
                if (document.body.contains(element)) {
                    element.remove();
                }
                let formData = new FormData();
                var inputFiles = document.querySelectorAll("#inputmainban");
                if (inputFiles[0].files.length > 0) {
                    for (let i = 0; i < inputFiles[0].files.length; i++) {
                        formData.append(`archivo${i}`, inputFiles[0].files[i]);
                    }
                    fetch("../funciones.php?accion=fetchUploadImagesMainBanner", {
                        method: 'POST',
                        body: formData,
                    })
                    .then(responseData => responseData.json())
                    .then(response => {
                        if (response.success) {
                            displayImages('mainBanner',response.data);
                            cleanUploadPanel('fileListMainB','form-up-mainbanner');
                        }
                        getElement('#drawer-upload-files').insertAdjacentHTML('beforeend',messageDisplay(response.success,response.message,'alert-mainBanner'));
                    })
                    .catch(err => {
                        getElement('#drawer-upload-files').insertAdjacentHTML('beforeend',messageDisplay(false,'Error de conexión con el servidor.','alert-mainBanner'));
                        console.error("ERROR: ", err.message);
                    });
                } else {
                    alert("No se seleccionaron archivos para cargar.");
                }
                showHideLoader('#exec-uf-mainbanner', '#spinnerLoadMainBan', 2);
            });

            inputMainBanner.addEventListener('change', function(e) {
                let filest = this.files;
                let txtfile = '';
                for (let i = 0; i < filest.length; i++) {
                    txtfile += `<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">${filest[i].name}</span>`;
                }
                listMainBanner.innerHTML = txtfile;
            });

            btnDelMainBanner.addEventListener('click', function(){
                let element = document.getElementById("execConfirm");
                eraseType = 'mainBanner';
                element.setAttribute("onclick",'deleteMainBanner()'); 
                let targetEl = document.getElementById("popup-confirm");
                checkSelectedItems();
            });

            btnDelPromotional.addEventListener('click', function(){
                let element = document.getElementById("execConfirm");
                eraseType = 'promotional';
                element.setAttribute("onclick",'deletePromotional()'); 
                let targetEl = document.getElementById("popup-confirm");
                checkSelectedItems();
            });

            inputPromotional.addEventListener('change', function(e) {
                let filest = this.files;
                let txtfile = '';
                for (let i = 0; i < filest.length; i++) {
                    txtfile += `<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">${filest[i].name}</span>`;
                }
                listPromotional.innerHTML = txtfile;
            });

            btnPromotions.addEventListener('click', function(){
                if (mbtag.classList.contains('block')) {
                    mbtag.classList.remove("block");
                }
                mbtag.classList.add("hidden");
                if (promtag.classList.contains('hidden')) {
                    promtag.classList.remove("hidden");
                }
                promtag.classList.add("block");
                showHideBlock();
                getElement('#iconpromotion').classList.remove('inactivebtn');
                getElement('#btnpromotions').classList.remove('inactivebtn');
                getElement('#iconpromotion').classList.add("activebtn");
                getElement('#btnpromotions').classList.add("activebtn");

            });

            btnMainBanner.addEventListener('click', function(){
                if (promtag.classList.contains('block')) {
                    promtag.classList.remove("block");
                }
                promtag.classList.add("hidden");
                if (mbtag.classList.contains('hidden')) {
                    mbtag.classList.remove("hidden");
                }
                mbtag.classList.add("block");
                showHideBlock();
                getElement('#iconmainbanner').classList.remove('inactivebtn');
                getElement('#btnmainbanner').classList.remove('inactivebtn');
                getElement('#iconmainbanner').classList.add("activebtn");
                getElement('#btnmainbanner').classList.add("activebtn");
            });

            btnExecUpPromotional.addEventListener('submit', function(event){
                event.preventDefault();
                if (getElement('#promolist').value.length==0) { 
                    getElement('#drawer-upload-promo').insertAdjacentHTML('beforeend',messageDisplay(false,'Debe seleccionar el Grupo/Familia a donde se agregaran las imagenes <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>','alert-promotional'));
                    return false;
                }
                showHideLoader('#exec-uf-promotional', '#spinnerLoadPromo', 1);
                let element = getElement('#alert-promotional'); 
                if (document.body.contains(element)) {
                    element.remove();
                }
                let formData = new FormData();
                formData.append("category", getElement('#promolist').value); 
                var inputFiles = document.querySelectorAll("#inputpromo");
                if (inputFiles[0].files.length > 0) {
                    for (let i = 0; i < inputFiles[0].files.length; i++) {
                        formData.append(`archivo${i}`, inputFiles[0].files[i]);
                    }
                    fetch("../funciones.php?accion=fetchUploadImagesPromotional", {
                        method: 'POST',
                        body: formData,
                    })
                    .then(responseData => responseData.json())
                    .then(response => {
                        if (response.success) {
                            displayImages('promotional',response.data)
                            cleanUploadPanel('fileListPromo','form-up-promotional');
                        }
                        getElement('#drawer-upload-promo').insertAdjacentHTML('beforeend',messageDisplay(response.success,response.message,'alert-promotional'));
                    })
                    .catch(err => {
                        getElement('#drawer-upload-promo').insertAdjacentHTML('beforeend',messageDisplay(false,'Error de conexión con el servidor.','alert-promotional'));
                        console.error("ERROR: ", err.message);
                    });
                } else {
                    alert("No se seleccionaron archivos para cargar.");
                }
                showHideLoader('#exec-uf-promotional', '#spinnerLoadPromo', 2);
            });
            
            promListSel.addEventListener('change', function() {
                let selitem = getElement('#promolist').value;
                if (selitem.length > 0) {
                    datasend = Object();
                    datasend.category = selitem;
                    fetch("../funciones.php?accion=getPromotions", {
                        method: 'POST',
                        body: JSON.stringify(datasend),
                    })
                    .then(responseData => responseData.json())
                    .then(response => {
                        if (response.success) {
                            displayImages('promotions',response.data);
                        } else {
                            getElement('#msjnotice').innerHTML = '<span class="text-red-600">'+response.message+'</span>';
                        }
                    })
                    .catch(err => {
                        getElement('#msjnotice').innerHTML = '<span class="text-red-600">Error de conexión con el servidor</span>';
                        targetEl.click();
                        console.error("ERROR: ", err.message);
                    });

                }
            });

            getFilesMainBanner();
            loadPromotionalGroups();
        });

        function showHideLoader(tagbtn, tagspin, sh) {
            if (sh==1) {
                getElement(tagspin).style.display = 'block';
                getElement(tagbtn).setAttribute('disabled','disabled');
            } else {
                getElement(tagspin).style.display = 'none';
                getElement(tagbtn).removeAttribute("disabled");
            }
        }

        function showHideBlock() {
            let items = document.querySelectorAll('.btnAction');
            items.forEach(element => {
                if (element.classList.contains('activebtn')) {
                    element.classList.remove("activebtn");
                    element.classList.add("inactivebtn");
                }
            });
        }

        function loadPromotionalGroups() {
            let listPG = document.querySelector('#promolist');
            for (let clave in promoGroups) {
                var opt = document.createElement("option");
                opt.value = promoGroups[clave];
                opt.innerHTML = '&nbsp; Familia '+promoGroups[clave].charAt(0).toUpperCase() + promoGroups[clave].slice(1);
                listPG.append(opt);
            }
        }


        function getFilesMainBanner() {
            let formData = new FormData();
            fetch("../funciones.php?accion=fetchGetImagesMainBanner", {
                method: 'POST',
                body: formData,
            })
            .then(responseData => responseData.json())
            .then(response => {
                if (response.success) {
                    displayImages('mainBanner',response.data);
                } else {
                    alert(response.message);
                }
            })
            .catch(err => {
                getElement('#msjnotice').innerHTML = '<span class="text-red-600">Error de conexión con el servidor</span>';
                targetEl.click();
                console.error("ERROR: ", err.message);
            });
        }

        function showPromotionalImages() { 
            let conta = 0;
            var divp = getElement('#promotionals');
            divp.innerHTML = '';
            var htmlres = '';
            if (promotionalImages.length > 0) {
                promotionalImages.forEach(element => {
                    htmlres += loadImgPromotional(element,conta);
                    conta++;
                });
                divp.innerHTML = htmlres;
            }
        }

        var loadImgPromotional = (element,conta) => {
            let cadsplit = element.split('/');
            return `<div class="relative inline-flex shadow"><img class="h-auto max-w-full rounded-lg" src="../${element}" title="${cadsplit[3]}"><div data-tooltip-target="tooltip-light${conta}" data-tooltip-placement="left" data-tooltip-style="light" class="absolute inline-flex items-center justify-center w-8 h-8 text-xs font-bold text-white bg-white border-2 border-white rounded-full -topend-2 dark:border-gray-900 cursor-pointer"><input id="check${conta}" type="checkbox" value="${cadsplit[4]}" class="w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkDeletePromotional text-lg"></div><div id="tooltip-light${conta}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-red-700 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">Seleccione para eliminar<div class="tooltip-arrow" data-popper-arrow></div></div></div>`;
        }

        function showMainBannerImages() {
            let conta = 0;
            var divp = getElement('#banner-web');
            divp.innerHTML = '';
            var htmlres = '';
            if (imagesMainWeb.length > 0) {
                for (let index = 0; index < imagesMainWeb.length; index++) {
                    htmlres += loadImgMainBanner(imagesMainWeb[index],conta);
                    conta++;
                }
                divp.innerHTML = htmlres;
            }
            divp = getElement('#banner-movil');
            divp.innerHTML = '';
            htmlres = '';
            if (imagesMainMovil.length > 0) {
                for (let index = 0; index < imagesMainMovil.length; index++) {
                    htmlres += loadImgMainBanner(imagesMainMovil[index],conta);
                    conta++;
                }
                divp.innerHTML = htmlres;
            }
        }

        var loadImgMainBanner = (element,conta) => {
            return `<div class="relative inline-flex"><img class="h-auto max-w-full rounded-lg" src="../assets/images/main-banner/${element}" title="${element}"><div data-tooltip-target="tooltip-light${conta}" data-tooltip-placement="left" data-tooltip-style="light" class="absolute inline-flex items-center justify-center w-8 h-8 text-xs font-bold text-white bg-white border-2 border-white rounded-full -topend-2 dark:border-gray-900 cursor-pointer"><input id="check${conta}" type="checkbox" value="${element}" class="w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkDeleteMainBanner text-lg"></div><div id="tooltip-light${conta}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-red-700 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">Seleccione para eliminar<div class="tooltip-arrow" data-popper-arrow></div></div></div>`;
        }

        var messageDisplay = (status,message,typeUp) => {
            let element = document.getElementById(typeUp);
            if (document.body.contains(element)) {
                element.remove();
            }
            let color = (status)? 'green':'red';
            let titr = (status)? '¡Exito!':'¡Error!';
            return `<div id="${typeUp}" class="flex items-center mt-5 p-4 mb-4 text-${color}-800 border border-${color}-300 rounded-lg bg-${color}-50 dark:bg-gray-800 dark:text-${color}-400" role="alert"><svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg><span class="sr-only">Info</span><div class="ms-3 text-sm font-medium"><span class="font-medium">${titr}</span> <p id="txtrmainres">${message}</p></div><button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-${color}-50 text-${color}-500 rounded-lg focus:ring-2 focus:ring-${color}-400 p-1.5 hover:bg-${color}-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-${color}-400 dark:hover:bg-gray-700" data-dismiss-target="#${typeUp}" aria-label="Close" onclick="closeAlert('${typeUp}')"><span class="sr-only">Close</span><svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg></button></div>`;
        }

        function cleanUploadPanel(listf,formup) {
            document.getElementById(listf).innerHTML= '';
            document.getElementById(formup).reset();
        }

        function deleteMainBanner() {
            let cheks = document.querySelectorAll('.checkDeleteMainBanner');
            if(itemsRemove.length > 0) {
                executeAction('mainBanner');
            }
        }

        function deletePromotional() {
            let cheks = document.querySelectorAll('.checkDeletePromotional');
            if(itemsRemove.length > 0) {
                executeAction(getElement('#promolist').value); 
            }
        }

        function checkSelectedItems() { 
            itemsRemove = new Array();
            let elecc = (eraseType=='mainBanner')? '.checkDeleteMainBanner':'.checkDeletePromotional';
            let elements = document.querySelectorAll(elecc);
            elements.forEach(element => {
                if (element.checked) {
                    itemsRemove.push(element.value);
                }
            });
            if(itemsRemove.length > 0) {
                getElement('#execConfirm').style.display = '';
                getElement('#cancelConfirm').style.display = '';
                getElement('#textConfirm').innerHTML = '¿Desea eliminar las imagenes seleccionadas?';
            } else {
                getElement('#execConfirm').style.display = 'none';
                getElement('#textConfirm').innerHTML = 'No hay ninguna imagen seleccionada para eliminar!';
                getElement('#cancelConfirm').style.display = 'none';
            }
        }

        function closeAlert(element) {
            document.getElementById(element).remove();
        }

        function executeAction(tipdel) {
            datasend = Object();
            datasend.typedel = tipdel;
            datasend.elements = itemsRemove;
            let targetEl = document.getElementById("btnnotice");
            fetch("../funciones.php?accion=deleteImages", {
                method: 'POST',
                body: JSON.stringify(datasend),
            })
            .then(responseData => responseData.json())
            .then(response => {
                if (response.success) {
                    getElement('#msjnotice').innerHTML = '<span class="text-green-600">'+response.message+'</span>';
                    displayImages(tipdel,response.data);
                } else {
                    getElement('#msjnotice').innerHTML = '<span class="text-red-600">'+response.message+'</span>';
                }
                targetEl.click();
            })
            .catch(err => {
                getElement('#msjnotice').innerHTML = '<span class="text-red-600">Error de conexión con el servidor</span>';
                console.error("ERROR: ", err.message);
                targetEl.click();
            });
        }

        function displayImages(tipdel,dataRes) {
            if (tipdel=='mainBanner') {
                imagesMainWeb = dataRes['web'];
                imagesMainMovil = dataRes['movil'];
                showMainBannerImages();
            } else {
                promotionalImages = dataRes;
                showPromotionalImages();
            }
        }

        function getElement(tag) {
            if (tag.substr(0,1) == '#') {
                return document.getElementById(tag.substr(1));
            } else if (tag.substr(0,1) == '.') {
                return document.querySelectorAll(tag);
            }
            console.log('No se recibio nombre tag');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>