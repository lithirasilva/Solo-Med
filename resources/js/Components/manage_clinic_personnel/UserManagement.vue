<template>
    <div class="flex flex-col lg:flex-row gap-6 p-6 bg-gray-50 min-h-screen">
        <!-- User List Section -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">User List</h2>
            <UserList @edit="setEditUser" />
        </div>

        <!-- User Form Section -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ isEditMode ? 'Edit User' : 'Add User' }}</h2>
            <UserForm :user="currentUser" @save="refreshUserList" />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import UserList from '@/Components/manage_clinic_personnel/UserList.vue';
import UserForm from '@/Components/manage_clinic_personnel/UserForm.vue';

const isEditMode = ref(false);
const currentUser = ref(null);

const setEditUser = (user) => {
    currentUser.value = user;
    isEditMode.value = true;
};

const refreshUserList = () => {
    // Logic to refresh or update the user list, e.g., by emitting an event or using a shared store
    isEditMode.value = false;
    currentUser.value = null;
};
</script>

<style scoped>
/* Optional custom styles for added flair */
</style>
