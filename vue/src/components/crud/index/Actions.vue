<script setup>
import App from '@/core/app';
import { IndexConfig } from '@/core/crud/configs';
import RouterLink from '@/components/blocks/RouterLink.vue';
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
        };
    },
    methods: {
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
                                this.model.data.record.is_deleted = true;
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
                        if (response.statusType === 'success' && this.model.hasSoftDelete) {
                            this.model.data.record.is_deleted = false;
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
            <template v-if="!model.data.record.is_deleted">
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

            <template v-if="config.grid.customActions[action]">
                <div :set="(customAction = config.grid.customActions[action](model.data.record))">
                    <RouterLink v-if="customAction" :to="customAction.path" v-bind="customAction.linkAttributes">
                        <i v-bind="customAction.iconAttributes"></i>
                    </RouterLink>
                </div>
            </template>
        </template>
    </div>
</template>
