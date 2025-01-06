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
                <div
                    class="flex flex-col md:flex-row items-center justify-between bg-white p-4 rounded-lg shadow-md mb-6 space-y-4 md:space-y-0"
                >
                    <!-- Simple Topic Select -->
                    <div class="w-full md:w-1/4">
                        <select
                            v-model="selectedTopic"
                            class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">All Topics</option>
                            <option value="Technology">Technology</option>
                            <option value="Health">Health</option>
                            <option value="Business">Business</option>
                            <option value="Education">Education</option>
                            <option value="Science">Science</option>
                            <option value="Sport">Sport</option>
                            <option value="Politics">Politics</option>
                            <option value="Mathematics">Mathematics</option>
                        </select>
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

                <!-- Add Resource Button -->
                <div class="flex justify-end mb-4">
                    <button
                        @click="showCreateModal = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow"
                    >
                        Add Resource
                    </button>
                </div>

                <!-- Create Resource Modal -->
                <div
                    v-if="showCreateModal"
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                >
                    <div class="bg-white rounded-lg p-6 shadow-md w-full max-w-lg">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Create New Resource</h2>
                        <form @submit.prevent="createResource">
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input
                                    v-model="newResource.title"
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter resource title"
                                    required
                                />
                            </div>
                            <div class="mb-4">
                                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                                <input
                                    v-model="newResource.author"
                                    id="author"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter author's name"
                                />
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea
                                    v-model="newResource.description"
                                    id="description"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Write a brief description"
                                ></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select
                                    v-model="newResource.category"
                                    id="category"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    required
                                >
                                    <option value="">Select a category</option>
                                    <option v-for="cat in categories" :key="cat" :value="cat">
                                        {{ cat }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="topic" class="block text-sm font-medium text-gray-700">Topic</label>
                                <input
                                    v-model="newResource.topic"
                                    id="topic"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter topic"
                                />
                            </div>
                            <div class="mb-4">
                                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                <select
                                    v-model="newResource.type"
                                    id="type"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    required
                                >
                                    <option value="">Select a type</option>
                                    <option value="book">Book</option>
                                    <option value="document">Document</option>
                                    <option value="article">Article</option>
                                </select>
                            </div>

                            <div class="mb-4" v-if="newResource.type === 'book'">
                                <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Image</label>
                                <input
                                    id="cover_image"
                                    type="file"
                                    @change="handleFileUpload"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                />
                            </div>

                            <div class="flex justify-end space-x-4">
                                <button
                                    type="button"
                                    @click="showCreateModal = false"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Create Resource Modal End -->

                <!-- Display Resources -->
                <div class="flex-1 pl-3 flex flex-col">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-grow">
                        <!-- Resources -->
                        <div
                            v-for="resource in resources"
                            :key="`resource-${resource.id}`"
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
                                <h2 class="text-lg font-semibold text-blue-700 mb-1">
                                    {{ resource.title }}
                                </h2>
                                <h3 class="text-sm text-gray-600 mb-2">
                                    by {{ resource.author }}
                                </h3>
                                <!-- Add small text indicating the type -->
                                <p class="text-xs text-gray-500 italic mb-2">
                                    {{ resource.type }}
                                </p>
                                <p class="text-gray-700 flex-1 text-sm">
                                    {{ resource.description }}
                                </p>
                                <button
                                    class="mt-2 self-start text-blue-600 hover:text-blue-800 font-medium flex items-center text-sm"
                                >
                                    Learn More
                                    <svg
                                        class="w-4 h-4 ml-1 transition-transform duration-200 transform group-hover:translate-x-1"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Books (fetched separately) -->
                        <div
                            v-for="book in books"
                            :key="`book-${book.id}`"
                            class="bg-white rounded-xl shadow hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1"
                        >
                            <div class="h-40 overflow-hidden rounded-t-xl">
                                <img
                                    src="/assets/images/pdf.jpg"
                                    alt="Book Cover"
                                    class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300"
                                />
                            </div>
                            <div class="p-4 flex flex-col">
                                <h2 class="text-lg font-semibold text-green-700 mb-1">
                                    {{ book.title }}
                                </h2>
                                <h3 class="text-sm text-gray-600 mb-2">
                                    {{ book.type }}
                                </h3>
                                <!-- Add small text indicating the type -->
                                <p class="text-xs text-gray-500 italic mb-2">
                                    {{ book.type }}
                                </p>
                                <p class="text-gray-700 flex-1 text-sm">
                                    {{ book.description }}
                                </p>
                                <p class="text-sm text-gray-500 italic">
                                    File: {{ book.file_name }}
                                </p>
                                <a
                                    :href="book.file_path"
                                    download
                                    class="mt-2 self-start bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors duration-200"
                                >
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Most Read Sidebar (unchanged) -->
            <div class="mostread w-[220px] divide-x-2 pl-6 relative z-10">
                <h1 class="text-lg text-gray-500 pl-2 mb-4">MOST READ</h1>
                <ol class="list-decimal pl-5 space-y-4">
                    <li
                        v-for="resource in mostReadResources"
                        :key="resource.id"
                        class="flex items-start space-x-4 hover:bg-gray-100 p-3 rounded-md transition-colors duration-200"
                    >
                        <Book
                            :title="resource.title"
                            :author="resource.author"
                            :cover="resource.cover_image"
                            class="w-16 h-16 object-cover rounded-md"
                        />
                        <div>
                            <h3 class="text-md font-medium text-gray-800">
                                {{ resource.title }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ resource.author }}
                            </p>
                            <p class="text-xs text-gray-500 italic">
                                {{ resource.type }}
                            </p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import {ref, watch, onMounted} from "vue";
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import NavLeft from "@/Shared/NavLeft.vue";
import Book from "@/Components/Book.vue";
import {MagnifyingGlassIcon} from "@heroicons/vue/20/solid/index.js";

