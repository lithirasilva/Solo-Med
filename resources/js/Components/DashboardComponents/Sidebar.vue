<template>
    <!-- <aside class="w-72 h-screen bg-white text-black flex flex-col lg:w-80 lg:px-6 lg:py-4 shadow-lg"> -->
    <!-- Sidebar Wrapper -->
    <aside :class="['transition-all duration-300 ease-in-out bg-white shadow-lg', sidebarOpen ? 'w-72' : 'w-20']">
        <!-- Sidebar Header -->
        <div class="flex justify-between items-center px-6 py-4">
            <!-- Sidebar Title (Visible when sidebar is open) -->
            <div v-if="sidebarOpen" class="text-3xl font-bold">SoloMed</div>
            <!-- Sidebar Toggle Button -->
            <button @click="toggleSidebar" class="p-2 text-gray-600 hover:bg-gray-200 rounded-full focus:outline-none transition">
                <i :class="sidebarOpen ? 'fa fa-angle-left' : 'fa fa-angle-right'"></i>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="mt-6    ">
            <ul>
                <!-- Loop through menu items -->
                <li v-for="item in menuItems" :key="item.name" class="mb-4">
                    <Link
                        :href="item.link"
                        @click.native.prevent="handleMenuItemClick(item.name)"
                        :class="[
                            'flex items-left justify-left',
                            sidebarOpen ? 'justify-start px-4' : 'justify-center',
                            'py-3 text-gray-700 hover:bg-orange-400 hover:text-white transition duration-200 rounded-md',
                            currentRoute === item.link ? '' : ''
                        ]"
                    >
                        <!-- Icon section -->
                        <i
                            :class="`fa ${item.icon} text-xl`"
                            :style="{
                                fontSize: iconSize,       /* Dynamic icon size */
                                color: iconColor          /* Dynamic icon color */
                            }"
                        ></i>

                        <!-- Label section (only visible when sidebar is open) -->
                        <span
                            v-if="sidebarOpen"
                            class="ml-5"
                            :style="{
                                fontSize: textSize,      /* Dynamic text size */
                                color: textColor         /* Dynamic text color */
                            }"
                        >
                            {{ item.name }}
                        </span>
                    </Link>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3'; // Ensure Inertia Link component is imported

// Sidebar open state
const sidebarOpen = ref(true); // Sidebar is open by default

// Props for menu items
const props = defineProps({
    menuItems: {
        type: Array,
        default: () => [
            { name: "Home", icon: "fa-home", link: "/dashboard" },
            { name: "Appointments", icon: "fa-calendar-alt", link: "/appointments" },
            { name: "Patients", icon: "fa-users", link: "/patients" },
            { name: "Medical Records", icon: "fa-folder", link: "/medical-records" },
            { name: "Finances", icon: "fa-dollar-sign", link: "/finances" },
            { name: "Notifications", icon: "fa-bell", link: "/notifications" },
            { name: "Calendar", icon: "fa-calendar", link: "/calendar" },
            { name: "Settings", icon: "fa-cogs", link: "/settings" }
        ]
    }
});

// Track current route for active link highlight
const currentRoute = usePage().url;

// Emit tab change event
const emit = defineEmits(['tab-change']);

// Sidebar icon size, text size, and colors (editable properties)
const iconSize = ref('24px');     // Default icon size
const textSize = ref('16px');     // Default text size
const iconColor = ref('#4B5563'); // Default icon color (gray-600)
const textColor = ref('#374151'); // Default text color (gray-700)

// Toggle sidebar visibility
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

// Handle menu item click
const handleMenuItemClick = (title) => {
    emit('tab-change', { title });
};
</script>

<style scoped>
/* Sidebar transition */
aside {
    width: 15rem; /* default full width for open sidebar */
}

aside.w-20 {
    width: 5rem; /* collapsed sidebar width */
}

/* Hover and active state */
ul li a:hover {
    background-color: #f97316; /* Tailwind orange-400 */
}

ul li a {
    transition: background-color 0.3s, color 0.3s; /* Smooth transitions */
}

ul li a.active {
    background-color: #f97316; /* Active state color */
}



</style>
