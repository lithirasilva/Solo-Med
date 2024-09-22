<template>
    <section class="relative flex flex-col md:flex-row items-center justify-between min-h-screen w-full overflow-hidden bg-cover bg-center p-12">
        <!-- Dark overlay for better text readability -->
        <div class="absolute inset-0 bg-black opacity-0"></div>
        
        <!-- Text Content -->
        <div class="relative z-100 flex flex-col items-start md:items-center justify-right text-center md:w-1/2 space-y-6 animate-text">
            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                {{ title }}
            </h1>

            <!-- Subtitle -->
            <p class="text-base md:text-lg lg:text-xl leading-relaxed drop-shadow-md">
                {{ subtitle }}
            </p>
        </div>

        <!-- Image Content -->
        <div class="relative z-100 flex justify-end md:w-1/2 mt-8 md:mt-0 animate-image">
            <img src="/Images/Hero.png" alt="Image Description" class="w-full h-auto object-cover">
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

// Reactive properties for title and subtitle
const title = ref('Welcome to SoloMed!');
const subtitle = ref('SoloMed is dedicated to enhancing your medical practice\'s efficiency and effectiveness with our cutting-edge, innovative solutions. Our platform is designed to address the unique challenges faced by healthcare providers, offering a range of features to optimize workflow, reduce administrative burdens, and enhance overall productivity. By integrating advanced technology with user-friendly design, SoloMed enables you to streamline your operations and improve patient care, ensuring that you can focus more on delivering high-quality medical services. Explore our comprehensive platform to discover how our tailored solutions can transform your practice, increase your operational efficiency, and ultimately lead to better patient outcomes.');
</script>

<style scoped>
/* Section Background */
section {
    /* Background Image Sizing Options */
    background-size: cover; /* Ensures the background covers the entire section */
    background-position: right; /* Positions the background image to the right */
    background-repeat: no-repeat; /* Prevents the image from repeating */
}

/* Title Styles */
h1 {
    color: rgb(69, 69, 69); /* Ensures the text is visible on the background */
}

/* Subtitle Styles */
p {
    color: rgb(59, 59, 59); /* Ensures the text is visible on the background */
}

/* Animation for Text */
@keyframes slide-up {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animate-text {
    animation: slide-up 1s ease-out;
}

/* Animation for Image */
@keyframes slide-up-image {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animate-image {
    animation: slide-up-image 1s ease-out;
}

/* Media Query for Small Screens */
@media (max-width: 768px) {
    h1 {
        font-size: 1.5rem; /* Smaller title on small screens */
        text-align: center; /* Center title text on small screens */
    }

    p {
        font-size: 0.875rem; /* Smaller subtitle text on small screens */
        text-align: center; /* Center subtitle text on small screens */
    }
}
</style>
