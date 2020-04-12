<?php
namespace UserManager\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use UserManager\Traits\TokenTrait;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int|null $role_id
 * @property string $email
 * @property string|null $name
 * @property string|null $last_name
 * @property string|null $abrev
 * @property string|null $telefono
 * @property string|null $text_color
 * @property string|null $background_color
 * @property int $activo
 * @property \Cake\I18n\FrozenTime|null $last_login
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \UserManager\Model\Entity\Role $role
 */
class User extends Entity {

  use TokenTrait;

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
      'role_id' => true,
      'email' => true,
      'name' => true,
      'last_name' => true,
      'abrev' => true,
      'telefono' => true,
      'text_color' => true,
      'background_color' => true,
      'activo' => true,
      'last_login' => true,
      'password' => true,
      'created' => true,
      'modified' => true,
      'role' => true,
  ];

  /**
   * Fields that are excluded from JSON versions of the entity.
   *
   * @var array
   */
  protected $_hidden = [
      'password',
  ];

  protected function _setPassword($password) {
    if (strlen($password) > 0) {
      return (new DefaultPasswordHasher)->hash($password);
    }
  }

    protected function _getFullName() {
    return $this->name . '  ' . $this->last_name;
  }
  
}
