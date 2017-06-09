<?php

use yii\db\Migration;

class m170607_024536_video extends Migration
{
    public function up()
    {
        $this->createTable('video', [
            'id'                => $this->primaryKey(10)->comment('ID'),
            'frame_link'        => $this->string()->notNull()->comment('IFrame Link'),
            'source_link'       => $this->string()->notNull()->comment('Source Link'),
            'source'            => $this->string()->notNull()->comment('Source'),
            'title'             => $this->string()->notNull()->comment('Title'),
            'description'       => $this->text()->comment('Description'),
            'image'             => $this->string()->comment('Image'),

            'status'            => $this->integer(2)->notNull()->comment('Status'),

            'created_by'        => $this->integer()->comment('Created By'),
            'updated_by'        => $this->integer()->comment('Updated By'),

            'created_at'        => $this->integer()->notNull()->comment('Created At'),
            'updated_at'        => $this->integer()->notNull()->comment('Updated At'),
        ]);
    }

    public function down()
    {
        $this->dropTable('video');
    }
}
