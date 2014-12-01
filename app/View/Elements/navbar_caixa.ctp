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
        <li><?php echo $this->Html->link('Manter Pagamentos',array('controller' => 'payments','action' => 'index')); ?></li>
        
      </ul>
      <?php if(AuthComponent::user('name')){ ?>
      <p class="navbar-text pull-right">Logado como <strong><?php echo $this->Session->read("Auth.User.name");?></strong> <?php echo $this->Html->link('Sair',array('controller' => 'users','action' => 'logout')); ?></p>
      <?php } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>