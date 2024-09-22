<template>
    <div class="p-6 max-w-3xl mx-auto bg-white rounded-lg shadow-lg">
        <div class="m-4">
            <Link
                :href="'/medical-records'"
                class="bg-gray-300 text-white px-4 py-2 rounded hover:bg-gray-600"
            >
                Back
            </Link>
        </div>
        <!-- Title -->
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Add New Medical Record</h1>

        <form @submit.prevent="submit">
            <!-- Patient ID -->
            <div class="mb-6">
                <label for="patientId" class="block text-gray-800 text-lg font-medium mb-2">Patient ID:</label>
                <input v-model="form.patientId" type="text" id="patientId" class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-400 w-full" />
                <span v-if="errors.patientId" class="text-red-600 text-sm">{{ errors.patientId }}</span>
            </div>

            <!-- Doctor ID -->
            <div class="mb-6">
                <label for="doctorId" class="block text-gray-800 text-lg font-medium mb-2">Doctor ID:</label>
                <select v-model="form.doctorId" id="doctorId" class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-400 w-full">
                    <option value="" disabled>Select a doctor</option>
                    <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">{{ doctor.name }}</option>
                </select>
                <span v-if="errors.doctorId" class="text-red-600 text-sm">{{ errors.doctorId }}</span>
            </div>

            <!-- Appointment ID -->
            <div class="mb-6">
                <label for="appointmentId" class="block text-gray-800 text-lg font-medium mb-2">Appointment ID:</label>
                <input v-model="form.appointmentId" type="text" id="appointmentId" class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-400 w-full" />
                <span v-if="errors.appointmentId" class="text-red-600 text-sm">{{ errors.appointmentId }}</span>
            </div>

            <!-- Record Title -->
            <div class="mb-6">
                <label for="recordTitle" class="block text-gray-800 text-lg font-medium mb-2">Record Title:</label>
                <input v-model="form.recordTitle" type="text" id="recordTitle" class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-400 w-full" />
                <span v-if="errors.recordTitle" class="text-red-600 text-sm">{{ errors.recordTitle }}</span>
            </div>

            <!-- Record Type -->
            <div class="mb-6">
                <span class="block text-gray-800 text-lg font-medium mb-2">Record Type:</span>
                <div class="flex flex-wrap gap-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" v-model="form.recordType" value="Notes" class="form-checkbox rounded-md border-gray-300 text-orange-500 focus:ring-orange-400" /> Notes
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" v-model="form.recordType" value="Prescription" class="form-checkbox rounded-md border-gray-300 text-orange-500 focus:ring-orange-400" /> Prescription
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" v-model="form.recordType" value="File Upload" class="form-checkbox rounded-md border-gray-300 text-orange-500 focus:ring-orange-400" /> File Upload
                    </label>
                </div>
                <span v-if="errors.recordType" class="text-red-600 text-sm">{{ errors.recordType }}</span>
            </div>

            <!-- Notes -->
            <div v-if="form.recordType.includes('Notes')" class="mb-6">
                <label for="notes" class="block text-gray-800 text-lg font-medium mb-2">Notes:</label>
                <textarea v-model="form.notes" id="notes" rows="5" class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-400 w-full"></textarea>
            </div>

            <!-- Prescription -->
            <div v-if="form.recordType.includes('Prescription')" class="mb-6">
                <label for="prescription" class="block text-gray-800 text-lg font-medium mb-2">Prescription:</label>
                <textarea v-model="form.prescription" id="prescription" rows="5" class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-400 w-full"></textarea>
            </div>

            <!-- File Upload -->
            <div v-if="form.recordType.includes('File Upload')" class="mb-6">
                <label for="fileUpload" class="block text-gray-800 text-lg font-medium mb-2">Upload File:</label>
                <input type="file" @change="handleFileChange" id="fileUpload" class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-400 w-full" />
                <p v-if="fileError" class="text-red-600 mt-2 text-sm">{{ fileError }}</p>
            </div>

            <button type="submit" :disabled="!isRecordTypeSelected" class="mt-6 bg-orange-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 transition duration-300">Submit</button>
        </form>

      
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

