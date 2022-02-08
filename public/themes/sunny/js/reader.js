let system = {
    win: false,
    mac: false,
    xll: false
};
//检测平台
let p = navigator.platform;
system.win = p.indexOf("Win") == 0;
system.mac = p.indexOf("Mac") == 0;
system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);

//改变阅读背景、字体大小和颜色的javascript
let ReadSet = {
    backgroundColor: ["#e7f4fe", "#FBFBB0", "#efefef", "#fcefff", "#ffffff", "#eefaee"],
    colorName: ["淡蓝海洋", "明黄淡雅", "灰色世界", "红粉世家", "白雪天地", "绿意春色"],
    backgroundColorValue: "#ffffff",
    fontColor: ["#333333", "#ff0000", "#008000", "#0000ff"],
    fontColorName: ["黑色", "红色", "绿色", "蓝色"],
    fontColorValue: "#008000",
    fontSize: ["14px", "16px", "18px", "20px", "24px"],
    fontSizeName: ["很小", "较小", "中等", "较大", "很大"],
    fontSizeValue: "16px",
    contentId: "contentContainer",
    fontSizeId: "contentText",
    SetBackgroundColor: function (color) {
        //document.bgColor = color;
        document.getElementById(this.contentId).style.backgroundColor = color;
        if (this.backgroundColorValue != color) this.SetCookies("backgroundColor", color);
        this.backgroundColorValue = color;
    },
    SetFontcolor: function (color) {
        document.getElementById(this.fontSizeId).style.color = color;
        if (this.fontColorValue != color) this.SetCookies("fontColor", color);
        this.fontColorValue = color;
    },
    SetFontsize: function (size) {
        document.getElementById(this.fontSizeId).style.fontSize = size;
        if (this.fontSizeValue != size) this.SetCookies("fontSize", size);
        this.fontSizeValue = size;
    },
    LoadCSS: function () {
        let style = "";
        style += ".readSet{padding:6px;clear:both;line-height:20px;max-width:700px;margin:auto;}\n";
        style += ".readSet .rc{color:#333333;float:left;padding-left:20px;}\n";
        style += ".readSet a.ra{float:left;border:1px solid #cccccc;display:inline-block;width:16px;height:16px;margin-left:6px;overflow:hidden;}\n";
        style += ".readSet .rf{float:left;}\n";
        style += ".readSet .rt{padding:0px 5px;}\n";


        let styleObj = document.createElement('style');
        styleObj.type = 'text/css';
        styleObj.innerHTML = style;

        document.getElementsByTagName('HEAD').item(0).appendChild(styleObj);

    },

    Show: function () {
        let output;
        output = '<div class="readSet">';
        output += '<span class="rc">阅读背景:</span>';
        for (let i = 0; i < this.backgroundColor.length; i++) {
            output += '<a style="background-color: ' + this.backgroundColor[i] + '" class="ra" title="' + this.colorName[i] + '" onclick="ReadSet.SetBackgroundColor(\'' + this.backgroundColor[i] + '\')" href="javascript:;"></a>';
        }
        output += '<span class="rc">字体颜色:</span>';
        for (let i = 0; i < this.fontColor.length; i++) {
            output += '<a style="background-color: ' + this.fontColor[i] + '" class="ra" title="' + this.fontColorName[i] + '" onclick="ReadSet.SetFontcolor(\'' + this.fontColor[i] + '\')" href="javascript:;"></a>';
        }
        output += '<span class="rc">字体大小:</span><span class="rf">[';
        for (let i = 0; i < this.fontSize.length; i++) {
            output += '<a class="rt" onclick="ReadSet.SetFontsize(\'' + this.fontSize[i] + '\')" href="javascript:;">' + this.fontSizeName[i] + '</a>';
        }
        output += ']</span>';
        output += '<div style="font-size:0; clear:both;"></div></div>';

        document.write(output);
    },

    SetCookies: function (cookieName, cookieValue, expirehours) {
        let today = new Date();
        let expire = new Date();
        expire.setTime(today.getTime() + 3600000 * 356 * 24);
        document.cookie = cookieName + '=' + escape(cookieValue) + ';expires=' + expire.toGMTString() + '; path=/';
    },

    ReadCookies: function (cookieName) {
        let theCookie = '' + document.cookie;
        let idx = theCookie.indexOf(cookieName);
        if (idx == -1 || cookieName == '')
            return '';

        let idx0 = theCookie.indexOf(';', idx);
        if (idx0 == -1)
            idx0 = theCookie.length;
        return unescape(theCookie.substring(idx + cookieName.length + 1, idx0));
    },

    SaveSet: function () {
        this.SetCookies("backgroundColor", this.backgroundColorValue);
        this.SetCookies("fontColor", this.fontColorValue);
        this.SetCookies("fontSize", this.fontSizeValue);
    },

    LoadSet: function () {
        let tmpStr = this.ReadCookies("backgroundColor");
        if (tmpStr !== "") this.backgroundColorValue = tmpStr;
        this.SetBackgroundColor(this.backgroundColorValue);
        tmpStr = this.ReadCookies("fontColor");
        if (tmpStr !== "") this.fontColorValue = tmpStr;
        this.SetFontcolor(this.fontColorValue);
        tmpStr = this.ReadCookies("fontSize");
        if (tmpStr !== "") this.fontSizeValue = tmpStr;
        this.SetFontsize(this.fontSizeValue);
    }
};

function readerSet() {
    ReadSet.LoadCSS();
    ReadSet.Show();
}

function LoadReadSet() {
    ReadSet.LoadSet();
}
