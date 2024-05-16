<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {AtSymbolIcon, CalendarDaysIcon, ChartBarIcon, HomeIcon, UserGroupIcon} from "@heroicons/vue/20/solid/index.js";

</script>

<template>

    <AppLayout>

        <div class="flex">
            <div class="nav-left w-[200px] text-gray-500">
                <div class="flex items-center text-primary mb-12">
                    <HomeIcon class="h-6 w-6 mr-4"/>
                    <a :href="route('home')" class="">HOME</a>
                </div>

                <h2>Tools</h2>
                <div class="flex items-center text-primary mb-2">
                    <AtSymbolIcon class="h-6 w-6 mr-4"/>
                    <a :href="route('email')" class="">Email</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <CalendarDaysIcon class="h-6 w-6 mr-4"/>
                    <a :href="route('calendar')" class="">Calendar</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <ChartBarIcon class="h-6 w-6 mr-4"/>
                    <a :href="route('reports')" class="">Reports</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <UserGroupIcon class="h-6 w-6 mr-4"/>
                    <a :href="route('users')" class="">Users</a>
                </div>
            </div>

            <div class="posts mx-6 content-width--200 bg-gray-200 px-2">
                <h1 class="text-xl text-gray-500">Email</h1>
            </div>
        </div>

    </AppLayout>

</template>
