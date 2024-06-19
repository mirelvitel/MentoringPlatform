<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import NavLeft from "@/Shared/NavLeft.vue";
import TopicDropdown from "@/Components/TopicDropdown.vue";
import Book from "@/Components/Book.vue";
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid/index.js";
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex">
            <NavLeft />
            <div class="flex flex-col mx-6 content-width-400 px-2 w-full divide-x-2">
                <div class="flex items-center mb-4">
                    <h1 class="text-xl text-gray-500 pl-2">RESOURCES</h1>
                </div>
                <div class="flex justify-between items-center w-full">
                    <div class="pl-2">
                        <TopicDropdown />
                    </div>
                    <div class="flex items-center">
                        <form class="flex items-center">
                            <input
                                type="search"
                                placeholder="Search"
                                id="default-search"
                                class="block p-2 pl-3 w-full rounded-lg border border-gray-200 dark:focus:border-blue-500"
                                required
                            />
                            <button
                                type="submit"
                                class="ml-2 text-white bg-primary hover:bg-blue-700 rounded-lg text-sm px-3 h-10"
                            >
                                <MagnifyingGlassIcon class="h-6 w-6" />
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex flex-col flex-grow justify-center items-center">
                    <p class="italic text-lg text-primary">Empower Your Journey: Access Tools and Insights for Meaningful Mentorship</p>
                </div>
            </div>

            <div class="mostread w-[200px] divide-x-2">
                <h1 class="text-xl text-gray-500 pl-2">MOST READ</h1>

                <Book/>
            </div>
        </div>
    </AppLayout>
</template>
