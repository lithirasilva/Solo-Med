<template>
  <!-- Main wrapper for the dashboard -->
  <div class="dashboard-layout bg-gray-00 p-4 max-w-7xl mx-auto">
    <!-- Dashboard Title -->
    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Patient Dashboard</h1>

    <!-- Stats Grid Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
      <!-- Appointments Card -->
      <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex items-center">
        <div class="flex-1">
          <h2 class="text-xl font-semibold text-gray-700">Appointments</h2>
          <p class="text-gray-500">Scheduled: 5</p>
        </div>
        <i class="fa-solid fa-calendar-check text-3xl text-blue-500"></i>
      </div>

      <!-- Upcoming Consultations Card -->
      <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex items-center">
        <div class="flex-1">
          <h2 class="text-xl font-semibold text-gray-700">Upcoming Consultations</h2>
          <p class="text-gray-500">Next: Sept 20</p>
        </div>
        <i class="fa-solid fa-user-md text-3xl text-green-500"></i>
      </div>

      <!-- Medical History Card -->
      <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex items-center">
        <div class="flex-1">
          <h2 class="text-xl font-semibold text-gray-700">Medical History</h2>
          <p class="text-gray-500">Records: 15</p>
        </div>
        <i class="fa-solid fa-file-medical text-3xl text-red-500"></i>
      </div>

      <!-- Notifications Card -->
      <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex items-center">
        <div class="flex-1">
          <h2 class="text-xl font-semibold text-gray-700">Notifications</h2>
          <p class="text-gray-500">Unread: 3</p>
        </div>
        <i class="fa-solid fa-bell text-3xl text-yellow-500"></i>
      </div>
    </div>

    <!-- Appointments Table Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Upcoming Appointments</h2>
      <table class="min-w-full leading-normal table-fixed">
        <thead>
          <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Doctor</th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Specialty</th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Sept 20, 2024</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Dr. Smith</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Cardiology</td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                <span class="relative">Confirmed</span>
              </span>
            </td>
          </tr>
          <!-- More rows can be added here -->
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import PatientLayout from "@/Layouts/PatientLayout.vue";

// Define the layout globally for the component
defineOptions({
  layout: PatientLayout,
});
</script>

<style scoped>
/* Center the dashboard and limit its max width */
.dashboard-layout {
  max-width: 1280px; /* Set a limit on the maximum width */
  margin-left: auto;
  margin-right: auto;
}

/* Style individual stat cards */
.stat-card {
  display: flex;
  justify-content: space-between;
  padding: 24px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Table customization */
table {
  width: 100%;
}

th {
  padding: 16px;
  background-color: #f9fafb;
  text-align: left;
  font-size: 0.75rem;
  color: #4a5568;
}

td {
  padding: 16px;
  font-size: 0.875rem;
  color: #2d3748;
}

/* Responsiveness */
@media (max-width: 768px) {
  .grid {
    grid-template-columns: repeat(1, minmax(0, 1fr));
  }
}

@media (min-width: 768px) and (max-width: 1024px) {
  .grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}
</style>
