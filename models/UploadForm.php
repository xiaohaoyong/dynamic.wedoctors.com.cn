<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/12/14
 * Time: 18:25
 */
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg', 'gif'],'maxSize' => 1024*1024*1024],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $baseName=substr(md5(file_get_contents($this->imageFile->tempName)),8,16);
            $img= $baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs(__DIR__ . '/../uploads/' .$img);
            return $img;
        } else {
            return false;
        }
    }
}