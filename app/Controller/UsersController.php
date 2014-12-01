<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator');
public $uses = array("User","Table");
/**
 * index method
 *
 * @return void
 */
public function index() {
	$this->User->recursive = 0;
	$this->set('users', $this->Paginator->paginate());
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	if (!$this->User->exists($id)) {
		throw new NotFoundException(__('Invalid user'));
	}
	$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
	$this->set('user', $this->User->find('first', $options));
}

/**
 * add method
 *
 * @return void
 */
public function add() {
	if ($this->request->is('post')) {
		$this->User->create();
		if ($this->User->save($this->request->data)) {
			$this->Session->setFlash(__('The user has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
		}
	}
	$groups = $this->User->Group->find('list');
	$this->set(compact('groups'));
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit($id = null) {
	if (!$this->User->exists($id)) {
		throw new NotFoundException(__('Invalid user'));
	}
	if ($this->request->is(array('post', 'put'))) {
		if ($this->User->save($this->request->data)) {
			$this->Session->setFlash(__('The user has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
		}
	} else {
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->request->data = $this->User->find('first', $options);
	}
	$groups = $this->User->Group->find('list');
	$this->set(compact('groups'));
}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function delete($id = null) {
	$this->User->id = $id;
	if (!$this->User->exists()) {
		throw new NotFoundException(__('Invalid user'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->User->delete()) {
		$this->Session->setFlash(__('The user has been deleted.'));
	} else {
		$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
	}
	return $this->redirect(array('action' => 'index'));
}
public function direciona(){
	switch($this->Auth->User("group_id")){
		case '3':
			$this->redirect(array('controller'=>'tables','action' => 'disponiveis'));
			break;
		case '6':
			$this->redirect(array('controller'=>'orders','action' => 'index'));
			break;
		case '1':
				$this->redirect(array('controller'=>'pages','action' => 'display','gerente'));
			break;
	}
	debug($this->Auth->User("group_id"));
}
public function login() {
	if ($this->request->is('post')) {
		if ($this->Auth->login()) {
			return $this->redirect($this->Auth->redirect());
		}
		$this->Session->setFlash(__('Your username or password was incorrect.'));
	}
}

public function logout() {
	$this->request->data["Table"]["id"] = $this->Session->read("Table");
	$this->request->data["Table"]["disponivel"] = 1;
	unset($this->request->data["Table"]["table_id"]);
	$this->Table->save($this->request->data);
	return $this->redirect($this->Auth->logout());

}
public function funcionarios(){

}
public function consultar(){
	if($this->request->query){
		$filtro["conditions"] = array("User.name LIKE"=>"%{$this->request->query["name"]}%");
		$user = $this->User->find('first',$filtro);
		if(isset($user["User"]["id"])){
			$this->redirect(array("action"=>'view',$user["User"]["id"]));
		}else{
			$this->Session->setFlash(__('Usuário não cadastrado'));

		}
	}
}

public function cadastrar(){
	if ($this->request->is('post')) {
		$this->User->create();
		if ($this->User->save($this->request->data)) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
		} else {
			$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
		}
	}
}

public function beforeFilter() {
	parent::beforeFilter();

    // For CakePHP 2.0
	$this->Auth->allow('*');

    // For CakePHP 2.1 and up
	$this->Auth->allow();
}
}
