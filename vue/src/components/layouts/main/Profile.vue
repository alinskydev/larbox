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
    <div class="dropdown d-inline-block">
        <button
            type="button"
            class="btn header-item noti-icon waves-effect"
            id="page-header-user-dropdown"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            <i class="ti-user"></i>
        </button>

        <div class="dropdown-menu dropdown-menu-end">
            <div class="px-4 py-2">
                <h5 class="m-0">
                    {{ App.user.username }}
                </h5>
            </div>
            
            <div class="dropdown-divider"></div>

            <RouterLink :to="'user/profile'" class="dropdown-item">
                <i class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i>
                {{ App.t('routes->user.profile') }}
            </RouterLink>

            <div class="dropdown-divider"></div>

            <a @click="logout" href="#" class="dropdown-item text-danger">
                <i class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i>
                {{ App.t('Выйти') }}
            </a>
        </div>
    </div>
</template>
