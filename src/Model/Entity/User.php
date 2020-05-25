<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $username
 * @property string|null $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $mobile
 * @property string|null $sex
 * @property \Cake\I18n\FrozenDate|null $birthdate
 * @property string|null $city
 * @property string|null $zip
 * @property string|null $about
 * @property string|null $interests
 * @property string|null $job
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'created' => true,
        'modified' => true,
        'username' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'mobile' => true,
        'sex' => true,
        'birthdate' => true,
        'city' => true,
        'zip' => true,
        'about' => true,
        'interests' => true,
        'job' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
    
	protected function _setPassword($value)
	{
		if (strlen($value)) {
			$hasher = new DefaultPasswordHasher();

			return $hasher->hash($value);
		}
	}
}
