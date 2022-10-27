<script>
export default {
    props: {
        type: {
            type: String,
            required: true,
        },
        id: {
            type: Number,
        },
    },
    data() {
        return {
            config: this.booted.components.current.config,
            pathPrefix: this.$route.matched.at(-1).path.replace('/', '').replace(':locale/', ''),
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
        deleteAllAction() {
            this.sendRequest(this.config.http.path + '/delete/all?_method=DELETE', (selection) => {
                for (let key in this.$parent.$data.items) {
                    let item = this.$parent.$data.items[key];

                    if (selection.includes(item.id.value)) {
                        item.is_deleted = true;
                    }
                }
            });
        },
        restoreAllAction() {
            this.sendRequest(this.config.http.path + '/restore/all?_method=DELETE', (selection) => {
                for (let key in this.$parent.$data.items) {
                    let item = this.$parent.$data.items[key];

                    if (selection.includes(item.id.value)) {
                        item.is_deleted = false;
                    }
                }
            });
        },
        sendRequest(path, callback) {
            let formData = new FormData(),
                selection = Array.from(document.querySelectorAll('.crud-index-data tbody .selection:checked'), (e) => parseInt(e.value));

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
            <input type="checkbox" class="checkbox-lg" @change="toggleHead" />
        </th>

        <th v-if="type === 'tableBody'">
            <input type="checkbox" :value="id" class="checkbox-lg" @change="toggleBody" />
        </th>

        <div v-if="type === 'actions'" class="actions card card-light" style="display: none">
            <div class="card-header">
                {{ __('Действия') }}
            </div>

            <div class="card-body">
                <template v-for="action in config.selection.actions">
                    <button
                        v-if="
                            action === 'deleteAll' &&
                            !$route.query['show[deleted]'] &&
                            booted.helpers.user.checkRoute(booted.components.app, pathPrefix + '/deleteAll')
                        "
                        class="btn btn-danger btn-block text-left"
                        @click="deleteAllAction"
                    >
                        <i class="fas fa-trash-alt mr-1"></i>
                        {{ __('routeActions->deleteAll') }}
                    </button>

                    <button
                        v-if="
                            action === 'deleteAll' &&
                            $route.query['show[deleted]'] === 'only-deleted' &&
                            booted.helpers.user.checkRoute(booted.components.app, pathPrefix + '/restoreAll')
                        "
                        class="btn btn-success btn-block text-left"
                        @click="restoreAllAction"
                    >
                        <i class="fas fa-trash-restore mr-1"></i>
                        {{ __('routeActions->restoreAll') }}
                    </button>
                </template>
            </div>
        </div>
    </template>
</template>
