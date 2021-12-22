<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Uploader
{
    public static function uploadToS3($path, $file, $filename = null){
        if(is_null($filename)){
            $file = Storage::disk('s3')->putFile($path, $file, 'public');
        }else{
            $file = Storage::disk('s3')->putFileAs($path, $file, $filename, 'public');
        }

        return env('S3_URL', 'https://s3-ap-southeast-1.amazonaws.com/').$file;
    }

    public static function uploadQrCodeToS3($output_file, $imageQrCode){
        Storage::disk('s3')->put($output_file, $imageQrCode, 'public');

        return env('S3_URL', 'https://s3-ap-southeast-1.amazonaws.com/').$output_file;
    }
}
?>