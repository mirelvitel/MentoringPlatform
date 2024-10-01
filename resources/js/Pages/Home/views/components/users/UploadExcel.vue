<script setup>
import { useToast } from "vue-toastification";
import { ref } from "vue";
import axios from 'axios';

const toast = useToast();

const users = ref(null);

const emit = defineEmits(["add-users", "delete-user"]);

function uploadExcel(event) {
    const file = event.target.files[0];
    if (!file) {
        toast.error("No file selected");
        return;
    }

    const formData = new FormData();
    formData.append("file", file);

    axios
        .post("/users/upload-excel", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then((response) => {
            toast.success("Users uploaded successfully");
            users.value = response.data;
            emit("add-users", response.data);
        })
        .catch((error) => {
            toast.error(error.response.data.message);
        });
}

function deleteUser(userId) {
    if (!confirm("Are you sure you want to delete this user?")) {
        return;
    }
    axios
        .delete(`/users/${userId}`)
        .then((response) => {
            toast.success("User deleted successfully");
            users.value = users.value.filter((user) => user.id !== userId);
            emit("delete-user", userId);
        })
        .catch((error) => {
            toast.error("An error occurred while deleting user");
        });
}
</script>

<template>
    <div>
        <div class="flex flex-col justify-center">
            <input
                type="file"
                @change="uploadExcel"
                accept=".xlsx, .xls"
                class="border-2 border-primary-300 p-2 rounded-lg w-full h-20 flex items-center justify-center p-6 bg-white"
            />
            <a
                href="/assets/example_file.xls"
                download
                class="text-primary mt-2 underline items-start"
                >Example File</a
            >
        </div>

        <div v-if="users !== null" class="bg-white mt-6">
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
                                <button
                                    @click="deleteUser(user.id)"
                                    class="text-white bg-red-400 px-2 rounded font-semibold hover:bg-red-500 transition-all"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
