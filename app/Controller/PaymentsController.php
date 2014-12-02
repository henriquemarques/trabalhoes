<?php
App::uses('AppController', 'Controller');
/**
 * Payments Controller
 *
 * @property Payment $Payment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PaymentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
public $uses = array("Payment","Table","Order");

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Payment->recursive = 0;
		$this->set('payments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Payment->exists($id)) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$options = array('conditions' => array('Payment.' . $this->Payment->primaryKey => $id));
		$this->set('payment', $this->Payment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$orders = $this->Order->find("all",array("conditions"=>array("Order.table_id"=>$this->request->data['Payment']['table_id'],"Order.status"=>0)));
			$pedido_em_aberto = false;
			foreach($orders as $order){
				if(
					(
						$order['Order']['tipo'] == 1 && 
						($order['Order']['liberado_cozinha'] == 0 || $order['Order']['liberado_balcao'] == 0)
					) || 
					$order['Order']['tipo'] == 2 && $order['Order']['liberado_cozinha'] == 0 || 
					$order['Order']['tipo'] == 3 && $order['Order']['liberado_balcao'] == 0
				){
					$pedido_em_aberto = true;
				}
			}
			if(!$pedido_em_aberto){
				foreach($orders as $order){
					$this->request->data['Payment']['order_id'] = $order['Order']['id'];
					$this->Payment->create();
					$this->Payment->save($this->request->data);

					$this->request->data["Order"]["id"] = $order['Order']['id'];
					$this->request->data["Order"]["status"] = 1;
					$this->Order->save($this->request->data);
				}
			}else{
				$this->Session->setFlash(__('Mesa com pedidos em aberto'));
			}
			return $this->redirect(array('action' => 'index'));
		}
		$tables = $this->Table->find('list');
		$this->set(compact('tables'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Payment->exists($id)) {
			throw new NotFoundException(__('Invalid payment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Payment->save($this->request->data)) {
				$this->Session->setFlash(__('The payment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Payment.' . $this->Payment->primaryKey => $id));
			$this->request->data = $this->Payment->find('first', $options);
		}
		$tables = $this->Table->find('list');
		$this->set(compact('tables'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Payment->id = $id;
		if (!$this->Payment->exists()) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Payment->delete()) {
			$this->Session->setFlash(__('The payment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The payment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
