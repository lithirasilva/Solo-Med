<template>
    <div id="main_container" class="flex bg-gray-100 min-h-screen">
      <!-- Sidebar Component -->
      <Sidebar :menuItems="menuItems" @tab-change="handleTabChange" />

      <!-- Right Container -->
      <div class="flex-1 overflow-auto p-6">
        <slot></slot>
      </div>

      <!-- Bottom Navigation Bar (FloatingButton) Component -->
      <FloatingButton :menuItems="menuItems" @tab-change="handleTabChange" />
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';
  import Sidebar from "@/Components/DashboardComponents/Sidebar.vue";
  import FloatingButton from "@/Components/DashboardComponents/FloatingButton.vue";

  // Define menu items in the parent component and pass to both Sidebar and FloatingButton
  const menuItems = ref([
    { name: "Home", icon: "fa-home", link: "/dashboard" },
    { name: "Appointments", icon: "fa-calendar-alt", link: "/appointments" },
    { name: "Patients", icon: "fa-users", link: "/patients" },
      { name: "Medical Records", icon: "fa-folder", link: "/medical-records" },
    { name: "Analytics", icon: "fa-dollar-sign", link: "/finances" },
    { name: "Notifications", icon: "fa-bell", link: "/notifications" },
    { name: "Calendar", icon: "fa-calendar", link: "/calendar" },
    { name: "Settings", icon: "fa-cogs", link: "/settings" }
  ]);

  // Emit the tab change event
  const emit = defineEmits(['tab-change']);

  const handleTabChange = (event) => {
    emit('tab-change', event);
  };
  </script>


<style scoped>
/* Ensure right container takes full height and scrolls */
#main_container {
    display: flex;
    height: 100vh;
    background-color: #f9fafb; /* Tailwind's cool-gray background */
}

/* Right container content padding and scroll behavior */
#main_container .flex-1 {
    padding: 2rem;
    overflow-y: auto; /* Ensure content in this area is scrollable */
}

/* Ensure sidebar is fixed width */
aside {
    flex-shrink: 0; /* Prevent sidebar from shrinking */
}

/* Hide Sidebar on Mobile */
@media (max-width: 768px) {
  aside {
    display: none;
  }
}

</style>
