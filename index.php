<?php 
$arrMainBanner = array();
$ruta = "assets/images/main-banner/";
$iterator = new FilesystemIterator($ruta);
$dir = '';
foreach($iterator as $entry) {
    if (strpos($entry->getFilename(), 'movil') === false) {
        $arrMainBanner[$entry->getFilename()] = array($entry->getFilename());
        $dir = $entry->getFilename();
    } else {
        $arrMainBanner[$dir][] = $entry->getFilename();
    }
}
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
    <link href="assets/css/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <style>
        /* para el carrusel principal */
        swiper-container {
            width: 100%;
            height: 100%;
        }
        swiper-slide {
            background-position: center;
            background-size: cover;
        }
        swiper-slide img {
            display: block;
            width: 100%;
        }

        /* Inicia seccion de style para el carrusel de productos */
        .product-swiper {
            width: 100%;
            height: 300px;
            margin-bottom: 1rem;
        }
        .product-swiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .product-swiper .swiper-pagination-bullet {
            background: #173861;
        }
        .product-swiper .swiper-button-next,
        .product-swiper .swiper-button-prev {
            color: #173861;
            background: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
        .product-swiper .swiper-button-next:after,
        .product-swiper .swiper-button-prev:after {
            font-size: 1rem;
        }
        .product-card {
            background: #f8f9fa;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        /*Finaliza seccion de carrusel de productos*/
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
        .ps-2\.3 {
            -webkit-padding-start: 2.3rem;
            padding-inline-start: 2.3rem;
        }
        .w-25 {
            width: 25rem;
        }
        .end-2\.5 {
            inset-inline-end: .625rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-8 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="./assets/images/logo.png" alt="Tiendas MODE Logo" title="Ya nos conoces! Siempre Precios Bajos" class="h-11 mr-4">
                </div>
                <div class="hidden md:block">
                    <p class=" text-3xl font-bold text-center ">Bienvenido a Tiendas MODE</p>
                </div>
                <div class="hidden md:flex items-center font-medium">
                    <a href="#" class="text-gray-900 hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 mx-3 item-menu">Inicio</a>
                    <a href="#productos" class="text-gray-900 hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 mx-3 item-menu">Nuestros Productos</a>
                    <a href="promociones.php" class="text-gray-900 hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 mx-3 item-menu">Promociones</a>
                    <a href="#nosotros" class="text-gray-900 hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 mx-3 item-menu">Nosotros</a>
                    <a href="#contacto" class="text-gray-900 hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 mx-3 item-menu">Contacto</a>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-800 hover:text-blue-600">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <div id="mobile-menu" class="mobile-menu mt-4 md:hidden">
                <a href="#" class="block text-gray-800 hover:text-blue-600 py-2">Inicio</a>
                <a href="#productos" class="block text-gray-800 hover:text-blue-600 py-2">Nuestros Productos</a>
                <a href="promociones.html" class="block text-gray-800 hover:text-blue-600 py-2">Promociones</a>
                <a href="#nosotros" class="block text-gray-800 hover:text-blue-600 py-2">Nosotros</a>
                <a href="#contacto" class="block text-gray-800 hover:text-blue-600 py-2">Contacto</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="bg-gradient py-3">
            <div class="container mx-auto">
                <swiper-container class="mySwiper main-carousel" autoplay="true" pagination="true" pagination-clickable="true" space-between="30" effect="fade" id="main-banner">
                </swiper-container>
            </div>
        </section>
        <section>
            <div class="my-4 mx-2 p-4 w-90" style="filter: drop-shadow(8px 9px 6px gray);">
                <picture>
                    <source media="(min-width: 641px)" srcset="assets/images/banderilla-blue.png 2x">
                    <source media="(max-width: 640px)" srcset="assets/images/banderilla-blue-m.png 2x">
                    <img src="assets/images/banderilla-blue.png" alt="Hersheys-Pos1-P11-2024-Promociones" title="MODE Promociones 2024" class="styleimgitem w-full">
                </picture>
            </div>
        </section>
        <section id="productos" class="bg-white py-8">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-8">Nuestros Productos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Producto 1: Cervezas y Licores -->
                    <div class="product-card p-4">
                        <div class="swiper product-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/cerveza/corona.png" alt="Corona">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/cerveza/megas.png" alt="Victoria">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/cerveza/latas.jpg" alt="Modelo">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <h3 class="text-xl text-center font-semibold mb-2">Cervezas y Licores</h3>
                        <p class="text-gray-600 text-center">De la mejor compañia cervecera ABInBev, tenemos para ti Corona,
                            Victoria, Modelo Especial, Negra Modelo en sus diferentes presentaciones.</p>
                    </div>
        
                    <!-- Producto 2: Aguas y Refrescos -->
                    <div class="product-card p-4">
                        <div class="swiper product-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/refrescos/coca.jpeg" alt="Refrescos">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/refrescos/pepsi.jpg" alt="Coca Cola">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/refrescos/agua.png" alt="Agua">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <h3 class="text-xl text-center font-semibold mb-2">Aguas Y Refrescos</h3>
                        <p class="text-gray-600 text-center">Agua de las marcas E-Pura, Nestle, Ciel, asi como tambien refrescos
                            Coca-Cola, Pepsi-Cola, Garci-Crespo entre otros.</p>
                    </div>
        
                    <!-- Producto 3: Dulces y Botanas -->
                    <div class="product-card p-4">
                        <div class="swiper product-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/botanas/chidas.jpg" alt="Galletas">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/botanas/sabritas1.jpg" alt="Sabritas">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/botanas/barcel.jpg" alt="Dulces">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <h3 class="text-xl text-center font-semibold mb-2">Dulces Y Botanas</h3>
                        <p class="text-gray-600 text-center">Dulces y Botanas de Sabritas, Barcel, Gamesa, Marinela, Bimbo entre
                            otros.</p>
                    </div>
        
                    <!-- Producto 4: Nuevo - Abarrotes -->
                    <div class="product-card p-4">
                        <div class="swiper product-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/abarrrotes/lala.jpg" alt="Abarrotes">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/abarrrotes/bimbo.jpg" alt="Despensa">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/images/productosbanner/abarrrotes/marinela.jpg" alt="Productos">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <h3 class="text-xl text-center font-semibold mb-2">Abarrotes</h3>
                        <p class="text-gray-600 text-center">Gran variedad de productos básicos para tu despensa, incluyendo
                            alimentos enlatados, granos, aceites y más.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="nosotros" class="bg-gradient py-8">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-8 text-white text-shadow">Nosotros</h2>
                <div class="bg-white rounded-lg shadow-xl p-4">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-800 text-center">Representaciones H.G.P., S.A. de C.V.</h3>
                    <div class="space-y-8 text-center text-lg">
                        <p>Es una empresa que se dedica a la compra-venta de cerveza, de las marcas Corona, Victoria, Modelo
                            y Montejo entre otros productos, siendo nuestro objetivo principal, el de posicionar el
                            producto en el gusto del consumidor, y regular su precio de venta en el mercado.</p>
                        <p>La empresa forma parte del Grupo H.G.P., funcionando a su vez como un satélite de "Casa García, S.A.
                            de C.V.", la cual es un distribuidor independiente del Grupo Modelo de México, en la zona centro del
                            estado de Veracruz.</p>
                        <p>Con la finalidad de hacer más rentable el negocio se fueron adhiriendo productos afines con la imagen
                            de las tiendas, tales como refrescos, botanas, cigarros, abarrotes, jugos, leches, desechables,
                            galletas etc.; así como también Recargas Electrónicas y Pago de Servicios.</p>
                        <p>En la actualidad, operamos a través de más de 80 puntos de venta, los cuales están situados en la ciudad de Córdoba y otros 8 municipios que son
                            Monte Blanco, Fortín, Amatlan, Cuitlahuac, Potrero Nuevo, Paso del Macho, Omealca y Coscomatepec;
                            obteniendo una posición relevante en nuestro segmento de mercado en la región, convirtiéndonos en
                            los líderes de la zona.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="contacto" class="bg-gray-100 py-8">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Contacto</h2>
                <div class="flex flex-wrap -mx-4">
                    <!-- Formulario de contacto -->
                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0 mx-auto">
                        <form id="contactForm" class="bg-white rounded-lg shadow-xl p-8">
                            <!-- Selector de tipo de formulario -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Tipo de Contacto
                                </label>
                                <div class="grid sm:grid-cols-3 gap-2">
                                    <div class="block">
                                        <input type="radio" id="tipoContactoS" name="tipoContacto" value="sugerencia" class="hidden checked:bg-no-repeat checked:bg-center checked:border-indigo-500 checked:bg-indigo-100" checked>
                                        <label for="tipoContactoS" class="flex flex-row-reverse p-3 block w-full bg-white border border-gray-200 rounded-md text-base font-normal sugerenciabtn">
                                        <span class="border border-gray-300  rounded-full mr-2 w-5 h-5 mt-0.5 ml-auto"></span>
                                        <h5 class="text-gray-500">Sugerencias</h5>
                                        </label>
                                    </div>
                                    <div class="block">
                                        <input type="radio" id="tipoContactoQ" name="tipoContacto" value="queja" class="hidden checked:bg-no-repeat checked:bg-center checked:border-indigo-500 checked:bg-indigo-100">
                                        <label for="tipoContactoQ" class="flex flex-row-reverse p-3 block w-full bg-white border border-gray-200 rounded-md text-base font-normal quejabtn">
                                        <span class="border border-gray-300 rounded-full mr-2 w-5 h-5 mt-0.5 ml-auto"></span>
                                        <h5 class="text-gray-500">Quejas</h5>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Contenedor para el formulario dinámico -->
                            <div id="formularioDinamico"></div>

                            <div class="flex items-center justify-center">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Enviar
                                </button>
                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"></button>
                            </div>
                        </form>
                    </div>
                    <!-- Mapa y datos de contacto -->
                    <div class="w-full md:w-1/2 px-4">
                        <div class="bg-white rounded-lg shadow-xl p-8 h-full">
                            <div class="mb-6">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15100.820247529491!2d-96.9195014!3d18.8779819!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c4eff8f6795289%3A0x2d13b00e7e5128a3!2sRepresentaciones%20HGP!5e0!3m2!1ses-419!2smx!4v1728876901883!5m2!1ses-419!2smx"
                                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                            <div class="text-gray-700">
                                <p class="mb-2"><strong>Correo:</strong> contactoclientes@modetiendas.mx</p>
                                <p class="mb-2"><strong>Teléfono:</strong> 271.71.29090 / 271.71.24050 / 271.71.21908</p>
                                <p class="mb-2"><strong>Dirección:</strong> Carretera Estatal Córdoba-Veracruz Km. 340, Colonia
                                    Zona Industrial, Código Postal 94690, Municipio Córdoba, Estado Veracruz, México</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    
        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal" onclick="almodal.toggle()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-red-400 w-12 h-12 dark:text-red-200 hidden" id="errormsj" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>

                        <svg class="mx-auto mb-4 text-green-400 w-12 h-12 dark:text-green-200 hidden" id="okmsj" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="responseReport"></h3>
                    </div>
                </div>
            </div>
        </div>
    
    </main>
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-3">Tiendas MODE</h3>
                    <p class="text-white">Siempre Precios Bajos</p>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h4 class="text-lg font-semibold mb-3">Enlaces Rápidos</h4>
                    <ul>
                        <li><a href="#" class="hover:text-blue-400">Inicio</a></li>
                        <li><a href="#productos" class="hover:text-blue-400">Productos</a></li>
                        <li><a href="promociones.php" class="hover:text-blue-400">Promociones</a></li>
                        <li><a href="#nosotros" class="hover:text-blue-400">Nosotros</a></li>
                        <li><a href="#contacto" class="hover:text-blue-400">Contacto</a></li>
                        <li><a href="aviso-privacidad-clientes.html" class="hover:text-blue-400">Aviso de Privacidad</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h4 class="text-lg font-semibold mb-3">Contacto</h4>
                    <p class="text-white">Email: contacto@modetiendas.mx</p>
                    <p class="text-white">Teléfono: (271) 71-2-90-90/71-2-40-50</p>
                </div>
                <div class="w-full md:w-1/4">
                    <h4 class="text-lg font-semibold mb-3">Síguenos</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-blue-400"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-blue-400"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-center">
                <p class="text-white">&copy; 2024 Tiendas MODE. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <button id="backToTop" class="fixed bottom-8 right-8 bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none transition-all duration-300 opacity-0 invisible">
        <i class="fas fa-arrow-up" title="Ir arriba"></i>
    </button>
    <script src="assets/js/flowbite.min.js"></script>
    <script>
        const imagesPromos = <?= json_encode($arrMainBanner) ?>;
        var tiporep = 1;
        var almodal;
        document.addEventListener('DOMContentLoaded', function () {
            const backToTopButton = document.getElementById('backToTop');
            const mainCarousel = document.getElementById('main-banner');
            
            let currentIndex = 0;
            let interval;

            mainCarousel.innerHTML = "";
            for (let clave in imagesPromos){
                let swiplide = document.createElement("swiper-slide");
                let pic = document.createElement("picture");
                let source1 = document.createElement("source");
                let source2 = document.createElement("source");
                let img = document.createElement("img");
                source1.setAttribute("media","(min-width: 641px)");
                source1.setAttribute("srcset",`assets/images/main-banner/${imagesPromos[clave][0]} 2x`);
                source2.setAttribute("media","(max-width: 640px)");
                source2.setAttribute("srcset",`assets/images/main-banner/${imagesPromos[clave][1]} 2x`);
                img.setAttribute("src",`assets/images/main-banner/${imagesPromos[clave][0]} 2x`);
                img.setAttribute("class","styleimgitem");
                img.setAttribute("title","MODE Promociones 2024");
                pic.append(source1);
                pic.append(source2);
                pic.append(img);
                swiplide.append(pic);
                mainCarousel.append(swiplide);
            }

            //Constante para el carrusel de productos
            const productSwipers = document.querySelectorAll('.product-swiper');

            productSwipers.forEach(element => {
                new Swiper(element, {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: element.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    navigation: {
                        nextEl: element.querySelector('.swiper-button-next'),
                        prevEl: element.querySelector('.swiper-button-prev'),
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                });
            });

            // Código para el menú móvil
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
            });

            window.addEventListener('scroll', function () {
                // Mostrar el botón cuando se ha hecho scroll hacia abajo (más de 100px)
                if (window.scrollY > 80) {
                    backToTopButton.classList.add('show');
                } else {
                    backToTopButton.classList.remove('show');
                }
            });

            // Animar el scroll hacia el inicio
            backToTopButton.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            // Eventos para el manejo del formulario
            document.getElementById('tipoContactoQ').addEventListener('change', actualizarFormulario);
            document.getElementById('tipoContactoS').addEventListener('change', actualizarFormulario);
            document.getElementById('contactForm').addEventListener('submit', manejarEnvio);
        });
        
        // Texto de prueba para tiendas
        const tiendas = [
            'MT La Once - Av 11, C. 12. ',
            'MT San Jose - Av 9, C. 10',
            'MT Bella Vista - Av 13, C 6',
            'MT Alameda - Av 11, C. 2',
        ];

        // Platilla del formulario para quejas
        const formularioQuejas = `
           <div class="mb-4">
                <label for="tienda-rep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tienda</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z"/>
                        </svg>
                    </div>
                    <select id="tienda-rep" name="tienda-rep" class="ps-2.3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Seleccione una tienda</option>
                        <optgroup label="Cordoba">
                            ${tiendas.map(tienda => `<option value="${tienda}">${tienda}</option>`).join('')}
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="fecha-rep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha del suceso</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker id="fecha-rep" name="fecha-rep" autocomplete="off" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Seleccione Fecha del suceso">
                </div>
            </div>
            <div class="mb-4">
                <label for="hora-rep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora del suceso</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <input type="time" id="hora-rep" name="hora-rep" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="nombre-rep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="nombre-rep" name="nombre-rep" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Su nombre" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="tel-rep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z"/>
                        </svg>
                    </div>
                    <input type="text" id="tel-rep" name="tel-rep" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Teléfono para seguimiento" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Queja</label>
                <textarea id="message" name="message-rep" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Describa la situación o suceso" required></textarea>
            </div>
        `;

        // Plantilla del formulario de sugerencias
        const formularioSugerencias = `
            <div class="mb-4">
                <label for="nombre-rep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="nombre-rep" name="nombre-rep" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Su nombre" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="email-rep" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email de contacto</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                        </svg>
                    </div>
                    <input type="email" id="email-rep" name="email-rep" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="direccion@dominio.com">
                </div>
            </div>
            <div class="mb-4">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sugerencias</label>
                <textarea id="message" name="message-rep" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Sus comentarios y sugerencias nos ayudan a mejorar" required></textarea>
            </div>
        `;

        // Función para actualizar el formulario segun sea la queja o sugerencia seleccionada por el cliente
        function actualizarFormulario() {
            let tipoContacto = document.querySelector('input[name="tipoContacto"]:checked').value; 
            let formularioDinamico = document.getElementById('formularioDinamico');

            formularioDinamico.innerHTML = tipoContacto === 'queja' ? formularioQuejas : formularioSugerencias;
            if (tipoContacto === 'queja') {
                tiporep = 2;
                const datepickerEl = document.getElementById('fecha-rep');
                new Datepicker(datepickerEl, {
                    languaje: 'es',
                    format: 'dd/mm/yyyy',
                });
            } else {
                tiporep = 1;
            }
        }

        // Función para el envio del formulario
        function manejarEnvio(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const datos = new URLSearchParams(formData);

            fetch("funciones.php?accion=sendReport", {
                method: 'POST',
                body: datos,
            })
            .then(responseData => responseData.json())
            .then(response => {
                if (response.success) {
                    event.target.reset();
                } 
                console.log(response.message);
                displayResponse(response.success);
            })
            .catch(err => {
                console.error("ERROR: ", err.message)
            });
        }

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
            },
            onToggle: () => {
                console.log('modal has been toggled');
            },
        };

        // instance options object
        const instanceOptions = {
            id: 'popup-modal',
            override: true
        };

        function displayResponse(status) {
            let targetEl = document.getElementById("popup-modal");
            let txtres = (tiporep==1)? 'Gracias. Sus comentarios son muy importantes para nosotros.':'Gracias. Le daremos seguimiento a su reporte y nos pondremos en contacto con usted.';
            let elementError = document.getElementById("errormsj");
            let elementOk = document.getElementById("okmsj");
            if (status) {
                if (elementError.classList.contains('block')) {
                    elementError.classList.remove("block");
                }
                if (elementOk.classList.contains('hidden')) {
                    elementOk.classList.remove("hidden");
                }
                elementError.classList.add("hidden");
                elementOk.classList.add("block");
                document.getElementById("responseReport").innerHTML = txtres;
            } else {
                if (elementOk.classList.contains('block')) {
                    elementOk.classList.remove("block");
                }
                if (elementError.classList.contains('hidden')) {
                    elementError.classList.remove("hidden");
                }
                elementOk.classList.add("hidden");
                elementError.classList.add("block");
                document.getElementById("responseReport").innerHTML = "Ocurrio un error. El servicio no esta disponible por el momento. Intente nuevamente o comuniquese a nuestras oficinas.";
            }
            almodal = new Modal(targetEl, options, instanceOptions);
            almodal.toggle();
        }

        // Inicializar el formulario
        actualizarFormulario();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/js/pagedone.js"></script>
</body>
</html>