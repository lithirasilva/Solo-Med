<template>
    <div class="container mx-auto p-6">
        <!-- Page Title -->
        <h2 class="text-5xl font-extrabold text-gray-900 mb-12 text-center">Patient Profile</h2>

        <!--Patient ID-->
        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Patient ID: {{ patientId }}</h2>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between mb-6">
            <!-- Back to Patients List Button -->
            <Link
                href="/patients"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-600"
            >
                Back to Patients List
            </Link>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8 space-y-12 border border-gray-300">
            <!-- Personal Information -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-4xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-user mr-3 text-2xl"></i> Personal Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <p class="text-xl font-medium text-gray-700"><strong>Name:</strong> {{ patient.firstName }} {{ patient.lastName }}</p>
                        <p class="text-xl font-medium text-gray-700"><strong>Email:</strong> {{ patient.email }}</p>
                        <p class="text-xl font-medium text-gray-700"><strong>Phone:</strong> {{ patient.phone }}</p>
                        <p class="text-xl font-medium text-gray-700"><strong>Date of Birth:</strong> {{ patient.dateOfBirth }}</p>
                    </div>
                    <div class="space-y-6">
                        <p class="text-xl font-medium text-gray-700"><strong>Address:</strong> {{ patient.address.street }}, {{ patient.address.city }}, {{ patient.address.province }}, {{ patient.address.postalCode }}, {{ patient.address.country }}</p>
                        <p class="text-xl font-medium text-gray-700"><strong>Weight:</strong> {{ patient.weightKg }} kg</p>
                        <p class="text-xl font-medium text-gray-700"><strong>Height:</strong> {{ patient.heightCm }} cm</p>
                        <p class="text-xl font-medium text-gray-700"><strong>Blood Type:</strong> {{ patient.bloodType }}</p>
                        <p class="text-xl font-medium text-gray-700"><strong>Age:</strong> {{ patient.age }}</p>
                        <p class="text-xl font-medium text-gray-700"><strong>Last Visit:</strong> {{ patient.lastVisit }}</p>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-4xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-phone-alt mr-3 text-2xl"></i> Emergency Contact
                </h3>
                <p class="text-xl font-medium text-gray-700"><strong>Name:</strong> {{ patient.emergencyContactName }}</p>
                <p class="text-xl font-medium text-gray-700"><strong>Phone:</strong> {{ patient.emergencyContactPhone }}</p>
            </div>

            <!-- Special Notes -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-4xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-sticky-note mr-3 text-2xl"></i> Special Notes
                </h3>
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-xl font-medium text-gray-700">{{ patient.specialNotes }}</p>
                </div>
            </div>

            <!--Patient Records-->

                <div class="bg-gray-100 p-3 rounded-lg shadow-md border border-gray-200 drop-shadow">
                    <Link
                        :href="'/patients/{{ patientId }}/records'"
                    >
                    <h3 class="text-4xl font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fa fa-folder mr-3 text-4xl"></i> Patient Records / Files</h3>
                    </Link>
                </div>



            <!-- Appointments List -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-4xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fa fa-calendar mr-3 text-2xl"></i> Past Appointments
                </h3>
                    <ul class="space-y-4">
                        <li v-for="appointment in patientAppointments" :key="appointment.appointmentId" class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Appointment ID: {{ appointment.appointmentId }}</h3>
                                <p class="text-gray-600">Date: {{ formatDate(appointment.date) }}</p>
                                <p class="text-gray-600">Start Time: {{ formatTime(appointment.startTime) }}</p>
                                <p class="text-gray-600">End Time: {{ formatTime(appointment.endTime) }}</p>
                            </div>
                            <Link :href="`/appointments/${appointment.appointmentId}`" class="text-blue-500 hover:underline">
                                View Details
                            </Link>
                            <hr class="my-4 border-gray-300"/>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
            <div class="flex justify-between">
                <Link
                    :href="`/patients/${patientId}/edit`"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600"
                >
                    Edit Patient
                </Link>
                <button
                    @click="showModal = true"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600"
                >
                    Delete Patient
                </button>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                <h3 class="text-xl font-semibold mb-4">Confirm Deletion</h3>
                <p class="mb-4">Are you sure you want to delete this patient? All of their patient data will be removed.</p>
                <div class="flex justify-end space-x-4">
                    <Link
                        :href="`/patients/${patientId}`"
                        method="delete"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600"
                        data-confirm="Are you sure you want to delete this patient?"
                    >
                        Delete Patient
                    </Link>
                    <button
                        @click="showModal = false"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-600"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { defineProps, ref } from 'vue';
import { useRouter } from 'vue-router';
import { Link } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Appointments from "@/Components/appointment_management/Appointments.vue";

const props = defineProps({
    patient: {
        type: Object,
        required: true
    },
    patientAppointments: {
        type: Array,
        required: true
    }
});

const router = useRouter();
const patientId = props.patient.patientId;  // Assuming the patient object contains an id

const showModal = ref(false);

function formatDate(dateString) {
    if (!dateString) return 'N/A'
    const date = new Date(dateString)
    return date.toLocaleDateString() // Customize as needed
}

function formatTime(timeString) {
    if (!timeString) return 'N/A'
    const time = new Date(timeString)
    return time.toLocaleTimeString() // Customize as needed
}


defineOptions({
    layout: AppLayout
});
</script>
