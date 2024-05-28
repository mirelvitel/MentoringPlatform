<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {AtSymbolIcon, CalendarDaysIcon, ChartBarIcon, HomeIcon, UserGroupIcon} from "@heroicons/vue/20/solid/index.js";
import NavLeft from "@/Shared/NavLeft.vue";

</script>

<template>

    <AppLayout>

        <div class="flex">
            <NavLeft />

            <div class="posts mx-6 content-width--200 bg-gray-200 px-2">
                <h1 class="text-xl text-gray-500">Email</h1>
            </div>
        </div>

    </AppLayout>

</template>
