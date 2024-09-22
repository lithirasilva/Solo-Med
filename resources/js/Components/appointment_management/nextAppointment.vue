<template>
    <div class="relative m-4">
        <div class="absolute inset-0 pulse-background rounded-lg"></div>
        <div class="block p-6 bg-red-100 rounded-lg shadow-lg hover:shadow-xl transition duration-300 z-10">
            <div>
                <h1 class="text-2xl font-semibold mb-4">Next Appointment</h1>
                <h2 class="text-lg font-medium mb-2">Patient: {{ nextAppointment.patient.firstName }} {{nextAppointment.patient.lastName}}</h2>
                <h3 class="text-md mb-2">Appointment ID: {{ nextAppointment.appointmentId }}</h3>
                <h3 class="text-md mb-2">Next Appointment At: {{ formattedAppointmentTime }}</h3>
                <h4 class="text-xl mb-4">Time Left: {{ timeLeft }}</h4>
            </div>
            <audio ref="ringer" src="path/to/ringer-sound.mp3" />

            <Link :href="`appointments/${nextAppointment.appointmentId}/edit`" class="drop-shadow-md bg-orange-400 rounded p-2">
                Go to Appointment
            </Link>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount, computed } from 'vue';

export default {
    components: {
        Link
    },
    props: {
        nextAppointment: {
            type: Object,
            required: true
        },
        patientFullName: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const timeLeft = ref('');

        const formattedAppointmentTime = computed(() => {
            const appointmentTime = new Date(props.nextAppointment.startTime);
            return appointmentTime.toLocaleString(); // Formats to local timezone
        });

        const updateTimeLeft = () => {
            const now = new Date();
            const appointmentTime = new Date(props.nextAppointment.startTime);
            const difference = appointmentTime - now;

            if (difference < 0) {
                timeLeft.value = "Appointment started!";
                clearInterval(interval);
            } else {
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);
                timeLeft.value = `${hours}h ${minutes}m ${seconds}s`;
            }
        };

        let interval;

        onMounted(() => {
            updateTimeLeft(); // Initial update
            interval = setInterval(updateTimeLeft, 1000);
            if (this.$refs.ringer) this.$refs.ringer.play();
        });

        onBeforeUnmount(() => {
            clearInterval(interval);
        });

        return {
            timeLeft,
            formattedAppointmentTime
        };
    }
}
</script>

<style scoped>
@keyframes pulse {
    0% {
        transform: scale(1);
        background-color: rgba(255, 0, 0, 0.1);
    }
    50% {
        transform: scale(1.05);
        background-color: rgba(255, 0, 0, 0.2);
    }
    100% {
        transform: scale(1);
        background-color: rgba(255, 0, 0, 0.1);
    }
}

.pulse-background {
    animation: pulse 2s infinite;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0; /* Behind the component */
    border-radius: inherit; /* Match the rounded corners of the component */
}
</style>
