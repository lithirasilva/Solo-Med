<template>
    <div class="max-w-5xl mx-auto p-6">
        <!-- Back Button -->
        <div class="mb-4">
            <Link
                :href="`/patients/${patientId}`"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-500 rounded-lg shadow-sm hover:bg-gray-600"
            >
                Back to Patient
            </Link>
        </div>

        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-8">{{ pageTitle }}</h1>

        <!-- Patient ID Display -->
        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Patient ID: {{ patientId }}</h2>
        </div>

        <!-- Form -->
        <form @submit.prevent="submitForm" class="space-y-8 bg-white rounded-lg shadow-lg p-8 overflow-auto">
            <!-- Name Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="firstName" class="block text-sm font-semibold text-gray-700">First Name</label>
                    <input v-model="form.firstName" type="text" id="firstName"
                           :class="{'border-red-500': errors.firstName}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.firstName" class="text-red-500 text-sm mt-1">{{ errors.firstName }}</p>
                </div>
                <div>
                    <label for="lastName" class="block text-sm font-semibold text-gray-700">Last Name</label>
                    <input v-model="form.lastName" type="text" id="lastName"
                           :class="{'border-red-500': errors.lastName}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.lastName" class="text-red-500 text-sm mt-1">{{ errors.lastName }}</p>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input v-model="form.email" type="email" id="email" readonly
                           class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-lg shadow-sm cursor-not-allowed"
                           required />
                </div>
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
                    <input v-model="form.phone" type="tel" id="phone"
                           :class="{'border-red-500': errors.phone}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.phone" class="text-red-500 text-sm mt-1">{{ errors.phone }}</p>
                </div>
            </div>

            <!-- Address Section -->
            <div>
                <label for="street" class="block text-sm font-semibold text-gray-700">Street</label>
                <input v-model="form.address.street" type="text" id="street"
                       :class="{'border-red-500': errors.street}"
                       placeholder="Street"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                       required />
                <p v-if="errors.street" class="text-red-500 text-sm mt-1">{{ errors.street }}</p>
            </div>

            <!-- Address Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <label for="city" class="block text-sm font-semibold text-gray-700">City</label>
                    <input v-model="form.address.city" type="text" id="city"
                           :class="{'border-red-500': errors.city}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.city" class="text-red-500 text-sm mt-1">{{ errors.city }}</p>
                </div>
                <div>
                    <label for="province" class="block text-sm font-semibold text-gray-700">Province</label>
                    <input v-model="form.address.province" type="text" id="province"
                           :class="{'border-red-500': errors.province}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.province" class="text-red-500 text-sm mt-1">{{ errors.province }}</p>
                </div>
                <div>
                    <label for="postalCode" class="block text-sm font-semibold text-gray-700">Postal Code</label>
                    <input v-model="form.address.postalCode" type="text" id="postalCode"
                           :class="{'border-red-500': errors.postalCode}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.postalCode" class="text-red-500 text-sm mt-1">{{ errors.postalCode }}</p>
                </div>
            </div>

            <!-- Country Section -->
            <div>
                <label for="country" class="block text-sm font-semibold text-gray-700">Country</label>
                <input v-model="form.address.country" type="text" id="country"
                       :class="{'border-red-500': errors.country}"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                       required />
                <p v-if="errors.country" class="text-red-500 text-sm mt-1">{{ errors.country }}</p>
            </div>

            <!-- Medical Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="dateOfBirth" class="block text-sm font-semibold text-gray-700">Date of Birth</label>
                    <input v-model="form.dateOfBirth" type="date" id="dateOfBirth"
                           :class="{'border-red-500': errors.dateOfBirth}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.dateOfBirth" class="text-red-500 text-sm mt-1">{{ errors.dateOfBirth }}</p>
                </div>
                <div>
                    <label for="bloodType" class="block text-sm font-semibold text-gray-700">Blood Type</label>
                    <input v-model="form.bloodType" type="text" id="bloodType"
                           :class="{'border-red-500': errors.bloodType}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.bloodType" class="text-red-500 text-sm mt-1">{{ errors.bloodType }}</p>
                </div>
            </div>

            <!-- Physical Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="weightKg" class="block text-sm font-semibold text-gray-700">Weight (kg)</label>
                    <input v-model="form.weightKg" type="number" id="weightKg" step="0.01"
                           :class="{'border-red-500': errors.weightKg}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.weightKg" class="text-red-500 text-sm mt-1">{{ errors.weightKg }}</p>
                </div>
                <div>
                    <label for="heightCm" class="block text-sm font-semibold text-gray-700">Height (cm)</label>
                    <input v-model="form.heightCm" type="number" id="heightCm" step="0.01"
                           :class="{'border-red-500': errors.heightCm}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.heightCm" class="text-red-500 text-sm mt-1">{{ errors.heightCm }}</p>
                </div>
            </div>

            <!-- Emergency Contact Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="emergencyContactName" class="block text-sm font-semibold text-gray-700">Emergency Contact Name</label>
                    <input v-model="form.emergencyContactName" type="text" id="emergencyContactName"
                           :class="{'border-red-500': errors.emergencyContactName}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.emergencyContactName" class="text-red-500 text-sm mt-1">{{ errors.emergencyContactName }}</p>
                </div>
                <div>
                    <label for="emergencyContactPhone" class="block text-sm font-semibold text-gray-700">Emergency Contact Phone</label>
                    <input v-model="form.emergencyContactPhone" type="tel" id="emergencyContactPhone"
                           :class="{'border-red-500': errors.emergencyContactPhone}"
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                           required />
                    <p v-if="errors.emergencyContactPhone" class="text-red-500 text-sm mt-1">{{ errors.emergencyContactPhone }}</p>
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
                        <input v-model="form.gender" type="radio" id="male" value="Male" class="mr-2" />
                        <label for="male" class="text-sm text-gray-700">Male</label>
                    </div>
                    <div>
                        <input v-model="form.gender" type="radio" id="female" value="Female" class="mr-2" />
                        <label for="female" class="text-sm text-gray-700">Female</label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full bg-orange-500 text-white py-3 px-4 rounded-lg shadow-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                    Update Patient
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue';
import {useForm} from '@inertiajs/vue3';
import {usePage} from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

defineOptions({
    layout: AppLayout,
});

const {props} = usePage();
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

const pageTitle = props.pageTitle || 'Edit Patient';
const patientId = props.patient ? props.patient.patientId : null;
const errors = ref({});

onMounted(() => {
    if (props.patient) {
        // Populate the form with patient data
        Object.assign(form, props.patient);

        // Ensure dateOfBirth is in the correct format for the date input
        if (form.dateOfBirth) {
            form.dateOfBirth = new Date(form.dateOfBirth).toISOString().split('T')[0];
        }
    }
});

const submitForm = () => {
    form.put(`/patients/${props.patient.patientId}`, {
        onSuccess: () => {
            console.log('Patient updated successfully');
        },
        onError: (errorsResponse) => {
            errors.value = errorsResponse;
            console.error('There was an error updating the patient', errorsResponse);
        }
    });
};
</script>

<style scoped>
.border-red-500 {
    border-color: #f56565;
}
</style>
