<?php

namespace App\Services\EditorFormatter;

class EditorContentFormatterService
{

    /**
     * Constructor receive a string with all the description of a task, with html tags etc.
     */
    public function __construct(public String $content)
    {
    }

    /**
     * Get all Base 64 Files from content. 
     * Ex: <img src="[10000char...]" />/>
     * 
     * @return array
     */
    public function getBase64FilesFromContent(): array
    {
        $pattern = "/<img\s+src='data:([^;]+);base64,([^'']+)'\s*\/?>/i";
        preg_match_all($pattern, $this->content, $matches);

        $result = [];
        foreach ($matches[1] as $index => $mimeType) {
            $extension = substr($mimeType, strrpos($mimeType, '/') + 1);

            $result[] = array(
                "file" => $matches[2][$index],
                "extension" => $extension,
            );
        }

        return $result;
    }

    /**
     * Get all text without any base64 content
     * 
     * @return string
     */
    public function getContentWithoutBase64(): string
    {
        $pattern = "/<figure class='image'><img src='data:([^;]+);base64,[^']+'[^>]*><\/figure>/i";
        $textOnly = preg_replace($pattern, '', $this->content);

        return $textOnly;
    }

}
