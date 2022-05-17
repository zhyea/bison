<div class="notice">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $siteUrl ?>/">首页</a></li>
            <li class="breadcrumb-item">专题</li>
            <li class="breadcrumb-item active"><?= $feature['name'] ?></li>
        </ol>
    </nav>
</div>

<div class="main">
    <div class="work-block">
        <div class="work-header">
            <span class="title">
                <?php iconTitle('book', '#255625', $feature['name']); ?>
            </span>
        </div>
        <div class="row work-neck">
            <?= empty($feature['brief']) ? '无专题信息，待完善' : $feature['brief'] ?>
        </div>
    </div>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-book"></i>&nbsp;作品列表</h3>
    </div>

    <?php include_once 'work-show.php'; ?>

    <div class="pagination">
        <a>共 <?= $total ?> 页</a>
        <?php for ($i = 1; $i <= $total; $i++) { ?>
            <a href="<?= $siteUrl ?>/f/<?= $feature['alias'] ?>/<?= $i ?>.html"
               class="<?= ($page == $i ? 'active' : '') ?>"><?= $i ?></a>
        <?php } ?>
    </div>
</div>