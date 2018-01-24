<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table =  'article';
    protected $primaryKey=  'id';
    public $timestamps=false;
    protected $guarded = [];

    public function tree()
    {
        $article = $this->all();
        return  $this->gettrue($article,'article_title','id','article_fid');
    }

    public function gettrue($data,$name,$id,$fid,$a=0){
        $arr = array();
        foreach ($data as $k=>$v){
            if($v->$fid == $a){
                $data[$k]["_".$name] = $data[$k][$name] ;
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$fid == $v->$id){
                        $data[$m]["_".$name] = "|—".$data[$m][$name] ;
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
