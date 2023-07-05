<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KuponProducts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'VARCHAR',
                'constraint'        => 36,
            ],
            'product_name' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'price_original' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'discount_percentage' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'discount_fixed' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'value_fixed' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'value_buy' => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'value_free' => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'kupon_id' => [
                'type'              => 'VARCHAR',
                'constraint'        => 36,
            ],
            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kupon_id', 'kupons', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kupon_products');
    }

    public function down()
    {
        $this->forge->dropTable('kupon_products');
    }
}
