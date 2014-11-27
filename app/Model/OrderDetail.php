<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Order $Order
 */
class OrderDetail extends AppModel {
	    public $useTable = 'orders_products'; // This model does not use a database table


	//The Associations below have been created with all possible keys, those that are not needed can be removed
 public $belongsTo = array(
        'Product', 'Order'
    );
// /**
//  * hasAndBelongsToMany associations
//  *
//  * @var array
//  */
// 	public $hasAndBelongsToMany = array(
// 		'Order' => array(
// 			'className' => 'Order',
// 			'joinTable' => 'orders_products',
// 			'foreignKey' => 'product_id',
// 			'associationForeignKey' => 'order_id',
// 			'unique' => 'keepExisting',
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'finderQuery' => '',
// 		)
// 	);

}
