<template>
    <div>
      <!-- Hamburger Icon for Mobile -->
      <button @click="toggleSidebar" class="lg:hidden p-2 text-white bg-orange-600 hover:bg-orange-700 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
        <i class="fas fa-bars fa-2x"></i>
      </button>
  
      <!-- Sidebar -->
      <aside :class="['lg:w-64 w-full lg:flex flex-col lg:px-4 lg:py-4 shadow-lg', isSidebarOpen ? 'block' : 'hidden', 'fixed inset-0 bg-gradient-to-b from-orange-500 to-orange-700 text-white z-50 lg:z-auto lg:relative']">
        <!-- Close button for mobile view -->
        <button @click="toggleSidebar" class="lg:hidden p-2 text-white self-end">
          <i class="fas fa-times fa-2x"></i>
        </button>
        
        <!-- Sidebar Header -->
        <div class="flex-shrink-0 flex items-center justify-center px-6 py-6 border-b border-orange-400">
          <h1 class="text-2xl font-semibold tracking-wide">SoloMed</h1>
        </div>
  
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto mt-6">
          <ul>
            <li v-for="item in menuItems" :key="item.name" class="mb-2">
              <Link
                :href="item.link"
                @click.native.prevent="handleMenuItemClick(item.name)"
                class="flex items-center px-4 py-3 text-white hover:bg-orange-600 transition-colors duration-200 rounded-md"
              >
                <i :class="`fa ${item.icon} text-xl`"></i>
                <span class="ml-4 text-lg">{{ item.name }}</span>
              </Link>
            </li>
          </ul>
        </nav>
      </aside>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3';
  
  const props = defineProps({
    menuItems: {
      type: Array,
      default: () => [
        { name: "Home", icon: "fa-home", link: "/dashboard" },
        { name: "Appointments", icon: "fa-calendar-alt", link: "/dashboard/appointments" },
        { name: "Patients", icon: "fa-users", link: "/dashboard/patients" },
        { name: "Notifications", icon: "fa-bell", link: "/dashboard/notifications" },
        { name: "Settings", icon: "fa-cogs", link: "/dashboard/settings" },
        { name: "Clinic Staff", icon: "fa-user-md", link: "/dashboard/clinic-staff" },
        { name: "Finances", icon: "fa-dollar-sign", link: "/dashboard/finances" },
        { name: "Calendar", icon: "fa-calendar", link: "/dashboard/calendar" },
        { name: "Find Suppliers", icon: "fa-search", link: "/dashboard/find-suppliers" }
      ]
    }
  });
  
  const isSidebarOpen = ref(false);
  
  const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
  };
  
  const handleMenuItemClick = (title) => {
    // Emit event for tab change, if necessary
    emit('tab-change', { title });
    // Close sidebar on mobile after clicking a menu item
    isSidebarOpen.value = false;
  };
  </script>
  
  <style scoped>
  @import 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
  
  aside {
    background: linear-gradient(180deg, #f97316, #ea580c); /* Gradient background for a professional look */
    border-right: 1px solid rgba(255, 255, 255, 0.2); /* Subtle border for separation */
  }
  
  nav ul li {
    margin-bottom: 0.5rem; /* Consistent spacing between menu items */
  }
  
  nav ul li:last-child {
    margin-bottom: 0; /* Remove margin on the last item */
  }
  
  button {
    margin: 1rem;
  }
  </style>
  