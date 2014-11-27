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

/**
 * index method
 *
 * @return void
 */
public function index() {
	$this->Order->recursive = 2;
	$orders = $this->Order->find("all",array("conditions"=>array("Order.status"=>0)));
	$this->set('orders', $orders);
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
	$this->paginate = $filter; 	
	$this->set('orders', $this->Paginator->paginate());

}

public function pedido() {
	$products = $this->Order->Product->find('list');
	$this->set(compact('tables', 'users', 'products'));
}

public function liberar_pedido(){
	$this->request->data["Order"]["status"] = 1;
	$this->Order->save($this->request->data);
	$this->redirect(array("action"=>"index"));
}

}
