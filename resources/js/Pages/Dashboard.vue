<template>
    <AppLayout title="Dashboard">
        

        <!-- Main Content Section -->
        <div class="h-screen flex flex-col bg-white">
            <!-- Dashboard body -->
            <div class="flex-grow">
                <!-- DynamicContainer now has no scrollable behavior -->
                <DynamicContainer @tab-change="updateDashboardTitle" class="h-auto">
                    <!-- Pass content here -->
                    <component :is="currentPage" />
                </DynamicContainer>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/inertia-vue3';
// import DynamicContainer from "@/Components/DashboardComponents/DynamicContainer.vue";
import Appointments from "@/Components/appointment_management/Appointments.vue";
import UserManagement from "@/Components/manage_clinic_personnel/UserManagement.vue";
import DashboardHome from "@/Components/DashboardComponents/DashboardHome.vue";
import CreatePatientForm from "@/Components/patient_management/CreatePatientForm.vue";
import Notification from '@/Components/notifications/Notification.vue';
// import example1 from "@/Pages/example.vue";

const dashboardTitle = ref('Dashboard'); // Default title

const updateDashboardTitle = ({ title }) => {
    dashboardTitle.value = title;
};

const props = defineProps({
    tabComponent: {
        type: String,
        required: true,
    },
});

const { component } = usePage();
const currentPage = computed(() => componentsMap[props.tabComponent]);

const componentsMap = {
    Appointments,
    CreatePatientForm,
    Notification,
    DashboardHome,
    UserManagement,
    // Add more components as needed
};
</script>

<style scoped>
/* Styles that prevent scrollability */
h-screen {
    height: 100vh;
}

.h-auto {
    height: auto;
}

/* Optional: Add some padding inside the container if needed */
.p-4 {
    padding: 1rem;
}
</style>


