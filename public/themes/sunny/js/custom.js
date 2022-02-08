

function backToTop() {
    document.writeln('<script type="text/javascript">$(function(){$("#floatPanel > .ctrlPanel > a.arrow").eq(0).click(function(){$("html,body").animate({scrollTop :0}, 800);return false;});$("#floatPanel > .ctrlPanel > a.arrow").eq(1).click(function(){$("html,body").animate({scrollTop : $(document).height()}, 800);return false;});});</script>');
    document.writeln("<!--浮动面板-->");
    document.writeln('<div id="floatPanel"><div class="ctrlPanel"><a class="arrow" href="#"><span>顶部</span></a><a class="arrow" href="#"><span>底部</span></a></div></div>');
}