<?php

use Plib\View;

if (!isset($this)) {http_response_code(403); exit;}

/**
 * @var View $this
 * @var string $css
 * @var string $image
 * @var string $src
 * @var string $js
 */
?>

<!DOCTYPE html>
<html class="imgzoom_view">
  <head>
    <title><?=$this->esc($image)?></title>
    <link rel="stylesheet" type="text/css" href="<?=$this->esc($css)?>">
  </head>
  <body>
    <img src="<?=$this->esc($src)?>" alt="<?=$this->esc($image)?>">
    <script type="module" src="<?=$this->esc($js)?>"></script>
  </body>
</html>
