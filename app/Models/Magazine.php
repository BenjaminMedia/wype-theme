<?php

namespace App\Models;

class Magazine
{
    /** @var string|null */
    private $brandCode;
    /** @var string|null */
    private $title;

    public function __construct(\stdClass $magazine)
    {
        if ($brandCode = data_get($magazine, 'PubCode')) {
            $this->brandCode = $brandCode;
        }
        if ($title = data_get($magazine, 'Title')) {
            $this->title = $title;
        }
    }

    /**
     * @return null|string
     */
    public function getBrandCode(): ?string
    {
        return $this->brandCode;
    }

    /**
     * @param null|string $brandCode
     * @return Magazine
     */
    public function setBrandCode(?string $brandCode): Magazine
    {
        $this->brandCode = $brandCode;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     * @return Magazine
     */
    public function setTitle(?string $title): Magazine
    {
        $this->title = $title;
        return $this;
    }
}
