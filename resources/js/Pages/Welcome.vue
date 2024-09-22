<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { ref, onMounted } from 'vue';
import WhatIsSoloMed from "@/Components/HomeTabComponents/WhatIsSoloMed.vue";
import Hero from "@/Components/Hero.vue";
import WhySoloMed from '@/Components/HomeTabComponents/WhySoloMed.vue';
import Features from '@/Components/HomeTabComponents/Features.vue';
import Pricing from '@/Components/HomeTabComponents/Pricing.vue';
import RequestTrial from '@/Components/HomeTabComponents/RequestTrial.vue';
import About from '@/Components/HomeTabComponents/About.vue';
import Contact from '@/Components/HomeTabComponents/Contact.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const sections = ref([
    { id: 'what-is-solomed', label: 'What is SoloMed?' },
    { id: 'why-solomed', label: 'Why SoloMed?' },
    { id: 'features', label: 'Features' },
    { id: 'pricing', label: 'Pricing' },
    { id: 'request-trial', label: 'Request a Trial' },
    { id: 'about', label: 'About Us' },
    { id: 'contact', label: 'Contact Us' },
]);

const menuOpen = ref(false);

function scrollToSection(id) {
    const element = document.getElementById(id);
    if (element) {
        window.scrollTo({
            top: element.offsetTop - 80, // Adjust offset for fixed navbar
            behavior: 'smooth',
        });
    }
}

function toggleMenu() {
    menuOpen.value = !menuOpen.value;
}
</script>


<template>
    <Head title="Welcome"/>
    <div class="flex flex-col min-h-screen bg-white">
        <!-- Header -->
        <header class="w-full grid grid-cols-1 lg:grid-cols-2 items-center py-4 px-6 lg:px-12 bg-white shadow">
            <div class="flex justify-center lg:justify-start">
                <ApplicationLogo class="h-24 w-auto"/>
            </div>
            <nav v-if="canLogin" class="flex justify-center lg:justify-end space-x-4 mt-4 lg:mt-0">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="text-sm px-4 py-2 text-white bg-[#fb6f04] rounded-md transition-transform transform hover:scale-105"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="text-sm px-4 py-2 text-white bg-[#fb6f04] rounded-md transition-transform transform hover:scale-105"
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="text-sm px-4 py-2 text-white bg-[#FC8C36] rounded-md transition-transform transform hover:scale-105"
                    >
                        Register
                    </Link>

                </template>

            </nav>

        </header>

      <!-- Sticky Navbar -->
<nav class="bg-transparent py-6 px-6 sticky top-0 z-10">
    <div class="flex justify-center">
        <div class="bg-[#ff5c00] text-white rounded-full py-6 px-20 flex space-x-12">
            <button
                v-for="section in sections"
                :key="section.id"
                @click="scrollToSection(section.id)"
                class="text-sm sm:text-base font-medium bg-transparent border-none cursor-pointer transition-transform duration-300 transform hover:scale-105 hover:text-[#]"
            >
                {{ section.label }}
            </button>
            <!-- Updated Book Appointment Button -->
            <Link
                :href="'/patient-home'"
                class="text-sm sm:text-base font-medium bg-[#fff] text-[#ff5c00] border-2 border-[#fff] rounded-full px-6 py-3 cursor-pointer transition-transform duration-300 transform hover:scale-110 hover:bg-[#ff5c00] hover:text-white"
            >

    Book Appointment
</Link>
        </div>
    </div>
