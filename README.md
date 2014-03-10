gbCaptcha
=========

make captcha code image per PHP and show it directly

![gbCaptcha](http://www.gravatar.com/userimage/62559707/093898d392ad09020dfcb953a7e3d9f3?size=120)

Usage
=====

```php
require_once('lib/gbCaptcha.php');

$cap = new gbCaptcha();
$cap->fromPng = '_resources/captcha.png';
$cap->font = '_resources/georgia.ttf';
$cap->fontSize = 18;
$cap->color = array(255, 78, 0);
$cap->shadow = true;
$cap->shadowDistance = 1;
$cap->colorShadow = array(0, 0, 0);
$cap->posX = 8;
$cap->posY = 30;
$cap->angleMin = -32;
$cap->angleMax = 32;
$cap->posMath = 5;
$cap->codeArr = array('1','2','3','4','5','6','7','8','9','0');
$code = $cap->setCode();
// $_SESSION['captcha'] = $code;
$cap->mkCaptcha();
```

show it directly in the HTML page:
```php
<img src="demo.php" alt="captcha" />
```