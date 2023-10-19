<script setup>
import App from '@/core/app';
</script>

<script>
export default {
    props: {
        parentId: {
            type: String,
            required: true,
        },
        httpPath: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            nodes: [],
            treeView: null,
        };
    },
    mounted() {
        console.log(this.httpPath);
        this.treeView = $('#tree-' + this.parentId);

        App.helpers.http
            .send({
                method: 'GET',
                path: this.httpPath + '/tree',
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    let plugins = ['search', 'contextmenu'];

                    if (App.helpers.user.checkRoute(this.httpPath + '.move')) plugins.push('dnd');

                    this.treeView
                        .jstree({
                            core: {
                                data: response.data,
                                multiple: false,
                                check_callback: true,
                                themes: {
                                    icons: false,
                                },
                            },
                            plugins: plugins,
                            search: {
                                case_insensitive: true,
                                show_only_matches: true,
                            },
                            contextmenu: {
                                items: (node) => {
                                    let allActions = {
                                        show: {
                                            label: App.t('routeActions->show'),
                                            icon: 'fas fa-eye',
                                            action: (obj) => {
                                                this.$route.params.pk = node.id;

                                                this.$parent.$data.modalView = 'show';
                                                this.$parent.$data.modalKey++;

                                                $('#modal-' + this.parentId).modal('show');
                                            },
                                        },
                                        update: {
                                            label: App.t('routeActions->update'),
                                            icon: 'fas fa-edit',
                                            action: (obj) => {
                                                this.$route.params.pk = node.id;

                                                this.$parent.$data.modalView = 'update';
                                                this.$parent.$data.modalKey++;

                                                $('#modal-' + this.parentId).modal('show');
                                            },
                                        },
                                        delete: {
                                            label: App.t('routeActions->delete'),
                                            icon: 'fas fa-trash-alt',
                                            action: (obj) => {
                                                if (confirm(App.t('Вы уверены?'))) {
                                                    App.helpers.http
                                                        .send({
                                                            method: 'DELETE',
                                                            path: this.httpPath + '/' + node.id,
                                                        })
                                                        .then((response) => {
                                                            if (response.statusType === 'success') {
                                                                this.treeView
                                                                    .jstree(true)
                                                                    .get_json(node.id, { flat: true })
                                                                    .forEach((value) => {
                                                                        this.treeView.jstree(true).disable_node(value);
                                                                        this.treeView.jstree(true).hide_node(value);
                                                                    });

                                                                this.nodes = this.treeView
                                                                    .jstree(true)
                                                                    .get_json('#', { flat: true });
                                                            }
                                                        });
                                                }
                                            },
                                        },
                                        restore: {
                                            label: App.t('routeActions->restore'),
                                            icon: 'fas fa-trash-restore',
                                            action: (obj) => {
                                                if (confirm(App.t('Вы уверены?'))) {
                                                    App.helpers.http
                                                        .send({
                                                            method: 'DELETE',
                                                            path: this.httpPath + '/' + node.id + '/restore',
                                                        })
                                                        .then((response) => {
                                                            if (response.statusType === 'success') {
                                                                this.treeView
                                                                    .jstree(true)
                                                                    .get_json(node.id, { flat: true })
                                                                    .forEach((value) => {
                                                                        this.treeView.jstree(true).enable_node(value);
                                                                        this.treeView.jstree(true).show_node(value);
                                                                    });

                                                                this.nodes = this.treeView
                                                                    .jstree(true)
                                                                    .get_json('#', { flat: true });
                                                            }
                                                        });
                                                }
                                            },
                                        },
                                    };

                                    let availableActions = node.state.disabled ? ['restore'] : ['show', 'update', 'delete'];

                                    availableActions = availableActions.filter((value) => {
                                        return App.helpers.user.checkRoute(this.httpPath + '/' + value);
                                    });

                                    return App.helpers.lodash.pick(allActions, availableActions);
                                },
                            },
                            dnd: {
                                is_draggable: (nodes, event) => !nodes[0].state.disabled,
                            },
                        })
                        .on('loaded.jstree', () => {
                            this.nodes = this.treeView.jstree(true).get_json('#', { flat: true });
                        })
                        .on('move_node.jstree', (event, data) => {
                            let formData = new FormData(),
                                nodes = this.treeView
                                    .jstree(true)
                                    .get_json('#', { no_data: true, no_state: true, no_li_attr: true, no_a_attr: true });

                            formData.append('tree', JSON.stringify(nodes));

                            App.helpers.http
                                .send({
                                    method: 'POST',
                                    path: this.httpPath + '/move?_method=PATCH',
                                    body: formData,
                                })
                                .then((response) => {
                                    if (response.statusType === 'validationFailed') {
                                        this.$parent.$data.treeKey++;
                                    }
                                });
                        });
                }
            });
    },
    methods: {
        search(event) {
            this.treeView.jstree(true).search(event.target.value);
        },
        toggle(event) {
            if (event.target.value === '1') {
                this.treeView.jstree(true).show_all();
            } else {
                this.nodes.forEach((value, index) => {
                    if (value.state.hidden) this.treeView.jstree(true).hide_node(value.id);
                });
            }
        },
    },
};
</script>

<template>
    <div class="row">
        <div class="col-sm-3">
            <label> {{ App.t('Поиск') }} </label>
            <input type="text" @keyup="search" class="form-control" />
        </div>

        <div class="col-sm-3">
            <label>{{ App.t('Отображать') }}</label>
            <select @change="toggle" class="form-control">
                <option value="0">{{ App.t('Только действующие') }}</option>
                <option value="1">{{ App.t('Все') }}</option>
            </select>
        </div>
    </div>

    <div :id="'tree-' + parentId" class="mt-4"></div>
</template>
