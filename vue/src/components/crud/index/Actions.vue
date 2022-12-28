<script setup>
import RouterLink from '@/components/blocks/RouterLink.vue';
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
            config: this.booted.components.current.config,
        };
    },
    methods: {
        deleteAction() {
            if (confirm(this.__('Вы уверены?'))) {
                this.booted.helpers.http
                    .send(this, {
                        method: 'DELETE',
                        path: this.config.http.path + '/' + this.item.id.value,
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            if (this.config.filter.hasSoftDelete) {
                                this.item.is_deleted = true;
                            } else {
                                this.$parent.$parent.$data.dataKey++;
                            }
                        }
                    });
            }
        },
        restoreAction() {
            if (confirm(this.__('Вы уверены?'))) {
                this.booted.helpers.http
                    .send(this, {
                        method: 'DELETE',
                        path: this.config.http.path + '/' + this.item.id.value + '/restore',
                    })
                    .then((response) => {
                        if (response.statusType === 'success' && this.config.filter.hasSoftDelete) {
                            this.item.is_deleted = false;
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
            <template v-if="!item.is_deleted">
                <RouterLink
                    v-if="action === 'show' && booted.helpers.user.checkRoute(booted.components.app, config.http.path + '/show')"
                    :title="__('routeActions->show')"
                    :to="config.http.path + '/' + item.id.value + '/show'"
                    class="btn btn-primary"
                >
                    <i class="fas fa-eye"></i>
                </RouterLink>

                <RouterLink
                    v-else-if="
                        action === 'update' && booted.helpers.user.checkRoute(booted.components.app, config.http.path + '/update')
                    "
                    :title="__('routeActions->update')"
                    :to="config.http.path + '/' + item.id.value + '/update'"
                    class="btn btn-warning"
                >
                    <i class="fas fa-edit"></i>
                </RouterLink>

                <a
                    v-else-if="
                        action === 'delete' && booted.helpers.user.checkRoute(booted.components.app, config.http.path + '/delete')
                    "
                    :title="__('routeActions->delete')"
                    @click="deleteAction"
                    class="btn btn-danger"
                >
                    <i class="fas fa-trash-alt"></i>
                </a>
            </template>

            <template v-else>
                <a
                    v-if="
                        action === 'delete' &&
                        booted.helpers.user.checkRoute(booted.components.app, config.http.path + '/restore')
                    "
                    :title="__('routeActions->restore')"
                    @click="restoreAction"
                    class="btn btn-success"
                >
                    <i class="fas fa-trash-restore"></i>
                </a>
            </template>

            <template v-if="config.grid.customActions[action]">
                <div :set="(ea = config.grid.customActions[action](item))">
                    <RouterLink v-if="ea" :to="ea.path" v-bind="ea.linkAttributes">
                        <i v-bind="ea.iconAttributes"></i>
                    </RouterLink>
                </div>
            </template>
        </template>
    </div>
</template>
