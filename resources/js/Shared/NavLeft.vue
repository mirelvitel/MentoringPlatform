<script setup>
import {AtSymbolIcon, FlagIcon, UsersIcon, BookOpenIcon, CalendarDaysIcon, ChartBarIcon, HomeIcon, UserGroupIcon} from "@heroicons/vue/20/solid/index.js";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
const page = usePage();
const user = computed(() => page.props.auth.user);

</script>

<template>
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
        <div v-if="user.role === 'admin'" class="flex items-center text-primary mb-2">
            <ChartBarIcon class="h-6 w-6 mr-3" />
            <a :href="route('reports')" class="">Reports</a>
        </div>
        <div v-if="user.role === 'admin'" class="flex items-center text-primary mb-2">
            <UserGroupIcon class="h-6 w-6 mr-3" />
            <a :href="route('users')" class="">Users</a>
        </div>
        <div v-if="user.role !== 'admin'" class="flex items-center text-primary mb-2">
            <BookOpenIcon class="h-6 w-6 mr-3" />
            <a :href="route('resources')" class="">Resources</a>
        </div>
        <div v-if="user.role !== 'admin'" class="flex items-center text-primary mb-2">
            <UsersIcon class="h-6 w-6 mr-3" />
            <a class="">Mentorship</a>
        </div>
        <div v-if="user.role !== 'admin'" class="flex items-center text-primary mb-2">
            <FlagIcon class="h-6 w-6 mr-3" />
            <a class="">Milestone</a>
        </div>
    </div>
</template>
