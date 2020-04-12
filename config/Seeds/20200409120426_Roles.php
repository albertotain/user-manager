<?php

use Phinx\Seed\AbstractSeed;

class RolesSeeder extends AbstractSeed {

  /**
   * Run Method.
   *
   * Write your database seeder using this method.
   *
   * More information on writing seeders is available here:
   * http://docs.phinx.org/en/latest/seeding.html
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

    $roles = $this->table('roles');
    $roles->insert($data)->save();
  }

}
