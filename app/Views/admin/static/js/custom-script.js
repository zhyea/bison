/**
 * 发送app相关请求
 */
function sendBootstrapTableRequest(table, method, url, data, successCallback, failedCallback) {
    $.ajax({
        type: method,
        contentType: "application/json",
        url: url,
        async: true,
        data: JSON.stringify(data),
        timeout: 6 * 1000,
        success: function (result) {
            if (result) {
                table.bootstrapTable('refresh');
                if (successCallback) {
                    successCallback(result);
                }
            }
        },
        error: function (xhr, state, errMsg) {
            console.log("操作失败:" + xhr.responseText);
            if (failedCallback) {
                failedCallback();
            }
        }
    });
}