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
        http: {
            type: Object,
            required: true,
        },
        actions: {
            type: Array,
            required: true,
        },
        extraActions: {
            type: Object,
        },
    },
    methods: {
        deleteAction(id) {
            if (confirm(this.__('Вы уверены?'))) {
                this.booted.helpers.http.send(this, {
                    method: 'DELETE',
                    path: this.http.path + '/' + id,
                }).then((response) => {
                    if (response.statusType === 'success') {
                        this.item.is_deleted = true;
                    }
                });
            }
        },
        restoreAction(id) {
            if (confirm(this.__('Вы уверены?'))) {
                this.booted.helpers.http.send(this, {
                    method: 'DELETE',
                    path: this.http.path + '/' + id + '/restore',
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
        <template v-for="action in actions">
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
               @click="deleteAction(item.id.value)"
               class="btn btn-danger">

                <i class="fas fa-trash-alt"></i>
            </a>

            <a v-else-if="action === 'restore' && item.is_deleted"
               :title="__('Восстановить')"
               @click="restoreAction(item.id.value)"
               class="btn btn-success">

                <i class="fas fa-trash-restore"></i>
            </a>

            <template v-if="extraActions[action]">
                <div :set="ea = extraActions[action]">
                    <RouterLink :to="ea.path.replace(':id', item.id.value)" v-bind="ea.buttonOptions">
                        <i v-bind="ea.iconOptions"></i>
                    </RouterLink>
                </div>
            </template>
        </template>
    </div>
</template>