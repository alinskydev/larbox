<script setup>
import App from '@/core/app';
import RouterLink from '@/components/blocks/RouterLink.vue';
</script>

<script>
export default {
    data() {
        return {
            notifications: [],
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
                    'page-size': 10,
                },
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    this.notifications = response.data.data;
                    this.quantity = response.data.meta.total;
                }
            });
    },
};
</script>

<template>
    <div class="dropdown d-inline-block ms-1">
        <button
            type="button"
            class="btn header-item noti-icon waves-effect"
            id="page-header-notifications-dropdown"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            <i class="ti-bell"></i>

            <span v-if="quantity > 0" class="badge bg-danger rounded-pill">
                {{ quantity }}
            </span>
        </button>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="m-0">
                            {{ App.t('routes->user.notification') + (quantity ? ' (' + quantity + ')' : '') }}
                        </h5>
                    </div>
                </div>
            </div>

            <div v-if="notifications.length > 0" class="dropdown-divider mt-0"></div>

            <div data-simplebar style="max-height: 230px">
                <template v-for="notification in notifications">
                    <RouterLink :to="'user/notification/' + notification.id + '/show'" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <span class="avatar-title border-dark rounded-circle">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    {{ App.enums.user_notification.types[notification.type] }}
                                </h6>

                                <div class="text-muted">
                                    <p class="ws-pre-wrap mb-1">
                                        {{ notification.text }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </RouterLink>
                </template>
            </div>

            <div class="p-2 border-top">
                <RouterLink to="user/notification/index" class="btn btn-sm btn-outline-primary font-size-14 w-100 text-center">
                    {{ App.t('Показать все') }}
                </RouterLink>
            </div>
        </div>
    </div>
</template>
