<?php
$data = array(
    'titulo' => 'Álbum de Prueba',
    'fecha_lanzamiento' => '2024-01-01',
    'urlSpotify' => 'https://open.spotify.com/album/test',
    'artista_ids' => [1, 2] // Kanye West y T-Pain
);

$json = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/albumes');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response: $response\n";
