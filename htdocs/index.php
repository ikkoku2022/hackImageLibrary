<?php

    //定数読み込み
    require_once("../data/define.php");

    /**
    * ヴィトーリアグループ 第一回ハッカソン [4]画像モザイク処理--中-上級向け！　ライブラリあり
    * モザイク処理
    */
    class hackImageLibrary {
        function __construct() {

        }

        /**
        * フォーマットにあった画像を読み込む
        *
        * @param string $filepath 対象の画像ファイルパス
        * @return GdImage|false 読み込んだ画像
        */
        public function imageCreateFromAny($filepath) {

            $type = getimagesize($filepath);
            switch ($type[2]) {
                case IMAGETYPE_JPEG:
                    $original_image = imagecreatefromjpeg($filepath);
                    break;
                case IMAGETYPE_PNG:
                    $original_image = imagecreatefrompng($filepath);
                    break;
                case IMAGETYPE_GIF:
                    $original_image = imagecreatefromgif($filepath);
                    break;
                case IMAGETYPE_BMP;
                    $original_image = imageCreateFromBmp($filepath);
                    break;
                default:
                    return false;
            }
            return $original_image; 
        }

        /**
        * 画像にモザイク処理をして書き出す。
        *
        * @param string $filepath 対象の画像ファイルパス
        * @return image|false 読み込んだ画像
        */
        public function mosic($inputImg,$outputImg)
        {
            $img = $this->imageCreateFromAny($inputImg);
            if($img !== false) {
                //モザイク処理
                imagefilter($img, IMG_FILTER_PIXELATE, 30); 

                //画像の書き出し処理
                imagejpeg($img, $outputImg, 75); // save as jpeg

                //画像をメモリから開放します
                imagedestroy($img);

                return true;
            } else {
                return false;
            }
        }
    }


    //インスタンスの生成
    $hack = new hackImageLibrary;

    //モザイク処理
    if($hack->mosic(MATERIAL,CONVERT_MATERIAL)){
        echo "モザイク処理成功";
    } else {
        echo "モザイク処理失敗";
    }

?>
