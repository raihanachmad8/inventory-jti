<?php

class FileImageService
{
    private string $imagePath = __DIR__ ;

    public function __construct(string $imagePath = '/../../public/assets/images/')
    {
        $this->imagePath .= $imagePath;
    }

    public function upload(string $dir, string $imageName, array $image) : bool
    {
        $path = $this->imagePath .  $dir;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $path .= '/' . $imageName;
        return move_uploaded_file($image['tmp_name'], $path);
    }


    public function delete(string $dir, string $imageName) : bool
    {
        $path = $this->imagePath . $dir .'/' . $imageName;
        if (file_exists($path)) {
            return unlink($path);
        }
        return false;
    }

    private function generateRandomName($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function randomImageName(array $image)
    {
        $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $imageName = $this->generateRandomName() . '-' . $this->generateRandomName(16) . '.' . $imageExtension;
        return $imageName;
    }

    public function getPathImage(string $dir, string $imageName)
    {
        return $this->imagePath . $dir . '/' . $imageName;
    }
}
