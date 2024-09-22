<template>
    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Clinic Settings</h2>

        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Open Days</label>
                <div class="mt-2 flex flex-wrap gap-4">
                    <label v-for="day in days" :key="day" class="flex items-center">
                        <input
                            type="checkbox"
                            :value="day"
                            v-model="settings.openDays"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                        />
                        <span class="ml-2 text-sm text-gray-700">{{ day }}</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="openTime" class="block text-sm font-medium text-gray-700">Open Time</label>
                <input
                    v-model="settings.openTime"
                    id="openTime"
                    type="time"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>

            <div class="mb-4">
                <label for="closeTime" class="block text-sm font-medium text-gray-700">Close Time</label>
                <input
                    v-model="settings.closeTime"
                    id="closeTime"
                    type="time"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>

            <div class="mb-4">
                <label for="breakHours" class="block text-sm font-medium text-gray-700">Break Hours</label>
                <input
                    v-model="settings.breakHours"
                    id="breakHours"
                    type="text"
                    placeholder="e.g., 12:00-13:00"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>

            <div class="mb-4">
                <label for="appointmentDuration" class="block text-sm font-medium text-gray-700">Appointment Duration (minutes)</label>
                <input
                    v-model="settings.appointmentDuration"
                    id="appointmentDuration"
                    type="number"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>

            <div class="mb-4">
                <label for="appointmentInterval" class="block text-sm font-medium text-gray-700">Appointment Interval (minutes)</label>
                <input
                    v-model="settings.appointmentInterval"
                    id="appointmentInterval"
                    type="number"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>

            <div class="mb-4">
                <label for="bookablePeriod" class="block text-sm font-medium text-gray-700">Bookable Period (days)</label>
                <input
                    v-model="settings.bookablePeriod"
                    id="bookablePeriod"
                    type="number"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>

            <div class="mb-4">
                <label for="appointmentLimit" class="block text-sm font-medium text-gray-700">Appointment Limit</label>
                <input
                    v-model="settings.appointmentLimit"
                    id="appointmentLimit"
                    type="number"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
            </div>

            <button
                type="submit"
                class="w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Save Settings
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";

// Default settings
const defaultSettings = {
    openDays: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
    openTime: '09:00',
    closeTime: '17:00',
    breakHours: '12:00-13:00',
    appointmentDuration: 30,
    appointmentInterval: 15,
    bookablePeriod: 14,
    appointmentLimit: 5
};

const settings = ref({ ...defaultSettings });
const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

// Initialize form with default settings
onMounted(() => {
    // Fetch current settings from API if needed
    // e.g., axios.get('/api/settings').then(response => settings.value = response.data);
});

function submitForm() {
    // Handle form submission, e.g., send data to the server
    console.log(settings.value);
    // Use Inertia to send data to your backend
    // Inertia.post('/api/settings', settings.value);
}

defineOptions({
    layout: AppLayout,
});
</script>
