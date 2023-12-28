<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProdukTendaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'productName' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'productDescription' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'productPrice' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'productImage' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('produk_tenda');
    }

    public function down()
    {
        $this->forge->dropTable('produk_tenda');
    }
}
