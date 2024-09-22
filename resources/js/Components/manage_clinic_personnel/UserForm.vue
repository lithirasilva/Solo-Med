<template>
    <div>
        <!-- The title is now controlled by the parent component -->
        <form @submit.prevent="saveUser" class="space-y-6">
            <div>
                <label for="name" class="block text-lg font-medium text-gray-900 mb-1">Name</label>
                <input id="name" v-model="form.name" type="text" class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter user name" required>
            </div>
            <div>
                <label for="email" class="block text-lg font-medium text-gray-900 mb-1">Email</label>
                <input id="email" v-model="form.email" type="email" class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter user email" required>
            </div>
            <div>
                <label for="role" class="block text-lg font-medium text-gray-900 mb-1">Role</label>
                <select id="role" v-model="form.role" class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="doctor">Doctor</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">Save</button>
        </form>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['user']);
const emit = defineEmits(['save']);

const isEditMode = ref(!!props.user);
const form = ref({
    id: null,
    name: '',
    email: '',
    role: 'staff',
});

watch(() => props.user, (newUser) => {
    if (newUser) {
        form.value = { ...newUser };
    }
});

const saveUser = () => {
    if (isEditMode.value) {
        Inertia.put(`/users/${form.value.id}`, form.value).then(() => {
            emit('save');
        });
    } else {
        Inertia.post('/users', form.value).then(() => {
            emit('save');
        });
    }
};
</script>
