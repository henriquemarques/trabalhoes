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
      <?php echo $this->Html->link('ES', array('controller' => 'pages', 'action'=>'index'), array('class' => 'navbar-brand')); ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><?php echo $this->Html->link('Consultar Cardápio',array('controller' => 'products','action' => 'cardapio')); ?></li>
        <li><?php echo $this->Html->link('Consultar Despesa',array('controller' => 'orders','action' => 'despesas')); ?></li>
        <li><?php echo $this->Html->link('Efetuar Pedido',array('controller' => 'orders','action' => 'pedido')); ?></li>
      </ul>
      <p class="navbar-text pull-left">Mesa: <strong><?php echo $this->Session->read("Table");?></strong></p>
      <?php if(AuthComponent::user('name')){ ?>
      <p class="navbar-text pull-right">Logado como <strong><?php echo $this->Session->read("Auth.User.name");?></strong> <?php echo $this->Html->link('Sair',array('controller' => 'users','action' => 'logout')); ?></p>
      <?php } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>