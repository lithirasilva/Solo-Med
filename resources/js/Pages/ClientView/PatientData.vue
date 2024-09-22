<template>
    <!-- Main wrapper to center content -->
    <div class="my-data max-w-4xl mx-auto p-6 sm:p-8">

        <!-- Title -->
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">My Data</h1>

        <!-- Profile Information Section -->
        <div class="profile-info bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Profile Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-medium text-gray-600">Name:</label>
                    <p class="text-gray-800">{{ profile.name }}</p>
                </div>
                <div>
                    <label class="font-medium text-gray-600">Email:</label>
                    <p class="text-gray-800">{{ profile.email }}</p>
                </div>
                <div>
                    <label class="font-medium text-gray-600">Phone:</label>
                    <p class="text-gray-800">{{ profile.phone }}</p>
                </div>
                <div>
                    <label class="font-medium text-gray-600">Date of Birth:</label>
                    <p class="text-gray-800">{{ profile.dob }}</p>
                </div>
            </div>
        </div>

        <!-- Additional Notes Section -->
        <div class="additional-notes bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Additional Notes</h2>
            <ul>
                <li
                    v-for="note in notes"
                    :key="note.id"
                    class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200"
                >
                    <p class="text-gray-700">{{ note.content }}</p>
                    <small class="text-gray-500">Added on: {{ note.date }}</small>
                </li>
            </ul>
        </div>

        <!-- Files Section -->
        <div class="files bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Files</h2>
            <ul>
                <li
                    v-for="file in files"
                    :key="file.id"
                    class="mb-2 p-3 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition"
                >
                    <a :href="file.url" class="text-blue-500 hover:underline">{{ file.name }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import PatientLayout from '@/Layouts/PatientLayout.vue';

defineOptions({
    layout: PatientLayout,
});

// Mock data for the user profile, notes, and files
const profile = ref({
    name: 'John Doe',
    email: 'john.doe@example.com',
    phone: '+1234567890',
    dob: '1990-05-15',
});

const notes = ref([
    {id: 1, content: 'Follow-up visit scheduled for next month.', date: '2024-08-12'},
    {id: 2, content: 'Patient shows signs of improvement.', date: '2024-09-02'},
]);

const files = ref([
    {id: 1, name: 'Medical Report - August', url: '/files/august-report.pdf'},
    {id: 2, name: 'Prescription - September', url: '/files/september-prescription.pdf'},
]);
</script>

<style scoped>
/* Center the content and set max width */
.my-data {
    max-width: 1024px; /* Limits the width */
    margin-left: auto;
    margin-right: auto;
    padding: 20px; /* General padding around the content */
}

/* Mobile responsiveness */
@media (min-width: 768px) {
    .profile-info .grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)); /* Two columns for larger screens */
    }
}

/* Ensure a centered layout and proper padding for all devices */
h1, h2 {
    text-align: center; /* Center titles */
}

/* Customize shadow and border */
.bg-white {
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for modern look */
}

@media (min-width: 640px) {
    .my-data {
        padding: 40px; /* More padding for larger screens */
    }
}
</style>
