<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class UserManager extends AbstractMigration
{
    public function up()
    {
        $this->table('roles')
            ->addColumn('role', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('users')
            ->addColumn('role_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('abrev', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('telefono', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('text_color', 'string', [
                'default' => '#000000',
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('background_color', 'string', [
                'default' => '#FFFFFF',
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('activo', 'integer', [
                'default' => null,
                'limit' => 2,
                'null' => false,
            ])
            ->addColumn('last_login', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'role_id',
                ]
            )
            ->create();

        $this->table('users')
            ->addForeignKey(
                'role_id',
                'roles',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT',
                ]
            )
            ->update();
    }

    public function down()
    {      
        $this->table('users')
            ->dropForeignKey(
                'role_id'
            )->save();

        $this->table('roles')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
