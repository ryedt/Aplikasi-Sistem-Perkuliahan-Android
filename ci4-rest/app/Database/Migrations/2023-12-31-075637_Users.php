<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'            => ['type' => 'varchar', 'constraint' => 255],
            'username'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'fullname'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'user_img'         => ['type' => 'varchar', 'constraint' => 255, 'default' => 'default.svg'],
            'password'    => ['type' => 'varchar', 'constraint' => 50],
            'level'       => ['type' => 'varchar', 'constraint' => 20, 'default' => 'Mahasiswa'],
            'reset_at'         => ['type' => 'datetime', 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('username');

        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
