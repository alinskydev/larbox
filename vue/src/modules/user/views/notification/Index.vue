<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/notification';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import PageTitleButtons from '@/components/blocks/PageTitleButtons.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->user.notification'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'user/notification',
                },
                grid: {
                    actions: ['link', 'show'],
                    customActions: {
                        link: (record) => {
                            let path;

                            switch (record.type) {
                                case 'feedback_callback_created':
                                    path = 'feedback/callback/' + record.params.id + '/show';
                                    break;

                                default:
                                    return null;
                            }

                            return {
                                path: path,
                                linkAttributes: {
                                    title: App.t('Ссылка'),
                                    class: 'btn btn-info',
                                    target: '_blank',
                                },
                                iconAttributes: {
                                    class: 'fas fa-external-link-alt',
                                },
                            };
                        },
                    },
                    rowAttributes: (record) => {
                        if (!record.is_seen) {
                            return {
                                class: 'table-warning',
                            };
                        }
                    },
                },
            }),
        };
    },
    created() {
        Page.init({
            title: this.title,
        });
    },
    methods: {
        seeAll() {
            if (confirm(App.t('Вы уверены?'))) {
                App.helpers.http
                    .send({
                        method: 'PATCH',
                        path: 'user/notification/see-all',
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            toastr.success(App.t('Операция прошла успешно'));
                            App.components.app.refresh();
                        }
                    });
            }
        },
    },
};
</script>

<template>
    <PageTitle :text="title" />

    <PageTitleButtons>
        <button type="button" @click="seeAll" class="btn btn-warning">
            {{ App.t('Отметить все как просмотренные') }}
        </button>
    </PageTitleButtons>

    <Index :config="config" />
</template>
