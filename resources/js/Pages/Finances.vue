<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Finances</h2>

        <div class="mb-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-calendar-day text-blue-500 mr-2"></i>
                <span class="font-semibold">Patients Seen This Month:</span>
                <span class="ml-2">{{ patientsSeenThisMonth }}</span>
            </div>
            <div class="flex items-center mb-4">
                <i class="fas fa-calendar-year text-blue-500 mr-2"></i>
                <span class="font-semibold">Patients Seen This Year:</span>
                <span class="ml-2">{{ patientsSeenThisYear }}</span>
            </div>
        </div>

        <div class="mb-6">
            <div class="flex items-center mb-4">
                <i class="fas fa-dollar-sign text-green-500 mr-2"></i>
                <label for="fee" class="font-semibold">Channeling Fee:</label>
                <input
                    id="fee"
                    type="number"
                    v-model.number="channelingFee"
                    class="ml-2 border border-gray-300 rounded-md px-3 py-1 w-40"
                    placeholder="Enter fee"
                />
            </div>
            <div class="flex items-center mb-4">
                <i class="fas fa-calendar-alt text-orange-500 mr-2"></i>
                <label for="year" class="font-semibold">Year:</label>
                <select
                    id="year"
                    v-model="selectedYear"
                    class="ml-2 border border-gray-300 rounded-md px-3 py-1"
                >
                    <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                </select>
            </div>
            <div class="flex items-center mb-4">
                <i class="fas fa-calendar-month text-purple-500 mr-2"></i>
                <label for="month" class="font-semibold">Month:</label>
                <select
                    id="month"
                    v-model="selectedMonth"
                    class="ml-2 border border-gray-300 rounded-md px-3 py-1"
                >
                    <option v-for="(month, index) in months" :key="index" :value="index + 1">{{ month }}</option>
                </select>
            </div>
            <button
                @click="calculateRevenue"
                class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600"
            >
                Calculate Revenue
            </button>
        </div>

        <div v-if="revenue !== null" class="mt-6">
            <h3 class="text-xl font-bold">Revenue:</h3>
            <p class="text-lg">{{ revenue | currency }}</p>
        </div>

        <div class="p-6 max-w-4xl mx-auto bg-gray-200 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">For now this is a placeholder!!!!</h2>
        </div>

    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from "@/Layouts/AppLayout.vue";

// Reactive state
const patientsSeenThisMonth = ref(0);
const patientsSeenThisYear = ref(0);
const channelingFee = ref(0);
const selectedYear = ref(new Date().getFullYear());
const selectedMonth = ref(new Date().getMonth() + 1); // Months are 0-based
const revenue = ref(null);

// Data for selects
const years = ref([...Array(5).keys()].map(i => new Date().getFullYear() - i));
const months = ref([
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
]);

// Function to calculate revenue
const calculateRevenue = async () => {
    if (selectedMonth.value === '') {
        if (!selectedYear.value) {
            alert('Please specify a year.');
            return;
        }
        // Fetch revenue for the selected year
        const response = await Inertia.get('/api/revenue', {
            year: selectedYear.value,
            channelingFee: channelingFee.value
        });
        revenue.value = response.data.revenue;
    } else {
        if (!selectedYear.value) {
            alert('Please specify a year.');
            return;
        }
        // Fetch revenue for the selected month and year
        const response = await Inertia.get('/api/revenue', {
            year: selectedYear.value,
            month: selectedMonth.value,
            channelingFee: channelingFee.value
        });
        revenue.value = response.data.revenue;
    }
};

// Currency filter
const currency = (value) => {
    if (!value) return '0.00';
    return `$${parseFloat(value).toFixed(2)}`;
};

defineOptions({
    layout: AppLayout,
});
</script>

