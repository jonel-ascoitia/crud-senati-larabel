<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pokemon-card {
            transition: transform 0.2s;
        }
        .pokemon-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .pokemon-img {
            width: 150px;
            height: 150px;
            object-fit: contain;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-5 display-4 fw-bold text-primary">
        Pokédex – Los primeros 20 Pokémon
    </h1>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @php
            // Hacemos la petición directamente aquí (solo para ejemplo rápido)
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://pokeapi.co/api/v2/pokemon?limit=20',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
            ]);

            $response = curl_exec($curl);
            curl_close($curl);

            $data = json_decode($response);

            // Si hubo error en la API, mostramos mensaje
            if (!$data || !isset($data->results)) {
                echo '<div class="col-12"><div class="alert alert-danger">Error al cargar los Pokémon</div></div>';
            } else {
                foreach ($data->results as $index => $pokemon) {
                    // El ID del Pokémon se saca del final de la URL
                    $urlParts = explode('/', rtrim($pokemon->url, '/'));
                    $pokemonId = end($urlParts);

                    // Imagen oficial de PokeAPI
                    $image = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$pokemonId}.png";
        @endphp

        <div class="col">
            <div class="card pokemon-card h-100 text-center border-0 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-center">
                    <span class="text-muted small">Nº {{ str_pad($pokemonId, 3, '0', STR_PAD_LEFT) }}</span>
                    <img src="{{ $image }}" alt="{{ ucfirst($pokemon->name) }}" class="pokemon-img mx-auto my-3">
                    <h5 class="card-title text-capitalize fw-bold">{{ $pokemon->name }}</h5>
                </div>
            </div>
        </div>

        @php
                }
            }
        @endphp
    </div>

    <div class="text-center mt-5">
        <p class="text-muted">¿Quieres ver más? Solo cambia <code>limit=20</code> por <code>limit=100</code> o el número que quieras</p>
    </div>
</div>

</body>
</html>