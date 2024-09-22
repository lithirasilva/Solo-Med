<script setup>
import { ref, onMounted } from 'vue';
import WhatIsSoloMedImage from '../../../../public/images/Discover.png';

// Reactive data for the component
const title = ref('Discover SoloMed');
const paragraph1 = ref('Welcome to your clinic\'s new digital hub, where managing your practice has never been easier! Our app empowers you to effortlessly view and organize both past and upcoming appointments, giving you full visibility into your schedule. Dive deep into patient medical records and history with just a single click, ensuring you make accurate diagnoses with confidence. Seamlessly assign and manage profiles for your clinic staff, and streamline patient interactions by allowing them to book appointments directly through your clinic\'s link. Keep your clinic\'s finances in check with our integrated management tools, and connect with suppliers to keep everything running smoothly. With a host of additional features designed to enhance every aspect of your practice, our app is your all-in-one solution for efficient, modern clinic management. Discover the future of healthcare administration today!');
const paragraph2 = ref('Discover our innovative platform designed to elevate your user experience with a range of cutting-edge features. Our app combines a user-friendly interface with robust functionality to help you achieve your goals efficiently. Whether you\'re navigating through our intuitive dashboards or utilizing our customizable settings, you\'ll find a seamless blend of ease and power at your fingertips. Our dedicated 24/7 customer support is always available to assist you, ensuring that you get the most out of our diverse range of tools and services tailored to meet your specific needs. Explore the future of productivity with our app and experience the difference firsthand.');
const bulletPoints = ref([
    'View Past & Upcoming Appointments',
    'View Patient Medical Records',
    'View Patient\'s Past Appointments',
    'Assign Profiles To Your Clinic Staff',
    'Access Patient History In One Click To Make Accurate Diagnosis\'',
    'Allow Patients To Make Appointments Through Your Clinic\'s Link',
    'Manage Your Clinic Finances',
]);

// Intersection Observer setup
const fadeInElements = ref([]);

const observeElements = () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    fadeInElements.value.forEach(element => observer.observe(element));
};

onMounted(() => {
    fadeInElements.value = Array.from(document.querySelectorAll('.fade-in-element'));
    observeElements();
});
</script>

<template>
    <div class="min-h-screen bg-orange-0 bg-opacity-0 p-4 sm:p-8 flex flex-col items-center">
        <!-- Image Section -->
        <div class="flex-shrink-0 mb-6 fade-in-element">
            <img :src="WhatIsSoloMedImage" alt="Image of 3d illustration" class="w-full max-w-[300px] sm:max-w-[400px] lg:max-w-[500px] object-cover mx-auto">
        </div>

        <!-- Content Section -->
        <div class="p-6 sm:p-10 bg-orange-600 text-white rounded-3xl shadow-lg space-y-4 sm:space-y-6 max-w-2xl sm:max-w-7xl text-container fade-in-element">
            <div>
                <h1 class="text-4xl font-bold mb-4 text-center">{{ title }}</h1>
                
                <div class="space-y-4 text-center font-bold">
                    <p class="text-lg">{{ paragraph1 }}</p>
                </div>

                <div class="space-y-4 text-lg mt-6 font-bold">
                    <ul class="list-disc list-inside text-left">
                        <li v-for="(point, index) in bulletPoints" :key="index" class="ml-6">{{ point }}</li>
                    </ul>

                    <div class="space-y-4 mt-4 text-center">
                        <p class="text-lg">{{ paragraph2 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add internal styling for padding and margins */
p {
    padding: 0.5rem;
    margin: 0.5rem 0;
}
ul {
    padding: 0;
    margin-left: 2rem;
}

/* Fade-in animation */
.fade-in-element {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}
.fade-in {
    opacity: 1;
    transform: translateY(0);
}
</style>
