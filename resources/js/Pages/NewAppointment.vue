<template>
    <div class="p-4 md:p-8 bg-white rounded-lg shadow-lg max-w-2xl mx-auto">
        <div class="mb-4">
            <Link href="/appointments" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                &larr; Back
            </Link>
        </div>

        <h2 class="text-2xl md:text-3xl font-bold mb-6 text-gray-900">Create Appointment</h2>

        <form @submit.prevent="submitForm" class="space-y-4 md:space-y-6">
            <div class="relative" ref="dropdownContainer">
                <label for="patient" class="block text-lg font-medium text-gray-700 mb-1">Patient</label>
                <div class="flex flex-col">
                    <div class="flex items-center w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-orange-500">
                        <input
                            type="text"
                            v-model="searchQuery"
                            @input="filterPatients"
                            @focus="dropdownVisible = true"
                            placeholder="Search for a patient by name, email, or ID..."
                            class="flex-1 focus:outline-none rounded-md border-gray-300 focus:border-orange-500"
                        />
                    </div>
                    <div v-if="selectedPatient" class="mt-2 p-4 border border-gray-300 rounded-lg bg-gray-50 flex items-center">
                        <span class="text-gray-700">
                            Selected Patient: {{ selectedPatient.firstName }} {{ selectedPatient.lastName }} ({{ selectedPatient.email }})
                        </span>
                        <button @click="deselectPatient" class="ml-2 text-red-500 hover:text-red-700 focus:outline-none">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                </div>

                <ul v-show="dropdownVisible" class="absolute z-10 w-full bg-white border border-gray-300 mt-1 rounded-lg shadow-lg max-h-60 overflow-auto" ref="dropdownList">
                    <li v-for="patient in filteredPatients" :key="patient.patientId" @click="selectPatient(patient)" class="px-4 py-2 text-gray-800 hover:bg-gray-100 cursor-pointer flex items-center justify-between">
                        <span class="text-lg font-medium">{{ patient.firstName }} {{ patient.lastName }}</span>
                        <span class="text-sm text-gray-500">ID: {{ patient.patientId }} | {{ patient.email }}</span>
                    </li>
                    <li v-if="noMatchingPatients" class="px-4 py-2 text-gray-800">Patient not found</li>
                    <li v-if="noMatchingPatients" class="px-4 py-2 text-blue-500 cursor-pointer hover:underline">
                        <span @click="showCreatePatientForm = true">Click here to create new patient</span>
                    </li>
                </ul>

                <span v-if="errors.patientId" class="text-red-600 text-sm mt-1">{{ errors.patientId }}</span>
            </div>

            <div>
                <label for="dateTime" class="block text-lg font-medium text-gray-700 mb-1">Date and Time</label>
                <div class="bg-gray-200 rounded p-2 cursor-pointer drop-shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" @click="showDateTimePickerModal = true">
                    <div class="m-1 p-1"><i class="fa fa-calendar"></i> Date: <span>{{ form.date }}</span></div>
                    <div class="m-1 p-1"><i class="fa fa-clock"></i> Time: <span>{{ form.startTime }} - {{ form.endTime }}</span></div>
                </div>
                <span v-if="errors.date" class="text-red-600 text-sm mt-1">{{ errors.date }}</span>
                <span v-if="errors.startTime" class="text-red-600 text-sm mt-1">{{ errors.startTime }}</span>
                <span v-if="errors.endTime" class="text-red-600 text-sm mt-1">{{ errors.endTime }}</span>
            </div>

            <div>
                <label for="reason" class="block text-lg font-medium text-gray-700 mb-1">Reason</label>
                <textarea v-model="form.reason" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" rows="3"></textarea>
                <span v-if="errors.reason" class="text-red-600 text-sm mt-1">{{ errors.reason }}</span>
            </div>

            <div>
                <label for="notes" class="block text-lg font-medium text-gray-700 mb-1">Notes</label>
                <textarea v-model="form.notes" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" rows="3"></textarea>
                <span v-if="errors.notes" class="text-red-600 text-sm mt-1">{{ errors.notes }}</span>
            </div>

            <button type="submit" class="w-full bg-orange-500 text-white py-3 px-6 rounded-lg shadow-md hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-300">
                Create Appointment
            </button>
        </form>

        <div class="mt-8 p-4 border border-gray-300 rounded-lg bg-gray-50">
            <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-900">Form Data</h3>
            <p><strong>Patient ID:</strong> {{ form.patientId }}</p>
            <p><strong>Date:</strong> {{ form.date }}</p>
            <p><strong>Start Time:</strong> {{ form.startTime }}</p>
            <p><strong>End Time:</strong> {{ form.endTime }}</p>
            <p><strong>Reason:</strong> {{ form.reason }}</p>
            <p><strong>Notes:</strong> {{ form.notes }}</p>
        </div>

        <!-- DateTime Picker Modal -->
        <div v-if="showDateTimePickerModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-4 md:p-8 rounded-lg shadow-lg max-w-xl w-full relative">
                <h2 class="text-2xl font-bold mb-4 text-gray-900">Select Date and Time</h2>
                <div class="mb-4">
                    <input type="date" v-model="date" @change="updateDate" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4 max-h-64 overflow-y-auto">
                    <label class="block text-lg font-medium text-gray-700 mb-1">Select Time Slot</label>
                    <ul class="space-y-2">
                        <li v-for="slot in timeSlots" :key="slot.start" class="flex justify-between">
                            <button
                                type="button"
                                @click="selectTime(slot.start, slot.end)"
                                class="w-full bg-gray-200 text-gray-800 py-2 px-4 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
                            >
                                {{ slot.start }} - {{ slot.end }}
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="flex justify-between">
                    <button @click="applyDateTime" class="bg-orange-500 text-white py-2 px-4 rounded-lg shadow-md hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-300">OK</button>
                    <button @click="resetDateTime" class="bg-gray-500 text-white py-2 px-4 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-300">Reset</button>
                </div>
                <button @click="showDateTimePickerModal = false" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 focus:outline-none">
                    X
                </button>
            </div>
        </div>

        <div v-if="showCreatePatientForm" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-xl w-full relative">
                <h2 class="text-2xl font-bold mb-4 text-gray-900">Register New Patient</h2>
                <CreatePatientForm @close="showCreatePatientForm = false" />
                <button @click="showCreatePatientForm = false" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 focus:outline-none">
                    X
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';

