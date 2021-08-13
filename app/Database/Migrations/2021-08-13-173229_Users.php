<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
				'null'			 => false,
			],
			'username' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'		 => 'false',
			],
			'email' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'		 => 'false',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
