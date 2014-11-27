<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $this->Html->charset(); ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php echo $this->fetch('title'); ?>
  </title>
  <?php
  echo $this->Html->meta('icon');

  echo $this->Html->css('bootstrap.min');
  echo $this->Html->css('main');

  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');
  ?>
  <meta charset="utf-8">
</head>
<body>
  <header>
    <?php echo $this->Element("navbar_cliente");?>
  </header>
  <div class="container">

    <?php echo $this->Session->flash(); ?>

    <?php echo $this->fetch('content'); ?>
  </div>
  <?php echo $this->Html->script('jquery.min');?>
  <?php echo $this->Html->script('bootstrap.min');?>
</body>
</html>