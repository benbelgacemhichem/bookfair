<?php

namespace App\Traits;

trait FileTrait
{
    public function uploadFile($file, $dist)
    {
        $originalFileName = $file->getClientOriginalName();
        $filename = md5(time()) . '_' . $originalFileName;
        $file->move(public_path($dist), $filename);
        $path = $dist . $filename;
        return $path;
    }
}
