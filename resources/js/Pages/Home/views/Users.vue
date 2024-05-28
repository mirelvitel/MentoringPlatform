<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {AtSymbolIcon, CalendarDaysIcon, ChartBarIcon, HomeIcon, UserGroupIcon} from "@heroicons/vue/20/solid/index.js";
import {ref} from "vue";

import Users from "@/Pages/Home/views/components/users/Users.vue";
import UsersForm from "@/Pages/Home/views/components/users/UserForm.vue";
import UploadExcel from "@/Pages/Home/views/components/users/UploadExcel.vue";
import PendingRequests from "@/Pages/Home/views/components/users/PendingRequests.vue";
import NavLeft from "@/Shared/NavLeft.vue";

const component = ref('users');

const props = defineProps({
    users: {
        type: Array,
        required: true
    }
});


function addNewUser(user) {
    props.users.push(user);
}

function addUsers(users) {
    for (let user of users) {
        props.users.push(user);
    }
}

function deleteUser(userId) {
    for (let i = 0; i < props.users.length; i++) {
        if (props.users[i].id === userId) {
            props.users.splice(i, 1);
            break;
        }
    }
}

function updateStatus(userId) {console.log(props.users, props.users.length)
    for (let i = 0; i < props.users.length; i++) {
        if (props.users[i].id === userId) {
            props.users[i].status = 'active';
        }
    }
}

</script>

<template>

    <AppLayout>

        <div class="flex">
            <NavLeft />


            <div class="posts mx-6 content-width--400 px-2">
                <h1 class="text-xl text-gray-500 mb-2">USERS</h1>
                <Users :users="users" v-if="component === 'users'"/>

                <UsersForm v-if="component === 'user-form'"
                           @user-added="addNewUser"/>

                <UploadExcel v-if="component === 'upload-excel'"
                             @add-users="addUsers"
                             @delete-user="deleteUser"/>

                <PendingRequests :users="users"
                                 v-if="component === 'pending-requests'"
                                 @delete-user="deleteUser"
                                 @update-status="updateStatus"/>
            </div>

            <div class="summary w-[200px]">
                <h1 class="text-xl text-gray-500 mb-2">USER MANAGEMENT</h1>

                <div
                    @click="component='users'"
                    :class="component==='users' ? 'bg-green-600 ' : 'bg-secondary '"
                    class="w-full py-2 px-4 text-white hover:bg-green-600 transition-all rounded shadow cursor-pointer">
                    Users
                </div>
                <div
                    @click="component='user-form'"
                    :class="component==='user-form' ? 'bg-green-600 ' : 'bg-secondary '"
                    class="w-full py-2 px-4 text-white hover:bg-green-600 transition-all mt-2 rounded shadow cursor-pointer">
                    Add User
                </div>
                <div
                    @click="component='upload-excel'"
                    :class="component==='upload-excel' ? 'bg-green-600 ' : 'bg-secondary '"
                    class="w-full py-2 px-4 text-white hover:bg-green-600 transition-all mt-2 rounded shadow cursor-pointer">
                    Upload Excel
                </div>
                <div
                    @click="component='pending-requests'"
                    :class="component==='pending-requests' ? 'bg-green-600 ' : 'bg-secondary '"
                    class="w-full py-2 px-4 text-white hover:bg-green-600 transition-all mt-2 rounded shadow cursor-pointer">
                    Pending Requests
                </div>
            </div>
        </div>

    </AppLayout>

</template>
