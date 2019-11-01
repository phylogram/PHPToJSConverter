<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PHPToJSConverter\JSConverter;
echo JSConverter::to_javascript($argv[1]);