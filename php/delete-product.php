<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xml = new DOMDocument();
    $xml->load('product-catalog.xml');

    $products = $xml->getElementsByTagName('product');
    foreach ($products as $product) {
        if ($product->getElementsByTagName('name')->item(0)->textContent == $_POST['name']) {
            $product->parentNode->removeChild($product);
            break;
        }
    }

    $xml->save('product-catalog.xml');
    header('Location: index.html');
    exit;
}
?>
