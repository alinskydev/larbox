<script setup>
import App from '@/core/app';
import RouterLink from '@/components/blocks/RouterLink.vue';
</script>

<script>
export default {
    methods: {
        logout() {
            App.helpers.user.logout();
        },
    },
};
</script>

<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user-circle"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <h5 class="dropdown-item text-center">
                {{ App.user.username }}
            </h5>

            <div class="dropdown-divider"></div>

            <RouterLink :to="'user/profile'" class="dropdown-item">
                <i class="fas fa-edit mr-2"></i>
                {{ App.t('routes->user.profile') }}
            </RouterLink>

            <div class="dropdown-divider"></div>

            <a role="button" @click="logout" class="dropdown-item">
                <i class="fas fa-power-off mr-2"></i>
                {{ App.t('Выйти') }}
            </a>
        </div>
    </li>
</template>
