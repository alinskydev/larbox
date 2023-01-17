export default class {
    info(url: string = '') {
        let extension = url.slice(url.lastIndexOf('.') + 1, url.length),
            type = null;

        switch (extension) {
            case 'gif':
            case 'jpg':
            case 'png':
            case 'svg':
            case 'webp':
                type = 'image';
                break;
            case 'ogg':
            case 'mp3':
                type = 'audio';
                break;
            case 'mp4':
                type = 'video';
                break;
        }

        return {
            type: type,
            mimeType: type ? type + '/' + extension : type,
        };
    }
}
