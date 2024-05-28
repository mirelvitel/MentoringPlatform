<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PostCard from "@/Components/PostCard.vue";
import { computed, ref } from "vue";
import {
    HomeIcon,
    AtSymbolIcon,
    CalendarDaysIcon,
    ChartBarIcon,
    UserGroupIcon,
    NewspaperIcon,
} from "@heroicons/vue/20/solid/index.js";
import { PlusCircleIcon } from "@heroicons/vue/20/solid";

import axios from "axios";
import { useToast } from "vue-toastification";

const toast = useToast();
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const displayForm = ref(false);
const form = ref({
    content: "",
});

function savePost() {
    axios
        .post("/home/post", form.value)
        .then((response) => {
            toast.success("Post saved successfully");
            props.items.push(response.data);
            displayForm.value = false;
            form.value = { content: "" };
        })
        .catch((error) => {
            toast.error("An error occurred while saving the post");
        });
}

const user = computed(() => page.props.auth.user);
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex">
            <div class="nav-left w-[200px] text-gray-500 pl-4">
                <h1 class="text-xl text-gray-500 mb-2">MAIN</h1>
                <div class="flex items-center text-primary mb-8">
                    <HomeIcon class="h-6 w-6 mr-3" />
                    <a :href="route('home')" class="">Home</a>
                </div>

                <h1 class="text-xl text-gray-500 mb-2">TOOLS</h1>
                <div class="flex items-center text-primary mb-2">
                    <AtSymbolIcon class="h-6 w-6 mr-3" />
                    <a :href="route('email')" class="">Email</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <CalendarDaysIcon class="h-6 w-6 mr-3" />
                    <a :href="route('calendar')" class="">Calendar</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <ChartBarIcon class="h-6 w-6 mr-3" />
                    <a :href="route('reports')" class="">Reports</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <UserGroupIcon class="h-6 w-6 mr-3" />
                    <a :href="route('users')" class="">Users</a>
                </div>
            </div>

            <div class="flex flex-col mx-6 content-width--400 px-2 w-full">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl text-gray-500">POSTS</h1>
                    <button class="flex space-x-2 text-primary font-semibold">
                        <PlusCircleIcon class="w-6 h-6" />
                        <span @click="displayForm = true">Create new Post</span>
                    </button>
                </div>

                <PostCard
                    v-for="item in items"
                    :post="item"
                ></PostCard>

                <div
                    class="form fixed inset-0 bg-gray-800 bg-opacity-25 flex items-center justify-center"
                    v-if="displayForm"
                >
                    <div
                        class="bg-white shadow border border-primary p-12 rounded-lg min-w-[500px]"
                    >
                        <div class="form-group flex flex-col mb-4 w-full">
                            <label for="content">Content</label>
                            <textarea
                                v-model="form.content"
                                id="content"
                                class="form-control"
                            ></textarea>
                        </div>

                        <button
                            @click="savePost()"
                            class="bg-secondary py-1 text-white transition-all hover:bg-green-600 px-4 rounded"
                        >
                            Create
                        </button>
                        <button
                            @click="displayForm = false"
                            class="py-1 text-white ml-4 bg-red-500 transition-all hover:bg-red-600 px-4 rounded"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <div class="summary w-[200px] bg-gray-200">
                <h1 class="text-xl text-gray-500">REPORTS SUMMARY</h1>
            </div>
        </div>
    </AppLayout>
</template>
