<!-- UserEditForm.vue -->
<script setup>
import { ref, watch, defineProps } from 'vue';

const props = defineProps({
    userData: {
        type: Object,
        required: true,
    }
});

// Create refs for each form field, initialized with userData
const name = ref(props.userData.name);
const email = ref(props.userData.email);
const status = ref(props.userData.status);
const password = ref('');
const profilePhoto = ref(props.userData.profile_photo_path);
const role = ref(props.userData.role);

const showPassword = ref(false); // password visibility

// Watch for changes in props.userData to update the form values
watch(() => props.userData, (newUserData) => {
    name.value = newUserData.name;
    email.value = newUserData.email;
    status.value = newUserData.status;
    role.value = newUserData.role;
});

// Handle file input changes
const handleFileChange = (event) => {
    const file = event.target.files[0];  // Get the first selected file
    profilePhoto.value = file;  // Store the file in the profilePhoto ref
};

// toggle password visibility
const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

// Method to handle form submission (e.g., updating user in the database)
const updateUser = () => {
    const updatedUser = {
        name: name.value,
        email: email.value,
        status: status.value,
        password: password.value,
        profile_photo: profilePhoto.value,
        role: role.value
    };
    
    // Emit the updated user back to the parent component
    emit('update-user', updatedUser);
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-lg font-bold mb-4">Edit User</h2>
            <form @submit.prevent="updateUser">
                <div class="mb-4">
                    <label class="block text-sm font-medium">Name</label>
                    <input v-model="name" type="text" class="border border-gray-300 rounded p-2 w-full" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Email</label>
                    <input v-model="email" type="email" class="border border-gray-300 rounded p-2 w-full" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Status</label>
                    <select v-model="status" class="border border-gray-300 rounded p-2 w-full">
                        <option value="active">Active</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Password</label>
                    <div class="relative">
                        <div class="flex">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            v-model="password"
                            class="border border-gray-300 rounded p-2 w-full"
                            placeholder="Leave blank to keep current password"
                        />
                        <button
                            type="button"
                            @click="togglePasswordVisibility"
                            class="absolute right-0 top-0 bottom-0 px-3 py-2 bg-gray-200 text-sm text-gray-700 rounded-r-md"
                        >
                            {{ showPassword ? 'Hide' : 'Show' }}
                        </button>
                    </div>
                    </div>
                    
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Profile Photo</label>
                    <input type="file" class="border border-gray-300 rounded p-2 w-full" @change="handleFileChange" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Role</label>
                    <select v-model="role" class="border border-gray-300 rounded p-2 w-full">
                        <option value="admin">Admin</option>
                        <option value="mentor">Mentor</option>
                        <option value="mentee">Mentee</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button @click="$emit('close')" type="button" class="bg-gray-500 text-white py-2 px-4 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
</style>
