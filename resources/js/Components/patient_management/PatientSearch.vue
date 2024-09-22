<template>
    <div class="relative" ref="dropdownContainer">
        <label for="patient" class="block text-gray-700 text-lg font-medium mb-1">Patient</label>
        <div class="flex items-center w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-orange-500">
            <input
                type="text"
                v-model="searchQuery"
                @input="filterPatients"
                @focus="dropdownVisible = true"
                placeholder="Search for a patient by Name , Email or Patient ID"
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
                <span @click="$emit('create-new')">Register new patient</span>
            </li>
        </ul>
        <span v-if="errors.patient_id" class="text-red-600 text-sm mt-1 block">{{ errors.patient_id }}</span>
    </div>
</template>

<script setup>
import {ref, computed, onMounted, onUnmounted} from 'vue';

const props = defineProps({
    patients: {
        type: Array,
        default: () => [
            {id: 1, name: 'John Doe', email: 'john@example.com'},
            {id: 2, name: 'Jane Doe', email: 'jane@example.com'},
            {id: 3, name: 'Alice Smith', email: 'alice@example.com'},
            {id: 4, name: 'Bob Johnson', email: 'bob@example.com'}
        ]
    },
    errors: {
        type: Object,
        default: () => ({})
    }
});

const emit = defineEmits(['update:selectedPatient', 'create-new']);

const searchQuery = ref('');
const selectedPatient = ref(null);
const dropdownVisible = ref(false);
const dropdownContainer = ref(null);
const noMatchingPatients = ref(false);

const filteredPatients = computed(() => {
    if (!searchQuery.value) {
        noMatchingPatients.value = false;
        return [];
    }

    const query = searchQuery.value.toLowerCase();
    const matches = props.patients.filter(patient =>
        patient.name.toLowerCase().includes(query) ||
        patient.email.toLowerCase().includes(query) ||
        patient.id.toString().includes(query)
    );

    noMatchingPatients.value = matches.length === 0;
    return matches;
});

const selectPatient = (patient) => {
    selectedPatient.value = patient;
    searchQuery.value = '';  // Clear search query after selection
    dropdownVisible.value = false;  // Hide dropdown after selection
    emit('update:selectedPatient', patient);
};

const filterPatients = () => {
    noMatchingPatients.value = filteredPatients.value.length === 0;
};

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

<style scoped>
/* Add any necessary styles here */
</style>
