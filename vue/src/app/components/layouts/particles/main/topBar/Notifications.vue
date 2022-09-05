<script setup>
import RouterLink from "@/app/components/blocks/RouterLink.vue";
</script>

<script>
export default {
    data() {
        return {
            quantity: 0,
        };
    },
    created() {
        this.booted.helpers.http.send(this, {
            method: 'GET',
            path: 'user/notification',
            query: {
                'filter[is_seen]': 0,
            },
        }).then((response) => {
            if (response.statusType === 'success') {
                this.quantity = response.data.meta.total;
            }
        });
    },
};
</script>

<template>
    <li class="nav-item">
        <RouterLink to="user/notification" class="nav-link">
            <i class="far fa-bell"></i>

            <span v-if="quantity > 0" class="badge badge-pill badge-danger navbar-badge">
                {{ quantity }}
            </span>
        </RouterLink>
    </li>
</template>