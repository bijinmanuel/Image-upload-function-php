<?php
function check_image_properties($size,$extension,$min_size,$max_size) {
    if ($size < $min_size) {
        return "Image size should be minimum of ".$min_size;
    }
    if ($size > $max_size) {
        return "Image size should be maximum of ".$max_size;
    }
    if(!(in_array($extension,ALLOWED_EXTENSIONS))) {
        return "Image type is not supported";
    }
    return true;
}
function upload_image($img,$upload_path,$min_size,$max_size) {
    $img_name = $img['name'];
    $img_type = $img['type'];
    $img_tmp_name = $img['tmp_name'];
    $img_size = $img['size'];
    $img_extension = explode('.',$img_name);
    $img_correct_extension = strtolower(end($img_extension));
    
    $check_result = check_image_properties($img_size,$img_correct_extension,$min_size,$max_size);
    if($check_result === true)
    {   
        if (move_uploaded_file($img_tmp_name,$upload_path)) {
            set_message(display_success("Image uploaded successfully"));
            return true;
        }
        return "Failed to upload image";
    }
    else {
        set_message(display_error($check_result));
        return $check_result;
    }
}
?>