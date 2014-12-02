<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator', 'Session');
public $uses = array("Order","Product");

/**
 * index method
 *
 * @return void
 */
public function index() {
	$grupo_usuario = $this->Auth->user('group_id');
	$this->Order->recursive = 2;
	$conditions = array("Order.status" => 0);
	if($grupo_usuario == 6){
		$conditions['OR'] = array(
            array('Order.tipo' => 1),
            array('Order.tipo' => 2),
        );
        $conditions['liberado_cozinha'] = 0;
	}else if($grupo_usuario == 5){
		$conditions['OR'] = array(
            array('Order.tipo' => 1),
            array('Order.tipo' => 3),
        );
        $conditions['liberado_balcao'] = 0;
	}
	$orders = $this->Order->find("all",array("conditions"=>$conditions,"order"=>array('Order.id' => 'DESC')));
	$this->set('orders', $orders);
}
public function pedidos_garcon($id){
	$this->Order->recursive = 2;
	$filter["conditions"]["Order.table_id"] = $id;
	$filter["order"] = array('Order.id' => 'DESC');
	$this->paginate = $filter; 	
	$this->set('orders', $this->Paginator->paginate());
}

public function efetuar_pedido_garcon(){
	$products = $this->Order->Product->find('list');
	$tables = $this->Order->Table->find('list');
	$pedidos_sessao = $this->Session->read("Pedidos");
	if(count($pedidos_sessao) > 0){
		$pedidos_sessao['total'] = 0;
		foreach($pedidos_sessao['Product'] as $index => $pedido){
			$pedidos_sessao['Product'][$index]['Product'] = $this->Product->find('first',array('conditions' => array('id' => $pedido['product_id'])))['Product'];
			$pedidos_sessao['total'] += $pedidos_sessao['Product'][$index]['Product']['price'] * $pedido['quantity'];
		}
	}
	$this->set(compact('tables', 'users', 'products', 'pedidos_sessao'));
}
public function listar(){
		$this->Order->recursive = 2;
	$orders = $this->Paginator->paginate();
	$this->set(compact('orders'));
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	if (!$this->Order->exists($id)) {
		throw new NotFoundException(__('Invalid order'));
	}
	$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
	$this->set('order', $this->Order->find('first', $options));
}

/**
 * add method
 *
 * @return void
 */
public function add() {
	if ($this->request->is('post')) {
		$this->Order->create();
		if ($this->Order->save($this->request->data)) {
			$this->Session->setFlash(__('The order has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
		}
	}
	$tables = $this->Order->Table->find('list');
	$users = $this->Order->User->find('list');
	$products = $this->Order->Product->find('list');
	$this->set(compact('tables', 'users', 'products'));
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit($id = null) {
	if (!$this->Order->exists($id)) {
		throw new NotFoundException(__('Invalid order'));
	}
	if ($this->request->is(array('post', 'put'))) {
		if ($this->Order->save($this->request->data)) {
			$this->Session->setFlash(__('The order has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
		}
	} else {
		$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
		$this->request->data = $this->Order->find('first', $options);
	}
	$tables = $this->Order->Table->find('list');
	$users = $this->Order->User->find('list');
	$products = $this->Order->Product->find('list');
	$this->set(compact('tables', 'users', 'products'));
}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function delete($id = null) {
	$this->Order->id = $id;
	if (!$this->Order->exists()) {
		throw new NotFoundException(__('Invalid order'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->Order->delete()) {
		$this->Session->setFlash(__('The order has been deleted.'));
	} else {
		$this->Session->setFlash(__('The order could not be deleted. Please, try again.'));
	}
	return $this->redirect(array('action' => 'index'));
}

public function despesas(){ 	
	$this->Order->recursive = 2;
	$filter["conditions"]["Order.user_id"] = $this->Auth->User("id");
	$filter["conditions"]["Order.status"] = 0;
	$filter["order"] = array('Order.id' => 'DESC');
	$this->paginate = $filter; 	
	$this->set('orders', $this->Paginator->paginate());

}

public function pedido() {
	$products = $this->Order->Product->find('list');
	$pedidos_sessao = $this->Session->read("Pedidos");
	if(count($pedidos_sessao) > 0){
		$pedidos_sessao['total'] = 0;
		foreach($pedidos_sessao['Product'] as $index => $pedido){
			$pedidos_sessao['Product'][$index]['Product'] = $this->Product->find('first',array('conditions' => array('id' => $pedido['product_id'])))['Product'];
			$pedidos_sessao['total'] += $pedidos_sessao['Product'][$index]['Product']['price'] * $pedido['quantity'];
		}
	}
	$this->set(compact('tables', 'users', 'products', 'pedidos_sessao'));
}

public function adicionar_pedido(){
	if($this->request->data['OrderDetail']['quantity'] > 0){
		$pedidos_sessao = $this->Session->read("Pedidos");
		if(!$pedidos_sessao){
			$pedidos_sessao = array();
		}
		$pedidos_sessao['table_id'] = $this->request->data['Order']['table_id'];
		$pedidos_sessao['status'] = $this->request->data['Order']['status'];
		$pedidos_sessao['Product'][$this->request->data['OrderDetail']['product_id']] = $this->request->data['OrderDetail'];
		$this->Session->write('Pedidos', $pedidos_sessao);
	}
	$this->redirect(array("controller"=>"orders","action"=>"pedido","client"));
}

public function cancelar_pedido(){
	$pedidos_sessao = $this->Session->read("Pedidos");
	if($pedidos_sessao['Product'][$this->request->params['named']['product_id']]){
		unset($pedidos_sessao['Product'][$this->request->params['named']['product_id']]);
		$this->Session->write('Pedidos', $pedidos_sessao);
	}
	$this->redirect(array("controller"=>"orders","action"=>"pedido","client"));
}

public function finalizar_pedido(){
	$pedidos_sessao = $this->Session->read("Pedidos");
	$pedidos_sessao['user_id'] = $this->Auth->user('id');

	$tem_bebida = 0;
	$tem_comida = 0;
	foreach($pedidos_sessao['Product'] as $index => $pedido){
		$product = $this->Product->find('first',array('conditions' => array('id' => $pedido['product_id'])))['Product'];
		if($product['tipo'] == 1){
			$tem_comida = 1;
		}else{
			$tem_bebida = 1;
		}
	}
	if($tem_comida && $tem_bebida){
		$pedidos_sessao['tipo'] = 1;
	}else if($tem_comida){
		$pedidos_sessao['tipo'] = 2;
	}else{
		$pedidos_sessao['tipo'] = 3;
	}

	$this->Order->create();
	$this->Order->save($pedidos_sessao);
	$this->Session->write('Pedidos', array());
	$this->redirect(array("controller"=>"orders","action"=>"despesas","client"));
}

public function liberar_pedido(){
	$grupo_usuario = $this->Auth->user('group_id');
	if($grupo_usuario == 6){
		$this->request->data["Order"]["liberado_cozinha"] = 1;
	}else if($grupo_usuario == 5){
		$this->request->data["Order"]["liberado_balcao"] = 1;
	}
	$this->Order->save($this->request->data);
	$this->redirect(array("action"=>"index"));
}

}
