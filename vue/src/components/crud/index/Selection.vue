<script>
export default {
    props: {
        type: {
            type: String,
            required: true,
        },
        pk: {
            type: [Number, String],
        },
    },
    data() {
        return {
            config: this.booted.components.current.config,
        };
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
                $('.crud-index-data .actions').fadeIn(100);
            } else {
                $('.crud-index-data .actions').fadeOut(100);
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

            if (confirm(this.__('Вы уверены?'))) {
                this.booted.helpers.http
                    .send(this, {
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
            <input type="checkbox" class="selection checkbox-lg" @change="toggleHead" />
        </th>

        <th v-if="type === 'tableBody'">
            <input type="checkbox" :value="pk" class="selection checkbox-lg" @change="toggleBody" />
        </th>

        <div v-if="type === 'actions'" class="actions card card-light" style="display: none">
            <div class="card-header">
                {{ __('Действия') }}
            </div>

            <div class="card-body">
                <template v-for="action in config.selection.actions">
                    <button
                        v-if="
                            action === 'deleteMultiple' &&
                            !$route.query['show[deleted]'] &&
                            booted.helpers.user.checkRoute(booted.components.app, config.http.path + '/deleteMultiple')
                        "
                        class="btn btn-danger btn-block text-left"
                        @click="deleteMultipleAction"
                    >
                        <i class="fas fa-trash-alt mr-1"></i>
                        {{ __('routeActions->deleteMultiple') }}
                    </button>

                    <button
                        v-if="
                            action === 'deleteMultiple' &&
                            $route.query['show[deleted]'] === 'only-deleted' &&
                            booted.helpers.user.checkRoute(booted.components.app, config.http.path + '/restoreMultiple')
                        "
                        class="btn btn-success btn-block text-left"
                        @click="restoreMultipleAction"
                    >
                        <i class="fas fa-trash-restore mr-1"></i>
                        {{ __('routeActions->restoreMultiple') }}
                    </button>
                </template>
            </div>
        </div>
    </template>
</template>
