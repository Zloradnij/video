<?php

namespace app\modules\job;

use app\modules\video\models\Video;

/**
 * This is the model class for table "video".
 */
class YouTubeVideo extends Video
{
    public $currentSource = 'youtube';

    public $metaTitle       = 'title';
    public $metaDescription = 'description';
    public $metaImage       = 'twitter:image';

    /**
     * @return string
     */
    public function setSourceLink(){
        $inLinkList = explode('/', $this->frame_link);
        $outLinkList = [
            $inLinkList[0],
            $inLinkList[1],
            $inLinkList[2],
        ];
        $outLinkList[3] = 'watch?v=' . explode('?', $inLinkList[4])[0] . '&t=1s';

        return implode('/', $outLinkList);
    }

    /**
     * @return bool
     */
    public function setMeta(){
        $meta = get_meta_tags($this->source_link);
        $this->description = $meta[$this->metaDescription];
        $this->title       = $meta[$this->metaTitle];
        $remoteImageLink   = $meta[$this->metaImage];

        if(!empty($remoteImageLink)){
            $image = new Images();
            $image->setModel($this);
            $imageLocalPath = $image->load($remoteImageLink);
        }
        $this->image = !empty($imageLocalPath) ? $imageLocalPath : $remoteImageLink;

        return true;
    }
}
