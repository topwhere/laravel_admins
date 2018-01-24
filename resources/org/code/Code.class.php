<?php
class Code{
    //随机因子
    private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';
    //验证码
    private $code;
    //验证码长度
    private $codeLen = 4;
    //图片宽度
    private $width = 160;
    //图片高度
    private $height = 40;
    //图片
    private $img;
    //ttf字体
    private $font;
    //字体大小
    private $fontSize = 20;
    //字体颜色
    private $fontColor;
    //线条间隔
    private $lineSpace = 10;
    //星号数量
    private $asteriskNum = 20;
    //构造函数
    public function __construct()
    {
        $this->font = __DIR__ . '/Solomon.ttf';
    }
    //生成验证码

    /**
     *
     */
    private function createCode(){

        $_len = strlen($this->charset);
        for($i = 0;$i < $this->codeLen;$i++){
            $this->code .= $this->charset[mt_rand(0,$_len-1)];
            $_SESSION['code']=$this->code;
        }
    }
    //生成背景图片
    private function createBg(){
        $this->img = imagecreatetruecolor($this->width,$this->height);
        $color = imagecolorallocate($this->img,mt_rand(157,255),mt_rand(157,255),mt_rand(157,255));
        imagefilledrectangle($this->img,0,0,$this->width,$this->height,$color);
    }
    //验证码写入图片
    private function createFont(){
        $_x = $this->width / $this->codeLen;
        for($i = 0;$i<$this->codeLen;$i++){
            $this->fontColor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imagettftext($this->img,$this->fontSize,mt_rand(-30,30),$_x*$i + mt_rand(3,5),$this->height/1.4,$this->fontColor,$this->font,$this->code[$i]);
        }
    }
    //干扰线条和星号
    private function createLine(){
        $_x = $this->width / $this->lineSpace;
        $_y = $this->height / $this->lineSpace;
        for($i = 0;$i < $_x;$i++){
            $color = imagecolorallocate($this->img,200,200,200);
            imageline($this->img,$this->lineSpace * $i,0,$this->lineSpace * $i,$this->height,$color);
        }
        for ($i = 0;$i<$_y;$i++){
            $color = imagecolorallocate($this->img,200,200,200);
            imageline($this->img,0,$this->lineSpace * $i,$this->width,$this->lineSpace * $i,$color);
        }
        for ($i = 0;$i<$this->asteriskNum;$i++){
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($this->img,6,mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
        }
    }
    //输出图片到浏览器
    private function outPut(){
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }
    //外部调用接口
    public function make(){
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPut();
        return $this->code;
    }
    //校验验证码
    public function get(){
        return $_SESSION['code'];
    }
}
?>