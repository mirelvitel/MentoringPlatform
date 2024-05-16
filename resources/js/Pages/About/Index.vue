<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted } from "vue";

// Define props
const props = defineProps({
    posts: {
        type: Array,
        required: true
    },
});

// Log a message when the component is mounted
onMounted(() => {
    console.log('About page mounted');
    console.log(props.posts);
});
</script>

<template>
    <AppLayout>
        <div class="container">
            <h1>About</h1>
            <p>This is the about page</p>

            <!-- Iterate over posts and display each post's title -->
            <div v-for="post in posts" :key="post.id">
                <h1>{{ post.title }}</h1>
            </div>
        </div>

    </AppLayout>
</template>

