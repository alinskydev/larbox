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
        this.treeView = $('#tree-' + this.id);

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
                                multiple: false,
                                check_callback: true,
                                themes: {
                                    icons: false,
                                },
                            },
                            plugins: ['search', 'contextmenu', 'dnd'],
                            search: {
                                case_insensitive: true,
                                show_only_matches: true,
                            },
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
                                            show: {
                                                label: this.__('routeActions->show'),
                                                icon: 'fas fa-eye',
                                                action: (obj) => {
                                                    this.$route.params.id = node.id;

                                                    this.$parent.$data.formType = 'show';
                                                    this.$parent.$data.formKey++;

                                                    $('#' + this.id).modal('show');
                                                },
                                            },
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
                            dnd: {
                                is_draggable: (nodes, event) => !nodes[0].state.disabled,
                            },
                        })
                        .on('loaded.jstree', () => {
                            this.hiddenNodes = this.treeView.jstree(true).get_json('#', { flat: true });
                        })
                        .on('move_node.jstree', (event, data) => {
                            let formData = new FormData();

                            formData.append('id', data.node.id);
                            formData.append('parent_id', data.parent === '#' ? 1 : data.parent);
                            formData.append('position', data.position);

                            this.booted.helpers.http
                                .send(this, {
                                    method: 'POST',
                                    path: this.httpPath + '-move?_method=PATCH',
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
        <div class="col-sm-3">
            <div class="form-group">
                <label> {{ __('Поиск') }} </label>
                <input type="text" @keyup="search" class="form-control" />
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <label>{{ __('Отображать') }}</label>
                <select @change="toggle" class="form-control">
                    <option value="0">{{ __('Только действующие') }}</option>
                    <option value="1">{{ __('Все') }}</option>
                </select>
            </div>
        </div>
    </div>

    <div :id="'tree-' + this.id" class="mt-3"></div>
</template>
