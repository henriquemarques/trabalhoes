<?php
App::uses('AppController', 'Controller');
/**
 * Tables Controller
 *
 * @property Table $Table
 * @property PaginatorComponent $Paginator
 */
class TablesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Table->recursive = 0;
		$this->set('tables', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Table->exists($id)) {
			throw new NotFoundException(__('Invalid table'));
		}
		$options = array('conditions' => array('Table.' . $this->Table->primaryKey => $id));
		$this->set('table', $this->Table->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Table->create();
			if ($this->Table->save($this->request->data)) {
				$this->Session->setFlash(__('The table has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The table could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Table->exists($id)) {
			throw new NotFoundException(__('Invalid table'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Table->save($this->request->data)) {
				$this->Session->setFlash(__('The table has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The table could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Table.' . $this->Table->primaryKey => $id));
			$this->request->data = $this->Table->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Table->id = $id;
		if (!$this->Table->exists()) {
			throw new NotFoundException(__('Invalid table'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Table->delete()) {
			$this->Session->setFlash(__('The table has been deleted.'));
		} else {
			$this->Session->setFlash(__('The table could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function disponiveis(){
		$this->Table->recursive = 0;
		$filtros["conditions"]["and"]["Table.disponivel"] = 1;
		$tables = $this->Table->find("list",$filtros);
		$this->set('tables', $tables);
	}

	public function selecionar_mesa(){
		$this->Session->write('Table', $this->request->data["Table"]["table_id"]);
		$this->request->data["Table"]["id"] = $this->request->data["Table"]["table_id"];
		$this->request->data["Table"]["disponivel"] = 0;
		unset($this->request->data["Table"]["table_id"]);
		$this->Table->save($this->request->data);
		$this->redirect(array("controller"=>"pages","action"=>"display","client"));

	}

	public function liberar(){
		$this->request->data["Table"]["id"] = $this->request->params['pass'][0];
		$this->request->data["Table"]["disponivel"] = 1;
		unset($this->request->data["Table"]["table_id"]);
		$this->Table->save($this->request->data);
		$this->redirect(array("controller"=>"tables","action"=>"index","client"));
	}
}
