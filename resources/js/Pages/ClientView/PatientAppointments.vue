<template>
    <div class="appointment-list bg-white shadow-md rounded-lg p-4">
      <!-- Title -->
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Booked Appointments</h2>
  
      <!-- List of Appointments -->
      <ul class="space-y-4">
        <li
          v-for="appointment in appointments"
          :key="appointment.id"
          @click="selectAppointment(appointment)"
          class="cursor-pointer p-4 bg-blue-50 hover:bg-blue-100 border rounded-lg shadow-sm transition duration-300 ease-in-out"
        >
          <div class="flex justify-between items-center">
            <div>
              <h3 class="text-lg font-semibold text-blue-700">{{ appointment.title }}</h3>
              <p class="text-gray-600">{{ appointment.date }} - {{ appointment.time }}</p>
            </div>
            <span v-if="selectedAppointment?.id === appointment.id" class="text-green-500 font-bold">
              Selected
            </span>
          </div>
        </li>
      </ul>
  
      <!-- Appointment Details (Shown when clicked) -->
      <div v-if="selectedAppointment" class="appointment-details mt-6 p-4 bg-white border rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-blue-600 mb-4">Appointment Details</h3>
        <p><strong>Doctor:</strong> {{ selectedAppointment.doctor }}</p>
        <p><strong>Date:</strong> {{ selectedAppointment.date }}</p>
        <p><strong>Time:</strong> {{ selectedAppointment.time }}</p>
        <p><strong>Location:</strong> {{ selectedAppointment.location }}</p>
        <p><strong>Notes:</strong> {{ selectedAppointment.notes || "No additional notes" }}</p>
        <button
          @click="closeDetails"
          class="mt-4 py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 ease-in-out"
        >
          Close
        </button>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  // Props to accept the list of appointments from the parent
  defineProps({
    appointments: Array
  });
  
  // State to track the selected appointment
  const selectedAppointment = ref(null);
  
  // Method to select an appointment
  const selectAppointment = (appointment) => {
    selectedAppointment.value = appointment;
  };
  
  // Method to close the details view
  const closeDetails = () => {
    selectedAppointment.value = null;
  };
  
  // Define the layout
  import PatientLayout from "@/Layouts/PatientLayout.vue";
  defineOptions({
    layout: PatientLayout,
  });
  </script>
  
  <style scoped>
  /* Smooth transitions on hover and details view */
  .appointment-list li:hover {
    transition: background-color 0.3s ease;
  }
  
  .appointment-details {
    transition: all 0.3s ease;
  }
  </style>
  