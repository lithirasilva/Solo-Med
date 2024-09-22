<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';

defineProps({
    bg:{
        type: String,
        default: 'bg-orange-200'

    }

});

</script>

<template>
    <div :class="`${bg} relative p-4 sm:p-6 md:p-8 lg:p-10 mx-4 sm:mx-6 md:mx-8 lg:mx-10 my-4 sm:my-6 md:my-8 lg:my-10  rounded-lg shadow-lg transform transition-transform duration-300 hover:scale-105`">
    <slot></slot>
    </div>

</template>


