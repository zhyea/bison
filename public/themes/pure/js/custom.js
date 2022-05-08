function goToTop() {
    $("html,body").animate({scrollTop: 0}, 80);
    return false;
}

function goToBottom() {
    $("html,body").animate({
        scrollTop: $(document).height()
    }, 80);
    return false;
}