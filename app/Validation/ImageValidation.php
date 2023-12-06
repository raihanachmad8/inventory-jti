<?php

require_once __DIR__ . '/Validation.php';

class ImageValidation extends Validation
{
    private array $allowedExtensions = ['jpg', 'jpeg', 'png'];
    private int $maxSize = 5 * 1024 * 1024;
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        if (!isset($this->request['image']) || $this->request['image'] === '') {
            $this->addError('image', 'Image is required');
        }

        if (empty($this->errors)) {
            $this->validateImage();
        }

        return $this;
    }

    private function validateImage()
    {
        $image = $this->request['image'];
        $imageExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $imageSize = $image['size'];

        if (!in_array($imageExtension, $this->allowedExtensions)) {
            $this->addError('image', 'Image must be a valid image.');
        }

        if ($imageSize > $this->maxSize) {
            $this->addError('image', 'Image must be less than 5MB.');
        }
    }


}
