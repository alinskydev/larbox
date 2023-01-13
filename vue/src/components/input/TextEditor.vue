<script setup>
import App from '@/core/app';
</script>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            pluginOptions: {
                language: App.locale,
                height: '500px',

                relative_urls: false,
                convert_urls: false,
                paste_data_images: true,

                verify_html: false,
                forced_root_block: 'div',
                table_style_by_css: true,

                font_size_formats: '8px 10px 12px 14px 16px 18px 24px 36px 48px',

                menubar: false,
                plugins: [
                    'advlist autolink lists link charmap anchor',
                    'searchreplace visualblocks code fullscreen',
                    'table',
                    'media image',
                ].join(' '),
                toolbar: [
                    [
                        'undo redo',
                        'fontsize styles',
                        'removeformat bold italic underline strikethrough superscript subscript',
                        'forecolor backcolor',
                    ].join('|'),
                    [
                        'outdent indent',
                        'alignleft aligncenter alignright alignjustify',
                        'bullist numlist table',
                        'link anchor image media charmap',
                        'searchreplace visualblocks code fullscreen',
                    ].join('|'),
                ],

                file_picker_callback: (callback, value, meta) => {
                    let input = document.createElement('input');
                    input.setAttribute('type', 'file');

                    input.onchange = () => {
                        let file = input.files[0],
                            reader = new FileReader();

                        reader.onload = () => {
                            let formData = new FormData();
                            formData.append('file', file, file.name);

                            App.helpers.http
                                .send({
                                    method: 'POST',
                                    path: 'storage/upload/media',
                                    body: formData,
                                })
                                .then((response) => {
                                    if (response.statusType === 'success') {
                                        callback(response.data.url);
                                    }
                                });
                        };

                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
                images_upload_handler: (blobInfo, progress) => {
                    return new Promise((resolve, reject) => {
                        let formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());

                        App.helpers.http
                            .send({
                                method: 'POST',
                                path: 'storage/upload/media',
                                body: formData,
                            })
                            .then((response) => {
                                if (response.statusType === 'success') {
                                    resolve(response.data.url);
                                } else {
                                    reject({
                                        message: response.data.message,
                                        remove: true,
                                    });
                                }
                            });
                    });
                },
                setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave();
                    });
                },
            },
        };
    },
    mounted() {
        if (this.item.options.isLocalized) {
            for (let key in App.languages.all) {
                tinymce.init({
                    ...this.pluginOptions,
                    ...{ selector: '#' + this.item.elementId + '-' + key },
                });
            }
        } else {
            tinymce.init({
                ...this.pluginOptions,
                ...{ selector: '#' + this.item.elementId },
            });
        }
    },
};
</script>

<template>
    <textarea></textarea>
</template>
