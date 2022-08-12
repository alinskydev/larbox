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
                language: this.booted.locale,
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
                        'fontfamily fontsize styles',
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

                            this.booted.helpers.http.send(this, {
                                method: 'POST',
                                path: 'storage/upload/media',
                                body: formData,
                            }).then((response) => {
                                if (response.statusType === 'success') {
                                    callback(response.data.absolute);
                                }
                            });
                        };

                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
                images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                    let formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    this.booted.helpers.http.send(this, {
                        method: 'POST',
                        path: 'storage/upload/media',
                        body: formData,
                    }).then((response) => {
                        if (response.statusType === 'success') {
                            resolve(response.data.absolute);
                        }
                    });
                }),

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
            for (let key in this.booted.languages.all) {
                tinymce.init({
                    ...{ selector: '#' + this.item.id + '-' + key },
                    ...this.pluginOptions,
                });
            }
        } else {
            tinymce.init({
                ...{ selector: '#' + this.item.id },
                ...this.pluginOptions,
            });

        }
    },
};
</script>

<template>
    <textarea></textarea>
</template>