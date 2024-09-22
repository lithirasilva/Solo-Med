<template>
    <div class="p-4 md:p-8 bg-gray-50 min-h-screen flex flex-col">
        <!-- Dashboard Tiles Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 flex-grow">
            <!-- Next Appointment Tile -->
            <Link
                href="/appointments/next-appointment"
                class="tile col-span-2 md:col-span-3 bg-white text-gray-800 shadow-lg hover:shadow-2xl transform transition-all hover:scale-105 cursor-pointer flex h-40 md:h-56 rounded-lg overflow-hidden"
            >
                <!-- Icon Section -->
                <div class="flex-shrink-0 w-1/4 flex items-center justify-center bg-gradient-to-tr from-indigo-500 to-indigo-700 text-white">
                    <i class="fas fa-calendar-check fa-2x md:fa-3x"></i> <!-- Adjust icon size here -->
                </div>
                <!-- Appointment Info Section -->
                <div class="flex-grow flex flex-col justify-center p-3 md:p-4">
                    <div class="text-lg md:text-2xl font-bold text-gray-800 mb-1">Next Appointment</div> <!-- Adjust text size here -->
                    <div class="text-xs md:text-base text-gray-600">{{ nextAppointment.date }}</div> <!-- Adjust text size here -->
                    <div class="text-xs md:text-base text-gray-600">{{ nextAppointment.time }}</div> <!-- Adjust text size here -->
                    <div class="text-xs md:text-base text-gray-600">{{ nextAppointment.patient }}</div> <!-- Adjust text size here -->
                </div>
            </Link>

            <!-- View Patients Tile -->
            <Link
                href="/patients"
                class="tile col-span-1 bg-white shadow-lg hover:shadow-2xl transform transition-all hover:scale-105 cursor-pointer flex flex-col items-center justify-center h-40 md:h-56 rounded-lg overflow-hidden"
            >
                <i class="fas fa-users fa-2x md:fa-3x mb-2 text-indigo-600"></i> <!-- Adjust icon size here -->
                <div class="text-base md:text-xl font-semibold text-gray-800">View Patients</div> <!-- Adjust text size here -->
            </Link>

            <!-- New Appointment Tile -->
            <Link
                href="/appointments/create"
                class="tile col-span-1 md:col-span-2 bg-white shadow-lg hover:shadow-2xl transform transition-all hover:scale-105 cursor-pointer flex flex-col items-center justify-center h-40 md:h-56 rounded-lg overflow-hidden"
            >
                <i class="fas fa-plus-circle fa-2x md:fa-3x mb-2 text-green-500"></i> <!-- Adjust icon size here -->
                <div class="text-base md:text-xl font-semibold text-gray-800">New Appointment</div> <!-- Adjust text size here -->
            </Link>

            <!-- All Appointments Tile -->
            <Link
                href="/appointments"
                class="tile col-span-2 md:col-span-2 bg-white shadow-lg hover:shadow-2xl transform transition-all hover:scale-105 cursor-pointer flex flex-col items-center justify-center h-40 md:h-56 rounded-lg overflow-hidden"
            >
                <i class="fas fa-calendar-alt fa-2x md:fa-3x mb-2 text-indigo-600"></i> <!-- Adjust icon size here -->
                <div class="text-base md:text-xl font-semibold text-gray-800">All Appointments</div> <!-- Adjust text size here -->
            </Link>
        </div>


    </div>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const { props } = usePage();

const nextAppointment = ref({
    date: '2024-08-22',
    time: '10:00 AM',
    patient: 'John Doe'
});


</script>

<style scoped>
/* General Tile Styling */
.tile {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

/* Tile hover effects */
.tile:hover {
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    transform: translateY(-3px);
}

/* Icon colors */
.text-indigo-600 {
    color: #4f46e5; /* Indigo for View Patients */
}
.text-green-500 {
    color: #10b981; /* Green for New Appointment */
}
.text-yellow-500 {
    color: #f59e0b; /* Yellow for All Appointments */
}

/* Spacing between tiles */
.grid {
    gap: 1.5rem; /* Adjust grid gap size here */
}

/* Notifications Section */
.max-h-48 {
    max-height: 12rem; /* Adjust notification container height here */
}
.overflow-y-auto {
    overflow-y: auto; /* Makes the container scrollable */
}

/* Notification icon color */
.text-blue-500 {
    color: #3b82f6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr 1fr; /* 2 tiles per row on mobile */
    }

    .h-40 {
        height: 6rem; /* Adjust mobile tile height here */
    }

    /* Full width for notifications section */
    .col-span-2 {
        grid-column: span 2  / span 2; /* Ensure full width for notifications */
    }

    /* Adjust text sizes on smaller screens */
    .text-xl {
        font-size: 1rem; /* Smaller heading */
    }
    .text-lg {
        font-size: 1rem; /* Smaller text */
    }
    .text-base {
        font-size: 0.75rem; /* Smaller body text */
    }
    .text-xs {
        font-size: 0.5rem; /* Smaller fine print */
    }

    /* Adjust icon sizes on mobile */
    .fa-2x {
        font-size: 1.5rem; /* Icon size for mobile */
    }

    .max-h-48 {
        max-height: 30rem; /* Reduce notification height on smaller screens */
    }
}
</style>
