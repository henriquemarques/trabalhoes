<?php
App::uses('AppController', 'Controller');
/**
 * Employers Controller
 *
 * @property Employer $Employer
 * @property PaginatorComponent $Paginator
 */
class EmployersController extends AppController {

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
		$this->Employer->recursive = 0;
		$this->set('employers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Employer->exists($id)) {
			throw new NotFoundException(__('Invalid employer'));
		}
		$options = array('conditions' => array('Employer.' . $this->Employer->primaryKey => $id));
		$this->set('employer', $this->Employer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Employer->create();
			if ($this->Employer->save($this->request->data)) {
				$this->Session->setFlash(__('The employer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employer could not be saved. Please, try again.'));
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
		if (!$this->Employer->exists($id)) {
			throw new NotFoundException(__('Invalid employer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Employer->save($this->request->data)) {
				$this->Session->setFlash(__('The employer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Employer.' . $this->Employer->primaryKey => $id));
			$this->request->data = $this->Employer->find('first', $options);
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
		$this->Employer->id = $id;
		if (!$this->Employer->exists()) {
			throw new NotFoundException(__('Invalid employer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Employer->delete()) {
			$this->Session->setFlash(__('The employer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The employer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
