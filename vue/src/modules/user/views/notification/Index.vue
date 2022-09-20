<script setup>
import { Page } from '@/core/base/page';
import { IndexConfig } from '@/core/base/crud/config';
import model from '@/modules/user/models/notification';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->user.notification'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'user/notification',
                },
                grid: {
                    actions: ['show'],
                    rowAttributes: (context, item) => {
                        if (!item.is_seen.value) {
                            return {
                                class: 'table-warning',
                            };
                        }
                    },
                },
            }),
        };
    },
    methods: {
        seeAll() {
            if (confirm(this.__('Вы уверены?'))) {
                this.booted.helpers.http
                    .send(this, {
                        method: 'PATCH',
                        path: 'user/notification/see-all',
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            toastr.success(this.__('Операция прошла успешно'));
                            this.booted.components.app.childKey++;
                        }
                    });
            }
        },
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <button type="button" @click="seeAll" class="btn btn-warning">
            {{ __('Отметить все как просмотренные') }}
        </button>
    </PageTitle>

    <Index />
</template>
