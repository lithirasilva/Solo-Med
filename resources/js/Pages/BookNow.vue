<template>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">{{ pageTitle }}</h1>
        <form @submit.prevent="submitForm" class="space-y-8 bg-white rounded-lg shadow-lg p-8 overflow-auto">
            <!-- Name Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="firstName" class="block text-sm font-semibold text-gray-700">First Name</label>
                    <input v-model="form.firstName" type="text" id="firstName"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
                <div>
                    <label for="lastName" class="block text-sm font-semibold text-gray-700">Last Name</label>
                    <input v-model="form.lastName" type="text" id="lastName"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
            </div>

            <!-- Contact Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input v-model="form.email" type="email" id="email"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
                    <input v-model="form.phone" type="tel" id="phone"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
            </div>

            <!-- Doctor Section -->
            <div>
                <label for="doctor" class="block text-sm font-semibold text-gray-700">Select Doctor</label>
                <select v-model="form.doctor" id="doctor"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                        required>
                    <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
                        {{ doctor.name }}
                    </option>
                </select>
            </div>

            <!-- Appointment Date & Time Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="appointmentDate" class="block text-sm font-semibold text-gray-700">Appointment Date</label>
                    <input v-model="form.appointmentDate" type="date" id="appointmentDate"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
                <div>
                    <label for="appointmentTime" class="block text-sm font-semibold text-gray-700">Appointment Time</label>
                    <input v-model="form.appointmentTime" type="time" id="appointmentTime"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
            </div>

            <!-- Special Notes Section -->
            <div>
                <label for="specialNotes" class="block text-sm font-semibold text-gray-700">Special Notes</label>
                <textarea v-model="form.specialNotes" id="specialNotes"
                          class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                          rows="4"></textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-between">
                <button type="button" @click="goBack"
                        class="w-full md:w-auto bg-gray-500 text-white py-3 px-4 rounded-lg shadow-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Close
                </button>
                <button type="submit"
                        class="w-full md:w-auto bg-orange-500 text-white py-3 px-4 rounded-lg shadow-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                    Book Appointment
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { useRouter } from 'vue-router'; // Import Vue Router

const { props } = usePage();
const router = useRouter(); // Initialize router
const form = useForm({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    doctor: '',
    appointmentDate: '',
    appointmentTime: '',
    specialNotes: '',
});

const pageTitle = props.pageTitle || 'Book an Appointment';

const doctors = ref([]);

onMounted(() => {
    if (props.appointment) {
        // Populate the form with existing appointment data if available
        Object.assign(form, props.appointment);
    }

    // Fetch the list of doctors from the server or some API
    fetch('/api/doctors')
        .then(response => response.json())
        .then(data => {
            doctors.value = data;
        })
        .catch(error => {
            console.error('Error fetching doctors:', error);
        });
});

const submitForm = () => {
    form.post('/dashboard', {
        onSuccess: () => {
            console.log('Appointment booked successfully');
        },
        onError: (errors) => {
            console.error('There was an error booking the appointment', errors);
        }
    });
};

const goBack = () => {
    // Navigate back to the previous page
    router.back(); // Use Vue Router's back method
};
</script>

<style scoped>
</style>
