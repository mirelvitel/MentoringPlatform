<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {AtSymbolIcon, CalendarDaysIcon, ChartBarIcon, HomeIcon, UserGroupIcon} from "@heroicons/vue/20/solid/index.js";
import {ref} from "vue";

import Users from "@/Pages/Home/views/components/users/Users.vue";
import UsersForm from "@/Pages/Home/views/components/users/UserForm.vue";
import UploadExcel from "@/Pages/Home/views/components/users/UploadExcel.vue";
import PendingRequests from "@/Pages/Home/views/components/users/PendingRequests.vue";

const component = ref('users');

const props = defineProps({
    users: {
        type: Array,
        required: true
    }
});

</script>

<template>

    <AppLayout>

        <div class="flex">
            <div class="nav-left w-[200px] text-gray-500 pl-4">
                <h1 class="text-xl text-gray-500 mb-2">MAIN</h1>
                <div class="flex items-center text-primary mb-8">
                    <HomeIcon class="h-6 w-6 mr-3"/>
                    <a :href="route('home')" class="">Home</a>
                </div>

                <h1 class="text-xl text-gray-500 mb-2">TOOLS</h1>
                <div class="flex items-center text-primary mb-2">
                    <AtSymbolIcon class="h-6 w-6 mr-3"/>
                    <a :href="route('email')" class="">Email</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <CalendarDaysIcon class="h-6 w-6 mr-3"/>
                    <a :href="route('calendar')" class="">Calendar</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <ChartBarIcon class="h-6 w-6 mr-3"/>
                    <a :href="route('reports')" class="">Reports</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <UserGroupIcon class="h-6 w-6 mr-3"/>
                    <a :href="route('users')" class="">Users</a>
                </div>
            </div>

        
            <div class="posts mx-6 content-width--400 px-2">
                <h1 class="text-xl text-gray-500 mb-2">USERS</h1>
                <Users :users="users" v-if="component === 'users'"/>
                <UsersForm v-if="component === 'user-form'"/>
                <UploadExcel v-if="component === 'upload-excel'"/>
                <PendingRequests v-if="component === 'pending-requests'"/>
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
