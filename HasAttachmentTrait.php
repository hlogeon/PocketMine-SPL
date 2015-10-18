<?php
/**
 * Created by PhpStorm.
 * User: hlogeon
 * Date: 10/18/15
 * Time: 5:36 AM
 */

trait HasAttachmentTrait {

    /** @var \ThreadedLoggerAttachment */
    protected $attachment = null;

    public function addAttachment(\ThreadedLoggerAttachment $attachment){
        if($this->attachment instanceof \ThreadedLoggerAttachment){
            $this->attachment->addAttachment($attachment);
        }else{
            $this->attachment = $attachment;
        }
    }

    /**
     * @param ThreadedLoggerAttachment $attachment
     */
    public function removeAttachment(\ThreadedLoggerAttachment $attachment){
        if($this->attachment instanceof \ThreadedLoggerAttachment){
            if($this->attachment === $attachment){
                $this->attachment = null;
                foreach($attachment->getAttachments() as $attachment){
                    $this->addAttachment($attachment);
                }
            }
        }
    }

    public function removeAttachments(){
        if($this->attachment instanceof \ThreadedLoggerAttachment){
            $this->attachment->removeAttachments();
            $this->attachment = null;
        }
    }

    /**
     * @return \ThreadedLoggerAttachment[]
     */
    public function getAttachments(){
        $attachments = [];
        if($this->attachment instanceof \ThreadedLoggerAttachment){
            $attachments[] = $this->attachment;
            $attachments += $this->attachment->getAttachments();
        }

        return $attachments;
    }

}