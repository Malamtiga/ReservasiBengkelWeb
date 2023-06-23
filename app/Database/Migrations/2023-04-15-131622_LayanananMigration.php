<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LayanananMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'auto_increment'=>true,'null'=>false],
            'data_user_id' => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'null'=>false],
            'data_registrasi_id' => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'null'=>false],
            'layanan'      => ['type'=>'varchar','constraint'=>25,'null'=>true],
            'harga'        => ['type'=>'varchar','constraint'=>25,'null'=>true],
            
        ]);
        $this->forge->addPrimaryKey('id');
      
        $this->forge->createTable('layanan');
    }
    
    public function down()
    {
        $this->forge->dropTable('layanan');
    }
}