// Define form data and methods
const form = useForm({
    patientId: '',
    doctorId: '',
    appointmentId: '',
    recordTitle: '',
    recordType: [],
    notes: '',
    prescription: '',
    uploads: null,
});

const errors = ref({});
const fileError = ref('');

const doctors = [
    { id: 1, name: 'Dr. John Doe' },
    { id: 2, name: 'Dr. Jane Doe' },
    { id: 3, name: 'Dr. James Doe' },
    { id: 4, name: 'Dr. Janet Doe' }
];

// Computed property to check if any checkbox is selected
const isRecordTypeSelected = computed(() => form.recordType.length > 0);

// Computed property to format the request data for display
const formattedRequestData = computed(() => {
    const data = {
        patientId: form.patientId,
        doctorId: form.doctorId,
        appointmentId: form.appointmentId,
        recordTitle: form.recordTitle,
        recordType: form.recordType,
        notes: form.notes,
        prescription: form.prescription,
        uploads: form.uploads ? form.uploads.name : null,
    };
    return JSON.stringify(data, null, 2);
});

// Function to validate the form
const validateForm = () => {
    errors.value = {}; // Reset errors
    if (!form.patientId) errors.value.patientId = 'Patient ID is required.';
    if (!form.doctorId) errors.value.doctorId = 'Doctor ID is required.';
    if (!form.appointmentId) errors.value.appointmentId = 'Appointment ID is required.';
    if (!form.recordTitle) errors.value.recordTitle = 'Record Title is required.';
    if (form.recordType.length === 0) errors.value.recordType = 'At least one Record Type must be selected.';
};

// Handle file input change
const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const allowedTypes = [
            'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'text/plain', 'image/jpeg', 'image/png', 'image/webp', 'text/csv', 'application/xml', 'application/dicom',
            'application/hl7', 'application/zip'
        ];
        if (!allowedTypes.includes(file.type)) {
            fileError.value = 'Invalid file type.';
            form.uploads = null;
            return;
        }
        if (file.size > 15 * 1024 * 1024) { // 15MB size limit
            fileError.value = 'File size exceeds 15MB.';
            form.uploads = null;
            return;
        }
        fileError.value = '';
        form.uploads = file;
    }
};

// Submit the form
const submit = () => {
    validateForm();
    if (Object.keys(errors.value).length > 0) return; // Stop submission if there are validation errors

    const formData = new FormData();
    formData.append('patientId', form.patientId);
    formData.append('doctorId', form.doctorId);
    formData.append('appointmentId', form.appointmentId);
    formData.append('recordTitle', form.recordTitle);
    formData.append('recordType', JSON.stringify(form.recordType));
    formData.append('notes', form.notes);
    formData.append('prescription', form.prescription);
    if (form.uploads) {
        formData.append('uploads', form.uploads);
    }

    form.post('/medical-records', {
        forceFormData: true, // Important for file uploads
        data: formData,
        onSuccess: () => {
            // Create the notification
            const notification = `Patient ID ${form.patientId} - Medical Records Updated`;
            saveNotification(notification);
        },
        onError: () => {
            // Handle error, e.g., show error messages
        },
    });
};

// Function to save notifications to local storage
const saveNotification = (notification) => {
    const existingNotifications = JSON.parse(localStorage.getItem('notifications')) || [];
    existingNotifications.push({
        message: notification,
        date: new Date().toLocaleDateString(),
        time: new Date().toLocaleTimeString(),
    });
    localStorage.setItem('notifications', JSON.stringify(existingNotifications));
};

defineOptions({
    layout: AppLayout,
});
</script>

<style scoped>
/* Style the checkboxes */
input[type="checkbox"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 2px solid #f59e0b;
    border-radius: 4px;
    width: 1.5rem;
    height: 1.5rem;
    margin-right: 0.5rem;
    position: relative;
}

input[type="checkbox"]:checked {
    background-color: #f59e0b;
    border: 2px solid #f59e0b;
}

input[type="checkbox"]:checked::after {
    content: '✔';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 1.1rem;
}
</style>