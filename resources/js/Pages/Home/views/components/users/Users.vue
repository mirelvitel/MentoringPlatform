<script setup>
import { ref } from 'vue';
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid/index.js";
import moment from "moment";
import EditForm from "./UserEditForm.vue";

const props = defineProps({
    users: {
        type: Array,
        required: true,
    },
});

// State to track whether the edit form is shown or not
const showEditForm = ref(false);

// State to hold the user data to be edited
const selectedUser = ref(null);

// Function to open the edit form with the selected user data
function openEditForm(user) {
    selectedUser.value = user;
    showEditForm.value = true;
}

// Function to close the edit form
function closeEditForm() {
    showEditForm.value = false;
}

// Function to handle the updated user data (this would be where you save changes)
function updateUser(updatedUser) {
    console.log('Updated user:', updatedUser);
    // Here, you would typically send a request to the backend to update the user
}

</script>

<template>
    <div>
        <div class="flex mb-3">
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
                            :class="user.status === 'pending' ? 'bg-red-100 cursor-not-allowed ' : ''"
                            class="border-b hover:bg-gray-50"
                        >
                            <td class="p-4">{{ user.name }}</td>
                            <td class="p-4">{{ user.email }}</td>
                            <td class="p-4">{{ user.role }}</td>
                            <td class="p-4">
                                {{ moment(user.created_at).format('DD.MM.YYYY') }}
                            </td>
                            <td class="p-4">
                                <button @click="openEditForm(user)" class="text-primary font-semibold">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <EditForm 
            v-if="showEditForm" 
            :userData="selectedUser" 
            @update-user="updateUser" 
            @close="closeEditForm" 
        />
    </div>
</template>
