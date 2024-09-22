<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded-lg shadow-lg">
        <div class="m-4">
            <Link
                :href="'/medical-records'"
                class="bg-gray-300 text-white px-4 py-2 rounded hover:bg-gray-600"
            >
                Back
            </Link>
        </div>
        <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">Medical Record Details</h1>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Patient ID: {{ medicalRecord.patientId }}</h2>
            <h2 class="text-lg font-semibold">Medical Record ID: {{ medicalRecord.medicalRecordId }}</h2>
            <h2 class="text-lg font-semibold">Patient Name: {{ medicalRecord.patient.firstName }} {{ medicalRecord.patient.lastName }}</h2>
            <h3 class="text-md">Doctor ID: {{ medicalRecord.doctorId }}</h3>
            <h3 class="text-md">Record Title: {{ medicalRecord.recordTitle }}</h3>
            <h4 class="text-sm">Date & Time: {{ new Date(medicalRecord.created_at).toLocaleString() }}</h4>
        </div>

        <div v-if="medicalRecord.notes" class="mb-4">
            <h4 class="font-medium">Notes:</h4>
            <p>{{ medicalRecord.notes }}</p>
        </div>

        <div v-if="medicalRecord.prescription" class="mb-4">
            <h4 class="font-medium">Prescription:</h4>
            <p id="prescription-text">{{ medicalRecord.prescription }}</p>
            <button @click="printPrescription" class="mt-2 bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                Print Prescription
            </button>
        </div>

        <div v-if="medicalRecord.uploads" class="mb-4">
            <h4 class="font-medium">Uploaded File:</h4>
            <a :href="fileUrl" class="text-blue-500 underline" target="_blank">{{ medicalRecord.uploads.split('/').pop() }}</a>
        </div>

        <button @click="deleteRecord" class="mt-4 bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
            Delete This Record
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

const { medicalRecord } = usePage().props;
const fileUrl = ref('');

if (medicalRecord.uploads) {
    const fileName = medicalRecord.uploads.split('/').pop();
    fileUrl.value = `/files/${medicalRecord.patientId}/${fileName}`;
}

const printPrescription = () => {
    const prescriptionContent = document.getElementById('prescription-text').innerText;

    const currentDate = () => {
        const date = new Date(Date.now());
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    const newWindow = window.open('', '_blank');
    newWindow.document.write(`
        <html>
            <head>
                <title>Print Prescription</title>
                <style>
                    @page {
                        size: A5;
                        margin: 15mm;
                    }
                    body {
                        font-family: Arial, sans-serif;
                        font-size: 10pt;
                        line-height: 1.4;
                    }
                    .letterhead { text-align: center; }
                    .letterhead img { max-width: 70px; }
                    .header-info { font-size: 0.9em; margin-top: 8px; }
                    hr { margin: 10px 0; border: 0; border-top: 1px solid #ccc; }
                    pre { white-space: pre-wrap; word-wrap: break-word; }
                    h1 { font-size: 16pt; margin: 5px 0; }
                    h2, h3 { font-size: 12pt; margin: 3px 0; }
                    h4 { font-size: 10pt; margin: 2px 0; }

                    .addressingPatient { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
                </style>
            </head>
            <body>
                <div class="letterhead">
                    <img src="path/to/logo.svg" alt="Logo" />
                    <div class="header-info">
                        <h2>Dr. ${medicalRecord.doctor.name}</h2>
                        <p>${medicalRecord.doctor.address}</p>
                        <p>Email: ${medicalRecord.doctor.email}</p>
                    </div>
                    <hr />
                </div>
                <div class="addressingPatient">
    <h3 style="display: inline; margin-right: 5px;">Patient Name:</h3>
    <span>${medicalRecord.patient.firstName} ${medicalRecord.patient.lastName}</span>
    <br />
    <h3 style="display: inline; margin-right: 5px;">Patient Age:</h3>
    <span>${medicalRecord.age}</span>
</div>
<h1>Prescription</h1>
                <div class="date">
                    <h3>Date: ${currentDate()}</h3>
                </div>

                <pre>${prescriptionContent}</pre>
            </body>
        </html>
    `);

    newWindow.document.close();
    newWindow.print();
};

const deleteRecord = () => {
    if (confirm('Are you sure you want to delete this medical record?')) {
        Inertia.delete(`/medical-records/${medicalRecord.medicalRecordId}`);
    }
};

defineOptions({
    layout : AppLayout,
});
</script>
