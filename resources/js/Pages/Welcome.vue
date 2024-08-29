<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-primary border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div
                    class="max-w-[2000px] mx-auto h-[100px] md:px-4 flex items-center"
                >
                    <div class="flex justify-between items-center w-full">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="flex items-center">
                                <img
                                    src="/assets/images/newlogo.png"
                                    class="h-[80px]"
                                />
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Log In Button -->
                            <div class="ms-3 relative">
                                <Link
                                    :href="route('login')"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                >
                                    Log In
                                </Link>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <!-- Responsive Log In Option -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink
                                :href="route('login')"
                                :active="route().current('login')"
                            >
                                Log In
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-[2000px] mx-auto py-6 md:px-4">
                <slot />
                <div class="flex flex-col items-center">
                    <h1 class="text-xl font-bold mb-4 text-center text-primary">
                        WELCOME!
                    </h1>
                    <h1 class="text-xl mb-4 text-center">
                        WeCanTech Mentoring
                    </h1>
                    <div class="w-1/2 space-y-4 text-center">
                        <p>
                            (DE) Das WeCanTech-Mentoring wird für Studentinnen
                            aus Master-Studiengängen der FH Technikum Wien im
                            letzten Studienjahr ausgeschrieben. Zehn ausgewählte
                            Teilnehmerinnen erhalten ein individuelles Mentoring
                            durch jeweils passende Mentorinnen. Die Mentorinnen
                            sind erfolgreiche Technikerinnen von
                            WeCanTech-Firmenpartnerschaften. Dabei entsteht eine
                            persönlich gestaltete Beziehung zwischen einer
                            beruflich erfahrenen Frau und einer Studentin. Ziel
                            ist es, Karrieremöglichkeiten aufzuzeigen,
                            Branchen-Knowhow zu vermitteln, Erfahrungen
                            auszutauschen sowie einen persönlichen Kontakt zum
                            Unternehmen zu schaffen. Mentoring ist ein besonders
                            starkes Instrument zur Förderung von Frauen!
                            <br />
                        </p>
                        <p class="about-paragraph">
                            (EN) The WeCanTech mentoring is advertised for
                            female students from Master's programs in their
                            final year of study. Ten selected participants
                            receive individual mentoring from suitable mentors.
                            This creates a personalized relationship between a
                            woman with professional experience and a female
                            student. The aim is to highlight career
                            opportunities, impart industry know-how, exchange
                            experiences and establish personal contact with the
                            company.
                            <br />Mentoring is a particularly powerful tool for
                            promoting women!
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
