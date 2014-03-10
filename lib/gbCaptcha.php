<?php
/**
 * erstellt ein captcha bild
 * 
 * @version 0.0.1
 * @author gb-media <github@gb-media.biz>
 * 
 */
class gbCaptcha {
	public $code;
	public $fromPng = false;
	public $font = false;
	public $fontSize = 11;
	public $strLen = 5;
	public $posX = 6;
	public $posY = 16;
	public $angleMin = 0;
	public $angleMax = 0;
	public $posMath = 2;
	public $color = array(0, 0, 0);
	public $shadow = false;
	public $shadowDistance = 1;
	public $colorShadow = array(255, 255, 255);
	public $codeArr = array ("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","m","n","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9");
	
	/**
	 * erstellt und zeigt das captcha bild
	 * 
	 * @return void
	 */
	public function mkCaptcha (){
		if (!$this->fromPng || !file_exists($this->fromPng) || !$this->font || !file_exists($this->font)){
			throw new Exception('Captcha error: no image or font set!');
		}
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
		header('Content-Type: image/png');
		$img = imagecreatefrompng ($this->fromPng);
		$captcha = ImageColorAllocate($img, $this->color[0], $this->color[1], $this->color[2]);
		$captchaShadow = ImageColorAllocate($img, $this->colorShadow[0], $this->colorShadow[1], $this->colorShadow[2]);
		$i_x = mt_rand(0,1);
		for($i=0;$i<strlen($this->code);$i++) {
			$i_fontsize = mt_rand(($this->fontSize-$this->posMath),$this->fontSize);
			$i_y = mt_rand(($this->posY-$this->posMath),($this->posY+$this->posMath));
			$i_x = $this->posX+(($this->fontSize+$this->posMath)*$i);
			$i_angle = rand( $this->angleMin, $this->angleMax );
			if($this->shadow){
				ImageTTFText ($img, $this->fontSize, $i_angle, $i_x+$this->shadowDistance, $i_y+$this->shadowDistance, $captchaShadow, $this->font, $this->code[$i]);	
			}
			ImageTTFText ($img, $this->fontSize, $i_angle, $i_x, $i_y, $captcha, $this->font, $this->code[$i]);
		}
		imagealphablending ($img,true);
		imageSaveAlpha($img, true);
		ImagePNG($img);
		ImageDestroy ($img);
	}
	
	/**
	 * generiert captcha code
	 * 
	 * @return string
	 */
	public function setCode (){
		shuffle ($this->codeArr);
		$this->code = implode(array_slice($this->codeArr, 0, $this->strLen));
		return $this->code;
	}
}

?>