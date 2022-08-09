<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        $('#' + this.item.id).owlCarousel({
            loop: false,
            responsiveClass: true,
            margin: 10,
            autoWidth: true,
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
    <div :id="item.id" class="owl-carousel">
        <img v-for="value in item.value" :src="value" style="height: 300px;" v-bind="item.attributes">
    </div>
</template>