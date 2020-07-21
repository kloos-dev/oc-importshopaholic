<?php namespace Codecycler\ImportShopaholic\Classes\Item;

class ImportValue
{
    protected $sValueKey;

    protected $sValueValue;

    protected $bIsRemote = false;

    protected $bIsImage = false;

    const IMAGE_EXTENSIONS = [
        'jpg',
        'png',
        'jpeg',
    ];

    public function __construct($sValueKey, $sValueValue)
    {
        $this->sValueKey = $sValueKey;
        $this->sValueValue = $sValueValue;

        $this->checkIsRemote();
        $this->checkIsImage();

        $this->downloadRemoteImage();
    }

    public function get()
    {
        return $this->sValueValue;
    }

    protected function checkIsRemote()
    {
        if (str_contains($this->sValueValue, 'http')) {
            $this->bIsRemote = true;
        }
    }

    protected function checkIsImage()
    {
        if (str_contains($this->sValueValue, self::IMAGE_EXTENSIONS)) {
            $this->bIsImage = true;
        }
    }

    protected function downloadRemoteImage()
    {
        if (!$this->bIsImage) {
            return;
        }

        try {
            $file = new \System\Models\File;
            $file->fromUrl($this->sValueValue);
            $file->save();

            $this->sValueValue = 'app/' . $file->getDiskPath();
        } catch (\Exception $obException) {
            \Log::notice('Could not download image ' . $this->sValueValue . ' while importing');
        }
    }

}