<?php $view->layout('error'); ?>

<h1>An Error Has Occured</h1>

<div class="inside">
  <p><strong><?php echo $e->getMessage(); ?></strong></p>
  <p><code><?php echo $e->getFile(); ?>:<?php echo $e->getLine(); ?></code></p>
  <pre><?php echo $e->getTraceAsString(); ?></pre>
</div>

