export default {
    info(url = '') {
        let extension = url.slice(url.lastIndexOf('.') + 1, url.length),
            type = null;

        switch (extension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
            case 'webp':
            case 'svg':
                type = 'image';
                break;
            case 'mp3':
            case 'ogg':
                type = 'audio';
                break;
            case 'mp4':
                type = 'video';
                break;
        }

        return {
            type: type,
            mimeType: type ? (type + '/' + extension) : type,
        };
    },
};