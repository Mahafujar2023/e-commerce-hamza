<?php
namespace App\Helper;

class ImageUpload{
    public static function handleFileUpload($request, $fieldName, $object, $property, $destination)
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $uniqueFilename = md5(uniqid() . $originalName) . '.' . $extension;
            
            $image->move(public_path($destination), $uniqueFilename);

            $object->$property = $uniqueFilename;
        } else {
            $object->$property = '';
        }
    }
}



?>
