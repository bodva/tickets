<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Comments extends ActiveRecord{

    public function rules () {
        return [
            // author and comment are required
            [['author', 'comment'], 'required'],
        ];
    }

    public function addComment() {
        try {
            $this->save();
        } catch (Exception $e) {
            $this->addErrors([$e->getCode() => $e->getMessage()]);
            return false;
        }
        return $this;
    }
}
