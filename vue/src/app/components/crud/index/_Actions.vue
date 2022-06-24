<script setup>
import { RouterLink } from "vue-router";
import CustomRouterLink from '../../vue/RouterLink.vue';
</script>

<script>
export default {
    props: {
        id: {
            type: Number,
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
                $(this.$el).closest('tr').hide(400);

                this.booted.helpers.http.send(this, {
                    method: 'DELETE',
                    path: this.http.path + '/' + id,
                }).then((response) => {
                    if (response.statusType !== 'success') {
                        $(this.$el).closest('tr').show(400);
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
            <RouterLink v-if="action === 'show'"
                        :title="__('Просмотреть')"
                        :to="$route.path + '/' + id + '/show'"
                        class="btn btn-primary">

                <i class="fas fa-eye"></i>
            </RouterLink>

            <RouterLink v-else-if="action === 'update'"
                        :title="__('Редактировать')"
                        :to="$route.path + '/' + id + '/update'"
                        class="btn btn-warning">

                <i class="fas fa-edit"></i>
            </RouterLink>

            <a v-else-if="action === 'delete'"
               :title="__('Удалить')"
               @click="deleteAction(id)"
               class="btn btn-danger">

                <i class="fas fa-trash-alt"></i>
            </a>

            <template v-if="extraActions[action]">
                <div :set="ea = extraActions[action]">
                    <CustomRouterLink :to="ea.path.replace(':id', id)" v-bind="ea.buttonOptions">
                        <i v-bind="ea.iconOptions"></i>
                    </CustomRouterLink>
                </div>
            </template>
        </template>
    </div>
</template>