<div class="notice">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $siteUrl ?>/">首页</a></li>
            <li class="breadcrumb-item">作家</li>
            <li class="breadcrumb-item active"><?= $author['name'] ?></li>
        </ol>
    </nav>
</div>

<div class="main">
    <div class="work-block">
        <div class="work-header">
            <span class="title"><?= $author['name'] ?></span>
        </div>
        <div class="row work-neck">
            <?= (empty($author['bio']) ? '无作者信息，待完善' : $author['bio']) ?>
        </div>
    </div>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-book"></i>&nbsp;作品列表</h3>
    </div>

    <?php include_once 'work-show.php'; ?>

    <div class="pagination">
        <a>共 <?= $total ?> 页</a>
        <?php for ($i = 1; $i <= $total; $i++) { ?>
            <a href="<?= $siteUrl ?>/author/<?= $author['id'] ?>/<?= $i ?>.html"
               class="<?= ($page == $i ? 'active' : '') ?>"><?= $i ?></a>
        <?php } ?>
    </div>
</div>
