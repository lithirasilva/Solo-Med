<template>
    <div class="p-8 bg-gray-50 min-h-screen">
        <!-- Tabs for Viewing Patients -->
        <div class="flex border-b border-gray-200 mb-6">
            <button
                @click="activeTab = 'all'"
                :class="{ 'border-b-2 border-orange-500': activeTab === 'all' }"
                class="px-4 py-2 text-lg font-semibold focus:outline-none"
            >
                All Patients
            </button>
            <button
                @click="activeTab = 'filters'"
                :class="{ 'border-b-2 border-orange-500': activeTab === 'filters' }"
                class="px-4 py-2 text-lg font-semibold focus:outline-none"
            >
                Filters
            </button>
        </div>

        <!-- Filters Tab Content -->
        <div v-if="activeTab === 'filters'" class="mb-6">
            <!-- Gender Filter -->
            <select v-model="selectedGender" @change="filterPatients" class="form-select w-full px-4 py-3 border rounded-lg shadow-sm mb-4">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <!-- Last Visit Date Range -->
            <div class="flex space-x-4 mb-4">
                <input
                    v-model="startDate"
                    @input="filterPatients"
                    type="date"
                    placeholder="Start Date"
                    class="form-input w-full px-4 py-3 border rounded-lg shadow-sm"
                />
                <input
                    v-model="endDate"
                    @input="filterPatients"
                    type="date"
                    placeholder="End Date"
                    class="form-input w-full px-4 py-3 border rounded-lg shadow-sm"
                />
            </div>

            <!-- Age Range -->
            <div class="flex space-x-4 mb-4">
                <input
                    v-model.number="minAge"
                    @input="filterPatients"
                    type="number"
                    placeholder="Min Age"
                    class="form-input w-full px-4 py-3 border rounded-lg shadow-sm"
                />
                <input
                    v-model.number="maxAge"
                    @input="filterPatients"
                    type="number"
                    placeholder="Max Age"
                    class="form-input w-full px-4 py-3 border rounded-lg shadow-sm"
                />
            </div>

            <!-- Clear Filters Button -->
            <button
                @click="clearFilters"
                class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition-colors"
            >
                Clear Filters
            </button>
        </div>

        <!-- All Patients Tab Content -->
        <div v-if="activeTab === 'all'" class="mb-6">
            <!-- Search Bar -->
            <input
                v-model="searchQuery"
                @input="filterPatients"
                type="text"
                placeholder="Search by Name, Email, or Phone..."
                class="form-input w-full px-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 mb-4"
            />
        </div>

        <!-- Patient List -->
        <div v-if="filteredPatients.length > 0">
            <ul>
                <li
                    v-for="patient in paginatedPatients"
                    :key="patient.patientId"
                    class="mb-6 p-4 bg-white rounded-lg shadow-md flex justify-between items-center"
                >
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">{{ patient.firstName }} {{ patient.lastName }}</h3>
                        <p class="text-gray-600"><strong>Email:</strong> {{ patient.email }}</p>
                        <p class="text-gray-600"><strong>Phone:</strong> {{ patient.phone }}</p>
                        <p class="text-gray-600"><strong>Address:</strong> {{ patient.address.street }}, {{ patient.address.city }}, {{ patient.address.province }}, {{ patient.address.country }}</p>
                        <p class="text-gray-600"><strong>Age:</strong> {{ patient.age }}</p>
                        <p class="text-gray-600"><strong>Gender:</strong> {{ patient.gender }}</p>
                        <p class="text-gray-600"><strong>Last Visit:</strong> {{ patient.lastVisit }}</p>
                    </div>
                    <Link
                        :href="`/patients/${patient.patientId}`"
                        class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors"
                    >
                        <i class="fas fa-info-circle mr-2"></i> View Details
                    </Link>
                </li>
            </ul>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6">
                <button
                    v-if="currentPage > 1"
                    @click="prevPage"
                    class="bg-gray-300 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors"
                >
                    Previous
                </button>
                <button
                    v-if="hasMore"
                    @click="nextPage"
                    class="bg-gray-300 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors"
                >
                    Next
                </button>
            </div>
        </div>
        <div v-else>
            <p class="text-gray-600">No patients found.</p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    patients: {
        type: Array,
        default: () => []
    },
});

const activeTab = ref('all');
const searchQuery = ref('');
const selectedGender = ref('');
const startDate = ref('');
const endDate = ref('');
const minAge = ref(null);
const maxAge = ref(null);
const currentPage = ref(1);
const itemsPerPage = ref(5);

const calculateAge = (dateOfBirth) => {
    const birthDate = new Date(dateOfBirth);
    const ageDiff = Date.now() - birthDate.getTime();
    const ageDate = new Date(ageDiff);
    return Math.abs(ageDate.getUTCFullYear() - 1970);
};

const filteredPatients = computed(() => {
    return props.patients.filter(patient => {
        const query = searchQuery.value.toLowerCase();

        const matchesSearchQuery = (
            `${patient.firstName} ${patient.lastName}`.toLowerCase().includes(query) ||
            patient.email.toLowerCase().includes(query) ||
            patient.phone.includes(query)
        );

        const isInDateRange = true; // Assuming there's no lastVisit field, adapt as needed

        const matchesGender = !selectedGender.value || patient.gender === selectedGender.value;

        const matchesAge = (
            (minAge.value === null || calculateAge(patient.dateOfBirth) >= minAge.value) &&
            (maxAge.value === null || calculateAge(patient.dateOfBirth) <= maxAge.value)
        );

        return matchesSearchQuery && matchesGender && matchesAge;
    });
});

const paginatedPatients = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return filteredPatients.value.slice(start, end);
});

const hasMore = computed(() => {
    return filteredPatients.value.length > currentPage.value * itemsPerPage.value;
});

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

const nextPage = () => {
    if (hasMore.value) {
        currentPage.value++;
    }
};

const clearFilters = () => {
    selectedGender.value = '';
    startDate.value = '';
    endDate.value = '';
    minAge.value = null;
    maxAge.value = null;
    searchQuery.value = '';
    activeTab.value = 'all';
};

watch([searchQuery, selectedGender, startDate, endDate, minAge, maxAge, activeTab], () => {
    if (activeTab.value === 'filters') {
        currentPage.value = 1;
    } else {
        currentPage.value = 1;
    }
});
</script>
