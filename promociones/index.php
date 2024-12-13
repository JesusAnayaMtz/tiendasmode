<?php 
$arrFilesProm = array();
$arrTagBtn = array();
$ruta = "../assets/images/promos/";
$iterator = new FilesystemIterator($ruta);
$dir = '';
foreach($iterator as $entry) {
    $arrFilesProm[$entry->getFilename()] = array();
    $dir = $entry->getFilename();
    $iteratord = new FilesystemIterator($ruta.$dir);
    foreach($iteratord as $files) {
        $arrFilesProm[$dir][] = $files->getFilename();
    }
}

$ruta = "../assets/images/grid-promos/";
$iterator = new FilesystemIterator($ruta);
foreach($iterator as $entry) {
    $nfile = explode('.',substr($entry->getFilename(),1));
    $arrTagBtn[$nfile[0]] = $entry->getFilename();
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
    <link href="../assets/css/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @media (max-width: 768px) {
            .mobile-menu {
                display: none;
            }
            .mobile-menu.active {
                display: block;
            }
            #promos-content {
                grid-template-columns: repeat(2, minmax(0, 1fr)) ;
            }
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.9);
        }
        .modal-content {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .close {
            color: white;
            position: absolute;
            text-shadow: black 0px 5px;
            right: 25px;
            font-size: 45px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1010;
        }
        .bg-grid {
            background-color: rgb(127 166 215);
        }
        .bg-grid:hover {
            background-color: #00356c;
        }
        .blue-mode {
            color: rgb(23 56 97);
        }
        .text-blue-b {
            color: rgb(0 70 225);
        }

        /* CSS Code */
        .swiper-wrapper {
            width: 100%;
            height: max-content !important;
            padding-bottom: 64px !important;
            -webkit-transition-timing-function: linear !important;
            transition-timing-function: linear !important;
            position: relative;
        }
        .swiper-pagination-bullet {
            background: #4f46e5;
        }
        .rounded-s1 {
            border-radius: 2rem 2rem 0rem 0rem;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="../assets/images/logo.png" title="Ya nos conoces! Siempre Precios Bajos" alt="ModelHogar Logo" class="h-8 mr-2 sm:h-11 sm:mr-4 redirtohome">
                </div>
                <div class="hidden md:block">
                    <p class="text-xl sm:text-3xl font-bold text-center" style="color: #173861;">¡Siempre Precios Bajos!</p>
                </div>
                <div>
                    <button id="mobile-menu-button" class="blue-mode hover:text-blue-b redirtohome" onclick="window.location.replace('../index.php')">
                        <i class="fa-solid fa-house-chimney text-3xl" title="Ver Nuestra Página Principal"></i>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-4 sm:py-8">
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="grid-content">
        </div>

        <div class="section">
            <div class="grid grid-cols-5 md:grid-cols-5 sm:grid-cols-2 grid-auto-columns-1/3 h-full py-2" id="ent">

            </div>
        </div>
        
    </main>

    <!-- NUEVO MODAL PROMOCIONAL -->
    <div id="modal-promo" class="modal">
        <span class="close text-xl" onclick="closeModal()">&times;</span>
        <div class="modal-content content overflow-scroll">
            <div class="section h-full mt-8">
                <div class="grid grid-cols-6 md:grid-cols-6 sm:grid-cols-2 grid-auto-columns-1/3 py-6" id="promos-content">

                </div>
            </div>
            
        </div>
    </div>

    <!--JAVASCRIPT CODE-->
    <script>
        const gridsPromos = <?= json_encode($arrTagBtn) ?>;
        const imagesPromos = <?= json_encode($arrFilesProm) ?>;;
        const gridContent = document.querySelector('#grid-content');
        const slideContent = document.querySelector('#promos-content');
        const redirtohome = document.querySelector('.redirtohome');

        document.addEventListener('DOMContentLoaded', function () {
            redirtohome.addEventListener('click', () => {
                location.href="../index.php";
            });
            deployPromoGrids();
        });

        function openModal(promotag) {
            let promos = imagesPromos[promotag];
            if (promos.length > 0) {
                slideContent.innerHTML ='';
                promos.forEach(image => {
                    let img = document.createElement("img");
                    let divC = document.createElement("div");
                    img.classList.add("w-full","rounded-lg","object-cover" ); 
                    
                    divC.classList.add("relative","m-3","shadow-lg");
                    img.setAttribute("src",`../assets/images/promos/${promotag}/${image}`);
                    img.setAttribute("width","275");
                    divC.append(img);
                    slideContent.append(divC);
                });
                showModal();
            }
        }

        function deployPromoGrids() {
            for (let clave in gridsPromos){
                var divC = document.createElement("div");
                let img = document.createElement("img");
                divC.classList.add("bg-grid","p-2","sm:p-4", "rounded-lg", "shadow-md");
                img.classList.add("w-full","h-32", "sm:h-48", "object-cover", "rounded", "cursor-pointer","promo-image");
                img.setAttribute("src","../assets/images/grid-promos/"+gridsPromos[clave]);
                img.setAttribute("onclick",`openModal("${clave}")`);
                img.setAttribute("title",`Nuestras Promociones en ${clave}`);
                divC.append(img);
                gridContent.append(divC);
            }
        }

        function initScriptCarousel() {
            var swiper = new Swiper(".default-carousel", {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                el: ".swiper-pagination",
                clickable: true,
                },
                navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
                },
            });
        }

        function closeModal() {
            document.getElementById("modal-promo").style.display = "none";
        }

        function showModal() {
            document.getElementById("modal-promo").style.display = "flex";
        }
    </script>
</body>
</html>