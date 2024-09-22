<template>
    <div class="p-4 border border-gray-200 rounded-lg bg-white shadow-sm">
        <h2 class="text-xl font-semibold">{{ patientName }}</h2>
        <p class="text-gray-600">{{ email }}</p>
        <p class="text-gray-600">{{ phone }}</p>
        <p class="text-gray-600">{{ address }}</p>
        <p class="mt-2 text-gray-800">{{ specialNotes }}</p>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    patient: {
        type: Object,
        required: true
    }
});

const patientName = computed(() => `${props.patient.first_name} ${props.patient.last_name}`);
const { email, phone, address, special_notes: specialNotes } = props.patient;
</script>

