<template>
    <div class="p-6 max-w-5xl mx-auto bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Medical Records</h1>
        <div class="m-4">
            <Link
                :href="'/medical-records/create'"
                class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-blue-600 "
            >
                Add New Record
            </Link>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Date & Time</th>
                <th class="py-2 px-4 border-b">Medical Record ID</th>
                <th class="py-2 px-4 border-b">Patient ID</th>
                <th class="py-2 px-4 border-b">Doctor ID</th>
                <th class="py-2 px-4 border-b">Record Title</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="record in medicalRecords" :key="record.medicalRecordId">
                <td class="py-2 px-4 border-b">{{ new Date(record.created_at).toLocaleString()  }}</td>
                <td class="py-2 px-4 border-b">{{ record.medicalRecordId }}</td>
                <td class="py-2 px-4 border-b">{{ record.patientId }}</td>
                <td class="py-2 px-4 border-b">{{ record.doctorId }}</td>
                <td class="py-2 px-4 border-b">{{ record.recordTitle }}</td>
                <td class="py-2 px-4 border-b">
                    <button @click="showRecord(record.medicalRecordId)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mx-2">
                        View Record
                    </button>
                    <button @click="deleteRecord(record.medicalRecordId)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mx-2">
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script setup>
import { ref } from 'vue';
import { usePage, useForm, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from "@/Layouts/AppLayout.vue";

const { medicalRecords } = usePage().props;

const deleteRecord = (id) => {
    if (confirm('Are you sure you want to delete this medical record?')) {
        Inertia.delete(`/medical-records/${id}`);
    }
};

const showRecord = (id) => {
    Inertia.get(`/medical-records/${id}`);
};

defineOptions(
    {
        layout: AppLayout,
    }

);
</script>

<style scoped>
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    text-align: left;
}
</style>
