<div class="myWrapper">
    <div>
        <div>List item 1</div>
        <div>List item 2</div>
        <div>List item 3</div>
        <div>List item 4</div>
    </div>
</div>

<?php

$js = <<<JS
$(document).ready(function(){
    
    $('.myWrapper').easyTicker({
        direction: 'up',
        easing: 'swing',
        speed: 'slow',
        interval: 2000,
        height: 'auto',
        visible: 0,
        mousePause: true,
        autoplay: true,
        controls: {
            up: '',
            down: '',
            toggle: '',
            playText: 'Play',
            stopText: 'Stop'
        },
        callbacks: {
            before: false,
            after: false,
            finish: false
        }
    });

});
JS;

$this->registerJs($js);
