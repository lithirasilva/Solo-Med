<template>
    <div class="p-8 bg-white rounded-lg shadow-lg max-w-2xl mx-auto">
        <div class="mb-4">
            <Link href="/appointments" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                &larr; Back
            </Link>
        </div>

        <h2 class="text-3xl font-bold mb-6 text-gray-900">Update Appointment</h2>

        <form @submit.prevent="updateAppointment" class="space-y-6">
            <div>
                <label class="block text-lg font-medium text-gray-700 mb-1">Patient ID</label>
                <input
                    type="text"
                    v-model="form.patientId"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                    readonly
                />
            </div>

            <div>
                <label class="block text-lg font-medium text-gray-700 mb-1">Doctor ID</label>
                <input
                    type="text"
                    v-model="form.doctorId"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                    readonly
                />
            </div>

            <div>
                <label for="dateTime" class="block text-lg font-medium text-gray-700 mb-1">Date and Time</label>
                <div class="bg-gray-200 rounded p-2 cursor-pointer drop-shadow-md hover:bg-gray-300 focus:outline-none" @click="showDateTimePickerModal = true">
                    <div class="m-1 p-1"><i class="fa fa-calendar"></i> Date: <span>{{ form.date }}</span></div>
                    <div class="m-1 p-1"><i class="fa fa-clock"></i> Time: <span>{{ form.startTime }} - {{ form.endTime }}</span></div>
                </div>
            </div>

            <div>
                <label for="reason" class="block text-lg font-medium text-gray-700 mb-1">Reason</label>
                <textarea v-model="form.reason" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" rows="4"></textarea>
                <span v-if="errors.reason" class="text-red-600 text-sm mt-1">{{ errors.reason }}</span>
            </div>

            <div>
                <label for="notes" class="block text-lg font-medium text-gray-700 mb-1">Notes</label>
                <textarea v-model="form.notes" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500" rows="4"></textarea>
                <span v-if="errors.notes" class="text-red-600 text-sm mt-1">{{ errors.notes }}</span>
            </div>

            <div class="flex space-x-4">
                <button type="button" @click="markAsComplete" class="flex-1 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300">
                    Mark as Complete
                </button>
                <button type="button" @click="attachMedicalRecord" class="flex-1 bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Attach Medical Record
                </button>
                <button type="button" @click="deleteAppointment" class="flex-1 bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300">
                    Delete
                </button>
            </div>

            <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg shadow-md hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-300">
                Update Appointment
            </button>
        </form>

        <div class="mt-8 p-4 border border-gray-300 rounded-lg bg-gray-50">
            <h3 class="text-2xl font-bold mb-4 text-gray-900">Form Data</h3>
            <p><strong>Patient ID:</strong> {{ form.patientId }}</p>
            <p><strong>Doctor ID:</strong> {{ form.doctorId }}</p>
            <p><strong>Date:</strong> {{ form.date }}</p>
            <p><strong>Start Time:</strong> {{ form.startTime }}</p>
            <p><strong>End Time:</strong> {{ form.endTime }}</p>
            <p><strong>Reason:</strong> {{ form.reason }}</p>
            <p><strong>Notes:</strong> {{ form.notes }}</p>
            <p><strong>Status:</strong> {{ form.status }}</p>
        </div>

        <!-- DateTime Picker Modal -->
        <div v-if="showDateTimePickerModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full relative">
                <h2 class="text-2xl font-bold mb-4 text-gray-900">Select Date and Time</h2>
                <div class="mb-4">
                    <input type="date" v-model="date" @change="updateDate" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4 max-h-64 overflow-y-auto">
                    <label class="block text-lg font-medium text-gray-700 mb-1">Select Time Slot</label>
                    <ul class="space-y-2">
                        <li v-for="slot in timeSlots" :key="slot.start" class="flex justify-between">
                            <button
                                type="button"
                                @click="selectTime(slot.start, slot.end)"
                                class="w-full bg-gray-200 text-gray-800 py-2 px-4 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
                            >
                                {{ slot.start }} - {{ slot.end }}
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="flex justify-between">
                    <button @click="applyDateTime" class="bg-orange-500 text-white py-2 px-4 rounded-lg shadow-md hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-300">OK</button>
                    <button @click="resetDateTime" class="bg-gray-500 text-white py-2 px-4 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-300">Reset</button>
                </div>
                <button @click="showDateTimePickerModal = false" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 focus:outline-none">
                    X
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, reactive} from 'vue';
import {Inertia} from '@inertiajs/inertia';
import {Link} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps(['appointment']);

const form = useForm({
    patientId: props.appointment.patientId,
    doctorId: props.appointment.doctorId,
    date: props.appointment.date,
    startTime: props.appointment.startTime,
    endTime: props.appointment.endTime,
    status: props.appointment.status,
    reason: props.appointment.reason,
    notes: props.appointment.notes
});
const errors = ref({});
const showDateTimePickerModal = ref(false);

const date = ref('');
const timeSlots = ref([]);

const generateTimeSlots = () => {
    const slots = [];
    const startHour = 8; // 8 AM
    const endHour = 17; // 5 PM
    for (let hour = startHour; hour < endHour; hour++) {
        for (let min = 0; min < 60; min += 15) {
            const start = `${hour.toString().padStart(2, '0')}:${(min).toString().padStart(2, '0')}`;
            const endMin = min + 15;
            const endHourAdjusted = endMin >= 60 ? hour + 1 : hour;
            const endMinAdjusted = endMin >= 60 ? endMin - 60 : endMin;
            const end = `${endHourAdjusted.toString().padStart(2, '0')}:${endMinAdjusted.toString().padStart(2, '0')}`;
            slots.push({start, end});
        }
    }
    timeSlots.value = slots;
};

generateTimeSlots();

const updateDate = () => {
    form.date = date.value;
};

const selectTime = (start, end) => {
    form.startTime = start;
    form.endTime = end;
};

const applyDateTime = () => {
    showDateTimePickerModal.value = false;
};

const resetDateTime = () => {
    date.value = '';
    form.startTime = '';
    form.endTime = '';
};

const updateAppointment = () => {
    form.put(`/appointments/${props.appointment.appointmentId}`, form, {
        onError: (errors) => {
            errors.value = errors;
        },
        onSuccess: () => {
            // Optionally reset form or redirect after successful update
        }
    });
};

const markAsComplete = () => {
    form.status = 'completed';
    updateAppointment();
};

const attachMedicalRecord = () => {
    // Logic to attach medical record
    console.log("Attaching medical record to appointment ID:", props.appointment.appointmentId);
};

const deleteAppointment = () => {
    if (confirm("Are you sure you want to delete this appointment?")) {
        Inertia.delete(`/appointments/${props.appointment.appointmentId}`);
    }
};

defineOptions({
    layout: AppLayout,
});

</script>
