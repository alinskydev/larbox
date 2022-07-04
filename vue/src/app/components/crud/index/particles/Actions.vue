<script setup>
import { RouterLink as BaseRouterLink } from "vue-router";
import RouterLink from '@/app/components/blocks/RouterLink.vue';
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
                this.booted.helpers.http.send(this, {
                    method: 'DELETE',
                    path: this.config.http.path + '/' + this.item.id.value,
                }).then((response) => {
                    if (response.statusType === 'success') {
                        this.item.is_deleted = true;
                    }
                });
            }
        },
        restoreAction() {
            if (confirm(this.__('Вы уверены?'))) {
                this.booted.helpers.http.send(this, {
                    method: 'DELETE',
                    path: this.config.http.path + '/' + this.item.id.value + '/restore',
                }).then((response) => {
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
            <BaseRouterLink v-if="action === 'show'"
                            :title="__('Просмотреть')"
                            :to="$route.path + '/' + item.id.value + '/show'"
                            class="btn btn-primary">

                <i class="fas fa-eye"></i>
            </BaseRouterLink>

            <BaseRouterLink v-else-if="action === 'update'"
                            :title="__('Редактировать')"
                            :to="$route.path + '/' + item.id.value + '/update'"
                            class="btn btn-warning">

                <i class="fas fa-edit"></i>
            </BaseRouterLink>

            <a v-else-if="action === 'delete' && !item.is_deleted"
               :title="__('Удалить')"
               @click="deleteAction"
               class="btn btn-danger">

                <i class="fas fa-trash-alt"></i>
            </a>

            <a v-else-if="action === 'restore' && item.is_deleted"
               :title="__('Восстановить')"
               @click="restoreAction"
               class="btn btn-success">

                <i class="fas fa-trash-restore"></i>
            </a>

            <template v-if="config.extraActions[action]">
                <div :set="ea = config.extraActions[action]">
                    <RouterLink :to="ea.path.replace(':id', item.id.value)" v-bind="ea.linkAttributes">
                        <i v-bind="ea.iconAttributes"></i>
                    </RouterLink>
                </div>
            </template>
        </template>
    </div>
</template>