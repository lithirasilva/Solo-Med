<template>
    <div class="bg-white rounded-lg shadow-md p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in users" :key="user.id">
                <td class="px-6 py-4 whitespace-nowrap">{{ user.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ user.email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ user.role }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <button @click="editUser(user)" class="text-blue-600 hover:text-blue-800">Edit</button>
                    <button @click="deleteUser(user.id)" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { defineEmits } from 'vue';
import { Inertia } from '@inertiajs/inertia';

// Define emits for the component
const emit = defineEmits(['edit', 'delete']);

// Props for the component
const props = defineProps({
    users: {
        type: Array,
        default: () => [
            {id: 1, name: 'John Doe', email: 'john.doe@example.com', role: 'doctor'},
            {id: 2, name: 'Jane Smith', email: 'jane.smith@example.com', role: 'staff'},
            {id: 3, name: 'Alice Johnson', email: 'alice.johnson@example.com', role: 'doctor'},
            {id: 4, name: 'Bob Brown', email: 'bob.brown@example.com', role: 'staff'}
        ],
    },
});

const editUser = (user) => {
    emit('edit', user);
};

const deleteUser = async (id) => {
    try {
        await Inertia.delete(`/users/${id}`);
        // Notify parent component of deletion if needed
        emit('delete', id);
    } catch (error) {
        console.error('Error deleting user:', error);
    }
};
</script>

