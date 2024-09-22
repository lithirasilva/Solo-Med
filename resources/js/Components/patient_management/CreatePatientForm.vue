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

            <!-- Address Section -->
            <div>
                <label for="street" class="block text-sm font-semibold text-gray-700">Street</label>
                <input v-model="form.address.street" type="text" id="street"
                       placeholder="Street"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                       required />
            </div>

            <!-- Address Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <label for="city" class="block text-sm font-semibold text-gray-700">City</label>
                    <input v-model="form.address.city" type="text" id="city"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
                <div>
                    <label for="province" class="block text-sm font-semibold text-gray-700">Province</label>
                    <input v-model="form.address.province" type="text" id="province"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
                <div>
                    <label for="postalCode" class="block text-sm font-semibold text-gray-700">Postal Code</label>
                    <input v-model="form.address.postalCode" type="text" id="postalCode"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
            </div>

            <!-- Country Section -->
            <div>
                <label for="country" class="block text-sm font-semibold text-gray-700">Country</label>
                <input v-model="form.address.country" type="text" id="country"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                       required />
            </div>

            <!-- Medical Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="dateOfBirth" class="block text-sm font-semibold text-gray-700">Date of Birth</label>
                    <input v-model="form.dateOfBirth" type="date" id="dateOfBirth"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
                <div>
                    <label for="bloodType" class="block text-sm font-semibold text-gray-700">Blood Type</label>
                    <input v-model="form.bloodType" type="text" id="bloodType"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
            </div>

            <!-- Physical Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="weightKg" class="block text-sm font-semibold text-gray-700">Weight (kg)</label>
                    <input v-model="form.weightKg" type="number" id="weightKg"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
                <div>
                    <label for="heightCm" class="block text-sm font-semibold text-gray-700">Height (cm)</label>
                    <input v-model="form.heightCm" type="number" id="heightCm"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
            </div>

            <!-- Emergency Contact Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="emergencyContactName" class="block text-sm font-semibold text-gray-700">Emergency Contact Name</label>
                    <input v-model="form.emergencyContactName" type="text" id="emergencyContactName"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                </div>
                <div>
                    <label for="emergencyContactPhone" class="block text-sm font-semibold text-gray-700">Emergency Contact Phone</label>
                    <input v-model="form.emergencyContactPhone" type="tel" id="emergencyContactPhone"
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

            <!-- Gender Section -->
            <div>
                <label class="block text-sm font-semibold text-gray-700">Gender</label>
                <div class="mt-1 flex space-x-4">
                    <div>
                        <input v-model="form.gender" type="radio" id="male" value="Male" class="mr-2" required />
                        <label for="male" class="text-sm text-gray-700">Male</label>
                    </div>
                    <div>
                        <input v-model="form.gender" type="radio" id="female" value="Female" class="mr-2" required />
                        <label for="female" class="text-sm text-gray-700">Female</label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full bg-orange-500 text-white py-3 px-4 rounded-lg shadow-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                    Create Patient
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import eventBus from '@/eventBus';

const { props } = usePage();
const form = useForm({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: {
        street: '',
        city: '',
        province: '',
        postalCode: '',
        country: '',
    },
    dateOfBirth: '',
    bloodType: '',
    weightKg: '',
    heightCm: '',
    emergencyContactName: '',
    emergencyContactPhone: '',
    specialNotes: '',
    gender: '',
});

const pageTitle = props.pageTitle || 'Add New Patient';

onMounted(() => {
    if (props.patient) {
        Object.assign(form, props.patient);
    }
});

const submitForm = () => {
    form.post('/patients', {
        onSuccess: () => {
            // Add notification after successful patient creation
            const notification = {
                title: `${form.firstName} ${form.lastName} - Patient logged successfully`,
                date: new Date().toLocaleDateString(),
                time: new Date().toLocaleTimeString(),
            };
            eventBus.addNotification(notification); // Add the notification to the event bus
            console.log('Patient created successfully');
        },
        onError: (errors) => {
            console.error('There was an error creating the patient', errors);
        }
    });
};
</script>
