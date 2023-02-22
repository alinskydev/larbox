<script setup>
import App from '@/core/app';
import { IndexConfig } from '@/core/crud/configs';
import RouterLink from '@/components/blocks/RouterLink.vue';
import ComponentResolver from '@/components/decorators/ComponentResolver.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: IndexConfig,
            required: true,
        },
        model: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            basePath: this.config.http.path + '/' + this.model.data.pk,
            record: this.model.data.record,
            customActions: {},
        };
    },
    watch: {
        record: {
            handler(newValue, oldValue) {
                this.refreshCustomActions();
            },
            deep: true,
        },
    },
    created() {
        this.refreshCustomActions();
    },
    mounted() {
        $(this.$el).find('a, button').not('[data-has-tooltip="false"]').tooltip();
    },
    beforeUnmount() {
        $(this.$el).find('a, button').not('[data-has-tooltip="false"]').tooltip('dispose');
    },
    methods: {
        refreshCustomActions() {
            for (let key in this.config.grid.customActions) {
                this.customActions[key] = this.config.grid.customActions[key](this.record);
            }
        },
        deleteAction() {
            if (confirm(App.t('Вы уверены?'))) {
                App.helpers.http
                    .send({
                        method: 'DELETE',
                        path: this.basePath,
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            if (this.model.hasSoftDelete) {
                                this.record.is_deleted = true;
                            } else {
                                this.$parent.$parent.$data.dataKey++;
                            }
                        }
                    });
            }
        },
        restoreAction() {
            if (confirm(App.t('Вы уверены?'))) {
                App.helpers.http
                    .send({
                        method: 'DELETE',
                        path: this.basePath + '/restore',
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            this.record.is_deleted = false;
                        }
                    });
            }
        },
    },
};
</script>

<template>
    <div class="btn-group">
        <template v-for="action in config.grid.actions">
            <template v-if="!record.is_deleted">
                <RouterLink
                    v-if="action === 'show' && App.helpers.user.checkRoute(config.http.path + '/show')"
                    :title="App.t('routeActions->show')"
                    :to="basePath + '/show'"
                    class="btn btn-primary"
                >
                    <i class="fas fa-eye"></i>
                </RouterLink>

                <RouterLink
                    v-else-if="action === 'update' && App.helpers.user.checkRoute(config.http.path + '/update')"
                    :title="App.t('routeActions->update')"
                    :to="basePath + '/update'"
                    class="btn btn-warning"
                >
                    <i class="fas fa-edit"></i>
                </RouterLink>

                <a
                    v-else-if="action === 'delete' && App.helpers.user.checkRoute(config.http.path + '/delete')"
                    :title="App.t('routeActions->delete')"
                    @click="deleteAction"
                    class="btn btn-danger"
                >
                    <i class="fas fa-trash-alt"></i>
                </a>
            </template>

            <template v-else>
                <a
                    v-if="action === 'delete' && App.helpers.user.checkRoute(config.http.path + '/restore')"
                    :title="App.t('routeActions->restore')"
                    @click="restoreAction"
                    class="btn btn-success"
                >
                    <i class="fas fa-trash-restore"></i>
                </a>
            </template>

            <template v-if="customActions[action]">
                <RouterLink
                    v-if="customActions[action].path"
                    :to="customActions[action].path"
                    v-bind="customActions[action].linkAttributes"
                >
                    <i v-bind="customActions[action].iconAttributes"></i>
                </RouterLink>

                <ComponentResolver v-else :resolve="config.grid.customActions[action](record)" />
            </template>
        </template>
    </div>
</template>
