<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted } from "vue";

// Define props
const props = defineProps({
    posts: {
        type: Array,
        required: true
    },
});

// Log a message when the component is mounted
onMounted(() => {
    console.log('About page mounted');
    console.log(props.posts);
});
</script>

<template>
    <AppLayout>

            <div class="flex flex-col">
                    <h1 class="text-xl mb-4">
                        WeCanTech Mentoring
                    </h1>
                    <div class="space-y-4">
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


    </AppLayout>
</template>

