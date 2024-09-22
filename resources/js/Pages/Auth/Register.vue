<script setup>
import { ref, computed, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import eventBus from '@/eventBus';

const selectedRole = ref(null);

const formData = ref({
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    password_confirmation: '',
    dateOfBirth: '',
    medicalCouncilRegistration: '', // Added field for doctor
    patientId: '', // Added field for patient
    address: {
        street: '',
        city: '',
        province: '',
        country: '',
        postalCode: '',
    },
    specialty: '',
    phone: '',
    bloodType: '',
    weightKg: '',
    heightCm: '',
    emergencyContactName: '',
    emergencyContactPhone: '',
    specialNotes: '',
    gender: '',
    // Name will be dynamically computed
});

const doctorAddressFields = [
    { label: 'Street', model: 'street', type: 'text' },
    { label: 'City', model: 'city', type: 'text' },
    { label: 'Province', model: 'province', type: 'text' },
    { label: 'Country', model: 'country', type: 'text' },
    { label: 'Postal Code', model: 'postalCode', type: 'text' },
];

const staffAddressFields = [
    { label: 'Street', model: 'street', type: 'text' },
    { label: 'City', model: 'city', type: 'text' },
    { label: 'Province', model: 'province', type: 'text' },
    { label: 'Country', model: 'country', type: 'text' },
    { label: 'Postal Code', model: 'postalCode', type: 'text' },
];

const patientAddressFields = [
    { label: 'Street', model: 'street', type: 'text' },
    { label: 'City', model: 'city', type: 'text' },
    { label: 'Province', model: 'province', type: 'text' },
    { label: 'Country', model: 'country', type: 'text' },
    { label: 'Postal Code', model: 'postalCode', type: 'text' },
];

const doctorFields = [
    { label: 'Specialty', model: 'specialty', type: 'text' },
    { label: 'Phone Number', model: 'phone', type: 'text' }
];

const staffFields = [
    { label: 'Phone Number', model: 'phone', type: 'text' }
];

const patientFields = [
    { label: 'Blood Type', model: 'bloodType', type: 'text' },
    { label: 'Weight (kg)', model: 'weightKg', type: 'number' },
    { label: 'Height (cm)', model: 'heightCm', type: 'number' },
    { label: 'Emergency Contact Name', model: 'emergencyContactName', type: 'text' },
    { label: 'Emergency Contact Phone', model: 'emergencyContactPhone', type: 'text' },
    { label: 'Special Notes', model: 'specialNotes', type: 'text' },
    { label: 'Gender', model: 'gender', type: 'text' }
];

const addressFields = computed(() => {
    switch (selectedRole.value) {
        case 'doctor':
            return doctorAddressFields;
        case 'staff':
            return staffAddressFields;
        case 'patient':
            return patientAddressFields;
        default:
            return [];
    }
});

const roleFields = computed(() => {
    switch (selectedRole.value) {
        case 'doctor':
            return doctorFields;
        case 'staff':
            return staffFields;
        case 'patient':
            return patientFields;
        default:
            return [];
    }
});

const formTitle = computed(() => {
    switch (selectedRole.value) {
        case 'doctor':
            return 'Doctor';
        case 'staff':
            return 'Staff';
        case 'patient':
            return 'Patient';
        default:
            return '';
    }
});

// Compute name based on firstName and lastName
watch([formData.value.firstName, formData.value.lastName], () => {
    formData.value.name = `${formData.value.firstName} ${formData.value.lastName}`;
});

function selectRole(role) {
    selectedRole.value = role;
}
function registerUser() {
    const payload = {
        ...formData.value,
        name: `${formData.value.firstName} ${formData.value.lastName}`,
        role: selectedRole.value // Add role to payload
    };
    Inertia.post('/register', payload).then(() => {
        // Add a notification on successful registration
        eventBus.addNotification({
            title: 'Registration Successful',
            date: new Date().toLocaleDateString(),
            time: new Date().toLocaleTimeString()
        });
    });
}
</script>
<template>
    <div class="container mx-auto py-8 md:py-16 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
        <!-- Left Column (Background & Info) -->
        <div class="left-column flex flex-col justify-center px-4 md:px-8 py-6 md:py-12">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-black">Join Our Platform</h1>
            <p class="text-base md:text-lg text-black mb-4">Select your role and fill in the details to get started with our platform.</p>
            <img src="../../../../public/images/bg.gif" alt="Background" class="w-full max-w-xs md:max-w-sm mx-auto">
        </div>

        <!-- Right Column (Form) -->
        <div class="right-column bg-white p-4 md:p-8 shadow-lg rounded-lg">
            <!-- Header -->
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 text-center mb-4 md:mb-6">{{ formTitle }} Registration</h2>

            <!-- Role Selection -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-4 md:mb-8 text-center">
                <!-- Doctor Tile -->
                <div @click="selectRole('doctor')" :class="{'active-role': selectedRole === 'doctor'}" class="role-card">
                    <i class="fas fa-stethoscope text-3xl md:text-4xl text-green-500"></i>
                    <h3 class="mt-2 md:mt-4 text-lg md:text-xl font-medium">Practitioner</h3>
                </div>

                <!-- Staff Tile -->
                <div @click="selectRole('staff')" :class="{'active-role': selectedRole === 'staff'}" class="role-card">
                    <i class="fas fa-house-chimney-medical text-3xl md:text-4xl text-purple-500"></i>
                    <h3 class="mt-2 md:mt-4 text-lg md:text-xl font-medium">Staff</h3>
                </div>

                <!-- Patient Tile -->
                <div @click="selectRole('patient')" :class="{'active-role': selectedRole === 'patient'}" class="role-card">
                    <i class="fas fa-user text-3xl md:text-4xl text-blue-500"></i>
                    <h3 class="mt-2 md:mt-4 text-lg md:text-xl font-medium">Patient</h3>
                </div>
            </div>

            <!-- Registration Form Based on Selected Role -->
            <form v-if="selectedRole" @submit.prevent="registerUser">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 md:mb-6">
                    <div class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">First Name</label>
                        <input type="text" v-model="formData.firstName" class="input-field" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">Last Name</label>
                        <input type="text" v-model="formData.lastName" class="input-field" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">Email</label>
                        <input type="email" v-model="formData.email" class="input-field" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">Password</label>
                        <input type="password" v-model="formData.password" class="input-field" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">Confirm Password</label>
                        <input type="password" v-model="formData.password_confirmation" class="input-field" />
                    </div>
                    <!-- New Date of Birth Field -->
                    <div class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">Date of Birth</label>
                        <input type="date" v-model="formData.dateOfBirth" class="input-field" />
                    </div>
                    <!-- Medical Council Registration Field for Doctor Role -->
                    <div v-if="selectedRole === 'doctor'" class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">Medical Council Registration</label>
                        <input type="text" v-model="formData.medicalCouncilRegistration" class="input-field" />
                    </div>
                    <!-- Patient ID Field for Patient Role -->
                    <div v-if="selectedRole === 'patient'" class="mb-4 relative">
                        <label class="block text-sm md:text-base font-medium text-gray-600">Patient ID (Optional)</label>
                        <input type="text" v-model="formData.patientId" class="input-field" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <i class="fas fa-info-circle text-gray-500" title="If you already have a patient profile under a doctor who uses SoloMed, ask for your patient ID from clinic staff and enter it below"></i>
                        </div>
                    </div>
                    <div v-for="(field, index) in addressFields" :key="index" class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">{{ field.label }}</label>
                        <input :type="field.type" v-model="formData.address[field.model]" class="input-field" />
                    </div>
                    <div v-for="(field, index) in roleFields" :key="index" class="mb-4">
                        <label class="block text-sm md:text-base font-medium text-gray-600">{{ field.label }}</label>
                        <input :type="field.type" v-model="formData[field.model]" class="input-field" />
                    </div>
                </div>
                <button type="submit" class="submit-button bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">Register</button>

            </form>
        </div>
    </div>
</template>
