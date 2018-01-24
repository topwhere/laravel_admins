<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table =  'picture';
    protected $primaryKey=  'id';
    public $timestamps=false;
    protected $guarded = [];


    public function upload($file)
    {
        $entrnsion = $file->getClientOriginalExtension();//获取上传文件后缀
        $newName = date('YmdHis').mt_rand(100,999).'.'.$entrnsion;
        $data['why'] = $file->move(public_path().'/uploads/',$newName);//移动文件到某一目录并重命名
        $data['newName'] = $newName;
        return $data;
    }
}
