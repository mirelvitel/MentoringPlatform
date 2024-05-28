<template>
    <div
        class="bg-white shadow-sm border border-gray-300 p-4 rounded-lg mb-4 w-full"
    >
        <div class="flex items-center mb-2">
            <div class="h-10 w-10 rounded-full bg-gray-300 mr-4"></div>
            <div>
                <div class="font-semibold text-green-600">
                    {{ post.user.name }}
                </div>
                <div class="text-sm text-gray-400">{{ moment(post.created_at).format('MMMM Do YYYY, H:mm')}}</div>
            </div>
        </div>
        <div class="text-gray-800">
            <p v-html="post.content"></p>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "PostCard",
    computed: {
        moment() {
            return moment
        }
    },
    props: {
        post: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style scoped></style>
