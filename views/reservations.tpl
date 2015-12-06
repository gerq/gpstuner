<ul>
<?php foreach($this->reservations as $key => $res): ?>
  <li><?php echo $res[1] ?>, <?php echo $res[2] ?> fős, <?php echo $res[3] ?> - <?php echo $res[4] ?></li>
<?php endforeach; ?>
</ul>