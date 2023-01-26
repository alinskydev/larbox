<script setup>
import App from '@/core/app';
import { IndexConfig } from '@/core/crud/configs';
</script>

<script>
export default {
    props: {
        config: {
            type: IndexConfig,
            required: true,
        },
        type: {
            type: String,
            required: true,
        },
        pk: {
            type: [Number, String],
        },
    },
    data() {
        return {};
    },
    methods: {
        toggleHead(event) {
            let isChecked = $(event.target).prop('checked');

            $('.crud-index-data tbody .selection').prop('checked', isChecked);
            this.toggleBody();
        },
        toggleBody() {
            let totalCount = $('.crud-index-data tbody .selection').length,
                checkedCount = $('.crud-index-data tbody .selection:checked').length;

            $('.crud-index-data thead .selection').prop('checked', checkedCount === totalCount);

            if (checkedCount > 0) {
                $('.crud-index-data .actions').slideDown(300);
            } else {
                $('.crud-index-data .actions').slideUp(300);
            }
        },
        deleteMultipleAction() {
            this.sendRequest(this.config.http.path + '/delete/multiple?_method=DELETE', (selection) => {
                this.$parent.$data.models.forEach((model) => {
                    if (selection.includes(model.data.pk)) {
                        model.data.record.is_deleted = true;
                    }
                });
            });
        },
        restoreMultipleAction() {
            this.sendRequest(this.config.http.path + '/restore/multiple?_method=DELETE', (selection) => {
                this.$parent.$data.models.forEach((model) => {
                    if (selection.includes(model.data.pk)) {
                        model.data.record.is_deleted = false;
                    }
                });
            });
        },
        sendRequest(path, callback) {
            let formData = new FormData(),
                selection = Array.from(document.querySelectorAll('.crud-index-data tbody .selection:checked'), (e) =>
                    parseInt(e.value),
                );

            for (let key in selection) {
                formData.append('selection[]', selection[key]);
            }

            if (confirm(App.t('Вы уверены?'))) {
                App.helpers.http
                    .send({
                        method: 'POST',
                        path: path,
                        body: formData,
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            callback(selection);

                            $('.crud-index-data .selection').prop('checked', false);
                            this.toggleBody();
                        }
                    });
            }
        },
    },
};
</script>

<template>
    <template v-if="config.selection.actions.length > 0">
        <th v-if="type === 'tableHead'" style="width: 50px">
            <div class="form-check">
                <input type="checkbox" class="selection form-check-input" @change="toggleHead" />
            </div>
        </th>

        <th v-if="type === 'tableBody'">
            <div class="form-check">
                <input type="checkbox" :value="pk" class="selection form-check-input" @change="toggleBody" />
            </div>
        </th>

        <div v-if="type === 'actions'" class="actions card" style="display: none">
            <div class="card-header">
                {{ App.t('Действия') }}
            </div>

            <div class="card-body d-grid gap-2">
                <template v-for="action in config.selection.actions">
                    <button
                        v-if="
                            action === 'deleteMultiple' &&
                            !$route.query['show[deleted]'] &&
                            App.helpers.user.checkRoute(config.http.path + '/deleteMultiple')
                        "
                        class="btn btn-danger text-start"
                        @click="deleteMultipleAction"
                    >
                        <i class="fas fa-trash-alt me-1"></i>
                        {{ App.t('routeActions->deleteMultiple') }}
                    </button>

                    <button
                        v-if="
                            action === 'deleteMultiple' &&
                            $route.query['show[deleted]'] === 'only-deleted' &&
                            App.helpers.user.checkRoute(config.http.path + '/restoreMultiple')
                        "
                        class="btn btn-success text-start"
                        @click="restoreMultipleAction"
                    >
                        <i class="fas fa-trash-restore me-1"></i>
                        {{ App.t('routeActions->restoreMultiple') }}
                    </button>
                </template>
            </div>
        </div>
    </template>
</template>
