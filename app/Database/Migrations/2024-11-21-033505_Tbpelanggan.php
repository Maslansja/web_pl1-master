<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbpelanggan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'pelanggan_id'         => [
                'type'          => 'INT',
                'constraint'    => '11',
                'unsigned'      => true,
                'auto_increment'=> true,
            ],
            'nama pelanggan'       => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'alamat' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'nomor telepon'              => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
        ]);

        $this->forge->addKey('pelanggan_id', TRUE);
        $this->forge->createTable('tb_pelanggan');

    }

    public function down()
    {
        $this->forge->dropTable('tb_pelanggan');
    }
}

