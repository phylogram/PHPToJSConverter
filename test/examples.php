<?php

require_once __DIR__ . '/../vendor/autoload.php';

echo "\n1.\n";

echo PHPToJSConverter\JSConverter::to_javascript(['a' => 1, 'f' => new \PHPToJSConverter\Items\LiteralJSCode(<<<JS
function (m) {
  console.log(m);
}
JS
)]);

echo "\n2.\n";

echo PHPToJSConverter\JSConverter::to_javascript([13, new \PHPToJSConverter\Items\LiteralJSCode('some_global_variable')]);

