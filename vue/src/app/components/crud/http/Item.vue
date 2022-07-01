<script setup>
import ShowGrid from '@/app/components/crud/show/Grid.vue';
import FormAccordion from '@/app/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    props: {
        child: {
            type: String,
            required: true,
            validator(value) {
                return ['show', 'form'].includes(value);
            },
        },
    },
    data() {
        return {
            page: this.booted.components.current.page,
            config: this.booted.components.current.config,
            model: this.booted.components.current.config.model,
            items: {},
        };
    },
    created() {
        let http = this.config.http;

        http.path = http.path.replace(':id', this.$route.params.id);

        this.booted.helpers.http.send(this, {
            method: 'GET',
            path: http.path,
            query: http.query,
        }).then((response) => {
            if (response.statusType === 'success') {

                // Page init

                if (this.config.titleField) {
                    this.page.title += ': ' + this.booted.helpers.iterator.get(
                        response.data,
                        this.config.titleField.replace(':locale', this.booted.locale)
                    );
                }

                this.page.init();

                // Collecting items

                switch (this.child) {
                    case 'show':
                        this.items = this.model.prepareValues(this, this.model.show, response.data);
                        break;
                    case 'form':
                        for (let key in this.model.form) {
                            this.items[key] = this.model.prepareInputs(this, this.model.form[key], response.data);
                        }
                        break;
                }
            } else {
                this.$router.back();
            }
        });
    },
};
</script>

<template>
    <ShowGrid v-if="child === 'show'" :items="items" />
    <FormAccordion v-else-if="child === 'form'" :itemGroups="items" />
</template>