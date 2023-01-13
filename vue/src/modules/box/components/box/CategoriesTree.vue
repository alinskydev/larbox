<script setup>
import App from '@/core/app';
</script>

<script>
export default {
    props: {
        value: {
            type: Array,
            default: [],
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
        this.treeView = $('#box-categories-tree');

        App.helpers.http
            .send({
                method: 'GET',
                path: this.httpPath,
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    this.treeView
                        .jstree({
                            core: {
                                data: response.data,
                                multiple: false,
                                check_callback: false,
                                themes: {
                                    icons: false,
                                },
                            },
                            plugins: ['search', 'checkbox'],
                            search: {
                                case_insensitive: true,
                                show_only_matches: true,
                            },
                            checkbox: {
                                three_state: false,
                                keep_selected_style: false,
                                tie_selection: false,
                            },
                        })
                        .on('loaded.jstree', () => {
                            this.treeView.jstree(true).check_node(this.value);
                            this.nodes = this.treeView.jstree(true).get_json('#', { flat: true });
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
    <div class="col-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label> {{ App.t('Поиск') }} </label>
                    <input type="text" @keyup="search" class="form-control" />
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label>{{ App.t('Отображать') }}</label>
                    <select @change="toggle" class="form-control">
                        <option value="0">{{ App.t('Только действующие') }}</option>
                        <option value="1">{{ App.t('Все') }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="box-categories-tree" class="mt-3"></div>
    </div>
</template>
