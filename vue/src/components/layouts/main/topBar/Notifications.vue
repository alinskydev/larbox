<script setup>
import App from '@/core/app';
import RouterLink from '@/components/blocks/RouterLink.vue';
</script>

<script>
export default {
    data() {
        return {
            quantity: 0,
        };
    },
    created() {
        App.helpers.http
            .send({
                method: 'GET',
                path: 'user/notification',
                query: {
                    'filter[is_seen]': 0,
                    'page-size': 1,
                },
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    this.quantity = response.data.meta.total;
                }
            });
    },
};
</script>

<template>
    <li class="nav-item">
        <RouterLink to="user/notification/index" class="nav-link">
            <i class="far fa-bell"></i>

            <span v-if="quantity > 0" class="badge badge-pill badge-danger navbar-badge font-weight-bold">
                {{ quantity }}
            </span>
        </RouterLink>
    </li>
</template>
