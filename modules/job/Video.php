<?php

namespace app\modules\job;

/**
 * This class for job with model "video".
 *
 */
class Video
{
    private $model;
    private $params;
    private $errors = [];

    /**
     * @param \app\modules\video\models\Video $model
     */
    public function setModel(\app\modules\video\models\Video $model){
        $this->model = $model;
    }

    /**
     * @param $params
     * @return bool
     */
    public function setParams($params){
        $this->params = end($params);
        $this->model = $this->model ? $this->model : $this->selectSource();

        $className = explode('\\', $this->model::className());
        $className = end($className);

        if (empty($this->model)) {
            $this->errors[] = 'empty model';

            return false;
        }

        $this->params['frame_link'] = $this->clearLink();

        if (empty($this->params['frame_link'])) {
            $this->errors[] = 'empty param link';
            return false;
        }

        $this->model->frame_link = $this->params['frame_link'];
        $this->model->source_link = $this->model->setSourceLink();
        $this->model->status = $this->params['status'];
        $this->model->source = $this->model->currentSource;

        $this->params[$className] = $this->params;

        if($this->model->setMeta()){
            return true;
        }

        $this->errors[] = 'load meta tags error';
        return false;
    }

    /**
     * @return array
     */
    public function getErrors(){
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function save(){
        return $this->model->save() ? true : false;
    }

    /**
     * @return mixed
     */
    public function getModel(){
        return $this->model;
    }

    /**
     * @return RuTubeVideo|VimeoVideo|YouTubeVideo|null
     */
    private function selectSource(){
        if ($this->isYouTube()) {
            return new YouTubeVideo();
        }

        if ($this->isRuTube()) {
            return new RuTubeVideo();
        }

        if ($this->isVimeo()) {
            return new VimeoVideo();
        }

//        if ($this->isYandex()) {
//            return new YandexVideo();
//        }

        return NULL;
    }

    /**
     * @return bool
     */
    private function isLink(){
        return strpos(htmlspecialchars($this->params['frame_link']), 'iframe') ? false : true;
    }

    /**
     * @return string
     */
    private function clearLink(){
        if (!$this->isLink()) {
            preg_match_all("#src=(?:\"|')(.*)(?:\"|')#isU",$this->params['frame_link'],$match);
            return !empty($match[1][0]) ? $match[1][0] : NULL;
        }
        return $this->params['frame_link'];
    }

    /**
     * @return bool
     */
    private function isYouTube(){
        return array_search('www.youtube.com', explode('/', $this->params['frame_link'])) === false ? false : true;
    }

    /**
     * @return bool
     */
    private function isRuTube(){
        return array_search('rutube.ru', explode('/', $this->params['frame_link'])) === false ? false : true;
    }

    /**
     * @return bool
     */
    private function isVimeo(){
        return array_search('vimeo.com', explode('/', $this->params['frame_link'])) === false ? false : true;
    }

    /**
     * @return bool
     */
    private function isYandex(){
        return array_search('yandex.ru', explode('/', $this->params['frame_link'])) === false ? false : true;
    }
}

