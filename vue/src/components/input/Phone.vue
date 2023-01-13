<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {};
    },
    mounted() {
        intlTelInput(document.getElementById(this.item.elementId), {
            preferredCountries: [],
            onlyCountries: ['gb', 'ru', 'uz'],
            initialCountry: 'uz',
            customContainer: 'w-100',
            nationalMode: false,
            autoPlaceholder: 'off',
            autoHideDialCode: false,
        });
    },
};
</script>

<template>
    <input type="text" />
</template>
