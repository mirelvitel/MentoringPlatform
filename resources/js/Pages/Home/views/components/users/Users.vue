<script setup>
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid/index.js";

const props = defineProps({
    users: {
        type: Array,
        required: true,
    },
});

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString("en-GB", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    });
}
</script>

<template>
    <div>
        <div class="flex max-w-2xl mx-auto mb-3">
            <form>
                <div>
                    <input
                        type="search"
                        placeholder="Search"
                        id="default-search"
                        class="block p-2 pl-3 w-full rounded-lg border border-gray-200 dark:focus:border-blue-500"
                        required
                    />
                </div>
            </form>
            <button
                type="submit"
                class="ml-2 text-white bg-primary hover:bg-blue-700 rounded-lg text-sm px-3"
            >
                <MagnifyingGlassIcon class="h-6 w-6" />
            </button>
        </div>
        <div class="bg-white">
            <div class="overflow-x-auto border-x border-t">
                <table class="table-auto w-full">
                    <thead class="border-b">
                        <tr class="bg-gray-200">
                            <th class="text-left p-4 font-medium text-primary">
                                Name
                            </th>
                            <th class="text-left p-4 font-medium text-primary">
                                Email
                            </th>
                            <th class="text-left p-4 font-medium text-primary">
                                Role
                            </th>
                            <th class="text-left p-4 font-medium text-primary">
                                Registered
                            </th>
                            <th class="text-left p-4 font-medium"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="user in users"
                            :key="user.id"
                            class="border-b hover:bg-gray-50"
                        >
                            <td class="p-4">{{ user.name }}</td>
                            <td class="p-4">{{ user.email }}</td>
                            <td class="p-4">{{ user.role }}</td>
                            <td class="p-4">
                                {{ formatDate(user.created_at) }}
                            </td>
                            <td class="p-4">
                                <button class="text-primary font-semibold">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
