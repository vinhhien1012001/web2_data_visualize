<?php
require "config.php";

header("Content-Type: application/json");

$sql_sales = "SELECT month, sales FROM sales";
$sql_products = "SELECT product_name, price FROM products";
$sql_customers = "SELECT country, COUNT(*) as customer_count FROM customers GROUP BY country ORDER BY customer_count DESC LIMIT 5";
$sql_reviews = "SELECT rating, COUNT(*) as review_count FROM reviews GROUP BY rating ORDER BY rating";

$result_sales = $conn->query($sql_sales);
$result_products = $conn->query($sql_products);
$result_customers = $conn->query($sql_customers);
$result_reviews = $conn->query($sql_reviews);

$data = array(
    'sales' => array(),
    'products' => array(),
    'customers' => array(),
    'reviews' => array()
);

while ($row = $result_sales->fetch_assoc()) {
    $data['sales'][] = $row;
}

while ($row = $result_products->fetch_assoc()) {
    $data['products'][] = $row;
}

while ($row = $result_customers->fetch_assoc()) {
    $data['customers'][] = $row;
}

while ($row = $result_reviews->fetch_assoc()) {
    $data['reviews'][] = $row;
}

echo json_encode($data);
?>