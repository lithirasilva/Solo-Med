<template>
    <div class="p-6 bg-gray-50 rounded-lg shadow-md max-h-screen overflow-y-auto">
        <!-- Section Heading -->
        <div class="mb-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 text-center md:text-left">Patient Management</h2>
        </div>

        <!-- Add New Patient Section -->
        <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm flex flex-col md:flex-row items-center md:space-x-4 space-y-4 md:space-y-0">
            <span class="text-lg font-semibold text-gray-800 text-center md:text-left">Add new patient:</span>
            <Link
                href="/patients/create"
                class="bg-green-500 text-white py-2 px-4 rounded-lg flex items-center justify-center space-x-2 hover:bg-green-600 transition-colors w-full md:w-auto"
            >
                <i class="fas fa-user-plus"></i>
                <span>Add Patient</span>
            </Link>
        </div>

        <!-- Patient List -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm overflow-x-auto">
            <ViewPatients :patients="patients" />
        </div>

        <!-- Create Patient Form Modal -->
        <div v-if="showCreateForm" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 p-4 md:p-0">
            <div class="relative bg-white p-6 rounded-lg shadow-lg max-w-full md:max-w-4xl w-full h-full md:h-3/4 overflow-y-auto transition-transform duration-300 ease-in-out transform scale-100">
                <CreatePatientForm @close="showCreateForm = false" />

                <!-- Close Button -->
                <button
                    @click="showCreateForm = false"
                    class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ViewPatients from "@/Components/patient_management/ViewPatients.vue";
import CreatePatientForm from "@/Components/patient_management/CreatePatientForm.vue";
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3'; // Import the Link component

const showCreateForm = ref(false);

const props = defineProps({
    patients: {
        type: Array,
        default: () => [],
    }
});

defineOptions({
    layout: AppLayout,
});
</script>

<style scoped>
/* Small animations */
.transition-transform {
    transition: transform 0.3s ease-in-out;
}

/* For mobile responsiveness */
@media (max-width: 768px) {
    h2 {
        text-align: center;
    }

    button {
        width: 100%;
    }

    .overflow-x-auto {
        overflow-x: auto;
    }
}
</style>
