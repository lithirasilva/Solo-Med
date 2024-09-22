<template>
    <div class="p-8 bg-white rounded-lg shadow-lg max-w-lg mx-auto relative">
        <h2 class="text-3xl font-extrabold mb-6 text-gray-900">Create Appointment</h2>
        <form @submit.prevent="submitForm" class="space-y-6">

            <!-- Patient field with searchable dropdown -->
            <div class="relative" ref="dropdownContainer">
                <label for="patient" class="block text-gray-700 text-lg font-medium mb-1">Patient</label>
                <div class="flex items-center w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-orange-500">
                    <input
                        type="text"
                        v-model="searchQuery"
                        @input="filterPatients"
                        @focus="dropdownVisible = true"
                        placeholder="Search for a patient..."
                        class="flex-1 focus:outline-none rounded mr-3"
                    />
                    <span v-if="selectedPatient" class="text-gray-700 mr-2">{{ selectedPatient.name }}</span>
                </div>
                <ul v-show="dropdownVisible" class="absolute z-10 w-full bg-white border border-gray-300 mt-1 rounded-lg shadow-lg max-h-60 overflow-auto">
                    <li
                        v-for="patient in filteredPatients"
                        :key="patient.id"
                        @click="selectPatient(patient)"
                        class="cursor-pointer hover:bg-gray-100 px-4 py-2 text-gray-800"
                    >
                        {{ patient.name }}
                    </li>
                    <li v-if="noMatchingPatients" class="cursor-pointer hover:bg-gray-100 px-4 py-2 text-gray-800">
                        Patient not found
                    </li>
                    <li v-if="noMatchingPatients" class="cursor-pointer hover:bg-gray-100 px-4 py-2 text-blue-500">
                        <span @click="showCreatePatientForm = true">Register new patient</span>
                    </li>
                </ul>
                <span v-if="errors.patient_id" class="text-red-600 text-sm mt-1 block">{{ errors.patient_id }}</span>
            </div>

            <!-- Other fields remain unchanged -->
            <!-- Doctor field -->
            <div>
                <label for="doctor" class="block text-gray-700 text-lg font-medium mb-1">Doctor</label>
                <select v-model="form.doctor" id="doctorId" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="" disabled>Select Doctor</option>
                    <option v-for="doctor in doctors" :key="doctor.doctorId" :value="doctor.doctorId">
                        {{ doctor.name }}
                    </option>
                </select>
                <span v-if="errors.doctorId" class="text-red-600 text-sm mt-1 block">{{ errors.doctorId }}</span>
            </div>

            <!-- Date field -->
            <div>
                <label for="date" class="block text-gray-700 text-lg font-medium mb-1">Date</label>
                <input v-model="form.date" type="date" id="date" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" />
                <span v-if="errors.date" class="text-red-600 text-sm mt-1 block">{{ errors.date }}</span>
            </div>

            <!-- Time field -->
            <div>
                <label for="time" class="block text-gray-700 text-lg font-medium mb-1">Time</label>
                <input v-model="form.time" type="time" id="time" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" />
                <span v-if="errors.time" class="text-red-600 text-sm mt-1 block">{{ errors.time }}</span>
            </div>

            <!-- Status field -->
            <div>
                <label for="status" class="block text-gray-700 text-lg font-medium mb-1">Status</label>
                <p class="w-full px-4 py-3 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg shadow-sm">Pending</p>
                <input type="hidden" v-model="form.status" value="pending" />
            </div>

            <!-- Reason for Visit field -->
            <div>
                <label for="reason" class="block text-gray-700 text-lg font-medium mb-1">Reason for Visit</label>
                <textarea v-model="form.reason" id="reason" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                <span v-if="errors.reason" class="text-red-600 text-sm mt-1 block">{{ errors.reason }}</span>
            </div>

            <!-- Notes field -->
            <div>
                <label for="notes" class="block text-gray-700 text-lg font-medium mb-1">Notes</label>
                <textarea v-model="form.notes" id="notes" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
            </div>


            <!-- Submit button -->
            <button type="submit" class="bg-orange-500 text-white py-3 px-6 rounded-lg shadow-md hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-300">
                Create Appointment

            </button>
        </form>

        <!-- Create Patient Form -->
        <div v-if="showCreatePatientForm" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl w-full max-h-screen overflow-y-auto relative">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Create New Patient</h2>

                <CreatePatientForm @close="showCreatePatientForm = false" />

                <button
                    @click="showCreatePatientForm = false"
                    class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

</template>

<script setup>
import {ref, computed, onMounted, onUnmounted} from 'vue';
import {useForm} from '@inertiajs/vue3';
import CreatePatientForm from "@/Components/patient_management/CreatePatientForm.vue";

// Props with default dummy data
const props = defineProps({
patients: [
        {id: 1, name: 'John Doe'},
        {id: 2, name: 'Jane Doe'},
        {id: 3, name: 'Alice Smith'},
        {id: 4, name: 'Bob Johnson'},
    ],
    doctor: {} ,
});

const doctors = [props.doctor];


// Initialize form with default status as 'pending'
const {data: form, setData, post, errors} = useForm({
    patientId: null,
    doctorId: '',
    date: '',
    time: '',
    status: 'pending',
    reason: '',
    notes: '',
});

// Reactive variables for search query, selected patient, and state
const searchQuery = ref('');
const showCreatePatientForm = ref(false);
const noMatchingPatients = ref(false);
const selectedPatient = ref(null);
const dropdownVisible = ref(false);
const dropdownContainer = ref(null);

// Computed property to filter patients based on search query
const filteredPatients = computed(() => {
    if (!searchQuery.value) {
        noMatchingPatients.value = false;
        return [];
    }

    const matches = props.patients.filter(patient =>
        patient.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );

    noMatchingPatients.value = matches.length === 0;
    return matches;
});

// Handle patient selection
const selectPatient = (patient) => {
    selectedPatient.value = patient;
    searchQuery.value = '';  // Clear search query after selection
    dropdownVisible.value = false;  // Hide dropdown after selection
};

// Deselect the patient
const deselectPatient = () => {
    selectedPatient.value = null;
};

// Handle the form submission
const submitForm = () => {
    setData('patient_id', selectedPatient.value?.id || null);
    post('/appointments');  // Replace with your desired endpoint
};

// Filter patients list based on the search query
const filterPatients = () => {
    noMatchingPatients.value = filteredPatients.value.length === 0;
};

// Handle clicks outside of the dropdown
const handleClickOutside = (event) => {
    if (dropdownContainer.value && !dropdownContainer.value.contains(event.target)) {
        dropdownVisible.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>
