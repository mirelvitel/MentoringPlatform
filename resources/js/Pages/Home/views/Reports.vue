<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {AtSymbolIcon, CalendarDaysIcon, ChartBarIcon, HomeIcon, UserGroupIcon} from "@heroicons/vue/20/solid/index.js";

</script>

<template>

    <AppLayout>

        <div class="flex">
            <div class="nav-left w-[200px] text-gray-500 pl-4">
                <h1 class="text-xl text-gray-500 mb-2">MAIN</h1>
                <div class="flex items-center text-primary mb-8">
                    <HomeIcon class="h-6 w-6 mr-3" />
                    <a :href="route('home')" class="">Home</a>
                </div>

                <h1 class="text-xl text-gray-500 mb-2">TOOLS</h1>
                <div class="flex items-center text-primary mb-2">
                    <AtSymbolIcon class="h-6 w-6 mr-3" />
                    <a :href="route('email')" class="">Email</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <CalendarDaysIcon class="h-6 w-6 mr-3" />
                    <a :href="route('calendar')" class="">Calendar</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <ChartBarIcon class="h-6 w-6 mr-3" />
                    <a :href="route('reports')" class="">Reports</a>
                </div>
                <div class="flex items-center text-primary mb-2">
                    <UserGroupIcon class="h-6 w-6 mr-3" />
                    <a :href="route('users')" class="">Users</a>
                </div>
            </div>

            <div class="posts mx-6 content-width--200 bg-gray-200 px-2">
                <h1 class="text-xl text-gray-500">Reports</h1>
            </div>
        </div>

    </AppLayout>

</template>
