<?php
use AnimationEditor\AnimationRepo;
require_once('AnimationRepo.php');

$repo = new AnimationRepo();
if(($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    return $repo->handleSave();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Animation Demo Page</title>
  <style>
    html, body {}
    <?=$repo->getStyle()?>
    .container {
        display:flex;
        align-items: center;
        justify-content: center;
        min-height:600px;
    }
    h2 {width:100%; display:block; text-align:center;}
  </style>
</head>
<body>
  <div class="container">
    <h2 class="animate1">My Demo Heading</h2>
  </div>
<pre>
  <?php print_r($repo->load()); ?>
</pre>
</body>
</html>