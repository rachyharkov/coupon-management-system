<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KuponCodes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'VARCHAR',
                'constraint'        => 36,
            ],
            'code' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'used' => [
                'type'              => 'ENUM',
                'constraint'        => ['1', '0'],
                'default'           => '0',
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
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kupon_id', 'kupons', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kupon_codes');
    }

    public function down()
    {
        $this->forge->dropTable('kupon_codes');
    }
}
