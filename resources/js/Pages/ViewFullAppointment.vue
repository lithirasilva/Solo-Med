<template>
    <div class="p-8 bg-white rounded-lg shadow-lg max-w-3xl mx-auto">
        <div class="m-2">
            <Link
                :href="`/appointments`"
                class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition-colors m-2"
            >
                Back
            </Link>
        </div>

        <h2 class="text-3xl font-extrabold mb-6 text-gray-900">Appointment Details</h2>

        <div v-if="appointment">
            <!-- Patient Details -->
            <div class="mb-8 p-6 border border-gray-200 rounded-lg shadow-sm">
                <h3 class="text-2xl font-semibold mb-4 text-gray-800">Patient Details</h3>
                <p class="text-gray-700"><strong>Name:</strong> {{ appointment.patient.firstName }} {{appointment.patient.lastName}}</p>
                <p class="text-gray-700"><strong>Age:</strong> {{ appointment.patient.age }}</p>
                <p class="text-gray-700"><strong>Email:</strong> {{ appointment.patient.email }}</p>
                <p class="text-gray-700"><strong>Phone:</strong> {{ appointment.patient.phone }}</p>
                <button
                    @click="viewPatientProfile"
                    class="mt-4 bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">
                    View Full Patient Profile
                </button>
            </div>

            <!-- Doctor Details -->
            <div class="mb-8 p-6 border border-gray-200 rounded-lg shadow-sm">
                <h3 class="text-2xl font-semibold mb-4 text-gray-800">Doctor Details</h3>
                <p class="text-gray-700"><strong>Name:</strong> {{ appointment.doctor.firstName }} {{appointment.doctor.lastName}}</p>
                <p class="text-gray-700"><strong>Specialty:</strong> {{ appointment.doctor.specialty }}</p>
            </div>

            <!-- Appointment Details -->
            <div class="mb-8 p-6 border border-gray-200 rounded-lg shadow-sm">
                <p class="text-orange-700 "><strong>Status:</strong> {{ appointment.status }}</p>
                <h3 class="text-2xl font-semibold mb-4 text-gray-800">Appointment Details</h3>
                <p class="text-gray-700"><strong>Date:</strong> {{ appointment.date }}</p>
                <p class="text-gray-700"><strong>Time:</strong> {{ appointment.startTime }}</p>
                <p class="text-gray-700"><strong>Reason for Visit:</strong> {{ appointment.reason }}</p>
                <p class="text-gray-700"><strong>Notes:</strong> {{ appointment.notes }}</p>
            </div>

            <!-- Status Toggle and Actions -->
            <div class="flex items-center mb-8">
                <label for="complete-status" class="mr-4 text-lg font-medium text-gray-700">Complete Appointment:</label>
                <input
                    type="checkbox"
                    id="complete-status"
                    v-model="isCompleted"
                    @change="toggleCompletion"
                    class="form-checkbox h-6 w-6 text-green-600 border-gray-300 rounded transition duration-150 ease-in-out"
                />
            </div>

            <div class="flex space-x-4">
                <button
                    @click="editAppointment"
                    class="bg-yellow-500 text-white py-2 px-6 rounded-lg hover:bg-yellow-600 transition-colors">
                    Update Appointment
                </button>

                <button
                    @click="cancelAppointment(appointment.appointmentId)"
                    class="bg-red-500 text-white py-2 px-6 rounded-lg hover:bg-yellow-600 transition-colors">
                    Cancel Appointment
                </button>
                <!-- Additional buttons can be added here -->
            </div>
        </div>
        <div v-else>
            <p class="text-gray-600">Loading appointment details...</p>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import {Inertia} from "@inertiajs/inertia";
import {Link} from "@inertiajs/vue3";

// Define props for the component
const props = defineProps({
    appointment: {
        type: Object,
        default: () => null,
    },
});

// Define reactive variables
const isCompleted = ref(props.appointment?.status === 'completed');

// Watch for changes to the appointment prop
watch(() => props.appointment, (newAppointment) => {
    if (newAppointment) {
        isCompleted.value = newAppointment.status === 'completed';
    }
}, { immediate: true });

// Methods for actions
const viewPatientProfile = () => {
    // Implement logic to view the full patient profile
    window.location.href = `/patients/${props.appointment.patient_id}`;
};

const toggleCompletion = () => {
    // Implement logic to mark appointment as completed or pending
    console.log('Appointment status toggled:', isCompleted.value);
};

const editAppointment = () => {
    // take to the url appointments/{appointmentId}/edit
    window.location.href = `/appointments/${props.appointment.appointmentId}/edit`;
};


const cancelAppointment = (appointmentId) => {
    if (confirm('Are you sure you want to cancel this appointment?')) {
        Inertia.delete(`/appointments/${appointmentId}`);
    }
};

</script>

<style scoped>
/* Add any additional scoped styles here */
</style>
