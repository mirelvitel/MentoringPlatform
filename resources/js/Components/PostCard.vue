<script setup>
import moment from "moment";

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    user: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["deletePost"]);

</script>

<style scoped></style>

<template>
    <div
        class="bg-white shadow-sm border border-gray-300 p-4 rounded-lg mb-4 w-full"
    >
        <div class="flex items-center mb-2">
            <div class="h-10 w-10 rounded-full bg-gray-300 mr-4"></div>
            <div>
                <div class="font-semibold text-secondary">
                    {{ post.user.name }}
                </div>
                <div class="text-sm text-gray-400">{{ moment(post.created_at).format('MMMM Do YYYY, H:mm')}}</div>
            </div>
        </div>
        <hr>
        <div class="text-gray-800">
            <h2 class="font-semibold text-lg">{{ post.title }}</h2>
            <p v-html="post.content"></p>

            <div
                v-if="post.user.id === user.id || user.role === 'admin'"
                class="flex w-full justify-end mt-4">
                <div @click="emit('deletePost', post.id)" class="bg-red-500 w-fit text-white hover:bg-red-600 transition-all rounded px-2 py-1 cursor-pointer">
                    Delete
                </div>
            </div>

        </div>
    </div>
</template>
