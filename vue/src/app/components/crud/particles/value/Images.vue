<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            id: 'images-' + this.booted.helpers.string.uniqueId(),
        };
    },
    mounted() {
        $('#' + this.id).owlCarousel({
            loop: false,
            responsiveClass: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 5,
                }
            }
        })
    },
};
</script>

<template>
    <div :id="id" class="owl-carousel">
        <div v-for="value in item.value">
            <img :src="value">
        </div>
    </div>
</template>