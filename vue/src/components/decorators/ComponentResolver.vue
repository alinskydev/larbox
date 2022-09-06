<script setup>
import { h, resolveDynamicComponent } from 'vue';
</script>

<script>
export default {
    props: {
        resolve: {
            type: Object,
            required: true,
        },
    },
    render() {
        return h(resolveDynamicComponent(this.resolve.component), ...this.resolve.params);
    },
};
</script>
