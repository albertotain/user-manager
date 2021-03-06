<?php

declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Roles seed.
 */
class UsersSeed extends AbstractSeed {

  /**
   * Run Method.
   *
   * Write your database seeder using this method.
   *
   * More information on writing seeds is available here:
   * http://docs.phinx.org/en/latest/seeding.html
   *
   * @return void
   */
  public function run() {
     $data = [
        [
            'role_id' => '1',
            'email' => 'admin@admin.es',
            'password' => (new DefaultPasswordHasher)->hash('admin'),
            'activo' => 1,
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s'),
        ],
    ];

    $table = $this->table('users');
    $table->insert($data)->save();
    
  }

}
