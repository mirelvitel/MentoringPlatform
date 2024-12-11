<script setup>
import { ref, watch, onMounted } from "vue";
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import NavLeft from "@/Shared/NavLeft.vue";
import TopicDropdown from "@/Components/TopicDropdown.vue";
import Book from "@/Components/Book.vue";
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid/index.js";

// Data properties for search and filtering
const searchTerm = ref("");
const selectedTopic = ref("");
const resources = ref([]);
const mostReadResources = ref([]); // Separate array for Most Read

// Method to fetch main resources from the API
const fetchResources = async () => {
    try {
        const response = await axios.get("/api/resources", {
            params: {
                topic: selectedTopic.value || undefined,
                search: searchTerm.value || undefined,
            },
        });
        resources.value = response.data;
    } catch (error) {
        console.error("Error fetching resources:", error);
    }
};

// Method to fetch most read resources from the API
const fetchMostReadResources = async () => {
    try {
        const response = await axios.get("/api/resources/most-read");
        mostReadResources.value = response.data;
    } catch (error) {
        console.error("Error fetching most read resources:", error);
    }
};

// Fetch resources when the component is mounted
onMounted(() => {
    fetchResources();
    fetchMostReadResources(); // Fetch most read separately
});

// Watch for changes in searchTerm and selectedTopic, and refetch data
watch([searchTerm, selectedTopic], fetchResources);
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex min-h-screen bg-gray-100">
            <!-- Left Navigation Panel -->
            <NavLeft />

            <!-- Main Content Area -->
            <div class="flex flex-col mx-6 content-width-400 px-2 w-full divide-x-2">
                <!-- Header -->
                <div class="flex items-center mb-4">
                    <h1 class="text-lg text-gray-500 pl-2">RESOURCES</h1>
                </div>

                <!-- Filters and Search -->
                <div class="flex flex-col md:flex-row items-center justify-between bg-white p-4 rounded-lg shadow-md mb-6 space-y-4 md:space-y-0">
                    <!-- Topic Dropdown -->
                    <div class="w-full md:w-1/4 relative">
                        <!-- Added relative positioning for z-index to work -->
                        <TopicDropdown v-model="selectedTopic" class="w-full z-20" />
                        <!-- Ensure dropdown menu has higher z-index -->
                    </div>

                    <!-- Search Bar -->
                    <div class="w-full md:w-1/4">
                        <form class="flex" @submit.prevent="fetchResources">
                            <div class="relative w-full">
                                <input
                                    v-model="searchTerm"
                                    type="search"
                                    placeholder="Search resources..."
                                    id="resource-search"
                                    class="w-full pl-4 pr-10 py-2 border border-gray-300 focus:outline-none rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-200"
                                />
                                <button
                                    type="submit"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white p-1 rounded-full transition-colors duration-200"
                                    aria-label="Search"
                                >
                                    <MagnifyingGlassIcon class="h-5 w-5" />
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Display Resources -->
                <div class="flex-1 pl-3 flex flex-col">
                    <!-- Explore Resources Header -->
                    <div class="mb-4">
                        <p class="italic text-md text-primary">
                            Empower Your Journey: Access Tools and Insights for Meaningful Mentorship
                        </p>
                    </div>

                    <!-- Resource Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 flex-grow">
                        <!-- No Resources Message -->
                        <div v-if="resources.length === 0" class="col-span-full text-center text-gray-500 italic">
                            No resources found.
                        </div>

                        <!-- Resource Card -->
                        <div
                            v-else
                            v-for="resource in resources"
                            :key="resource.id"
                            class="bg-white rounded-xl shadow hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1"
                        >
                            <div class="h-40 overflow-hidden rounded-t-xl">
                                <img
                                    :src="resource.cover_image"
                                    :alt="resource.title"
                                    class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300"
                                />
                            </div>
                            <div class="p-4 flex flex-col">
                                <h2 class="text-lg font-semibold text-blue-700 mb-1">{{ resource.title }}</h2>
                                <h3 class="text-sm text-gray-600 mb-2">by {{ resource.author }}</h3>
                                <p class="text-gray-700 flex-1 text-sm">{{ resource.description }}</p>
                                <button class="mt-2 self-start text-blue-600 hover:text-blue-800 font-medium flex items-center text-sm">
                                    Learn More
                                    <svg
                                        class="w-4 h-4 ml-1 transition-transform duration-200 transform group-hover:translate-x-1"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Most Read Sidebar -->
            <div class="mostread w-[220px] divide-x-2 pl-6 relative z-10">
                <h1 class="text-lg text-gray-500 pl-2 mb-4">MOST READ</h1>
                <ol class="list-decimal pl-5 space-y-4">
                    <!-- Most Read Resource Item -->
                    <li
                        v-for="resource in mostReadResources"
                        :key="resource.id"
                        class="flex items-start space-x-4 hover:bg-gray-100 p-3 rounded-md transition-colors duration-200"
                    >
                        <Book :title="resource.title" :author="resource.author" :cover="resource.cover_image" class="w-16 h-16 object-cover rounded-md" />
                        <div>
                            <h3 class="text-md font-medium text-gray-800">{{ resource.title }}</h3>
                            <p class="text-sm text-gray-500">{{ resource.author }}</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Optional: Add custom styles if needed */
.content-width-400 {
    max-width: 1200px; /* Adjust as needed */
}
.mostread {
    /* Adjust the width and styling as needed */
}

/* Ensure dropdown menu appears above other elements */
.TopicDropdown {
    z-index: 50; /* Higher than default elements */
}
</style>
