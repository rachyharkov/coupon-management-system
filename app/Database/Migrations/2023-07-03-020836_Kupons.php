<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kupons extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'VARCHAR',
                'constraint'        => 36,
            ],
            'nama' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'code_total' => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],
            'code_length' => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],
            'coupon_type' => [
                'type'              => 'ENUM',
                'constraint'        => ['discount', 'free_shipping', 'buy_x_free_y', 'fixed_amount'],
                'default'           => 'fixed_amount',
            ],
            'coupon_value_type' => [
                'type'              => 'ENUM',
                'constraint'        => ['fixed', 'percentage'],
                'default'           => 'fixed',
            ],
            'coupon_applied_on' => [
                'type'              => 'ENUM',
                'constraint'        => ['single_product', 'multiple_products'],
                'default'           => 'single_product',
            ],
            'coupon_date_expired' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'coupon_limit' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'custom_condition' => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'formulir_id' => [
                'type'              => 'VARCHAR',
                'constraint'        => 36,
            ],
            'status' => [
                'type'              => 'ENUM',
                'constraint'        => ['1', '0'],
                'default'           => '1',
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
        $this->forge->addForeignKey('formulir_id', 'formulirs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kupons');
    }


    public function down()
    {
        $this->forge->dropTable('kupons');
    }
}
