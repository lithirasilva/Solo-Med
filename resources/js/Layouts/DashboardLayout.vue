<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynamicContainer from "@/Components/DashboardComponents/DynamicContainer.vue";
import { ref } from 'vue';

const dashboardTitle = ref('Dashboard'); // Default title

</script>

<template>
    <AppLayout>
         <!-- <div class="w-full bg-orange-500 p-4 text-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ dashboardTitle }}
            </h2>
        </div> -->
        <DynamicContainer>
        <slot>

        </slot>
        </DynamicContainer>
    </AppLayout>
</template>

