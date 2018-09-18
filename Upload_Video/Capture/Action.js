/**
 * @return {string}
 */
var dataURL = [];

function CaptureVideoURL(Video_ID, Format, Screenshot_ID) {

    var video = document.getElementById(Video_ID);
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');

    video.addEventListener('loadedmetadata', function () {
        var ratio = video.videoWidth / video.videoHeight;
        var w = video.videoWidth - 100;
        var h = parseInt(w / ratio, 10);
        canvas.width = w;
        canvas.height = h;
    }, false);

    context.fillRect(0, 0, canvas.width, canvas.height);
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    dataURL[Screenshot_ID] = canvas.toDataURL('image/' + Format);

    return dataURL[Screenshot_ID];
}

function getCookie(cname) {
    var name = cname + '=';
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function CaptureSave(SaveID) {
    var SelectDataURL = dataURL[SaveID];
    var data = SelectDataURL.split(',')[1];
    var mimeType = dataURL[SaveID].split(';')[0].slice(5);
    var bytes = window.atob(data);
    var buf = new ArrayBuffer(bytes.length);
    var arr = new Uint8Array(buf);
    var blob;
    var name = getCookie('Video_ID') + '.png';

    for (var i = 0; i < bytes.length; i++) {
        arr[i] = bytes.charCodeAt(i);
    }

    blob = new Blob([arr], {type: mimeType});
    var formData = new FormData();

    formData.append('Screenshot', blob, name);

    $.ajax({
        url: 'action.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false
    });
}

