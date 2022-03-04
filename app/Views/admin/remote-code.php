<div class="container main">

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-cloud"></i> 远程写</h3>
    </div>

    <form>
        <div class="row">
            <div class="form-label col-md-2 col-xs-12">交互码</div>
            <div class="form-input col-md-10 col-xs-12">
                <input type="text" class="form-control" name="id" value="<?= $code ?>" readonly/>
            </div>
        </div>
        <div class="row">
            <div class="form-label col-md-2 col-xs-12">过期时间</div>
            <div class="form-input col-md-10 col-xs-12">
                <input type="text" class="form-control" name="id" value="<?= $expire_time ?>" readonly/>
            </div>
        </div>
    </form>
</div>
