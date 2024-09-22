<template>
    <div class="p-6 bg-gray-50 rounded-lg shadow-md">
        <!-- Section Heading -->
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-900">Patient Management</h2>
        </div>

        <!-- Add New Patient Section -->
        <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm flex items-center space-x-4">
            <span class="text-lg font-semibold text-gray-800">Add new patient:</span>
            <button
                @click="addNewPatient"
                class="bg-green-500 text-white py-2 px-4 rounded-lg flex items-center space-x-2 hover:bg-green-600 transition-colors"
            >
                <i class="fas fa-user-plus"></i>
                <span>Add Patient</span>
            </button>
        </div>

        <!-- Patient List -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
            <ViewPatients/>
        </div>
    </div>
</template>

<script setup>
import ViewPatients from "@/Components/patient_management/ViewPatients.vue";
import {ref} from 'vue';
</script>
