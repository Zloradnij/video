<?php

namespace app\modules\job;

use app\modules\video\models\Video;

/**
 * This is the model class for table "video".
 */
class RuTubeVideo extends Video
{
    public $currentSource = 'rutube';

    public $metaTitle       = 'title';
    public $metaDescription = 'description';
    public $metaImage       = 'twitter:image';

    /**
     * @return string|null
     */
    public function setSourceLink(){
        $html = file_get_contents('http:' . $this->frame_link);
        preg_match_all("#link rel=\"canonical\" href=(?:\"|')(.*)(?:\"|')#isU",$html,$match);

        return !empty($match[1][0]) ? $match[1][0] : NULL;
    }

    /**
     * @return bool
     */
    public function setMeta(){
        $meta = get_meta_tags($this->source_link);
        $this->description = $meta[$this->metaDescription];

        $html = file_get_contents($this->source_link);

        preg_match_all("/<title>(.*)<\/title>/siU",$html,$match);
        $this->title       = $match[1][0];

        preg_match_all("#meta property=\"og:image\" content=(?:\"|')(.*)(?:\"|')#isU",$html,$match);
        $remoteImageLink   = $match[1][0];

        if(!empty($remoteImageLink)){
            $image = new Images();
            $image->setModel($this);
            $imageLocalPath = $image->load($remoteImageLink);
        }
        $this->image = !empty($imageLocalPath) ? $imageLocalPath : $remoteImageLink;

        return true;
    }
}
