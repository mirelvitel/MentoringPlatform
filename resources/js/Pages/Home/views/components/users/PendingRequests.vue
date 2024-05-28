<script setup>

import {useToast} from "vue-toastification";
import {computed, ref} from "vue";

const toast = useToast();
import axios from "axios";
import {usePage} from "@inertiajs/vue3";

const page = usePage();
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

const emit = defineEmits(["updateStatus", 'deleteUser']);

function acceptUser(userId) {
    axios.put(`/users/${userId}`).then((response) => {
        //props.users.splice(props.users.findIndex((user) => user.id === userId), 1)
        toast.success("Status updated successfully");
        emit('updateStatus', userId);
    }).catch((error) => {
        toast.error("An error occurred while updating status");
    });
}

function deleteUser(userId) {
    if (!confirm("Are you sure you want to delete this user?"))
        return;

    axios
        .delete(`/users/${userId}`)
        .then((response) => {
            toast.success("User deleted successfully");
            emit('deleteUser', userId);
        })
        .catch((error) => {
            toast.error("An error occurred while updating status");
        });
}

const user = computed(() => page.props.auth.user);
</script>

<template>
    <div>
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
                            Registration Request
                        </th>
                        <th class="text-left p-4 font-medium text-primary">

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="user in users">
                        <tr
                            v-if="user.status === 'pending'"
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
                                <button @click="acceptUser(user.id)"
                                        class="text-white bg-secondary font-semibold border rounded mr-2 py-1 px-1">
                                    Accept
                                </button>
                                <button @click="deleteUser(user.id)"
                                        class="text-white bg-red-500 hover:bg-red-600 transition-all font-semibold border rounded py-1 px-1">
                                    Refuse
                                </button>
                            </td>
                        </tr>
                    </template>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
