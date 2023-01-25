<script setup>
import App from '@/core/app';
import RouterLink from '@/components/blocks/RouterLink.vue';
</script>

<template>
    <div class="float-start">
        <div class="navbar-brand-box">
            <RouterLink to="" class="logo logo-dark">
                <span class="logo-sm">
                    <img :src="App.settings.logo" height="30" />
                </span>
                <span class="logo-lg">
                    <img :src="App.settings.logo" height="30" />
                </span>

                <span class="text-dark font-size-18 ms-2 d-none d-lg-inline">
                    {{ App.settings.project_name }}
                </span>
            </RouterLink>
        </div>

        <button
            type="button"
            class="btn btn-sm px-3 font-size-24 d-lg-none header-item waves-effect waves-light"
            data-bs-toggle="collapse"
            data-bs-target="#topnav-menu-content"
        >
            <i class="mdi mdi-menu"></i>
        </button>
    </div>
</template>
