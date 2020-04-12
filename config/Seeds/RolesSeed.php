<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Roles seed.
 */
class RolesSeed extends AbstractSeed {

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
            'id' => '1',
            'role' => 'Administrador',
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s'),
        ],
    ];

    $table = $this->table('roles');
    $table->insert($data)->save();
  }

}
