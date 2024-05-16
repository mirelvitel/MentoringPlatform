<script setup>

const props = defineProps({
    users: {
        type: Array,
        required: true
    }
});



</script>


<template>
    <div>
        <div v-for="user in users" :key="user.id">
            <h1>{{ user.name }}</h1>
            <p>{{ user.email }}</p>
        </div>
    </div>
</template>
