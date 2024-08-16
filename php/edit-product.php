<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xml = new DOMDocument();
    $xml->load('product-catalog.xml');

    $products = $xml->getElementsByTagName('product');

    foreach ($products as $product) {
        if ($product->getElementsByTagName('name')->item(0)->textContent == $_POST['old_name']) {
            $product->getElementsByTagName('name')->item(0)->textContent = $_POST['name'];
            $product->getElementsByTagName('description')->item(0)->textContent = $_POST['description'];
            $product->getElementsByTagName('price')->item(0)->textContent = $_POST['price'];
            if (!empty($_FILES['image']['name'])) {
                $product->getElementsByTagName('image')->item(0)->textContent = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $_FILES['image']['name']);
            }
            break;
        }
    }

    $xml->save('product-catalog.xml');
    header('Location: index.html');
    exit;
}
?>
