<template>
    <div>
        <h1>{{ example.name }}</h1>
        <p>{{ example.description }}</p>
        <a :href="`/examples/${example.id}/edit`">Edit</a>
        <form :action="`/examples/${example.id}`" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit">Delete</button>
        </form>
        <router-link to="/examples">Back to List</router-link>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'

const { example } = usePage().props
</script>
