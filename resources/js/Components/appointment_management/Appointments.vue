<template>
    <div class="p-8 bg-gray-100 min-h-screen">
        <!-- Title and Add New Appointment Button -->
        <div v-if="!lockedPatient" class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-extrabold text-gray-800">
                <i class="fas fa-calendar-day mr-2"></i> Appointments
            </h1>
            <!-- New Appointment Button -->
            <button
                @click="showCreateForm = true"
                class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors flex items-center"
            >
                <i class="fas fa-plus mr-2"></i> New Appointment
            </button>
        </div>

        <!-- Search Bar -->
        <div v-if="!lockedPatient" class="mb-6">
            <input
                v-model="searchQuery"
                @input="filterAppointments"
                type="text"
                :placeholder="lockedPatient ? 'Search by Appointment ID...' : 'Search by Name, Email, or Appointment ID...'"
                class="form-input w-full px-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
            />
        </div>

        <!-- Date Range Picker -->
        <div class="mb-6 flex gap-4">
            <div class="w-1/2">
                <label for="startDate" class="block text-gray-700">Start Date:</label>
                <input
                    v-model="startDate"
                    type="date"
                    id="startDate"
                    class="form-input w-full px-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
            </div>
            <div class="w-1/2">
                <label for="endDate" class="block text-gray-700">End Date:</label>
                <input
                    v-model="endDate"
                    type="date"
                    id="endDate"
                    class="form-input w-full px-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
            </div>
        </div>

        <!-- Appointment List -->
        <div v-if="filteredAppointments.length > 0">
            <ul>
                <li
                    v-for="appointment in paginatedAppointments"
                    :key="appointment.id"
                    class="mb-6 p-4 bg-white rounded-lg shadow-md flex justify-between items-center"
                >
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">Appointment ID: {{ appointment.id }}</h3>
                        <p class="text-xl font-semibold text-gray-800">{{ appointment.patient_name }}</p>
                        <p class="text-gray-600"><strong>Date:</strong> {{ appointment.date }}</p>
                        <p class="text-gray-600"><strong>Time:</strong> {{ appointment.time }}</p>
                    </div>
                    <Link
                        :href="`/patients/${appointment.id}`"
                        class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors"
                    >
                        <i class="fas fa-info-circle mr-2"></i> View Details
                    </Link>
                </li>
            </ul>

            <!-- Pagination -->
            <div class="flex justify-between items-center">
                <button
                    v-if="currentPage > 1"
                    @click="currentPage--"
                    class="bg-gray-300 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors flex items-center"
                >
                    <i class="fas fa-chevron-left mr-2"></i> Previous
                </button>
                <button
                    v-if="hasMore"
                    @click="currentPage++"
                    class="bg-gray-300 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors flex items-center"
                >
                    <i class="fas fa-chevron-right mr-2"></i> Next
                </button>
            </div>
        </div>
        <div v-else>
            <p class="text-gray-600">No appointments found.</p>
        </div>

        <!-- Create Appointment Form -->
        <div v-if="showCreateForm" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="relative bg-white p-6 rounded-lg shadow-lg max-w-4xl w-full h-3/4 overflow-y-auto">
                <CreateAppointmentForm @close="showCreateForm = false" />
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
import { ref, computed, watch } from 'vue';
import CreateAppointmentForm from '@/Components/appointment_management/CreateAppointmentForm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    lockedPatient: {
        type: Boolean,
        default: false
    },
    appointments: {
        type: Array,
    }
});

// Reactive variables
const activeTab = ref('upcoming'); // Default tab
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = ref(5); // Adjust items per page as needed
const startDate = ref('');
const endDate = ref('');
const showCreateForm = ref(false); // Controls visibility of the Create Appointment form

// Computed properties
const filteredAppointments = computed(() => {
    const query = searchQuery.value.toLowerCase();
    const start = startDate.value ? new Date(startDate.value) : null;
    const end = endDate.value ? new Date(endDate.value) : null;

    return props.appointments.filter(appointment => {
        const appointmentDate = new Date(appointment.date);

        // Search filter
        const matchesSearchQuery = props.lockedPatient
            ? appointment.id.toString().includes(query) // Only search by Appointment ID
            : (
                appointment.patient_name.toLowerCase().includes(query) ||
                appointment.email.toLowerCase().includes(query) ||
                appointment.id.toString().includes(query) // Include ID search as well
            );

        // Date range filter
        const isInDateRange = (
            (!start || appointmentDate >= start) &&
            (!end || appointmentDate <= end)
        );

        // Apply tab filter
        const isActiveTab = activeTab.value === 'upcoming'
            ? appointmentDate >= new Date().setHours(0, 0, 0, 0) // Future dates are 'upcoming'
            : appointmentDate < new Date().setHours(0, 0, 0, 0); // Past dates

        return matchesSearchQuery && isInDateRange && isActiveTab;
    });
});

const paginatedAppointments = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return filteredAppointments.value.slice(start, end);
});

const hasMore = computed(() => {
    return filteredAppointments.value.length > currentPage.value * itemsPerPage.value;
});

// Watch for changes to the search query, date range, and active tab, and reset pagination
watch([searchQuery, startDate, endDate, activeTab], () => {
    currentPage.value = 1;
});
</script>
