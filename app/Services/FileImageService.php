<?php

class FileImageService
{
    private string $imagePath = __DIR__ . '/../../public/images/';

    public function __construct()
    {
        if (!file_exists($this->imagePath)) {
            mkdir($this->imagePath);
        }
    }

    public function upload(array $image, $dir) : bool
    {
        $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $imageName = uniqid() . '.' . $imageExtension;
        $imagePath = $this->imagePath . $dir . '/' . $imageName;
        return move_uploaded_file($image['tmp_name'], $imagePath);
    }


    public function delete(string $imageName) : bool
    {
        $imagePath = $this->imagePath . $imageName;
        if (file_exists($imagePath)) {
            return unlink($imagePath);
        }
        return false;
    }
}
