<?php
$this->setFrameMode(true);
?>

<?if(count($arResult['ITEMS']) > 0):?>
    <section class="instagram-wrapper section">
       <div class="container">
            <h2 class="section__title">Наш <span>Instagram</span></h2>
            <div class="instagram">
                <?foreach($arResult['ITEMS'] as $arItem):?>
                    <div class="instagram__item">
                        <a href="<?=$item['permalink']?>" target="_blank">
                            <img src="<?=$item['media_url']?>" alt="">
                        </a>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </section>
<?endif?>