<template>
    <AppLayout title="Dashboard">
        <div class="flex min-h-screen bg-gray-100">
            <!-- Left Navigation Panel -->
            <NavLeft />

            <!-- Main Content Area -->
            <div class="flex flex-col mx-6 content-width-400 px-2 w-full divide-x-2">

                <!-- Header / Title -->
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-xl font-bold text-gray-700">
                        Resources
                    </h1>
                    <!-- Example "Add Resource" button -->
                    <button
                        @click="showCreateModal = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow"
                    >
                        Add Resource
                    </button>
                </div>

                <!-- Filters & Search -->
                <div class="flex flex-col md:flex-row items-center justify-between bg-white p-4 rounded-lg shadow-md mb-6 space-y-4 md:space-y-0">
                    <!-- Topic Select -->
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
                            <option value="Web Development">Web Development</option>
                            <option value="Software Development">Software Development</option>

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

                <!-- Resource Grid -->
                <div class="flex-1 pl-3 flex flex-col">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-grow">
                        <!-- Single Resource Card -->
                        <div
                            v-for="resource in sortedResources"
                            :key="resource.id"
                            class="bg-white rounded-xl shadow hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1 cursor-pointer"
                            @click="handleResourceClick(resource)"
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
                                <p class="text-xs text-gray-500 italic mb-1">
                                    {{ resource.type }} | Created:
                                    <span class="text-gray-400">{{ formatDate(resource.created_at) }}</span>
                                </p>
                                <p class="text-gray-700 flex-1 text-sm line-clamp-3">
                                    {{ resource.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOST READ SIDEBAR -->
            <div class="mostread w-[220px] pl-6 relative z-10">
                <h1 class="text-lg text-gray-500 pl-2 mb-4 border-b pb-2">MOST READ</h1>
                <ol class="list-decimal pl-5 space-y-4">
                    <li
                        v-for="mr in mostReadResources"
                        :key="mr.id"
                        class="flex items-start space-x-3 hover:bg-gray-100 p-3 rounded-md transition-colors duration-200"
                    >
                        <img
                            :src="mr.cover_image ? mr.cover_image : '/assets/images/pdf.jpg'"
                            alt="Cover"
                            class="w-16 h-16 object-cover rounded shadow"
                        />
                        <div class="flex-1">
                            <h3 class="text-md font-medium text-gray-800 leading-tight mb-1">
                                {{ mr.title }}
                            </h3>
                            <p class="text-sm text-gray-500 mb-1">
                                by {{ mr.author }}
                            </p>
                            <p class="text-xs text-gray-400 italic">
                                Reads: {{ mr.read_count }}
                            </p>
                        </div>
                    </li>
                </ol>
            </div>
            <!-- END: MOST READ SIDEBAR -->

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
                            <input
                                v-model="newResource.category"
                                id="category"
                                type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                placeholder="Category"
                                required
                            />
                        </div>
                        <div class="mb-4">
                            <label for="topic" class="block text-sm font-medium text-gray-700">Topic</label>
                            <input
                                v-model="newResource.topic"
                                id="topic"
                                type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                placeholder="Enter topic"
                                required
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
            <!-- End Create Resource Modal -->

            <!-- Book Details Popup -->
            <div
                v-if="showBookPopup"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 px-4"
            >
                <div class="bg-white rounded-lg p-6 shadow-md w-full max-w-3xl relative">
                    <!-- Close button top-right -->
                    <button
                        @click="showBookPopup = false"
                        class="absolute top-4 right-4 bg-gray-100 hover:bg-gray-200 text-gray-700 p-2 rounded-full"
                        title="Close"
                    >
                        <XMarkIcon class="h-5 w-5" />
                    </button>

                    <div class="flex flex-col md:flex-row">
                        <!-- Book cover -->
                        <div class="md:w-1/3 mb-4 md:mb-0 md:mr-6">
                            <img
                                :src="selectedBookDetail?.cover_image || '/assets/images/pdf.jpg'"
                                alt="Book Cover"
                                class="w-full object-cover rounded shadow"
                            />
                        </div>

                        <!-- Right side: details -->
                        <div class="md:w-2/3">
                            <h2 class="text-xl font-semibold text-gray-700 mb-2">
                                {{ selectedBookDetail?.title }}
                            </h2>
                            <p class="text-sm text-gray-600 mb-2">
                                By {{ selectedBookDetail?.author }}
                            </p>

                            <!-- Rating & reviews -->
                            <div class="flex items-center mb-3">
                                <span class="text-yellow-500 mr-1">★</span>
                                <span class="text-sm text-gray-800 font-semibold">
                                    {{ selectedBookDetail?.rating || 'N/A' }}
                                </span>
                                <span class="text-xs text-gray-500 ml-2">
                                    ({{ selectedBookDetail?.reviews_count || 0 }} reviews)
                                </span>
                            </div>

                            <!-- Descriptions -->
                            <p class="text-gray-800 mb-2">
                                {{ selectedBookDetail?.short_description || '' }}
                            </p>
                            <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
                                {{ selectedBookDetail?.long_description || '' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button
                            @click="showBookPopup = false"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Book Details Popup -->
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted,watch  } from "vue";
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import NavLeft from "@/Shared/NavLeft.vue";

// Icons
import { MagnifyingGlassIcon, XMarkIcon } from "@heroicons/vue/20/solid";

// ------------------------
// State / Refs
// ------------------------
const resources = ref([]);

// "Most Read" resources
const mostReadResources = ref([]);

// Book detail popup states
const showBookPopup = ref(false);
const selectedBookDetail = ref(null);

// "Create Resource" modal
const showCreateModal = ref(false);
const file = ref(null);
const newResource = ref({
    title: "",
    author: "",
    description: "",
    category: "",
    topic: "",
    type: "",
});

// Searching & filtering
const searchTerm = ref("");
const selectedTopic = ref("");

// ------------------------
// Lifecycle
// ------------------------
onMounted(() => {
    fetchResources();
    fetchMostReadResources();
});
// ------------------------
// Watchers
// ------------------------
watch([searchTerm, selectedTopic], () => {
    fetchResources();
});
// ------------------------
// Computed: sortedResources
// sorts client-side by created_at (descending)
// ------------------------
const sortedResources = computed(() => {
    return [...resources.value].sort((a, b) => {
        // If we can't parse, fallback to 0
        const dateA = Date.parse(a.created_at) || 0;
        const dateB = Date.parse(b.created_at) || 0;
        return dateB - dateA; // descending
    });
});

// ------------------------
// Methods
// ------------------------
async function fetchResources() {
    try {
        // /api/resources might or might not be sorted on the server,
        // we'll do a client-side sort anyway via "sortedResources"
        const response = await axios.get("/api/resources", {
            params: {
                search: searchTerm.value || undefined,
                topic: selectedTopic.value || undefined,
            },
        });
        resources.value = response.data;
    } catch (error) {
        console.error("Error fetching resources:", error);
    }
}

// Fetch top-most read books
async function fetchMostReadResources() {
    try {
        const { data } = await axios.get("/api/resources/most-read");
        mostReadResources.value = data;
    } catch (error) {
        console.error("Error fetching most read resources:", error);
    }
}

// When user clicks a resource card
async function handleResourceClick(resource) {
    if (resource.type !== "book") return; // Only show popup if it's a book

    try {
        const { data } = await axios.get(`/api/book-details/${resource.id}`);
        selectedBookDetail.value = {
            title: data.title || resource.title,
            author: data.author || resource.author,
            cover_image: data.cover_image || resource.cover_image,
            rating: data.rating,
            reviews_count: data.reviews_count,
            short_description: data.short_description,
            long_description: data.long_description,
        };
        showBookPopup.value = true;
    } catch (err) {
        console.error("Error fetching book details:", err);
    }
}

// Create a new resource
async function createResource() {
    try {
        const formData = new FormData();
        formData.append("title", newResource.value.title);
        formData.append("author", newResource.value.author || "");
        formData.append("description", newResource.value.description || "");
        formData.append("category", newResource.value.category);
        formData.append("topic", newResource.value.topic);
        formData.append("type", newResource.value.type);

        // Only attach cover_image if a file was selected
        if (newResource.value.type === "book" && file.value) {
            formData.append("cover_image", file.value);
        }

        await axios.post("/resources", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        // Re-fetch data
        fetchResources();
        fetchMostReadResources(); // If needed, in case new resource has read_count

        // Reset form & close modal
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
}

// Handle file input
function handleFileUpload(event) {
    file.value = event.target.files[0];
}

// Utility to show date in "YYYY-MM-DD HH:mm:ss" (or whatever you like)
function formatDate(dateString) {
    if (!dateString) return "";
    return dateString; // or further transform it if desired
}
</script>

<style scoped>
.content-width-400 {
    max-width: 1200px;
}

/* For multi-line truncation on resource descriptions,
   we can clamp it to 3 lines. */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3; /* number of lines to show */
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
