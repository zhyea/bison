<div class="notice">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $siteUrl ?>/">首页</a></li>
            <li class="breadcrumb-item active">全部作者</li>
        </ol>
    </nav>
</div>

<div class="main">
    <div class="work-body">
        <?php foreach ($all as $key => $value) { ?>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 volume">
                    <i class="glyphicon glyphicon-bookmark"></i> <?= $key ?>
                </div>
                <?php foreach ($value as $author) { ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 chapter">
                        <a href="<?= $siteUrl ?>/author/<?= $author['id'] ?>.html"><?= $author['name'] ?></a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
