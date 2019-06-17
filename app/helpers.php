<?php

//返回可读性更好的文件尺寸
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

//判断文件的MIME类型是否为图片
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

//如果为true则返回checked,checked() 方法用于在视图的复选框和单选框中设置 checked 属性。
function checked($value)
{
    return $value ? 'checked' : '';
}

//返回image头部url,page_image() 方法用于返回上传图片的完整路径。
function page_image($value = null)
{
    if (empty($value)){
        $value = config('blog.page_image');
    }
    if (! starts_with($value, 'http') && $value[0] !== '/'){
        $value = config('blog.uploads.webpath') . '/' . $value;
    }
    return $value;
}
