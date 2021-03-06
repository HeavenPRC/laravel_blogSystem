<?php

namespace App\Handlers;

use Image;

class ImageUploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];
    /**
     * 上传图片
     * @param  [type]  $file        文件资源
     * @param  [type]  $folder      文件夹
     * @param  [type]  $file_prefix 用户id
     * @param  [type]  $maxF        限制上传文件大小
     * @param  boolean $max_width   规格
     * @return [type]               true false
     */
    public function save($file, $folder, $file_prefix, $maxF,$max_width = false, $roc = false)
    {
        //限制传输文件大小
        if ($file->getClientSize()>$maxF) {
            session()->flash('info', '请上传小于1M的图片');
            return false;
        }

        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym", time()) . '/'.date("d", time()).'/';

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $file->move($upload_path, $filename);

        // 如果限制了图片宽度，就进行裁剪
        if ($max_width && $extension != 'gif') {

            // 此类中封装的函数，用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width, $roc);
        }

        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }

    public function reduceSize($file_path, $max_width, $roc = false)
    {
        if (!$roc) {
            // 先实例化，传参是文件的磁盘物理路径
            $image = Image::make($file_path)->resize($max_width, $max_width);
        } else {
            // 进行大小调整的操作
    		$image = Image::make($file_path)->resize($max_width, null, function ($constraint) {

                // 设定宽度是 $max_width，高度等比例双方缩放
                $constraint->aspectRatio();

                // 防止裁图时图片尺寸变大
                $constraint->upsize();
            });
        }
        // 对图片修改后进行保存
        $image->save();
    }
}