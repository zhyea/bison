<?php if (!empty($recommend)) { ?>
    <div class="row recommend">
        <?php foreach ($recommend as $r) { ?>
            <div class="item ">
                <div class="cover">
                    <a href="<?= $siteUrl ?>/work/<?= $r['id'] ?>.html">
                        <img src="<?= $uriUpload . '/' . $r['cover'] ?>" width="126px" height="176px" loading="lazy"/>
                    </a>
                    <div class="remark"><a href="<?= $siteUrl ?>/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a></div>
                </div>
            </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
<?php } ?>