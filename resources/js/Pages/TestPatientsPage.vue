<script setup>
import { ref, defineProps } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";


defineOptions({
    layout: AppLayout,
});

const props = defineProps({
    patients: {
        type: Array,
        default: () => []
    }
});

</script>

<template>
<p>
    {{ patients}}
</p>
</template>

