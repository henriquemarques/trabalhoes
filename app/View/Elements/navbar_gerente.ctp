<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ES</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><?php echo $this->Html->link('Manter Usuários',array('controller' => 'users','action' => 'index')); ?></li>
        <li><?php echo $this->Html->link('Manter Pedidos',array('controller' => 'orders','action' => 'listar')); ?></li>
        <li><?php echo $this->Html->link('Manter Mesas',array('controller' => 'tables','action' => 'index')); ?></li>
      </ul>
      <p class="navbar-text pull-right">Logado como <strong><?php echo $this->Session->read("Auth.User.name");?></strong> <?php echo $this->Html->link('Sair',array('controller' => 'users','action' => 'logout')); ?></p>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>