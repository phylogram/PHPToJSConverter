# PHPToJSConverter: Generate JS Code from within Php

## Description
This package allows to generate javascript code from php, with literal code from strings, and automatic array, string, boolean, number and null conversion.
## Why
I used json_encode to transform php arrays and more into javascript code. I would not write as strings, since I want to use phps object inherit features.
However you can not pass javascript code through json_encode, because it will be handled as strings.

Somehow I did not find any other implementation.
## How
Pass your data to \PHPToJSConverter\JSConverter::to_javascript(), if you need javascript code, use \PHPToJSConverter\Items\LiteralJSCode()
## Examples
### 1.
```php
echo 'let one = ' . PHPToJSConverter\JSConverter::to_javascript(['a' => 1, 'f' => new \PHPToJSConverter\Items\LiteralJSCode(<<<JS
function (m) {
  console.log(m);
}
JS
)]);
```
->
```js
let one = {  a:  1 ,  f:  function (m) {
  console.log(m);
}  } 

```

### 2.
```php
echo 'let two = ' . PHPToJSConverter\JSConverter::to_javascript([13, new \PHPToJSConverter\Items\LiteralJSCode('some_global_variable')]);
```
->
```js
let two = [ 13 ,  some_global_variable ] 
```
