<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours en España (Task)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .tour {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
        }

        .tour img {
            max-width: 40%;
            height: auto;
            margin-right: 20px;
            border-radius: 5px;
        }

        .tour h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .tour p {
            margin: 0;
            color: #555;
        }

        .tour p.summary {
            font-style: italic;
        }

		.tour p strong {
            color: #333;
        }

        .tour p.location {
            font-weight: bold;
        }

        .tour p.price {
            font-weight: bold;
            color: #27ae60;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    // Conectar a la libreria de TourCMS en la carpeta
    require 'C:\xampp\htdocs\TourCMS API\TourCMS.php';

    // Inicio de sesion con las credenciales dadas en correo
    $marketplaceId = '126';
    $apiKey = '5aed2d3d69ea';
    $channelId = '0';
    $timeout = 120; // TTL

    // Inicializar la instancia de TourCMS
    $tourcms = new TourCMS\Utils\TourCMS($marketplaceId, $apiKey, 'simplexml', $timeout);

    // Configurar los parámetros de búsqueda
    $params = [
        'product_type' => 4 // Tours de día sin estancia nocturna
    ];

    $response = $tourcms->search_tours($params);

    // Verificar si hay tours disponibles
    if (isset($response->tour) && !empty($response->tour)) {
        // Mostrar solo tours en España
        foreach ($response->tour as $tour) {
            if ($tour->country == 'ES') {
                echo '<div class="tour">';
                // Mostrar imagen en miniatura si hay
                if (!empty($tour->thumbnail_image)) {
                    echo '<img src="' . htmlentities($tour->thumbnail_image) . '" alt="' . htmlentities($tour->tour_name) . '">';
                }
					echo '<div>';
					
						echo '<h3><a href="' . htmlentities($tour->tour_url) . '">' . htmlentities($tour->tour_name) . '</a></h3>';
						echo '<p class="summary">' . htmlentities($tour->summary) . '</p>';
						echo '<p><strong>Duración:</strong> ' . htmlentities($tour->duration_desc) . '</p>';
						echo '<p class="location"><strong>Ubicación:</strong> ' . htmlentities($tour->location) . '</p>';
						echo '<p class="price"><strong>Precio desde:</strong> ' . htmlentities($tour->from_price) . ' €</p>';
					echo '</div>';
					
                echo '</div>';
            }
        }
    } else {
        echo '<p>No se encontraron tours disponibles en España.</p>';
    }
    ?>
</div>
<!-- Derechos de autor: Alejandro Garcia Avivar -->
</body>
</html>
