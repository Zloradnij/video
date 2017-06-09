<?php

namespace app\modules\job;

use app\modules\video\models\Video;

/**
 * This is the model class for table "video".
 */
class VimeoVideo extends Video
{
    public $currentSource   = 'vimeo';

    public $metaTitle       = 'twitter:title';
    public $metaDescription = 'twitter:description';
    public $metaImage       = 'twitter:image';

    /**
     * @return string|null
     */
    public function setSourceLink(){
        $inLinkList = explode('/', $this->frame_link);

        return 'https://vimeo.com/' . $inLinkList[4];
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
