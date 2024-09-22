<template>
    <div class="max-w-lg mx-auto p-4 bg-white shadow-lg rounded-lg">
        <form @submit.prevent="submitForm" class="space-y-4">
            <!-- Notes Section -->
            <div>
                <label for="notes" class="block text-lg font-semibold mb-2">Notes:</label>
                <textarea
                    v-model="form.notes"
                    id="notes"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4"
                    required
                ></textarea>
            </div>

            <!-- Prescription Section -->
            <div>
                <label for="prescription" class="block text-lg font-semibold mb-2">Prescription:</label>
                <textarea
                    v-model="form.prescription"
                    id="prescription"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4"
                    required
                ></textarea>
            </div>

            <!-- Record Type Section -->
            <div>
                <label for="recordType" class="block text-lg font-semibold mb-2">Record Type:</label>
                <input
                    v-model="form.recordType"
                    type="text"
                    id="recordType"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
            </div>

            <!-- Record Title Section -->
            <div>
                <label for="recordTitle" class="block text-lg font-semibold mb-2">Record Title:</label>
                <input
                    v-model="form.recordTitle"
                    type="text"
                    id="recordTitle"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
            </div>

            <!-- File Upload Section -->
            <div>
                <label for="uploads" class="block text-lg font-semibold mb-2">Uploads:</label>
                <input
                    type="file"
                    id="uploads"
                    @change="handleFileChange"
                    accept=".pdf,.doc,.docx,.txt,.png,.jpeg,.webp"
                    class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm text-gray-500 file:border-0 file:bg-blue-500 file:text-white file:py-1 file:px-2 file:rounded-md hover:file:bg-blue-600"
                    required
                />
                <p v-if="fileError" class="mt-2 text-red-500 text-sm flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ fileError }}
                </p>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <i class="fas fa-paper-plane mr-2"></i> Submit
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

const form = ref({
    notes: JSON.stringify({ title: '', type: '', note: '' }), // JSON format
    prescription: '',
    recordType: '',
    recordTitle: '',
    uploads: null
});

const fileError = ref('');

// You need to set the appointmentId after fetching it from the backend or passing it as a prop
const appointmentId = ref(null);

// Assuming you get the appointmentId from backend or props
// Example: appointmentId.value = someValueFromBackend;

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const validExtensions = ['pdf', 'doc', 'docx', 'txt', 'png', 'jpeg', 'webp'];
        const maxSizeMB = 15;

        const fileExtension = file.name.split('.').pop().toLowerCase();
        if (!validExtensions.includes(fileExtension)) {
            fileError.value = 'Invalid file type. Please upload a valid file.';
            form.value.uploads = null;
            return;
        }

        if (file.size > maxSizeMB * 1024 * 1024) {
            fileError.value = 'File size exceeds the 15 MB limit.';
            form.value.uploads = null;
            return;
        }

        fileError.value = '';
        form.value.uploads = file;
    }
};

const { post } = useForm({
    data: form.value
});

const submitForm = () => {
    if (!form.value.uploads) {
        fileError.value = 'Please upload a valid file.';
        return;
    }

    if (!appointmentId.value) {
        fileError.value = 'Appointment ID is required.';
        return;
    }

    const formData = new FormData();
    formData.append('appointmentId', appointmentId.value);
    Object.keys(form.value).forEach(key => {
        formData.append(key, form.value[key]);
    });

    post('/your-endpoint', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
};
</script>

<style scoped>
/* Custom styles (if any) */
</style>