</nav>


        <!-- Main content -->
        <main class="flex-1">
            <!-- Hero Section -->
            <Hero/>

            <!-- Content Sections -->
            <section id="what-is-solomed" class="py-8">
                <WhatIsSoloMed/>
            </section>
            <section id="why-solomed" class="py-8">
                <WhySoloMed/>
            </section>
            <section id="features" class="py-8">
                <Features/>
            </section>
            <section id="pricing" class="py-8">
                <Pricing/>
            </section>
            <section id="request-trial" class="py-8">
                <RequestTrial/>
            </section>
            <section id="about" class="py-8">
                <About/>
            </section>
            <section id="contact" class="py-8">
                <Contact/>
            </section>
            <section id="booking" class="py-8">

            </section>
        </main>
        <!-- Footer -->
        <footer class="bg-[#fb6f04] text-white py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Contact Information -->
            <div>
                <h2 class="text-lg font-bold mb-4">Contact Us</h2>
                <p class="mb-2">Email: <a href="mailto:support@solomed.com" class="underline">support@solomed.com</a></p>
                <p class="mb-2">Phone: <a href="tel:+1234567890" class="underline">+1 (234) 567-890</a></p>
                <p class="mb-2">Address: 123 Clinic Lane, Health City, HC 12345</p>
            </div>
            <!-- Social Media Links -->
            <div>
                <h2 class="text-lg font-bold mb-4">Follow Us</h2>
                <div class="flex space-x-4">
                    <a href="https://facebook.com/solomed" target="_blank" class="text-white hover:text-[#FC8C36]">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.04C6.477 2.04 2 6.694 2 12.434c0 5.525 4.326 10.013 9.9 10.889V15.9h-3v-3.466h3v-2.553c0-2.966 1.768-4.577 4.466-4.577 1.277 0 2.379.095 2.697.138v3.126h-1.851c-1.435 0-1.71.686-1.71 1.69v2.215h3.418l-.447 3.466h-2.971V23.32C17.674 22.438 22 17.95 22 12.434 22 6.694 17.523 2.04 12 2.04z"/></svg>
                    </a>
                    <a href="https://twitter.com/solomed" target="_blank" class="text-white hover:text-[#FC8C36]">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6.003c-.806.356-1.67.596-2.58.705a4.557 4.557 0 0 0 1.993-2.512 9.052 9.052 0 0 1-2.887 1.1 4.53 4.53 0 0 0-7.72 4.13 12.84 12.84 0 0 1-9.33-4.71c-.335.573-.527 1.238-.527 1.95 0 1.348.689 2.537 1.735 3.235a4.497 4.497 0 0 1-2.055-.567v.057c0 1.875 1.337 3.44 3.113 3.794a4.55 4.55 0 0 1-2.045.078c.575 1.793 2.244 3.101 4.216 3.14a9.083 9.083 0 0 1-5.619 1.937 12.783 12.783 0 0 0 6.916 2.038c8.296 0 12.831-6.876 12.831-12.831 0-.196-.004-.391-.013-.585a9.174 9.174 0 0 0 2.253-2.33z"/></svg>
                    </a>
                    <a href="https://linkedin.com/company/solomed" target="_blank" class="text-white hover:text-[#FC8C36]">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.23 0H1.77C.792 0 0 .792 0 1.77v20.46c0 .978.792 1.77 1.77 1.77h20.46c.978 0 1.77-.792 1.77-1.77V1.77C24 .792 23.208 0 22.23 0zM7.41 20.452H4.86V9.603h2.55v10.849zm-1.275-12.045c-.821 0-1.486-.663-1.486-1.486s.665-1.486 1.486-1.486c.821 0 1.486.663 1.486 1.486s-.665 1.486-1.486 1.486zm13.571 12.045h-2.55v-5.594c0-1.33-.047-3.046-1.86-3.046-1.86 0-2.14 1.469-2.14 2.985v5.655h-2.549V9.603h2.438v1.49h.033c.343-.649 1.182-1.339 2.439-1.339 2.605 0 3.088 1.715 3.088 3.953v6.644h-.003z"/></svg>
                    </a>
                </div>
            </div>
            <!-- Call to Action -->
            <div class="text-center md:text-left">
                <h2 class="text-lg font-bold mb-4">Ready to Get Started?</h2>
                <p class="mb-4">Join the many successful clinics who have transformed their practice with SoloMed. Get in touch with us today to learn more or to start your free trial.</p>
                <a href="#request-trial" class="inline-block bg-white text-[#fb6f04] py-2 px-4 rounded-md text-sm font-semibold hover:bg-[#FC8C36] hover:text-white transition-colors">Request a Trial</a>
            </div>
        </div>
    </div>
    <div class="py-10 text-center text-sm">
        <p>&copy; 2024 SoloMed. All rights reserved.</p>
    </div>
</footer>

    </div>
</template>





<style scoped>
/* Adjustments for smaller screens */
@media (max-width: 768px) {
    .text-center {
        text-align: center !important;
    }

    .px-4 {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }

    .px-6 {
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
    }

    .py-4 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-8 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }

    .mt-4 {
        margin-top: 1rem !important;
    }
}
</style>


