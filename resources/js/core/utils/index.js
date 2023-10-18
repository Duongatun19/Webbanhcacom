export function isMobile() {
    try {
        if (typeof (navigator !== 'undefined')) {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                return true;
            }
        }
    } catch (e) { }
    return false;
}

export function isAndroid() {
    try {
        if (typeof (navigator !== 'undefined')) {
            var ua = navigator.userAgent.toLowerCase();
            var isAndroid = ua.indexOf("android") > -1;
            if (isAndroid) {
                return true;
            }
        }
    } catch (e) { }
    return false;
}

export function isIOS() {
    try {
        if (typeof (navigator !== 'undefined')) {
            var iOS = !!navigator.platform && /iPad|iPhone|iPod/i.test(navigator.platform);
            if (iOS) {
                return iOS;
            }
        }
    } catch (e) { }
    return false;
}

export function getCookie(cname, req) {
    let name = cname + "="
    let decodedCookie
    if (typeof window === 'undefined') decodedCookie = decodeURIComponent(req.headers.cookie)
    else decodedCookie = decodeURIComponent(document.cookie)
    var ca = decodedCookie.split(';')
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i]
        while (c.charAt(0) == ' ') {
            c = c.substring(1)
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length)
        }
    }
    return "";
}

export function getCookieByName(name) {
    var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
    return v ? v[2] : null;
}
export function setCookie(name, value, days) {
    var d = new Date;
    d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days);
    document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
}
export function deleteCookie(name) { setCookie(name, '', -1); }

export function getOrientation(file, callback) {
    var reader = new FileReader();

    reader.onload = function (event) {
        var view = new DataView(event.target.result);

        if (view.getUint16(0, false) != 0xFFD8) return callback(-2);

        var length = view.byteLength,
            offset = 2;

        while (offset < length) {
            var marker = view.getUint16(offset, false);
            offset += 2;

            if (marker == 0xFFE1) {
                if (view.getUint32(offset += 2, false) != 0x45786966) {
                    return callback(-1);
                }
                var little = view.getUint16(offset += 6, false) == 0x4949;
                offset += view.getUint32(offset + 4, little);
                var tags = view.getUint16(offset, little);
                offset += 2;

                for (var i = 0; i < tags; i++)
                    if (view.getUint16(offset + (i * 12), little) == 0x0112)
                        return callback(view.getUint16(offset + (i * 12) + 8, little));
            }
            else if ((marker & 0xFF00) != 0xFF00) break;
            else offset += view.getUint16(offset, false);
        }
        return callback(-1);
    };

    reader.readAsArrayBuffer(file.slice(0, 64 * 1024));
};

export function resetOrientation(srcBase64, srcOrientation, callback) {
    var img = new Image();

    img.onload = function () {
        var width = img.width,
            height = img.height,
            canvas = document.createElement('canvas'),
            ctx = canvas.getContext("2d");

        // set proper canvas dimensions before transform & export
        if (4 < srcOrientation && srcOrientation < 9) {
            canvas.width = height;
            canvas.height = width;
        } else {
            canvas.width = width;
            canvas.height = height;
        }

        // transform context before drawing image
        switch (srcOrientation) {
            case 2: ctx.transform(-1, 0, 0, 1, width, 0); break;
            case 3: ctx.transform(-1, 0, 0, -1, width, height); break;
            case 4: ctx.transform(1, 0, 0, -1, 0, height); break;
            case 5: ctx.transform(0, 1, 1, 0, 0, 0); break;
            case 6: ctx.transform(0, 1, -1, 0, height, 0); break;
            case 7: ctx.transform(0, -1, -1, 0, height, width); break;
            case 8: ctx.transform(0, -1, 1, 0, 0, width); break;
            default: break;
        }

        // draw image
        ctx.drawImage(img, 0, 0);

        // export base64
        callback(canvas.toDataURL());
    };

    img.src = srcBase64;
};