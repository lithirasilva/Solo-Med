<script setup>
import { ref } from 'vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import AppLayout from "@/Layouts/AppLayout.vue";

// Define the calendarOptions using ref
const calendarOptions = ref({
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth'
});

defineOptions({
    layout: AppLayout
});
</script>

<template>
    <div class="m-10 p-10 bg-gray-800 bg-opacity-50 rounded">
        <FullCalendar :options="calendarOptions" />
    </div>

</template>
