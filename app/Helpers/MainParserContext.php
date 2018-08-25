<?php

namespace App\Helpers;

class MainParserContext
{
    /** @var string $url */
    protected $url;

    /**
     * MainParserContext constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return MainParserContext
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
