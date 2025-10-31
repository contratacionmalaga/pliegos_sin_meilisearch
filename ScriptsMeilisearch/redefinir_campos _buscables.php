/**
 * Using `meilisearch-php` with the Guzzle HTTP client, in the command line:
 *   composer require meilisearch/meilisearch-php \
 *     guzzlehttp/guzzle \
 *     http-interop/http-factory-guzzle:^1.0
 */

/**
 * In your PHP file:
 */
<?php

require_once __DIR__ . '/vendor/autoload.php';

use MeiliSearch\Client;

$client = new Client('http://172.26.3.122:7700', '9e1b0a104ad235f5f33029b562e16833c23eca96c4a57a7f74732f83f61451b2');
/*$client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));*/

$index = $client->index('Anuncios');
$index->updateSearchableAttributes(['contract_folder_id', 'publication_media_name']);

echo "✅ Campos buscables actualizados correctamente.\n";

print_r($index->getSearchableAttributes());

