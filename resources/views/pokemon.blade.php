<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>20 Pokémon con cURL</title>
    
</head>
<body>

<h2>Lista de los primeros 20 Pokémon</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr>

<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pokeapi.co/api/v2/pokemon/?limit=20',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);

foreach ($data['results'] as $index => $pokemon) {
    $id = $index + 1;
    $nombre = ucwords(str_replace('-', ' ', $pokemon['name']));
    echo "<tr><td>$id</td><td>$nombre</td></tr>";
}
?>

</table>

</body>
</html>