<template>
    <div class="p-8 bg-gray-50 min-h-screen">
        <h2 class="text-3xl font-extrabold mb-6 text-gray-900">Upcoming Appointments</h2>
        <div v-if="appointments.length > 0">
            <ul>
                <li
                    v-for="appointment in appointments"
                    :key="appointment.patient_id"
                    class="mb-6 p-4 bg-white rounded-lg shadow-md"
                >
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ appointment.patient_name }}</h3>
                            <p class="text-gray-600"><strong>Date:</strong> {{ appointment.date }}</p>
                            <p class="text-gray-600"><strong>Time:</strong> {{ appointment.time }}</p>
                            <p class="text-gray-600"><strong>Status:</strong> {{ appointment.status }}</p>
                        </div>
                        <button
                            @click="viewAppointmentDetails(appointment)"
                            class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors"
                        >
                            View Details
                        </button>
                    </div>
                    <p class="text-gray-700"><strong>Reason:</strong> {{ appointment.reason }}</p>
                </li>
            </ul>
        </div>
        <div v-else>
            <p class="text-gray-600">No upcoming appointments.</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

// Dummy data for appointments
const appointments = ref([
    { patient_id: 1, patient_name: 'John Doe', date: '2024-08-25', time: '09:00', status: 'Pending', reason: 'Routine check-up' },
    { patient_id: 2, patient_name: 'Jane Smith', date: '2024-08-26', time: '10:30', status: 'Pending', reason: 'Follow-up visit' },
    { patient_id: 3, patient_name: 'Emily Johnson', date: '2024-08-27', time: '11:00', status: 'Pending', reason: 'Consultation' },
    { patient_id: 4, patient_name: 'Michael Brown', date: '2024-08-28', time: '13:00', status: 'Pending', reason: 'Emergency visit' },
    { patient_id: 5, patient_name: 'Sarah Davis', date: '2024-08-29', time: '14:30', status: 'Pending', reason: 'Routine check-up' },
    { patient_id: 6, patient_name: 'David Wilson', date: '2024-08-30', time: '15:00', status: 'Pending', reason: 'Follow-up visit' },
    { patient_id: 7, patient_name: 'Sophia Martinez', date: '2024-08-31', time: '16:00', status: 'Pending', reason: 'Consultation' },
    { patient_id: 8, patient_name: 'Daniel Garcia', date: '2024-09-01', time: '08:30', status: 'Pending', reason: 'Emergency visit' },
    { patient_id: 9, patient_name: 'Olivia Rodriguez', date: '2024-09-02', time: '09:45', status: 'Pending', reason: 'Routine check-up' },
    { patient_id: 10, patient_name: 'James Taylor', date: '2024-09-03', time: '10:15', status: 'Pending', reason: 'Follow-up visit' }
]);

// Method to handle viewing appointment details
const viewAppointmentDetails = (appointment) => {
    // Implement logic to view details of the selected appointment
    // For example, redirect to an appointment detail page or show a modal
    console.log('Viewing details for appointment:', appointment);
};
</script>

<style scoped>
/* Add any additional scoped styles here */
</style>
