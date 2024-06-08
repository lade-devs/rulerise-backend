<?php

namespace App\Support;

class HelperSupport
{
    public static function snake_to_camel($input, $capitalizeFirstCharacter = false)
    {
        if(! is_array($input)){
            $str = str_replace('_', '', ucwords($input, '-'));

            return $capitalizeFirstCharacter ? lcfirst($str) : $str;
        }
        $newInput = array();

        foreach ($input as $key => $inputs){
            $str = str_replace('_', '', ucwords($key, '_'));
            $str = ! $capitalizeFirstCharacter ? lcfirst($str) : $str;
            $newInput[$str] = $inputs;
        }

        return $newInput;
    }

    public static function getMimeTypeFromBase64($base64String) {
        // Split the base64 string
        $data = explode(',', $base64String);

        // Check if the data contains the MIME type
        if (isset($data[0]) && preg_match('/data:([a-zA-Z0-9\/]+);base64/', $data[0], $matches)) {
            return $matches[1];
        }

        return null;
    }

    public static function getFileExtensionFromMimeType($mimeType) {
        // Get the extension from the MIME type
        $extensions = [
            'image/jpeg' => 'jpeg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'application/pdf' => 'pdf',
        ];

        return $extensions[$mimeType] ?? null;
    }
}
