<?php

namespace app\modules\job;

use app\modules\video\models\Video;
use Yii;

/**
 * This class for job with files.
 *
 */

class Images
{
    public $model;
    public $image;

    /**
     * @param Video $model
     */
    public function setModel(Video $model){
        $this->model = $model;
    }

    /**
     *
     */
    private function uploadRemoteFile(){
        $this->image;
    }

    /**
     * create folder
     * @param string $path
     */
    private function checkPath($path){
        if(!file_exists($path)){
            $folderConstruct = '/';
            foreach (explode('/',$path) as $folder){
                if(!empty($folder)){
                    $folderConstruct = $folderConstruct . $folder . "/";
                    if(!file_exists($folderConstruct)){
                        mkdir($folderConstruct, 0755);
                    }
                }
            }
        }
    }

    /**
     * delete old image
     */
    private function deleteOldFile(){
        if(file_exists(Yii::$app->basePath . '/web' . $this->model->image) && !is_dir(Yii::$app->basePath . '/web' . $this->model->image)){
            unlink(Yii::$app->basePath . '/web' . $this->model->image);
        }
    }

    /**
     * @param $link
     * @return bool|string
     */
    public function load($link){
        $this->image = file_get_contents($link);

        if (!empty($this->image)) {
            $fileName = uniqid();
            $path = '/uploads/' . substr($fileName, 0, 2);
            $this->checkPath(Yii::$app->basePath . '/web' . $path);
            $path .= '/' . $fileName . '.' . pathinfo($link, PATHINFO_EXTENSION);
            if (file_put_contents(Yii::$app->basePath . '/web' . $path, $this->image)) {
                $this->deleteOldFile();
                $this->model->file = NULL;
                return $path;
            }
        }

        return false;
    }
}