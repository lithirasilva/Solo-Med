<template>
    <form @submit.prevent="submitForm">
        <input v-model="form.name" type="text" placeholder="Name" required>
        <input v-model="form.email" type="email" placeholder="Email" required>
        <button type="submit">Send OTP</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: '',
                email: ''
            }
        };
    },
    methods: {
        submitForm() {
            this.$inertia.post('/public-appointments/send-otp', this.form);
        }
    }
};
</script>
