<?php

namespace App\Helper;

class GlobalHelper
{
    public static function statusColor($status)
    {
        if ($status == 'Active') {
            $return_data = [
                'status_name' => ucfirst($status),
                'badge_class' => 'success',
            ];
        } elseif ($status == 'InActive') {
            $return_data = [
                'status_name' => ucfirst($status),
                'badge_class' => 'danger',
            ];
        } else {
            $return_data = [
                'status_name' => '',
                'badge_class' => '',
            ];
        }
        return $return_data;
    }

    public static function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
}
