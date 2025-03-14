<?php

use Plib\View;

/**
 * @var View $this
 * @var string $version
 * @var list<array{class:string,label:string,stateLabel:string}> $checks
 */
?>

<h1>Imgzoom <?=$this->esc($version)?></h1>
<div>
  <h2><?=$this->text('syscheck_title')?></h2>
<?php foreach ($checks as $check):?>
  <p class="<?=$check['class']?>"><?=$this->text('syscheck_message', $check['label'], $check['stateLabel'])?></p>
<?php endforeach?>
</div>
