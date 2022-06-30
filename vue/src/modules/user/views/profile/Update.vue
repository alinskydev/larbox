<script setup>
import { UpdatePage } from '@/app/core/crud/page';
import model from '@/modules/user/models/profile';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return new UpdatePage({
            context: this,
            title: this.__('Профиль'),
            titleField: 'username',
            model: model,
            http: {
                method: 'PATCH',
                path: 'user/profile',
            },
            redirectPath: 'user/profile',
            afterSubmit: (context, form, responseBody) => {
                toastr.success(context.__('Профиль успешно сохранён'));

                if (form.new_password) {
                    this.booted.helpers.user.login(this, form.username, form.new_password);
                }

                context.booted.components.app.$data.childKey++;
            },
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons :actions="['save']" />
    </PageTitle>

    <Item child="form" />
</template>
