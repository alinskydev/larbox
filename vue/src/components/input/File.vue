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
            options: this.item.options,
            inputOptions: this.item.options.file ?? {},
            items: [],
            oldFilesName: null,
            oldFiles: [],
            fileInputOptions: {
                initialPreviewAsData: true,
                showCaption: false,
                showUpload: false,
                showRemove: false,
                showDelete: false,
                showCancel: false,
                showClose: false,
                browseOnZoneClick: true,

                overwriteInitial: this.item.options.file?.willOverride ?? !this.item.options.isMultiple,

                browseClass: 'btn btn-primary w-100',
                browseIcon: '<i class="fas fa-folder-open"></i>',
                browseLabel: App.t('Выбрать файл'),

                fileActionSettings: {
                    showDrag: Boolean(this.item.options.file?.showDrag),
                    dragClass: 'btn btn-outline-primary w-auto h-auto m-0',
                    dragIcon: '<i class="fas fa-arrows-alt"></i>',
                    zoomClass: 'btn btn-info',
                    zoomIcon: '<i class="fas fa-search-plus"></i>',
                    downloadClass: 'btn btn-primary',
                    downloadIcon: '<i class="fas fa-cloud-download-alt"></i>',
                    removeClass: 'btn btn-danger',
                    removeIcon: '<i class="fas fa-trash-alt"></i>',
                },
                previewZoomButtonClasses: {
                    prev: 'btn btn-navigate btn-secondary',
                    next: 'btn btn-navigate btn-secondary',
                },
                previewZoomButtonIcons: {
                    prev: '<i class="fas fa-caret-left"></i>',
                    next: '<i class="fas fa-caret-right"></i>',
                    toggleheader: '<i class="far fa-window-maximize"></i>',
                    fullscreen: '<i class="fas fa-compress"></i>',
                    borderless: '<i class="fas fa-arrows-alt"></i>',
                    close: '<i class="fas fa-times"></i>',
                },

                layoutTemplates: {
                    actions: [
                        '{drag}<div class="file-actions">',
                        '<div class="file-footer-buttons">{zoom} {download}',
                        this.item.options.file?.showDelete ? ' {delete}' : '',
                        '</div></div>',
                    ].join(''),
                },

                ajaxDeleteSettings: {
                    type: 'GET',
                },
            },
        };
    },
    created() {
        if (this.item.name.match(/]$/)) {
            this.oldFilesName = this.item.name.replace(/]$/, '_old_keys]');
        } else {
            this.oldFilesName = this.item.name + '_old_keys';
        }

        if (this.item.value) {
            this.oldFiles = this.item.options.isMultiple ? Object.keys(this.item.value) : ['0'];
        } else {
            this.oldFiles = [];
        }
    },
    mounted() {
        this.collectItems();

        this.fileInputOptions.initialPreview = this.items.map((value, key) => value.previewUrl);
        this.fileInputOptions.initialPreviewConfig = this.items;

        $('#' + this.item.elementId)
            .fileinput(this.fileInputOptions)
            .on('filesorted', (event, params) => {
                this.oldFiles = params.stack.map((value) => value.key);
                this.$forceUpdate();
            })
            .on('filedeleted', (event, key) => {
                let oldKey = this.oldFiles.indexOf(key.toString());
                if (oldKey !== -1) this.oldFiles.splice(oldKey, 1);

                this.$forceUpdate();
            });
    },
    methods: {
        collectItems() {
            let items = [],
                value = this.item.value;

            if (!value) return;

            if (!this.options.isMultiple) {
                value = [value];
            }

            for (let key in value) {
                let file = value[key],
                    previewUrl = App.helpers.iterator.get(file, this.inputOptions.previewPath),
                    downloadUrl = App.helpers.iterator.get(file, this.inputOptions.downloadPath),
                    fileInfo = App.helpers.file.info(downloadUrl);

                items[key] = {
                    key: key,
                    caption: App.t('Файл №:index', { index: parseInt(key) + 1 }),
                    type: fileInfo.type ?? 'html',
                    filetype: fileInfo.mimeType,
                    previewUrl: previewUrl,
                    downloadUrl: downloadUrl,
                    url: App.config.http.url + '/../common/empty',
                };
            }

            this.items = items;
        },
    },
};
</script>

<template>
    <input v-bind="$attrs" type="file" :multiple="options.isMultiple" />
    <input type="hidden" :name="oldFilesName" :value="'[' + oldFiles + ']'" />
</template>
