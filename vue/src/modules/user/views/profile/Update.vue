<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';
import model from '@/modules/user/models/profile';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/particles/Buttons.vue';
import Update from '@/app/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Профиль'),
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'user/profile',
                },
                redirectPath: 'user/profile',
                afterSubmit: (context, formData, response) => {
                    toastr.success(context.__('Профиль успешно сохранён'));

                    this.booted.helpers.user.login(this, formData.get('username'), formData.get('new_password'));
                    context.booted.components.app.childKey++;
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons :actions="['save']" />
    </PageTitle>

    <Update />
</template>
