<template>
    <form @submit.prevent="submitDetails">
        <input v-model="form.date" type="date" required>
        <input v-model="form.time" type="time" required>
        <textarea v-model="form.reason" placeholder="Reason for appointment" required></textarea>
        <button type="submit">Book Appointment</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: {
                date: '',
                time: '',
                reason: ''
            }
        };
    },
    methods: {
        submitDetails() {
            this.$inertia.post('/public-appointments/store-details', this.form);
        }
    }
};
</script>
