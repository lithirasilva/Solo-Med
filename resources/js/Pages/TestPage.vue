<template>
    <div class="p-8">
        <!-- Tile Selection -->
        <div class="flex space-x-4 mb-8">
            <!-- Practitioner Tile -->
            <div
                @click="selectRole('practitioner')"
                class="flex-1 p-6 bg-white border border-gray-200 rounded-lg shadow-lg cursor-pointer transform transition-transform duration-300 hover:scale-105"
            >
                <i class="fas fa-user-md fa-3x text-blue-500"></i>
                <h2 class="mt-4 text-xl font-semibold text-center">Practitioner</h2>
            </div>

            <!-- Staff Tile -->
            <div
                @click="selectRole('staff')"
                class="flex-1 p-6 bg-white border border-gray-200 rounded-lg shadow-lg cursor-pointer transform transition-transform duration-300 hover:scale-105"
            >
                <i class="fas fa-users fa-3x text-green-500"></i>
                <h2 class="mt-4 text-xl font-semibold text-center">Staff</h2>
            </div>

            <!-- Client Tile -->
            <div
                @click="selectRole('client')"
                class="flex-1 p-6 bg-white border border-gray-200 rounded-lg shadow-lg cursor-pointer transform transition-transform duration-300 hover:scale-105"
            >
                <i class="fas fa-user fa-3x text-purple-500"></i>
                <h2 class="mt-4 text-xl font-semibold text-center">Client</h2>
            </div>
        </div>

        <!-- Render Form Based on Selected Role -->
        <div v-if="selectedRole" class="mt-8">
            <form v-if="selectedRole === 'practitioner'" class="bg-white p-6 border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Practitioner Registration</h2>
                <!-- Practitioner Form Fields -->
                <div class="mb-4">
                    <label for="name-practitioner" class="block text-sm font-medium">Name</label>
                    <input type="text" id="name-practitioner" v-model="formData.name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="specialization" class="block text-sm font-medium">Specialization</label>
                    <input type="text" id="specialization" v-model="formData.specialization" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="license" class="block text-sm font-medium">License Number</label>
                    <input type="text" id="license" v-model="formData.license" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Register</button>
            </form>

            <form v-if="selectedRole === 'staff'" class="bg-white p-6 border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Staff Registration</h2>
                <!-- Staff Form Fields -->
                <div class="mb-4">
                    <label for="name-staff" class="block text-sm font-medium">Name</label>
                    <input type="text" id="name-staff" v-model="formData.name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="department" class="block text-sm font-medium">Department</label>
                    <input type="text" id="department" v-model="formData.department" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium">Position</label>
                    <input type="text" id="position" v-model="formData.position" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Register</button>
            </form>

            <form v-if="selectedRole === 'client'" class="bg-white p-6 border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Client Registration</h2>
                <!-- Client Form Fields -->
                <div class="mb-4">
                    <label for="name-client" class="block text-sm font-medium">Name</label>
                    <input type="text" id="name-client" v-model="formData.name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="email-client" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email-client" v-model="formData.email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="phone-client" class="block text-sm font-medium">Phone Number</label>
                    <input type="text" id="phone-client" v-model="formData.phone" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <button type="submit" class="px-4 py-2 bg-purple-500 text-white rounded-md">Register</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const selectedRole = ref(null);

// Form data object to store input values
const formData = ref({
    name: '',
    specialization: '',
    license: '',
    department: '',
    position: '',
    email: '',
    phone: '',
});

function selectRole(role) {
    selectedRole.value = role;
}
</script>

<style scoped>
/* Add any additional styles if needed */
</style>
