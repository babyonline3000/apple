<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Apple App';
?>
<div class="site-index">
    <p style="text-align: center;margin-top: 10%;font-size: 100px">Go to apple-world</p>
</div>

<?php
$js = <<<JS
    $( document ).ready(function(){
        (function iterator(){
            $('div p')
            .animate({
                opacity: 0}, 1500)
            .delay(2000)
            .animate({
                opacity: 1}, 1500, iterator)
            .delay(2000)}());
    });
JS;
$this->registerJs($js);
?>