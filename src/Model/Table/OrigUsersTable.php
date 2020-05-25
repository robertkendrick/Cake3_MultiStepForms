<?php
// src/Model/Table/ArticlesTable.php
namespace App\Model\Table;
use Cake\ORM\Table;

// the Validator class
use Cake\Validation\Validator;
// the Text class
use Cake\Utility\Text;
use Cake\ORM\Query;

class Users extends Table {
    var $validate = array(
            'username' => array(
                    'unique' => array(
                            'rule' => 'isUnique',
                            'message' => 'User already registered'
                    ),
                    'email' => array(
                            'rule' => 'email',
                            'message' => 'Username must be a valid email address'
                    )
            ),
            'password' => array(
                    'rule' => array('minLength', 6),
                    'message' => 'Minimum six characters please'
            ),
            'first_name' => array(
                    'rule' => 'notEmpty',
                    'message' => 'required field'
            ),
            'last_name' => array(
                    'rule' => 'notEmpty',
                    'message' => 'required field'
            ),
            'mobile' => array(
                    'rule' => 'notEmpty',
                    'message' => 'required field'
            ),
            'birthdate' => array(
                    'rule' => 'notEmpty',
                    'message' => 'required field'
            ),
            'city' => array(
                    'rule' => 'notEmpty',
                    'message' => 'required field'
            ),
            'zip' => array(
                    'numeric' => array(
                            'rule' => 'numeric',
                            'message' => 'zip code can contain only numeric values'
                    ),
                    'lenght' => array(
                            'rule' => array('between', 5,5),
                            'message' => 'zip code must be 5 digits long'
                    )
            )
    );
}
