<template>
    <div class="max-w-5xl mx-auto p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Appointment Records</h1>

        <!-- Prescriptions Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Prescriptions</h2>
            <div class="space-y-4">
                <div v-for="(note, index) in prescriptionNotes" :key="index" class="border border-gray-300 rounded-lg p-4 bg-white shadow-sm">
          <textarea
              v-model="note.text"
              class="w-full border border-gray-300 p-2 rounded-md"
              placeholder="Add a note..."
          ></textarea>
                    <button
                        @click="removePrescription(index)"
                        class="mt-2 text-red-500 hover:underline"
                    >
                        Remove Note
                    </button>
                </div>
                <button
                    @click="addPrescriptionNote"
                    class="bg-green-500 text-white px-4 py-2 rounded-md mt-4"
                >
                    Add Note
                </button>
                <FileUpload ref="fileUpload" />
            </div>
        </div>

        <!-- Other Medical Records Section -->
        <div>
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Other Medical Records</h2>
            <div class="space-y-4">
                <div v-for="(record, index) in medicalRecords" :key="index" class="border border-gray-300 rounded-lg p-4 bg-white shadow-sm">
                    <input
                        type="file"
                        ref="fileInput"
                        @change="handleMedicalFileChange(index)"
                        class="border border-gray-300 p-2 rounded-md"
                    />
                    <textarea
                        v-model="record.notes"
                        class="w-full border border-gray-300 p-2 rounded-md mt-2"
                        placeholder="Add notes about this record..."
                    ></textarea>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input
                                type="radio"
                                v-model="record.type"
                                value="Blood-Test"
                                class="form-radio"
                            />
                            <span class="ml-2">Blood-Test</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input
                                type="radio"
                                v-model="record.type"
                                value="X-Ray"
                                class="form-radio"
                            />
                            <span class="ml-2">X-Ray</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input
                                type="radio"
                                v-model="record.type"
                                value="MRI"
                                class="form-radio"
                            />
                            <span class="ml-2">MRI</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input
                                type="radio"
                                v-model="record.type"
                                value="CT-Scan"
                                class="form-radio"
                            />
                            <span class="ml-2">CT-Scan</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input
                                type="radio"
                                v-model="record.type"
                                value="Other"
                                class="form-radio"
                            />
                            <span class="ml-2">Other</span>
                        </label>
                    </div>
                </div>
                <button
                    @click="addMedicalRecord"
                    class="bg-green-500 text-white px-4 py-2 rounded-md mt-4"
                >
                    Add Medical Record
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import FileUpload from './FileUpload.vue'; // Import the FileUpload component

const prescriptionNotes = ref([{ text: '' }]);
const medicalRecords = ref([{ type: '', notes: '' }]);

const addPrescriptionNote = () => {
    prescriptionNotes.value.push({ text: '' });
};

const removePrescription = (index) => {
    prescriptionNotes.value.splice(index, 1);
};

const addMedicalRecord = () => {
    medicalRecords.value.push({ type: '', notes: '' });
};

const handleMedicalFileChange = (index) => {
    // Logic to handle file upload for a specific medical record
    console.log('File selected for record', index);
};
</script>

<style scoped>
/* Scoped styles if necessary */
</style>
