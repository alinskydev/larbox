<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/config';
import model from '@/modules/user/models/user';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->update'),
                breadcrumbs: [
                    {
                        label: this.__('routes->user.user'),
                        path: 'user/user',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                title: 'username',
                http: {
                    path: 'user/user/:id',
                },
                events: {
                    afterSubmit: (context, formData, response) => {
                        toastr.success(context.__('Сохранение прошло успешно'));

                        if (this.$route.params.id == this.booted.user.id) {
                            this.booted.helpers.user.login(this, formData.get('username'), formData.get('new_password'));
                            context.booted.components.app.childKey++;
                        }

                        this.page.goUp();
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons />
    </PageTitle>

    <Update />
</template>
