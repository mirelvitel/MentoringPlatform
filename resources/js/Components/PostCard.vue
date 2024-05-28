<template>
    <div
        class="bg-white shadow-sm border border-gray-300 p-4 rounded-lg mb-4 w-full"
    >
        <div class="flex items-center mb-2">
            <div class="h-10 w-10 rounded-full bg-gray-300 mr-4"></div>
            <div>
                <div class="font-semibold text-green-600">
                    {{ post.user }}
                </div>
                <div class="text-sm text-gray-400">{{ post.created_at }}</div>
            </div>
        </div>
        <div class="text-gray-800">
            <p>{{ post.content }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostCard",
    props: {
        post: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style scoped></style>
