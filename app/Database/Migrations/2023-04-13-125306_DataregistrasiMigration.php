<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataregistrasiMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'auto_increment'=>true,'null'=>false],
            'data_user_id'          => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'null'=>false],
            'nama_bengkel'      => ['type'=>'varchar','constraint'=>20,'null'=>true],
            'alamat_bengkel'    => ['type'=>'varchar','constraint'=>50,'null'=>true],
            'hp_bengkel'        => ['type'=>'varchar','constraint'=>15,'null'=>true],
            'status'            => ['type'=>'int','constraint'=>2,'null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('data_registrasi');
        $this->forge->addForeignKey('data_user_id', 'data_user', 'id', 'cascade');
    }
    
    public function down()
    {
        $this->forge->dropTable('data_registrasi');
    }
}