const props = defineProps([
    'patients',
    'doctors',
    'takenAppointments',
    'clinicSettings',
]);

const form = reactive({
    patientId: '',
    doctorId: props.doctors.doctorId,
    date: '',
    startTime: '',
    endTime: '',
    status: 'pending',
    reason: '',
    notes: ''
});
const errors = ref({});
const searchQuery = ref('');
const dropdownVisible = ref(false);
const showDateTimePickerModal = ref(false);
const showCreatePatientForm = ref(false);
const selectedPatient = ref(null); // Add selectedPatient state

const patients = ref(props.patients);
const filteredPatients = computed(() => {
    return patients.value.filter(patient =>
        patient.firstName.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        patient.lastName.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        patient.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        patient.patientId.toString().includes(searchQuery.value)
    );
});
const noMatchingPatients = computed(() => filteredPatients.value.length === 0 && searchQuery.value.length > 0);

const date = ref('');
const timeSlots = ref([]);

const generateTimeSlots = () => {
    const slots = [];
    const startHour = 8; // 8 AM
    const endHour = 17; // 5 PM
    for (let hour = startHour; hour < endHour; hour++) {
        for (let min = 0; min < 60; min += 15) {
            const start = hour.toString().padStart(2, '0') + ':' + min.toString().padStart(2, '0');
            const endMin = min + 15;
            const endHourAdjusted = endMin >= 60 ? hour + 1 : hour;
            const endMinAdjusted = endMin >= 60 ? endMin - 60 : endMin;
            const end = endHourAdjusted.toString().padStart(2, '0') + ':' + endMinAdjusted.toString().padStart(2, '0');
            slots.push({ start, end });
        }
    }
    timeSlots.value = slots;
};

generateTimeSlots();

const updateDate = () => {
    form.date = date.value;
};

const selectTime = (start, end) => {
    form.startTime = start;
    form.endTime = end;
};

const applyDateTime = () => {
    if (form.startTime && form.endTime) {
        showDateTimePickerModal.value = false;
    }
};

const resetDateTime = () => {
    date.value = '';
    form.startTime = '';
    form.endTime = '';
};

const validateForm = () => {
    errors.value = {};
    if (!form.patientId) {
        errors.value.patientId = 'Patient is required.';
    }
    if (!form.date) {
        errors.value.date = 'Date is required.';
    }
    if (!form.startTime) {
        errors.value.startTime = 'Start time is required.';
    }
    if (!form.endTime) {
        errors.value.endTime = 'End time is required.';
    }
    if (!form.reason) {
        errors.value.reason = 'Reason is required.';
    }
};

const submitForm = () => {
    validateForm();
    if (Object.keys(errors.value).length === 0) {
        Inertia.post('/appointments', form, {
            onSuccess: () => {
                Object.keys(form).forEach(key => form[key] = '');
                searchQuery.value = '';
                dropdownVisible.value = false;
                showDateTimePickerModal.value = false;
                showCreatePatientForm.value = false;
                selectedPatient.value = null; // Reset selected patient
            }
        });
    }
};
const selectPatient = (patient) => {
    form.patientId = patient.patientId;
    selectedPatient.value = patient; // Set the selected patient
    searchQuery.value = `${patient.firstName} ${patient.lastName}`; // Update the search query
    dropdownVisible.value = false;
};

const deselectPatient = () => {
    form.patientId = '';
    searchQuery.value = '';
    dropdownVisible.value = false;
    selectedPatient.value = null; // Clear selected patient
};

watch(() => form.patientId, (newVal) => {
    if (!newVal) {
        searchQuery.value = '';
        selectedPatient.value = null; // Clear selected patient if patient ID is cleared
    }
});

defineOptions({
    layout: AppLayout,
});
</script>