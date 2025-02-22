<?php
require_once 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Sample data
$jsonData = file_get_contents('example-data.json');
$data = json_decode($jsonData, true);

// Helper functions
function formatDate($date, $userId) {
    return date('Y-m-d', strtotime($date));
}

function formatHMS($seconds, $showSeconds = false, $userId = null) {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    return $hours . ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT);
}

function currency($amount, $currency) {
    return $currency['symbol'] . '' . number_format($amount, 2);
}

// Initialize Twig
$loader = new FilesystemLoader('./');
$twig = new Environment($loader);

// Add the helper functions as Twig functions
$twig->addFunction(new \Twig\TwigFunction('formatDate', 'formatDate'));
$twig->addFunction(new \Twig\TwigFunction('formatHMS', 'formatHMS'));
$twig->addFunction(new \Twig\TwigFunction('currency', 'currency'));

// Render the template
echo $twig->render('modern-invoice.twig', $data); 