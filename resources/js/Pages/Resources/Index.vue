<script setup>
import { ref, watch, onMounted } from "vue";
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import NavLeft from "@/Shared/NavLeft.vue";
import TopicDropdown from "@/Components/TopicDropdown.vue";
import Book from "@/Components/Book.vue";
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid/index.js";

///////////////////////////
// Data for managing articles
const file = ref(null);
const handleFileUpload = (event) => {
    file.value = event.target.files[0];
};
const showCreateModal = ref(false);
const newArticle = ref({
    title: "",
    author: "",
    description: "",
    category: "",
    topic: "",
});

// Method to handle article creation
const createArticle = async () => {
    try {
        const formData = new FormData();
        formData.append("title", newArticle.value.title);
        formData.append("author", newArticle.value.author);
        formData.append("description", newArticle.value.description);
        formData.append("category", newArticle.value.category);
        formData.append("topic", newArticle.value.topic);

        if (file.value) {
            formData.append("cover_image", file.value);
        }

        await axios.post("/resources", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        // Fetch the updated resources list after successful creation
        fetchResources();

        // Reset the form and modal
        newArticle.value = {
            title: "",
            author: "",
            description: "",
            category: "",
            topic: "",
        };
        file.value = null;
        console.log("Form Submitted:", newArticle.value);
        showCreateModal.value = false;
    } catch (error) {
        console.error("Error creating article:", error);
    }
};

///////////////////////////

///////////// add new book
// Manage articles and books
const showCreateBookModal = ref(false); // Toggle for Book Modal
const newBook = ref({
    title: "",
    file: null,
    description: "",
    type: "",
    author: "",
    category: "",
    publisher: "",
    published_date: "",
    pages: "",
});

// Handle file selection for book upload
const handleBookFileUpload = (event) => {
    newBook.value.file = event.target.files[0];
};

// Method to handle book creation
const createBook = async () => {
    try {
        const formData = new FormData();
        formData.append("title", newBook.value.title);
        formData.append("file", newBook.value.file);
        formData.append("description", newBook.value.description);
        formData.append("type", newBook.value.type);
        formData.append("author", newBook.value.author);
        formData.append("category", newBook.value.category);
        formData.append("publisher", newBook.value.publisher);
        formData.append("published_date", newBook.value.published_date);
        formData.append("pages", newBook.value.pages);

        await axios.post("/books", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        // Reset the form and modal
        newBook.value = {
            title: "",
            file: null,
            description: "",
            type: "",
            author: "",
            category: "",
            publisher: "",
            published_date: "",
            pages: "",
        };
        console.log("Book Uploaded:", newBook.value);
        showCreateBookModal.value = false;

        // Optionally refetch the books to update the list
        fetchBooks();
    } catch (error) {
        console.error("Error uploading book:", error);
    }
};


///////////// add new book - END

// Data properties for search and filtering
const searchTerm = ref("");
const selectedTopic = ref("");
const resources = ref([]);
const mostReadResources = ref([]); // Separate array for Most Read
const books = ref([]);

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
const fetchBooks = async () => {
    try {
        const response = await axios.get("/books");
        console.log("Books API Response:", response.data); // Log the response
        books.value = response.data.books;
    } catch (error) {
        console.error("Error fetching books:", error);
    }
};

// Fetch resources when the component is mounted
onMounted(() => {
    fetchResources();
    fetchBooks();
    fetchMostReadResources(); // Fetch most read separately
});

// Watch for changes in searchTerm and selectedTopic, and refetch data
watch([searchTerm, selectedTopic], () => {
    fetchResources();
    fetchBooks();
});

// Method to fetch most read resources from the API
const fetchMostReadResources = async () => {
    try {
        const response = await axios.get("/api/resources/most-read");
        mostReadResources.value = response.data;
    } catch (error) {
        console.error("Error fetching most read resources:", error);
    }
};
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex min-h-screen bg-gray-100">
            <!-- Left Navigation Panel -->
            <NavLeft />

            <!-- Main Content Area -->
            <div
                class="flex flex-col mx-6 content-width-400 px-2 w-full divide-x-2"
            >
                <!-- Header -->
                <div class="flex items-center mb-4">
                    <h1 class="text-lg text-gray-500 pl-2">RESOURCES</h1>
                </div>

                <!-- Filters and Search -->
                <div
                    class="flex flex-col md:flex-row items-center justify-between bg-white p-4 rounded-lg shadow-md mb-6 space-y-4 md:space-y-0"
                >
                    <!-- Topic Dropdown -->
                    <div class="w-full md:w-1/4 relative">
                        <!-- Added relative positioning for z-index to work -->
                        <TopicDropdown
                            v-model="selectedTopic"
                            class="w-full z-20"
                        />
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

                <!-- -->

                <div class="flex justify-end mb-4">
                    <button
                        @click="showCreateModal = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow"
                    >
                        Add New Article
                    </button>
                </div>

                <div
                    v-if="showCreateModal"
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                >
                    <div
                        class="bg-white rounded-lg p-6 shadow-md w-full max-w-lg"
                    >
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">
                            Create New Article
                        </h2>
                        <form @submit.prevent="createArticle">
                            <div class="mb-4">
                                <label
                                    for="title"
                                    class="block text-sm font-medium text-gray-700"
                                    >Title</label
                                >
                                <input
                                    v-model="newArticle.title"
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter article title"
                                    required
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="author"
                                    class="block text-sm font-medium text-gray-700"
                                    >Author</label
                                >
                                <input
                                    v-model="newArticle.author"
                                    id="author"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter author's name"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="description"
                                    class="block text-sm font-medium text-gray-700"
                                    >Description</label
                                >
                                <textarea
                                    v-model="newArticle.description"
                                    id="description"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Write a brief description"
                                ></textarea>
                            </div>
                            <div class="mb-4">
                                <label
                                    for="category"
                                    class="block text-sm font-medium text-gray-700"
                                    >Category</label
                                >
                                <input
                                    v-model="newArticle.category"
                                    id="category"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter category"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="topic"
                                    class="block text-sm font-medium text-gray-700"
                                    >Topic</label
                                >
                                <input
                                    v-model="newArticle.topic"
                                    id="topic"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter topic"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="cover_image"
                                    class="block text-sm font-medium text-gray-700"
                                    >Cover Image</label
                                >
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

                <!-- -->

                <!-- Add New Book Button -->
                <div class="flex justify-end mb-4">
                    <button
                        @click="showCreateBookModal = true"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow"
                    >
                        Add New Book
                    </button>
                </div>
                <!-- Book Upload Modal -->
                <div
                    v-if="showCreateBookModal"
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 overflow-auto"
                >
                    <div
                        class="bg-white rounded-lg p-6 shadow-md w-full max-w-lg max-h-[90vh] overflow-y-auto"
                    >
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">
                            Upload New Book
                        </h2>
                        <form @submit.prevent="createBook">
                            <div class="mb-4">
                                <label
                                    for="book-title"
                                    class="block text-sm font-medium text-gray-700"
                                    >Title</label
                                >
                                <input
                                    v-model="newBook.title"
                                    id="book-title"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter book title"
                                    required
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="book-file"
                                    class="block text-sm font-medium text-gray-700"
                                    >Upload File</label
                                >
                                <input
                                    id="book-file"
                                    type="file"
                                    @change="handleBookFileUpload"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    required
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="book-description"
                                    class="block text-sm font-medium text-gray-700"
                                    >Description</label
                                >
                                <textarea
                                    v-model="newBook.description"
                                    id="book-description"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Write a brief description"
                                ></textarea>
                            </div>
                            <div class="mb-4">
                                <label
                                    for="book-type"
                                    class="block text-sm font-medium text-gray-700"
                                    >Type</label
                                >
                                <input
                                    v-model="newBook.type"
                                    id="book-type"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter file type (e.g., PDF, EPUB)"
                                />
                            </div>

                            <div class="mb-4">
                                <label
                                    for="book-author"
                                    class="block text-sm font-medium text-gray-700"
                                    >Author</label
                                >
                                <input
                                    v-model="newBook.author"
                                    id="book-author"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter author name"
                                    required
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="book-category"
                                    class="block text-sm font-medium text-gray-700"
                                    >Category</label
                                >
                                <input
                                    v-model="newBook.category"
                                    id="book-category"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter category"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="book-publisher"
                                    class="block text-sm font-medium text-gray-700"
                                    >Publisher</label
                                >
                                <input
                                    v-model="newBook.publisher"
                                    id="book-publisher"
                                    type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter publisher"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="book-published_date"
                                    class="block text-sm font-medium text-gray-700"
                                    >Published Date</label
                                >
                                <input
                                    v-model="newBook.published_date"
                                    id="book-published_date"
                                    type="date"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="book-pages"
                                    class="block text-sm font-medium text-gray-700"
                                    >Pages</label
                                >
                                <input
                                    v-model="newBook.pages"
                                    id="book-pages"
                                    type="number"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Enter number of pages"
                                />
                            </div>

                            <div class="flex justify-end space-x-4">
                                <button
                                    type="button"
                                    @click="showCreateBookModal = false"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"
                                >
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Add New Book Button - end -->

                <!-- Display Resources -->

                <div class="flex-1 pl-3 flex flex-col">
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-grow"
                    >
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
                                <h2
                                    class="text-lg font-semibold text-blue-700 mb-1"
                                >
                                    {{ resource.title }}
                                </h2>
                                <h3 class="text-sm text-gray-600 mb-2">
                                    by {{ resource.author }}
                                </h3>
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

                        <!-- Books -->
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
                                <h2
                                    class="text-lg font-semibold text-green-700 mb-1"
                                >
                                    {{ book.title }}
                                </h2>
                                <h3 class="text-sm text-gray-600 mb-2">
                                    {{ book.type }}
                                </h3>
                                <p class="text-gray-700 flex-1 text-sm">
                                    {{ book.description }}
                                </p>
                                <p class="text-sm text-gray-500 italic">
                                    File: {{ book.file_name }}
                                </p>
                                <!-- Download Button -->
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
