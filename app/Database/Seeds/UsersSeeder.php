<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
	public function run()
	{
		$data= [
			[
      			'username'=> 'Allison Silva',
				'email'=> 'silva@empresa.com',
			],
			[
      			'username'=> 'Amanda Marques',
				'email'=> 'marques@empresa.com',
			],
						[
      			'username'=> 'Sulliavan Ruan',
				'email'=> 'ruan@empresa.com',
			],
			[
      			'username'=> 'Catarina Gomes',
				'email'=> 'gomes@empresa.com',
			],
			[
      			'username'=> 'Felipe Silvestre',
				'email'=> 'silvestre@empresa.com',
			],
			[
      			'username'=> 'Romilson Alife',
				'email'=> 'alife@empresa.com',
			],
						[
      			'username'=> 'Manoel Queiroz',
				'email'=> 'queiroz@empresa.com',
			],
		];
		// Using Query Builder
		$this->db->table('users')->insertBatch($data);
	}
}
