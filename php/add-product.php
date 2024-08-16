<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xml = new DOMDocument();
    $xml->load('product-catalog.xml');

    $root = $xml->getElementsByTagName('catalog')->item(0);

    $product = $xml->createElement('product');

    $name = $xml->createElement('name', $_POST['name']);
    $product->appendChild($name);

    $description = $xml->createElement('description', $_POST['description']);
    $product->appendChild($description);

    $price = $xml->createElement('price', $_POST['price']);
    $product->appendChild($price);

    $image = $xml->createElement('image', $_FILES['image']['name']);
    $product->appendChild($image);

    $root->appendChild($product);

    $xml->save('product-catalog.xml');

    // Save the uploaded image
    move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $_FILES['image']['name']);

    header('Location: index.html');
    exit;
}
?>