const file = ref(null);
const showCreateModal = ref(false);

// Resource form state
const newResource = ref({
    title: "",
    author: "",
    description: "",
    category: "",
    topic: "",
    type: "",
});

// Predefined categories
const categories = [
    "Reference",
    "Non-fiction",
    "Technology",
    "Business",
    "Personal Development",
];

const handleFileUpload = (event) => {
    file.value = event.target.files[0];
};

const createResource = async () => {
    try {
        const formData = new FormData();
        formData.append("title", newResource.value.title);
        formData.append("author", newResource.value.author);
        formData.append("description", newResource.value.description);
        formData.append("category", newResource.value.category);
        formData.append("topic", newResource.value.topic);
        formData.append("type", newResource.value.type);

        // Only append a file if it's a book
        if (newResource.value.type === "book" && file.value) {
            formData.append("cover_image", file.value);
        }

        await axios.post("/resources", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        fetchResources();

        // Reset the form and modal
        newResource.value = {
            title: "",
            author: "",
            description: "",
            category: "",
            topic: "",
            type: "",
        };
        file.value = null;
        showCreateModal.value = false;
    } catch (error) {
        console.error("Error creating resource:", error);
    }
};

// Data for search and filtering
const searchTerm = ref("");
const selectedTopic = ref("");
const resources = ref([]);
const mostReadResources = ref([]);
const books = ref([]);

const fetchResources = async () => {
    try {
        const response = await axios.get("/api/resources", {
            params: {
                topic: selectedTopic.value || undefined,
                search: searchTerm.value || undefined,
            },
        });

        // Sort descending by created_at (newest first)
        resources.value = response.data.sort((a, b) => {
            return new Date(b.created_at) - new Date(a.created_at);
        });
    } catch (error) {
        console.error("Error fetching resources:", error);
    }
};


const fetchBooks = async () => {
    try {
        const response = await axios.get("/books");
        books.value = response.data.books;
    } catch (error) {
        console.error("Error fetching books:", error);
    }
};

const fetchMostReadResources = async () => {
    try {
        const response = await axios.get("/api/resources/most-read");
        mostReadResources.value = response.data;
    } catch (error) {
        console.error("Error fetching most read resources:", error);
    }
};

onMounted(() => {
    fetchResources();
    fetchBooks();
    fetchMostReadResources();
});

// Re-fetch whenever searchTerm or selectedTopic changes
watch([searchTerm, selectedTopic], () => {
    fetchResources();
    fetchBooks();
});
</script>

<style scoped>
.content-width-400 {
    max-width: 1200px;
}

.mostread {
}
</style>
