<script>
export default {
    props: {
        id: {
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
            hiddenNodes: [],
            treeView: null,
        };
    },
    mounted() {
        this.treeView = $('#hierarchical-tree-' + this.id);

        this.booted.helpers.http
            .send(this, {
                method: 'GET',
                path: this.httpPath + '-tree',
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    this.treeView
                        .jstree({
                            core: {
                                data: response.data.children,
                                themes: {
                                    icons: false,
                                },
                            },
                            plugins: ['contextmenu', 'search', 'dnd'],
                            contextmenu: {
                                items: (node) => {
                                    if (node.state.disabled) {
                                        return {
                                            restore: {
                                                label: this.__('routeActions->restore'),
                                                icon: 'fas fa-trash-restore',
                                                action: (obj) => {
                                                    if (confirm(this.__('Вы уверены?'))) {
                                                        this.booted.helpers.http
                                                            .send(this, {
                                                                method: 'DELETE',
                                                                path: this.httpPath + '/' + node.id + '/restore',
                                                            })
                                                            .then((response) => {
                                                                if (response.statusType === 'success') {
                                                                    this.$parent.$data.treeKey++;
                                                                }
                                                            });
                                                    }
                                                },
                                            },
                                        };
                                    } else {
                                        return {
                                            update: {
                                                label: this.__('routeActions->update'),
                                                icon: 'fas fa-edit',
                                                action: (obj) => {
                                                    this.$route.params.id = node.id;

                                                    this.$parent.$data.formType = 'update';
                                                    this.$parent.$data.formKey++;

                                                    $('#' + this.id).modal('show');
                                                },
                                            },
                                            delete: {
                                                label: this.__('routeActions->delete'),
                                                icon: 'fas fa-trash-alt',
                                                action: (obj) => {
                                                    if (confirm(this.__('Вы уверены?'))) {
                                                        this.booted.helpers.http
                                                            .send(this, {
                                                                method: 'DELETE',
                                                                path: this.httpPath + '/' + node.id,
                                                            })
                                                            .then((response) => {
                                                                if (response.statusType === 'success') {
                                                                    this.$parent.$data.treeKey++;
                                                                }
                                                            });
                                                    }
                                                },
                                            },
                                        };
                                    }
                                },
                            },
                            search: {
                                case_insensitive: true,
                                show_only_matches: true,
                            },
                        })
                        .on('loaded.jstree', () => {
                            this.hiddenNodes = this.treeView.jstree(true).get_json('#', { flat: true });
                        });
                }
            });
    },
    methods: {
        search(event) {
            this.treeView.jstree(true).search(event.target.value);
        },
        toggle(event) {
            if (event.target.checked) {
                this.hiddenNodes.forEach((node, index) => {
                    if (node.state.hidden) this.treeView.jstree(true).show_node(node.id);
                });
            } else {
                this.hiddenNodes.forEach((node, index) => {
                    if (node.state.hidden) this.treeView.jstree(true).hide_node(node.id);
                });
            }
        },
    },
};
</script>

<template>
    <div class="row">
        <div class="col-sm-9">
            <input type="text" @keyup="search" :placeholder="__('Поиск')" class="form-control" />
        </div>

        <div class="col-sm-3">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" @change="toggle" class="form-check-input" />
                    <b class="align-middle ml-2">
                        {{ __('Показать вместе с удалёнными') }}
                    </b>
                </label>
            </div>
        </div>
    </div>

    <div :id="'hierarchical-tree-' + this.id" class="mt-3"></div>
</template>
