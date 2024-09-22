<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full relative">
            <!-- Close Button -->
            <button @click="close" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                <i class="fas fa-times"></i>
            </button>
            <!-- Message Content -->
            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ title }}</h2>
            <p class="text-gray-700">{{ message }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps } from 'vue';

// Define props for the component
const props = defineProps({
    title: String,
    message: String
});

// Internal state for controlling visibility
const show = ref(true);

// Method to close the popup
const close = () => {
    show.value = false;
};
</script>
