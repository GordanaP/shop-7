<?php

namespace App\Utilities\Images;

use Storage;

abstract class CustomImage
{
    private $disk;
    private $relationship;
    private $pathAttribute = 'path';

    protected abstract function manage($model, $data);

    protected function handle($image, $data = null)
    {
        if($data) {
            $image == null ? $this->add($data) : $this->update($image, $data);
        }
    }

    public function getUrl($image = null)
    {
        $pathAttribute = $this->pathAttribute;

        return Storage::url(optional($image)->$pathAttribute);
    }

    public function removeStoragePath($image = null)
    {
        $pathAttribute = $this->pathAttribute;

        Storage::delete(optional($image)->$pathAttribute);
    }

    protected function setDisk($disk)
    {
        $this->disk = $disk;

        return $this;
    }

    protected function setRelationship($relationship)
    {
        $this->relationship = $relationship;

        return $this;
    }



    private function update($image, $data)
    {
        $this->removeStoragePath($image);

        $this->save($image, $data);
    }

    private function save($image, $data)
    {
        $pathAttribute = $this->pathAttribute;

        $image->$pathAttribute = $this->makeStoragePath($data);

        $image->save();
    }

    private function add($data)
    {
        $this->relationship->create($this->path($data));
    }

    protected function path($data)
    {
        return [
            $this->pathAttribute => $this->makeStoragePath($data)
        ];
    }

    private function makeStoragePath($data = null)
    {
        return optional($data)->store($this->disk);
    }
}