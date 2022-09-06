<script setup>
import { RouterLink as BaseRouterLink } from 'vue-router';
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
                            this.item.is_deleted = true;
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
                        if (response.statusType === 'success') {
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
        <template v-for="action in config.actions">
            <template v-if="!item.is_deleted">
                <BaseRouterLink
                    v-if="action === 'show'"
                    :title="__('Просмотреть')"
                    :to="$route.path + '/' + item.id.value + '/show'"
                    class="btn btn-primary"
                >
                    <i class="fas fa-eye"></i>
                </BaseRouterLink>

                <BaseRouterLink
                    v-else-if="action === 'update'"
                    :title="__('Редактировать')"
                    :to="$route.path + '/' + item.id.value + '/update'"
                    class="btn btn-warning"
                >
                    <i class="fas fa-edit"></i>
                </BaseRouterLink>

                <a v-else-if="action === 'delete'" :title="__('Удалить')" @click="deleteAction" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i>
                </a>

                <template v-if="config.extraActions[action]">
                    <div :set="(ea = config.extraActions[action](item))">
                        <RouterLink v-if="ea" :to="ea.path" v-bind="ea.linkAttributes">
                            <i v-bind="ea.iconAttributes"></i>
                        </RouterLink>
                    </div>
                </template>
            </template>

            <template v-else>
                <a v-if="action === 'restore'" :title="__('Восстановить')" @click="restoreAction" class="btn btn-success">
                    <i class="fas fa-trash-restore"></i>
                </a>
            </template>
        </template>
    </div>
</template>
